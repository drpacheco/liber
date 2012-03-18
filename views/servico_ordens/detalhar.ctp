<h2 class="descricao_cabecalho">Detalhando ordem de serviço número <?php print $c['ServicoOrdem']['id']; ?></h2>

<fieldset>
	<legend>Dados do serviço</legend>
	
	<div class="grupo_horizontal">
		<label>Data e hora do registro </label> <input class="noinput" value="<?php print $formatacao->dataHora($c['ServicoOrdem']['data_hora_cadastrada']);?>" />
	</div>
	<div class="grupo_horizontal"> 
		<label>Cliente </label> <input class="noinput" value="<?php print $c['ServicoOrdem']['cliente_id'].' '.$c['Cliente']['nome'];?>" />
	</div>
	<div class="grupo_horizontal">
		<label>Forma de pagamento </label> <input class="noinput" value="<?php print $c['ServicoOrdem']['forma_pagamento_id'].' '.$c['FormaPagamento']['nome'] ;?>" />
	</div>
	<div class="grupo_horizontal">
		<label>Situação </label> <input class="noinput" value="<?php print $opcoes_situacao[$c['ServicoOrdem']['situacao']] ;?>" />
	</div>
	<div class="grupo_horizontal">
		<label>Início</label> <input class="noinput" value="<?php print $formatacao->dataHora($c['ServicoOrdem']['data_hora_inicio']) ;?>" />
	</div>
	<div class="grupo_horizontal">
		<label>Fim </label> <input class="noinput" value="<?php print $formatacao->dataHora($c['ServicoOrdem']['data_hora_fim']);?>" />
	</div>
</fieldset>


<fieldset>
	<legend>Serviços incluídos</legend>

	<table class="padrao">
		<thead>
			<tr>
				<th>Cód.</th>
				<th>Nome</th>
				<th>Quantidade</th>
				<th>Valor</th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			foreach ($c['ServicoOrdemItem'] as $r):?>
			<tr>
				<td><?php print $r['servico_id'] ?></td>
				<td><?php print $r['servico_nome'] ?></td>
				<td><?php print $r['quantidade'] ?></td>
				<td><?php print $r['valor'] ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		
	</table>
	<div class="grupo_horizontal">
		<label class="grupo_horizontal"><b>Valor bruto</b></label> <input class="grupo_horizontal noinput" value="R$<?php print $c['ServicoOrdem']['valor_bruto'] ;?>" />
		<label class="grupo_horizontal"><b>Valor líquido</b></label> <input class="grupo_horizontal noinput" value="R$<?php print $c['ServicoOrdem']['valor_liquido'] ;?>" />
	</div>
</fieldset>