
<h2 class="descricao_cabecalho">Exibindo as ordens de serviço cadastradas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $paginator->sort('Código','id'); ?></th>
			<th><?php print $paginator->sort('Cadastrada','data_hora_cadastrada'); ?></th>
			<th><?php print $paginator->sort('Cliente','cliente_id'); ?></th>
			<th><?php print $paginator->sort('Usuário cadastrou','usuario_id'); ?></th>
			<th><?php print $paginator->sort('Situação','situacao'); ?></th>
			<th><?php print $paginator->sort('Início','data_hora_inicio'); ?></th>
			<th><?php print $paginator->sort('Fim','data_hora_fim'); ?></th>
			<th><?php print $paginator->sort('Valor bruto','valor_bruto'); ?></th>
			<th><?php print $paginator->sort('Valor líquido','valor_liquido'); ?></th>
			<th colspan="3">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php
foreach ($consulta as $c): ?>
		
		<tr>
			<td><?php print $c['ServicoOrdem']['id'];?></td>
			<td><?php print $html->link($formatacao->dataHora($c['ServicoOrdem']['data_hora_cadastrada']),'editar/' . $c['ServicoOrdem']['id']) ;?></td>
			<td><?php print $c['ServicoOrdem']['cliente_id'].' '.$c['Cliente']['nome']; ?></td>
			<td><?php print $c['ServicoOrdem']['usuario_id'].' '.$c['Usuario']['nome']; ?></td>
			<td><?php print $opcoes_situacao[$c['ServicoOrdem']['situacao']]; ?></td>
			<td><?php print $formatacao->dataHora($c['ServicoOrdem']['data_hora_inicio']); ?></td>
			<td><?php if (!empty($c['ServicoOrdem']['data_hora_fim'])) print $formatacao->dataHora($c['ServicoOrdem']['data_hora_fim']); ?></td>
			<td><?php print $c['ServicoOrdem']['valor_bruto']; ?></td>
			<td><?php print $c['ServicoOrdem']['valor_liquido']; ?></td>
			
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['ServicoOrdem']['id'])) ;?>
			</td>
			
			<td>
				<?php print $this->element('painel_detalhar',array('id'=>$c['ServicoOrdem']['id'])) ;?>
			</td>
			
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['ServicoOrdem']['id'])) ;?>
			</td>
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
