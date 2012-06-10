<script type="text/javascript">
	// variaveis a serem utilizadas no arquivo conta_receber.js
	var raiz_site = "<?php print $this->Html->url('/',true); ?>/";
	var ajaxPesqCliente = "<?php print $this->Html->url(array('controller'=>'Clientes','action'=>'pesquisaAjaxCliente')); ?>/";
	var ajaxPesqFornecedor = "<?php print $this->Html->url(array('controller'=>'Fornecedores','action'=>'pesquisaAjaxFornecedor')); ?>/";
</script>

<?php
//#FIXME Ao recuperar a data ela nao volta para o padrao brasileiro
# exibir alerta se a data de vencimento for menor que a data atual?
print $this->Html->script('conta_pagar');
print $this->Html->script('formatar_moeda');
?>

<h2 class="descricao_cabecalho">Editar conta a receber</h2>

<?php print $this->Form->create('PagarConta',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;')); ?>
<div class="grupo_horizontal">
	<?php
	print $this->Form->label('eh_cliente_ou_fornecedor','É cliente ou fornecedor?',array('class'=>'required'));
	print $this->Form->input('eh_cliente_ou_fornecedor', array(
		'div'=>false,
		'label'=>false,
		'options'=>array(''=>'','C'=>'Cliente','F'=>'Fornecedor')
		));
	?>
</div>
		
<div class="grupo_horizontal">
	<?php
	print $this->Form->label('eh_fical','É fiscal?',array('class'=>'required'));
	print $this->Form->input('eh_fiscal', array(
		'div'=>false,
		'label'=>false,
		'options'=>array('0'=>'Não','1'=>'Sim')
		));
	?>
</div>

<div class="grupo_horizontal">
	<?php
	print $this->Form->label('situacao','Situação',array('class'=>'required'));
	print $this->Form->input('situacao', array(
		'div'=>false,
		'label'=>false,
		'options'=>$opcoes_situacoes
		));
	?>
</div>
<div class="limpar"></div>

<div class="divs_grupo_2">
	<div class="div1_2">
		<div>
			<?php
			print $this->Form->label('cliente_fornecedor_id','Cliente/fornecedor',array('class'=>'required'));
			print $this->Form->input('cliente_fornecedor_id', array(
				'div'=>false,
				'label'=>false,
				'type'=>'text',
				'style' => 'float:left; width: 10%;'
				));
			?>
			<input style="margin-left: 1%; width: 80%" type="text" name="pesquisar_cliente_fornecedor" id="pesquisar_cliente_fornecedor" />
		</div>
		<?php
		print $this->Form->input('tipo_documento_id',array('label'=>'Tipo documento','options'=>$opcoes_tipo_documento));
		print $this->Form->input('numero_documento',array('label'=>'Número documento'));
		print $this->Form->input('valor',array('label'=>'Valor'));
		?>
	</div>
	<div class="div2_2">
		<?php
		print $this->Form->input('conta_origem',array('label'=>'Conta de origem','options'=>$opcoes_conta_origem));
		print $this->Form->input('plano_conta_id',array('label'=>'Plano de contas','options'=>$opcoes_plano_contas));
		print $this->Form->input('data_vencimento',array('label'=>'Data do vencimento','type'=>'text','class'=>'datepicker mascara_data'));
		?>
	</div>
</div>
<div class="limpar">&nbsp;</div>

<?php
print $this->Form->input('observacao',array('label'=>'Observação'));
print $this->Form->end('Gravar');
?>
