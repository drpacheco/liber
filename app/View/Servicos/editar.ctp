<?php print $this->Html->script('formatar_moeda'); ?>
<script type="text/javascript">
	$(function() {
		$('#ServicoValor').priceFormat();
	});
</script>

<h2 class="descricao_cabecalho">Editar serviço</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'Servico','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('Servico',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
<div class="divs_grupo_2">
	<div class="div1_2">
		<?php
		print $this->Form->input('nome',array('label'=>'Nome'));
		print $this->Form->input('valor',array('label'=>'Valor'));
		?>
	</div>
	<div class="div2_2">
		<?php
		print $this->Form->input('servico_categoria_id',array('label'=>'Categoria','options'=>$opcoes_servico_categoria));
		?>
	</div>
</div>
<?php print $this->Form->end('Gravar'); ?>
