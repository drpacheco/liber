<h2 class="descricao_cabecalho">Editar categoria de fornecedor</h2>

<?php
if ($ajax->isAjax()) {
	print $ajax->form('editar','post',array('autocomplete'=>'off','model'=>'FornecedorCategoria','update'=>'conteudo_ajax'));

}
else {
	print $form->create('FornecedorCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
print $form->input('descricao',array('label'=>'Descrição'));
print $form->end('Gravar');
?>
