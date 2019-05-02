<div class="contenido" >
<div class="form-group text-center">
		<label for="">Quicheladas</label><br>
		<p>
		<img src="<?php echo base_url();?>img/quicheladas.png" height="64" width="64"> 
		</p>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco
		Santa Cruz del Quiche
	</div>
<p class="text-center"><strong>AJUSTE DE INVENTARIO</strong></p> <br>
<p class="text-center"><strong>Fecha: </strong><?php echo $ajuste->fecha;?></p>
<p class="text-center"><strong>Usuario: </strong><?php echo getUsuario($ajuste->usuario_id)->nombres;?></p><br>
<p class="text-center"><strong>Productos</strong></p>
<table class="table table-bordered" >
	<thead>
		<tr>
			<th>Producto</th>
			<th>Stock BD</th>
			<th>Stock Fisico</th>
			<th>Ajuste</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($productos as $p): ?>
			<tr>
				<td><?php echo getProducto($p->producto_id)->nombre; ?></td>
				<td><?php echo $p->stock_bd; ?></td>
				<td><?php echo $p->stock_fisico; ?></td>
				<td><?php echo abs($p->diferencia_stock); ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
</div>