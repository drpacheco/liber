<h2 class="descricao_cabecalho">Editar categoria de produto</h2>

<?php
if ($ajax->isAjax()) {
	print $ajax->form('editar','post',array('autocomplete'=>'off','model'=>'CategoriaProduto','update'=>'conteudo_ajax'));

}
else {
	print $form->create('CategoriaProduto',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $form->input('nome',array('label'=>'Nome'));
print $form->end('Gravar');
?>
