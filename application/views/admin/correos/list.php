<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Bien Hecho!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error!", "<?php echo $this->session->flashdata("error"); ?>", "error");
    </script>
<?php endif ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Correos
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="correos">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                Configuración de correo remitente
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="<?php echo base_url();?>administrador/correos/saveCorreoRemitente" method="POST">
                                            <?php
                                                $idConfiguracion = '';
                                                $correo_remitente = '';
                                                if (!empty($configuracion)) {
                                                    $idConfiguracion = $configuracion->id;
                                                    $correo_remitente = $configuracion->correo_remitente;
                                                }
                                            ?>
                                            <input type="hidden" name="idConfiguracion" value="<?php echo $idConfiguracion; ?>">
                                            <div class="input-group">
                                              <input type="text" class="form-control" name="correo_remitente" placeholder="example@gmail.com" value="<?php echo $correo_remitente; ?>" required="required">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-success btn-flat" type="button">Guardar</button>
                                              </span>
                                            </div><!-- /input-group -->
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary box-solid">
                            <div class="box-header with-border">
                                Configuración de correos cuando se elimina una orden y/o productos de la orden
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h1 class="page-header ">Agregar Correo</h1>
                                        <form action="<?php echo base_url();?>administrador/correos/store" method="POST">
                                            <div class="form-group">
                                                <input type="email" name="correo" class="form-control" placeholder="Correo">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Agregar</button>
                                            
                                        </form>
                                    </div>
                                
                                    <div class="col-md-6 col-md-offset-1">
                                        <h1 class="page-header">Correos Agregados</h1>
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($correos)):?>
                                                    <?php foreach($correos as $correo):?>
                                                        <tr>
                                                            <td><?php echo $correo->id;?></td>
                                                            <td><?php echo $correo->correo;?></td>
                                                            <td>
                                                                <a href="<?php echo base_url();?>administrador/correos/delete/<?php echo $correo->id;?>" class="btn btn-danger">Eliminar</a>
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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de Area</h4>
      </div>
      <div class="modal-body">
        
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
