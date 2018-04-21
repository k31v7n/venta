<?php
$efectivo = "0.00";
$tarjeta  = "0.00";
$credito  = "0.00";
$venta    = "";
if ($detalle) {
	$Venta    = $detalle->venta;
}
?>

<?php if (isset($mensaje)): ?>
	<div class="col-sm-12 text-center">
		<p><?php echo $mensaje; ?></p>
		<button class="btn btn-sm btn-default" onclick="cargarCobro($venta)">
			<i class="glyphicon glyphicon-repeat"></i> Reintentar
		</button>
	</div>
<?php else: ?>
	<div class="list-group-item">
		<h4 class="text-center">
			<b><i class="glyphicon glyphicon-shopping-cart"></i> Venta # <?php echo $Venta;?></b>
		</h4>
		<button class="btn btn-sm btn-info pull-right">
			<i class="glyphicon glyphicon-print"></i>
		</button>
		<p>
			<b><i class="glyphicon glyphicon-list-alt"></i>
			Datos de la Factura</b>
		</p>
		<p>	Número: <?php echo $detalle->numero; ?>
			<span style="margin-left: 30px;">Serie: <?php echo $detalle->serie; ?></span><br>
			Descripción: <b>Por la compra de <?php echo $detalle->articulos ?> articulos.</b>
		</p>
		<hr class="sinpading sinmargen">
		<p>
			Nombre: <?php echo $detalle->nombre ?><br>
			NIT: <?php echo $detalle->nit ?>
			<span style="margin-left: 30px;">Dirección: <?php echo $detalle->direccion ?></span>
		</p>
		<div class="text-danger text-right">
			<b>Descuento: <?php echo $detalle->descuento ?></b><br>
			<b>Subtotal: <?php echo $detalle->subtotal ?></b><br>
			<b>Total: <?php echo $detalle->total ?></b>
		</div>
		<div class="text-center">
			<button class="btn btn-sm btn-default" onclick="cargarVenta(<?php echo $ultima; ?>, 1)">
				<i class="glyphicon glyphicon-refresh"></i>
				Continuar
			</button>
		</div>
	</div>
<?php endif ?>