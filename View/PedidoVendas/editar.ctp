<script type="text/javascript">
	// variaveis a serem utilizadas no arquivo pedido_venda.js
	var ajaxPesqCliente = "<?php print $this->Html->url(array('controller'=>'Clientes','action'=>'pesquisaAjaxCliente')); ?>/";
	var ajaxPesqProduto = "<?php print $this->Html->url(array('controller'=>'Produtos','action'=>'pesquisaAjaxProduto')); ?>/";
</script>

<?php
print $this->Html->script('pedido_venda');
print $this->Html->script('formatar_moeda');
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'PedidoVenda','update'=>'conteudo_ajax'));
}
else {
	print $this->Form->create('PedidoVenda',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>

<div class="row-fluid">
	
	<div class="span12">
		
		<fieldset>
			<legend class="descricao_cabecalho"><?php print __('Cadastrar pedido de venda'); ?></legend>

			<div class="row-fluid">
				
				<div class="span2 visible-desktop">

					<ul class="nav nav-pills nav-stacked">

						<li class="nav-header">
							Ações
						</li>
						<li>
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoOrdens','action'=>'index'));?>" onclick="formulario_cancelar(); return false;">
								<i class="icon-remove"></i>
								Cancelar
							</a>
						</li>

						<li class="nav-header">
							Ordens de serviço
						</li>
						<li class="active">
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoOrdens','action'=>'cadastrar'));?>">
								<i class="icon-file"></i>
								Cadastrar
							</a>
						</li>
						<li>
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoOrdens','action'=>'editar'));?>">
								<i class="icon-edit"></i>
								Editar
							</a>
						</li>
						<li>
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoOrdens','action'=>'pesquisar'));?>">
								<i class="icon-filter"></i>
								Pesquisar
							</a>
						</li>
						<li>
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoOrdens','action'=>'index'));?>">
								<i class="icon-list"></i>
								Listar
							</a>
						</li>

						<li class="nav-header">
							Serviços
						</li>
						<li>
							<a href="<?php print $this->Html->url(array('controller'=>'Servicos','action'=>'cadastrar'));?>">
								<i class="icon-file"></i>
								Cadastrar
							</a>
							<a href="<?php print $this->Html->url(array('controller'=>'Servicos','action'=>'index'));?>">
								<i class="icon-list"></i>
								Listar
							</a>
						</li>

						<li class="nav-header">
							Categorias de serviço
						</li>
						<li>
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoCategorias','action'=>'cadastrar'));?>">
								<i class="icon-file"></i>
								Cadastrar
							</a>
							<a href="<?php print $this->Html->url(array('controller'=>'ServicoCategorias','action'=>'index'));?>">
								<i class="icon-list"></i>
								Listar
							</a>
						</li>
					</ul>

				</div>

				<div class="span10">

					<div id="pedido_venda_abas">
						<ul>
							<li><a href="#informacoes">Informações</a></li>
							<li><a href="#produtos">Produtos</a></li>
							<li><a href="#outros">Outros</a></li>
						</ul>

						<div id="informacoes">
							<div class="row-fluid">
								<div class="span6">
									<?php
									$this->Form->defineRow(array(2,10));
									print $this->Form->input('cliente_id', array('label'=>__('Cliente'),'type'=>'text','class'=>'span12'));
									print $this->Form->input('pesquisar_cliente', array('label'=>__('Nome'),'id'=>'pesquisar_cliente','class'=>'span12'));
									$this->Form->restoreDefaults();
									print $this->Form->input('forma_pagamento_id',array('label'=>__('Forma de pagamento'),'options'=>$opcoes_forma_pamamento,'class'=>'span12'));
									unset($opcoes_situacoes['C']); unset($opcoes_situacoes['T']);
									print $this->Form->input('situacao',array('label'=>__('Situação'),'options'=>$opcoes_situacoes,'class'=>'span12'));
									print $this->Form->input('vendedor_id',array('label'=>__('Vendedor'),'options'=>$opcoes_vendedores,'class'=>'span12'));
									?>
								</div>
								<div class="span6">
									<?php
									print $this->Form->input('data_venda',array('label'=>__('Data da venda'),'type'=>'text','class'=>'mascara_data datepicker','class'=>'span12'));
									print $this->Form->input('data_saida',array('label'=>__('Data da saída'),'type'=>'text','class'=>'mascara_data datepicker','class'=>'span12'));
									print $this->Form->input('data_entrega',array('label'=>__('Data entrega'),'type'=>'text','class'=>'mascara_data datepicker','class'=>'span12'));
									print $this->Form->input('desconto',array('label'=>__('Desconto'),'type'=>'text','class'=>'span12'));
									?>
								</div>
							</div>
						</div> <!-- fim de informacoes -->

						<div id="produtos">

								<fieldset>
									<legend>Pesquisar produto</legend>
									<div id="form_pesquisar_produtos">
										<div id="produtos_pesquisar">
											<?php
											$this->Form->defineRow(array(2,4,2,2,2));
											print $this->Form->input('Produto.id',array('label'=>'Cód.','type'=>'text','class'=>'span12'));
											print $this->Form->input('Produto.nome',array('label'=>'Nome','type'=>'text','class'=>'span12'));
											print $this->Form->input('Produto.quantidade_estoque',array('label'=>'Cód.','type'=>'text','readonly'=>'readonly','class'=>'span12'));
											print $this->Form->input('Produto.quantidade',array('label'=>'Cód.','type'=>'text','class'=>'span12'));
											print $this->Form->input('Produto.preco_venda',array('label'=>'Cód.','type'=>'text','class'=>'span12'));
											print $this->Form->input('Produto.categoria',array('label'=>'Cód.','type'=>'hidden','class'=>'span12'));
											?>
										</div>
										<input type="button" value="Adicionar" class="btn btn-success" style="float: left; width: 10%;" id="ProdutoAdicionar" />
									</div>
								</fieldset>
								<br/>

								<fieldset id="fieldset_produtos_incluidos">
									<legend>Produtos incluídos</legend>
									
									<table class="table table-striped">
										<thead>
											<tr>
												<th style="width: 5%;">Cód.</th> <th>Nome</th> <th style="width: 5%;">Qtd.</th> <th style="width: 5%;">Valor</th>  <th style="width: 5%;">Ações</th>
											</tr>
										</thead>
										<tbody id="produtos_incluidos">
											<?php //aqui ficam os itens incluidos
											if (isset($campos_ja_inseridos)) {
												$i = 0;
												$valor_total = 0;
												foreach ($campos_ja_inseridos as $item) {
													print '<tr>'.
													'<td> <input type="text" name="data[PedidoVendaItem]['.$i.'][produto_id]" value="'.$item['produto_id'].'" class="noinput item_id" /> </td>'.
													'<td> <input type="text" name="data[PedidoVendaItem]['.$i.'][produto_nome]" value="'.$item['produto_nome'].'" class="noinput item_nome" /> </td>'.
													'<td> <input type="text" name="data[PedidoVendaItem]['.$i.'][quantidade]" value="'.$this->Geral->numero2moeda($item['quantidade']).'" class="noinput item_qtd" /> </td>'.
													'<td> <input type="text" name="data[PedidoVendaItem]['.$i.'][preco_venda]" value="'.$this->Geral->numero2moeda($item['preco_venda']).'" class="noinput item_val" /> </td>'.
													'<td> <img src="'.$this->Html->url('/',true).'/img/del24x24.png" class="remover_linha"/> </td>'.
													'</tr>'."\n";
													$i++;
													$valor_total += $this->Geral->moeda2numero($item['quantidade']) * $this->Geral->moeda2numero($item['preco_venda']);
												}
												$valor_total = $this->Geral->numero2moeda($valor_total);
											}
											?>
										</tbody>
										<input type="hidden" id="numero_itens_incluidos" value="<?php if (isset($i)) print $i; else print '0';?>" />
										<input type="hidden" id="preco_custo" value="0" />
									</table>
									<b>Valor total: </b> R$ <span id="valor_total"><?php if (isset($valor_total)) print $valor_total; else print '0'; ?></span>
								</fieldset>

						</div> <!-- fim de produtos -->

						<div id="outros">
							<?php
							$this->Form->defineRow(array(4,4,4));
							print $this->Form->input('custo_frete',array('label'=>__('Custo do frete'),'type'=>'text'));
							print $this->Form->input('custo_seguro',array('label'=>__('Custo do seguro'),'type'=>'text'));
							print $this->Form->input('custo_outros',array('label'=>__('Outros custos'),'type'=>'text'));
							print $this->Form->input('observacao',array('label'=>__('Observação')));
							?>
						</div> <!-- fim de outros -->

					</div>
					
					<br/>
					<?php print $this->Form->end('Gravar'); ?>
					
				</div>
				
			</div>

		</fieldset>
		
	</div>
	
</div>