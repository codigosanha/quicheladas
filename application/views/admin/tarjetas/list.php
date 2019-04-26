<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Registro con Exito","<?php echo $this->session->flashdata("success"); ?>", "success");
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
        Tarjetas
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="areas">
                <div class="row">
                    <div class="col-md-4">
                        <h1 class="page-header ">Agregar Tarjeta</h1>
                        <form action="<?php echo base_url();?>administrador/tarjetas/store" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre de Tarjeta">
                            </div>
                            
                            <button type="submit" class="btn btn-success">Agregar</button>
                            
                        </form>
                    </div>
                
                    <div class="col-md-6 col-md-offset-1">
                        <h1 class="page-header">Tarjeras Agregados</h1>
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
                                <?php if(!empty($tarjetas)):?>
                                    <?php foreach($tarjetas as $tarjeta):?>
                                        <tr>
                                            <td><?php echo $tarjeta->id;?></td>
                                            <td><?php echo $tarjeta->nombre;?></td>
                                            <td>
                                                <button  type="button" class="btn btn-warning btn-edit-tarjeta" value="<?php echo $tarjeta->id;?>" data-toggle="modal" data-target="#modal-edit-tarjeta"> 
                                                    Editar
                                                </button>
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

<div class="modal fade" id="modal-edit-tarjeta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Tarjeta</h4>
      </div>
      <form action="<?php echo base_url();?>administrador/tarjetas/update" method="POST" id="form-edit-tarjeta">
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" name="idTarjeta" id="idTarjeta">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre">
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
