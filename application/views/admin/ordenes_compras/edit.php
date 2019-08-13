<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes de Compras
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>movimientos/ordenes_compras/update" method="POST">
                    <input type="hidden" name="idOrden" value="<?php echo $orden->id ?>">
                    <div class="row">
                        <!--Inicio Primer Columna-->
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="">Producto:</label>
                                <div class="input-group barcode">
                                    <div class="input-group-addon">
                                        <i class="fa fa-barcode"></i>
                                    </div>
                                    <input type="text" class="form-control" id="searchProductoCompra" placeholder="Buscar por codigo de barras o nombre del proucto">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="table-responsive">
                                <table id="tbcompras" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Unidad</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detalles as $detalle): ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="idProductos[]" value="<?php echo $detalle->producto_id ?>">
                                                    <?php echo $detalle->codigo;?></td>
                                                <td><?php echo $detalle->nombre;?></td>
                                                <th><?php echo getUnidadMedida($detalle->unidad_medida_id)->nombre;?></th>
                                                <td>
                                                    <input type="hidden" name="precios[]" value="<?php echo $detalle->precio; ?>">
                                                    <?php echo $detalle->precio;?></td>
                                                <td>
                                                    <input type="hidden" name="cantidades[]" value="<?php echo $detalle->cantidad; ?>">
                                                    <?php echo $detalle->cantidad;?></td>

                                                <td>
                                                    <input type="hidden" name="importes[]" value="<?php echo $detalle->importe; ?>">
                                                    <?php echo $detalle->importe;?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        
                        </div>
                        <!--Inicio 2da Columna-->
                        <div class="col-md-3">
                           
                            <div class="form-group">
                                <label for="">Tipo de Pago:</label>
                                <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                                    <option value="Efectivo" <?php echo $orden->tipo_pago == "Efectivo" ? 'selected':''; ?>>Efectivo</option>
                                    <option value="Credito" <?php echo $orden->tipo_pago == "Credito" ? 'selected':'';?>>Credito</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Proveedor:</label>
                                <select name="proveedor_id" id="proveedor_id" class="form-control">
                                    <?php foreach ($proveedores as $proveedor): ?>
                                        <?php 
                                            $selected = '';
                                            if ($proveedor->id == $orden->proveedor_id){
                                                $selected = "selected";
                                            }
                                            
                                        ?>

                                        <option value="<?php echo $proveedor->id; ?>" <?php echo $selected ?>><?php echo $proveedor->nombre ?></option>
                                        }
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Total:</span>
                                    <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly" value="<?php echo $orden->total ?>">
                                </div>
                            </div> 
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat" id="btn-guardar-compra" disabled="disabled"><i class="fa fa-save"></i> Guardar</button>
                                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat"><i class="fa fa-times"></i> Cancelar</a>
                            </div>      
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>

    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

