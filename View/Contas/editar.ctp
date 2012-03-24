<h2 class="descricao_cabecalho">Editar conta</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'TipoDocumento','update'=>'conteudo_ajax'));
}
else {
	print $this->Form->create('Conta',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
<div class="divs_grupo_2">
	<div class="div1_2">
		<?php
		print $this->Form->input('nome',array('label'=>'Nome'));
		print $this->Form->input('apelido',array('label'=>'Apelido'));
		print $this->Form->input('banco',array('label'=>'Banco'));
		?>
	</div>
	<div class="div2_2">
		<?php
		print $this->Form->input('agencia',array('label'=>'Agência'));
		print $this->Form->input('conta',array('label'=>'Conta'));
		print $this->Form->input('titular',array('label'=>'Titular'));
		?>
	</div>
</div>
<?php print $this->Form->end('Gravar'); ?>
