<?php
/**
 * Painel utilizado no layout, para exibir informacoes do usuario logado
 */
?>

<div class="painel_usuario_info">
	Usuário: <?php print AuthComponent::user('nome'); ?> &nbsp;&nbsp;&nbsp;&nbsp;
	Empresa: <?php print AuthComponent::user('empresa_id'); ?>
	
</div>
