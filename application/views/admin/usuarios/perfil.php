

<?php if ($this->session->flashdata("success")): ?>
    <script>
        swal("Bien Hecho!", "<?php echo $this->session->flashdata("success");?>");
    </script>
<?php endif ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Usuario
        <small>Perfil</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <h3 class="profile-username text-center"><?php echo $usuario->nombres;?></h3>

                    <p class="text-muted text-center"><?php echo $usuario->nombres;?></p>

                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>assets/images/usuarios/<?php echo $usuario->imagen;?>" alt="User profile picture">
                    <hr>
                    <form action="#" method="POST" id="form-change-image" enctype="multipart/form-data">
                        <input type="hidden" name="idUsuario" value="<?php echo $usuario->id;?>">
                        <div class="form-group">
                            <label for="">Cambiar Foto:</label>
                            <input type="file" class="form-control" name="file">
                            <span class="help-block">Seleccione archivo .jpg  y .png</span>
                        </div>
                        <button type="submit" class="btn btn-info btn-flat btn-block">Cambiar Imagen</button>
                    </form>
                    </div>
      
        <div class="col-md-8 col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Información Personal</a></li>
                    <li><a href="#password" data-toggle="tab">Cambiar Contraseña</a></li>
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
                        <form action="<?php echo base_url();?>usuario/perfil/changePassword" method="POST" id="form-change-password-perfil">
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

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
              <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
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
        <h4 class="modal-title">Informacion del Usuario</h4>
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

<div class="modal fade" id="modal-password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cambio de Contraseña</h4>
      </div>
      <form action="#" method="POST" id="form-change-password">
      <div class="modal-body">
        <input type="hidden" name="idusuario">
        <div class="error"></div>
        <div class="form-group">
            <label for="">Nueva Contraseña:</label>
            <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nueva Contraseña" required>
        </div>
        <div class="form-group">
            <label for="">Repetir Nueva Contraseña:</label>
            <input type="password" class="form-control" name="repeatpassword" id="newpassword" placeholder="Repetir Nueva Contraseña" required>
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
