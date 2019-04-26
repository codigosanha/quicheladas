
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Ordenes del Dia
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($caja_abierta != false): ?>
                            <a href="<?php echo base_url();?>movimientos/ordenes/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Orden</a>
                            <a href="<?php echo base_url();?>movimientos/ordenes/venta_directa" class="btn btn-warning btn-flat"><span class="fa fa-plus"></span> Venta Directa</a>
                        <?php endif ?>
                        
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mesas</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($ordenes)):?>
                                    <?php foreach($ordenes as $orden):?>
                                        <tr>
                                            <td><?php echo $orden->id;?></td>

                                            <?php 
                                            $mesas = "";
                                            foreach ($orden->mesas as $mesa){
                                                $mesas .= $mesa->numero.","; 
                                            } 

                                            ?>
                                            <td><?php echo substr($mesas, 0, -1);?> <!-- <button type="button" class="btn btn-link btn-mesa">Cambiar o Unir Mesas</button></td> -->
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-info-pedido" data-toggle="modal" data-target="#modal-venta" value="<?php echo $orden->id;?>"><span class="fa fa-search"></span></button>
                                                    <a href="<?php echo base_url()?>movimientos/ordenes/edit/<?php echo $orden->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>movimientos/ordenes/pay/<?php echo $orden->id;?>" class="btn btn-success"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                                                    
                                                    <a href="<?php echo base_url();?>movimientos/ordenes/delete/<?php echo $orden->id;?>" class="btn btn-danger btn-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                   <?php endif;?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                              <!-- Custom Tabs (Pulled to the right) -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <?php foreach ($areas as $area): ?>
                                    <li class="<?php echo $area->id==$firstArea ? 'active':'';?>"><a href="#mesas" data-toggle="tab" data-href="<?php echo $area->id;?>" class="tab-area"><?php echo $area->nombre;?></a></li>
                                <?php endforeach ?>
                                <li class="pull-left header"><i class="fa fa-th"></i> Areas y Mesas</li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="mesas">
                                    <div class="row" id="mesas-area">
                                        <?php foreach ($mesasArea as $mesa): ?>
                                            <?php 
                                                $estado = 'mesa-ocupada';
                                                if ($mesa->estado == 1) {
                                                    $estado = 'mesa-disponible';
                                                }
                                            ?>
                                            <div class="col-md-3 col-sm-6 col-xs-6">
                                                <div class="numero-mesa <?php echo $estado;?>">
                                                    MESA<br>
                                                    <?php echo $mesa->numero;?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>

                                </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div>
                          <!-- nav-tabs-custom -->
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
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-flat btn-print"><span class="fa fa-print"></span> Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
