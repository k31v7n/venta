<nav class="navbar navbar-default navbar-pri">
	<div class="container-fluid">
		<div class="navbar-header col-sm-12">
			<a class="navbar-brand ntext" href="#" style="color: #FFF;">
				<i class="glyphicon glyphicon-home"></i> <?php echo $_SESSION["NombreEmpresa"]; ?>
			</a>

			<div class="navbar-text ntext pull-right" style="color: #FFF;">
				<input type="checkbox" id="btn-menu" class="btn-menu">
				<label style="font-weight: normal;" for="btn-menu">
					<span style="font-size: 13px;"><?php echo $_SESSION["UserName"] ?></span> <i class="glyphicon 
					glyphicon-align-justify"></i></label>
				</div>
			</div>
		</div>
	</nav>

	<div class="capa-menu">
		<div id="cont-menu">
			<div class="user-info">
				<img src="<?php echo base_url('public/img/user.png') ?>" alt="">
				<span class="text-left" style="margin-left: 20px;">
				<?php echo $_SESSION["UserName"] ?>
				</span>
			</div>
			<div class="list-group" style="margin-top: 20px;">
				<a href="<?php echo base_url("index.php/ventas") ?>" class="list-group-item" style="border-radius: 0; border: 1px solid #f2f2f2;">
					<i class="glyphicon glyphicon-shopping-cart"></i> Ventas
				</a>
				<a href="<?php echo base_url("index.php/reporte") ?>" class="list-group-item" style="border-radius: 0; border: 1px solid #f2f2f2;">
					<i class="glyphicon glyphicon-search"></i> Consulta Ventas
				</a>
				<!--<a href="javascript:;" class="list-group-item opcmenu" style="border-radius: 0; border: 1px solid #f2f2f2;">
					<i class="glyphicon glyphicon-stats"></i> Reportes
				</a>-->
				<a href="<?php echo base_url("index.php/producto/mantenimiento") ?>" class="list-group-item opcmenu" style="border-radius: 0; border: 1px solid #f2f2f2;">
					<i class="glyphicon glyphicon-list-alt"></i> Mantenimiento Productos
				</a>
				<a href="<?php echo base_url("index.php/sesion/cerrarSesion") ?>" class="list-group-item opcmenu" style="border-radius: 0; border: 1px solid #f2f2f2;">
					<i class="glyphicon glyphicon-log-out"></i> Cerrar Sesión
				</a>
			</div>
			<div class="foot-menu text-center">
				<span class="text-center">Power by www.stguatemala.com</span>
			</div>
		</div>
	</div>