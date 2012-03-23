
<h2 class="descricao_cabecalho">Exibindo as contas a pagar</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('Código','id'); ?></th>
			<th><?php print $this->Paginator->sort('Cliente ou fornecedor?','eh_cliente_ou_fornecedor'); ?></th>
			<th><?php print $this->Paginator->sort('Cliente / fornecedor','cliente_fornecedor_id'); ?></th>
			<th><?php print $this->Paginator->sort('Documento','tipo_documento_id'); ?></th>
			<th><?php print $this->Paginator->sort('N. documento','numero_documento'); ?></th>
			<th><?php print $this->Paginator->sort('Valor','valor'); ?></th>
			<th><?php print $this->Paginator->sort('Situação','situacao'); ?></th>
			<th><?php print $this->Paginator->sort('Plano de contas','plano_conta_id'); ?></th>
			<th><?php print $this->Paginator->sort('Vencimento','data_vencimento'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_conta_pagar as $c):
	if (strtoupper($c['PagarConta']['eh_cliente_ou_fornecedor']) == 'C') $tipo = 'cliente';
	else $tipo = 'fornecedor';
?>
		
		<tr>
			<td><?php print $c['PagarConta']['id'];?></td>
			<td><?php print ucfirst($tipo); ?></td>
			<td>
				<?php
				print $c['PagarConta']['cliente_fornecedor_id'].' ';
				if ($tipo == 'cliente') print $this->Html->link($c['Cliente']['nome'],'editar/'.$c['PagarConta']['id']);
				else if ($tipo == 'fornecedor') print $this->Html->link($c['Fornecedor']['nome'],'editar/'.$c['PagarConta']['id']);
				?>
			</td>
			<td><?php print $c['PagarConta']['tipo_documento_id'].' '.$c['TipoDocumento']['nome']; ?></td>
			<td><?php print $c['PagarConta']['numero_documento']; ?></td>
			<td><?php print $c['PagarConta']['valor']; ?></td>
			<td><?php print $opcoes_situacoes[$c['PagarConta']['situacao']] ?></td>
			<td><?php print $c['PagarConta']['plano_conta_id'].' '.$c['PlanoConta']['nome']; ?></td>
			<td><?php print $this->Formatacao->data($c['PagarConta']['data_vencimento']); ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['PagarConta']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['PagarConta']['id'])) ;?>
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
