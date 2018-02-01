<div class="table-responsive">
	<table class="table table-hover letra">
		<tr class="active">
			<th colspan="100%"><i class="glyphicon glyphicon-stats"></i> Articulos agregados</th>
		</tr>
		<tr>
			<th class="text-center">Código</th>
			<th class="text-center">Nombre</th>
			<th class="text-center">Cantidad</th>
			<th class="text-center">Precio</th>
			<th class="text-center">Desc.</th>
			<th class="text-center">Subtotal</th>
			<th class="text-center">Total</th>
			<th class="text-center"><i class="glyphicon glyphicon-trash"></i></th>
		</tr>
		<?php if (isset($listapro) && $listapro): ?>
			<?php foreach ($listapro as $row): ?>
				<tr>
					<td><?php echo $row->codigo ?></td>
					<td><?php echo $row->nombre ?></td>
					<td class="text-center"><?php echo $row->cantidad ?></td>
					<td class="text-center"><?php echo $row->precioventa; ?></td>
					<td class="text-center">
						<?php
						$cant  = ($row->cant_aplica) ? $row->cant_aplica : 0;
						$title = "Aplica descuento para {$cant} producto(s)";
						?>
						<a href="javascript:;" onclick="cargardescuento(<?php echo "{$row->venta},{$row->producto}";?>)" title="<?php echo $title; ?>">
							<?php echo $row->descuento ?>
						</a>
					</td>
					<td class="text-right"><?php echo $row->subtotal ?></td>
					<td class="text-right"><?php echo $row->total ?></td>
					<td class="text-center"><a href="javascript:;" class="btn-rojo todo" onclick="eleminarProducto(<?php echo "{$row->venta},{$row->producto}";?>);"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>
</div>
