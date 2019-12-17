<?php 
    $nummesas = "";
    foreach ($mesas as $mesa){
        $nummesas .= $mesa->numero.","; 
    } 

?>
<div class="contenido">
    <div class="form-group text-center">
        <label for="">Quicheladas</label><br>
        <p>
        <img src="<?php echo base_url();?>img/quicheladas.png" height="64" width="64"> 
        </p>
        3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia Batres Don Paco
        Santa Cruz del Quiche
    </div>
    <?php $infoPedido = getPedido($pedido);
   
    ?>
    <div class="form-group text-center">
        <p><b>El consumo es para: </b><?php echo $infoPedido->tipo_consumo == '1' ? 'Comer en el Restaurant':'Llevar'?></p> <br>
        <?php if ($infoPedido->tipo_consumo == 1): ?>
            <b>Mesas: </b> <?php echo substr($nummesas, 0, -1); ?><br></div>
        <?php endif ?>
        
    <div class="form-group">
        <table width="100%" cellpadding="10" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th style="text-align: left;">Precio</th>
                    <th style="text-align: right;"> Importe</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0;?>
                <?php foreach($subcatproductos as $sp):?>
                <tr >
                    <td colspan="4" style="background-color: #3BB933; color: #FFF; font-weight: bold;" class="text-center"><?php echo $sp->nombre;?></td>
                </tr>
                    <?php foreach ($sp->subs as $p): ?>
                        <?php $cantidad = $p->cantidad - $p->pagados;?>
                        <tr>
                            <td>
                                <?php echo $p->nombre;?>
                            </td>
                            <td><?php echo $cantidad;?></td>
                            <td style="text-align: left;">
                                <?php echo number_format($p->precio, 2, '.', '');?>
                            </td>

                            <td style="text-align: right;">
                                <?php echo number_format(($cantidad * $p->precio), 2, '.', ''); ?>
                            </td>
                        </tr>
                        <?php $total = $total + ($cantidad * $p->precio) ;?>
                        <?php 
                            $htmlExtras = "";
                            $totalExtras = 0.00;
                            $extras = getPreciosExtras($p->pedido_id,$p->producto_id,$p->codigo);

                            if (!empty($extras)) {
                                foreach ($extras as $e) {
                                    $htmlExtras .= "<tr>";
                                    $htmlExtras .= "<td><i>".$e->nombre."</i></td>";
                                    $htmlExtras .= "<td>".$cantidad."</td>";
                                    if ($e->precio == "0.00") {
                                        $htmlExtras .= "<td></td>";
                                    }else{
                                        $htmlExtras .= "<td>".$e->precio."</td>";
                                    }
                                    
                                    $importe = $e->precio * $cantidad;
                                    if ($importe == 0) {
                                        $htmlExtras .= "<td>&nbsp</td>";
                                    }else {
                                        $htmlExtras .= "<td style='text-align: right;'>".number_format($importe, 2, '.', '')."</td>";
                                    }
                                    $htmlExtras .= "</tr>";
                                    $totalExtras = $totalExtras + ($e->precio * $cantidad);
                                }
                            }

                            echo $htmlExtras;
                            $total = $total + $totalExtras;
                            $htmlOfertas = "";
                            $ofertas = getOfertas($p->pedido_id,$p->producto_id,$p->codigo);
                            if (!empty($ofertas)) {
                                foreach ($ofertas as $oferta) {
                                    $htmlOfertas .= "<tr>";
                                    $htmlOfertas .= "<td><i>".$oferta->nombre."</i></td>";
                                    $htmlOfertas .= "<td>".$oferta->cantidad."</td>";
                                    $htmlOfertas .= "<td></td>";
                                    $htmlOfertas .= "<td></td>";
                                    
                                    $htmlOfertas .= "</tr>";
                                }
                            }
                            echo $htmlOfertas;

                        ?>


                    <?php endforeach ?>
                
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">TOTAL:</th>
                    <th style="text-align: right;"><?php echo number_format($total, 2, '.', '');?></th>
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