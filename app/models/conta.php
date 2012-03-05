<?php

class Conta extends AppModel {
	var $name = 'Conta';
	var $hasMany = array(
		'forma_pagamentos' => array(
			'className' => 'FormaPagamento',
			'foreignKey' => 'conta_principal'
		),
		'pagar_contas' => array(
			'className' => 'PagarConta',
			'foreignKey' => 'conta_origem'
		),
		'receber_contas' => array(
			'className' => 'ReceberConta',
			'foreignKey' => 'conta_origem'
		)
	);
	var $validate = array(
		'nome' => array(
			'obrigatorio' => array (
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
			'unico' => array(
				'allowEmpty' => false,
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		'apelido' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'titular' => array(
			'allowEmpty' => true,
			'rule' => 'alphanumeric',
			'message' => 'Somente letras e números.'
		)
	);
}

?>