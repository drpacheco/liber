<?php
print $this->Html->script('formatar_moeda');
?>

<script type="text/javascript">
	$(function(){
		$(".datepicker").datepicker({
			showOn: "button",
			buttonImage: "<?php print $this->Html->url('/',true); ?>/img/calendario_icone.gif",
			buttonImageOnly: true
		});
	
		$('#PedidoVendaValorTotal').priceFormat();
		
		//pesquisa cliente
		//autocomplete
		$("#PedidoVendaClienteNome").autocomplete({
			source: "<?php print $this->Html->url('/',true); ?>/Clientes/pesquisaAjaxCliente/nome",
			minLength: 3,
			select: function(event, ui) {
				$("#PedidoVendaClienteId").val(ui.item.id);
				$('#PedidoVendaClienteNome').val(ui.item.nome);
			}
		});
		// ao digitar o codigo
		$('#PedidoVendaClienteId').blur(function(){
			codigo = $(this).val();
			if (codigo == null || codigo == '') return null;
			$.getJSON('<?php print $this->Html->url('/',true); ?>/Clientes/pesquisaAjaxCliente/codigo', {'term': codigo}, function(data) {
				if (data == null) {
					alert ('Cliente com o código '+codigo+' não foi encontrado!');
					$('#PedidoVendaClienteNome').val('');
					$("#PedidoVendaClienteId")
						.val('')
						.focus();
				}
				else { //encontrou resultados
					data = data[0];
					$("#PedidoVendaClienteId").val(data.id);
					$('#PedidoVendaClienteNome').val(data.nome);
				}
			});
		});

	});
</script>

<h2 class="descricao_cabecalho">Pesquisar pedido de venda</h2>

<?php
/**
 * Elimino as divs dos campos input para que nao apareça quais campos
 * sao marcados como obrigatorios no BD
 */

print $this->Form->create(null,array('controller'=>'pedidoVendas','action'=>'pesquisar','autocomplete'=>'off'));
?>
<div class="divs_grupo_2">
	
	<div class="div1_2">
		<div>
			<label>Código</label>
			<input id="PedidoVendaId" type="text" name="data[PedidoVenda][id]" class="" />
		</div>
		<div>
			<label style="">Cliente</label>
			<input style="float:left; width: 10%;" id="PedidoVendaClienteId" type="text" name="data[PedidoVenda][cliente_id]" />
			<input style="margin-left: 1%; width: 80%" id="PedidoVendaClienteNome" type="text" name="data[PedidoVenda][cliente_nome]" />
		</div>
		<div>
			<label>Cadastrado em</label>
			<input id="PedidoVendaDataHoraCadastrado" type="text" name="data[PedidoVenda][data_hora_cadastrado]" class="datepicker mascara_data" />
		</div>
		<div>
			<label>Valor total</label>
			<input type="text" id="PedidoVendaValorTotal" name="data[PedidoVenda][valor_total]"/>
		</div>
	</div>
	
	<div class="div2_2">
		<div>
			<?php
			$opcoes_situacoes = array_merge(array('0'=>''),$opcoes_situacoes);
			print $this->Form->label('situacao','Situacao',array('class'=>'norequired'));
				print $this->Form->input('situacao', array(
				'div'=>false,
				'label'=>false,
				'options'=>$opcoes_situacoes,
			));
			?>
		</div>
		<div>
			<?php
			$opcoes_usuarios = array_merge (array('0'=>''),$opcoes_usuarios);
			print $this->Form->label('usuario_cadastrou','Usuário cadastrou',array('class'=>'norequired'));
				print $this->Form->input('usuario_cadastrou', array(
				'div'=>false,
				'label'=>false,
				'options'=>$opcoes_usuarios,
			));
			?>
		</div>
	</div>
	
</div>
<div class="limpar">&nbsp;</div>
<?php print $this->Form->end('Pesquisar'); ?>

<?php if (isset($num_resultados) && $num_resultados > 0) : ?>
	<table class="padrao">
		<thead>
			<tr>
				<th><?php print $this->Paginator->sort('id','Cód'); ?></th>
				<th><?php print $this->Paginator->sort('data_hora_cadastrado','Cadastrada em'); ?></th>
				<th><?php print $this->Paginator->sort('cliente_id','Cliente'); ?></th>
				<th><?php print $this->Paginator->sort('situacao','Situação'); ?></th>
				<th><?php print $this->Paginator->sort('valor_liquido','Valor total'); ?></th>
				<th colspan="3">Ações</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($resultados as $r): ?>
				<tr>
					<td><?php print $r['PedidoVenda']['id']; ?></td>
					<td><?php print $this->Html->link($this->Formatacao->dataHora($r['PedidoVenda']['data_hora_cadastrado']),'editar/' . $r['PedidoVenda']['id']) ;?></td>
					<td><?php print $r['PedidoVenda']['cliente_id'].' '.$r['Cliente']['nome']; ?></td>
					<td><?php print $opcoes_situacoes[$r['PedidoVenda']['situacao']]; ?></td>
					<td><?php print $r['PedidoVenda']['valor_liquido']; ?></td>
					<td>
						<?php print $this->element('painel_detalhar',array('id'=>$r['PedidoVenda']['id'])) ;?>
					</td>
					<td>
						<?php print $this->element('painel_editar',array('id'=>$r['PedidoVenda']['id'])) ;?>
					</td>
					<td>
						<?php print $this->element('painel_excluir',array('id'=>$r['PedidoVenda']['id'])) ;?>
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
