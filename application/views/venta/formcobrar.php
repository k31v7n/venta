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
<div class="alert alert-warning sinpading sinmargen" id="notacliente">
	<b>¡Nota!</b> Si no tiene dato de cliente dejarlo vacio
</div>
<form action="<?php echo $accion; ?>" class="form-horizontal" method="post" id="formCobrar">
	<input type="hidden" name="venta" value="<?php echo $venta ?>">
	<input type="hidden" name="descuento" value="<?php echo $descuento ?>">
	<input type="hidden" name="total" value="<?php echo $total ?>">
	<input type="hidden" name="subtotal" value="<?php echo $subtotal ?>">

	<div class="list-group-item	">
		<p class="text-right sinmargen"><b><i class="glyphicon glyphicon-list-alt"></i> Formulario de Cobro</b></p>
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
		<p><b><i class="glyphicon glyphicon-usd"></i> Forma de Pago</b>
			<b><span class="text-danger pull-right">Total a pagar <?php echo $total ?></span></b>
		</p>

		<div class="form-group form-group-sm">
			<label class="col-sm-2 control-label">Efectivo</label>
			<div class="col-sm-10">
				<input type="number" step="0.01" name="efectivo" class="form-control">
			</div>
		</div>

		<div class="form-group form-group-sm">
			<label class="col-sm-2 control-label">Tarjeta</label>
			<div class="col-sm-10">
				<input type="number" step="0.01" name="tarjeta" class="form-control">
			</div>
		</div>
		<div class="form-group form-group-sm">
			<label class="col-sm-2 control-label">Crédito</label>
			<div class="col-sm-10">
				<input type="number" step="0.01" name="credito" class="form-control">
			</div>
		</div>

		<div class="form-group form-group-sm">
			<div class="col-sm-12 text-right">
				<button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-usd"></i> Cobrar</button>
				<button type="button" class="btn btn-danger btn-sm" onclick="cerrar('cobrarform','resumencont')"><i class="glyphicon glyphicon-remove"></i>Cancelar</button>
			</div>
		</div>
	</div>
</form>