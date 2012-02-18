<?php
/**
 * O pedido de venda tem as seguintes situações:
 * A = Aberto
 * O = Orçamento
 * C = Cancelado
 * V = Vendido
 * T = Travado
 */

//#TODO criar alerta caso o(s) pedido(s) totalize(m) um valor maior que o limite de credito  
//#TODO ao cancelar um pedido de venda a conta a receber nao é cancela. Cancelar?
class PedidoVendasController extends AppController {
	var $name = 'PedidoVendas';
	var $components = array ('Geral','ContasReceber');
	var $helpers = array('CakePtbr.Estados', 'Javascript','CakePtbr.Formatacao','Geral');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'PedidoVenda.id' => 'desc'
		)
	);
	
	function _obter_opcoes() {
		$opcoes_forma_pamamento = $this->PedidoVenda->FormaPagamento->find('list',array('fields'=>array('FormaPagamento.id','FormaPagamento.nome')));
		$this->set('opcoes_forma_pamamento',$opcoes_forma_pamamento);
		
		$opcoes_empresas = $this->PedidoVenda->Empresa->find('list',array('fields'=>array('Empresa.id','Empresa.nome')));
		$this->set('opcoes_empresas',$opcoes_empresas);
		
		$opcoes_situacoes = array(
			'A'=>'Aberto',
			'O' => 'Orçamento',
			'C' => 'Cancelado',
			'V' => 'Vendido',
			'T' => 'Travado',
		);
		$this->set('opcoes_situacoes',$opcoes_situacoes);
		
		// view pesquisa
		$this->loadModel('Usuario');	
		$opcoes_usuarios = $this->Usuario->find('list',array('fields'=>array('Usuario.id','Usuario.nome'), 'conditions'=>array('Usuario.ativo'=>'1','Usuario.eh_tecnico'=>'0')));
		$this->set('opcoes_usuarios',$opcoes_usuarios);
	}
	
	/**
	* caso algum produto seja enviado (erro na validacao, editando registro, etc),
	* o insiro na pagina
	*/
	function _recupera_produtos_inseridos($data) {
		if (isset($data['PedidoVendaItem'])) {
			$itens = $data['PedidoVendaItem'];
			$i = 0;
			$valor_total = 0;
			$campos_ja_inseridos = array();
			foreach ($itens as $item) {
				$n = $this->PedidoVenda->PedidoVendaItem->Produto->findById($item['produto_id']);
				$n = $n['Produto']['nome'];
				$campos_ja_inseridos[$i] = array('produto_id'=>$item['produto_id']);
				$campos_ja_inseridos[$i] += array('produto_nome'=>$n);
				$campos_ja_inseridos[$i] += array('quantidade'=>$item['quantidade']);
				$campos_ja_inseridos[$i] += array('preco_venda'=>$item['preco_venda']);
				$i++;
			}
			$this->set('campos_ja_inseridos',$campos_ja_inseridos);
			return 1;
		}
		
		return 0;
	}
	
	function _calcular_valores($data) {
		$valor_bruto = 0;
		$valor_liquido = 0;
		foreach ($data['PedidoVendaItem'] as $c) {
			$valor_bruto += ($this->Geral->moeda2numero($c['quantidade'])) * ($this->Geral->moeda2numero($c['preco_venda']));
		}
		// se ha outros custos, somo para obter o valor bruto
		if (isset($data['PedidoVenda']['custo_frete']) && (! empty($data['PedidoVenda']['custo_frete']))) {
			$valor_bruto = $valor_bruto + ($this->Geral->moeda2numero($data['PedidoVenda']['custo_frete']));
		}
		if (isset($data['PedidoVenda']['custo_seguro']) && (! empty($data['PedidoVenda']['custo_seguro']))) {
			$valor_bruto = $valor_bruto + ($this->Geral->moeda2numero($data['PedidoVenda']['custo_seguro']));
		}
		if (isset($data['PedidoVenda']['custo_outros']) && (! empty($data['PedidoVenda']['custo_outros']))) {
			$valor_bruto = $valor_bruto + ($this->Geral->moeda2numero($data['PedidoVenda']['custo_outros']));
		}
		$valor_liquido = $valor_bruto;
		// se ha desconto, subtraio para obter o valor liquido
		if (isset($data['PedidoVenda']['desconto']) && (! empty($data['PedidoVenda']['desconto']))) {
			$valor_liquido = $valor_bruto - ($this->Geral->moeda2numero($data['PedidoVenda']['desconto']));
		}
		
		$retorno = array(
			'valor_bruto' => $valor_bruto,
			'valor_liquido' => $valor_liquido
		);
		
		return $retorno;
	}
	
	/**
	 * @see Component ContasReceber
	 */
	function _gerar_conta_receber($valor_total=null) {
		// Apenas crio a forma de pagamento se a situacao do pedido for 'Vendido'
		if (strtoupper($this->data['PedidoVenda']['situacao']) == 'V' ) {
			$dados = array_merge(
				array('valor_total'=>$valor_total),
				array('numero_documento'=>$this->PedidoVenda->id),
				$this->data['PedidoVenda']
				);
			return $this->ContasReceber->gerarContaReceber($dados);
			
		}
		return true;
	}
	
	/**
	 * Faz a baixe do estoque de determinados produtos	
	 * 
	 * @return true em caso de sucesso
	 * @return false em caso de falha
	 * @return null caso a baixa no estoque nao seja aplicavel a situacao
	 * @return dados modificados no banco
	 */
	function _baixar_estoque() {
		// apenas baixa o estoque se o pedido estiver Vendido
		if (strtoupper($this->data['PedidoVenda']['situacao']) != 'V' ) return null;
		
		$erro=0;
		foreach ($this->data['PedidoVendaItem'] as $item) {
			$temEstoqueIlimitado = $this->PedidoVenda->PedidoVendaItem->Produto->field('tem_estoque_ilimitado',array('Produto.id'=>$item['produto_id']));
			if ($temEstoqueIlimitado) return null;
		
			$quantidadeNaoFiscal = $this->PedidoVenda->PedidoVendaItem->Produto->field('quantidade_estoque_nao_fiscal',array('Produto.id'=>$item['produto_id']));
			if (empty($quantidadeNaoFiscal)) {
				$this->Session->setFlash('Erro na baixa de estoque: não foi possível recuperar a quantidade do produto.','flash_erro');
				return false;
			}
			
			$quantidadeFiscal = $this->PedidoVenda->PedidoVendaItem->Produto->field('quantidade_estoque_fiscal',array('Produto.id'=>$item['produto_id']));
			if (empty($quantidadeFiscal)) {
				$this->Session->setFlash('Erro na baixa de estoque: não foi possível recuperar a quantidade do produto.','flash_erro');
				return false;
			}
			
			$quantidadeReservada = $this->PedidoVenda->PedidoVendaItem->Produto->field('quantidade_reservada',array('Produto.id'=>$item['produto_id']));
			if (empty($quantidadeReservada)) $quantidadeReservada = 0;
			
			$quantidadeDisponivel = $quantidadeNaoFiscal - $quantidadeReservada;
			if (! is_numeric($quantidadeDisponivel)) {
				$this->Session->setFlash('Erro na baixa de estoque: não foi possível determinar a quantidade reservada.','flash_erro');
				return false;
			}
			
			if ($this->Geral->moeda2numero($item['quantidade']) > $quantidadeDisponivel) {
				$this->Session->setFlash("O produto ${item['produto_id']} não está disponível na quantidade informada.",'flash_erro');
				$erro++;
			}
			else if ($erro == 0) {
				$dados = array (
					'Produto' => array (
						'quantidade_estoque_fiscal' => $quantidadeFiscal - $this->Geral->moeda2numero($item['quantidade']),
						'quantidade_estoque_nao_fiscal' => $quantidadeNaoFiscal - $this->Geral->moeda2numero($item['quantidade']),
					),
				);
				$this->PedidoVenda->PedidoVendaItem->Produto->id = $item['produto_id'];
				if (! $this->PedidoVenda->PedidoVendaItem->Produto->save($dados) ) {
					$this->Session->setFlash('Erro ao realizar baixa no estoque!','flash_erro');
					return false;
				}
			}
		}
		
		if ( (isset($erro) && ($erro>1)) ) return false;
		
	}
	
	function index() {
		$dados = $this->paginate('PedidoVenda');
		$this->set('consulta',$dados);
		$this->_obter_opcoes();
	}
	
	function cadastrar() {
		$this->set("title_for_layout","Pedido de venda"); 
		$this->_obter_opcoes();
		if (! empty($this->data)) {
			$this->_recupera_produtos_inseridos($this->data);
			$this->loadModel('Cliente');
			$r = $this->Cliente->find('first',
				array('conditions'=>array(
					'Cliente.id' => $this->data['PedidoVenda']['cliente_id'],
					'Cliente.situacao' => 'A')));
			if (empty($r)) {
				$this->Session->setFlash('Cliente não existe ou não está ativo.','flash_erro');
				return null;
			}
			$this->data['PedidoVenda'] += array ('data_hora_cadastrado' => date('Y-m-d H:i:s'));
			$this->data['PedidoVenda'] += array ('usuario_cadastrou' => $this->Auth->user('id'));
			$valores = $this->_calcular_valores($this->data);
			$valor_bruto = $valores['valor_bruto'];
			$valor_liquido = $valores['valor_liquido'];
			if ($valor_liquido <= 0) {
				$this->Session->setFlash('O valor total do pedido é R$ '.$this->Geral->numero2moeda($valor_liquido),'flash_erro');
				return null;
			}
			$this->data['PedidoVenda'] += array ('valor_bruto' => $valor_bruto);
			$this->data['PedidoVenda'] += array ('valor_liquido' => $valor_liquido);
			
			// evito que o conteudo seja preenchido com 0000-00-00
			if (empty($this->data['PedidoVenda']['data_saida'])) $this->data['PedidoVenda']['data_saida'] = null;
			if (empty($this->data['PedidoVenda']['data_entrega'])) $this->data['PedidoVenda']['data_entrega'] = null;
			if (empty($this->data['PedidoVenda']['data_venda'])) $this->data['PedidoVenda']['data_venda'] = null;
			
			//Inicia uma transaction
			$this->PedidoVenda->begin();
			
			if ($this->PedidoVenda->saveAll($this->data,array('validate'=>'first'))) {
				if ( $this->_gerar_conta_receber($valor_liquido) !== true ) {
					$this->PedidoVenda->rollback();
				}
				else if ($this->_baixar_estoque() === false) {
					$this->PedidoVenda->rollback();
				}
				else {
					$this->PedidoVenda->commit();
					$this->Session->setFlash("Pedido de venda, código {$this->PedidoVenda->id}, cadastrado com sucesso.<br/>"
					."<a href='#' onclick=popup('pedido_vendas/cupomNaoFiscal/{$this->PedidoVenda->id}','300','300') > Imprimir cupom não fiscal</a>"."
					",'flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar o pedido de venda.','flash_erro');
				$this->PedidoVenda->rollback();
			}
		}
	}
	
	function editar($id=NULL) {
		$this->set("title_for_layout","Pedido de venda"); 
		$this->_obter_opcoes();
		if (empty ($this->data)) {
			$this->PedidoVenda->id = $id;
			$this->data = $this->PedidoVenda->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Pedido de venda não encontrado.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->_recupera_produtos_inseridos($this->data);
				
				if ($this->data['PedidoVenda']['data_saida'] == '0000-00-00') $this->data['PedidoVenda']['data_saida'] = null;
				else $this->data['PedidoVenda']['data_saida'] = date('d/m/Y', strtotime($this->data['PedidoVenda']['data_saida']));
				
				if ($this->data['PedidoVenda']['data_entrega'] == '0000-00-00') $this->data['PedidoVenda']['data_entrega'] = null;
				else $this->data['PedidoVenda']['data_entrega'] = date('d/m/Y', strtotime($this->data['PedidoVenda']['data_entrega']));
				
				if ($this->data['PedidoVenda']['data_venda'] == '0000-00-00') $this->data['PedidoVenda']['data_venda'] = null;
				else $this->data['PedidoVenda']['data_venda'] = date('d/m/Y', strtotime($this->data['PedidoVenda']['data_venda']));
			}
		}
		else {
			$this->_recupera_produtos_inseridos($this->data);
			$this->loadModel('Cliente');
			$r = $this->Cliente->find('first',
				array('conditions'=>array(
					'Cliente.id' => $this->data['PedidoVenda']['cliente_id'],
					'Cliente.situacao' => 'A')));
			if (empty($r)) {
				$this->Session->setFlash('Erro. Cliente não existe ou não está ativo.','flash_erro');
				return null;
			}
			//o pedido de venda pode ser editado apenas se nao tiver sido cancelado ou vendido
			$s = strtoupper($this->PedidoVenda->field('situacao'));
			if ( ($s == 'V') || ($s == 'C') || ($s == 'T') ) {
				// o usuario pode cancelar um pedido de venda na situacao 'Vendido'
				if (strtoupper($this->data['PedidoVenda']['situacao']) != 'C') {
					$this->Session->setFlash('A situação deste pedido de venda impede que seja editado','flash_erro');
					return null;
				}
			}
			$this->data['PedidoVenda']['id'] = $id;
			$this->data['PedidoVenda'] += array ('usuario_alterou' => $this->Auth->user('id'));
			$valores = $this->_calcular_valores($this->data);
			$valor_bruto = $valores['valor_bruto'];
			$valor_liquido = $valores['valor_liquido'];
			if ($valor_liquido <= 0) {
				$this->Session->setFlash('Erro. O valor total do pedido é R$ '.$this->Geral->numero2moeda($valor_liquido),'flash_erro');
				return null;
			}
			$this->data['PedidoVenda'] += array ('valor_bruto' => $valor_bruto);
			$this->data['PedidoVenda'] += array ('valor_liquido' => $valor_liquido);
			
			// evito que o conteudo seja preenchido com 0000-00-00
			if (empty($this->data['PedidoVenda']['data_saida'])) $this->data['PedidoVenda']['data_saida'] = null;
			if (empty($this->data['PedidoVenda']['data_entrega'])) $this->data['PedidoVenda']['data_entrega'] = null;
			if (empty($this->data['PedidoVenda']['data_venda'])) $this->data['PedidoVenda']['data_venda'] = null;
			
			//Inicia uma transaction
			$this->PedidoVenda->begin();
			
			// #TODO seria bom nao deletar e reinserir todos os registros
			// deleto os itens que pertenciam a pedido de venda
			if( ! ($this->PedidoVenda->PedidoVendaItem->deleteAll(array('pedido_venda_id'=>$id),false))) {
				$this->Session->setFlash('Erro ao atualizar o pedido de venda','flash_erro');
				$this->PedidoVenda->rollback();
				return null;
			}

			// insiro o que foi enviado agora, inclusive os itens
			if ($this->PedidoVenda->saveAll($this->data,array('validate'=>'first'))) {
				if ($this->_gerar_conta_receber($valor_liquido) !== true ) {
					$this->PedidoVenda->rollback();
				}
				else if ($this->_baixar_estoque() === false) {
					$this->PedidoVenda->rollback();
				}
				else {
					$this->PedidoVenda->commit();
					$this->Session->setFlash("Pedido de venda alterado com sucesso.<br/>"
					."<a href='#' onclick=popup('pedido_vendas/cupomNaoFiscal/{$this->PedidoVenda->id}','300','300') > Imprimir cupom não fiscal</a>"."
					",'flash_sucesso');
					//$this->redirect(array('action'=>'index'));
				}
			}
			else {
				$this->Session->setFlash('Erro ao editar o pedido de venda.','flash_erro');
				$this->PedidoVenda->rollback();
			}
			
		}
	}
	
	function detalhar($id = null) {
		$this->set("title_for_layout","Pedido de venda");
		$consulta = $this->PedidoVenda->findById($id);
		if (empty($consulta)) {
			$this->Session->setFlash('Pedido de venda não encontrado','flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			// adiciono, no array resultante, o nome do produto correspondente
			$i = 0;
			$this->loadModel('Produto');
			foreach ($consulta['PedidoVendaItem'] as $x) {
				$nome = $this->Produto->field('nome',array('Produto.id'=>$x['produto_id']));
				$consulta['PedidoVendaItem'][$i]['produto_nome'] = $nome;
				$i++;
			}
			$this->set('c',$consulta);
			$this->_obter_opcoes();
		}
	}

	function excluir($id=NULL) {
		if (! empty($id)) {
			$this->PedidoVenda->id = $id;
			$r = $this->PedidoVenda->field('situacao');
			if (empty ($r)) {
				$this->Session->setFlash('Pedido de venda não encontrado','flash_erro');
				$this->redirect(array('action'=>'pesquisar'));
				return false;
			}
			//Uma pedido de venda apenas pode ser deletado se sua situacao for 'Orçamento' ou 'Aberto'
			$r = strtoupper($r);
			if ( ($r != 'O') && ($r != 'A') ) {
				$this->Session->setFlash('A situação do pedido de venda impede a sua exclusão. Talvez você deva apenas cancelá-lo','flash_erro');
				$this->redirect(array('action'=>'index'));
				return false;
			}
			if ($this->PedidoVenda->PedidoVendaItem->deleteAll(array('PedidoVendaItem.pedido_venda_id'=>$id))) {
				if ($this->PedidoVenda->delete($id)) {
					$this->Session->setFlash("Pedido de venda número $id foi excluído com sucesso.",'flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else $this->Session->setFlash("Pedido de venda $id não pode ser excluído",'flassh_erro');
			}
			else $this->Session->setFlash("Pedido de venda número $id não pode ser excluído.",'flash_erro');
			$this->redirect(array('action'=>'pesquisar'));
		}
		else {
			$this->Session->setFlash('Pedido de venda não informado.','flash_erro');
			$this->redirect(array('action'=>'pesquisar'));
		}
	}
	
	function pesquisar() {
		$this->set("title_for_layout","Pedido de venda");
		$this->_obter_opcoes();
		if (! empty($this->data)) {
			//usuario enviou os dados da pesquisa
			$url = array('controller'=>'PedidoVendas','action'=>'pesquisar');
			//trocandos as barras dos campos de data, pois estes parametros, caso existam, vou para a url
			if (!empty($this->data['PedidoVenda']['data_hora_cadastrado'])) $this->data['PedidoVenda']['data_hora_cadastrado'] = preg_replace('/\//', '-', $this->data['PedidoVenda']['data_hora_cadastrado']);
			// codificando os parametros
			if( is_array($this->data['PedidoVenda']) ) {
				foreach($this->data['PedidoVenda'] as &$produto) {
					$produto = urlencode($produto);
				}
			}
			$params = array_merge($url,$this->data['PedidoVenda']);
			$this->redirect($params);
		}
		
		if (! empty($this->params['named'])) {
			//a instrucao acima redirecionou para cá
			$dados = $this->params['named'];
			$condicoes=array();
			if (! empty($dados['id'])) $condicoes[] = array('PedidoVenda.id'=>$dados['id']);
			if (! empty($dados['cliente_id'])) $condicoes[] = array('PedidoVenda.cliente_id'=>$dados['cliente_id']);
			if (! empty($dados['cliente_nome'])) $condicoes[] = array('Cliente.nome LIKE'=>'%'.$dados['cliente_nome'].'%');
			if (! empty($dados['situacao'])) $condicoes[] = array('PedidoVenda.situacao'=>$dados['situacao']);
			if (! empty($dados['valor_total'])) $condicoes[] = array('PedidoVenda.valor_liquido'=>$dados['valor_total']);
			if (! empty($dados['usuario_cadastrou'])) $condicoes[] = array('PedidoVenda.usuario_cadastrou'=>$dados['usuario_cadastrou']);
			if (! empty($dados['data_hora_cadastrado'])) {
				$ret = explode('-', $dados['data_hora_cadastrado']);
				$dados['data_hora_cadastrado'] = $ret[2].'-'.$ret[1].'-'.$ret[0];
				// pesquiso todos os registros cadastrados entre o intervalo do dia informado pelo usuario
				$condicoes[] = array('PedidoVenda.data_hora_cadastrada BETWEEN ? AND ?'=>array($dados['data_hora_cadastrada'].' 00:00:00',$dados['data_hora_cadastrada'].' 23:59:59'));
			}
			if (! empty ($condicoes)) {
				$resultados = $this->paginate('PedidoVenda',$condicoes);
				if (! empty($resultados)) {
					$num_encontrados = count($resultados);
					$this->set('resultados',$resultados);
					$this->set('num_resultados',$num_encontrados);
					$this->Session->setFlash("$num_encontrados pedido(s) de venda encontrados",'flash_sucesso');
				}
				else $this->Session->setFlash("Nenhum pedido de venda encontrado",'flash_erro');
			}
			else {
				$this->set('num_resultados','0');
				$this->Session->setFlash("Informe algum campo para realizar a pesquisa",'flash_erro');
			}
		}
	}

	function cupomNaoFiscal ($id = null) {
		$this->layout = 'limpo';
		$this->set("title_for_layout","Cupom não fiscal (venda $id)");
		
		$this->PedidoVenda->id = $id;
		$venda = $this->PedidoVenda->read();
		$i=0;
		foreach ($venda['PedidoVendaItem'] as $item) {
			$this->PedidoVenda->PedidoVendaItem->Produto->id = $item['produto_id'];
			$produto_nome = $this->PedidoVenda->PedidoVendaItem->Produto->field('nome');
			$venda['PedidoVendaItem'][$i] = array_merge( $venda['PedidoVendaItem'][$i], array('produto_nome'=>$produto_nome));
			$i++;
		}
		$this->set('venda',$venda);
	}
	
}

?>