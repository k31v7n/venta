<?php if (isset($categoria) && $categoria): ?>
	<?php foreach ($categoria as $row): ?>
		<tr>
			<td><a href="javascript:;" onclick="abrirForm({'opcion':1, 'registro':<?php echo $row->categoria ?>})">
				<?php echo $row->nombre ?>
			</a></td>
			<td><?php echo $row->empresa ?></td>
			<td class="text-center">
				<div class="btn-group" role="group">
				    <button id="btnGroupDrop1" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      <i class="glyphicon glyphicon-cog"></i>
				    </button>
				    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
				      <li><a class="dropdown-item" href="javascript:;" onclick="abrirForm({'opcion':4,'registro':<?php echo $row->categoria?>,'nombre':'<?php echo $row->nombre ?>'})">Productos</a></li>
				      <li><a class="dropdown-item" href="javascript:;" onclick='accionProducto(<?php echo "2,{$row->categoria}"?>)'>Eliminar</a></li>
				    </ul>
  				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php endif ?>