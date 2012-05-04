
<h2 class="descricao_cabecalho">Exibindo todos os produtos cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
			<th><?php print $this->Paginator->sort('produto_categoria_id','Categoria'); ?></th>
			<th><?php print $this->Paginator->sort('preco_custo','Preço de custo'); ?></th>
			<th><?php print $this->Paginator->sort('preco_venda','Preço de venda'); ?></th>
			<th><?php print $this->Paginator->sort('margem_lucro','Margem de lucro'); ?></th>
			<th><?php print $this->Paginator->sort('quantidade_estoque_fiscal','Quantidade estoque fiscal'); ?></th>
			<th><?php print $this->Paginator->sort('quantidade_estoque_nao_fiscal','Quantidade estoque não fiscal'); ?></th>
			<th colspan="1">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta as $c): ?>
		
		<tr>
			<td><?php print $c['Produto']['id'];?></td>
			<td><?php print $this->Html->link($c['Produto']['nome'],'editar/' . $c['Produto']['id']) ;?></td>
			<td><?php print $c['ProdutoCategoria']['nome']; ?></td>
			<td><?php print $c['Produto']['preco_custo']; ?></td>
			<td><?php print $c['Produto']['preco_venda']; ?></td>
			<td><?php print $c['Produto']['margem_lucro']; ?></td>
			<td><?php print $c['Produto']['quantidade_estoque_fiscal']; ?></td>
			<td><?php print $c['Produto']['quantidade_estoque_nao_fiscal']; ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['Produto']['id'])) ;?>
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
