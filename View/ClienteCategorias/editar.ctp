<div class="row-fluid">
	
	<div class="span12">
		<fieldset>
			<legend class="descricao_cabecalho"><?php print __('Editar categoria de cliente'); ?></legend>

			<?php
			if ($this->Ajax->isAjax()) {
				print $this->Ajax->form('editar','post',array('autocomplete'=>'off','model'=>'ClienteCategoria','update'=>'conteudo_ajax'));

			}
			else {
				print $this->Form->create('ClienteCategoria',array('autocomplete'=>'off'));
			}

			print $this->Form->input('descricao',array('label'=>__('Descrição'),'class'=>'span4'));
			print $this->Form->end(__('Gravar'));
			?>
		</fieldset>
	</div>

</div>