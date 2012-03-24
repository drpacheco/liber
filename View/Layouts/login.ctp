<?php print $this->Html->docType('html5'); ?>
<html>
	<head>
		<?php
		print $this->Html->charset()."\n";
		print $this->fetch('meta');
		print $this->Html->meta(array('name' => 'robots', 'content' => 'noindex'));
		?>
		<title>
			Liber - login
		</title>
		<?php
			print $this->Html->meta('icon');
			print $this->Html->css('login.css');
			print $this->fetch('css');
			print $this->fetch('script');;
			print $this->Html->script('jquery');
		?>
		
		<script type="text/javascript">
			$(document).ready(function() {
				if ($('#UsuarioLogin').val() == undefined || $('#UsuarioLogin').val() == "") {
					$('#UsuarioLogin').focus();
				}
				else {
					$('#UsuarioSenha').focus();
				}
			});
		</script>
	</head>
	
	<body>
		
		
		<div id="cabecalho">
			
		</div>
		
		<div id="banner">
			&nbsp;
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
		
	</body>
	
</html>
