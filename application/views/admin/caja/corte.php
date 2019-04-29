<div class="contenido">
	<div class="form-group text-center">
		
		<p><strong>Corte de Caja</strong></p>
		<p><strong>Cajero:</strong><?php echo getUsuario($caja->usuario_id)->nombres; ?></p>
	</div>	
	<div class="form-group text-center">
		<label for="">Quicheladas</label><br>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco
		Santa Cruz del Quiche
		<p>NIT: 81118287</p>
	</div>
	<div class="form-group text-center">
		Fecha: <?php echo $caja->fecha_cierre;?> <br>
		No. de Caja: 1
	</div>
	<div class="form-group text-center">
		<p><strong>DETALLES DE PAGO</strong></p>
		<p><strong>Efectivo: </strong><?php echo $caja->monto_efectivo?></p>
		<br>
		<p><strong>TARJETAS DE CREDITO</strong></p>
		<?php $totalTarjetas = 0; ?>
		<?php foreach ($tarjetas as $tarjeta): ?>
			<?php $totalTarjeta = getTotalTarjeta($caja->id,$tarjeta->id);?> 
			<p><strong><?php echo $tarjeta->nombre;?> : </strong><?php echo $totalTarjeta;?></p>
			<?php $totalTarjetas = $totalTarjetas + $totalTarjeta;?>
		<?php endforeach ?>
		<p><strong>Monto total en Tarjeta: </strong><?php echo $totalTarjetas?></p>
		<br>
		<p><strong>VENTAS AL CREDITO</strong></p>
		<p><strong>Total: </strong><?php echo getMontos("monto_credito",$caja->id)?></p> <br>
		<p><strong>Descuentos: </strong><?php echo getTotalDescuentos($caja->id);?></p>
		<p><strong>Caja Inicial: </strong><?php echo $caja->monto_apertura;?></p>
		<?php $monto_efectivo =  getMontos('monto_efectivo',$caja->id);
                                            ?>
		<p><strong>Efectivo Recolectado: </strong><?php echo getMontoVentas($caja->id)?></p>
		<?php $gastos = getGastos($caja->id); ?>
		<p><strong>Gastos: </strong><?php echo $gastos;?></p>
		<?php $efectivo = $caja->monto_apertura + $monto_efectivo - $gastos?>
		<p><strong>Efectivo a Entregar: </strong><?php echo number_format($efectivo, 2, '.', '');?></p>
		<p><strong>Efectivo Recolectado: </strong><?php echo $caja->monto_efectivo;?></p>
		<p><strong>Monto Faltante: </strong><?php echo  number_format($efectivo - $caja->monto_efectivo, 2, '.', '');?></p>
		<p><strong>Total de transacciones: </strong><?php echo getNumeroVentas($caja->id);?></p>
		<p><strong>Prom de Transaccion por Cuenta: </strong>
			<?php if (getNumeroVentas($caja->id) > 0): ?>
				<?php echo number_format(getMontoVentas($caja->id)/getNumeroVentas($caja->id), 2, '.', '');?>
				<?php else: ?>
					<?php echo "0.00";?>
			<?php endif ?>
			
		</p>
		<br><br><br>
		<p>F._________________________</p>
		<p>Gerente</p> <br><br><br>
		<p>F._________________________</p>
	</div>
	
</div>