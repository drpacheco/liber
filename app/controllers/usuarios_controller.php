<?php

class UsuariosController extends AppController {
	var $name = "Usuarios";
	var $components = array('Auth','Sanitizacao','RequestHandler');
	var $helpers = array('Javascript','Ajax');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'Usuario.id' => 'asc'
		)
	);
	
	/**
	* @var $Usuario
	*/
	var $Usuario;

	function login() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		else {
			$this->layout = 'login';
		}
		if ($this->Auth->user()) {
			$this->Usuario->id = $this->Auth->user('id');
			$h = array('ultimo_login'=>date('Y-m-d H:i:s'));
			$this->Usuario->save($h);
			$this->Session->write('Usuario.tipo',$this->Auth->user('tipo'));
			/* no app_controller desabilitei o redirecionamento automatico
			 * para que o metodo login fosse executado, redireciono aqui
			 */
			$this->redirect($this->Auth->redirect());
		}
	}
	
	function logout() {
		if ($this->Auth->user()) {
			$this->Usuario->id = $this->Auth->user('id');
			$h = array('ultimo_logout'=>date('Y-m-d H:i:s'));
			$this->Usuario->save($h);
			$this->Session->destroy();
		}
		$this->layout = 'login';
		// Redireciona o usuário para o action do logoutRedirect
		 $this->redirect($this->Auth->logout());
	}
	
	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$dados = $this->paginate('Usuario');
		$this->set('consulta_usuario',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->data)) {
			if ($this->data['Usuario']['senha'] == $this->Auth->password($this->data['Usuario']['senha_confirma'])) {
				$this->Usuario->create();
				if ($this->Usuario->save($this->data)) {
					$this->Session->setFlash('Usuário cadastrado com sucesso.','flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else {
					$this->data['Usuario']['senha'] = NULL;
					$this->data['Usuario']['senha_confirma'] = NULL;
					$this->Session->setFlash('Erro ao cadastrar o usuário.','flash_erro');
				}
			}
			else {
				$this->data['Usuario']['senha'] = NULL;
				$this->data['Usuario']['senha_confirma'] = NULL;
				$this->Session->setFlash('As senhas digitadas não conferem.','flash_erro');
			}
		}
	}
	
	function editar($id = null) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		//popular o formulario, na primeira carga
		if (empty ($this->data)) {
			$this->data = $this->Usuario->read();
			// formulario carrega sem as senhas
			unset($this->data['Usuario']['senha']);
			unset($this->data['Usuario']['senha_confirma']);
			if ( ! $this->data) {
				$this->Session->setFlash('Usuário não encontrado.','flash_erro');
				$this->redirect(array('action'=>'index'));
			}
		}
		//formulario ja estava populado
		else {
			$this->data['Usuario']['id'] = $id;
			if ($this->data['Usuario']['senha'] == $this->Auth->password($this->data['Usuario']['senha_confirma'])) {
				/**
				 * caso a senha não seja informada, pego a antiga
				 * nota: o campo senha sempre terá valor, pois é feito hash do que havia nele
				 * por isso vejo se a segunda senha informada está em branco
				 */
				if (empty($this->data['Usuario']['senha_confirma'])) {
					$old = $this->Usuario->read();
					$this->data['Usuario']['senha'] = $old['Usuario']['senha'];
					$this->data['Usuario']['senha_confirma'] = $old['Usuario']['senha'];
				}
				if ($this->Usuario->save($this->data)) {
					$this->Session->setFlash('Usuário alterado com sucesso.','flash_sucesso');
					$this->redirect(array('action'=>'index'));
				}
				else {
					$this->data['Usuario']['senha'] = NULL;
					$this->data['Usuario']['senha_confirma'] = NULL;
					$this->Session->setFlash('Erro ao atualizar o usuário.','flash_erro');
				}
			}
			else {
				$this->data['Usuario']['senha'] = NULL;
				$this->data['Usuario']['senha_confirma'] = NULL;
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