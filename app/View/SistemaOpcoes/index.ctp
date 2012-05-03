<script type="text/javascript">
	$(function(){
		$('#sistema_opcoes').tabs();
	});
</script>

<h2 class="descricao_cabecalho">Opções gerais do sistema</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('index','post',array('autocomplete'=>'off','model'=>'SistemaOpcao','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('SistemaOpcao',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>

<div id="sistema_opcoes">
	<ul>
		<li> <a href="#opcoes_sistema_financeiro">Financeiro</a> </li>
		<li> <a href="#opcoes_sistema_seguranca">Segurança</a> </li>
	</ul>


	<div id="opcoes_sistema_financeiro">
		<div class="divs_grupo_2">
			<div class="div1_2">
				<?php
				print $this->Form->input('item_plano_contas_pedido_vendas',array(
				    'label'=>'Item do plano de contas utilizado nas contas a receber geradas por pedidos de venda.',
				    'options' => $opcoes_plano_contas,
				    )
				);
				print $this->Form->input('item_plano_contas_ordem_servicos',array(
				    'label'=>'Item do plano de contas utilizado nas contas a receber geradas por ordens de serviço.',
				    'options' => $opcoes_plano_contas,
				    )
				);
				?>
			</div>
		</div>
		<div class="limpar"></div>
	</div>

	<div id="opcoes_sistema_seguranca">
		<div class="divs_grupo_2">
			<div class="div1_2">
				<?php
				print $this->Form->input('login_periodo_tentativas',array('label'=>'Período, em minutos, entre as tentativas de login'));
				print $this->Form->input('login_maximo_tentativas',array('label'=>'Máximo de tentativas de login no período'));
				print $this->Form->input('login_tempo_bloqueio',array('label'=>'Tempo, em minutos, que o usuário ficará bloqueado.'));
				?>
			</div>
		</div>
		<div class="limpar"></div>
	</div>

</div>

<?php print $this->Form->end('Gravar'); ?>

