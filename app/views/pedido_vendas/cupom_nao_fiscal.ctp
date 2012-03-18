<!--
	Para uma impressora com 80mm de largura,
	equivalentes a cerca de 302 pixels
-->
<style type="text/css">
	body {font-size:80%;}
	#cupom {
		width: 295px;
	}
	p {
		margin-top: 0px;
		margin-bottom: 5px;
	}
</style>

<script type="text/javascript">
	window.print();
</script>

<div id="cupom">
	
	<div id="cabecalho">
		
		<h1 class="destaque" style="text-align: center;"> Liber software </h1>
		<p>
			<?php print "{$venda['Empresa']['nome']} - {$venda['Empresa']['logradouro']} {$venda['Empresa']['numero']}
					{$venda['Empresa']['complemento']} {$venda['Empresa']['bairro']}
					{$venda['Empresa']['cidade']} - {$venda['Empresa']['estado']}"; ?>
		</p>
		
		<span class="separador"></span>
		
		<p>
			ID nº <?php print $venda['PedidoVenda']['id']; ?> 
			em <?php (! empty($venda['PedidoVenda']['data_hora_cadastrado'])) ? print $formatacao->dataHora($venda['PedidoVenda']['data_hora_cadastrado']) : print ''; ?> 
			<br/>
			Cliente: <?php print $venda['Cliente']['nome']; ?> 
			<br/>
			Pagamento: <?php print $venda['FormaPagamento']['nome']; ?> 
		</p>
		
	</div>
	
	<div id="itens">
		
		<table>
			<thead>
				<th style="width: 70%; text-align: left;">Descrição</th>
				<th style="width: 10%; text-align: left;">Qtd.</th>
				<th style="width: 20%; text-align: left;">Valor uni.</th>
			</thead>
			<tbody>
				<?php
				foreach ($venda['PedidoVendaItem'] as $item) {
					print "<tr>";
					print "<td> ${item['produto_nome']} </td>";
					print "<td> ${item['quantidade']} </td>";
					print "<td>". $geral->numero2moeda($item['preco_venda'])." </td>";
					print "</tr>\n";
				}
				?>
			</tbody>
		</table>
		
	</div>
	
	<br/>
	
	<p>
		<span class="destaque">Valor bruto</span>: R$<?php print $geral->numero2moeda($venda['PedidoVenda']['valor_bruto']); ?>
		<br/>
		<span class="destaque">Valor total</span>: R$<?php print $geral->numero2moeda($venda['PedidoVenda']['valor_liquido']); ?>
	</p>
	
	<p>
		Ass.:
		__________________________________
	</p>
	
</div>