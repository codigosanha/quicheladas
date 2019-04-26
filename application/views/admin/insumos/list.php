<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Insumos
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
                            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-add-insumo">
                                <i class="fa fa-plus"></i> Agregar Gasto
                            </button>
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
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Unidad de Medida</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($insumos)):?>
                                        <?php foreach($insumos as $insumo):?>
                                            <tr>
                                                <td><?php echo $insumo->id;?></td>
                                                <td><?php echo $insumo->nombre;?></td>
                                                <td><?php echo $insumo->cantidad;?></td>
                                                <td><?php echo getUnidadMedida($insumo->unidad_medida_id)->nombre;?></td>
                                                <td>
                                                    <?php $dataInsumo = $insumo->id."*".$insumo->nombre."*".$insumo->cantidad."*".$insumo->unidad_medida_id;?>
                                                    <button type="button" class="btn btn-warning btn-edit-insumo" data-toggle="modal" data-target="#modal-edit-insumo" value="<?php echo $dataInsumo;?>">Editar</button>
                                                    <a href="<?php echo base_url();?>produccion/insumos/delete/<?php echo $insumo->id;?>" class="btn btn-danger btn-remove">Eliminar</a>
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

<div class="modal fade" id="modal-add-insumo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Insumo</h4>
      </div>
      <form action="<?php echo base_url();?>produccion/insumos/store" method="POST" id="form-add-insumo">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Nombre del Insumo:</label>
            <input type="text" name="nombre" class="form-control" required="required">
        </div>
        <div class="form-group">
            <label for="">Cantidad:</label>
            <input type="text" name="cantidad" class="form-control" required="required">
        </div>
        <div class="form-group">
            <label for="">Unidad Medida:</label>
            <select name="unidad_medida_id" class="form-control" required="required">
                <option value="">Seleccione...</option>
                <?php foreach ($unidades_medidas as $um): ?>
                    <option value="<?php echo $um->id?>"><?php echo $um->nombre?></option>
                <?php endforeach ?>
            </select>
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

<div class="modal fade" id="modal-edit-insumo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Insumo</h4>
      </div>
      <form action="<?php echo base_url();?>produccion/insumos/update" method="POST" id="form-edit-insumo">
        <input type="hidden" name="idInsumo" id="idInsumo">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Nombre del Insumo:</label>
            <input type="text" name="nombre" class="form-control" required="required">
        </div>
        <div class="form-group">
            <label for="">Cantidad:</label>
            <input type="text" name="cantidad" class="form-control" required="required">
        </div>
        <div class="form-group">
            <label for="">Unidad Medida:</label>
            <select name="unidad_medida_id" class="form-control" required="required">
                <option value="">Seleccione...</option>
                <?php foreach ($unidades_medidas as $um): ?>
                    <option value="<?php echo $um->id?>"><?php echo $um->nombre?></option>
                <?php endforeach ?>
            </select>
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
