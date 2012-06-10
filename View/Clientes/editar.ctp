<?php print $this->Html->script('cliente'); ?>
<h2 class="descricao_cabecalho">
	Editar cliente
</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'Cliente','update'=>'conteudo_ajax'));
}
else {
	print $this->Form->create('Cliente',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}

?>

	<div class="grupo_horizontal">
		<?php
		print $this->Form->label('tipo_pessoa','Tipo pessoa',array('class'=>'required'));
		print $this->Form->input('tipo_pessoa', array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_tipos
			));
		?>
	</div>
	<div class="grupo_horizontal">
	<?php
		print $this->Form->label('situacao','Situação',array('class'=>'required'));
		print $this->Form->input('situacao',array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_situacoes
			));
		?>
	</div>

	<div class="grupo_horizontal">
	<?php
		print $this->Form->label('cliente_categoria_id','Categoria do cliente',array('class'=>'required'));
		print $this->Form->input('cliente_categoria_id',array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_categoria_cliente
			));
		?>
	</div>

<div class="limpar"></div>
<div class="divs_grupo_3">
	<div class="div1_3">
		<?php
		print $this->Form->input('nome', array('label'=>'Nome'));
		print $this->Form->input('nome_fantasia', array('label'=>'Nome fantasia'));
		print $this->Form->input('logradouro_nome', array('label'=>'Logradouro'));
		print $this->Form->input('logradouro_numero', array('label'=>'Número'));
		print $this->Form->input('logradouro_complemento', array('label'=>'Complemento'));
		?>
	</div>
	
	<div class="div2_3">
		<?php
		print $this->Form->input('bairro');
		print $this->Form->input('cidade');
		?>
		<div class="input text required">
			<label for="ClienteUf">UF:</label>
			<?php print $this->Estados->select('uf'); ?>
		</div>
		<?php
		print $this->Form->input('cep', array('label'=>'CEP'));
		print $this->Form->input('numero_telefone', array('label'=>'Número de telefone'));
		?>
	</div>
	
	<div class="div3_3">
		<?php
		print $this->Form->input('endereco_email', array('label'=>'Endereço de e-mail'));
		print $this->Form->input('cnpj',array('label'=>'CNPJ', 'disabled'=>'disabled'));
		print $this->Form->input('inscricao_estadual',array('label'=>'Inscrição estadual', 'disabled'=>'disabled'));
		print $this->Form->input('cpf',array('label'=>'CPF', 'disabled'=>'disabled'));
		print $this->Form->input('rg',array('label'=>'RG', 'disabled'=>'disabled'));
		print $this->Form->input('inscricao_municipal',array('label'=>'Registro municipal'));
		?>
	</div>
	
</div>
<div class="limpar"></div>
<?php
print $this->Form->input('observacao', array('label'=>'Observação') );
print $this->Form->end('Gravar');
?>
