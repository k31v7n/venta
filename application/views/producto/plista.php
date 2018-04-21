<?php if (isset($lista) && $lista): ?>
	<?php foreach ($lista as $row): ?>
		<tr>
			<td><?php echo $row->codigo ?></td>
			<td>
				<a href="javascript:;" onclick="abrirForm({'opcion':5,'registro':<?php echo $row->producto ?>})"><?php echo $row->nombre ?></a>
			</td>
			<td><?php echo $row->codigo_alterno ?></td>
			<td><?php echo $row->cantidad ?></td>
			<td><?php echo $row->precio_original ?></td>
			<td><?php echo $row->precio_venta ?></td>
		</tr>
	<?php endforeach ?>
<?php endif ?>