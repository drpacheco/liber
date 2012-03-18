<?php
// Recebe a variavel $id
// Exibe uma imagem com um link apontando para deletar/$id
// utilizado nas views index e pesquisar

$imagem = $html->image('del24x24.png',array('title'=>"Deletar registro ${id}",'alt'=>"Deletar registro ${id}",));
print $html->link($imagem, array('action' => 'excluir',$id), array('escape'=>false),'Deseja realmente excluir este registro?', false);
?>