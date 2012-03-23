
<h2 class="descricao_cabecalho">Exibindo todos os tipos de documentos cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('Código','id'); ?></th>
			<th><?php print $this->Paginator->sort('Nome','nome'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_tipo_documento as $consulta): ?>
		
		<tr>
			
			<td><?php print $consulta['TipoDocumento']['id'];?></td>
			<td><?php print $this->Html->link($consulta['TipoDocumento']['nome'],'editar/' . $consulta['TipoDocumento']['id']) ;?></td>
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
print $this->Paginator->counter(array(
	'format' => 'Exibindo %current% registros de um total de %count% registros. Página %page% de %pages%.'
)); 

print '<br/>';

print $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

?>
