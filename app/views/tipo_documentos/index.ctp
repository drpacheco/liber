
<h2 class="descricao_cabecalho">Exibindo todos os tipos de documentos cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $paginator->sort('Código','id'); ?></th>
			<th><?php print $paginator->sort('Nome','nome'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_tipo_documento as $consulta): ?>
		
		<tr>
			
			<td><?php print $consulta['TipoDocumento']['id'];?></td>
			<td><?php print $html->link($consulta['TipoDocumento']['nome'],'editar/' . $consulta['TipoDocumento']['id']) ;?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$consulta['TipoDocumento']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$consulta['TipoDocumento']['id'])) ;?>
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
