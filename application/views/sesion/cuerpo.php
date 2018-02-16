<link rel="stylesheet" href="<?php echo base_url('public/css/sesion.css') ?>">

<?php if (isset($_SESSION["mensaje"])): ?>
	<script>
		notificar(0,"<?php echo $_SESSION["mensaje"];?>");
	</script>
	<?php unset($_SESSION["mensaje"]);
	?>
<?php endif ?>
<div class="login sombra">
	<div class="list-group-item">
		<div class="limg text-center">
			<img src="<?php echo base_url("public/img/sysconta.png") ?>" alt="">
		</div>
	</div>
	<div class="list-group-item">
		<form action="<?php echo $accion; ?>" method="post">
			<div class="form-group form-group-sm">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i> Usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<input type="text" name="usuario" class="form-control" placeholder="..." aria-describedby="basic-addon1">
				</div>
			</div>
			<div class="form-group form-group-sm">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-option-horizontal"></i> Contraseña</span>
					<input type="password" name="password" class="form-control" placeholder="..." aria-describedby="basic-addon1">
				</div>
			</div>
			<div class="form-group form-group-sm text-center">
				<button class="btn btn-sm btn-primary">Iniciar Sesión</button>
			</div>
		</form>
	</div>
</div>