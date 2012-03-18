<?php

class ClienteCategoriasController extends AppController {
	var $name = 'ClienteCategorias';
	var $components = array('Sanitizacao','RequestHandler');
	var $helpers = array('Javascript','Ajax');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'ClienteCategoria.id' => 'desc'
		)
	);
	
	/**
	* @var $ClienteCategoria
	*/
	var $ClienteCategoria;

	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->ClienteCategoria->recursive = 0;
		$this->set('consulta',$this->paginate());
	
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->data)) {
			
			if ($this->ClienteCategoria->save($this->data)) {
				$this->Session->setFlash('Categoria de cliente cadastrada com sucesso.','flash_sucesso');
				if ( ! $this->RequestHandler->isAjax() ) {
					$this->redirect(array('action'=>'index'));
				}
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar a categoria de cliente.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (empty ($this->data)) {
			$this->ClienteCategoria->id = $id;
			$this->ClienteCategoria->recursive = -1;
			$this->data = $this->ClienteCategoria->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Categoria de cliente não encontrada.','flash_erro');
				if ( ! $this->RequestHandler->isAjax() ) {
					$this->redirect(array('action'=>'index'));
				}
			}
		}
		else {
			$this->data['ClienteCategoria']['id'] = $id;
			
			if ($this->ClienteCategoria->save($this->data)) {
				$this->Session->setFlash('Categoria de cliente atualizada com sucesso.','flash_sucesso');
				if ( ! $this->RequestHandler->isAjax() ) {
					$this->redirect(array('action'=>'index'));
				}
			}
			else {
				$this->Session->setFlash('Erro ao atualizar a categoria de cliente.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($this->ClienteCategoria->delete($id)) $this->Session->setFlash("Categoria de cliente $id excluída com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Categoria de cliente $id não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Categoria de cliente não informada.','flash_erro');
		}
	}
	
}

?>