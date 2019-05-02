

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

        Ajustes de Inventario

        <small>Nuevo</small>

        </h1>

    </section>

    <!-- Main content -->

    <section class="content">

        <!-- Default box -->

        <div class="box box-solid">

            <div class="box-body">

                

                <div class="row">

                    <div class="col-md-12">

                        <form action="<?php echo base_url();?>mantenimiento/ajuste/store" method="POST">                        

                            <table  class="table table-bordered table-hover">

                                <thead>

                                    <tr>

                                        <th>Producto</th>

                                        

                                        <th>Stock BD</th>

                                        <th>Stock Fisico</th>

                                        <th>Diferencia de Stock</th>

                                        

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php if (!empty($productos)): ?>

                                        <?php foreach ($productos as $producto): ?>

                                            <tr>

                                                <td>

                                                    <input type="hidden" name="productos[]" value="<?php echo $producto->id;?>">

                                                    <?php echo getProducto($producto->id)->nombre;?>

                                                </td>

                                                

                                                <td>

                                                    <input type="hidden" name="stocks_bd[]" value="<?php echo $producto->stock;?>">

                                                    <?php echo $producto->stock;?>

                                                </td>

                                                <td>

                                                    <input type="text" name="stocks_fisico[]" class="form-control stocks_fisico" value="<?php echo $producto->stock;?>">

                                                </td>

                                                <td>

                                                    <input type="text" name="stocks_diferencia[]" class="form-control" value="0" readonly="readonly">

                                                </td>


                                            </tr>

                                        <?php endforeach ?>

                                    <?php endif ?>

                                </tbody>

                            </table>

                            <button type="submit" class="btn btn-success btn-flat">

                                <span class="fa fa-save"></span>

                                Guardar

                            </button>

                            <a href="<?php echo base_url();?>mantenimiento/ajuste" class="btn btn-danger">Volver</a>

                        </form>



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

        <h4 class="modal-title">Informacion de la Categoria</h4>

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

