
<h2 class="descricao_cabecalho">Exibindo as ordens de serviço cadastradas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('data_hora_cadastrada','Cadastrada'); ?></th>
			<th><?php print $this->Paginator->sort('cliente_id','Cliente'); ?></th>
			<th><?php print $this->Paginator->sort('usuario_id','Usuário cadastrou'); ?></th>
			<th><?php print $this->Paginator->sort('situacao','Situação'); ?></th>
			<th><?php print $this->Paginator->sort('data_hora_inicio','Início'); ?></th>
			<th><?php print $this->Paginator->sort('data_hora_fim','Fim'); ?></th>
			<th><?php print $this->Paginator->sort('valor_bruto','Valor bruto'); ?></th>
			<th><?php print $this->Paginator->sort('valor_liquido','Valor líquido'); ?></th>
			<th colspan="3">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php
foreach ($consulta as $c): ?>
		
		<tr>
			<td><?php print $c['ServicoOrdem']['id'];?></td>
			<td><?php print $this->Html->link($this->Formatacao->dataHora($c['ServicoOrdem']['data_hora_cadastrada']),'editar/' . $c['ServicoOrdem']['id']) ;?></td>
			<td><?php print $c['ServicoOrdem']['cliente_id'].' '.$c['Cliente']['nome']; ?></td>
			<td><?php print $c['ServicoOrdem']['usuario_id'].' '.$c['Usuario']['nome']; ?></td>
			<td><?php print $opcoes_situacao[$c['ServicoOrdem']['situacao']]; ?></td>
			<td><?php print $this->Formatacao->dataHora($c['ServicoOrdem']['data_hora_inicio']); ?></td>
			<td><?php if (!empty($c['ServicoOrdem']['data_hora_fim'])) print $this->Formatacao->dataHora($c['ServicoOrdem']['data_hora_fim']); ?></td>
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
print $this->Paginator->counter(array(
	'format' => 'Exibindo %current% registros de um total de %count% registros. Página %page% de %pages%.'
)); 

print '<br/>';

print $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

?>
