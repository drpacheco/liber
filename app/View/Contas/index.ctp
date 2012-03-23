
<h2 class="descricao_cabecalho">Exibindo as contas cadastradas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('Código','id'); ?></th>
			<th><?php print $this->Paginator->sort('Nome','nome'); ?></th>
			<th><?php print $this->Paginator->sort('Apelido','apelido'); ?></th>
			<th><?php print $this->Paginator->sort('Banco','banco'); ?></th>
			<th><?php print $this->Paginator->sort('Agência','agencia'); ?></th>
			<th><?php print $this->Paginator->sort('Conta','conta'); ?></th>
			<th><?php print $this->Paginator->sort('Titular','titular'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_conta as $conta): ?>
		
		<tr>
			<td><?php print $conta['Conta']['id'];?></td>
			<td><?php print $this->Html->link($conta['Conta']['nome'],'editar/' . $conta['Conta']['id']) ;?></td>
			<td><?php print $conta['Conta']['apelido']; ?></td>
			<td><?php print $conta['Conta']['banco']; ?></td>
			<td><?php print $conta['Conta']['agencia']; ?></td>
			<td><?php print $conta['Conta']['conta']; ?></td>
			<td><?php print $conta['Conta']['titular']; ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$conta['Conta']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$conta['Conta']['id'])) ;?>
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
