<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Caja Abierta","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error!", "<?php echo $this->session->flashdata("error"); ?>", "error");
    </script>
<?php endif ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Aperturas y Cierres de Caja
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <input type="hidden" id="modulo" value="categorias">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($permisos->insert == 1):?>
                            <?php if (!$caja_abierta): ?>
                                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-abrir-caja">
                                    <i class="fa fa-plus"></i> Abrir Caja
                                </button>
                            <?php endif ?>
                        
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
                                    <th>Usuario </th>
                                    <th>Fecha y Hora de Apertura de Caja</th>    
                                    <th>Fecha y Hora de Cierre de Caja</th>  
                                    <th># Total de Ventas  </th> 
                                    <th>Monto Inicial de Caja  </th> 
                                    <th>Monto de Ventas </th>
                                    <th>Monto Final de Caja(Efectivo)</th>   
                                    <th>Monto de Ventas con (Tarjeta de Crédito)    </th>
                                    <th>Gastos(Dinero Tomado de la Caja)(Modulo de Caja) </th>   
                                    <th>Crédito(Ventas al Crédito sin ninguna garantía)</th>
                                    <th>Efectivo en Caja  </th>  
                                    <th>Observaciones  </th> 
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($cajas)):?>
                                    <?php foreach($cajas as $caja):?>
                                        <tr>
                                            <td><?php echo getUsuario($caja->usuario_id)->username;?></td>
                                            <td><?php echo $caja->fecha_apertura;?></td>
                                            <td><?php echo $caja->fecha_cierre;?></td>
                                            <td><?php echo getNumeroVentas($caja->id);?></td>
                                            <td><?php echo $caja->monto_apertura;?></td>
                                            <?php $montoVentas = getMontoVentas($caja->id)?>
                                            <td><?php echo $montoVentas;?></td>
                                            <?php 
                                                $monto_efectivo =  getMontos('monto_efectivo',$caja->id);
                                            ?>
                                            <td><?php echo $monto_efectivo; ?></td>
                                            <td><?php echo getMontos('monto_tarjeta',$caja->id);?></td>
                                            <?php $gastos = getGastos($caja->id); ?>
                                            <td><?php echo $gastos;?></td>
                                            <td><?php echo getMontos('monto_credito',$caja->id);?></td>
                                            <?php $efectivo = $caja->monto_apertura + $monto_efectivo - $gastos?>
                                            <td><?php echo number_format($efectivo, 2, '.', '');?></td>
                                            <td><?php echo $caja->observacion;?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php if ($this->session->userdata("rol")==1 || $this->session->userdata("id") == $caja->usuario_id): ?>
                                                        <?php if ($caja->estado == 1): ?>
                                                            <button type="button" class="btn btn-danger btn-flat btn-cerrar-caja" value="<?php echo $caja->id;?>">
                                                                <i class="fa fa-times"></i>
                                                                Cerrar Caja
                                                            </button>
                                                        <?php endif ?>
                                                    <?php endif ?>
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

<div class="modal fade" id="modal-abrir-caja">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la Apertura de Caja</h4>
      </div>
      <form action="<?php echo base_url();?>caja/apertura_cierre/store" method="POST">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Monto de Apertura</label>
            <input type="text" name="monto" class="form-control" required="required">
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
