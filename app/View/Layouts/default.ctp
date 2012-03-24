<?php print $this->Html->docType('html5'); ?>
<html>
	<head>
		<?php print $this->Html->charset()."\n"; ?>
		<noscript>
			<meta http-equiv="refresh" content="0; URL=<?php print $this->Html->url('/',true); ?>sistema/noscript" />
			<?php print $this->fetch('meta'); ?>
		</noscript>
		<title>
			<?php print 'Liber - '.$title_for_layout."\n"; ?>
		</title>
		<?php
		print $this->Html->meta('icon');
		print $this->Html->css('estilo.css');
		print $this->fetch('css');
		print $this->Html->css('jquery-ui/jquery-ui.css');
		print $this->Html->script('jquery');
		print $this->Html->script('auxiliares.js');
		?>
	</head>
	
	<body>
		
		<div id="cabecalho">
			<div id="menu" name="menu">
				<?php print $this->element('menu'); ?>
			</div>
			
			<div id="banner">
				<div class="logo">Liber</div>
			</div>
		</div>
		
		<div id="conteudo">
			
			<div id="flash">
				<?php
				print $this->Session->flash();
				print $this->Session->flash('auth');
				?>
			</div>
			
			<?php print $this->fetch('content') ?>
		
			<div id="rodape">
				
			</div>
			
		</div>
		
		<?php 
		print $this->Html->script('menu.superfish.js');
		print $this->Html->script('jquery-ui.js');
		print $this->Html->script('mascaras.js');
		print $this->fetch('script');
		?>
		
		<?php print $this->element('sql_dump'); ?>
	</body>
	
</html>
