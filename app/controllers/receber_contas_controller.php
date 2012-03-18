<?php

class ReceberContasController extends AppController {
	var $name = 'ReceberContas';
	var $components = array('Sanitizacao');
	var $helpers = array('CakePtbr.Formatacao','Javascript','Jqplot');

	/**
	* @var $ReceberConta
	*/
	var $ReceberConta;
	
	/**
	 * Obtem dados necessarios ao decorrer deste controller.
	 * Os dados sao setados em variaveis a serem utilizadas nas views 
	 */
	function _obter_opcoes() {
		$this->ReceberConta->TipoDocumento->recursive = -1;
		$consulta1 = $this->ReceberConta->TipoDocumento->find('list',array('fields'=>array('TipoDocumento.id','TipoDocumento.nome')));
		$this->set('opcoes_tipo_documento',array_merge(array(0=>''),$consulta1));
		
		$this->ReceberConta->Conta->recursive = -1;
		$consulta2 = $this->ReceberConta->Conta->find('list',array('fields'=>array('Conta.id','Conta.apelido')));
		$this->set('opcoes_conta_origem',array_merge(array(0=>''),$consulta2));
		
		$this->ReceberConta->PlanoConta->recursive = -1;
		$consulta3 = $this->ReceberConta->PlanoConta->find('list',array('fields'=>array('PlanoConta.id','PlanoConta.nome')));
		$this->set('opcoes_plano_contas',array_merge(array(0=>''),$consulta3));
		
		$this->ReceberConta->Empresa->recursive = -1;
		$consulta4 = $this->ReceberConta->Empresa->find('list',array('fields'=>array('Empresa.id','Empresa.nome')));
		$this->set('opcoes_empresas',$consulta4);
		
		$opcoes_situacoes = array (
			'N' => 'Não paga',
			'P' => 'Paga',
		);
		$this->set('opcoes_situacoes',$opcoes_situacoes);
		
		return null;
	}
	
	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->paginate['ReceberConta'] = array (
		    'limit' => 10,
			'order' => array (
				'ReceberConta.id' => 'desc'
			),
		    'contain' => array('TipoDocumento.nome','Conta.nome','PlanoConta.nome','Empresa.nome','Cliente.nome','Fornecedor.nome'),
		);
		$dados = $this->paginate('ReceberConta');
		$this->set('consulta_conta_receber',$dados);
		$this->_obter_opcoes();
		
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->_obter_opcoes();
		if (! empty($this->data)) {
			if (strtoupper($this->data['ReceberConta']['eh_cliente_ou_fornecedor']) == 'C') {
				$this->ReceberConta->Cliente->recursive = -1;
				$r = $this->ReceberConta->Cliente->find('first',
					array('conditions'=>array(
						'Cliente.id' => $this->data['ReceberConta']['cliente_fornecedor_id'],
						'Cliente.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			else if (strtoupper($this->data['ReceberConta']['eh_cliente_ou_fornecedor']) == 'F') {
				$this->ReceberConta->Fornecedor->recursive = -1;
				$r = $this->ReceberConta->Fornecedor->find('first',
					array('conditions'=>array(
						'Fornecedor.id' => $this->data['ReceberConta']['cliente_fornecedor_id'],
						'Fornecedor.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			if ((! isset($cliente_fornecedor_encontrado)) || (! $cliente_fornecedor_encontrado)) {
				$this->Session->setFlash('Erro. Cliente/fornecedor não encontrado','flash_erro');
			}
			
			else {
				$this->data['ReceberConta'] += array ('data_hora_cadastrada' => date('Y-m-d H:i:s'));
				
				if ($this->ReceberConta->save($this->data)) {
					$this->Session->setFlash('Conta a receber cadastrada com sucesso.','flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else {
					$this->Session->setFlash('Erro ao cadastrar a conta a receber.','flash_erro');
				}
			}
		}
	}
	
	function editar($id=null) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->_obter_opcoes();
		if (empty ($this->data)) {
			$this->ReceberConta->contain('TipoDocumento.nome','Conta.nome','PlanoConta.nome','Empresa.nome','Cliente.nome','Fornecedor.nome');
			$this->data = $this->ReceberConta->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Conta a receber não encontrada.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->data['ReceberConta']['data_vencimento'] = date('d/m/Y', strtotime($this->data['ReceberConta']['data_vencimento']));
			}
		}
		else {
			$this->data['ReceberConta']['id'] = $id;
			if (strtoupper($this->data['ReceberConta']['eh_cliente_ou_fornecedor']) == 'C') {
				$this->ReceberConta->Cliente->recursive = -1;
				$r = $this->ReceberConta->Cliente->find('first',
					array('conditions'=>array(
						'Cliente.id' => $this->data['ReceberConta']['cliente_fornecedor_id'],
						'Cliente.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			else if (strtoupper($this->data['ReceberConta']['eh_cliente_ou_fornecedor']) == 'F') {
				$this->ReceberConta->Fornecedor->recursive = -1;
				$r = $this->ReceberConta->Fornecedor->find('first',
					array('conditions'=>array(
						'Fornecedor.id' => $this->data['ReceberConta']['cliente_fornecedor_id'],
						'Fornecedor.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			if ((! isset($cliente_fornecedor_encontrado)) || (! $cliente_fornecedor_encontrado)) {
				$this->Session->setFlash('Erro. Cliente/fornecedor não encontrado','flash_erro');
			}
			
			else {
				if ($this->ReceberConta->save($this->data)) {
					$this->Session->setFlash('Conta a receber atualizada com sucesso.','flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else {
					$this->Session->setFlash('Erro ao atualizar a conta a receber.','flash_erro');
				}
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($this->ReceberConta->delete($id)) $this->Session->setFlash("Conta a receber $id excluída com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Conta a receber $id não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Conta a receber não informada.','flash_erro');
		}
	}

	function pesquisar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		//#FIXME pesquisa por valor nao funciona se informar valor em notação brasileira ou valor contiver .
		$this->_obter_opcoes();
		if (! empty($this->data)) {
			//usuario enviou os dados da pesquisa
			$url = array('controller'=>'receberContas','action'=>'pesquisar');
			// as / das datas sao trocas por - para nao interferir no padrao de url do CAKE
			if ( ! empty($this->data['ReceberConta']['data_inicio']) ) $this->data['ReceberConta']['data_inicio'] = preg_replace ('/\//', '-', $this->data['ReceberConta']['data_inicio']);
			if ( ! empty($this->data['ReceberConta']['data_fim']) ) $this->data['ReceberConta']['data_fim'] = preg_replace ('/\//', '-', $this->data['ReceberConta']['data_fim']);
			$params = array_merge($url,$this->data['ReceberConta']);
			$this->redirect($params);
		}
		
		if (! empty($this->params['named'])) {
			//a instrucao acima redirecionou para cá
			$dados = $this->params['named'];
			$condicoes=array();
			if (! empty($dados['numero_documento'])) $condicoes[] = array('ReceberConta.numero_documento'=>$dados['numero_documento']);
			if (! empty($dados['valor'])) $condicoes[] = array('ReceberConta.valor'=>$dados['valor']);
			if (! empty($dados['eh_cliente_ou_fornecedor'])) $condicoes[] = array('ReceberConta.eh_cliente_ou_fornecedor'=>$dados['eh_cliente_ou_fornecedor']);
			if (! empty($dados['cliente_fornecedor_id'])) $condicoes[] = array('ReceberConta.cliente_fornecedor_id'=>$dados['cliente_fornecedor_id']);
			if (! empty($dados['id'])) $condicoes[] = array('ReceberConta.id'=>$dados['id']);
			if (! empty($dados['tipo_documento'])) $condicoes[] = array('ReceberConta.tipo_documento'=>$dados['tipo_documento']);
			if (! empty($dados['conta_origem'])) $condicoes[] = array('ReceberConta.conta_origem'=>$dados['conta_origem']);
			if (! empty($dados['plano_conta_id'])) $condicoes[] = array('ReceberConta.id'=>$dados['plano_conta_id']);
			if (! empty($dados['situacao'])) $condicoes[] = array('ReceberConta.situacao'=>$dados['situacao']);
			if (! empty($dados['data_inicio'])) {
				$data = explode('-',$dados['data_inicio']);
				$data = "${data[2]}-${data[1]}-${data[0]}";
				$condicoes[] = array('ReceberConta.data_hora_cadastrada <='=> $data);
			}
			if (! empty($dados['data_fim'])) {
				$data = explode('-',$dados['data_fim']);
				$data = "${data[2]}-${data[1]}-${data[0]}";
				$condicoes[] = array('ReceberConta.data_hora_cadastrada >='=> $data);
			}
			if (! empty ($condicoes)) {
				$this->paginate['ReceberConta'] = array (
				'limit' => 10,
					'order' => array (
						'ReceberConta.id' => 'desc'
					),
				'contain' => array('TipoDocumento.nome','Conta.nome','PlanoConta.nome','Cliente.nome','Fornecedor.nome'),
				);
				$resultados = $this->paginate('ReceberConta',$condicoes);
				if (! empty($resultados)) {
					$num_encontrados = count($resultados);
					$this->set('resultados',$resultados);
					$this->set('num_resultados',$num_encontrados);
					$this->Session->setFlash("$num_encontrados conta(s) a receber encontrada(s)",'flash_sucesso');
				}
				else $this->Session->setFlash("Nenhuma conta a receber encontrada",'flash_erro');
			}
			else {
				$this->set('num_resultados','0');
				$this->Session->setFlash("Nenhum resultado encontrado",'flash_erro');
			}
		}
	}

	function resumo() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		//grafico de percentual do uso dos itens do plano de contas
		$consulta = $this->ReceberConta->query("SELECT receber_conta.plano_conta_id,COUNT(*) AS numero_ocorrencias, plano_conta.nome
		FROM receber_contas AS receber_conta, plano_contas AS plano_conta
		WHERE receber_conta.plano_conta_id = plano_conta.id
		GROUP BY receber_conta.plano_conta_id
		ORDER BY numero_ocorrencias DESC;");
		$retorno = array();
		foreach ($consulta as $r) {
			$retorno[] = array($r['plano_conta']['nome'],$r[0]['numero_ocorrencias']) ; 
		}
		$retorno = json_encode($retorno,JSON_NUMERIC_CHECK);
		$this->set('data1',$retorno);
		
		//grafico de itens do plano de contas ordenados por valor
		$consulta = $this->ReceberConta->query("SELECT receber_conta.plano_conta_id,sum(valor) AS valores, plano_conta.nome
		FROM receber_contas AS receber_conta, plano_contas AS plano_conta
		WHERE receber_conta.plano_conta_id = plano_conta.id
		GROUP BY receber_conta.plano_conta_id
		ORDER BY valores DESC;");
		$retorno = array();
		foreach ($consulta as $r) {
			$retorno[] = array($r['plano_conta']['nome'],$r[0]['valores']) ; 
		}
		$retorno = json_encode($retorno,JSON_NUMERIC_CHECK);
		$this->set('data2',$retorno);
		
		// grafico de clientes com mais contas a receber
		$consulta = $this->ReceberConta->query("SELECT receber_contas.cliente_fornecedor_id, count(receber_contas.cliente_fornecedor_id) AS contador, receber_contas.eh_cliente_ou_fornecedor,
		case receber_contas.eh_cliente_ou_fornecedor
			when 'C' then clientes.nome
			when 'F' then fornecedores.nome
		end AS nome
		FROM receber_contas, clientes,fornecedores
		WHERE receber_contas.cliente_fornecedor_id = clientes.id
		GROUP BY receber_contas.eh_cliente_ou_fornecedor
		ORDER BY contador DESC");
		$retorno = array();
		foreach ($consulta as $r) {
			$retorno[] = array($r[0]['nome'],$r[0]['contador']) ; 
		}
		$retorno = json_encode($retorno,JSON_NUMERIC_CHECK);
		$this->set('data3',$retorno);
	}
	
}

?>