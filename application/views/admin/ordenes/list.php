
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="listado-ordenes">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes del Dia
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" name="configCorreos" id="configCorreos" value="<?php echo $configCorreos;?>">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($caja_abierta != false): ?>
                            <a href="<?php echo base_url();?>movimientos/ordenes/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Orden</a>
                            <a href="<?php echo base_url();?>movimientos/ordenes/venta_directa" class="btn btn-warning btn-flat"><span class="fa fa-plus"></span> Venta Directa</a>
                        <?php endif ?>

                        <input type="hidden" id="permisos" value='<?php echo json_encode($permisos);?>'>
                        
                    </div>
                </div>
                <hr>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="row form-group">
                            <div class="col-md-7 col-xs-12">
                                Mostrar
                                    <select name="records_per_page" id="records_per_page" class="form-control" style="width: 80px !important; display: inline;">
                                        <option value="10">10</option>
                                        <option value="25" selected="selected">25</option>
                                    </select>
                                registros por pagina
                            </div>
                            <div class="col-md-5 col-xs-12 text-right">
                                Buscar: <input type="text" class="form-control" id="search-orden" name="search-orden" placeholder="Buscar..." style="width: 130px !important; display: inline;">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tbordenesactual" class="table table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Mesas</th>
                                        <th>Preparacion</th>
                                        <th>El consumo es para:</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination">
                        </ul>
                    </div>
                    <div class="col-md-6">
                              <!-- Custom Tabs (Pulled to the right) -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <?php foreach ($areas as $area): ?>
                                    <li class="<?php echo $area->id==$firstArea ? 'active':'';?>"><a href="#mesas" data-toggle="tab" data-href="<?php echo $area->id;?>" class="tab-area"><?php echo $area->nombre;?></a></li>
                                <?php endforeach ?>
                                <li class="pull-left header"><i class="fa fa-th"></i> Areas y Mesas</li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="mesas">
                                    <div class="row" id="mesas-area">
                                        <?php foreach ($mesasArea as $mesa): ?>
                                            <?php 
                                                $estado = 'mesa-ocupada';
                                                if ($mesa->estado == 1) {
                                                    $estado = 'mesa-disponible';
                                                }
                                            ?>
                                            <div class="col-md-3 col-sm-6 col-xs-6">
                                                <div class="numero-mesa <?php echo $estado;?>">
                                                    MESA<br>
                                                    <?php echo $mesa->numero;?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>

                                </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div>
                          <!-- nav-tabs-custom -->
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

<div class="modal fade" id="modal-venta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la orden</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <a href="#" class="btn btn-primary btn-flat" id="btn-print-orden"><span class="fa fa-print"></span> Imprimir</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-msgCorreos">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de Eliminacion</h4>
      </div>
      <div class="modal-body">
        Esta acción requiere la configuración de un correo remitente y al menos un correo destinatario para enviar la información de la eliminación en formato PDF. <br> <br>
        Póngase en contacto con su administrador para resolver esta diligencia.

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