
<h2 class="descricao_cabecalho">Exibindo as empresas cadastradas</h2>

<?php print $this->element('painel_index'); ?>

<table class="padrao">
	<thead>
		<tr>
			<th><?php print $this->Paginator->sort('id','Código'); ?></th>
			<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
			<th><?php print $this->Paginator->sort('cnpj','CNPJ'); ?></th>
			<th><?php print $this->Paginator->sort('logradouro','Logroudouro'); ?></th>
			<th><?php print $this->Paginator->sort('numero','Número'); ?></th>
			<th><?php print $this->Paginator->sort('bairro','Bairro'); ?></th>
			<th><?php print $this->Paginator->sort('complemento','Complemento'); ?></th>
			<th><?php print $this->Paginator->sort('cidade','Cidade'); ?></th>
			<th><?php print $this->Paginator->sort('estado','Estado'); ?></th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php foreach ($consulta_empresa as $c): ?>
		
		<tr>
			<td><?php print $c['Empresa']['id'];?></td>
			<td><?php print $this->Html->link($c['Empresa']['nome'],'editar/' . $c['Empresa']['id']) ;?></td>
			<td> <?php print $c['Empresa']['cnpj']; ?> </td>
			<td><?php print $c['Empresa']['logradouro']; ?></td>
			<td><?php print $c['Empresa']['numero']; ?></td>
			<td><?php print $c['Empresa']['bairro']; ?></td>
			<td><?php print $c['Empresa']['complemento']; ?></td>
			<td><?php print $c['Empresa']['cidade']; ?></td>
			<td><?php print $c['Empresa']['estado']; ?></td>
			<td>
				<?php print $this->element('painel_editar',array('id'=>$c['Empresa']['id'])) ;?>
			</td>
			<td>
				<?php print $this->element('painel_excluir',array('id'=>$c['Empresa']['id'])) ;?>
			</td>
		</tr>

<?php endforeach ?>

	</tbody>
</table>

<?php
$this->Paginator->options (array (
	'update' => '#conteudo',
	'before' => $this->Js->get('.indicador_carregando')->effect('fadeIn', array('buffer' => false)),
	'complete' => $this->Js->get('.indicador_carregando')->effect('fadeOut', array('buffer' => false)),
));

print $this->Paginator->prev('« Anterior ', null, null, array('class' => 'disabled'));
print $this->Paginator->next(' Próximo »', null, null, array('class' => 'disabled'));

print '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

print $this->Paginator->counter(array(
	'format' => 'Página %page% de %pages%. Total de %count% registros.'
)); 
?>
