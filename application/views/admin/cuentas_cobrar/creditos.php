
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Cuentas por Cobrar
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="cuentas_cobrar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Nro de Comprobante</th>
                                    <th>Tipo de comprobante</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Monto abonado</th>
                                    <th>Saldo Pendiente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($cuentas)):?>
                                    <?php foreach($cuentas as $cuenta):?>
                                        <?php $venta = getVenta($cuenta->venta_id);?>
                                        <tr>
                                            <td><?php echo getCliente($venta->cliente_id)->nombre;?></td>
                                            <td><?php echo $venta->num_documento;?></td>
                                            <td><?php echo getComprobante($venta->tipo_comprobante_id)->nombre;?></td>
                                            <td><?php echo $cuenta->fecha;?></td>
                                            <td><?php echo $cuenta->monto;?></td>
                                            <?php if (getTotalAbonos($cuenta->id) == 0): ?>
                                                <td>0.00</td>
                                            <?php else: ?>
                                                <td>
                                                    <a href="#modal-pagos" data-toggle="modal" data-href="<?php echo $cuenta->id;?>" class="btn-pagos">
                                                        <?php echo number_format(getTotalAbonos($cuenta->id), 2, '.', '');?>
                                                    </a>
                                                </td>
                                            <?php endif ?>
                                            
                                            <td><?php echo number_format($cuenta->monto - getTotalAbonos($cuenta->id), 2, '.', '');?></td>
                                            <td>
                                                <div class="btn-group">
                                                    
                                                    <button type="button" class="btn btn-primary btn-abonar" data-toggle="modal" data-target="#modal-abonar" value="<?php  echo $cuenta->id;?>">
                                                        Abonar
                                                    </button>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                       </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-abonar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Informacion de Abono</h4>
            </div>
            <form action="<?php echo base_url();?>cuentas_cobrar/creditos/abonar" method="POST">
                <input type="hidden" name="idCuenta" id="idCuenta">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Numero de Comprobante</label>
                        <input type="text" id="num_documento" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="">Saldo Pendiente</label>
                        <input type="text" id="saldo_pendiente" class="form-control" readonly="readonly">
                        <input type="hidden" name="monto" id="monto">
                        <input type="hidden" name="monto_abonado" id="monto_abonado">
                    </div>
                    <div class="form-group">
                        <label for="">Monto a Abonar</label>
                        <input type="text" id="monto_abonar" name="monto_abonar" class="form-control" required="required">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-pagos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Informacion de Monto Abonados</h4>
            </div>
            
            <div class="modal-body">
                <p class="text-center num_documento">
                    
                </p>
                <table class="table table-bordered" id="tbpagos">
                    <thead>
                        <tr>
                            
                            <th>Monto abonado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>       
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                </div>
            
        </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->