<?php

class ContasController extends AppController {
	var $name = 'Contas';
	var $components = array('Sanitizacao','RequestHandler');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'Conta.id' => 'asc'
		)
	);
	
	/**
	* @var $Conta
	*/
	var $Conta;

	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$dados = $this->paginate('Conta');
		$this->set('consulta_conta',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->data)) {
			
			if ($this->Conta->save($this->data)) {
				$this->Session->setFlash('Conta cadastrada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar a conta.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (empty ($this->data)) {
			$this->Conta->recursive = -1;
			$this->data = $this->Conta->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Conta não encontrada.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->data['Conta']['id'] = $id;
			
			if ($this->Conta->save($this->data)) {
				$this->Session->setFlash('Conta atualizada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar a conta.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($this->Conta->delete($id)) $this->Session->setFlash("Conta $id excluída com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Conta $id não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Conta não informada.','flash_erro');
		}
	}
	
}

?>