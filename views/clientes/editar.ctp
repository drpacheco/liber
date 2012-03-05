<?php $javascript->link('clientes.js',false); ?>
<h2 class="descricao_cabecalho">
	Editar cliente
</h2>

<?php
if ($ajax->isAjax()) {
	print $ajax->form('editar','post',array('autocomplete'=>'off','model'=>'Cliente','update'=>'conteudo_ajax'));
}
else {
	print $form->create('Cliente',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}

?>

	<div class="grupo_horizontal">
		<?php
		print $form->label('tipo_pessoa','Tipo pessoa',array('class'=>'required'));
		print $form->input('tipo_pessoa', array(
			'div'=>false,
			'label'=>false,
			'options'=>array(''=>'','F'=>'Física','J'=>'Jurídica')
			));
		?>
	</div>
	<div class="grupo_horizontal">
	<?php
		print $form->label('situacao','Situação',array('class'=>'required'));
		print $form->input('situacao',array(
			'div'=>false,
			'label'=>false,
			'options'=>array(''=>'','A'=>'Ativo','I'=>'Inativo','B'=>'Bloqueado')
			));
		?>
	</div>

	<div class="grupo_horizontal">
	<?php
		print $form->label('cliente_categoria_id','Categoria do cliente',array('class'=>'required'));
		print $form->input('cliente_categoria_id',array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_categoria_cliente
			));
		?>
	</div>
	<div class="grupo_horizontal">
	<?php
		print $form->label('empresa_id','Empresa',array('class'=>'required'));
		print $form->input('empresa_id',array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_empresa
			));
		?>
	</div>

<div class="limpar"></div>
<div class="divs_grupo_3">
	<div class="div1_3">
		<?php
		print $form->input('nome', array('label'=>'Nome'));
		print $form->input('nome_fantasia', array('label'=>'Nome fantasia'));
		print $form->input('logradouro_nome', array('label'=>'Logradouro'));
		print $form->input('logradouro_numero', array('label'=>'Número'));
		print $form->input('logradouro_complemento', array('label'=>'Complemento'));
		?>
	</div>
	
	<div class="div2_3">
		<?php
		print $form->input('bairro');
		print $form->input('cidade');
		?>
		<div class="input text required">
			<label for="ClienteUf">UF:</label>
			<?php print $estados->select('uf'); ?>
		</div>
		<?php
		print $form->input('cep', array('label'=>'CEP'));
		print $form->input('numero_telefone', array('label'=>'Número de telefone'));
		?>
	</div>
	
	<div class="div3_3">
		<?php
		print $form->input('endereco_email', array('label'=>'Endereço de e-mail'));
		print $form->input('cnpj',array('label'=>'CNPJ', 'disabled'=>'disabled'));
		print $form->input('inscricao_estadual',array('label'=>'Inscrição estadual', 'disabled'=>'disabled'));
		print $form->input('cpf',array('label'=>'CPF', 'disabled'=>'disabled'));
		print $form->input('rg',array('label'=>'RG', 'disabled'=>'disabled'));
		print $form->input('inscricao_municipal',array('label'=>'Registro municipal'));
		?>
	</div>
	
</div>
<div class="limpar"></div>
<?php
print $form->input('observacao', array('label'=>'Observação') );
print $form->end('Gravar');
?>
