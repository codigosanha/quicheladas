<section class="content-header">
    <h1>
        Perfil de Usuario
    </h1>
</section>
<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Bien Hecho!", "<?php echo $this->session->flashdata("success");?>");
    </script>
<?php endif ?>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="row">
      
        <div class="col-md-12 col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Información Personal</a></li>
                    <li><a href="#password" data-toggle="tab">Cambiar Contraseña</a></li>
                    <li><a href="#firma" data-toggle="tab">Cambiar Firma</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="settings">
                        <form action="<?php echo base_url();?>usuario/perfil/infousuario" method="POST">
                            <input type="hidden" name="idUsuario" value="<?php echo $usuario->id;?>">
                            
                            <div class="form-group">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $usuario->nombres;?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuario->apellidos;?>" required="required">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario->telefono;?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario->email;?>" required="required">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-flat">Enviar</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="password">
                        <form action="<?php echo base_url();?>usuario/perfil/changePassword" method="POST">
                            <input type="hidden" name="idUsuario" value="<?php echo $usuario->id;?>">
                            <div class="form-group">
                                <label for="newpass">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="newpass" name="newpass">
                            </div>
                            <div class="form-group">
                                <label for="confpass">Confirmar Nueva Contraseña:</label>
                                <input type="password" class="form-control" id="confpass" name="confpass">
                               
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-flat">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="firma">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-center"><b>FIRMA ACTUAL</b></p>
                                <?php if (!empty($usuario->firma)): ?>
                                    <img src="<?php echo base_url();?>assets/images/firmas/<?php echo $usuario->firma;?>" alt="" class="img-responsive">
                                <?php else: ?>
                                    <p class="text-center text-muted">No ha establecido alguna firma</p>
                                <?php endif ?>
                            </div>
                            <div class="col-md-9">
                                <form action="<?php echo base_url();?>administrador/usuarios/changeFirma" method="POST" enctype="multipart/form-data" id="form-change-firma">
                                    <input type="hidden" name="idUsuario" value="<?php echo $usuario->id;?>">
                                    
                                    <div class="form-group">
                                        <label for="">Cambiar Firma:</label>
                                        <input type="file" class="form-control" name="file">
                                        <span class="help-block">Seleccione archivo .jpg  y .png</span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-flat">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
              <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
</section>
<!-- /.content -->