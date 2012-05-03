<?php

class SistemaOpcao extends AppModel {
	var $name = 'SistemaOpcao';
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