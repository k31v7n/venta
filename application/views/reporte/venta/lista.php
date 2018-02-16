<?php if (isset($ventas) && $ventas): ?>
	<?php foreach ($ventas as $key => $row): ?>
		<tr>
			<td><?php echo formatoFecha($row->fecha,2) ?></td>
			<td><?php echo formatoFecha($row->fecha_vendido,2) ?></td>
			<td><?php echo $row->usuario ?></td>
			<td><?php echo $row->total ?></td>
			<td>
				<button class="btn btn-xs btn-success" onclick="editaVenta(<?php echo $row->venta ?>)">
					<i class="glyphicon glyphicon-edit"></i>
				</button>
			</td>
		</tr>
	<?php endforeach ?>
<?php endif ?>

<?php if (isset($mas)): ?>
	<tr id="verMas">
		<td colspan="100%"><a href="javascript:;" onclick="cargarMas(<?php echo $mas; ?>)">Cargar Mas</a></td>
	</tr>
<?php endif ?>