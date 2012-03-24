<h2 class="descricao_cabecalho">Cadastrar item do plano de contas</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'PlanoConta','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('PlanoConta',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $this->Form->input('nome',array('label'=>'Nome'));
print $this->Form->input('tipo',array('label'=>'Tipo','options'=>$opcoes));
print $this->Form->end('Gravar');
?>
