<div class="row">
                    <?php if (!empty($pedidos)): ?>
                        <?php foreach ($pedidos as $pedido): ?>
                            <?php if (!empty($pedido->productos)): ?>
                                
                            
                            <?php 
                                if ($pedido->preparado == 0) {
                                    $status = "danger";
                                } else if ($pedido->preparado == 1){
                                    $status = "warning";
                                } else{
                                    $status = "success";
                                }

                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-12">
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
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php else: ?>
                        <div class="col-md-12 text-center">
                            <h1>Aun no se han realizado pedidos</h1>
                        </div>
                    <?php endif ?>
                    
                </div>