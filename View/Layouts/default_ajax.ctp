<div id="conteudo_ajax">
	
	<?php print $scripts_for_layout; ?>	
	
	<div id="flash_ajax">
		<?php
		print $this->Session->flash();
		print $this->Session->flash('auth');
		?>
	</div>
	
	<?php print $content_for_layout ?>
	
</div>