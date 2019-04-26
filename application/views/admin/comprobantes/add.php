
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Comprobantes
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($this->session->flashdata("error")):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                
                             </div>
                        <?php endif;?>
                        <form action="<?php echo base_url();?>administrador/comprobantes/store" method="POST">
                            <div class="form-group <?php echo form_error('nombre') == true ? 'has-error':''?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group <?php echo form_error('serie') == true ? 'has-error':''?>">
                                <label for="serie">Serie:</label>
                                <input type="text" class="form-control" id="serie" name="serie">
                                <?php echo form_error("serie","<span class='help-block'>","</span>");?>
                            </div>
                            <div class="form-group">
                                <label for="numero_inicial">Numero Inicial:</label>
                                <input type="number" class="form-control" id="numero_inicial" name="numero_inicial" required="required">
                                <input type="text" class="form-control" id="showNumeroInicial" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="limite">Limite:</label>
                                <input type="number" class="form-control" id="limite" name="limite" required="required">
                            </div>
                            
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="0" name="solicitar_nit" id="solicitar_nit">Solicitar informacion del NIT
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                            </div>
                        </form>
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
