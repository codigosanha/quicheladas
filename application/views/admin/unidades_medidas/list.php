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
        Unidades de Medida
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="medidas">
                <div class="row">
                    <div class="col-md-4">
                        <h1 class="page-header ">Agregar Unidad de Medida</h1>
                        <form action="<?php echo base_url();?>mantenimiento/unidades_medidas/store" method="POST">
                            <div class="form-group">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre de Tarjeta">
                            </div>
                            
                            <button type="submit" class="btn btn-success">Agregar</button>
                            
                        </form>
                    </div>
                
                    <div class="col-md-6 col-md-offset-1">
                        <h1 class="page-header">Unidades de Medidas Agregados</h1>
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
                                <?php if(!empty($medidas)):?>
                                    <?php foreach($medidas as $medida):?>
                                        <tr>
                                            <td><?php echo $medida->id;?></td>
                                            <td><?php echo $medida->nombre;?></td>
                                            <td>
                                                <button  type="button" class="btn btn-warning btn-edit-medida" value="<?php echo $medida->id;?>" data-toggle="modal" data-target="#modal-edit-medida"> 
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

<div class="modal fade" id="modal-edit-medida">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Unidad de Medida</h4>
      </div>
      <form action="<?php echo base_url();?>mantenimiento/unidades_medidas/update" method="POST" id="form-edit-medida">
      <div class="modal-body">
        <div class="form-group">
            <input type="hidden" name="idMedida" id="idMedida">
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
