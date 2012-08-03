<?php
// app/Controller/AppController.php
App::uses('Controller', 'Controller');
class AppController extends Controller {
	
	// Componentes utilizados por toda a aplicação
	var $components = array('Session', 'Cookie','Auth','RequestHandler');
	// Helpers utilizados por toda a aplicacao
	var $helpers = array('Html','Form','Session','Js','Javascript','Ajax');
	
	function beforeFilter() {
		
		// Parametros do AuthComponent
		// utilizado para autenticacao de usuarios
		$this->Auth->authenticate = array(
		     // define parametros para o metodo de autenticacao baseado em formulario
		    'Form' => array (
			   // model a ser utilizado pelo AuthComponent
			   'userModel' => 'Usuario',
			   // os campos que irão definir usuario e senha
			   'fields' => array ('username' => 'login', 'password' => 'senha'),
			   // Condicao de usuario ativo/valido (opcional)
			   'userScope' => array('Usuario.ativo' => true),
			)
		);
		// action da tela de login
		$this->Auth->loginAction = array ('controller' => 'usuarios','action' => 'login');
		// Para onde o usuario ira depois de fazer login e
		// sem ter url de referencia
		$this->Auth->loginRedirect = array ('controller' => 'sistema','action' => 'inicio');
		// Action para redirecionamento apos o logout
		$this->Auth->logoutRedirect = array( 'controller' => 'usuarios','action' => 'login');
		// mensagem de erro, ao acessar area restrita
		$this->Auth->authError = 'Você precisa fazer login para acessar o sistema';
		
	}
	
	function beforeRender() {
		parent::beforeRender();
		// Se cliente nao estiver logado
		if ( ! $this->Auth->loggedIn() ) {
			/*
			* Altera o layout para todos os erros do Cake
			* http://groups.google.com/group/cake-php/browse_thread/thread/090eb7d3bbe179cb
			*/
			if ($this->name === 'CakeError') {
				$this->layout = 'erro';
			}
		}
	}
	
}


?>