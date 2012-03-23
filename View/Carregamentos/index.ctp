
<h2 class="descricao_cabecalho">Exibindo os carregamentos cadastrados</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('Código','id'); ?></th>
			<th><?php print $this->Paginator->sort('Criado em','data_hora_criado'); ?></th>
			<th><?php print $this->Paginator->sort('Descrição','descricao'); ?></th>
			<th><?php print $this->Paginator->sort('Situação','situacao'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta as $carregamento): ?>
		
		<tr>
			<td><?php print $carregamento['Carregamento']['id'];?></td>
			<td><?php print $this->Html->link($this->Formatacao->dataHora($carregamento['Carregamento']['data_hora_criado']),'detalhar/' . $carregamento['Carregamento']['id']) ;?></td>
			<td><?php print $carregamento['Carregamento']['descricao']; ?></td>
			<td><?php print $opcoes_situacoes[$carregamento['Carregamento']['situacao']]; ?></td>
			<td>
				<?php print $this->element('painel_detalhar',array('id'=>$carregamento['Carregamento']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$carregamento['Carregamento']['id'])) ;?>
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
