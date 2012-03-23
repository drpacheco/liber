<h2 class="descricao_cabecalho">Editar motorista</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'Motorista','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('Motorista',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
<div class="divs_grupo_2">
	<div class="div1_2">
		<?php
		print $this->Form->input('nome',array('label'=>'Nome'));
		print $this->Form->input('logradouro_nome',array('label'=>'Logradouro'));
		print $this->Form->input('logradouro_numero',array('label'=>'Número'));
		print $this->Form->input('logradouro_complemento',array('label'=>'Complemento'));
		?>
	</div>
	<div class="div2_2">
		<?php
		print $this->Form->input('cnh_numero_registro',array('label'=>'Número de registro da C.N.H.'));
		print $this->Form->input('cnh_data_validade',array('label'=>'Data de validade da C.N.H.','type'=>'text','class'=>'datepicker mascara_data'));
		print $this->Form->input('cnh_categoria',array('label'=>'Categoria da C.N.H.'));
		print $this->Form->input('veiculo_padrao',array('label'=>'Principal veículo','options'=>$opcoes_veiculo));
		?>
	</div>
</div>
<?php print $this->Form->end('Gravar'); ?>
