
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Gastos
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                            <?php if ($caja_abierta!=false): ?>
                                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-add-gasto">
                                    <i class="fa fa-plus"></i> Agregar Gasto
                                </button>
                            <?php endif ?>
                        
                        <?php endif;?>
                    </div>
                </div>
                <hr>
               
                <div class="row">
                
                    <div class="col-md-12">
                        
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Fecha y Hora</th>
                                        <th>Nombre  de Gasto</th>
                                        <th>Monto</th>
                                        <th>Observaciones</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    <?php if(!empty($gastos)):?>
                                        <?php foreach($gastos as $gasto):?>
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><?php echo getUsuario($gasto->usuario_id)->username;?></td>
                                                <td><?php echo $gasto->fecha;?></td>
                                                <td><?php echo $gasto->nombre;?></td>
                                                <td><?php echo $gasto->monto;?></td>
                                                <td><?php echo $gasto->observaciones;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm btn-delete-gasto" data-toggle="modal" data-target="#modal-default" value="<?php echo $gasto->id ?>">
                                                        Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
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

<div class="modal fade" id="modal-add-gasto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Gasto</h4>
      </div>
      <form action="<?php echo base_url();?>caja/gastos/store" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Nombre del Gasto:</label>
            <input type="text" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Monto del Gasto:</label>
            <input type="text" name="monto" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" rows="5" class="form-control"></textarea>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar Gasto</h4>
      </div>
      <form action="#" method="POST" id="form-delete-gasto">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Ingrese Clave de Permiso</label>
            <input type="password" class="form-control" name="clave" required="required">
            <input type="hidden" name="idGasto" id="idGasto">
        </div>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-print"></span> Guardar</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->