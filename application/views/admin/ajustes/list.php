<?php if($this->session->flashdata("success")):?>

    <script>
        $(document).ready(function(){
            var id= '<?php echo $this->session->flashdata("success"); ?>';
            showAjuste(id);
        });

    </script>

<?php endif; ?>

<?php if($this->session->flashdata("error")):?>

    <script>

        swal("Error!", "<?php echo $this->session->flashdata('error');?>", "error");

    </script>

<?php endif;?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

        Ajustes de Inventario

        <small>Listado</small>

        </h1>

    </section>

    <!-- Main content -->

    <section class="content">

        <!-- Default box -->

        <div class="box box-solid">

            <div class="box-body">

                <?php if (!$ajusteActual): ?>

                    <div class="row">

                        <div class="col-md-12">

                            <?php if($permisos->insert == 1):?>

                            <a href="<?php echo base_url();?>mantenimiento/ajuste/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Ajuste</a>

                            <?php endif;?>

                        </div>

                    </div>

                    <hr>

                <?php endif ?>

                

                <div class="row">

                    <div class="col-md-12">

                        <table id="example1" class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Fecha</th>

                                    <th>Usuario</th>

                                    <th>Opciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($ajustes)): ?>

                                    <?php foreach ($ajustes as $ajuste): ?>

                                        <tr>

                                            <td><?php echo $ajuste->id;?></td>

                                            <td><?php echo $ajuste->fecha;?></td>

                                            <td><?php echo getUsuario($ajuste->usuario_id)->nombres;?></td>

                                            <td>

                                                <?php if($permisos->update == 1):?>
                                                    <button type="button" class="btn btn-info btn-view-ajuste" value="<?php echo $ajuste->id;?>">
                                                        <span class="fa fa-eye"></span>
                                                    </button>
                                                    <a href="<?php echo base_url();?>mantenimiento/ajuste/edit/<?php echo $ajuste->id;?>" class="btn btn-warning btn-flat"><span class="fa fa-pencil"></span></a>
                                                    

                                                <?php endif;?>

                                            </td>

                                        </tr>

                                    <?php endforeach ?>

                                <?php endif ?>

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



<div class="modal fade" id="modal-ajuste">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title">Informacion del Ajuste</h4>

      </div>

      <div class="modal-body">
        <p></p>
        

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print-ajuste">Imprimir</button>

      </div>

    </div>

    <!-- /.modal-content -->

  </div>

  <!-- /.modal-dialog -->

</div>

<!-- /.modal -->

