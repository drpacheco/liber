<?php

class Motorista extends AppModel {
	var $name = 'Motorista';
	var $hasOne = array('Carregamento');
	var $belongsTo = array(
		'Veiculo' => array(
			'className' => 'veiculo',
			'foreignKey' => 'veiculo_padrao'
		)
	);
	var $actsAs = array('CakePtbr.AjusteData');
	var $validate = array(
		'nome' => array(
			'obrigatorio' => array (
				'allowEmpty' => false,
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
			'unico' => array(
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		'cnh_numero_registro' => array(
			'numerico' => array(
				'allowEmpty' => true,
				'rule' => 'numeric',
				'message' => 'Somente números.'
			),
			'unico' => array(
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		'cnh_data_validade' => array(
			'allowEmpty' => true,
			'rule' => 'date',
			'message' => 'Data inválida.'
		)
	);
}

?>