
<h2 class="descricao_cabecalho">Exibindo todas as contas a receber</h2>

<?php print $this->element('painel_index'); ?>

<table>
	<thead>
		<tr>
			<th><?php print $paginator->sort('Código','id'); ?></th>
			<th><?php print $paginator->sort('Cadastrada em','data_hora_cadastrada'); ?></th>
			<th><?php print $paginator->sort('É fiscal?','eh_fiscal'); ?></th>
			<th><?php print $paginator->sort('Cliente ou fornecedor?','eh_cliente_ou_fornecedor'); ?></th>
			<th><?php print $paginator->sort('Cliente/fornecedor','cliente_fornecedor_id'); ?></th>
			<th><?php print $paginator->sort('Tipo documento','tipo_documento_id'); ?></th>
			<th><?php print $paginator->sort('Número documento','numero_documento'); ?></th>
			<th><?php print $paginator->sort('Valor','valor'); ?></th>
			<th><?php print $paginator->sort('Conta origem','conta_origem'); ?></th>
			<th><?php print $paginator->sort('Plano de contas','plano_conta_id'); ?></th>
			<th><?php print $paginator->sort('Data do vencimento','data_vencimento'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_conta_receber as $c):
	if (strtoupper($c['ReceberConta']['eh_cliente_ou_fornecedor']) == 'C') $tipo = 'cliente';
	else $tipo = 'fornecedor';
?>
		
		<tr>
			<td><?php print $c['ReceberConta']['id'];?></td>
			<td><?php print $html->link($formatacao->dataHora($c['ReceberConta']['data_hora_cadastrada']),'editar/' . $c['ReceberConta']['id']) ;?></td>
			<td>
				<?php
				if ($c['ReceberConta']['eh_fiscal'] == 1) print 'Sim';
				else print 'Não';
				?>
			</td>
			<td><?php print ucfirst($tipo); ?></td>
			<td>
				<?php
				print $c['ReceberConta']['cliente_fornecedor_id'].' ';
				if ($tipo == 'cliente') print $c['Cliente']['nome'];
				else if ($tipo == 'fornecedor') print $c['Fornecedor']['nome'];
				?>
			</td>
			<td><?php print $c['ReceberConta']['tipo_documento_id'].' '.$c['TipoDocumento']['nome']; ?></td>
			<td><?php print $c['ReceberConta']['numero_documento']; ?></td>
			<td><?php print $c['ReceberConta']['valor']; ?></td>
			<td><?php print $c['ReceberConta']['conta_origem'].' '.$c['Conta']['apelido']; ?></td>
			<td><?php print $c['ReceberConta']['plano_conta_id'].' '.$c['PlanoConta']['nome']; ?></td>
			<td><?php print $formatacao->data($c['ReceberConta']['data_vencimento']); ?></td>
			<td>
				<?php print '<a title="Excluir" onclick="javascript: return confirm(\'Deseja realmente excluir este registro?\')"
				href="'.$html->url(array('action'=>'excluir')).'/'.$c['ReceberConta']['id'].'">'.
				$html->image('del24x24.png', array('alt'=>'Excluir'))
				.'</a>';?>
			</td>
			<td><?php print $html->image('edit24x24.png',array('title'=>'Editar',
			'alt'=>'Editar','url'=>array('action'=>'editar',$c['ReceberConta']['id']))) ?></td>
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