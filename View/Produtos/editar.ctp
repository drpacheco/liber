<script type="text/javascript">
	$(function(){
		
		function calcularPrecoVenda() {
			if ($('#ProdutoCalcularPreco').is(':checked')) {
				precoCusto = $('#ProdutoPrecoCusto');
				precoVenda = $('#ProdutoPrecoVenda');
				margemLucro = $('#ProdutoMargemLucro');
				precoCusto.final = moeda2numero(precoCusto.val());
				precoVenda.final = moeda2numero(precoVenda.val());
				margemLucro.final = moeda2numero(margemLucro.val());
				margemLucro.final = margemLucro.final.replace('%','');
				
				r = (margemLucro.final/100)*precoCusto.final;
				r = parseFloat(precoCusto.final) + parseFloat(r);	
				precoVenda.val( numero2moeda(r) );
			}
		}
		
		$('#ProdutoPrecoCusto').blur(function(){
			calcularPrecoVenda();
		});
		
		$('#ProdutoMargemLucro').blur(function(){
			calcularPrecoVenda();
		});
		
	});
</script>

<h2 class="descricao_cabecalho">Editar produto</h2>

<?php
if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'Produto','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('Produto',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
}
?>
	<div class="grupo_horizontal">
		<?php
		print $this->Form->label('produto_categoria_id','Categoria',array('class'=>'required'));
		print $this->Form->input('produto_categoria_id', array(
			'div'=>false,
			'label'=>false,
			'options'=>$opcoes_categoria_produto
			));
		?>
	</div>
	<div class="grupo_horizontal">
	<?php
		print $this->Form->label('situacao','Situação',array('class'=>'required'));
		print $this->Form->input('situacao',array(
			'div'=>false,
			'label'=>false,
			'options'=>array('E'=>'Em linha','F'=>'Fora de linha')
			));
		?>
	</div>
	<div class="grupo_horizontal">
		<?php
		print $this->Form->label('tipo_produto','Tipo',array('class'=>'required'));
		print $this->Form->input('tipo_produto',array('label'=>false,'div'=>false,'options'=>array($opcoes_tipos)));
		?>
	</div>
	<div class="limpar">&nbsp;</div>
	
	<div class="divs_grupo_3">
		<div class="div1_3">
			<?php
			print $this->Form->input('nome',array('label'=>'Nome'));
			print $this->Form->input('codigo_ean',array('label'=>'Código EAN'));
			print $this->Form->input('codigo_dun',array('label'=>'Código DUN'));
			print $this->Form->input('tem_estoque_ilimitado',array('label'=>'Estoque ilimitado?','options'=>array('0'=>'Não','1'=>'Sim')));
			?>
		</div>
		<div class="div2_3">
			<?php
			print $this->Form->input('estoque_minimo',array('label'=>'Estoque mínimo'));
			print $this->Form->input('unidade',array('label'=>'Unidade'));
			print $this->Form->input('quantidade_estoque_fiscal',array('label'=>'Qtd. estoque fiscal'));
			print $this->Form->input('quantidade_estoque_nao_fiscal',array('label'=>'Qtd. estoque não fiscal'));
			?>
		</div>
		<div class="div3_3">
			<div style="margin-top: 4%; border: 1px solid">
				<input type="checkbox" name="ProdutoCalcularPreco" id="ProdutoCalcularPreco" checked="checked" />
				<label>Calcular preço de venda?</label>
			</div>
			<div>
				<?php
				print $this->Form->input('preco_custo',array('label'=>'Preço de custo','type'=>'text'));
				print $this->Form->input('preco_venda',array('label'=>'Preço de venda','type'=>'text'));
				print $this->Form->input('margem_lucro',array('label'=>'Margem de lucro (%)','type'=>'text'));
				?>
			</div>
			
		</div>
	</div>
	<div class="limpar">&nbsp;</div>
<?php print $this->Form->end('Gravar'); ?>
