<?php

class Empresa extends AppModel {
	var $name = 'Empresa';
	var $hasMany = array('Cliente','Fornecedor');
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
		'site' => array(
			'allowEmpty' => true,
			'rule' => 'url',
			'message' => 'Endereço inválido'
		),
		'endereco_email_principal' => array(
			'allowEmpty' => true,
			'rule' => 'email',
			'message' => 'Endereço inválido'
		),
		'endereco_email_secundario' => array(
			'allowEmpty' => true,
			'rule' => 'email',
			'message' => 'Endereço inválido'
		),
		'logradouro' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'numero' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'bairro' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'cep' => array(
			'obrigatorio' => array (
				'allowEmpty' => false,
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
			'numerico' => array(
				'rule' => 'numeric',
				'message' => 'Somente números.'
			),
		),
		'cidade' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'estado' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		)
	);
}

?>