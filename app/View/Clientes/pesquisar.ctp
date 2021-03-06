<script type="text/javascript">
		$(function(){
			//pesquisa cliente
			
			//autocomplete
			$("#ClienteNome").autocomplete({
				source: "<?php print $this->Html->url('/',true); ?>/Clientes/pesquisaAjaxCliente/nome",
				minLength: 3,
				select: function(event, ui) {
					$("#ClienteId").val(ui.item.id);
					$('#ClienteNome').val(ui.item.nome);
				}
			});
			// ao digitar o codigo
			$('#ClienteId').blur(function(){
				codigo = $(this).val();
				if (codigo == null || codigo == '') return null;
				$.getJSON('<?php print $this->Html->url('/',true); ?>/Clientes/pesquisaAjaxCliente/codigo', {'term': codigo}, function(data) {
					if (data == null) {
						alert ('Cliente com o código '+codigo+' não foi encontrado!');
						$('#ClienteNome').val('');
						$("#ClienteId")
							.val('')
							.focus();
					}
					else { //encontrou resultados
						data = data[0];
						$("#ClienteId").val(data.id);
						$('#ClienteNome').val(data.nome);
					}
				});
			});
		});
</script>
<h2 class="descricao_cabecalho">Pesquisar cliente</h2>

<?php
/**
 * Elimino as divs dos campos input para que nao apareça quais campos
 * sao marcados como obrigatorios no BD
 */
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('','post',array('autocomplete'=>'off','model'=>'Cliente','update'=>'conteudo_ajax'));
}
else {
	print $this->Form->create(null,array('controller'=>'clientes','action'=>'pesquisar','autocomplete'=>'off'));
}
?>
<div class="divs_grupo_2">
	
	<div class="div1_2">
		<div>
			<label style="">Código / nome</label>
			<input style="float:left; width: 10%;" id="ClienteId" type="text" name="data[Cliente][id]" />
			<input style="margin-left: 1%; width: 80%" id="ClienteNome" type="text" name="data[Cliente][nome]" />
		</div>
		<?php
		print '<div>'.$this->Form->input('nome_fantasia', array('label'=>'Nome fantasia','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('bairro',array('div'=>false)).'</div>';
		print '<div>'.$this->Form->input('cidade',array('div'=>false)).'</div>';
		?>
	</div>
	
	<div class="div2_2">
		<?php
		print '<div>'.$this->Form->input('cnpj',array('label'=>'CNPJ','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('inscricao_estadual',array('label'=>'Inscrição estadual','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('cpf',array('label'=>'CPF','div'=>false)).'</div>';
		print '<div>'.$this->Form->input('rg',array('label'=>'RG','div'=>false)).'</div>';
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
				<th><?php print $this->Paginator->sort('id','Cód'); ?></th>
				<th><?php print $this->Paginator->sort('tipo_pessoa','Pessoa'); ?></th>
				<th><?php print $this->Paginator->sort('nome','Nome'); ?></th>
				<th><?php print $this->Paginator->sort('nome_fantasia','Nome fantasia'); ?></th>
				<th><?php print $this->Paginator->sort('cidade','Cidade'); ?></th>
				<th>CPF/CNPJ</th>
				<th>RG/IE</th>
				<th><?php print $this->Paginator->sort('Usuário cadastrou','usuario_cadastrou'); ?></th>
				<th colspan="2">Ações</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($resultados as $r) : ?>
				<tr>
					<td><?php print $r['Cliente']['id']; ?></td>
					<td><?php print $r['Cliente']['tipo_pessoa']; ?></td>
					<td><?php print $this->Html->link($r['Cliente']['nome'],'editar/' . $r['Cliente']['id']) ;?></td>
					<td><?php print $r['Cliente']['nome_fantasia']; ?></td>
					<td><?php print $r['Cliente']['cidade']; ?></td>
					<td><?php print $r['Cliente']['cpf'].$r['Cliente']['cnpj']; ?></td>
					<td><?php print $r['Cliente']['rg'].$r['Cliente']['inscricao_estadual']; ?></td>
					<td><?php print $r['Usuario']['login']; ?></td>
					<td>
						<?php print $this->element('painel_detalhar',array('id'=>$r['Cliente']['id'])) ;?>
					</td>
					<td>
						<?php print $this->element('painel_editar',array('id'=>$r['Cliente']['id'])) ;?>
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
