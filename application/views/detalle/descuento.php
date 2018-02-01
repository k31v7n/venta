<div class="well well-sm">
	<button type="button" class="close" onclick="cerrar('descuentoProducto','ventaProductos');">&times;</button>
	<p><i class="glyphicon glyphicon-tag"></i> Descuento Producto: <b><?php echo "{$nombre} ({$codigo})"; ?></b></p>
	<?php echo $open; ?>
		<div class="form-group form-group-sm">
			<?php echo $lab_precio; ?>
			<div class="col-sm-4">
				<?php echo $precio; ?>
			</div>

			<?php echo $lab_subtotal; ?>
			<div class="col-sm-4">
				<?php echo $subtotal; ?>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<?php echo $lab_cantidad; ?>
			<div class="col-sm-4">
				<?php echo $cantidad; ?>
			</div>

			<?php echo $lab_totdescuento; ?>
			<div class="col-sm-4">
				<?php echo $totdescuento; ?>
			</div>
		</div>
		<div class="form-group form-group-sm">
			<?php echo $lab_porcentaje; ?>
			<div class="col-sm-4">
				<?php echo $porcentaje; ?>
			</div>

			<?php echo $lab_total; ?>
			<div class="col-sm-4">
				<?php echo $total; ?>
			</div>
		</div>

		<div class="col-sm-3 col-sm-offset-1 checkbox">
				<label><?php echo $aplica ?> Aplica Todos</label>
			</div>
		<div class="text-right">
			<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
			<button type="button" class="btn btn-sm btn-default" onclick="cerrar('descuentoProducto','ventaProductos');"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
		</div>
	<?php echo $cerrar; ?>
</div>