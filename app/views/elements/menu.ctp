<ul class="sf-menu">
	<li>
		<?php print $html -> link('Início', "/");?>
	</li>
	
	<li>
		<a href="#">Compras</a>
		<ul>
			<li>
				<?php print $html -> link('Fornecedores', "/fornecedores");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/fornecedores/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/fornecedores/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/fornecedores/");?></li>
					<li>
						<?php print $html -> link('Categorias', "/fornecedorCategorias");?>
						<ul>
							<li>
								<?php print $html -> link('Cadastrar', "/fornecedorCategorias/cadastrar",
									   array('class' => 'ajax_link_dialog',
										'data-ajax_link_dialog_altura'=>'300',
										'data-ajax_link_dialog_largura'=>'500',
										'data-ajax_link_dialog_titulo'=>'Categoria de fornecedores'));?>
							</li>
							<li><?php print $html -> link('Listar', "/fornecedorCategorias");?></li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<?php print $html -> link('Produtos', "/produtos/");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/produtos/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/produtos/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/produtos/");?></li>
					<li>
						<?php print $html -> link('Categorias', "/categoriaProdutos");?>
						<ul>
							<li>
								<?php print $html -> link('Cadastrar', "/categoriaProdutos/cadastrar",
									    array('class' => 'ajax_link_dialog',
										'data-ajax_link_dialog_altura'=>'300',
										'data-ajax_link_dialog_largura'=>'500',
										'data-ajax_link_dialog_titulo'=>'Categoria de produtos'));?>
							</li>
							<li><?php print $html -> link('Listar', "/categoriaProdutos");?></li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
	</li>
	
	<li>
		<a href="#">Vendas</a>
		<ul>
			<li>
				<?php print $html -> link('Clientes', "/clientes");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/clientes/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/clientes/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/clientes/");?></li>
					<li>
						<?php print $html -> link('Categorias', "/clienteCategorias");?>
						<ul>
							<li>
								<?php print $html -> link('Cadastrar', "/clienteCategorias/cadastrar",
								    array('class' => 'ajax_link_dialog',
										'data-ajax_link_dialog_altura'=>'300',
										'data-ajax_link_dialog_largura'=>'500',
										'data-ajax_link_dialog_titulo'=>'Categoria de clientes'));?>
							</li>
							<li><?php print $html -> link('Listar', "/clienteCategorias");?></li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<?php print $html -> link('Pedido de venda', "/pedidoVendas");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/pedidoVendas/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/pedidoVendas/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/pedidoVendas/");?></li>
				</ul>
			</li>
		</ul>
	</li>
	
	<li>
		<a href="#">Serviços</a>
		<ul>
			<li>
				<?php print $html -> link('Ordens de serviço', "/servicoOrdens");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/servicoOrdens/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/servicoOrdens/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/servicoOrdens");?></li>
				</ul>
			</li>
			<li>
				<?php print $html -> link('Serviços', "/servicos"); ?>
				<ul>
					<li>
						<?php print $html -> link('Cadastrar', "/servicos/cadastrar",
							   array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastrar serviço'));?>
					</li>
					<li><?php print $html -> link('Listar', "/servicos");?></li>
				</ul>
			</li>
			<li>
				<?php print $html -> link('Categorias', "/servicoCategorias"); ?>
				<ul>
					<li>
						<?php print $html -> link('Cadastrar', "/servicoCategorias/cadastrar",
						array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'300',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Categoria de serviços'));?>
					</li>
					<li><?php print $html -> link('Listar', "/servicoCategorias/index"); ?></li>
				</ul>
			</li>
			
		</ul>
	</li>
	
	<li>
		<a href="#">Expedição</a>
		<ul>
			<li>
				<?php print $html -> link('Carregamento', "/carregamentos/");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/carregamentos/cadastrar");?></li>
					<li><?php print $html -> link('Enviar', "/carregamentos/enviar");?></li>
					<li><?php print $html -> link('Pesquisar', "/carregamentos/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/carregamentos/");?></li>
				</ul>
			</li>
			
			<li>
				<?php print $html -> link('Motoristas', "/motoristas"); ?>
				<ul>
					<li>
						<?php print $html -> link('Cadastrar', "/motoristas/cadastrar",
						array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de motorista'));?>
					</li>
					<li><?php print $html -> link('Listar', "/motoristas/index"); ?></li>
				</ul>
			</li>
			
			<li>
				<?php print $html -> link('Veículos', "/veiculos"); ?>
				<ul>
					<li>
						<?php print $html -> link('Cadastrar', "/veiculos/cadastrar",
						array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de veículo'));?>
					</li>
					<li><?php print $html -> link('Listar', "/veiculos/index"); ?></li>
				</ul>
			</li>
			
		</ul>
	</li>

	<li>
		<a href="#" >Financeiro</a>
		<ul>
			<li>
				<?php print $html -> link('Contas a receber', "/receberContas/");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/receberContas/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/receberContas/pesquisar");?></li>
					<li><?php print $html -> link('Resumo', "/receberContas/resumo");?></li>
					<li><?php print $html -> link('Listar', "/receberContas/");?></li>
				</ul>
			</li>
			<li>
				<?php print $html -> link('Contas a pagar', "/pagarContas/");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/pagarContas/cadastrar");?></li>
					<li><?php print $html -> link('Pesquisar', "/pagarContas/pesquisar");?></li>
					<li><?php print $html -> link('Resumo', "/pagarContas/resumo");?></li>
					<li><?php print $html -> link('Listar', "/pagarContas/");?></li>
				</ul>
			</li>
			<li><?php print $html -> link('Plano de contas', "/planoContas/");?></li>
			<li><?php print $html -> link('Tipos de documentos', "/tipoDocumentos/");?></li>
			<li class="separador"></li>
			<li><?php print $html -> link('Formas de pagamento', "/formaPagamentos");?></li>
			<li><?php print $html -> link('Contas', "/contas/");?></li>
		</ul>
	</li>

	<li>
		<a href="#">Ferramentas</a>
		<ul>
			<li>
				<?php print $html -> link('Empresas', "/empresas");?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/empresas/cadastrar");?></li>
					<li><?php print $html -> link('Listar', "/empresas/");?></li>
				</ul>
			</li>
			<li><?php print $html -> link('Usuários', "/usuarios/");?></li>
			<li>
				<?php print $html -> link('Ajuda', "/sistema/ajuda",
					   array('class' => 'ajax_link_dialog',
						  'data-ajax_link_dialog_altura'=>'500',
						  'data-ajax_link_dialog_largura'=>'500',
						  'data-ajax_link_dialog_titulo'=>'Ajuda'));
				?>
			</li>
			<li>
				<?php print $html -> link('Sobre', "/sistema/sobre",
				   array('class' => 'ajax_link_dialog',
						  'data-ajax_link_dialog_altura'=>'500',
						  'data-ajax_link_dialog_largura'=>'500',
						  'data-ajax_link_dialog_titulo'=>'Sobre'));
				?>
			</li>
			<li><?php print $html -> link('Sair', "/usuarios/logout");?></li>
		</ul>
	</li>
</ul>
