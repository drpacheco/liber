<?php

/**
 * Controller utilizado para funçoes gerais acerca do proprio sistema e
 * exibir a página inicial da aplicação, sendo que para esta tarefa o controller
 * pages poderia ser utilizado
 */

class SistemaController extends AppController {
	var $name = "Sistema";
	var $components = array('Sanitizacao','RequestHandler');
	var $helpers = array('Javascript','Ajax');
	var $uses = array(); //nao ha model para este controller
	
	/**
	* @var $Sistema
	*/
	var $Sistema;

	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
	}
	
	function ajuda() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
	}
	
	function sobre() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
	}
	
	function noscript(){
		/**
		 * Defino um novo layout para onde as requisições de clientes
		 * sem suporte a javascript serão redirecionados.
		 * O novo layout remove boa parte dos scripts e menu.
		 */
		$this->layout = 'noscript';
	}
	
	/**
	 * Página inicial (home) da aplicação
	 * Para o funcionamento foi necessario alterar a rota / em app/config/routes.php
	 * outra alternativa: http://www.phpfreaks.com/forums/index.php?topic=240370.0
	 */
	function inicio() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->loadModel('PagarConta');
		$this->PagarConta->contain('Cliente.nome');
		$dadosContasPagar = $this->PagarConta->find('all',array('conditions'=>array('data_vencimento'=>date('Y-m-d')),'limit'=>10,'recursive'=>'1'));
		if (empty($dadosContasPagar)) $contasPagar = 'Não há contas a pagar que vencem hoje.';
		else {
			$contasPagar = '';
			foreach ($dadosContasPagar as $conta) {
				$contasPagar .= "<a href='pagarContas/editar/{$conta['PagarConta']['id']}'>{$conta['Cliente']['nome']} (R\${$conta['PagarConta']['valor']})</a> / ";
			}
		}
		$this->set('contasPagar',$contasPagar);
		
		$this->loadModel('ReceberConta');
		$this->ReceberConta->contain('Cliente.nome');
		$dadosContasReceber = $this->ReceberConta->find('all',array('conditions'=>array('data_vencimento'=>date('Y-m-d')),'limit'=>10,'recursive'=>'1'));
		if (empty($dadosContasReceber)) $contasReceber = 'Não há contas a receber que vencem hoje.';
		else {
			$contasReceber = '';
			foreach ($dadosContasReceber as $conta) {
				$contasReceber .= "<a href='receberContas/editar/{$conta['ReceberConta']['id']}'>{$conta['Cliente']['nome']} (R\${$conta['ReceberConta']['valor']})</a> / ";
			}
		}
		$this->set('contasReceber',$contasReceber);
	}

}

?>