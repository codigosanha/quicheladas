
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Configuraciones de Cupones
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="areas">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                        <a href="<?php echo base_url();?>administradpr/cupones/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Area</a>
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
                                    <th>Tipo de Cupon</th>
                                    <th>Valor</th>
                                    <th>Rango de Monto</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Final</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($configuraciones)):?>
                                    <?php foreach($configuraciones as $c):?>
                                        <tr>
                                            <td><?php echo $c->id;?></td>
                                            <td>
                                                <?php
                                                    if ($c->tipo_cupon == 1) {
                                                        echo "Cupon de Descuento";
                                                    } else if($c->tipo_cupon == 2){
                                                        echo "Cupon de Almuerzo Gratis";
                                                    } else {
                                                        echo "Cupon de Premio";
                                                    }
                                                ?>     
                                            </td>
                                            <td><?php echo $c->monto_inicial." - ".$c->monto_final;?></td>
                                            <td><?php echo $c->fecha_inicio;?></td>
                                            <td><?php echo $c->fecha_final;?></td>
                                            <td>
                                                
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
        <h4 class="modal-title">Informacion de Area</h4>
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
