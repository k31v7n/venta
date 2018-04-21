<?php
$cantidad  = 0;
$descuento = "0.00";
$subtotal  = "0.00";
$total     = "0.00";
if($resumen){
	$cantidad  = $resumen->cantidad;
	$descuento = $resumen->descuento;
	$subtotal  = $resumen->subtotal;
	$total     = $resumen->total;
}
?>

<button type="button" class="close" onclick="cerrar('resumencont');">&times;</button>
<h4 class="h4 abajo">
	<i class="glyphicon glyphicon-shopping-cart"></i>
	Resumen
</h4>
<ul class="list-group">
	<li class="list-group-item" style="padding: 4px;">
		Cantidad de Articulos
		<span class="pull-right"><b><?php echo $cantidad ?></b></span>
	</li>
	<li class="list-group-item" style="padding: 4px;">
		Descuento
		<span class="pull-right"><b><?php echo $descuento ?></b></span>
	</li>
	<li class="list-group-item" style="padding: 4px;">
		Subtotal
		<span class="pull-right"><b><?php echo $subtotal; ?></b></span>
	</li>
	<li class="list-group-item" style="padding: 4px; color:#FFF; background: #4CAE4C;">
		Total
		<span class="pull-right"><b><?php echo $total; ?></b></span>
	</li>
</ul>
<table class="table">
	<tr>
		<td>
			<button class="btn btn-sm btn-primary todo btnV" onclick="cargarCobro(<?php echo $venta; ?>)">
				<i class="glyphicon glyphicon-ok"></i> Completar Venta
			</button>
		</td>
		<td>
			<button class="btn btn-sm btn-danger todo btnV" onclick="accionVenta(<?php echo $venta;?>, 3)">
			<i class="glyphicon glyphicon-remove"></i> Anular Venta
			</button>
		</td>
	</tr>
</table>