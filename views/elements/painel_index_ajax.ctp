<?php
/**
 * Painel utilizado no metodo index dos controladores com ajax.
 */
?>

<div class="botoes">
	<?php 
	$imagem = $html->image('add24x24.png',array('title'=>'Cadastrar','alt'=>'Cadastrar',));
	
	print $ajax->link($imagem, array('action' => 'cadastrar'), array('update' => 'conteudo_ajax','indicator'=>'carregando','escape'=>false),null, false);
	
	print '<a title="Imprimir" onclick="javascript: window.print();" href="#">'.
		$html->image('print24x24.png', array('alt'=>'Imprimir','title'=>'Imprimir')).'</a>';
	?>
</div>