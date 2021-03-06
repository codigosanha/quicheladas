
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
        <small>Editar</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <form action="<?php echo base_url();?>mantenimiento/productos/update" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if($this->session->flashdata("error")):?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>
                                    
                                 </div>
                            <?php endif;?>
                            
                                <input type="hidden" name="idproducto" value="<?php echo $producto->id;?>">
                                <div class="form-group">
                                    <label for="categoria">Categoria:</label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        <?php foreach($categorias as $categoria):?>
                                            <?php if($categoria->id == $producto->categoria_id):?>
                                            <option value="<?php echo $categoria->id?>" selected><?php echo $categoria->nombre;?></option>
                                        <?php else:?>
                                            <option value="<?php echo $categoria->id?>"><?php echo $categoria->nombre;?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subcategoria">Subcategoria:</label>
                                    <select name="subcategoria" id="subcategoria" class="form-control">
                                        <?php foreach($subcategorias as $sc):?>
                                            <?php if($sc->id === $producto->subcategoria):?>
                                            <option value="<?php echo $sc->id?>" selected><?php echo $sc->nombre;?></option>
                                        <?php else:?>
                                            <option value="<?php echo $sc->id?>"><?php echo $sc->nombre;?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group <?php echo !empty(form_error('codigo')) ? 'has-error':'';?>">
                                    <label for="codigo">Codigo:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo !empty(form_error('codigo')) ? set_value('codigo'):$producto->codigo?>">
                                    <?php echo form_error("codigo","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="form-group <?php echo !empty(form_error('nombre')) ? 'has-error':'';?>">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo !empty(form_error('nombre')) ? set_value('nombre'):$producto->nombre?>">
                                    <?php echo form_error("nombre","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto->descripcion?>">
                                </div>
                                <div class="form-group">
                                    <label for="precio_compra">Precio Compra:</label>
                                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php echo $producto->precio_compra?>">
                                </div>
                                <div class="form-group <?php echo !empty(form_error('precio')) ? 'has-error':'';?>">
                                    <label for="precio">Precio Venta:</label>
                                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo !empty(form_error('precio')) ? set_value('precio'):$producto->precio?>">
                                    <?php echo form_error("precio","<span class='help-block'>","</span>");?>
                                </div>
                                <div class="form-group">
                                    <label class="radio-inline">
                                      <input type="radio" name="condicion" value="1" <?php echo $producto->condicion== "1"? "checked":"";?>>Considerar Stock
                                    </label>
                                    <label class="radio-inline">
                                      <input type="radio" name="condicion" value="0" <?php echo $producto->condicion== "0"? "checked":"";?>>No Considerar Stock
                                    </label>
                                </div>
                                <?php
                                    if ($producto->condicion == "0") {
                                        $stockminimo = "";
                                        $stock = "";
                                        $status = "disabled";
                                    }else{
                                        $stockminimo = $producto->stock_minimo;
                                        $stock = $producto->stock;
                                        $status = "";
                                    }
                                 ?>
                                <div class="form-group ">
                                    <label for="stockminimo">Stock Minimo:</label>
                                    <input type="text" class="form-control" id="stockminimo" name="stockminimo" value="<?php echo $stockminimo;?>" <?php echo $status;?>>
                                </div>

                                <div class="form-group ">
                                    <label for="cantidad_descuento">Cantidad para Aplicar Descuento:</label>
                                    <input type="text" class="form-control" id="cantidad_descuento" name="cantidad_descuento" value="<?php echo $producto->cantidad_descuento;?>">
                                </div>
                                <div class="form-group ">
                                    <label for="monto_descuento">Monto de Descuento:</label>
                                    <input type="text" class="form-control" id="monto_descuento" name="monto_descuento" value="<?php echo $producto->monto_descuento;?>">
                                </div>

                                <div class="form-group">
                                    <label for="imagen">Imagen:</label>
                                    <input type="file" name="imagen" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                    <a href="<?php echo base_url().$this->uri->segment(1).'/'.$this->uri->segment(2); ?>" class="btn btn-danger btn-flat">Volver</a>
                                </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Productos a Asociar</label>
                                <input type="text" id="productosA" class="form-control">
                            </div>
                            <table class="table table-bordered" id="tbAsociados">
                                <caption class="text-center"><strong>Productos Asociados</strong></caption>
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th style="width:20%;">Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($productosAsociados)) {
                                        foreach ($productosAsociados as $productoA) { ?>
                                            <tr>
                                                <td><input type="hidden" name="idproductosA[]" value="<?php echo $productoA->producto_asociado;?>"><?php echo $productoA->codigo;?></td>
                                                <td><?php echo $productoA->nombre;?></td>
                                                <td><input type="number" name="cantidadA[]" class="form-control" min="1" value="<?php echo $productoA->cantidad;?>"></td>
                                                <td><button type="button" class="btn btn-danger btn-quitarAsociado"><i class="fa fa-times"></i></button></td>
                                            </tr>
                                    <?php  }
                                    }?>
                                    
                                </tbody>
                            </table>
                            <hr>
                            <div class="form-group">
                                <label for="">Categorias</label>
                                <div class="input-group">
                                    <select name="categoria_asociada" id="categoria_asociada" class="form-control">
                                        <option value="">Seleccione</option>
                                        <?php foreach($categorias as $categoria):?>
                                            <option value="<?php echo $categoria->id."*".$categoria->nombre; ?>
                                            "><?php echo $categoria->nombre;?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="button" id="btn-add-categoria">Agregar</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                            <div class="form-group" style="border: 1px solid #f5f5f5;background-color: #f5f5f5; padding: 10px 20px;">
                                <h3 class="text-center">Categorias Asociadas</h3>
                                <table class="table table-bordered" id="categorias_asociadas">
                                    <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th style="width: 100px;">Cantidad</th>
                                            <th style="width: 10px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($categorias_asociadas)): ?>
                                            <?php foreach ($categorias_asociadas as $ca): ?>
                                                <tr>
                                                <td><input type='hidden' name='categorias[]' value='<?php echo $ca->categoria_id ?>'><?php echo $ca->nombre ?></td>
                                                <td><input type='number' class='form-control input-sm' name='cant_categorias[]' value="<?php echo $ca->cantidad ?>"></td>
                                                <td><button type='button' class='btn btn-danger btn-xs btn-remove-categoria'><span class='fa fa-times'></span></button></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
