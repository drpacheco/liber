<?php print $this->Html->script('fornecedores'); ?>
<h2 class="descricao_cabecalho">
	Adicionar fornecedor
</h2>

<?php print $this->Form->create('Fornecedor',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;')); ?>

	<div class="grupo_horizontal">
		<?php
		print $this->Form->label('tipo_pessoa','Tipo pessoa',array('class'=>'required'));
		print $this->Form->input('tipo_pessoa', array(
			'div'=>false,
			'label'=>false,
			'options'=>array(''=>'','F'=>'Física','J'=>'Jurídica')
			));
		?>
	</div>
	<div class="grupo_horizontal">
	<?php
		print $this->Form->label('situacao','Situação',array('class'=>'required'));
		print $this->Form->input('situacao',array(
			'div'=>false,
			'label'=>false,
			'options'=>array(''=>'','A'=>'Ativo','I'=>'Inativo','B'=>'Bloqueado')
			));
		?>
	</div>

	<div class="grupo_horizontal">
	<?php
		print $this->Form->label('fornecedor_categoria_id','Categoria do fornecedor',array('class'=>'required'));
		print $this->Form->input('fornecedor_categoria_id',array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_categoria_fornecedor
			));
		?>
	</div>
	<div class="grupo_horizontal">
	<?php
		print $this->Form->label('empresa_id','Empresa',array('class'=>'required'));
		print $this->Form->input('empresa_id',array(
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
			<label for="FornecedorUf">UF:</label>
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

<?php
print $this->Form->input('observacao', array('label'=>'Observação') );
print $this->Form->end('Gravar');
?>
