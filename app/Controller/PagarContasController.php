<?php

class PagarContasController extends AppController {
	var $name = 'PagarContas';
	var $components = array('Geral');
	var $helpers = array('CakePtbr.Formatacao','Javascript','Jqplot');
	
	/**
	 * Obtem dados necessarios ao decorrer deste controller.
	 * Os dados sao setados em variaveis a serem utilizadas nas views 
	 */
	function _obter_opcoes() {
		
		$this->PagarConta->TipoDocumento->recursive = -1;
		$consulta1 = $this->PagarConta->TipoDocumento->find('list',array('fields'=>array('TipoDocumento.id','TipoDocumento.nome')));
		$this->set('opcoes_tipo_documento',array_merge(array(0=>''),$consulta1));
		
		$this->PagarConta->Conta->recursive = -1;
		$consulta2 = $this->PagarConta->Conta->find('list',array('fields'=>array('Conta.id','Conta.apelido')));
		$this->set('opcoes_conta_origem',array_merge(array(0=>''),$consulta2));
		
		$this->PagarConta->PlanoConta->recursive = -1;
		$consulta3 = $this->PagarConta->PlanoConta->find('list',array('fields'=>array('PlanoConta.id','PlanoConta.nome')));
		$this->set('opcoes_plano_contas',array_merge(array(0=>''),$consulta3));
		
		$this->PagarConta->Empresa->recursive = -1;
		$consulta4 = $this->PagarConta->Empresa->findEmpresa();
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
			$this->layout = 'ajax';
		}
		$this->paginate = array (
		    'limit' => 10,
			'order' => array (
				'PagarConta.id' => 'desc'
			),
		    'contain' => array('TipoDocumento.nome','Conta.nome','PlanoConta.nome','Empresa.nome','Cliente.nome','Fornecedor.nome'),
		);
		$dados = $this->paginate('PagarConta');
		$this->set('consulta_conta_pagar',$dados);
		$this->_obter_opcoes();
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		$this->_obter_opcoes();
		if (! empty($this->request->data)) {
			if (strtoupper($this->request->data['PagarConta']['eh_cliente_ou_fornecedor']) == 'C') {
				$this->PagarConta->Cliente->recursive = -1;
				$r = $this->PagarConta->Cliente->find('first',
					array('conditions'=>array(
						'Cliente.id' => $this->request->data['PagarConta']['cliente_fornecedor_id'],
						'Cliente.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			else if (strtoupper($this->request->data['PagarConta']['eh_cliente_ou_fornecedor']) == 'F') {
				$this->PagarConta->Fornecedor->recursive = -1;
				$r = $this->PagarConta->Fornecedor->find('first',
					array('conditions'=>array(
						'Fornecedor.id' => $this->request->data['PagarConta']['cliente_fornecedor_id'],
						'Fornecedor.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			if ((! isset($cliente_fornecedor_encontrado)) || (! $cliente_fornecedor_encontrado)) {
				$this->Session->setFlash('Erro. Cliente/fornecedor não encontrado','flash_erro');
			}
			
			else {
				$this->request->data['PagarConta'] += array ('data_hora_cadastrada' => date('Y-m-d H:i:s'));
				
				if ($this->PagarConta->save($this->request->data)) {
					$this->Session->setFlash('Conta a pagar cadastrada com sucesso.','flash_sucesso');
					$this->redirect($this->referer(array('action' => 'index')));
				}
				else {
					$this->Session->setFlash('Erro ao cadastrar a conta a pagar.','flash_erro');
				}
			}
		}
	}
	
	function editar($id=null) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		$this->_obter_opcoes();
		if (empty ($this->request->data)) {
			$this->PagarConta->contain('TipoDocumento.nome','Conta.nome','PlanoConta.nome','Empresa.nome','Cliente.nome','Fornecedor.nome');
			$this->PagarConta->id = $id;
			$this->request->data = $this->PagarConta->read();
			if ( ! $this->request->data) {
				$this->Session->setFlash('Conta a receber não encontrada.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->request->data['PagarConta']['data_vencimento'] = date('d/m/Y', strtotime($this->request->data['PagarConta']['data_vencimento']));
			}
		}
		else {
			$this->request->data['PagarConta']['id'] = $id;
			if (strtoupper($this->request->data['PagarConta']['eh_cliente_ou_fornecedor']) == 'C') {
				$this->PagarConta->Cliente->recursive = -1;
				$r = $this->PagarConta->Cliente->find('first',
					array('conditions'=>array(
						'Cliente.id' => $this->request->data['PagarConta']['cliente_fornecedor_id'],
						'Cliente.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			else if (strtoupper($this->request->data['PagarConta']['eh_cliente_ou_fornecedor']) == 'F') {
				$this->PagarConta->Fornecedor->recursive = -1;
				$r = $this->PagarConta->Fornecedor->find('first',
					array('conditions'=>array(
						'Fornecedor.id' => $this->request->data['PagarConta']['cliente_fornecedor_id'],
						'Fornecedor.situacao' => 'A')));
				if (! empty($r)) $cliente_fornecedor_encontrado = true;
			}
			if ((! isset($cliente_fornecedor_encontrado)) || (! $cliente_fornecedor_encontrado)) {
				$this->Session->setFlash('Erro. Cliente/fornecedor não encontrado','flash_erro');
			}
			
			else {
				if ($this->PagarConta->save($this->request->data)) {
					$this->Session->setFlash('Conta a pagar atualizada com sucesso.','flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else {
					$this->Session->setFlash('Erro ao atualizar a conta a pagar.','flash_erro');
				}
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		if (! empty($id)) {
			if ($this->PagarConta->delete($id)) $this->Session->setFlash("Conta a pagar $id excluída com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Conta a pagar $id não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Conta a pagar não informada.','flash_erro');
		}
	}

	function pesquisar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		//#FIXME pesquisa por valor nao funciona se informar valor em notação brasileira ou valor contiver .
		$this->_obter_opcoes();
		if (! empty($this->request->data)) {
			//usuario enviou os dados da pesquisa
			$url = array('controller'=>'pagarContas','action'=>'pesquisar');
			// as / das datas sao trocas por - para nao interferir no padrao de url do CAKE
			if ( ! empty($this->request->data['PagarConta']['data_inicio']) ) $this->request->data['PagarConta']['data_inicio'] = preg_replace ('/\//', '-', $this->request->data['PagarConta']['data_inicio']);
			if ( ! empty($this->request->data['PagarConta']['data_fim']) ) $this->request->data['PagarConta']['data_fim'] = preg_replace ('/\//', '-', $this->request->data['PagarConta']['data_fim']);
			$params = array_merge($url,$this->request->data['PagarConta']);
			$this->redirect($params);
		}
		
		if (! empty($this->request->params['named'])) {
			//a instrucao acima redirecionou para cá
			$dados = $this->request->params['named'];
			$condicoes=array();
			if (! empty($dados['numero_documento'])) $condicoes[] = array('PagarConta.numero_documento'=>$dados['numero_documento']);
			if (! empty($dados['valor'])) $condicoes[] = array('PagarConta.valor'=>$dados['valor']);
			if (! empty($dados['eh_cliente_ou_fornecedor'])) $condicoes[] = array('PagarConta.eh_cliente_ou_fornecedor'=>$dados['eh_cliente_ou_fornecedor']);
			if (! empty($dados['cliente_fornecedor_id'])) $condicoes[] = array('PagarConta.cliente_fornecedor_id'=>$dados['cliente_fornecedor_id']);
			if (! empty($dados['id'])) $condicoes[] = array('PagarConta.id'=>$dados['id']);
			if (! empty($dados['tipo_documento'])) $condicoes[] = array('PagarConta.tipo_documento'=>$dados['tipo_documento']);
			if (! empty($dados['conta_origem'])) $condicoes[] = array('PagarConta.conta_origem'=>$dados['conta_origem']);
			if (! empty($dados['plano_conta_id'])) $condicoes[] = array('PagarConta.id'=>$dados['plano_conta_id']);
			if (! empty($dados['situacao'])) $condicoes[] = array('PagarConta.situacao'=>$dados['situacao']);
			if (! empty($dados['data_inicio'])) {
				$data = explode('-',$dados['data_inicio']);
				$data = "${data[2]}-${data[1]}-${data[0]}";
				$condicoes[] = array('PagarConta.data_hora_cadastrada <='=> $data);
			}
			if (! empty($dados['data_fim'])) {
				$data = explode('-',$dados['data_fim']);
				$data = "${data[2]}-${data[1]}-${data[0]}";
				$condicoes[] = array('PagarConta.data_hora_cadastrada >='=> $data);
			}
			if (! empty ($condicoes)) {
				$this->paginate = array (
				'limit' => 10,
					'order' => array (
						'PagarConta.id' => 'desc'
					),
				'contain' => array('TipoDocumento.nome','Conta.nome','PlanoConta.nome','Cliente.nome','Fornecedor.nome'),
				);
				$resultados = $this->paginate('PagarConta',$condicoes);
				if (! empty($resultados)) {
					$num_encontrados = count($resultados);
					$this->set('resultados',$resultados);
					$this->set('num_resultados',$num_encontrados);
					$this->Session->setFlash("$num_encontrados conta(s) a pagar encontrada(s)",'flash_sucesso');
				}
				else $this->Session->setFlash("Nenhuma conta a pagar encontrada",'flash_erro'); 
			}
			else {
				$this->set('num_resultados','0');
				$this->Session->setFlash("Nenhum resultado encontrado",'flash_erro');
			}
		}
	}

	function resumo() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		//grafico de percentual do uso dos itens do plano de contas
		$consulta = $this->PagarConta->query("SELECT pagar_conta.plano_conta_id,COUNT(*) AS numero_ocorrencias, plano_conta.nome
		FROM pagar_contas AS pagar_conta, plano_contas AS plano_conta
		WHERE pagar_conta.plano_conta_id = plano_conta.id
		GROUP BY pagar_conta.plano_conta_id
		ORDER BY numero_ocorrencias DESC;");
		$retorno = array();
		foreach ($consulta as $r) {
			$retorno[] = array($r['plano_conta']['nome'],$r[0]['numero_ocorrencias']) ; 
		}
		$retorno = json_encode($retorno,JSON_NUMERIC_CHECK);
		$this->set('data1',$retorno);
		
		//grafico de itens do plano de contas ordenados por valor
		$consulta = $this->PagarConta->query("SELECT pagar_conta.plano_conta_id,sum(valor) AS valores, plano_conta.nome
		FROM pagar_contas AS pagar_conta, plano_contas AS plano_conta
		WHERE pagar_conta.plano_conta_id = plano_conta.id
		GROUP BY pagar_conta.plano_conta_id
		ORDER BY valores DESC;");
		$retorno = array();
		foreach ($consulta as $r) {
			$retorno[] = array($r['plano_conta']['nome'],$r[0]['valores']) ; 
		}
		$retorno = json_encode($retorno,JSON_NUMERIC_CHECK);
		$this->set('data2',$retorno);
		
		// grafico de clientes com mais contas a receber
		$consulta = $this->PagarConta->query("SELECT pagar_contas.cliente_fornecedor_id, count(pagar_contas.cliente_fornecedor_id) AS contador, pagar_contas.eh_cliente_ou_fornecedor,
		case pagar_contas.eh_cliente_ou_fornecedor
			when 'C' then clientes.nome
			when 'F' then fornecedores.nome
		end AS nome
		FROM pagar_contas, clientes,fornecedores
		WHERE pagar_contas.cliente_fornecedor_id = clientes.id
		GROUP BY pagar_contas.eh_cliente_ou_fornecedor
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