
<h2 class="descricao_cabecalho">Exibindo as categorias de cliente</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $paginator->sort('Código','id'); ?></th>
			<th><?php print $paginator->sort('Descrição','descricao'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta as $c): ?>
		
		<tr>
			<td><?php print $c['ClienteCategoria']['id'];?></td>
			<td><?php print $ajax->link($c['ClienteCategoria']['descricao'],'editar/' . $c['ClienteCategoria']['id'],array('update' => 'conteudo_ajax','indicator'=>'carregando')) ;?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['ClienteCategoria']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['ClienteCategoria']['id'])) ;?>
			</td>
		</tr>

<?php endforeach ?>

	</tbody>
</table>

<?php
print $paginator->counter(array(
	'format' => 'Exibindo %current% registros de um total de %count% registros. Página %page% de %pages%.'
)); 

print '<br/>';

print $paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

?>
