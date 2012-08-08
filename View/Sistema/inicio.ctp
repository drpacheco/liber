<script type="text/javascript">
	$(function(){
		$( ".column" ).sortable({
			connectWith: ".column"
		});

		$( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
			.find( ".portlet-header" )
				.addClass( "ui-widget-header ui-corner-all" )
				.prepend( "<span class='ui-icon ui-icon-minusthick'></span>")
				.end()
			.find( ".portlet-content" );

		$( ".portlet-header .ui-icon" ).click(function() {
			$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
			$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
		});

		$( ".column" ).disableSelection();
	});
</script>

<style type="text/css">
	.portlet { margin: 0 1em 1em 0; }
	.portlet-header { margin: 0.3em; padding-bottom: 4px; padding-left: 0.2em; }
	.portlet-header .ui-icon { float: right; }
	.portlet-content { padding: 0.4em; }
	.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
	.ui-sortable-placeholder * { visibility: hidden; }
</style>

<div>
	
	<div class="row">
		
		<div class="column span6">

			<div class="portlet">
				<div class="portlet-header">Contas a receber</div>
				<div class="portlet-content">
					<?php if (!empty($contasReceber)) print $contasReceber ?>
				</div>
			</div>

		</div>

		<div class="column span6">

			<div class="portlet">
				<div class="portlet-header">Contas a pagar</div>
				<div class="portlet-content">
					<?php if (!empty($contasPagar)) print $contasPagar ?>
				</div>
			</div>

		</div>
		
	</div>
	
	<div class="row">
		
		<div class="column span6">
			<div class="portlet">
				<div class="portlet-header">Teste</div>
				<div class="portlet-content">
					teste teste teste teste teste
				</div>
			</div>
		</div>
		
		<div class="column span6">
			<div class="portlet">
				<div class="portlet-header">Teste 2</div>
				<div class="portlet-content">
					teste teste teste
				</div>
			</div>
		</div>
		
	</div>
	
</div>