<style>
label{
	font-weight: normal;
}
</style>
<div class="container-fluid ajusta">

	<!-- Para ver el formulario de registro -->
	<div class="col-md-5 ajusta-p1">
		<div class="panel panel-default sombra abajo sinradio">
			<div class="panel-body" id="contForm">



				<nav class="navbar navbar-default sinradio">
					<div class="container-fluid">
						<div class="navbar-header">
							<a class="navbar-brand" href="javascript:;">
								<i class="glyphicon glyphicon-list-alt"></i> Consulta de Ventas
							</a>
						</div>

					</div>
				</nav>

				<div class="list-group-item">
					<div class="container-fluid">
						<p><i class="glyphicon glyphicon-search"></i> Buscador</p>
						<form action="<?php echo $accion; ?>" id="FormBusca">
							<input type="hidden" id="inicio" value="0" name="inicio">
							<div class="form-group form-group-sm col-md-6">
								<label>Del</label>
								<input type="date" class="form-control" name="fecha">
							</div>
							<div class="form-group form-group-sm col-md-6 ">
								<label>Al</label>
								<input type="date" class="form-control " name="fecha_vendido">
							</div>
							<!--<div class="form-group form-group-sm col-md-4 ">
								<label>Vendedor</label>
								<select name="" class="form-control " id="">
									<option value="">Seleccione</option>
								</select>
							</div>-->
							<div class="col-sm-12 text-right">
								<button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
							</div>
						</form>
					</div>
				</div>
				<div id="FormEditar">
							
						</div>
			</div>
		</div>
	</div>

	<!-- Para ver el detalle -->
	<div class="col-md-7 ajusta-p2">
		<div class="panel panel-default abajo sombra sinradio alto">
			<div class="panel-body">
				<div class="list-group-item sinpading">
					<div class="table-responsive">
						<table class="table letra">
							<thead>
								<tr class="active">
									<th colspan="100%"><i class="glyphicon glyphicon-stats"></i> 	Ventas Realizadas</th>
								</tr>
								<tr>
									<th>Fecha</th>
									<th>Fecha Vendida</th>
									<th>Vendedor</th>
									<th>Total</th>
									<th><i class="glyphicon glyphicon-edit"></i></th>
								</tr>
							</thead>
							<tbody id="Listado">
								<?php $this->load->view("reporte/venta/lista"); ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>