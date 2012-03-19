<?php

class ProdutoCategoria extends AppModel {
	var $name = 'ProdutoCategoria';
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