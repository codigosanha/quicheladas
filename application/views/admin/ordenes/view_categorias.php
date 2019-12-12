<ul class="nav nav-tabs">

    <?php foreach ($categorias as $key => $categoria): ?>
        <li class="<?php echo $key == 0 ? 'active':''; ?>"><a data-toggle="tab" href="#cat-<?php echo $categoria->categoria_id: ?>">$categoria->nombre</a></li>
    <?php endforeach ?>
</ul>

<div class="tab-content">
    <?php foreach ($categorias as $key => $categoria): ?>
        <div id="home" class="tab-pane fade <?php echo $key == 0 ? 'in active':'' ?>">
          <h3>Productos</h3>
          <input type="text">
          <div class="row">
              <div class="col-md-6">
                <?php foreach ($categoria->productos as $producto): ?>
                    <button type="button" class="btn btn-primary"><?php echo $producto->nombre ?></button>
                <?php endforeach ?>
                  
              </div>
          </div>
        </div>
        <li class="<?php echo $key == 0 ? 'active':''; ?>"><a data-toggle="tab" href="#cat-<?php echo $categoria->categoria_id: ?>">$categoria->nombre</a></li>
    <?php endforeach ?>
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
</div>