<?php
class PlanoConta extends  Model {
	var $name = 'PlanoConta';
	var $actsAs = array('Empresa','Containable');
	var $belongsTo = array(
	    'Empresa' => array(
			'className' => 'Empresa'
		),
	);
	var $hasMany = array(
	    'PagarConta' => array(
		   'className' => 'PagarConta',
	    ),
	    'ReceberConta' => array (
		   'className' => 'ReceberConta',
	    ),
	    'SistemaOpcaoPedidoVenda' => array (
		   'className' => 'SistemaOpcao',
		   'foreignKey' => 'item_plano_contas_pedido_vendas',
	    ),
	    'SistemaOpcaoOrdemServico' => array (
		   'className' => 'SistemaOpcao',
		   'foreignKey' => 'item_plano_contas_ordem_servicos',
	    ),
	);
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
		'tipo' => array (
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
	    'empresa_id' => array (
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
	);
	
}

?>