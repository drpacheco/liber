<?php
class TipoDocumento extends  Model {
	var $name = 'TipoDocumento';
	var $hasMany = array('PagarConta','ReceberConta','FormaPagamento');
	var $actsAs = array('Containable');
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
	);
	
}

?>