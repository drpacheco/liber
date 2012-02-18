<?php print $html->docType()."\n"; ?>
<html>
	<head>
		<?php print $this->Html->charset()."\n"; ?>
		<title>
			<?php
			__('Liber - ');
			print $title_for_layout."\n";
			?>
		</title>
		<?php
			print $this->Html->meta('icon');
			print $this->Html->script('jquery');
			print $this->Html->script('auxiliares');
			print $this->Html->css('estilo_limpo.css');
		?>
	</head>
	
	<body>
		
		<div id="conteudo">
			
			<div id="flash">
				<?php
				//print $this->Session->flash();
				print $this->Session->flash('auth');
				?>
			</div>
			
			<?php print $content_for_layout ?>
			
		</div>

	</body>
	
</html>
