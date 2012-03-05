<h2 class="descricao_cabecalho">Resumo das contas a receber</h2>

<?php
$javascript->link('jqplot/jquery.jqplot.js',false);
$javascript->link('jqplot/plugins/jqplot.donutRenderer.js',false);
$javascript->link('jqplot/plugins/jqplot.pieRenderer.js',false);

print $html->css('jquery.jqplot.css');
?>

<script type="text/javascript">
	$(document).ready(function(){
		
		var data1 = <?php print $data1 ?>;
		var grafico1 = jQuery.jqplot ('grafico1', [data1], {
			title: 'Itens do plano de contas mais utilizados',
			seriesDefaults: {
				// Cria um grafico de pizza
				renderer: jQuery.jqplot.PieRenderer,
				rendererOptions: {
					// Coloque rótulos de dados sobre as fatias de pizza.
					 // Por padrão rótulos mostram a porcentagem da fatia.
					showDataLabels: true
				}
			},
			legend: { show:true, location: 'e' }
			}
		);
		
		var data2 = <?php print $data2 ?>;
		var grafico2 = jQuery.jqplot ('grafico2', [data2], {
			title: 'Itens do plano de contas com maiores valores (R$)',
			seriesDefaults: {
				// Cria um grafico de pizza
				renderer: jQuery.jqplot.PieRenderer,
				rendererOptions: {
					// Coloque rótulos de dados sobre as fatias de pizza.
					 // Por padrão rótulos mostram a porcentagem da fatia.
					showDataLabels: true,
					dataLabels: 'value'
				},
			},
			legend: { show:true, location: 'e' }
			}
		);
		
		var data3 = <?php print $data3 ?>;
		var grafico3 = jQuery.jqplot ('grafico3', [data3], {
			title: 'Clientes/fornecedores com mais contas a receber',
			seriesDefaults: {
				// Cria um grafico de pizza
				renderer: jQuery.jqplot.PieRenderer,
				rendererOptions: {
					// Coloque rótulos de dados sobre as fatias de pizza.
					 // Por padrão rótulos mostram a porcentagem da fatia.
					showDataLabels: true,
				},
			},
			legend: { show:true, location: 'e' }
			}
		);
		
	});
</script>



<div id="grafico1" class="grafico grupo_horizontal" style="height:300px;width:30%; margin-left: 2%; ">
	
</div>

<div id="grafico2" class="grafico grupo_horizontal" style="height:300px;width:30%; margin-left: 2%; ">
	
</div>

<div id="grafico3" class="grafico grupo_horizontal" style="height:300px;width:30%; margin-left: 2%;">
	
</div>

<div class="limpar">&nbsp;</div>
