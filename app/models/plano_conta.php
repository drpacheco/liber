<?php
class PlanoConta extends  Model {
	var $name = 'PlanoConta';
	var $hasMany = array('PagarConta','ReceberConta');
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
		'tipo' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		)
	);
	
}

?>