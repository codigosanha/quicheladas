
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
                                        <th style="width:35%;">Producto</th>
                                        <th style="width:20%;">Stock Max</th>
                                        <th style="width:30%;">Cantidad</th>
                                        <th style="width:15%;"></th>
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
                                      <option value="<?php echo $mesa->id;?>"><?php echo $mesa->numero;?></option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button id="btn-success" type="submit" class="btn btn-success btn-flat btn-guardar" disabled="disabled">Guardar</button>
                                <a href="<?php echo base_url();?>movimientos/ordenes" class="btn btn-danger">Volver</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <h4 class="page-header">Categorias</h4>
                        <?php if (!empty($categorias)): ?>
                            <?php foreach ($categorias as $categoria): ?>
                                <button type="button" class="btn btn-success btn-flat btn-categoria btn-block" value="<?php echo $categoria->id;?>"><?php echo $categoria->nombre;?></button>
                            <?php endforeach ?>
                        <?php endif ?>
                        
                    </div>
                    <div class="col-md-4">
                        <h4 class="page-header">Productos de la Categoria</h4>
                        <div class="row" id="list-product">
                            

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
    <button type="button" class="btn btn-primary btn-flat btn-print"><span class="fa fa-print"></span> Imprimir</button>
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
        <div class="panel panel-primary">

            <div class="panel-heading">Listado de Extras</div>
            <div class="panel-body">
                <input type="hidden" id="tr-id">
                <input type="hidden" id="idProducto">
                <table class="table table-hover table-bordered" id="tbextras">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
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