<?php

class TipoDocumentosController extends AppController {
	var $name = 'TipoDocumentos';
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'TipoDocumento.nome' => 'asc'
		),
	    'contain' => array()
	);

	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		$dados = $this->paginate('TipoDocumento');
		$this->set('consulta_tipo_documento',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		if (! empty($this->request->data)) {
			
			if ($this->TipoDocumento->save($this->request->data)) {
				$this->Session->setFlash('Tipo de documento cadastrado com sucesso.','flash_sucesso');
				$this->redirect($this->referer(array('action' => 'index')));
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar tipo de documento.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		if (empty ($this->request->data)) {
			$this->TipoDocumento->recursive = -1;
			$this->TipoDocumento->id = $id;
			$this->request->data = $this->TipoDocumento->read();
			if ( ! $this->request->data) {
				$this->Session->setFlash('Tipo de documento não encontrado.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->request->data['TipoDocumento']['id'] = $id;
			
			if ($this->TipoDocumento->save($this->request->data)) {
				$this->Session->setFlash('Tipo de documento atualizado com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar o Tipo de documento.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'ajax';
		}
		if (! empty($id)) {
			if ($this->TipoDocumento->delete($id)) $this->Session->setFlash("Tipo de documento $id excluído com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Tipo de documento $id não pode ser excluído.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Tipo de documento não informado.','flash_erro');
		}
	}
	
}

?>