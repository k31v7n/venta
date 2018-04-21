<?php
$descuento = "0.00";
$subtotal  = "0.00";
$total     = "0.00";
if($montos){
	$descuento = $montos->descuento;
	$subtotal  = $montos->subtotal;
	$total     = $montos->total;
}
?>

<form action="<?php echo $accion; ?>" class="form-horizontal" method="post" id="formCobrar">
	<input type="hidden" name="venta" value="<?php echo $venta ?>">
	<input type="hidden" name="descuento" value="<?php echo $descuento ?>">
	<input type="hidden" name="total" value="<?php echo $total ?>">
	<input type="hidden" name="subtotal" value="<?php echo $subtotal ?>">

	<div class="list-group-item	">
		<div class="alert alert-warning sinpading sinmargen" id="notacliente">
			<b>¡Nota!</b> Si no tiene dato de cliente dejarlo vacio
			<span class="pull-right"><b><i class="glyphicon glyphicon-list-alt"></i> Formulario de Cobro</b></b></span>
		</div>
		<p><b><i class="glyphicon glyphicon-user"></i> Datos de Cliente</b></p>
		<div class="form-group form-group-sm">
			<label class="col-sm-2 control-label">Cliente</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="cliente">
			</div>
		</div>
		<div class="form-group form-group-sm">
			<label class="col-sm-2 control-label">Nit</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="nit">
			</div>

			<label class="col-sm-2 control-label">Dirección</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="direccion">
			</div>
		</div>
	</div>
	<div class="list-group-item	">
		<input type="hidden" id="montoventa" value="<?php echo $total; ?>">
		<h4 class="text-danger bg-danger text-center"><b>Total a pagar <?php echo $total ?></b></h4>
		<div id="Formpagox">
		</div>

		<div class="form-group form-group-sm">
			<div class="col-sm-12 text-center">
				<button class="btn btn-info btn-sm"><i class="glyphicon glyphicon-ok"></i> Cobrar</button>
				<button type="button" class="btn btn-default btn-sm" onclick="cargarListaProductos(<?php echo $venta ?>)"><i class="glyphicon glyphicon-remove"></i>Cancelar</button>
			</div>
		</div>
	</div>
</form>