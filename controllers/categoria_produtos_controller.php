<?php

class CategoriaProdutosController extends AppController {
	var $name = 'CategoriaProdutos';
	var $components = array('Sanitizacao','RequestHandler');
	var $helpers = array('Javascript','Ajax');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'CategoriaProduto.id' => 'desc'
		)
	);
	
	/**
	* @var $CategoriaProduto
	*/
	var $CategoriaProduto;

	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$dados = $this->paginate('CategoriaProduto');
		$this->set('consulta',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->data)) {
			
			if ($this->CategoriaProduto->save($this->data)) {
				$this->Session->setFlash('Categoria de produto cadastrada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar a categoria de produto.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (empty ($this->data)) {
			$this->data = $this->CategoriaProduto->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Categoria de produto não encontrada.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->data['CategoriaProduto']['id'] = $id;
			
			if ($this->CategoriaProduto->save($this->data)) {
				$this->Session->setFlash('Categoria de produto atualizada com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar a categoria de produto.');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($this->CategoriaProduto->delete($id)) $this->Session->setFlash("Categoria de produto $id excluída com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Categoria de produto $id não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Categoria de produto não informada.','flash_erro');
		}
	}
	
}

?>