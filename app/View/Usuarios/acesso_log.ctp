<h2 class="descricao_cabecalho">
	Gerar log de acesso de usuários
</h2>

<?php
print $this->Form->create('Usuario', array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
?>
<div class="divs_grupo_2">
	
	<div class="div1_2">
		<?php
		print $this->Form->input('id', array('label'=>'Usuário','options'=>$opcoes_usuarios));
		?>
	</div>
	
	<div class="div2_2">
		<?php
		print $this->Form->input('data_inicial',array('label'=>'Data inicial','type'=>'datetime','dateFormat' => 'DMY','timeFormat'=>24));
		print $this->Form->input('data_final',array('label'=>'Data final','type'=>'datetime','dateFormat' => 'DMY','timeFormat'=>24));
		
		?>
	</div>
	<div class="limpar">&nbsp;</div>
</div>
<div class="limpar">&nbsp;</div>
<?php print $this->Form->end('Gravar'); ?>
