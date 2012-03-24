
<h2 class="descricao_cabecalho">Exibindo todos as formas de pagamento cadastradas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
			<th><?php print $this->Paginator->sort('conta_pricipal','Conta principal'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_forma_pagamento as $consulta): ?>
		
		<tr>
			<td><?php print $consulta['FormaPagamento']['id'];?></td>
			<td><?php print $this->Html->link($consulta['FormaPagamento']['nome'],'editar/' . $consulta['FormaPagamento']['id']) ;?></td>
			<td><?php print $consulta['FormaPagamento']['conta_principal'].' '.
			$consulta['Conta']['nome']; ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$consulta['FormaPagamento']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$consulta['FormaPagamento']['id'])) ;?>
			</td>
		</tr>

<?php endforeach ?>

	</tbody>
</table>

<?php
print $this->Paginator->counter(array(
	'format' => 'Exibindo %current% registros de um total de %count% registros. Página %page% de %pages%.'
)); 

print '<br/>';

print $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

?>
