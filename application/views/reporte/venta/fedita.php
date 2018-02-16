<?php 
$creacion = '';
$vendido  = '';
$xventa   = 0;
if($venta){
	$creacion = formatoFecha($venta->fecha,0);
	$vendido  = formatoFecha($venta->fecha_vendido,0);
	$xventa   = $venta->venta;
}
?>
<div class="list-group-item">
	<form action="<?php echo $accion; ?>" method="POST" class="form-horizontal" id="FormGuardar">
		<input type="hidden" value="<?php echo $xventa ?>" name="venta">

		<div class="form-group form-group-sm">
			<label class="control-label col-sm-2">Fecha</label>
			<div class="col-sm-10">
				<input type="date" name="fecha" class="form-control" value="<?php echo $creacion ?>">
			</div>
		</div>

		<div class="form-group form-group-sm">
			<label class="control-label col-sm-2">Fecha Vendida</label>
			<div class="col-sm-10">
				<input type="date" name="fecha_vendido" class="form-control" value="<?php echo $vendido ?>">
			</div>
		</div>

		<div class="form-group text-center">
			<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
		</div>
	</form>
</div>