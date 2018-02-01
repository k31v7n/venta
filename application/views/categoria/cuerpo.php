<div class="list-group-item">
	<button type="button" class="close" onclick="cargarListaProductos(<?php echo $venta ?>);">&times;</button>
<h4 class="h4 abajo"><i class="glyphicon glyphicon-list-alt"></i> Lista de Productos</h4>
<nav class="navbar navbar-default sinradio">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle btn-xs boton" data-toggle="collapse" data-target="#myproducto">
					<i class="glyphicon glyphicon-menu-hamburger"></i>
				</button>
			<a class="navbar-brand" href="javascript:;">
				Categorias
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myproducto">
			<ul class="nav navbar-nav categorias">
				<?php if (isset($categoria) && $categoria): ?>
					<?php foreach ($categoria as $row): ?>
					<li class="catego">
						<a href="javascript:;" onclick="buscarProducto(<?php echo $row->categoria ?>)">
							<?php echo $row->nombre ?>
						</a>
					</li>
					<?php endforeach ?>
				<?php endif ?>
			</ul>
		</div>
	</div>
</nav>

<div class="table-responsive">
	<table class="table table-hover table-bordered letra">
		<thead>
			<tr class="active">
				<th class="table-pr">Código</th>
				<th class="table-pr">Nombre</th>
				<th class="table-pr">Categoria</th>
				<th class="table-pr" width="100">Precio Venta</th>
				<th class="table-pr" width="100">Cantidad</th>
				<th class="table-pr text-center" width="50"></th>
			</tr>
		</thead>
		<tbody id="ListaProducto">

		</tbody>
	</table>
</div>

<div class="text-right">
	<button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-ok"></i> Agregar</button>
	<button class="btn btn-sm btn-default" onclick="cargarListaProductos(<?php echo $venta ?>);"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
</div>

</div>