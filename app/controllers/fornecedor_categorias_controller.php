<?php

class FornecedorCategoriasController extends AppController {
	var $name = 'FornecedorCategorias';
	var $components = array('Sanitizacao','RequestHandler');
	var $helpers = array('Js' => array('Jquery'),'Ajax');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'FornecedorCategoria.id' => 'desc'
		)
	);
	
	/**
	* @var $FornecedorCategoria
	*/
	var $FornecedorCategoria;

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
			
			if ($this->FornecedorCategoria->save($this->data)) {
				$this->Session->setFlash('Categoria de fornecedor cadastrada com sucesso.','flash_sucesso');
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar a categoria de fornecedor.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (empty ($this->data)) {
			$this->data = $this->FornecedorCategoria->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Categoria de fornecedor não encontrada.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->data['FornecedorCategoria']['id'] = $id;
			
			if ($this->FornecedorCategoria->save($this->data)) {
				$this->Session->setFlash('Categoria de fornecedor atualizada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar a categoria de fornecedor.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($this->FornecedorCategoria->delete($id)) $this->Session->setFlash("Categoria de fornecedor $id excluída com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Categoria de fornecedor $id não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Categoria de fornecedor não informada.','flash_erro');
		}
	}
	
}

?>