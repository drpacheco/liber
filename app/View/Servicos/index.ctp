
<h2 class="descricao_cabecalho">Exibindo os serviços cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
			<th><?php print $this->Paginator->sort('servico_categoria_id','Categoria'); ?></th>
			<th><?php print $this->Paginator->sort('valor','Valor'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta as $c): ?>
		
		<tr>
			<td><?php print $c['Servico']['id'];?></td>
			<td><?php print $this->Html->link($c['Servico']['nome'],'editar/' . $c['Servico']['id']) ;?></td>
			<td><?php print $c['Servico']['servico_categoria_id'].' '.$c['ServicoCategoria']['nome']; ?></td>
			<td><?php print $c['Servico']['valor']; ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['Servico']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['Servico']['id'])) ;?>
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
