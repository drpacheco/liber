<?php

class PlanoContasController extends AppController {
	var $name = 'PlanoContas';
	var $components = array('Sanitizacao');

	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->paginate = array (
			'limit' => 30,
			'order' => array (
				'PlanoConta.nome' => 'asc'
			),
		    'contain' => array()
		    
		);
		$dados = $this->paginate('PlanoConta');
		$this->set('consulta_plano_contas',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->request->data)) {
			
			if ($this->PlanoConta->save($this->request->data)) {
				$this->Session->setFlash('Item do plano de contas cadastrado com sucesso.','flash_sucesso');
				$this->redirect($this->referer(array('action' => 'index')));
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar item do plano de contas.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (empty ($this->request->data)) {
			$this->PlanoConta->recursive = -1;
			$this->request->data = $this->PlanoConta->read();
			if ( ! $this->request->data) {
				$this->Session->setFlash('Item do plano de contas não encontrado.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->request->data['PlanoConta']['id'] = $id;
			
			if ($this->PlanoConta->save($this->request->data)) {
				$this->Session->setFlash('Plano de contas atualizado com sucesso.','flash_sucesso');
				$this->redirect(array('action'=>'index'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar o plano de contas.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($this->PlanoConta->delete($id)) $this->Session->setFlash("Item $id do plano de contas excluído com sucesso.",'flash_sucesso');
			else $this->Session->setFlash("Item $id do plano de contas não pode ser excluída.",'flash_erro');
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash('Item do plano de contas não informado.','flash_erro');
		}
	}
	
}

?>