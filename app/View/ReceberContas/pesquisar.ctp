<script type="text/javascript">
	var raiz_site = "<?php print $this->Html->url('/',true); ?>/";

	$(function(){
		
		$(".datepicker").datepicker({
			showOn: "button",
			buttonImage: raiz_site+"/img/calendario_icone.gif",
			buttonImageOnly: true
		});
	});
</script>

<h2 class="descricao_cabecalho">Pesquisar conta a receber</h2>

<?php
/**
 * Elimino as divs dos campos input para que nao apareça quais campos
 * sao marcados como obrigatorios no BD, pois aqui isso non ecxiste
 */
print $this->Form->create(null,array('action'=>'pesquisar','autocomplete'=>'off'));
?>
<div class="divs_grupo_2">
	
	<div class="div1_3">
		<?php
		
		print '<div>'.$this->Form->input('numero_documento',array('label'=>'Número do documento','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('valor',array('label'=>'Valor','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('cliente_fornecedor_id',array('label'=>'Código cliente/fornecedor','div'=>false,'type'=>'text')).'</div>';
		?>
	</div>
	
	<div class="div2_3">
		<?php
		print '<div>'.$this->Form->input('data_inicio',array('label'=>'Data inicial','div'=>false,'class'=>'datepicker mascara_data')).'</div>';
		print '<div>'.$this->Form->input('data_fim',array('label'=>'Data final','div'=>false,'class'=>'datepicker mascara_data')).'</div>';
		print '<div>'.$this->Form->input('eh_cliente_ou_fornecedor', array('label'=>'Cliente ou fornecedor?',
		'div'=>false,'options'=>array(''=>'','C'=>'Cliente','F'=>'Fornecedor'))).'</div>';
		?>
	</div>
	
	<div class="div3_3">
		<?php
		print '<div>'.$this->Form->input('id', array('label'=>'Código','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('tipo_documento_id',array('label'=>'Tipo do documento','div'=>false,'options'=>$opcoes_tipo_documento)).'</div>';
		print '<div>'.$this->Form->input('conta_origem',array('label'=>'Conta de origem','div'=>false,'options'=>$opcoes_conta_origem)).'</div>';
		print '<div>'.$this->Form->input('plano_conta_id',array('label'=>'Plano de contas','div'=>false,'options'=>$opcoes_plano_contas)).'</div>';
		$opcoes_situacoes = array_merge(array(''=>''),$opcoes_situacoes);
		print '<div>'.$this->Form->input('situacao',array('label'=>'Situação','div'=>false,'options'=>$opcoes_situacoes)).'</div>';
		?>
	</div>
	
	<?php
	print $this->Form->end('Pesquisar');	
	?>
	
</div>

<?php if (isset($num_resultados) && $num_resultados > 0) : ?>
	<table class="resultados padrao">
		<thead>
			<tr>
				<th><?php print $this->Paginator->sort('Cód','id'); ?></th>
				<th><?php print $this->Paginator->sort('Cliente ou fornecedor?','eh_cliente_ou_fornecedor'); ?></th>
				<th><?php print $this->Paginator->sort('Cliente/fornecedor','cliente_fornecedor_id'); ?></th>
				<th><?php print $this->Paginator->sort('Tipo documento','tipo_documento_id'); ?></th>
				<th><?php print $this->Paginator->sort('Número documento','numero_documento'); ?></th>
				<th><?php print $this->Paginator->sort('Valor','valor'); ?></th>
				<th><?php print $this->Paginator->sort('Conta origem','conta_origem'); ?></th>
				<th><?php print $this->Paginator->sort('Plano de contas','plano_conta_id'); ?></th>
				<th colspan="2">Ações</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($resultados as $r) :
				if (strtoupper($r['ReceberConta']['eh_cliente_ou_fornecedor']) == 'C') $tipo='cliente';
				else $tipo='fornecedor';
				?>
				<tr>
					<td><?php print $r['ReceberConta']['id']; ?></td>
					<td><?php print ucfirst($tipo); ?></td>
					<td>
						<?php
						if ($tipo == 'cliente') print $this->Html->link($r['Cliente']['nome'],'editar/' . $r['ReceberConta']['id']) ;
						else if ($tipo == 'fornecedor') print $this->Html->link($r['Fornecedor']['nome'],'editar/' . $r['ReceberConta']['id']) ;
						?>
					</td>
					<td><?php print $r['ReceberConta']['tipo_documento_id'].' '.$r['TipoDocumento']['nome']; ?></td>
					<td><?php print $r['ReceberConta']['numero_documento']; ?></td>
					<td><?php print $r['ReceberConta']['valor'] ?></td>
					<td><?php print $r['ReceberConta']['conta_origem'].' '.$r['Conta']['nome'] ?></td>
					<td><?php print $r['ReceberConta']['plano_conta_id'].' '.$r['PlanoConta']['nome'] ; ?></td>
					<td>
						<?php print $this->element('painel_editar',array('id'=>$r['ReceberConta']['id'])) ;?>
					</td>
					<td>
						<?php print $this->element('painel_excluir',array('id'=>$r['ReceberConta']['id'])) ;?>
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
