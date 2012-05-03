<script type="text/javascript">
	$(function(){
		$('#conteudo_menus').accordion();
	});
</script>

<div class="conteudo">
	<div style="width: 40%; margin-top: 10px; margin-left: 15px; float: left;">
		<?php print $this->Html->image('logotipo_grande.png',array('alt'=>'Liber','style'=>'width: 100%;')); ?>
	</div>
	
	<div id="conteudo_menus" style="float:left; margin-top: 30px; margin-left: 10%; width: 45%;">
		<h3> <a href="#">Contas a receber</a> </h3>
		<div>
			<?php if (!empty($contasReceber)) print $contasReceber ?>
		</div>

		<h3> <a href="#">Contas a pagar</a> </h3>
		<div>
			<?php if (!empty($contasPagar)) print $contasPagar ?>
		</div>
	</div>
	
	<div class="limpar">&nbsp;</div>
</div>