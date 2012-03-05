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
						<?php print $html -> link('Categorias', "/fornecedorCategorias",array('class' => 'ajax_link_dialog'));?>
						<ul>
							<li><?php print $html -> link('Cadastrar', "/fornecedorCategorias/cadastrar",array('class' => 'ajax_link_dialog'));?></li>
							<li><?php print $html -> link('Listar', "/fornecedorCategorias",array('class' => 'ajax_link_dialog'));?></li>
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
						<?php print $html -> link('Categorias', "/categoriaProdutos",array('class' => 'ajax_link_dialog'));?>
						<ul>
							<li><?php print $html -> link('Cadastrar', "/categoriaProdutos/cadastrar",array('class' => 'ajax_link_dialog'));?></li>
							<li><?php print $html -> link('Listar', "/categoriaProdutos",array('class' => 'ajax_link_dialog'));?></li>
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
					<li><?php print $html -> link('Pesquisar', "/clientes/pesquisar",array('class' => 'ajax_link_dialog'));?></li>
					<li><?php print $html -> link('Listar', "/clientes/");?></li>
					<li>
						<?php print $html -> link('Categorias', "/clienteCategorias",array('class' => 'ajax_link_dialog','data-ajax_link_dialog_altura'=>'500','data-ajax_link_dialog_largura'=>'500','data-ajax_link_dialog_titulo'=>'categorias de cliente'));?>
						<ul>
							<li><?php print $html -> link('Cadastrar', "/clienteCategorias/cadastrar",array('class' => 'ajax_link_dialog','data-ajax_link_dialog_altura'=>'500','data-ajax_link_dialog_largura'=>'500','data-ajax_link_dialog_titulo'=>'cadastrar categorias de cliente'));?></li>
							<li><?php print $html -> link('Listar', "/clienteCategorias",array('class' => 'ajax_link_dialog','data-ajax_link_dialog_altura'=>'500','data-ajax_link_dialog_largura'=>'500','data-ajax_link_dialog_titulo'=>'categorias de cliente'));?></li>
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
			<li><?php print $html -> link('Serviços', "/servicos/",array('class' => 'ajax_link_dialog'));?></li>
			<li><?php print $html -> link('Categorias de serviços', "/servicoCategorias",array('class' => 'ajax_link_dialog'));?></li>
		</ul>
	</li>
	
	<li>
		<a href="#">Expedição</a>
		<ul>
			<li>
				<?php print $html -> link('Carregamento', "/carregamentos/",array('class' => 'ajax_link_dialog'));?>
				<ul>
					<li><?php print $html -> link('Cadastrar', "/carregamentos/cadastrar");?></li>
					<li><?php print $html -> link('Enviar', "/carregamentos/enviar");?></li>
					<li><?php print $html -> link('Pesquisar', "/carregamentos/pesquisar");?></li>
					<li><?php print $html -> link('Listar', "/carregamentos/");?></li>
				</ul>
			</li>
			<li><?php print $html -> link('Motoristas', "/motoristas/");?></li>
			<li><?php print $html -> link('Veículos', "/veiculos");?></li>
			<!--
			<li>
				<a href="#">Consultar</a>
				<ul>
					<li><?php print $html -> link('Pedidos por carregamento', "/carregamentos/pedidosPorCarregamento");?></li>
				</ul>
			</li>
			-->
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
			<li><?php print $html -> link('Tipos de documentos', "/tipoDocumentos/",array('class' => 'ajax_link_dialog'));?></li>
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
			<li><?php print $html -> link('Ajuda', "/sistema/ajuda",array('class' => 'ajax_link_dialog'));?></li>
			<li><?php print $html -> link('Sobre', "/sistema/sobre",array('class' => 'ajax_link_dialog'));?></li>
			<li><?php print $html -> link('Sair', "/usuarios/logout");?></li>
		</ul>
	</li>
</ul>
