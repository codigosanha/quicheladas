<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Compras
        <small>Nueva</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>movimientos/compras/store" method="POST">
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
                                    
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                        <!--Inicio 2da Columna-->
                        <div class="col-md-3">
                               
                            <div class="form-group">
                                <label for="">Comprobante:</label>
                                <select name="comprobante" id="comprobante" class="form-control">
                                    <?php foreach ($tipocomprobantes as $tp): ?>
                                        <option value="<?php echo $tp->id;?>"><?php echo $tp->nombre;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tipo de Pago:</label>
                                <select name="tipo_pago" id="tipo_pago" class="form-control" required>
                                    <option value="1">Efectivo</option>
                                    <option value="2">Credito</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Serie:</label>
                                <input type="text" class="form-control" id="serie" name="serie" placeholder="Escriba la Serie" required="required">
                            </div>    
                            <div class="form-group">
                                <label for="">No. Comprobante:</label>
                                <input type="text" class="form-control"  name="numero" placeholder="Escriba el No. de Factura" required="required">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha de Compra:</label>
                                <input type="date" class="form-control" name="fecha" value="<?php echo date("Y-m-d");?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Proveedor:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Seleccione proveedor" id="proveedor" readonly="readonly">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-proveedores">Buscar</button>
                                    </span>
                                    <input type="hidden" name="idproveedor" id="idproveedor">
                                </div><!-- /input-group -->
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Subtotal:</span>
                                    <input type="text" class="form-control" placeholder="0.00" name="subtotal" readonly="readonly">
                                </div>
                        
                                <div class="input-group">
                                    <span class="input-group-addon">Total:</span>
                                    <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly">
                                </div>
                            </div> 
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat" id="btn-guardar-compra" disabled="disabled"><i class="fa fa-save"></i> Guardar Compra</button>
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

<div class="modal fade" id="modal-proveedores">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Informacion de Proveedores</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover" id="example1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>NIT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($proveedores)): ?>
                            <?php foreach ($proveedores as $p): ?>
                                <tr>
                                    <td><?php echo $p->id;?></td>
                                    <td><?php echo $p->nombre;?></td>
                                    <td><?php echo $p->nit;?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm btn-select-proveedor" value="<?php echo $p->id;?>">
                                            <span class="fa fa-check"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-flat btn-print"><span class="fa fa-print"></span> Imprimir</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->