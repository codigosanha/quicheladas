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
                                                    <input type="hidden" name="idproductos[]" value="<?php echo $detalle->producto_id ?>">
                                                    <?php echo $detalle->codigo;?></td>
                                                <td><?php echo $detalle->nombre;?></td>
                                                <?php  
                                                    $select = "<select id='medida' name='medida' class='form-control medida' required='required'><option value='' disabled>Seleccione..</option>";

                                                    $medidas = getMedidasProducto($detalle->producto_id);

                                                    foreach ($medidas as $medida) {
                                                        $selected="";
                                                        $valueOption = $medida->id . "*" . $medida->idpum . "*" . $medida->nombre. "*" . $medida->cantidad. "*" . $medida->precio;
                                                        if ($medida->id == $detalle->unidad_medida_id) {
                                                            $cantidadesMedida = $medida->cantidad;
                                                            $idMedidas = $medida->id;
                                                            $selected = "selected";
                                                        }
                                                        $select .= "<option value='".$valueOption."' ".$selected.">".$medida->nombre." = ".$medida->cantidad." unids."."</option>";
                                                    }

                                                    $select .="</select>";

                                                ?>
                                                <td>
                                                    <?php echo $select; ?>
                                                    <input type='hidden' name='cantidadesMedida[]' class='cantidadesMedida' value="<?php echo $cantidadesMedida; ?>">
                                                    <input type='hidden' name='idMedidas[]' class='idMedidas' value="<?php echo $idMedidas ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="precios[]" value="<?php echo $detalle->precio; ?>" readonly="readonly" class="form-control" style="width: 100px;"></td>
                                                <td>
                                                    <input type="text" name="cantidades[]" value="<?php echo $detalle->cantidad; ?>" class="form-control cantidadesCompra" style="width: 100px;"></td>

                                                <td>
                                                    <input type="text" name="importes[]" value="<?php echo $detalle->importe; ?>" readonly="readonly" class="form-control" style="width: 100px;"></td>
                                                <td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>

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
                                <label for="">Numero de Orden</label>
                                <input type="text" name="numero" class="form-control" required="required" value="<?php echo $orden->numero; ?>">
                            </div>
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
                                <label for="estado">Estado:</label>
                                <select name="estado" id="estado-orden" class="form-control">
                                    <option value="Registrada" <?php echo $orden->estado == "Registrada" ? "selected":"" ?>>Registrada</option>
                                    <option value="Procesada" <?php echo $orden->estado == "Procesada" ? "selected":"" ?>>Procesada</option>
                                    <option value="Recibida">Recibida</option>
                                </select>
                            </div> 
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat" id="btn-guardar-compra" ><i class="fa fa-save"></i> Guardar</button>
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

