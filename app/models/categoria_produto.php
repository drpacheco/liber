<?php

class CategoriaProduto extends AppModel {
	var $name = 'CategoriaProduto';
	var $hasMany = array('Produto');
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
		)
	);
}

?>