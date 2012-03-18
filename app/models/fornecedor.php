<?php

class Fornecedor extends AppModel {
	
	var $name = 'Fornecedor'; // para compatibilidade com o PHP 4
	var $actsAs = array('Containable');
	var $belongsTo = array(
		'FornecedorCategoria' => array(
			'className' => 'FornecedorCategoria'
		),
		'Empresa' => array(
			'className' => 'Empresa'
		),
		'Usuario' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_cadastrou',
		),
		'Usuario2' => array(
			'className' => 'Usuario',
			'foreignKey' => 'usuario_alterou',
		)
	);
	var $validate = array(
		'tipo_pessoa' => array (
			'allowEmpty' => false,
			'rule' => array('inList', array('F','J')),
			'message' => 'Escolha uma das opções.'
		),
		
		'situacao' => array (
			'allowEmpty' => false,
			'rule' => array('inList', array('A','I','B')),
			'message' => 'Escolha uma das opções.'
		),
		
		'nome' => array(
			'obrigatorio' => array (
				'allowEmpty' => false,
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório. Somente letras e números.'
			),
			'unico' => array(
				'allowEmpty' => true,
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		
		'nome_fantasia' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório. Somente letras e números.'
		),
		
		'logradouro_nome' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		
		'logradouro_numero' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		
		'bairro' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		
		'cidade' => array(
			'allowEmpty' => false,
			'rule' => 'alphanumeric',
			'message' => 'Campo obrigatório. Somente letras e números.'
		),
		
		'uf' => array(
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		
		'cep' => array(
			'obrigatorio' => array (
				'rule' => 'notEmpty',
				'message' => 'Campo obrigatório.'
			),
			'valido' => array(
				'rule' => array('postal',null,'br'),
				'message' => 'CEP inválido.'
			),
		),
		
		'endereco_email' => array (
			'allowEmpty' => true,
			'rule' => 'email',
			'message' => 'Endereço de e-mail inválido.'
		),
		
		'cnpj' => array(
			'numerico' => array(
				'allowEmpty' => true,
				'rule' => 'numeric',
				'message' => 'Somente números.'
			),
			'unico' => array(
				'allowEmpty' => true,
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		
		'inscricao_estadual' => array(
			'numerico' => array(
				'allowEmpty' => true,
				'rule' => 'numeric',
				'message' => 'Somente números.'
			),
			'unico' => array(
				'allowEmpty' => true,
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		
		'cpf' => array(
			'numerico' => array(
				'allowEmpty' => true,
				'rule' => 'numeric',
				'message' => 'Somente números.'
			),
			'unico' => array(
				'allowEmpty' => true,
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		
		'rg' => array(
			'alphanumerico' => array(
				'allowEmpty' => true,
				'rule' => 'alphanumeric',
				'message' => 'Somente letras e números.'
			),
			'unico' => array(
				'allowEmpty' => true,
				'rule' => 'isUnique',
				'message' => 'Já cadastrado.'
			)
		),
		'empresa_id' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		'fornecedor_categoria_id' => array(
			'allowEmpty' => false,
			'rule' => 'notEmpty',
			'message' => 'Campo obrigatório.'
		),
		
	);
	
	
}

?>