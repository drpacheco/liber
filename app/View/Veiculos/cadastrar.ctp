<h2 class="descricao_cabecalho">Cadastrar veículo</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'Veiculo','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('Veiculo',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
<div class="divs_grupo_2">
	<div class="div1_2">
		<?php
		print $this->Form->input('modelo',array('label'=>'Modelo'));
		print $this->Form->input('placa',array('label'=>'Placa'));
		print $this->Form->input('fabricante',array('label'=>'Fabricante'));
		print $this->Form->input('ano',array('label'=>'Ano','type'=>'text'));
		?>
	</div>
</div>
<?php print $this->Form->end('Gravar'); ?>
