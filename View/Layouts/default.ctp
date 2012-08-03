<?php print $this->Html->docType('html5'); ?>
<html>
	<head>
		<?php print $this->Html->charset()."\n"; ?>
		<noscript>
			<meta http-equiv="refresh" content="0; URL=<?php print $this->Html->url('/',true); ?>sistema/noscript" />
		</noscript>
		<?php print $this->fetch('meta'); ?>
		<title>
			<?php print 'Liber - '.$title_for_layout."\n"; ?>
		</title>
		<?php
		print $this->Html->meta('icon');
		print $this->Html->css('estilo.css');
		print $this->fetch('css');
		print $this->Html->css('jquery-ui/jquery-ui.css');
		print '<script type="text/javascript">';
		print 'var site_raiz = "'.$this->Html->url('/',true).'";';
		print '</script>';
		print $this->Html->script('jquery');
		print $this->Html->script('funcoes');
		print $this->Html->script('auxiliares');
		?>
	</head>
	
	<body>
		
		<div id="cabecalho">
			<div id="menu" name="menu">
				<?php print $this->element('menu'); ?>
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
		
		</div>
		
		<div id="rodape">
			<span class="texto_label">Usuário</span>: <?php print AuthComponent::user('nome'); ?> &nbsp;&nbsp;&nbsp;&nbsp;
			<span class="texto_label">Empresa</span>: <?php print AuthComponent::user('empresa_nome');  ?>

			<span style="float: right;">
				<a style="text-decoration: none" href="#menu">Topo &uarr;</a>
			</span>

			<div class="indicador_carregando" style="float: right; display: none; margin-right: 5px;">
				<?php print $this->Html->image('carregando3.gif',array('alt'=>'Carregando','title'=>'Carregando')); ?>
			</div>
		</div>
		
		<?php 
		print $this->Html->script('menu.hoverIntent');
		print $this->Html->script('menu.superfish');?>
		<script type="text/javascript">
			$(document).ready(function(){ 
				$("ul.sf-menu").superfish({ 
					delay:     0
				}); 
			}); 
		</script>
		<?php
		print $this->Html->script('jquery-ui');
		print $this->Html->script('mascaras');
		print $this->fetch('script');
		print $this->Js->writeBuffer();
		?>
		
		<div id="liber_log">
			<?php
			// Substituido pelo Cake DebugKitToolbar
			//print $this->element('sql_dump');
			?>
		</div>
	</body>
	
</html>
