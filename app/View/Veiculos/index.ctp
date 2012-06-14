
<h2 class="descricao_cabecalho">Exibindo os veículos cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('modelo','Modelo'); ?></th>
			<th><?php print $this->Paginator->sort('placa','Placa'); ?></th>
			<th><?php print $this->Paginator->sort('fabricante','Fabricante'); ?></th>
			<th><?php print $this->Paginator->sort('ano','Ano'); ?></th>
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
