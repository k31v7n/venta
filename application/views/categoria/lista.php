<?php if (isset($productos) && $productos): ?>
	<?php foreach ($productos as $key => $row): ?>
		<tr id='<?php echo "fila{$key}" ?>'>
			<td class="table-pr"><?php echo $row->codigo ?></td>
			<td class="table-pr"><?php echo $row->nombre ?></td>
			<td class="table-pr"><?php echo $row->ncategoria ?></td>
			<td class="table-pr"><input type="number" class="form-control inp-lista letra" value="<?php echo $row->precio_venta ?>"></td>
			<td class="table-pr"><input type="number" class="form-control inp-lista letra" value="1"></td>
			<td class="table-pr text-center"><input type="checkbox" value="<?php echo $row->codigo;?>" onclick="file(this,<?php echo $key?>)"></td>
		</tr>
	<?php endforeach ?>
<?php endif ?>