<div class="list-group-item" style="margin-bottom: 20px;">
	<button type="button" class="close" onclick="cerrar('Fproducto')">&times;</button><br>
	<div class="alert alert-warning sinpading">
		Se está agregando un producto a la categoria <b><?php echo $ncategoria ?></b>.
	</div>
	<?php echo $openform; ?>
		<div class="form-group form-group-sm">
			<?php echo $lab_nombre; ?>
			<div class="col-sm-4">
				<?php echo $nombre; ?>
			</div>

			<?php echo $lab_codigoalterno; ?>
			<div class="col-sm-4">
				<?php echo $codigoalterno; ?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo $lab_preciocompra; ?>
			<div class="col-sm-4">
				<?php echo $preciocompra; ?>
			</div>

			<?php echo $lab_precioventa; ?>
			<div class="col-sm-4">
				<?php echo $precioventa; ?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo $lab_cantidad; ?>
			<div class="col-sm-4">
				<?php echo $cantidad; ?>
			</div>

			<div class="col-sm-6 text-right">
				<?php echo $button; ?>
			</div>
		</div>
	<?php echo $closeform; ?>
</div>