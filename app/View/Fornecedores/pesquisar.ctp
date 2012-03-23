<script type="text/javascript">
		$(function(){
			//pesquisa cliente
			//autocomplete
			$("#FornecedorNome").autocomplete({
				source: "<?php print $this->Html->url('/',true); ?>/Fornecedores/pesquisaAjaxFornecedor/nome",
				minLength: 3,
				select: function(event, ui) {
					$("#FornecedorId").val(ui.item.id);
					$('#FornecedorNome').val(ui.item.nome);
				}
			});
			// ao digitar o codigo
			$('#FornecedorId').blur(function(){
				codigo = $(this).val();
				if (codigo == null || codigo == '') return null;
				$.getJSON('<?php print $this->Html->url('/',true); ?>/Fornecedores/pesquisaAjaxFornecedor/codigo', {'term': codigo}, function(data) {
					if (data == null) {
						alert ('Fornecedor com o código '+codigo+' não foi encontrado!');
						$('#FornecedorNome').val('');
						$("#FornecedorId")
							.val('')
							.focus();
					}
					else { //encontrou resultados
						data = data[0];
						$("#FornecedorId").val(data.id);
						$('#FornecedorNome').val(data.nome);
					}
				});
			});
		});
</script>
<h2 class="descricao_cabecalho">Pesquisar Fornecedor</h2>

<?php
/**
 * Elimino as divs dos campos input para que nao apareça quais campos
 * sao marcados como obrigatorios no BD, pois aqui isso non ecxiste
 */
print $this->Form->create(null,array('controller'=>'fornecedores','action'=>'pesquisar','autocomplete'=>'off'));
?>
<div class="divs_grupo_2">
	
	<div class="div1_2">
		<div>
			<label style="">Código / nome</label>
			<input style="float:left; width: 10%;" id="FornecedorId" type="text" name="data[Fornecedor][id]" />
			<input style="margin-left: 1%; width: 80%" id="FornecedorNome" type="text" name="data[Fornecedor][nome]" />
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
	<table class="padrao">
		<thead>
			<tr>
				<th><?php print $this->Paginator->sort('Cód','id'); ?></th>
				<th><?php print $this->Paginator->sort('Pessoa','tipo_pessoa'); ?></th>
				<th><?php print $this->Paginator->sort('Nome','nome'); ?></th>
				<th><?php print $this->Paginator->sort('Nome fantasia','nome_fantasia'); ?></th>
				<th><?php print $this->Paginator->sort('Cidade','cidade'); ?></th>
				<th>CPF/CNPJ</th>
				<th>RG/IE</th>
				<th><?php print $this->Paginator->sort('Usuário cadastrou','usuario_cadastrou'); ?></th>
				<th colspan="2">Ações</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ($resultados as $r) : ?>
				<tr>
					<td><?php print $r['Fornecedor']['id']; ?></td>
					<td><?php print $r['Fornecedor']['tipo_pessoa']; ?></td>
					<td><?php print $this->Html->link($r['Fornecedor']['nome'],'editar/' . $r['Fornecedor']['id']) ;?></td>
					<td><?php print $r['Fornecedor']['nome_fantasia']; ?></td>
					<td><?php print $r['Fornecedor']['cidade']; ?></td>
					<td><?php print $r['Fornecedor']['cpf'].$r['Fornecedor']['cnpj']; ?></td>
					<td><?php print $r['Fornecedor']['rg'].$r['Fornecedor']['inscricao_estadual']; ?></td>
					<td><?php print $r['Usuario']['login']; ?></td>
					<td>
						<?php print $this->element('painel_detalhar',array('id'=>$r['Fornecedor']['id'])) ;?>
					</td>
					<td>
						<?php print $this->element('painel_editar',array('id'=>$r['Fornecedor']['id'])) ;?>
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
