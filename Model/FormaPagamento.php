<?php

class FormaPagamento extends AppModel {
	var $name='FormaPagamento';
	var $actsAs = array('Containable','Empresa');
	var $belongsTo = array (
		'Conta' => array (
			'className' => 'Conta',
			'foreignKey' => 'conta_principal'
		),
		'TipoDocumento' => array(
		    'className' => 'TipoDocumento',
		    'foreignKey' => 'tipo_documento_id'
		),
	    'Empresa' => array(
			'className' => 'Empresa'
		),
	);
	var $hasMany = array (
		'FormaPagamentoItem' => array(
			'class_name' => 'FormaPagamentoItem',
		),
		'ServicoOrdem' => array(
			'className' => 'ServicoOrdem'
		),
		'PedidoVenda' => array(
			'className' => 'PedidoVenda'
		)
	);
	var $validate = array (
		'nome' => array (
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'conta_principal' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'tipo_documento_id' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
	    'empresa_id' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
	);
}

?>