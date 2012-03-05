<div id="login">

	<?php
	if ($ajax->isAjax()) {
		print $ajax->form('login','post',array('autocomplete'=>'off','model'=>'Usuario','update'=>'conteudo_ajax'));

	}
	else {
		print $form->create('Usuario', array('action'=>'login','autocomplete'=>'off'));
	}
	print $form->input('login',array('label'=>'Usuário'));
	print $form->input('senha', array('type'=>'password'));
	print $form->end('Entrar');
	?>
	
</div>