<h2 class="descricao_cabecalho">Editar categoria de serviço</h2>

<?php
print $this->Form->create('ServicoCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
print $this->Form->input('nome',array('label'=>'Nome'));
print $this->Form->end('Gravar');
?>