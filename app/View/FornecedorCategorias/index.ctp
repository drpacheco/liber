<h2 class="descricao_cabecalho">Exibindo as categorias de fornecedor</h2>

<?php print $this->element('painel_index'); ?>

	<table class="padrao">
		<thead>
			<tr>
				<th><?php print $this->Paginator->sort('id','Código'); ?></th>
				<th><?php print $this->Paginator->sort('descricao','Descrição'); ?></th>
				<th colspan="2">Ações</th>
			</tr>
		</thead>
		
		<tbody>
			
	<?php foreach ($consulta as $c): ?>
			
			<tr>
				<td><?php print $c['FornecedorCategoria']['id'];?></td>
				<td><?php print $this->Html->link($c['FornecedorCategoria']['descricao'],'editar/' . $c['FornecedorCategoria']['id']) ;?></td>
				<td>
					<?php print $this->element('painel_editar',array('id'=>$c['FornecedorCategoria']['id'])) ;?>
				</td>
				<td>
					<?php print $this->element('painel_excluir',array('id'=>$c['FornecedorCategoria']['id'])) ;?>
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
