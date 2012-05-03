<?php

class SistemaOpcao extends AppModel {
	var $name = 'SistemaOpcao';
	var $belongsTo = array (
	    'PlanoContaPedidoVenda' => array (
		   'className' => 'PlanoConta',
		   'foreignKey' => 'item_plano_contas_pedido_vendas',
	    ),
	    'PlanoContaOrdemServico' => array (
		   'className' => 'PlanoConta',
		   'foreignKey' => 'item_plano_contas_ordem_servicos',
	    ),
	);
	var $validate = array (
		'login_periodo_tentativas' => array(
			'obrigatorio' => array (
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
		    'numero' => array (
				'rule' => 'numeric',
				'message' => 'Número inválido.'
		    ),
		),
		'login_maximo_tentativas' => array(
			'obrigatorio' => array (
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
		    'numero' => array (
				'rule' => 'numeric',
				'message' => 'Número inválido.'
		    ),
		),
		'login_tempo_bloqueio' => array(
			'obrigatorio' => array (
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
		    'numero' => array (
				'rule' => 'numeric',
				'message' => 'Número inválido.'
		    ),
		)
	);
}

?>