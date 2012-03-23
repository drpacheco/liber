<h2 class="descricao_cabecalho">Cadastrar item do plano de contas</h2>

<?php
$opcoes = array(
	'D'=>'Despesas',
	'R'=>'Receitas',
	'E'=>'Especiais'
);
print $this->Form->create('PlanoConta',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
print $this->Form->input('nome',array('label'=>'Nome'));
print $this->Form->input('tipo',array('label'=>'Tipo','options'=>$opcoes));
print $this->Form->end('Gravar');
?>
