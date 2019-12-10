
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes
        <small>Nuevo</small>
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
                        <form action="<?php echo base_url();?>movimientos/ordenes/store" method="POST" id="add-orden">
                            <h4 class="page-header">Productos Agregado a la Orden</h4>
                            <div class="form-group">
                                <label for="">El consumo es para:</label>
                                <select name="tipo_consumo" id="tipo_consumo" class="form-control">
                                    <option value="1">Comer en el Restaurant</option>
                                    <option value="2">Llevar</option>
                                </select>
                            </div>
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
                                    
                                </tbody>
                            </table>
                            </div>
                            <div id="extras"></div>
                            <div class="form-group" id="content-mesas">
                                <label for="">Mesas</label>
                                <select name="mesas[]" class="form-control select2" multiple="multiple" data-placeholder="Seleccione mesas" style="width: 100%;" required="required" id="mesas">
                                  <?php foreach ($mesas as $mesa): ?>
                                      <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero." (".$mesa->area.")";?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button id="btn-success" type="submit" class="btn btn-success btn-flat btn-guardar" disabled="disabled">Guardar</button>
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
                        <h6 class="page-header">Lista de Productos</h6>
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