<h2 class="descricao_cabecalho">Editar categoria de serviço</h2>

<?php
print $form->create('ServicoCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
print $form->input('nome',array('label'=>'Nome'));
print $form->end('Gravar');
?>