<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Bien Hecho!","<?php echo $this->session->flashdata("success"); ?>", "success");
    </script>
<?php endif ?>
<?php if ($this->session->flashdata("error")): ?>
    <script>
        swal("Error!", "<?php echo $this->session->flashdata("error"); ?>", "error");
    </script>
<?php endif ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="listado-pedidos">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Cocina
        <small>Listado de Pedidos</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <?php if (!empty($pedidos)): ?>
                        <?php foreach ($pedidos as $pedido): ?>
                            <?php 
                                if ($pedido->preparado == 0) {
                                    $status = "danger";
                                } else if ($pedido->preparado == 1){
                                    $status = "warning";
                                } else{
                                    $status = "success";
                                }

                            ?>
                            <div class="col-md-3">
                                <div class="panel panel-<?php echo $status;?>">
                                    <div class="panel-heading text-center">
                                        Pedido N° - <?php echo $pedido->id;?>
                                    </div>
                                    <div class="panel-body">
                                        <p class="text-center">

                                            <?php 
                                                $nummesas = "";
                                                foreach ($pedido->mesas as $mesa){
                                                    $nummesas .= $mesa->numero.","; 
                                                } 
                                            ?>
                                            <strong>Mesa(s) : </strong> <?php echo substr($nummesas, 0, -1); ?>

                                            
                                        </p>
                                        <p class="text-center"><strong>PRODUCTOS</strong></p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pedido->productos as $producto): ?>
                                                    <tr>
                                                        <td><?php echo $producto->nombre ?></td>
                                                        <td><?php echo $producto->cantidad ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                        <?php if ($pedido->preparado == 0): ?>
                                            <p class="text-center">
                                                <a href="<?php echo base_url();?>pedidos/cocina/procesarPreparacion/<?php echo $pedido->id;?>" class="btn btn-warning btn-flat btn-block">Marcar como Preparando</a>
                                            </p>
                                        <?php endif ?>
                                        <?php if ($pedido->preparado == 1): ?>
                                             <p class="text-center">
                                                <a href="<?php echo base_url();?>pedidos/cocina/finalizarPreparacion/<?php echo $pedido->id;?>" class="btn btn-success btn-flat btn-block">Marcar como Listo a Entregar</a>
                                            </p>
                                        <?php endif ?>
                                        
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="col-md-12 text-center">
                            <h1>Aun no se han realizado pedidos</h1>
                        </div>
                    <?php endif ?>
                    
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
