<h2 class="descricao_cabecalho">Alterar tipo de documento</h2>

<?php
print $this->Form->create('TipoDocumento',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
print $this->Form->input('nome',array('label'=>'Nome'));
print $this->Form->end('Gravar');
?>
