<style>
	.contenido{
		width: 310px;
	}
	.texto-centrado{
		text-align: center;
	}
</style>
<div class="contenido">
	<div class="texto-centrado">
		<label for="">Quicheladas</label><br>
		<p>
		    <img src="./img/quicheladas.png" height="64" width="64"> 
		</p>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco
		Santa Cruz del Quiche
		<p></p>

		<h4>ELIMINACION DE ORDEN</h4>

		<p><b>N° de Orden:</b><br> <?php echo $orden;?></p> 
		<p><b>Fecha y Hora:</b><br> <?php echo date("d/m/Y H:i a")?></p>
		<?php $usuario = getUsuario($this->session->userdata("id")); ?>
		<p><b>Usuario:</b><br> <?php echo $usuario->nombres." ".$usuario->apellidos;?></p>
		

		<h4>DETALLE DE LA ORDEN</h4>
	</div>
	<table width="100%" cellpadding="0" cellspacing="0" border="1">
		
		<thead>
			<tr>
				<th>PRODUCTO</th>
				<th>CANTIDAD</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($detalles as $detalle): ?>
				<tr>
					<td><?php echo $detalle->nombre;?></td>
					<td><?php echo $detalle->cantidad;?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<p class="texto-centrado">
		<b>Observaciones</b><br>
		<?php echo $observaciones;?>
	</p>
</div>