<h2 class="descricao_cabecalho">Cadastrar empresa</h2>

<?php print $this->Form->create('Empresa',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));?>
<div class="divs_grupo_3">
	<div class="div1_3">
		<?php
		print $this->Form->input('nome',array('label'=>'Nome'));
		print $this->Form->input('cnpj',array('label'=>'CNPJ'));
		print $this->Form->input('inscricao_estadual',array('label'=>'Inscrição estadual'));
		print $this->Form->input('telefone',array('label'=>'Número de telefone'));
		print $this->Form->input('fax',array('label'=>'Número de fax'));
		?>
	</div>
	<div class="div2_3">
		<?php
		print $this->Form->input('site',array('label'=>'Site da empresa'));
		print $this->Form->input('endereco_email_principal',array('label'=>'Endereço de e-mail principal'));
		print $this->Form->input('endereco_email_secundario',array('label'=>'Endereço de e-mail secundário'));
		print $this->Form->input('logradouro',array('label'=>'Logradouro'));
		print $this->Form->input('cep',array('label'=>'CEP'));
		?>
	</div>
	<div class="div3_3">
		<?php
		print $this->Form->input('numero',array('label'=>'Número'));
		print $this->Form->input('bairro',array('label'=>'Bairro'));
		print $this->Form->input('complemento',array('label'=>'Complemento'));
		print $this->Form->input('cidade',array('label'=>'Cidade'));
		?>
		<div class="input text required">
			<label for="EmpresaUf">UF:</label>
			<?php print $this->Estados->select('estado'); ?>
		</div>
		<?php
		?>
	</div>
</div>
<?php print $this->Form->end('Gravar'); ?>
