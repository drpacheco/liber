
<h2 class="descricao_cabecalho">Exibindo os pedidos de venda</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('cliente_id','Cliente'); ?></th>
			<th><?php print $this->Paginator->sort('forma_pagamento_id','Forma de pagamento'); ?></th>
			<th><?php print $this->Paginator->sort('data_venda','Data venda'); ?></th>
			<th><?php print $this->Paginator->sort('valor_bruto','Valor bruto'); ?></th>
			<th><?php print $this->Paginator->sort('valor_liquido','Valor líquido'); ?></th>
			<th><?php print $this->Paginator->sort('situacao','Situação'); ?></th>
			<th colspan="3">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php

foreach ($consulta as $c): ?>
		
		<tr>
			<td><?php print $c['PedidoVenda']['id'];?></td>
			<td><?php print $c['PedidoVenda']['cliente_id'].' '.$c['Cliente']['nome']; ?></td>
			<td><?php print $c['PedidoVenda']['forma_pagamento_id'].' '.$c['FormaPagamento']['nome']; ?></td>
			<td><?php if(isset($c['PedidoVenda']['data_venda']) && ($c['PedidoVenda']['data_venda'] != '0000-00-00') ) print $this->Formatacao->data($c['PedidoVenda']['data_venda']); ?></td>
			<td><?php print $c['PedidoVenda']['valor_bruto']; ?></td>
			<td><?php print $c['PedidoVenda']['valor_liquido']; ?></td>
			<td><?php print $opcoes_situacoes[$c['PedidoVenda']['situacao']]; ?></td>
			
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['PedidoVenda']['id'])) ;?>
			</td>
			
			<td>
				<?php print $this->element('painel_detalhar',array('id'=>$c['PedidoVenda']['id'])) ;?>
			</td>
			
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['PedidoVenda']['id'])) ;?>
			</td>
		</tr>

<?php endforeach; ?>

	</tbody>
</table>

<?php
$this->Paginator->options (array (
	'update' => '#conteudo',
	'before' => $this->Js->get('.indicador_carregando')->effect('fadeIn', array('buffer' => false)),
	'complete' => $this->Js->get('.indicador_carregando')->effect('fadeOut', array('buffer' => false)),
));

print $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

print $this->Paginator->counter(array(
	'format' => 'Página %page% de %pages%. Total de %count% registros.'
)); 
?>
