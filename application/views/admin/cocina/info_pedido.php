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
		<?php if ($pedido->preparado): ?>
			<span class="label label-warning">En Preparación</span>
		<?php else: ?>
			<span class="label label-success">Nuevo</span>
		<?php endif ?>
	</div>
</div>
</div>
<p><b>PRODUCTOS</b></p>
<div class="row">
	<?php if (!empty($pedido_productos)): ?>
		<?php foreach ($pedido_productos as $pp): ?>
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<span class="badge pull-right">
							<?php echo $pp->cantidad; ?>
						</span>
						<?php echo $pp->nombre ?>
						
					</div>
					<?php 
						$productos_asociados = getProductosA($pp->producto_id);
						$extras = getPreciosExtras($pp->pedido_id, $pp->producto_id, $pp->codigo);

					
					?>
					<?php if (!empty($productos_asociados) || !empty($extras)): ?>
						<div class="panel-body">
							<?php if (!empty($productos_asociados)): ?>
								<b>Productos a cocinar</b>
								<ul class="list-group">
									<?php foreach ($productos_asociados as $pa): ?>
										<li class="list-group-item">
									    	<span class="badge"><?php echo $pp->cantidad * $pa->cantidad ?></span>
									    	<?php echo $pa->nombre ?>
									  	</li>
									<?php endforeach ?>
								  	
								</ul>
							<?php endif ?>

							<?php if (!empty($extras)): ?>
								<b>Extras</b>
								<ul class="list-group">
									<?php foreach ($extras as $e): ?>
										<li class="list-group-item">
									    	
									    	<?php echo $e->nombre ?>
									  	</li>
									<?php endforeach ?>
								  	
								</ul>
							<?php endif ?>
							
							
						</div>
					<?php endif ?>
					
					
				</div>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>