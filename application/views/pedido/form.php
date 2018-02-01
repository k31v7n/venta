<?php
$idventa         = "";
$campocantidad = "";
if($venta){
	$idventa         = $venta->venta;
	$campocantidad = $venta->campocantidad;
}
?>

<h4 class="h4 abajo">
	<b><i class="glyphicon glyphicon-folder-open"></i></b>&nbsp;
	Captura de Venta
	<div class="pull-right">
		<div class="btn-group">
			<button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="glyphicon glyphicon-cog"></i>
			</button>
			<ul class="dropdown-menu dropdown-menu-right">
				<?php if ($campocantidad == 0): ?>
					<li><a href="javascript:;" onclick="accionVenta(<?php echo "{$idventa}, 1";?>);">Habiliar Campo Cantidad</a></li>
				<?php else: ?>
					<li><a href="javascript:;" onclick="accionVenta(<?php echo "{$idventa}, 1";?>);">Deshabilitar Campo Cantidad</a></li>
				<?php endif ?>
				<li><a href="javascript:;" onclick="accionVenta(<?php echo "{$idventa}, 2";?>);">Reiniciar Venta</a></li>
				<li><a href="javascript:;" onclick="cerrar('cobrarform','resumencont')">Ver Resumen</a></li>
				<li><a href="javascript:;" onclick="cargarCobro(<?php echo "{$idventa}";?>);">Cobrar</a></li>
				<li><a href="javascript:;" onclick="accionVenta(<?php echo "{$idventa}, 3";?>);">Anular</a></li>
			</ul>
		</div>
		<button class="btn btn-xs btn-default" onclick="abrirProducto(<?php echo "{$idventa}";?>);">
				<i class="glyphicon glyphicon-shopping-cart"></i>
			</button>
	</div>
</h4>
<form action="<?php echo $accion; ?>" method="POST" id="formGuardar">
	<input type="hidden" name="venta" id="noventa" value="<?php echo $idventa; ?>">
	<?php $tam = ($campocantidad == 1)? "col-md-7" : "col-sm-10"; ?>
	<div class="<?php echo $tam; ?> sinpading">
		<div class="input-group">
			<span class="input-group-addon sinradio" id="basic-addon3">
				<b><i class="glyphicon glyphicon-barcode"></i>&nbsp;</b> Código
			</span>
			<input type="text" class="form-control sinradio" id="codigo" aria-describedby="basic-addon3" placeholder="Producto ..." name="codigo" autocomplete="off">
		</div>
	</div>
	<?php if ($campocantidad == 1): ?>
		<div class="col-sm-3 sinpading">
			<input type="number" class="form-control sinradio" placeholder="Cantidad..." name="cantidad" required="required">
		</div>
	<?php endif ?>
	<div class="col-md-2 sinpading">
		<button class="btn btn-primary sinradio todo" id="btnGuardar">Agregar</button>
	</div>
</form>
