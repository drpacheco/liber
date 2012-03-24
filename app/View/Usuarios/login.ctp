<div id="login">
	<?php
	print $this->Form->create('Usuario', array('action'=>'login','autocomplete'=>'off'));
	print $this->Form->input('login',array('label'=>'Usuário'));
	print $this->Form->input('senha', array('type'=>'password'));
	print $this->Form->end('Entrar');
	?>
</div>