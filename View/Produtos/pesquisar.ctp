<h2 class="descricao_cabecalho">Pesquisar produto</h2>

<?php
/**
 * Elimino as divs dos campos input para que nao apareça quais campos
 * sao marcados como obrigatorios no BD, pois aqui isso non ecxiste
 */
print $this->Form->create(null,array('controller'=>'produtos','action'=>'pesquisar','autocomplete'=>'off'));
?>
<div class="divs_grupo_2">
	
	<div class="div1_2">
		<?php
		print '<div>'.$this->Form->input('nome', array('label'=>'Nome','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('categoria_produto_id', array('label'=>'Categoria','div'=>false,'options'=>$opcoes_categoria_produto)).'</div>';
		print '<div>'.$this->Form->input('tipo_produto',array('div'=>false,'label'=>'Tipo','options'=>array(''=>''))).'</div>';
		print '<div>'.$this->Form->input('codigo_ean',array('div'=>false,'label'=>'Código EAN')).'</div>';
		?>
	</div>
	
	<div class="div2_2">
		<?php
		print '<div>'.$this->Form->input('codigo_dun',array('label'=>'Código DUN','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('unidade',array('label'=>'Unidade','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('quantidade_estoque_fiscal',array('label'=>'Qtd. estoque fiscal','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('situacao',array('label'=>'Situação','div'=>false)).'</div>';
		?>
	</div>
	
	<?php
	print $this->Form->end('Pesquisar');	
	?>
	
</div>

<?php if (isset($num_resultados) && $num_resultados > 0) : ?>
	<table class="padrao">
		<thead>
			<tr>
				<th><?php print $this->Paginator->sort('id','Cód'); ?></th>
				<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
				<th><?php print $this->Paginator->sort('categoria_produto_id','Categoria'); ?></th>
				<th><?php print $this->Paginator->sort('tipo_produto','Tipo produto'); ?></th>
				<th><?php print $this->Paginator->sort('preco_custo','Preço de custo'); ?></th>
				<th><?php print $this->Paginator->sort('preco_venda','Preço de venda'); ?></th>
				<th><?php print $this->Paginator->sort('quantidade_estoque_fiscal','Quantidade'); ?></th>
				<th><?php print $this->Paginator->sort('situacao','Situação'); ?></th>
				<th colspan="2">Ações</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($resultados as $r) : ?>
				<tr>
					<td><?php print $r['Produto']['id']; ?></td>
					<td><?php print $this->Html->link($r['Produto']['nome'],'editar/' . $r['Produto']['id']) ;?></td>
					<td><?php print $r['Produto']['categoria_produto_id'].' '.$r['ProdutoCategoria']['nome']; ?></td>
					<td><?php print $r['Produto']['tipo_produto']; ?></td>
					<td><?php print $r['Produto']['preco_custo']; ?></td>
					<td><?php print $r['Produto']['preco_venda']; ?></td>
					<td><?php print $r['Produto']['quantidade_estoque_fiscal']; ?></td>
					<td><?php print $r['Produto']['situacao']; ?></td>
					<td>
						<?php print $this->element('painel_detalhar',array('id'=>$r['Produto']['id'])) ;?>
					</td>
					<td>
						<?php print $this->element('painel_editar',array('id'=>$r['Produto']['id'])) ;?>
					</td>
				</tr>
			<?php endforeach; ?>
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
	
<?php endif; ?>
