
<h2 class="descricao_cabecalho">Exibindo os veículos cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('Código','id'); ?></th>
			<th><?php print $this->Paginator->sort('Modelo','modelo'); ?></th>
			<th><?php print $this->Paginator->sort('Placa','placa'); ?></th>
			<th><?php print $this->Paginator->sort('Fabricante','fabricante'); ?></th>
			<th><?php print $this->Paginator->sort('Ano','ano'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_veiculo as $veiculo): ?>
		
		<tr>
			<td><?php print $veiculo['Veiculo']['id'];?></td>
			<td><?php print $this->Html->link($veiculo['Veiculo']['modelo'],'editar/' . $veiculo['Veiculo']['id']) ;?></td>
			<td><?php print $veiculo['Veiculo']['placa']; ?></td>
			<td><?php print $veiculo['Veiculo']['fabricante']; ?></td>
			<td><?php print $veiculo['Veiculo']['ano']; ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$veiculo['Veiculo']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$veiculo['Veiculo']['id'])) ;?>
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
