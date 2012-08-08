<div class="row-fluid">
	
	<div class="span12">
		<fieldset>
			<legend class="descricao_cabecalho"><?php print __('Cadastrar categoria de fornecedor'); ?></legend>

			<?php
			if ($this->Ajax->isAjax()) {
				print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'FornecedorCategoria','update'=>'conteudo_ajax'));

			}
			else {
				print $this->Form->create('FornecedorCategoria',array('autocomplete'=>'off'));
			}

			print $this->Form->input('descricao',array('label'=>__('Descrição'),'class'=>'span4'));
			print $this->Form->end(__('Gravar'));
			?>
		</fieldset>
	</div>

</div>