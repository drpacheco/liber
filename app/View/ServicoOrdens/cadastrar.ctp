<script type="text/javascript">
	// variaveis a serem utilizadas no arquivo ordem_servico.js
	var raiz_site = "<?php print $this->Html->url('/',true); ?>/";
	var ajaxPesqCliente = "<?php print $this->Html->url(array('controller'=>'Clientes','action'=>'pesquisaAjaxCliente')); ?>/";
	var ajaxPesqServico = "<?php print $this->Html->url(array('controller'=>'Servicos','action'=>'pesquisaAjaxServico')); ?>/";
	var ajaxPesqFormaPagamento = "<?php print $this->Html->url(array('controller'=>'FormaPagamentos','action'=>'pesquisaAjaxNumeroMaximoParcelas')); ?>/";
</script>

<?php
print $this->Html->script('ordem_servico');
print $this->Html->script('formatar_moeda');
?>

<h2 class="descricao_cabecalho">Cadastrar ordem de serviço</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'ServicoOrdem','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('ServicoOrdem',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>

<div id="servico_ordem_abas">
	<ul>
		<li><a href="#informacoes">Informações</a></li>
		<li><a href="#servicos">Serviços</a></li>
		<li><a href="#outros">Outros</a></li>
	</ul>
	
	<div id="informacoes">
		<div class="divs_grupo_2">
			<div class="div1_2">
				<div>
					<?php
					print $this->Form->label('cliente_id','Cliente',array('class'=>'required'));
					print $this->Form->input('cliente_id', array(
						'div'=>false,
						'label'=>false,
						'type'=>'text',
						'style' => 'float:left; width: 10%;'
						));
					?>
					<input style="margin-left: 1%; width: 80%" type="text" name="pesquisar_cliente" id="pesquisar_cliente" />
				</div>
				<?php
				print $this->Form->input('forma_pagamento_id',array('label'=>'Forma de pagamento','options'=>$opcoes_forma_pamamento));
				print $this->Form->input('dias_garantia',array('label'=>'Dias de garantia'));
				?>
			</div>
			<div class="div2_2">
				<?php
				print $this->Form->input('data_hora_inicio',array('label'=>'Data e hora do início','dateFormat' => 'DMY','timeFormat'=>24));
				unset($opcoes_situacao['C']);
				print $this->Form->input('situacao',array('label'=>'Situação','options'=>$opcoes_situacao));
				print $this->Form->input('usuario_id',array('label'=>'Técnico','options'=>$opcoes_tecnico));
				?>
			</div>
			<div class="limpar"></div>
		</div>
		<div class="limpar">&nbsp;</div>
	</div> <!-- fim de informacoes -->
	
	<div id="servicos">
		<div class="divs_grupo_2">
			
			<div class="div1_2">
				<fieldset id="fieldset_servicos_incluidos">
					<legend>Serviços incluídos</legend>
					<!-- 
						#TODO adicionar ajustes das colunas da tabela conforme o tamanho do campo input
						style="border-collapse:collapse;"
						-->
					<table class="padrao">
						<thead>
							<tr>
								<th style="width: 10%;">Cód.</th> <th>Nome</th> <th style="width: 15%;">Qtd.</th> <th style="width: 15%;">Valor</th>  <th>Ações</th>
							</tr>
						</thead>
						<tbody id="servicos_incluidos">
							<?php //aqui ficam os itens incluidos
							if (isset($campos_ja_inseridos)) {
								$i = 0;
								$valor_total = 0;
								foreach ($campos_ja_inseridos as $item) {
									print '<tr>'.
									'<td> <input type="text" name="data[ServicoOrdemItem]['.$i.'][servico_id]" value="'.$item['servico_id'].'" class="noinput item_id" /> </td>'.
									'<td> <input type="text" name="data[ServicoOrdemItem]['.$i.'][servico_nome]" value="'.$item['servico_nome'].'" class="noinput item_nome" /> </td>'.
									'<td> <input type="text" name="data[ServicoOrdemItem]['.$i.'][quantidade]" value="'.$item['quantidade'].'" class="noinput item_qtd" /> </td>'.
									'<td> <input type="text" name="data[ServicoOrdemItem]['.$i.'][valor]" value="'.$item['valor'].'" class="noinput item_val" /> </td>'.
									'<td> <img src="'.$this->Html->url('/',true).'/img/del24x24.png" class="remover_linha"/> </td>'.
									'</tr>'."\n";
									$i++;
									$valor_total += $item['quantidade'] * $this->Geral->moeda2numero($item['valor']);
								}
							}
							?>
						</tbody>
						<input type="hidden" id="numero_itens_incluidos" value="<?php if (isset($i)) print $i; else print '0';?>" />
					</table>
					<b>Valor total: </b> R$ <span id="valor_total"><?php if (isset($valor_total)) print $valor_total; else print '0'; ?></span>
				</fieldset>
			</div>
			
			<div class="div2_2">
				<fieldset>
					<legend>Pesquisar serviço</legend>
					<div id="form_pesquisar_servicos">
						<div id="servicos_pesquisar">
							<label for="[Servico][id]">Código</label>
							<input type="text" name="[Servico][id]" id="ServicoId" value="" class="required number" />
							
							<label for="[Servico][nome]">Serviço</label>
							<input type="text" name="[Servico][nome]" id="ServicoNome" value="" />
							
							<input type="hidden" name="[Servico][categoria]" id="ServicoCategoria" value="" />
							
							<label for="[Servico][quantidade]">Quantidade</label>
							<input type="text" name="[Servico][quantidade]" id="ServicoQuantidade" value="" class="required number" />
							
							<label for="[Servico][valor]">Valor</label>
							<input type="text" name="[Servico][valor]" id="ServicoValor" value="" />
						</div>
						<p>
							<input type="button" value="Adicionar" class="botao_aviso"
								style="float: left; width: 40%;" onclick="adicionar_servico(); return false;" />
							<input type="button" value="Limpar" class="botao_erro" style="width: 40%; margin-left: 10%;"
								onclick="limpar_pesquisa(); return false;" />
						</p>
					</div>
				</fieldset>
			</div>
			<div class="limpar"></div>
		</div>
		<div class="limpar">&nbsp;</div>
	</div> <!-- fim de servicos -->
	
	<div id="outros">
		<?php
		print $this->Form->input('empresa_id',array('label'=>'Empresa','options'=>$opcoes_empresas));
		print $this->Form->input('custo_outros',array('label'=>'Outros custos'));
		print $this->Form->input('desconto',array('label'=>'Desconto'));
		print $this->Form->input('defeitos_relatados',array('label'=>'Defeitos relatados','rows'=>'3'));
		print $this->Form->input('laudo_tecnico',array('label'=>'Laudo técnico','rows'=>'3'));
		print $this->Form->input('observacao',array('label'=>'Observação','rows'=>'3'));
		?>
	<div class="limpar">&nbsp;</div>
	</id> <!-- fim de outros -->
	
</div>
<br/>

<?php print $this->Form->end('Gravar'); ?>
