<h2 class="descricao_cabecalho">Cadastrar tipo de documento</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'TipoDocumentos','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('TipoDocumento',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $this->Form->input('nome',array('label'=>'Nome'));
print $this->Form->end('Gravar');
?>