<div class="container-fluid ajusta">
	<!-- Para mostrar las pestanias -->
	<div class="navbar navbar-default sombra abajo">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle btn-xs boton" data-toggle="collapse" data-target="#myNavbar">
					<i class="glyphicon glyphicon-menu-hamburger"></i>
				</button>
				<a class="navbar-brand" href="#">
					<i class="glyphicon glyphicon-list-alt"></i> Detalle Venta
					<span id="numeroventa"></span>
				</a>
			</div>
			<div id="Listapestanias"></div>
		</div>
	</div>

	<!-- Para ver el formulario de registro -->
	<div class="col-md-5 ajusta-p1">
		<div class="panel panel-default sombra abajo sinradio">
			<div class="panel-body" id="formCaptura"></div>
		</div>

		<!-- Para el resumen -->
		<div class="panel panel-default sombra abajo sinradio" id="resumencont">
			<div class="panel-body" id="contResumen">
			</div>
		</div>

		<!-- Para ver el form de cobrar -->
		<div class="panel panel-default sombra abajo sinradio" id="cobrarform">
			<div class="panel-body" id="contCobrar">
			</div>
		</div>
	</div>

	<!-- Para ver el detalle -->
	<div class="col-md-7 ajusta-p2">
		<div class="panel panel-default abajo sombra sinradio alto">
			<div class="panel-body">
				<div id="descuentoProducto" style="display: none;"></div>
				<div id="ventaProductos"></div>
			</div>
		</div>
	</div>
</div>

<script>cargarVenta(<?php echo $ultima; ?>,1);</script>
