<?php

class ClienteCategoria extends AppModel {
	var $name = 'ClienteCategoria';
	var $hasMany = array('Cliente');
	var $validate = array(
		'descricao' => array(
			'obrigatorio' => array (
				'allowEmpty' => false,
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
			'unico' => array(
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		)
	);
}

?>