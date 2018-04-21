<?php $activa = ($agrmas) ? 'disabled' : ''; ?>
<div class="form-group form-group-sm">
	<label class="control-label col-sm-2">Forma de Pago</label>
	<div class="col-sm-4">
		<select id="pago" class="form-control" <?php echo $activa ?>>
			<option value="">Seleccione</option>
			<?php if (isset($tpago) && $tpago): ?>
				<?php foreach ($tpago as $row): ?>
					<option value="<?php echo $row->tipo_pago ?>" <?php echo ($row->tipo_pago == 1) ? 'selected' : '' ?>>
						<?php echo $row->descripcion ?>		
					</option>
				<?php endforeach ?>
			<?php endif ?>
		</select>
	</div>

	<label class="control-label col-sm-1">Monto</label>
	<div class="col-sm-2">
		<input type="number" step="0.01" id="monto" class="form-control" <?php echo $activa ?>>
	</div>
	<div class="col-sm-1">
		<button class="btn btn-xs" type="button" id="btnagrega" onclick="agregapago(<?php echo $idventa; ?>)" <?php echo $activa ?>>
			<i class="glyphicon glyphicon-plus"></i> Agregar
		</button>
	</div>
</div>
<table class="table table-bordered letra">
	<thead>
		<tr class="active">
			<th style="padding: 2px 5px;">Forma</th>
			<th class="text-center" style="padding: 2px 5px;">Monto</th>
			<th style="padding: 2px 5px;"></th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($plista) && $plista): 
			$xtotal = 0;	?>
			<?php foreach ($plista as $row): ?>
				<tr>
					<td style="padding: 2px 5px;"><?php echo $row->descripcion; ?></td>
					<td class="text-center" style="padding: 2px 5px;"><?php echo $row->monto ?></td>
					<td style="padding: 2px 5px;" class="text-center">
						<button type="button" class="btn btn-xs" onclick="agregapago(<?php echo $row->venta.','.$row->pago; ?>)">
							<i class="glyphicon glyphicon-remove"></i>
						</button>
					</td>
				</tr>
				<?php $xtotal += $row->monto; ?>
			<?php endforeach ?>
			<tr class="bg-info">
				<th style="padding: 2px 5px;">MONTO ACUMULADO</th>
				<th style="padding: 2px 5px;" class="text-center"><?php echo number_format($xtotal,2);?></th>
				<th></th>
			</tr>
		<?php endif ?>
	</tbody>
</table>