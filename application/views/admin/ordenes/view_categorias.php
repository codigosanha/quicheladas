
<ul class="nav nav-tabs">
    <?php $i=1; ?>
    <?php foreach ($categorias as  $categoria): ?>
        <li class="<?php echo $i == 1 ? 'active':''; ?>"><a data-toggle="tab" href="#categoria<?php echo $categoria->categoria_id ?>"><?php echo $categoria->nombre;  ?></a></li>
        <?php $i++; ?>
    <?php endforeach ?>
</ul>

<div class="tab-content">
    <?php $i=1; ?>
    <?php foreach ($categorias as $c): ?>
        <div id="categoria<?php echo $c->categoria_id ?>" class="tab-pane <?php echo $i == 1 ? 'active':'' ?>">
          <h3>Productos</h3>
          <input type="hidden" id="categoria" value="cat<?php echo  $c->categoria_id ?>">
          <div class="row">
              
            <?php foreach ($c->productos as $producto): ?>
                <div class="col-md-6 form-group">
                    <button type="button" class="btn btn-primary btn-product-category btn-block" value="<?php echo $producto->id ?>"><?php echo $producto->nombre ?></button>
                </div>
            <?php endforeach ?>
                  
              
          </div>
        </div>
        <?php $i++; ?>
    <?php endforeach ?>
    
</div>