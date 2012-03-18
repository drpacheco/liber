<?php

class ClientesController extends AppController {
	var $name = 'Clientes'; // PHP 4
	var $components = array('RequestHandler');
	var $helpers = array('CakePtbr.Estados','Ajax', 'Javascript');
	var $paginate = array (
		'limit' => 10,
		'order' => array (
			'Cliente.id' => 'desc'
		)
	);

	/**
	* @var $Cliente
	*/
	var $Cliente;
           
	/**
	 * Obtem dados necessarios ao decorrer deste controller.
	 * Os dados sao setados em variaveis a serem utilizadas nas views 
	 */
	function _obter_opcoes() {
		$this->loadModel('ClienteCategoria');
		$this->ClienteCategoria->recursive = -1;
		$consulta1 = $this->ClienteCategoria->find('list',array('fields'=>array('ClienteCategoria.id','ClienteCategoria.descricao')));
		$this->set('opcoes_categoria_cliente',$consulta1);
		
		$this->loadModel('Empresa');
		$this->Empresa->recursive = -1;
		$consulta2 = $this->Empresa->find('list',array('fields'=>array('Empresa.id','Empresa.nome')));
		$this->set('opcoes_empresa',$consulta2);

		return null;
	}
	
	
	/**
	 * Lista todos os Clientes
	 */
	function index() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$dados = $this->paginate('Cliente');
		$this->set('consulta_cliente',$dados);
	}
	
	function cadastrar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->_obter_opcoes();
		if (! empty($this->data)) {
			$this->data['Cliente'] += array ('data_cadastrado' => date('Y-m-d H:i:s'));
			$this->data['Cliente'] += array ('usuario_cadastrou' => $this->Auth->user('id'));
			
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash('Cliente cadastrado com sucesso.','flash_sucesso');
				$this->redirect(array('controller'=>'Clientes'));
			}
			else {
				$this->Session->setFlash('Erro ao cadastrar o cliente.','flash_erro');
			}
		}
	}
	
	function editar($id=NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		$this->_obter_opcoes();
		if (empty ($this->data)) {
			$this->Cliente->recursive = -1;
			$this->data = $this->Cliente->read();
			if ( ! $this->data) {
				$this->Session->setFlash('Cliente não encontrado.','flash_erro');
				$this->redirect(array('controller'=>'Clientes','action'=>'pesquisar'));
			}
		}
		else {
			$this->data['Cliente']['id'] = $id;
			$this->data['Cliente'] += array ('atualizado' => date('Y-m-d H:i:s'));
			$this->data['Cliente'] += array ('usuario_alterou' => $this->Auth->user('id'));
			
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash('Cliente atualizado com sucesso.','flash_sucesso');
				$this->redirect(array('controller'=>'Clientes'));
			}
			else {
				$this->Session->setFlash('Erro ao atualizar o cliente.','flash_erro');
			}
		}
	}
	
	function pesquisar() {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if (! empty($this->data)) {
			//usuario enviou os dados da pesquisa
			$url = array('controller'=>'Clientes','action'=>'pesquisar');
			//convertendo caracteres especiais
			if( is_array($this->data['Cliente']) ) {
				foreach($this->data['Cliente'] as &$cliente) {
					$cliente = urlencode($cliente);
				}
			}
			$params = array_merge($url,$this->data['Cliente']);
			$this->redirect($params);
		}
		
		if (! empty($this->params['named'])) {
			//a instrucao acima redirecionou para cá
			$dados = $this->params['named'];
			$condicoes=array();
			if (! empty($dados['nome'])) $condicoes[] = array('Cliente.nome LIKE'=>'%'.$dados['nome'].'%');
			if (! empty($dados['nome_fantasia'])) $condicoes[] = array('Cliente.nome_fantasia LIKE'=>'%'.$dados['nome_fantasia'].'%');
			if (! empty($dados['bairro'])) $condicoes[] = array('Cliente.bairro'=>$dados['bairro']);
			if (! empty($dados['cidade'])) $condicoes[] = array('Cliente.cidade'=>$dados['cidade']);
			if (! empty($dados['cnpj'])) $condicoes[] = array('Cliente.cnpj'=>$dados['cnpj']);
			if (! empty($dados['inscricao_estadual'])) $condicoes[] = array('Cliente.inscricao_estadual'=>$dados['inscricao_estadual']);
			if (! empty($dados['cpf'])) $condicoes[] = array('Cliente.cpf'=>$dados['cpf']);
			if (! empty($dados['rg'])) $condicoes[] = array('Cliente.rg'=>$dados['rg']);
			if (! empty ($condicoes)) {
				$resultados = $this->paginate('Cliente',$condicoes);
				if (! empty($resultados)) {
					$num_encontrados = count($resultados);
					$this->set('resultados',$resultados);
					$this->set('num_resultados',$num_encontrados);
					$this->Session->setFlash("$num_encontrados cliente(s) encontrado(s)",'flash_sucesso');
				}
				else $this->Session->setFlash("Nenhum cliente encontrado",'flash_erro');
			}
			else {
				$this->set('num_resultados','0');
				$this->Session->setFlash("Nenhum resultado encontrado",'flash_erro');
			}
		}
	}
	
	function detalhar($id = NULL) {
		if ( $this->RequestHandler->isAjax() ) {
			$this->layout = 'default_ajax';
		}
		if ($id) {
			$this->Cliente->id = $id;
			$this->Cliente->contain('Usuario','Usuario2');
			$r = $this->Cliente->read();
			if (empty($r)) {
				$this->Session->setFlash("Cliente $id não encontrado");
				return null;
			}
			else $this->set('cliente',$r);
		}
		else {
			$this->Session->setFlash('Erro: nenhum cliente informado.','flash_erro');
		}
	}
	
	function pesquisaAjaxCliente($campo_a_pesquisar,$termo = null) {
		if (strtoupper($campo_a_pesquisar) == "NOME") $campo = 'nome';
		else if (strtoupper($campo_a_pesquisar) == "CODIGO") $campo = 'id';
		else return null;
		if (! isset($termo)) $termo = $this->params['url']['term'];
		if ( $this->RequestHandler->isAjax() ) {
			$i=0;
			$resultados=array();
			$retorno=array();
			$r = array();
   			Configure::write ('debug',0);
   			$this->autoRender=false;
			if ($campo == 'id') {
				$condicoes = array('Cliente.id'=>$termo);
			}
			else {
				$condicoes = array("Cliente.$campo LIKE" => '%'.$termo.'%');
			}
			$resultados = $this->Cliente->find('all',array('fields' => array('id','nome','situacao'),'conditions'=>$condicoes));
			if (!empty($resultados)) {
				foreach ($resultados as $r) {
					$retorno[$i]['label'] = $r['Cliente']['nome'];
					$retorno[$i]['value'] = $r['Cliente'][$campo];
					$retorno[$i]['id'] = $r['Cliente']['id'];
					$retorno[$i]['nome'] = $r['Cliente']['nome'];
					$retorno[$i]['bloqueado'] = ($r['Cliente']['situacao'] == 'B') ? 1 : 0;
					$retorno[$i]['inativo'] = ($r['Cliente']['situacao'] == 'I') ? 1 : 0;
					$retorno[$i]['situacao'] = $r['Cliente']['situacao'];
					$i++; 
				}
				print json_encode($retorno);
			}
		}
	}

}

?>