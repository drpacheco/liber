<?php

class Veiculo extends AppModel {
	var $name = 'Veiculo';
	var $hosOne = array(
		'Veiculo' => array(
			'className' => 'veiculo',
			'foreignKey' => 'veiculo_padrao'
		),
		'Carregamento' => array (
			'className' => 'carregamento',
			'foreignKey' => 'veiculo_id'
		)
	);
	var $validate = array(
		'modelo' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'placa' => array(
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
		'ano' => array(
			'allowEmpty' => true,
			'rule' => 'numeric',
			'message' => 'Somente números.'
		)
	);
}

?>