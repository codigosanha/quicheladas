<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos e Insumos
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
                                <i class="fa fa-plus"></i> Establecer Insumos a Productos
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
                                        
                                        <th>Producto</th>
                                        <th>Insumos</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($productos_insumos)):?>
                                        <?php foreach($productos_insumos as $pi):?>
                                            <tr>
                                                
                                                <td><?php echo getProducto($pi->producto_id)->nombre;?></td>
                                                <td><?php echo substr(getInsumos($pi->producto_id),0,-2);?></td>
                                                
                                                <td>
                                                    
                                                    <button type="button" class="btn btn-warning btn-edit-insumo-producto" data-toggle="modal" data-target="#modal-edit-insumo" value="<?php echo $pi->producto_id;?>">Editar</button>
                                                    <a href="<?php echo base_url();?>produccion/establecer_insumos/delete/<?php echo $pi->producto_id;?>" class="btn btn-danger">Eliminar</a>
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

<div class="modal fade" id="modal-add-insumo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Insumo a Producto</h4>
      </div>
      <form action="<?php echo base_url();?>produccion/establecer_insumos/store" method="POST" id="form-add-producto-insumos">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Producto:</label>
            <select name="producto_id" class="form-control select2" style="width: 100%;" required="required">
                <option value=""></option>
                <?php foreach ($productos as $p): ?>
                    <option value="<?php echo $p->id?>"><?php echo $p->nombre;?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10%;"></th>
                        <th style="width: 30%;">Insumo</th>
                        <th style="width: 30%;">Unidad de Medida</th>
                        <th style="width: 30%;">Cantidad Requerida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="insumos[]" value="<?php echo $insumo->id;?>" class="checkInsumo">
                            </td>
                            
                            <td><?php echo $insumo->nombre;?></td>
                            <td><?php echo getUnidadMedida($insumo->unidad_medida_id)->nombre;?></td>
                            
                            <td>
                                
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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
        <h4 class="modal-title">Editar Insumos de Producto</h4>
      </div>
      <form action="<?php echo base_url();?>produccion/establecer_insumos/update" method="POST" id="form-edit-insumo-producto">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Producto:</label>
            <input type="text" name="nombre" class="form-control" readonly="readonly">
            <input type="hidden" name="idProducto">
        </div>
        <div class="form-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10%;"></th>
                        <th style="width: 30%;">Insumo</th>
                        <th style="width: 30%;">Unidad de Medida</th>
                        <th style="width: 30%;">Cantidad Requerida</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo): ?>
                        <tr id="insumo<?php echo $insumo->id;?>">
                            <td>
                                <input type="checkbox" name="insumos[]" value="<?php echo $insumo->id;?>" class="checkInsumo">
                            </td>
                            
                            <td><?php echo $insumo->nombre;?></td>
                            <td><?php echo getUnidadMedida($insumo->unidad_medida_id)->nombre;?></td>
                            
                            <td>
                                
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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
