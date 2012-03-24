<div id="conteudo_ajax">
	
	<?php
	print $this->fetch('meta');
	print $this->fetch('css');
	print $this->fetch('script');
	?>	
	
	<div id="flash_ajax">
		<?php
		print $this->Session->flash();
		print $this->Session->flash('auth');
		?>
	</div>
	
	<?php print $this->fetch('content') ?>
	
</div>