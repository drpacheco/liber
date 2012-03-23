<?php

class UsuariosController extends AppController {
	var $name = 'Usuarios';
	var $components = array('Auth','Sanitizacao','RequestHandler');
	var $helpers = array('Javascript','Ajax');
	var $paginate = array (
		'limit' => 10,
		'contain' => array(),
		'order' => array (
			'Usuario.id' => 'asc'
		),
	    'contain' => array()
	);
	
	public function beforeFilter() {
			parent::beforeFilter();
		}
	
	public function login() {	
		$this->layout = 'login';
		if ($this->request->is('post')) {
			if ($this->Auth->login($this->request->data)) {
				$dados = $this->Usuario->find('first',array('conditions'=>array(
					'login'=>$this->request->data['Usuario']['login'],
				),'recursive' => '-1' ) );
				$this->Auth->user = $dados['Usuario'];
				$this->Usuario->id = $this->Auth->user('id');
				$h = array('ultimo_login'=>date('Y-m-d H:i:s'));
				$this->Usuario->save($h);
				$this->Session->write('Usuario.tipo',$this->Auth->user('tipo'));
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
			}
		}
	}
	
	function logout() {
		$this->layout = 'login';
		if ($this->Auth->user()) {
			/*$this->Usuario->id = $this->Auth->user('id');
			$h = array('ultimo_logout'=>date('Y-m-d H:i:s'));
			$this->Usuario->save($h);*/
			$this->redirect($this->Auth->logout());
		}
		// Redireciona o usuário para o action do logoutRedirect
		 $this->redirect($this->Auth->logout());
	}
	
	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->set('consulta_usuario',$this->paginate('Usuario'));
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->request->data)) {
			if ($this->request->data['Usuario']['senha'] == $this->Auth->password($this->request->data['Usuario']['senha_confirma'])) {
				$this->Usuario->create();
				if ($this->Usuario->save($this->request->data)) {
					$this->Session->setFlash('Usuário cadastrado com sucesso.','flash_sucesso');
					$this->redirect($this->referer(array('action' => 'index')));
				}
				else {
					$this->request->data['Usuario']['senha'] = NULL;
					$this->request->data['Usuario']['senha_confirma'] = NULL;
					$this->Session->setFlash('Erro ao cadastrar o usuário.','flash_erro');
				}
			}
			else {
				$this->request->data['Usuario']['senha'] = NULL;
				$this->request->data['Usuario']['senha_confirma'] = NULL;
				$this->Session->setFlash('As senhas digitadas não conferem.','flash_erro');
			}
		}
	}
	
	function editar($id = null) {
		$this->Usuario->id = $id;
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		//popular o formulario, na primeira carga
		if (empty ($this->request->data)) {
			$this->Usuario->recursive = -1;
			$this->request->data = $this->Usuario->read();
			// formulario carrega sem as senhas
			unset($this->request->data['Usuario']['senha']);
			unset($this->request->data['Usuario']['senha_confirma']);
			if ( ! $this->request->data) {
				$this->Session->setFlash('Usuário não encontrado.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		//formulario ja estava populado
		else {
			if ($this->request->data['Usuario']['senha'] == $this->Auth->password($this->request->data['Usuario']['senha_confirma'])) {
				/**
				 * caso a senha não seja informada, pego a antiga
				 * nota: o campo senha sempre terá valor, pois é feito hash do que havia nele
				 * por isso vejo se a segunda senha informada está em branco
				 */
				if (empty($this->request->data['Usuario']['senha_confirma'])) {
					$this->Usuario->recursive = -1;
					$old = $this->Usuario->read();
					$this->request->data['Usuario']['senha'] = $old['Usuario']['senha'];
					$this->request->data['Usuario']['senha_confirma'] = $old['Usuario']['senha'];
				}
				if ($this->Usuario->save($this->request->data)) {
					$this->Session->setFlash('Usuário alterado com sucesso.','flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else {
					$this->request->data['Usuario']['senha'] = NULL;
					$this->request->data['Usuario']['senha_confirma'] = NULL;
					$this->Session->setFlash('Erro ao atualizar o usuário.','flash_erro');
				}
			}
			else {
				$this->request->data['Usuario']['senha'] = NULL;
				$this->request->data['Usuario']['senha_confirma'] = NULL;
				$this->Session->setFlash('As senhas digitadas não conferem.','flash_erro');
			}
		}
	}
	
	function excluir($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($id)) {
			if ($id == 1) {
				$this->Session->setFlash("O usuário administrador não pode ser excluído.",'flash_erro');
				$this->redirect(array('action'=>'index'));
			}
			else {
				if ($this->Usuario->delete($id)) $this->Session->setFlash("Usuário $id excluído com sucesso.",'flash_sucesso');
				else $this->Session->setFlash("Usuário $id não pode ser excluído.",'flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->Session->setFlash('Usuário não informado.','flash_erro');
		}
	}
	
	
}

?>