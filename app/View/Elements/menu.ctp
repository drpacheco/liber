<ul class="sf-menu">
	<li>
		<?php print $this->Html-> link('Início', "/");?>
	</li>
	
	<li>
		<a href="#">Compras</a>
		<ul>
			<li>
				<?php print $this->Html-> link('Fornecedores', "/fornecedores");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/fornecedores/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/fornecedores/pesquisar");?></li>
					<li><?php print $this->Html-> link('Listar', "/fornecedores/");?></li>
					<li>
						<?php print $this->Html-> link('Categorias', "/fornecedorCategorias");?>
						<ul>
							<li>
								<?php print $this->Html-> link('Cadastrar', "/fornecedorCategorias/cadastrar",
									   array('class' => 'ajax_link_dialog',
										'data-ajax_link_dialog_altura'=>'300',
										'data-ajax_link_dialog_largura'=>'500',
										'data-ajax_link_dialog_titulo'=>'Categoria de fornecedores'));?>
							</li>
							<li><?php print $this->Html-> link('Listar', "/fornecedorCategorias");?></li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Produtos', "/produtos/");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/produtos/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/produtos/pesquisar");?></li>
					<li><?php print $this->Html-> link('Listar', "/produtos/");?></li>
					<li>
						<?php print $this->Html-> link('Categorias', "/produtoCategorias");?>
						<ul>
							<li>
								<?php print $this->Html-> link('Cadastrar', "/produtoCategorias/cadastrar",
									    array('class' => 'ajax_link_dialog',
										'data-ajax_link_dialog_altura'=>'300',
										'data-ajax_link_dialog_largura'=>'500',
										'data-ajax_link_dialog_titulo'=>'Categoria de produtos'));?>
							</li>
							<li><?php print $this->Html-> link('Listar', "/produtoCategorias");?></li>
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
				<?php print $this->Html-> link('Clientes', "/clientes");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/clientes/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/clientes/pesquisar");?></li>
					<li><?php print $this->Html-> link('Listar', "/clientes/");?></li>
					<li>
						<?php print $this->Html-> link('Categorias', "/clienteCategorias");?>
						<ul>
							<li>
								<?php print $this->Html-> link('Cadastrar', "/clienteCategorias/cadastrar",
								    array('class' => 'ajax_link_dialog',
										'data-ajax_link_dialog_altura'=>'300',
										'data-ajax_link_dialog_largura'=>'500',
										'data-ajax_link_dialog_titulo'=>'Categoria de clientes'));?>
							</li>
							<li><?php print $this->Html-> link('Listar', "/clienteCategorias");?></li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Pedido de venda', "/pedidoVendas");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/pedidoVendas/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/pedidoVendas/pesquisar");?></li>
					<li><?php print $this->Html-> link('Listar', "/pedidoVendas/");?></li>
				</ul>
			</li>
		</ul>
	</li>
	
	<li>
		<a href="#">Serviços</a>
		<ul>
			<li>
				<?php print $this->Html-> link('Ordens de serviço', "/servicoOrdens");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/servicoOrdens/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/servicoOrdens/pesquisar");?></li>
					<li><?php print $this->Html-> link('Listar', "/servicoOrdens");?></li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Serviços', "/servicos"); ?>
				<ul>
					<li>
						<?php print $this->Html-> link('Cadastrar', "/servicos/cadastrar",
							   array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastrar serviço'));?>
					</li>
					<li><?php print $this->Html-> link('Listar', "/servicos");?></li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Categorias', "/servicoCategorias"); ?>
				<ul>
					<li>
						<?php print $this->Html-> link('Cadastrar', "/servicoCategorias/cadastrar",
						array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'300',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Categoria de serviços'));?>
					</li>
					<li><?php print $this->Html-> link('Listar', "/servicoCategorias/index"); ?></li>
				</ul>
			</li>
			
		</ul>
	</li>
	
	<li>
		<a href="#">Expedição</a>
		<ul>
			<li>
				<?php print $this->Html-> link('Carregamento', "/carregamentos/");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/carregamentos/cadastrar");?></li>
					<li><?php print $this->Html-> link('Enviar', "/carregamentos/enviar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/carregamentos/pesquisar");?></li>
					<li><?php print $this->Html-> link('Listar', "/carregamentos/");?></li>
				</ul>
			</li>
			
			<li>
				<?php print $this->Html-> link('Motoristas', "/motoristas"); ?>
				<ul>
					<li>
						<?php print $this->Html-> link('Cadastrar', "/motoristas/cadastrar",
						array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de motorista'));?>
					</li>
					<li><?php print $this->Html-> link('Listar', "/motoristas/index"); ?></li>
				</ul>
			</li>
			
			<li>
				<?php print $this->Html-> link('Veículos', "/veiculos"); ?>
				<ul>
					<li>
						<?php print $this->Html-> link('Cadastrar', "/veiculos/cadastrar",
						array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de veículo'));?>
					</li>
					<li><?php print $this->Html-> link('Listar', "/veiculos/index"); ?></li>
				</ul>
			</li>
			
		</ul>
	</li>

	<li>
		<a href="#" >Financeiro</a>
		<ul>
			<li>
				<?php print $this->Html-> link('Contas a receber', "/receberContas/");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/receberContas/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/receberContas/pesquisar");?></li>
					<li><?php print $this->Html-> link('Resumo', "/receberContas/resumo");?></li>
					<li><?php print $this->Html-> link('Listar', "/receberContas/");?></li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Contas a pagar', "/pagarContas/");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/pagarContas/cadastrar");?></li>
					<li><?php print $this->Html-> link('Pesquisar', "/pagarContas/pesquisar");?></li>
					<li><?php print $this->Html-> link('Resumo', "/pagarContas/resumo");?></li>
					<li><?php print $this->Html-> link('Listar', "/pagarContas/");?></li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Plano de contas', "/planoContas/");?>
				<ul>
					<li> <?php print $this->Html-> link('Cadastrar', "/planoContas/cadastrar",
						   array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'300',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de item do plano de contas'));?>
					</li>
					<li> <?php print $this->Html-> link('Listar', "/planoContas/");?> </li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Tipos de documentos', "/tipoDocumentos/");?>
				<ul>
					<li>
						<?php print $this->Html-> link('Cadastrar', "/tipoDocumentos/cadastrar",
							   array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'300',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de tipo de documento'));?>
					</li>
					<li> <?php print $this->Html-> link('Listar', "/tipoDocumentos/");?> </li>
				</ul>
			</li>
			<li class="separador"></li>
			<li>
				<?php print $this->Html-> link('Formas de pagamento', "/formaPagamentos");?>
				<ul>
					<li>
						<?php print $this->Html-> link('Cadastrar', "/formaPagamentos/cadastrar",
							   array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'500',
							'data-ajax_link_dialog_largura'=>'600',
							'data-ajax_link_dialog_titulo'=>'Cadastro de forma de pagamento'));?>
					</li>
					<li>	<?php print $this->Html-> link('Listar', "/formaPagamentos"); ?>	</li>
				</ul>
			</li>
			<li>
				<?php print $this->Html-> link('Contas', "/contas/");?>
				<ul>
					<li> <?php print $this->Html-> link('Cadastrar', "/contas/cadastrar",
						   array('class' => 'ajax_link_dialog',
							'data-ajax_link_dialog_altura'=>'400',
							'data-ajax_link_dialog_largura'=>'500',
							'data-ajax_link_dialog_titulo'=>'Cadastro de conta'));?>
					</li>
					<li> <?php print $this->Html-> link('Listar', "/contas/");?> </li>
				</ul>
			</li>
		</ul>
	</li>

	<li>
		<a href="#">Ferramentas</a>
		<ul>
			<li>
				<?php print $this->Html-> link('Empresas', "/empresas");?>
				<ul>
					<li><?php print $this->Html-> link('Cadastrar', "/empresas/cadastrar");?></li>
					<li><?php print $this->Html-> link('Listar', "/empresas/");?></li>
				</ul>
			</li>
			<li><?php print $this->Html-> link('Usuários', "/usuarios/");?></li>
			<li><?php print $this->Html-> link('Grupos', "/grupos/");?></li>
			<li><?php print $this->Html-> link('Opções', "/sistemaOpcoes/");?></li>
			<li>
				<?php print $this->Html-> link('Ajuda', "/sistema/ajuda",
					   array('class' => 'ajax_link_dialog',
						  'data-ajax_link_dialog_altura'=>'500',
						  'data-ajax_link_dialog_largura'=>'500',
						  'data-ajax_link_dialog_titulo'=>'Ajuda'));
				?>
			</li>
			<li>
				<?php print $this->Html-> link('Sobre', "/sistema/sobre",
				   array('class' => 'ajax_link_dialog',
						  'data-ajax_link_dialog_altura'=>'500',
						  'data-ajax_link_dialog_largura'=>'500',
						  'data-ajax_link_dialog_titulo'=>'Sobre'));
				?>
			</li>
			<li><?php print $this->Html-> link('Sair', "/usuarios/logout");?></li>
		</ul>
	</li>
</ul>
