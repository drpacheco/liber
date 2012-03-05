<?php

class FornecedorCategoria extends AppModel {
	var $name = 'FornecedorCategoria';
	var $hasMany = array('Fornecedor');
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