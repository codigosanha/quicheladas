
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Venta Directa
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="formulario" value="venta_directa">
                <div class="row">
                    <div class="col-md-7">
                        <form action="<?php echo base_url();?>movimientos/ventas/save_venta_directa" method="POST" id="form-venta-directa">
                            <h4 class="page-header">Productos Agregado a la Venta</h4>
                            <input type="hidden" name="igv" id="igv" value="0">
                            <div class="form-group">
                                <label for="">Cliente:</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Buscar Cliente..." id="cliente" data-toggle="modal" data-target="#modal-default" required="required">

                                  <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                                  </span>
                                </div><!-- /input-group -->
                            </div>
                            <input type="hidden" name="serie" id="serie" value="<?php echo $comprobantePredeterminado->serie;?>">
                                <?php 

                                    $numero = $comprobantePredeterminado->cantidad + 1;



                                ?>
                            <input type="hidden" name="numero" id="numero" value="<?php echo str_pad($numero, 6, "0", STR_PAD_LEFT); ?>">
                            <input type="hidden" name="idComprobante" id="idComprobante" value="<?php echo $comprobantePredeterminado->id;?>">
                            <input type="hidden" name="idcliente" id="idcliente">

                            <div class="form-group">
                                <label for="">Forma de Pago</label>
                                <select name="tipo_pago" id="tipo_pago" class="form-control">
                                    <option value="1">Efectivo</option>
                                    <option value="2">Tarjeta de Credito</option>
                                    <option value="3">Pago Mixto</option>
                                    <option value="4">Credito</option>
                                </select>
                            </div>
                            <div class="form-group" id="content-tarjeta" style="display: none;">
                                <label for="">Tarjeta</label>
                                <select name="tarjeta" id="tarjeta" class="form-control">
                                    <?php foreach ($tarjetas as $tarjeta): ?>
                                        <option value="<?php echo $tarjeta->id?>"><?php echo $tarjeta->nombre;?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group" id="content-monto-tarjeta" style="display: none;">
                                <label for="">Monto de tarjeta</label>
                                <input type="text" name="monto_tarjeta" id="monto_tarjeta" class="form-control">
                            </div>

                            <div class="form-group" id="content-monto-efectivo" style="display: none;">
                                <label for="">Monto de Efectivo</label>
                                <input type="text" name="monto_efectivo" id="monto_efectivo" class="form-control">
                            </div>
                            
                            <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tb-venta-directa">
                                <thead>
                                    <tr>
                                       
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Stock Max</th>
                                        <th>Cantidad</th>
                                        <th>Descuento</th>
                                        <th>Importe</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">Subtotal:</th>
                                        <td colspan="2"><input type="hidden" name="subtotal" id="subtotal"><p class="subtotal"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">IVA:</th>
                                        <td colspan="2"><input type="hidden" name="iva" id="iva"><p class="iva"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">Descuento:</th>
                                        <td colspan="2"><input type="hidden" name="descuento" id="descuento" value="0.00"><p class="descuento"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">Total:</th>
                                        <td colspan="2"><input type="hidden" name="total" id="total"><p class="total"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">Efectivo:</th>
                                        <td colspan="2"><input type="text" name="monto_recibido" id="monto_recibido" width="60px"><p class="form_control monto_recibido"></p></td>
                                    </tr>
                                    <tr>
                                        <th colspan="6" style="text-align: right;">Cambio:</th>
                                        <td colspan="2"><input type="text" name="cambio" id="cambio" readonly="readonly" class="form-control cambio" width="60px"><p class="cambio"></p></td>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <div id="extras"></div>
                            <div class="form-group">
                                <button id="btn-success" type="submit" class="btn btn-success btn-flat btn-guardar" disabled="disabled">Guardar</button>
                                <a href="<?php echo base_url();?>movimientos/ordenes" class="btn btn-danger">Volver</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">Aplicar Descuento</button>
                                <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-cupon">Canjear Cupón</button>
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
        <h4 class="modal-title">Informacion de la venta</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button  type="button" class="btn btn-danger pull-left btn-cerrar-modal-vd" data-dismiss="modal">Cerrar</button>
        <a href="<?php echo base_url(); ?>movimientos/ventas/printVenta" class="btn btn-primary">Imprimir</a>
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
        <input type="hidden" id="tr-id">
                <input type="hidden" id="idProducto">
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

<div class="modal fade" id="modal-default2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del Descuento</h4>
            </div>
            <div class="modal-body">

                <form action="#" method="POST" id="form-comprobar-password">
                    <div class="form-group">
                        <label for="">Monto</label>
                        <input type="text" name="montoDescuento" id="montoDescuento" class="form-control" placeholder="Monto...">
                    </div>
                    <div class="form-group">
                        <label for="">Introduzca Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña...">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Comprobar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-cupon">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Canjear Cupón</h4>
      </div>
      <form action="<?php echo base_url();?>movimientos/ordenes/validarCupon" method="POST" id="formCanjearCupon">
      <div class="modal-body">
          <div class="form-group">
              <label for="">Ingrese Codigo</label>
              <input type="text" class="form-control" name="codigo" id="codigo">
              <input type="hidden" name="tipo_cupon" value="1">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success"><span class="fa fa-print"> </span>Comprobar</button>
      </div>
      </form>
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
                <h4 class="modal-title">Clientes</h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab">Listado</a></li>
                      <li><a href="#tab_2" data-toggle="tab">Registrar</a></li>
                      
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($clientes)):?>
                                        <?php foreach($clientes as $cliente):?>
                                            <tr>
                                                <td><?php echo $cliente->id;?></td>
                                                <td><?php echo $cliente->nombre;?></td>
                                                <td><?php echo $cliente->direccion;?></td>
                                                <td><?php echo $cliente->telefono;?></td>
                                                <?php $datacliente = $cliente->id."*".$cliente->nombre."*".$cliente->telefono."*".$cliente->direccion;?>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente;?>"><span class="fa fa-check"></span></button>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        <form action="<?php echo base_url();?>movimientos/ventas/savecliente" method="POST" id="form-cliente">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar y Seleccionar</button>
                            </div>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                      
                    </div>
                    <!-- /.tab-content -->
                </div>


                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->