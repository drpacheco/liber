
<h2 class="descricao_cabecalho">Exibindo plano de contas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
			<th><?php print $this->Paginator->sort('tipo','Tipo'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_plano_contas as $consulta): ?>
		
		<tr>
			<td><?php print $consulta['PlanoConta']['id'];?></td>
			<td><?php print $this->Html->link($consulta['PlanoConta']['nome'],'editar/' . $consulta['PlanoConta']['id']) ;?></td>
			<td>	<?php print $opcoes[$consulta['PlanoConta']['tipo']]; ?> </td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$consulta['PlanoConta']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$consulta['PlanoConta']['id'])) ;?>
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