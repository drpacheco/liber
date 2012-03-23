<?php
/**
 * Painel utilizado no metodo index dos controladores com ajax.
 */
?>

<div class="botoes">
	<?php 
	$imagem = $this->Html->image('add24x24.png',array('title'=>'Cadastrar','alt'=>'Cadastrar',));
	
	print $this->Ajax->link($imagem, array('action' => 'cadastrar'), array('update' => 'conteudo_ajax','indicator'=>'carregando','escape'=>false),null, false);
	
	print '<a title="Imprimir" onclick="javascript: window.print();" href="#">'.
		$this->Html->image('print24x24.png', array('alt'=>'Imprimir','title'=>'Imprimir')).'</a>';
	?>
</div>