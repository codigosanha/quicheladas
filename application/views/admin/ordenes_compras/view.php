<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <p><strong>N° de Orden de Compra:</strong><?php echo $orden->id ?></p>
            <p><strong>Proveedor:</strong><?php echo $orden->proveedor ?></p>
            <p><strong>Fecha:</strong><?php echo $orden->fecha ?></p>
            <p><strong>Estado:</strong><?php echo $orden->estado ?></p>
            <p><strong>Forma de Pago:</strong><?php echo $orden->tipo_pago ?></p>
            <p><strong>Usuario</strong><?php echo $orden->usuario ?></p>
        </div>
        <div class="form-group">
            
            <table border="1" width="100%" class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="5" class="text-center">Detalle de la Orden de Compra</th>
                    </tr>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Unidad de Medida</th>
                        <th>Precio</th>
                        <th>Importe</th>
                    </tr>
                    <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?php echo $detalle->cantidad;?></td>
                            <td><?php echo $detalle->nombre;?></td>
                            <th><?php echo getUnidadMedida($detalle->unidad_medida_id)->nombre;?></th>
                            <td><?php echo $detalle->precio;?></td>
                            <td><?php echo $detalle->importe;?></td>
                        </tr>
                    <?php endforeach ?>
                    
                    
                    <tr>
                        <th colspan="4" class="text-right">Total:</th>
                        <td><?php echo $orden->total; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>