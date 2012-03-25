<h2 class="descricao_cabecalho">Alterar tipo de documento</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'TipoDocumento','update'=>'conteudo_ajax'));
}
else {
	print $this->Form->create('TipoDocumento',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $this->Form->input('nome',array('label'=>'Nome'));
print $this->Form->end('Gravar');
?>
