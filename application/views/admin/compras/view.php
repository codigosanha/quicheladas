<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <table border="1" width="100%" class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="7" class="text-center">Informacion del Proveedor</th>
                    </tr>
                    <tr>
                        <th>Proveedor:</th>
                        <td colspan="2"><?php echo $compra->proveedor;?></td>
                        <th>Serie:</th>
                        <td><?php echo $compra->serie;?></td>
                        <th>No. Comprobante</th>
                        <td><?php echo $compra->numero;?></td>
                    </tr>
                    <tr>
                        <th>NIT:</th>
                        <td><?php echo $compra->nit;?></td>
                        <th>Comprobante:</th>
                        <td colspan="2"><?php echo getComprobante($compra->comprobante_id)->nombre;;?></td>
                        <th>Tipo Pago</th>
                        <td><?php echo $compra->tipo_pago == 1?'Efectivo':'Credito';?></td>
                    </tr>
                    <tr>
                        <th>Direccion:</th>
                        <td colspan="4"><?php echo $compra->direccion;?></td>
                        <th>Fecha Compra:</th>
                        <td><?php echo $compra->fecha_compra;?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table border="1" width="100%" class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="5" class="text-center">Detalle de la Compra</th>
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
                        <th colspan="4" class="text-right">Subtotal:</th>
                        <td><?php echo $compra->subtotal; ?></td>
                    </tr>
                    
                    <tr>
                        <th colspan="4" class="text-right">Total:</th>
                        <td><?php echo $compra->total; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>