<?php if (isset($productos) && $productos): ?>
	<?php foreach ($productos as $key => $row): ?>
		<tr>
			<td class="table-pr text-center">
				<input type="checkbox" value="<?php echo $row->codigo;?>" class="item-pro" corre="<?php echo $key; ?>">
			</td>	
			<td class="table-pr"><?php echo $row->codigo ?></td>
			<td class="table-pr"><?php echo $row->nombre ?></td>
			<td class="table-pr"><?php echo $row->ncategoria ?></td>
			<td class="table-pr">
				<input type="number" class="form-control inp-lista letra" id="precio<?php echo $key?>" value="<?php echo $row->precio_venta ?>">
			</td>
			<td class="table-pr">
				<input type="number" class="form-control inp-lista letra" id="cantidad<?php echo $key?>" value="1">
			</td>
			
		</tr>
	<?php endforeach ?>
<?php endif ?>

<?php if (isset($vermas)): ?>
	<tr id="vermas">
		<td colspan="100%" class="text-center">
			<p id="textmas">
			<a href="javascript:;" onclick="cargarMas(<?php echo $vermas ?>)">Cargar Mas</a>
			</p>
		</td>
	</tr>
<?php endif ?>