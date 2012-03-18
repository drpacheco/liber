<?php

class FormaPagamentosController extends AppController {
	var $name = 'FormaPagamentos';
	var $components = array('RequestHandler');
	var $helpers = array('Javascript');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'FormaPagamento.id' => 'asc'
		)
	);
	
	/**
	* @var $FormaPagamento
	*/
	var $FormaPagamento;
	
	/**
	 * Obtem dados necessarios ao decorrer deste controller.
	 * Os dados sao setados em variaveis a serem utilizadas nas views 
	 */
	function _obter_opcoes() {
		$this->FormaPagamento->Conta->recursive = -1;
		$opcoes_contas = $this->FormaPagamento->Conta->find('list',array('fields'=>array('Conta.id','Conta.nome')));
		$this->set('opcoes_contas',$opcoes_contas);
		
		$this->FormaPagamento->TipoDocumento->recursive = -1;
		$r = $this->FormaPagamento->TipoDocumento->find('list',array('fields'=>array('TipoDocumento.id','TipoDocumento.nome')));
		$this->set('opcoes_documentos',$r);
	}
	
	/**
	* caso algum produto seja enviado (erro na validacao, editando registro, etc),
	* o insiro na pagina
	*/
	function _recupera_itens_inseridos() {
		if (isset($this->data['FormaPagamentoItem'])) {
			$itens = $this->data['FormaPagamentoItem'];
			$i = 0;
			$valor_total = 0;
			$campos_ja_inseridos = array();
			foreach ($itens as $item) {
				$campos_ja_inseridos[$i] = array('dias_intervalo_parcela'=>$item['dias_intervalo_parcela']);
				$i++;
			}
			$this->set('campos_ja_inseridos',$campos_ja_inseridos);
			return 1;
		}
		
		return 0;
	}
	
	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$dados = $this->paginate('FormaPagamento');
		$this->set('consulta_forma_pagamento',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		
		$this->_obter_opcoes();
		
		if (! empty($this->data)) {
			
			if ($this->FormaPagamento->saveAll($this->data,array('validate'=>'first'))) {
				$this->Session->setFlash('Forma de pagamento cadastrada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar a forma de pagamento.','flash_erro');
				$this->_recupera_itens_inseridos();
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->_obter_opcoes();
		
		if (empty ($this->data)) {
			$this->FormaPagamento->id = $id;
			$this->FormaPagamento->recursive = -1;
			$this->data = $this->FormaPagamento->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Forma de pagamento não encontrada.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->_recupera_itens_inseridos();
			}
		}
		else {
			$this->_recupera_itens_inseridos();
			$this->data['FormaPagamento']['id'] = $id;
			
			// #TODO seria bom nao deletar e reinserir todos os registros
			// deleto os itens que pertenciam a forma de pagamento
			if( ! ($this->FormaPagamento->FormaPagamentoItem->deleteAll(array('forma_pagamento_id'=>$id),false))) {
				$this->Session->setFlash('Erro ao atualizar a forma de pagamento','flash_erro');
				return null;
			}
			
			if ($this->FormaPagamento->saveAll($this->data,array('validate'=>'first'))) {
				$this->Session->setFlash('Forma de pagamento atualizada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar a forma de pagamento.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		#FIXME nao estah deletando
		if (! empty($id)) {
			if ($this->FormaPagamento->deleteAll(array('FormaPagamentoItem.forma_pagamento_id'=>$id))) {
				$this->Session->setFlash("Forma de pagamento $id excluída com sucesso.",'flash_sucesso');
			}
			else $this->Session->setFlash("Forma de pagamento $id não pode ser excluída.",'flash_erro');
			//$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Forma de pagamento não informada.','flash_erro');
		}
	}
	
}

?>