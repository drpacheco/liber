<?php

/**
 * Classe para utilização do plugin jquery, Jqplot
 * 
 * #TODO criar metodo para javascript->link nao utilizar o scripts_for_layout
 */
class JqplotHelper extends AppHelper {
	
	var $helpers = array('Html','Javascript');
	
	function showHeaders () {
		$retorno = null;
		$this->Javascript->link('jqplot/jquery.jqplot.js',false);
		$this->Javascript->link('jqplot/plugins/jqplot.donutRenderer.js',false);
		$this->Javascript->link('jqplot/plugins/jqplot.pieRenderer.js',false);
		
		$retorno += '
			<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="jqplot/excanvas.js"></script><![endif]-->
		';
		$retorno += $this->Html->css('jquery.jqplot.css');
		
		
		return $this->output($retorno);
	}
	
}


?>