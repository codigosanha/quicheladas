
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Comprobantes
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('success'); ?>
                        
                      </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('error'); ?>
                        
                      </div>
                <?php endif ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php if($permisos->insert == 1):?>
                        <a href="<?php echo base_url();?>administrador/comprobantes/add" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Comprobante</a>
                        <?php endif;?>
                    </div>
                    <div class="col-md-6">
                        <form action="<?php echo base_url();?>administrador/comprobantes/establecerPredeterminado" method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Comprobante Predeterminado:</span>
                                    <select name="comprobante" id="comprobante" class="form-control" required="required">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($comprobantes as $comprobante): ?>
                                            <option value="<?php echo $comprobante->id;?>" <?php echo $comprobante->predeterminado == 1 ? 'selected':'';?>><?php echo $comprobante->nombre;?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit">Establecer</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Serie</th>
                                    <th>Numero Inicial</th>
                                    <th>Limite</th>
                                    <th>Solicitar NIT</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($comprobantes)):?>
                                    <?php foreach($comprobantes as $comprobante):?>
                                        <tr>
                                            <td><?php echo $comprobante->id;?></td>
                                            <td><?php echo $comprobante->nombre;?></td>
                                            <td><?php echo $comprobante->serie;?></td>
                                            <td><?php echo str_pad($comprobante->numero_inicial, 8, "0", STR_PAD_LEFT);?></td>
                                            <td><?php echo $comprobante->limite;?></td>
                                            

                                            <?php if ($comprobante->solicitar_nit == 0): ?>
                                                <td>No es necesario</td>
                                            <?php else: ?>
                                                <td>Es necesario</td>
                                            <?php endif ?>
                                            <td>
                                                <div class="btn-group">
                                                    
                                                    <?php if($permisos->update == 1):?>
                                                    <a href="<?php echo base_url()?>administrador/comprobantes/edit/<?php echo $comprobante->id;?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                    <?php endif;?>
                                                    <?php if($permisos->delete == 1):?>
                                                    <a href="<?php echo base_url();?>administrador/comprobantes/delete/<?php echo $comprobante->id;?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                                                    <?php endif;?>
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
        <h4 class="modal-title">Informacion de la Comprobante</h4>
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
