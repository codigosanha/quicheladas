
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
              <input type="hidden" id="formulario" value="form-orden">
                <div class="row">
                    <div class="col-md-6">
                        <form action="<?php echo base_url();?>movimientos/ordenes/update" method="POST" id="add-orden">
                            <input type="hidden" name="idPedido" value="<?php echo $orden->id;?>">
                            <h4>Productos Agregado a la Orden</h4>
                            <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tborden">
                                <thead>
                                    <tr>
                                        <!-- <th>Imagen</th> -->
                                        <th>Producto</th>
                                        <th>Stock Max</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productos as $producto): ?>
                                        <tr>
                                            <!-- <td><img src="<?php echo base_url(); ?>assets/imagenes_productos/<?php echo $producto->imagen ?>" class="img-responsive" style="width: 100px;" alt="<?php echo $producto->nombre ?>"></td> -->
                                            <td>
                                                <input type="hidden" value="<?php echo $producto->producto_id?>">
                                                <?php echo $producto->nombre;?>
                                                <?php $extras = getPreciosExtras($orden->id,$producto->producto_id,$producto->codigo);?>
                                                <?php foreach ($extras as $e): ?>
                                                  <p style="margin: 0"><i><?php echo $e->nombre;?></i></p>
                                                <?php endforeach ?>

                                                <?php $ofertas = getOfertas($orden->id,$producto->producto_id,$producto->codigo);?>
                                                <?php foreach ($ofertas as $o): ?>
                                                  <p style="margin: 0"><i><?php echo $o->nombre." - ".$o->cantidad;?></i></p>
                                                <?php endforeach ?>
                                                    
                                            </td>
                                            <?php 
                                                $stock = "N/A";
                                                if ($producto->condicion == 1){
                                                    $stock = $producto->stock;
                                                }
                                                
                                            ?>
                                            <td><?php echo $stock;?></td>
                                            <td>
                                                <div class="input-group">
                                                    
                                                    <input type="number" class="form-control input-cantidad input-sm" readonly="readonly" style="font-weight: bold; width: 50px;" value="<?php echo $producto->cantidad - $producto->pagados;?>" min="1" max="">
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-warning btn-sm btn-menos" type="button" disabled="disabled"><span class="fa fa-minus"></span></button></span>
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-success btn-sm btn-mas" type="button" disabled="disabled"><span class="fa fa-plus"></span></button></span>
                                                </div>
                                            </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-quitarprod btn-sm" value="<?php echo $orden->id."*".$producto->producto_id."*".($producto->cantidad - $producto->pagados)."*".$producto->id;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-times"></span></button>
                                                </td>
                                            
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            </div>
                            <div id="extras"></div>
                            <?php 
                                $mesasActual = "";
                                foreach ($pedidomesas as $pedidomesa){
                                    $mesasActual .= $pedidomesa->numero.",";
                                }
                            ?>
                            <div class="form-group" id="content-mesas">
                                <label for="">Mesas</label>
                                <select name="mesas[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione mesas" style="width: 100%;" required="required" id="mesas">
                                    <optgroup label="Mesa(s) Actual">
                                    <?php foreach ($pedidomesas as $pedidomesa): ?>
                                        <option value="<?php echo $pedidomesa->id;?>" selected="selected"><?php echo $pedidomesa->numero." (".$pedidomesa->area.")";?></option>
                                    <?php endforeach ?>
                                    </optgroup>
                                    <optgroup label="Mesa(s) Disponibles">
                                    <?php foreach ($mesas as $mesa): ?>
                                        <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero." (".$mesa->area.")";?></option>
                                    <?php endforeach ?>
                                    </optgroup>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <button id="btn-success" type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <a href="<?php echo base_url();?>movimientos/ordenes" class="btn btn-danger">Volver</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <h4 class="page-header">Categorias</h4>
                        <?php if (!empty($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <button type="button" class="btn btn-success btn-flat btn-categoria btn-block" value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></button>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    <div class="col-md-3">
                        <h4 class="page-header">Lista de Productos</h4>
                        <div class="list-group" id="lista-productos">
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
        <button id="btn-cmodal" type="button" class="btn btn-danger pull-left btn-cerrar-imp" data-dismiss="modal">Cerrar</button>
        <a href="<?php echo base_url() ?>movimientos/ordenes/printOrden"  class="btn btn-primary btn-flat"><span class="fa fa-print"></span> Imprimir</a>
      </div>
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
        <h4 class="modal-title">Eliminar producto de la orden</h4>
      </div>
      <form action="#" method="POST" id="form-clave">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Ingrese Clave de Permiso</label>
            <input type="password" class="form-control" name="clave">
            <input type="hidden" name="idOrden" id="idOrden">
            <input type="hidden" name="idProducto" id="idProducto">
            <input type="hidden" name="idPedidoProd" id="idPedidoProd">
        </div>
        <div class="form-group">
            <label for="">Cantidad a eliminar</label>
            <input type="text" class="form-control" name="cantEliminar" id="cantEliminar" max="1">
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones:</label>
            <textarea name="observaciones" id="observaciones" rows="5" class="form-control"></textarea>
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

<div class="modal fade" id="modal-extras">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        
        <h4 class="text-center">Nuevo Extra</h4>
        <form action="<?php echo base_url(); ?>movimientos/ordenes/saveExtra" class="form-horizontal" method="POST" id="saveExtra">
            <input type="hidden" id="tr-id">
            <input type="hidden" id="idProducto" name="idProducto">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nombre" placeholder="Nuevo Extra" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="text" name="precio" value="0.00" class="form-control">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
        <h4 class="text-center">Extras Registrados</h4>
        <div class="row" id="extras-registrados">

        </div>
        
      </div>
      <div class="modal-footer">
        <button id="btn-cmodal" type="button" class="btn btn-danger pull-left " data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-combo">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
        <input type="hidden" id="tr_producto">
        <input type="hidden" id="id_producto">
      </div>
      <div class="modal-body">
        
            
        </div>
       
        
   
      <div class="modal-footer">
        <button id="btn-cmodal" type="button" class="btn btn-danger pull-left " data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
