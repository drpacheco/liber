<div class="row-fluid">
	
	<div class="span12">
		<fieldset>
			<legend class="descricao_cabecalho"><?php print __('Cadastrar categoria de serviço'); ?></legend>
			<?php
			if ($this->Ajax->isAjax()) {
				print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'ServicoCategoria','update'=>'conteudo_ajax'));

			}
			else {
				print $this->Form->create('ServicoCategoria',array('autocomplete'=>'off','onsubmit'=>'submissaoFormulario(this); return false;'));
			}
			print $this->Form->input('nome',array('label'=>__('Nome'),'class'=>'span4'));
			print $this->Form->end('Gravar');
			?>
		</fieldset>
	</div>

</div>