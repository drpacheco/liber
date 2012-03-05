<h2 class="descricao_cabecalho">Cadastrar categoria de cliente</h2>

<?php
if ($ajax->isAjax()) {
	print $ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'ClienteCategoria','update'=>'conteudo_ajax'));

}
else {
	print $form->create('ClienteCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $form->input('descricao',array('label'=>'Descrição'));
print $form->end('Gravar');
?>
