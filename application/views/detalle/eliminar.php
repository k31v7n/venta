<div class="form-horizontal">
	<?php if ($producto): ?>
		<?php if ($producto->cantidad == 1): ?>
			<p>¿Está seguro de eliminar este producto?</p>
			<input type="hidden" id="unico" value="<?php echo $producto->cantidad; ?>">

		<?php else: ?>
			<div class="form-group form-group-sm">
				<div class="col-md-12">
					<div class="alert alert-warning alerte">
						Al realizar esta acción se quitará el descuento si aplica.
					</div>
					<p>Ingrese la cantidad a eliminar</p>
					<input type="number" class="form-control" id="cantidad" placeholder="Cantidad...">
					<div class="checkbox">
						<label><input type="checkbox" id="todo" value="<?php echo $producto->cantidad ?>"> Eliminar Todo</label>
					</div>
				</div>
			</div>
		<?php endif ?>
	<?php else: ?>
		<p>Error al tratar de eliminar el producto</p>
	<?php endif ?>
</div>
