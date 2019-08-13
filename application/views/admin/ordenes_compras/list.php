
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes de compras
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="movimientos/ordenes_compras">
                <div class="row">
                    <div class="col-md-12">
                      
                        <a href="<?php echo base_url();?>movimientos/ordenes_compras/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Nueva Orden de Compra</a>
                      
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Tipo de Pago</th>
                                    <th>Total</th>
                                    <th>Estado</th>                        
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($ordenes_compras)):?>
                                    <?php foreach($ordenes_compras as $orden):?>
                                        <tr>
                                            <td><?php echo $orden->id;?></td>
                                            <td><?php echo $orden->fecha;?></td>
                                            <td><?php echo $orden->proveedor;?></td>
                                            <td><?php echo $orden->tipo_pago;?></td>
                                            <td><?php echo $orden->total;?></td>
                                            <td><?php echo $orden->estado;?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-view" data-toggle="modal" data-target="#modal-default" value="<?php echo $orden->id;?>"><span class="fa fa-search"></span></button>
                                                    <a href="<?php echo base_url(); ?>movimientos/ordenes_compras/edit/<?php echo $orden->id; ?>" class="btn btn-warning">
                                                        <span class="fa fa-pencil"></span>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>movimientos/ordenes_compras/pay/<?php echo $orden->id; ?>" class="btn btn-success">
                                                        <span class="fa fa-credit-card"></span>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>movimientos/ordenes_compras/cancelar/<?php echo $orden->id; ?>" class="btn btn-danger btn-cancelar-orden">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                    
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
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Orden</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-flat btn-print-modal"><span class="fa fa-print"></span> Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
