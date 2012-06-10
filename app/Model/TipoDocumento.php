<?php
class TipoDocumento extends  Model {
	var $name = 'TipoDocumento';
	var $actsAs = array('Containable','Empresa');
	var $belongsTo = array(
	    'Empresa' => array(
			'className' => 'Empresa'
		),
	);
	var $hasMany = array('PagarConta','ReceberConta','FormaPagamento');
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
	    'empresa_id' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
	);
	
}

?>