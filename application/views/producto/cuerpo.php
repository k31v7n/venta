<div class="col-sm-12 mbordenav">
	<nav class="navbar navbar-default sombra sinmargen">
		<div class="navbar-body">
			<div class="navbar-brand">
				<i class="glyphicon glyphicon-shopping-cart"></i> 	Mantenimiento de Productos
			</div>

			<button class="navbar-btn btn btn-xs btn-success">
				<i class="glyphicon glyphicon-save"></i> Exportar
			</button>
		</div>
	</nav>
</div>

<div class="col-sm-5 mbordepright" style="height: 78%;">
	<div class="panel panel-default sombra" style="height: 100%;">
		<div class="panel-body">
			<div id="Fcategoria"></div>
				<table class="table table-bordered table-smx">
					<thead>
						<tr class="active">
							<th colspan="100%">Categorias
								<button class="btn btn-xs btn-primary pull-right" onclick="abrirForm({'opcion':1})">
									<i class="glyphicon glyphicon-plus"></i> Categoria
								</button>
							</th>
						</tr>
						<tr>
							<th>Nombre</th>
							<th>Empresa</th>
							<th width="40px;"></th>
						</tr>
					</thead>
					<tbody id="clista">
						<?php $this->load->view("producto/clista") ?>
					</tbody>
				</table>
		</div>
	</div>
</div>

<div class="col-sm-7 mbordes mbordepleft" style="height: 78%;">
	<div class="panel panel-default sombra" style="height: 100%;">
		<div class="panel-body">
			<div id="Fproducto"></div>
			<div class="table-responsive">
				<table class="table table-bordered table-smx">
					<thead>
						<tr class="active">
							<th colspan="100%">
								Productos de categoria <b><spam id="nocategoria"></spam></b>
								<input type="hidden" id="xcategoria">
								<button class="btn btn-xs btn-danger pull-right" onclick="abrirForm({'opcion':5})">
									<i class="glyphicon glyphicon-plus"></i> Producto
								</button>
							</th>
						</tr>
						<tr>
							<th>Código</th>
							<th>Descripción</th>
							<th>Código Alterno</th>
							<th>Existencias</th>
							<th>Precio Original</th>
							<th>Precio Venta</th>
						</tr>
					</thead>
					<tbody id="ListaProductos">
						<tr>
							<td colspan="100%" class="text-center">
								Es necesario seleccionar una categoria
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>