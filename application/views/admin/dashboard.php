
        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php if ($this->backend_lib->verGrafico()): ?>
            <section class="content-header">
                <h1>
                Dashboard
                <small>Panel de Control </small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner"> 
                                <h3><?php echo $cantClientes;?></h3>

                                <p>Clientes</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="<?php echo base_url();?>mantenimiento/clientes" class="small-box-footer">Ver Clientes <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $cantProductos;?></h3>

                                <p>Productos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="<?php echo base_url();?>mantenimiento/productos" class="small-box-footer">Ver Productos <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo $cantUsuarios;?></h3>

                                <p>Usuarios</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="<?php echo base_url();?>administrador/usuarios" class="small-box-footer">Ver Usuarios <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $cantVentas;?></h3>

                                <p>Ventas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="<?php echo base_url();?>movimientos/ventas" class="small-box-footer">Ver Ventas <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                    <!-- ./col -->
                    
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Grafico de Ventas x Día</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Grafico de Ventas x Mes</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div id="grafico" style="height: 400px;width: 100%;"></div>
                        </div>
                          <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div id="graficoMeses" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                        </div>
                          <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Los ultimos 10 productos agregados</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($productoslast)):?>
                                    <?php foreach($productoslast as $producto):?>
                                        <tr>
                                            
                                            <td><?php echo $producto->id;?></td>
                                            <td><?php echo $producto->nombre;?></td>
                                            <td><?php echo $producto->categoria;?></td>
                                            
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col (left) -->
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Top 10 productos mas vendidos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="tb-productos-vendidos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($productosmvendidos)):?>
                                    <?php $i=1;?>
                                    <?php foreach($productosmvendidos as $pmv):?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><input type="hidden" value="<?php echo $pmv->totalVendidos;?>"><?php echo $pmv->nombre;?></td>
                                            <td><?php echo $pmv->categoria;?></td>
                                            
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col (right) -->
        </div>

        <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Mesas mas Prendidas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <?php foreach ($pedidos as $pedido): ?>
                            <?php $mesasArea = getMesasFromPedido($pedido->pedido_id);?>
                            <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                     <strong>Mesas: </strong><?php echo substr($mesasArea['mesas'],0,-1);?> - <strong>Area: </strong><?php echo $mesasArea['area'];?> 
                                </div>
                                <div class="panel-body no-padding">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $productos = getProductosFromPedido($pedido->pedido_id);?>
                                            <?php $i = 1;?>
                                            <?php if (!empty($productos)): ?>
                                                <?php foreach ($productos as $p): ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $p->nombre ?></td>
                                                        <td><?php echo $p->cantidad ?></td>
                                                    </tr>
                                                    <?php $i++;?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                         <?php endforeach ?> 
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Top 10 Mejores Clientes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Monto de Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;?>
                                <?php if(!empty($clientes)):?>
                                    <?php foreach($clientes as $c):?>
                                        <tr>
                                            
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $c->nombre?></td>
                                            <td><?php echo $c->total;?></td>
                                            <?php $i++;?>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafico de Productos mas Vendidos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="grafico-torta" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
        </div>
                <!-- /.row -->
                <?php endif ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->