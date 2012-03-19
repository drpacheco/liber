<h2 class="descricao_cabecalho">Editar categoria de produto</h2>

<?php
if ($ajax->isAjax()) {
	print $ajax->form('editar','post',array('autocomplete'=>'off','model'=>'ProdutoCategoria','update'=>'conteudo_ajax'));

}
else {
	print $form->create('ProdutoCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $form->input('nome',array('label'=>'Nome'));
print $form->end('Gravar');
?>
