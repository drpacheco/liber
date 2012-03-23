
<h2 class="descricao_cabecalho">Exibindo plano de contas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('Código','id'); ?></th>
			<th><?php print $this->Paginator->sort('Nome','nome'); ?></th>
			<th><?php print $this->Paginator->sort('Tipo','tipo'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_plano_contas as $consulta): ?>
		
		<tr>
			<td><?php print $consulta['PlanoConta']['id'];?></td>
			<td><?php print $this->Html->link($consulta['PlanoConta']['nome'],'editar/' . $consulta['PlanoConta']['id']) ;?></td>
			<td>
				<?php
				switch ($consulta['PlanoConta']['tipo']) {
					case 'R':
						print 'Receitas';
						break;
					case 'D':
						print 'Despesas';
						break;
					case 'E':
						print 'Especiais';
						break;
					default:
						print 'Não informado';
						break;
				}
				?>
			</td>
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
print $this->Paginator->counter(array(
	'format' => 'Exibindo %current% registros de um total de %count% registros. Página %page% de %pages%.'
)); 

print '<br/>';

print $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

?>
