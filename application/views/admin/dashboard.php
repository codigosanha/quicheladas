
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
                <!-- ./col -->
                    
                    <div style="background-color: white;" class="row">
                    <div  class="col-md-12">
                        <div align="center">
                        <div calss="col-md-12 content-header"> <strong>Ultimos 5 Productos Agregados</strong></div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive "></div>
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
             </div>
             <hr>
             <!--Productos mas vendidos-->
             <div style="background-color: white;" class="row">
                    <div  class="col-md-12">
                        <div align="center">
                        <div calss="col-md-12 content-header"> <strong>Top 10 Productos mas Vendidos</strong></div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive "></div>
                        <table class="table table-bordered table-hover table-striped">
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
                                            <td><?php echo $pmv->nombre;?></td>
                                            <td><?php echo $pmv->categoria;?></td>
                                            
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                     </div>
                 </div>
             </div>
                <!-- /.row -->
                  <!--Productos con Stock Agotado-->
             <div style="background-color: white;" class="row">
                    <div  class="col-md-12">
                        <div align="center">
                        <div calss="col-md-12 content-header"> <strong>Productos con Stock Critico</strong></div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive "></div>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                      <th>Categoria</th>
                                    <th>Existencias</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($pstockminimo)):?>
                                    <?php $i=1;?>
                                    <?php foreach($pstockminimo as $psm):?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $psm->nombre;?></td>
                                            <td><?php echo $psm->categoria;?></td>
                                            <?php if($psm->condicion == "1"):?>
                                                <?php if ($psm->stock <= $psm->stock_minimo): ?>
                                                    <td style="color: red;"><b><?php echo $psm->stock;?></b></td>
                                                <?php else:?>
                                                    <td style="color: green;"><b><?php echo $psm->stock;?></b></td>
                                                <?php endif ?>
                                                
                                            <?php else: ?>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            <?php endif;?>
                                            
                                            
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                     </div>
                 </div>
             </div>
                <!-- /.row -->
                <?php endif ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->