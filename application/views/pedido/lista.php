<div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav opc-vent">
		<?php if (isset($lista) && $lista): ?>
			<?php foreach ($lista as $row): ?>
				<li class="activa vetsopc">
					<a href="javascript:;" class="ventanas" onclick="cargarVenta(<?= $row->venta ?>)">
						Venta <?= $row->venta; ?>
					</a>
				</li>
			<?php endforeach ?>
		<?php else: ?>
		<div class="alert alert-warning sinmargen">
			<b>Es necesario crear una venta</b>
		</div>
		<?php endif ?>
	</ul>
	<ul class="nav navbar-nav">
		<li class="btn-nuevo sinmargen">
			<a href="#" class="ventanas sinmargen" style="color: #FFF; border-left:none;" title="¡Nueva venta!" onclick="nuevaVenta();" id="btncrea">
				<i class="glyphicon glyphicon-plus"></i>
			</a>
		</li>
	</ul>
</div>