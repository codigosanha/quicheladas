<div class="contenido">
	<div class="form-group text-center">
		<label for="">Quicheladas</label><br>
		<p>
		<img src="<?php echo base_url();?>img/quicheladas.png" height="64" width="64"> 
		</p>
		3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco
		Santa Cruz del Quiche
	</div>
	<div class="hide-venta">
	<div class="form-group text-center">
		<label for=""><?php echo $venta->tipocomprobante;?></label><br>
		<?php echo $venta->serie ." - ".$venta->num_documento;?>
	</div>
	<div class="form-group">
		<?php if ($venta->pedido_id != 0): ?>
			<?php $infoMesasArea = getMesasFromPedido($venta->pedido_id);?>
			<p><b>Area: </b><?php echo $infoMesasArea['area'];?></p>
		
			<p><b>Mesa(s): </b><?php echo substr($infoMesasArea['mesas'], 0,-1);?></p>
		<?php endif ?>
		
		<p><b>Estado: </b><?php if ($venta->estado == "1") {
                                                    echo '<strong>Pagado</strong>';
                                                }else if($venta->estado == "2"){
                                                    echo '<strong>Pendiente</strong>';
                                                }else{
                                                    echo '<strong>Anulado</strong>';
                                                } ?>
                                            </p>
		<p><b>Cliente: </b><?php echo $venta->nombre;?></p>
		
		<p><b>Fecha y Hora: </b><?php echo $venta->fecha." ".$venta->hora;?></p>
	</div>

	<div class="form-group">
		<table width="100%" cellpadding="10" cellspacing="0" border="0">
			<thead>
				<tr>
					<th>Cant.</th>
					<th>Producto</th>
					<th style="text-align: right;">Importe</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalles as $detalle):?>
				<?php 
					$htmlExtras = "";
					$totalExtras = 0.00;
					$extras = getPreciosExtras($venta->pedido_id,$detalle->producto_id,$detalle->codigo);

					if (!empty($extras)) {
						foreach ($extras as $e) {
							$htmlExtras .= "<tr>";
							$htmlExtras .= "<td></td>";
							$htmlExtras .= "<td><i>".$e->nombre."</i></td>";
							$htmlExtras .= "<td style='text-align: right;'>".number_format($e->precio * $detalle->cantidad, 2, '.', '')."</td>";
							$htmlExtras .= "</tr>";
							$totalExtras = $totalExtras + $e->precio;
						}
					}
				?>
				<tr>
					<td><?php echo $detalle->cantidad;?></td>
					<td><?php echo $detalle->nombre;?></td>
					<td style="text-align: right;"><?php echo number_format($detalle->importe - ($totalExtras * $detalle->cantidad), 2, '.', '');?></td>
				</tr>
				<?php echo $htmlExtras;?>
				<?php endforeach;?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2">Subtotal:</td>
					<td style="text-align: right;"><?php echo $venta->subtotal;?></td>
				</tr>
				<!--
				<tr>
					<td colspan="2">iva:</td>
					<td style="text-align: right;">?php echo $venta->iva;?></td>
				</tr>
			-->
				<tr>
					<td colspan="2">Descuento:</td>
					<td style="text-align: right;"><?php echo $venta->descuento;?></td>
				</tr>
				<tr>
					<th colspan="2">TOTAL:</th>
					<th style="text-align: right;"><?php echo $venta->total;?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	
	<div class="form-group text-center">
        <p>Gracias por tu preferencia!!!</p>
        <p>Si el servicio fue de tu agrado te agradeceremos una <strong>Propina</strong></p>
        <p>Recuerda visitarnos en:</p>
        <p><i class="fa fa-globe"> www.quicheladas.com</i></p>
        <p><i class="fa fa-facebook-square"> Quicheladas y Ceviches</i></p>
    </div>

    </div>

    <div class="form-group text-center content-cupon hide-cupon">
		<?php if (!empty($cupon)): ?>
			<h4>CUPON DE DESCUENTO</h4>
			<p><strong>Valor:</strong></p>
			<p>$<?php echo $cupon->valor; ?></p><br>
			<p><strong>Fecha válida hasta:</strong></p>
			<p><?php echo $cupon->fecha_limite;?></p>
			<img src="<?php echo base_url();?>assets/images/qrcode/<?php echo $cupon->codigo;?>.png" alt="">
			<p><?php echo strtoupper($cupon->codigo)?></p> <br>
			<button type="button" class="btn btn-success btn-block btn-print-cupon no-print">Imprimir Cupon</button>
		<?php endif ?>
	</div>
</div>