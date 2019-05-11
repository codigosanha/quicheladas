
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Configuracion de Cupones
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
                        <form action="<?php echo base_url();?>administrador/cupones/store" method="POST">
                            <div class="form-group">
                                <label for="tipo_cupon">Tipo de Cupon</label>
                                <select name="tipo_cupon" id="tipo_cupon" class="form-control" required="required">
                                    <option value="">Seleccione</option>
                                    <option value="1">Cupon de Descuento</option>
                                    <option value="2">Cupon de Almuerzo Gratis</option>
                                    <option value="3">Cupon de Premio</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="text" name="valor" id="valor" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="monto_minimo">Rango de Monto Minimo</label>
                                <input type="text" name="monto_minimo" id="monto_minimo" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="monto_maximo">Rango de Monto Maximo</label>
                                <input type="text" name="monto_maximo" id="monto_maximo" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="fecha_final">Fecha Final</label>
                                <input type="date" name="fecha_final" id="fecha_final" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
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
