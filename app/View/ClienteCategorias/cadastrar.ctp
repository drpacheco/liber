<h2 class="descricao_cabecalho">Cadastrar categoria de cliente</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'ClienteCategoria','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('ClienteCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $this->Form->input('descricao',array('label'=>'Descrição'));
print $this->Form->end('Gravar');
?>
