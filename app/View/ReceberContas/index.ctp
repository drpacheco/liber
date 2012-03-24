<h2 class="descricao_cabecalho">Exibindo as contas a receber</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('eh_cliente_ou_fornecedor','Cliente ou fornecedor?'); ?></th>
			<th><?php print $this->Paginator->sort('cliente_fornecedor_id','Cliente / fornecedor'); ?></th>
			<th><?php print $this->Paginator->sort('tipo_documento_id','Documento'); ?></th>
			<th><?php print $this->Paginator->sort('numero_documento','N. documento'); ?></th>
			<th><?php print $this->Paginator->sort('valor','Valor'); ?></th>
			<th><?php print $this->Paginator->sort('situacao','Situação'); ?></th>
			<th><?php print $this->Paginator->sort('plano_conta_id','Plano de contas'); ?></th>
			<th><?php print $this->Paginator->sort('data_vencimento','Vencimento'); ?></th>
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
			<td><?php print ucfirst($tipo); ?></td>
			<td>
				<?php
				print $c['ReceberConta']['cliente_fornecedor_id'].' ';
				if ($tipo == 'cliente') print $this->Html->link($c['Cliente']['nome'],'editar/'.$c['ReceberConta']['id']);
				else if ($tipo == 'fornecedor') print $this->Html->link($c['Fornecedor']['nome'],'editar/'.$c['ReceberConta']['id']);
				?>
			</td>
			<td><?php print $c['ReceberConta']['tipo_documento_id'].' '.$c['TipoDocumento']['nome']; ?></td>
			<td><?php print $c['ReceberConta']['numero_documento']; ?></td>
			<td><?php print $c['ReceberConta']['valor']; ?></td>
			<td><?php print $opcoes_situacoes[$c['ReceberConta']['situacao']] ?></td>
			<td><?php print $c['ReceberConta']['plano_conta_id'].' '.$c['PlanoConta']['nome']; ?></td>
			<td><?php print $this->Formatacao->data($c['ReceberConta']['data_vencimento']); ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['ReceberConta']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['ReceberConta']['id'])) ;?>
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