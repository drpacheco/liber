<h2 class="descricao_cabecalho">Cadastrar categoria de fornecedor</h2>

<?php

if ($this->Ajax->isAjax()) {
	print $this->Ajax->form('cadastrar','post',array('autocomplete'=>'off','model'=>'FornecedorCategoria','update'=>'conteudo_ajax'));

}
else {
	print $this->Form->create('FornecedorCategoria',array('autocomplete'=>'off'));
}

print $this->Form->input('descricao',array('label'=>'Descrição'));
print $this->Form->end('Gravar');

?>
