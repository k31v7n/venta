<?php 
$nombre = '';
if($categoria){
	$nombre = $categoria->nombre;
}
?>
<div class="list-group-item" style="margin-bottom: 20px;">
	<button type="button" class="close" onclick="cerrar('Fcategoria')">&times;</button><br>
	<div class="alert alert-warning">
		<b>CATEGORIA</b> Escriba el nombre de esta categoria
	</div>
	<form action="<?php echo $accion; ?>" class="form-horizontal" id="FxormProducto">
		<div class="form-group form-group-sm">
			<label class="control-label col-sm-2">Nombre:</label>
			<div class="col-sm-7">
				<input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>">
			</div>
			<div class="col-sm-3">
				<button class="btn btn-sm btn-info todo" id="btnGuardar">
					<i class="glyphicon glyphicon-floppy-disk"></i> Guardar
				</button>
			</div>
		</div>
	</form>
</div>