<?php $javascript->link('formatar_moeda.js',false); ?>
<script type="text/javascript">
	$(function() {
		$('#ServicoValor').priceFormat();
	});
</script>

<h2 class="descricao_cabecalho">Editar serviço</h2>

<?php
if ($ajax->isAjax()) {
	print $ajax->form('editar','post',array('autocomplete'=>'off','model'=>'Servico','update'=>'conteudo_ajax'));

}
else {
	print $form->create('Servico',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
<div class="divs_grupo_2">
	<div class="div1_2">
		<?php
		print $form->input('nome',array('label'=>'Nome'));
		print $form->input('valor',array('label'=>'Valor'));
		?>
	</div>
	<div class="div2_2">
		<?php
		print $form->input('servico_categoria_id',array('label'=>'Categoria','options'=>$opcoes_servico_categoria));
		?>
	</div>
</div>
<?php print $form->end('Gravar'); ?>
