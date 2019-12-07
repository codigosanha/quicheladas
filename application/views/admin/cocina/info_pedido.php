<div class="well well-sm">
<div class="row">
	<div class="col-md-2 ">
		<b>Nro Oden:</b><?php echo $pedido->id; ?>
		
	</div>
	<div class="col-md-2 ">
		<?php if ($pedido->tipo_consumo): ?>
			<?php if (!empty($pedido_mesas)): ?>
				<?php $num_mesas = ""; ?>
				<?php foreach ($pedido_mesas as $pm): ?>
					<?php $num_mesas .= $pm->numero.","; ?>
				<?php endforeach ?>
			<?php endif ?>
			<b>Mesas: </b> <?php echo $num_mesas; ?>
		<?php endif ?>
	</div>
	<div class="col-md-4 ">
		<b>Consumo:</b><?php echo $pedido->tipo_consumo == 1 ? "Comer en el Restaurante":"Para llevar"; ?>
	</div>
	<div class="col-md-3">
		<b>Estado:</b>
		<?php if ($pedido->estado): ?>
			<span class="label label-warning">En Preparación</span>
		<?php else: ?>
			<span class="label label-success">Nuevo</span>
		<?php endif ?>
	</div>
</div>
</div>
<h5 class="page-header">Productos</h5>
<div class="row">
	<?php if (!empty($pedido_productos)): ?>
		<?php foreach ($pedido_productos as $pp): ?>
			<div class="col-md-3">
				<?php echo $pp->nombre ?>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>