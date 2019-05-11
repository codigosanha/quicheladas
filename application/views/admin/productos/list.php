
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
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
                        <a href="<?php echo base_url();?>mantenimiento/productos/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Productos</a>
                        <?php endif;?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="test">
                        <table id="example1" class="table table-bordered table-hover"  style="z-index: 1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Stock Min.</th>
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($productos)):?>
                                    <?php foreach($productos as $producto):?>
                                        <tr>
                                            <td><?php echo $producto->id;?></td>
                                            <td><?php echo $producto->codigo;?></td>
                                            <td><?php echo $producto->nombre;?></td>
                                            <td><?php echo $producto->descripcion;?></td>
                                            <td><?php echo $producto->precio;?></td>
                                            <?php if($producto->condicion == "1"):?>
                                                <td><?php echo $producto->stock_minimo;?></td>
                                                <?php if ($producto->stock <= $producto->stock_minimo): ?>
                                                    <td style="color: red;"><b><?php echo $producto->stock;?></b></td>
                                                <?php else:?>
                                                    <td style="color: green;"><b><?php echo $producto->stock;?></b></td>
                                                <?php endif ?>
                                                
                                            <?php else: ?>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            <?php endif;?>

                                            <td><?php echo $producto->categoria;?></td>
                                            
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-transparent btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <span class="fa fa-cogs"></span> <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="#modal-default" class=" btn-view-producto" 
                                                            data-href="<?php echo $producto->id;?>" data-toggle="modal">
                                                                <i class="fa fa-eye"></i>
                                                                Ver
                                                            </a>
                                                        </li>
                                                        <?php if($permisos->update == 1):?>

                                                        <li>
                                                            <a href="<?php echo base_url()?>mantenimiento/productos/edit/<?php echo $producto->id;?>">
                                                                <i class="fa fa-pencil"></i>
                                                                Editar
                                                            </a>
                                                        </li>
                                                        <?php endif;?>
                                                        <?php if($permisos->delete == 1):?>
                                                        <li>
                                                            <a href="<?php echo base_url();?>mantenimiento/productos/delete/<?php echo $producto->id;?>" class="btn-remove">
                                                                <i class="fa fa-times"></i>
                                                                Eliminar
                                                            </a>
                                                        </li>
                                                        <?php endif;?>
                                                        <li>
                                                            <a href="#modal-extras" class=" btn-extras" data-toggle="modal" data-target="#modal-extras" data-href="<?php echo $producto->id;?>">
                                                                <i class="fa fa-plus"></i>
                                                                Extras
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#modal-medidas" class="btn-medidas" data-toggle="modal" data-target="#modal-medidas" data-href="<?php echo $producto->id;?>">
                                                                <i class="fa fa-tags"></i>
                                                                Unidad de Medidas</a>
                                                        </li>
                                                    </ul>
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

<div class="modal fade" id="modal-extras">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Extras del Producto</h4>
      </div>
      <div class="modal-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar Extras
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <form action="" method="POST" id="form-add-extra">
                        <input type="hidden" name="idProducto" id="idProducto">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del extra" required="required">
                            </div>
                            <div class="col-md-4">
                                <label for="precio">Precio:</label>
                                <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio del extra" required="required">
                            </div>
                            <div class="col-md-4">
                                
                                <button type="submit" class="btn btn-success btn-flat" style="margin-top: 24px;">
                                    <span class="fa fa-plus"></span> Agregar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de Extras
            </div>
            <div class="panel-body no-padding">
                <table class="table table-bordered table-striped" id="tbmedidas">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-medidas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Unidades de medidas del Producto</h4>
      </div>
      <div class="modal-body">
        <h1 class="page-header text-center" id="nombreProducto"></h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar Medida
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <form action="" method="POST" id="form-add-medida">
                        <input type="hidden" name="idProducto" id="idProducto">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombre">Unidad de Medida:</label>
                                <select name="unidad_medida_id" id="unidad_medida_id" class="form-control" required="required">
                                    <option value="">Selecccione..</option>
                                    <?php if (!empty($medidas)): ?>
                                        <?php foreach ($medidas as $medida): ?>
                                            <option value="<?php echo $medida->id?>"><?php echo $medida->nombre;?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cantidad">Cantidad de la medida:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" required="required">
                            </div>
                            <div class="col-md-2">
                                <label for="precio">Precio:</label>
                                <input type="text" name="precio" id="precio" class="form-control" required="required">
                            </div>
                            <div class="col-md-1">
                                
                                <button type="submit" class="btn btn-success btn-flat" style="margin-top: 24px;">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de Unidades de Medidas
            </div>
            <div class="panel-body no-padding">
                <table class="table table-bordered table-striped" id="tbmedidas">
                    <thead>
                        <tr>
                            <th>Unidad de Medida</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

