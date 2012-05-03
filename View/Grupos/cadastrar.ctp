<h2 class="descricao_cabecalho">Cadastrar grupo</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'Grupo','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('Grupo',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
<div class="divs_grupo_2">
	<div class="div1_2">
		<?php
		print $this->Form->input('nome',array('label'=>'Nome'));
		?>
	</div>
</div>
<?php print $this->Form->end('Gravar'); ?>
