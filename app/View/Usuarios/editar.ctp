<h2 class="descricao_cabecalho">
	Editar usuário
</h2>

<?php
print $this->Form->create('Usuario', array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
?>
<div class="divs_grupo_2">
	
	<div class="div1_2">
		<?php
		print $this->Form->input('nome', array('label'=>'Nome'));
		print $this->Form->input('login',array('label'=>'Login'));
		print $this->Form->input('senha', array('label'=>'Senha','type'=>'password'));
		print $this->Form->input('senha_confirma', array('label'=>'Redigite a senha','type'=>'password'));
		?>
	</div>
	
	<div class="div2_2">
		<?php
		print $this->Form->input('tipo', array('label'=>'Tipo de usuário','options'=>
		array(
		'0'=>'Administrador',
		'1'=>'Usuário comum',
		'2' => 'Vendedor',
		'3' => 'Técnico'
		)));
		print $this->Form->input('email', array('label'=>'Endereço de e-mail'));
		print $this->Form->input('ativo', array('label'=>'Ativo?','checked'=>'checked'));
		print $this->Form->input('eh_tecnico',array('label'=>'É técnico?'));
		print $this->Form->input('eh_vendedor',array('label'=>'É vendedor?'));
		?>
	</div>
	<div class="limpar">&nbsp;</div>
</div>
<div class="limpar">&nbsp;</div>
<?php print $this->Form->end('Gravar'); ?>
