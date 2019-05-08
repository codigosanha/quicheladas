<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ordenes_model");
		$this->load->model("Ventas_model");
		$this->load->model("Categorias_model");
		$this->load->model("Mesas_model");
		$this->load->model("Areas_model");
		$this->load->model("Clientes_model");
		$this->load->model("Productos_model");
		$this->load->model("Permisos_model");
		$this->load->model("Correos_model");
		$this->load->model("Caja_model");
		$this->load->model("Tarjetas_model");
		$this->load->model("Insumos_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$firstArea = $this->Areas_model->getFirstArea();
		$data  = array(
			'permisos' => $this->permisos,
			'ordenes' => $this->Ordenes_model->getOrdenes(), 
			'areas' => $this->Areas_model->getAreas(),
			'mesasArea' => $this->Areas_model->getMesas($firstArea),
			'firstArea' => $firstArea,
			'caja_abierta' => $this->Caja_model->getCajaAbierta(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/list",$data);
		$this->load->view("layouts/footer");

	}

	public function getOrdenes(){

		$ordenes = $this->Ordenes_model->getOrdenes();

        $data = array();
        if(!empty($ordenes))
        {
            foreach ($ordenes as $orden)
            {

                $nestedData['id'] = $orden->id;

                $mesas = "";
                foreach ($orden->mesas as $mesa){
                    $mesas .= $mesa->numero.","; 
                } 
     
                $nestedData['mesas'] = substr($mesas, 0, -1);
                
                $nestedData['preparado'] = $orden->preparado;
                
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
	}

	public function add(){
		$data  = array(
			'categorias' => $this->Categorias_model->getCategorias(), 
			'mesas' => $this->Mesas_model->getMesas(1), 

		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){
		$codigo = uniqid();
		$mesas = $this->input->post("mesas");
		$productos = $this->input->post("productos");
		$codigos = $this->input->post("codigos");
		$cantidades = $this->input->post("cantidades");
		$extras = $this->input->post("extras");

		$dataPedido = array(
			"fecha" => date("Y-m-d"),
			"usuario_id" => $this->session->userdata("id"),
			"estado" => 1
		);

		$pedido_id = $this->Ordenes_model->save($dataPedido);

		if ($pedido_id != false) {
			for($i = 0; $i < count($mesas);$i++){
				$dataMesas = array(
					"estado" => 0
				);
				$dataPedidoMesas = array(
					"pedido_id" => $pedido_id,
					"mesa_id" => $mesas[$i],
				);
				$this->Ordenes_model->updateMesa($mesas[$i],$dataMesas);
				$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			}

			for ($i=0; $i < count($productos) ; $i++) { 
				$dataPedidoProductos = array(
					"pedido_id" => $pedido_id,
					"producto_id" => $productos[$i],
					"cantidad" => $cantidades[$i],
					"codigo" => $codigo
				);

				$this->Ordenes_model->savePedidoProductos($dataPedidoProductos);
				$this->updateInsumo($productos[$i],$cantidades[$i]);

				$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->condicion == "1") {
					$this->updateProducto($productos[$i],$cantidades[$i]);
					$productoActual = $this->Productos_model->getProducto($productos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $productos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
				}
				$this->updateProductosAsociados($productos[$i],$cantidades[$i]);
			}

			$this->reset_stock_negative();
			if (!empty($extras)) {
				$this->saveExtrasProductoOrden($extras,$pedido_id,$codigo);
			}
			

			$dataP  = array(
				'pedido' => $pedido_id,
				'mesas' => $this->Ordenes_model->getPedidosMesas($pedido_id),

				'subcatproductos' => $this->Ordenes_model->subcategorias($pedido_id,1) 
			);
			$this->load->view("admin/ordenes/view3",$dataP);
		}else{
			redirect(base_url()."movimientos/ordenes/add");
		}
		
	}

	protected function updateInsumo($producto_id, $cantidad){
		$insumosFromProducto = $this->Insumos_model->getInsumosByProducto($producto_id);
		if (!empty($insumosFromProducto)) {
			foreach ($insumosFromProducto as $ifp) {
				$insumo = $this->Insumos_model->getInsumo($ifp->insumo_id);
				$data  = array(
					'cantidad' => $insumo->cantidad - ($ifp->cantidad * $cantidad), 
				);

				$this->Insumos_model->update($insumo->id,$data);
			}
		}
	}

	protected function saveExtrasProductoOrden($extras,$idOrden,$codigo){
		for ($i=0; $i < count($extras); $i++) { 
			$extra = $extras[$i];
			$infoExtra = explode("*", $extra);
			$data = array(
				'orden_id' => $idOrden,
				'producto_id' => $infoExtra[1],
				'extra_id' => $infoExtra[0],
				'codigo' => $codigo
			);
			$this->Ordenes_model->saveExtrasProductoOrden($data);
		}
	}

	public function reset_stock_negative(){
		$data = array(
			"stock" => 0
		);
		$products = $this->Productos_model->setear_stock_negative($data);
	}

	protected function updateProducto($idproducto,$cantidad){
		$productoActual = $this->Productos_model->getProducto($idproducto);
		$data = array(
			'stock' => $productoActual->stock - $cantidad, 
		);
		$this->Productos_model->update($idproducto,$data);
	}

	protected function updateProductosAsociados($idproducto,$cantidad){
		$productosA = $this->Productos_model->getProductosA($idproducto);
		if (!empty($productosA)) {
			foreach ($productosA as $productoA) {
				$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

				if ($productoActual->condicion != 0) {
					$this->updateProducto($productoA->producto_asociado,($productoA->cantidad * $cantidad));
				}
				
			}
		}
	}

	public function edit($id){
		$data  = array(
			'orden' => $this->Ordenes_model->getPedido($id), 
			'categorias' => $this->Categorias_model->getCategorias(), 
			'mesas' => $this->Mesas_model->getMesas(1), 
			'productos' => $this->Ordenes_model->getPedidosProductos($id),
			'pedidomesas' => $this->Ordenes_model->getPedidosMesas($id)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$codigo = uniqid();
		$idPedido = $this->input->post("idPedido");
		$cantidades = $this->input->post("cantidades");
		$productos = $this->input->post("productos");
		$mesa = $this->input->post("mesa");
		$nuevamesa = $this->input->post("nuevamesa");
		$extras = $this->input->post("extras");

		if (!empty($mesa)) {
			$dataPedidoMesas = array(
				'pedido_id' => $idPedido,
				'mesa_id' => $mesa 
			);
			$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			$dataMesas = array(
				"estado" => 0
			);
			$this->Ordenes_model->updateMesa($mesa,$dataMesas);
		}

		if (!empty($nuevamesa)) {
			$mesas = $this->Ordenes_model->getPedidosMesas($idPedido);
			$this->Ordenes_model->deletePedidoMesas($idPedido);
			foreach ($mesas as $m) {
				$dataMesas = array(
					"estado" => 1
				);
				$this->Ordenes_model->updateMesa($m->id,$dataMesas);
			}

			$dataPedidoMesas = array(
				'pedido_id' => $idPedido,
				'mesa_id' => $nuevamesa 
			);
			$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			$dataMesas = array(
				"estado" => 0
			);
			$this->Ordenes_model->updateMesa($nuevamesa,$dataMesas);

		}
		$data  = array(
			'updated' => 2, 
		);
		$this->Ordenes_model->setUpdated($idPedido,$data);

		for ($i=0; $i < count($productos) ; $i++) { 
			$infoproducto = $this->Productos_model->getProducto($productos[$i]);

            $dataProducto = array(
                'stock' => $infoproducto->stock - $cantidades[$i], 
            );

            if ($infoproducto->condicion == "1") {
            	$this->Productos_model->update($productos[$i],$dataProducto);
            	$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->stock <= $productoActual->stock_minimo) {
					$data = array(
						'estado' => 0,
						'producto_id' => $productos[$i] 
					);
					$this->Ventas_model->saveNotificacion($data);
				}
            }


            $dataDetalle  = array(
                'pedido_id'     => $idPedido, 
                'producto_id'     => $productos[$i],
                'cantidad' => $cantidades[$i],
                'estado' => 0,
                'codigo' => $codigo
            );

            $this->Ordenes_model->savePedidoProductos($dataDetalle);
            $this->updateProductosAsociados($productos[$i],$cantidades[$i]);

		}
		if (!empty($extras)) {
			$this->saveExtrasProductoOrden($extras,$idPedido,$codigo);
		}

		if (!empty($extras)) {
				$this->saveExtrasProductoOrden($extras,$idPedido);
			}

		$dataP  = array(
			'mesas' => $this->Ordenes_model->getPedidosMesas($idPedido),
			'pedido' => $idPedido,
			'subcatproductos' => $this->Ordenes_model->subcategorias($idPedido,1)
		);
		$this->load->view("admin/ordenes/view3",$dataP);
		
	}

	protected function save_detalle($productos,$idventa,$precios,$cantidades,$importes){
		for ($i=0; $i < count($productos); $i++) { 
			$data  = array(
				'producto_id' => $productos[$i], 
				'venta_id' => $idventa,
				'precio' => $precios[$i],
				'cantidad' => $cantidades[$i],
				'importe'=> $importes[$i],
			);

			$this->Ventas_model->save_detalle($data);
			$productoActual = $this->Productos_model->getProducto($productos[$i]);
			if ($productoActual->condicion == "1") {
				$this->updateProducto($productos[$i],$cantidades[$i]);
				$productoActual = $this->Productos_model->getProducto($productos[$i]);
				if ($productoActual->stock <= $productoActual->stock_minimo) {
					$data = array(
						'estado' => 0,
						'producto_id' => $productos[$i] 
					);
					$this->Ventas_model->saveNotificacion($data);
				}
			}

			$this->updateProductosAsociados($productos[$i]);
		}
	}


	public function pay($id){
		$data  = array(
			'orden' => $this->Ordenes_model->getPedido($id),
			'productos' => $this->Ordenes_model->getPedidosProductos($id),
			"clientes" => $this->Clientes_model->getSoloClientes(),
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"comprobantePredeterminado" => $this->Ordenes_model->comprobantePredeterminado(),
			"tarjetas" => $this->Tarjetas_model->getTarjetas(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/pay",$data);
		$this->load->view("layouts/footer");
	}

	/*public function view(){
		$id = $this->input->post("idpedido");
		$data  = array(
			'mesas' => $this->Ordenes_model->getPedidosMesas($id),
			'productos' => $this->Ordenes_model->getPedidosProductos($id), 
		);
		$this->load->view("admin/ordenes/view",$data);
	}*/
	public function view(){
		$id = $this->input->post("idpedido");
		$data  = array(
			'pedido' => $id,
			'mesas' => $this->Ordenes_model->getPedidosMesas($id),
			'subcatproductos' => $this->Ordenes_model->subcategorias($id), 
		);
		$this->load->view("admin/ordenes/view3",$data);
	}

	public function delete($id){
		$observaciones = $this->input->post("observaciones");
		$mesas = $this->Ordenes_model->getPedidosMesas($id);

		foreach ($mesas as $m) {
			$data = array(
				"estado" => 1
			);
			$this->Mesas_model->update($m->id,$data);
		}

		$this->Ordenes_model->deletePedidoMesas($id);

		$detalles = $this->Ordenes_model->getPedidosProductos($id);


        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->producto_id);
            $productosA = $this->Productos_model->getProductosA($detalle->producto_id);
            if (!empty($productosA)) {
				foreach ($productosA as $productoA) {
					$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

					if ($productoActual->condicion != 0) {

						$data = array(
							"stock" => $productoActual->stock + ($detalle->cantidad * $productoA->cantidad)
						);
						$this->Productos_model->update($productoA->producto_asociado,$data);
					}
					
				}
			}

            $dataProducto = array(
                'stock' => $infoproducto->stock + $detalle->cantidad, 
            );

            $this->Productos_model->update($detalle->producto_id,$dataProducto);
        }
        $this->Ordenes_model->deletePedidoProductos($id);
        $this->Ordenes_model->deletePedido($id);

        $resp = $this->sendEmailDeleteOrden($id,$detalles,$observaciones);
        
    
        echo "movimientos/ordenes";
	}

	public function getProductosByCategoria(){
		$idcategoria = $this->input->post("idcategoria");
		$productos = $this->Ordenes_model->getProductosByCategoria($idcategoria);
		echo json_encode($productos);
	}

	public function infoComprobante(){
		$id = $this->input->post("idcomprobante");
		$comprobante = $this->Ventas_model->getComprobante($id);
		echo json_encode($comprobante);
	}

	public function deleteProductoOrden(){
		$idorden = $this->input->post("idorden");
		$idprod = $this->input->post("idprod");
		$cantidad = $this->input->post("cantidad");

		if($this->Ordenes_model->deleteProductoOrden($idorden,$idprod)){
			$infoproductoA = $this->Productos_model->getProducto($idprod);
			if ($infoproductoA->condicion == 1) {
				$dataStock = array(
					"stock" => $infoproductoA->stock + $cantidad
				);

				$this->Productos_model->update($idprod,$dataStock);
			}

			$productosA = $this->Productos_model->getProductosA($idprod);
			if (!empty($productosA)) {
				foreach ($productosA as $productoA) {
					$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

					if ($productoActual->condicion != 0) {

						$data = array(
							"stock" => $productoActual->stock + ($productoA->cantidad * $cantidad)
						);
						$this->Productos_model->update($productoActual->id,$data);
					}
					
				}
			}
			echo "1";
		} else {
			echo "0";
		}
	}

	public function checkClave(){
		$clave = $this->input->post("clave");
		$idorden = $this->input->post("idOrden");
		$idprod = $this->input->post("idProducto");
		$cantidad = $this->input->post("cantEliminar");
		$observaciones = $this->input->post("observaciones");
		$idPedidoProd = $this->input->post("idPedidoProd");

		$resultados = $this->Permisos_model->checkClave($clave);

		if ($resultados) {
			$infoPedidoProd = $this->Ordenes_model->getPedidoProducto($idPedidoProd);
			$infoproducto = $this->Productos_model->getProducto($infoPedidoProd->producto_id);

			if ($infoproducto->condicion == 1) {
				$dataStock = array(
					"stock" => $infoproducto->stock + $cantidad
				);

				$this->Productos_model->update($infoPedidoProd->producto_id,$dataStock);
			}

			$productosA = $this->Productos_model->getProductosA($infoproducto->id);
			if (!empty($productosA)) {
				foreach ($productosA as $productoA) {
					$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

					if ($productoActual->condicion != 0) {

						$data = array(
							"stock" => $productoActual->stock + ($productoA->cantidad * $cantidad)
						);
						$this->Productos_model->update($productoActual->id,$data);
					}
				}
			}

			$cantidadActual = $infoPedidoProd->cantidad - $cantidad;
			$estado = $infoPedidoProd->estado;

			if ($cantidadActual == $infoPedidoProd->pagados) {
				$estado = 1;
			}
			$dataPedidoProducto = array(
				"estado" => $estado,
				"cantidad" => $cantidadActual
			);
			$this->Ordenes_model->updatePedidoProductos($idPedidoProd,$dataPedidoProducto);

			if (empty($this->Ordenes_model->getPedidosProductos($idorden))) {
				$mesas = $this->Ordenes_model->getPedidosMesas($idorden);
				$this->Ordenes_model->deletePedidoMesas($idorden);
				foreach ($mesas as $m) {
					$dataMesas = array(
						"estado" => 1
					);
					$this->Ordenes_model->updateMesa($m->id,$dataMesas);
				}
				$this->Ordenes_model->deletePedido($idorden);
				$respuesta = "2";
			} else{
				$respuesta= "1";
			}

			$resp = $this->sendEmailDeleteProducto($idorden,$idprod,$cantidad,$observaciones);
			
		}else{
			$respuesta = "0";
		}

		echo $respuesta;
	}

	public function getAreas($idArea){
		$mesas = $this->Areas_model->getMesas($idArea);
		echo json_encode($mesas);
	}

	protected function sendEmailDeleteProducto($orden,$producto,$cantidad,$observaciones){

		$this->load->library('pdfgenerator');
		$data = array(
			'orden' => $orden, 
			'cantidad' => $cantidad,
			'idprod' => $producto,
			'observaciones' => $observaciones
		);
	    $html = $this->load->view('admin/correos/pdf_delete_producto', $data, true);
	    $filename = 'report_'.time();
	    $path_to_pdf_file = $this->pdfgenerator->generate($html, $filename, false, 'A4', 'portrait');

	    $correos = $this->Correos_model->getCorreos();
	    $sendCorreos   = array();
	    foreach ($correos as $c) {
	    	$sendCorreos[] = $c->correo; 
	    }

	   $this->load->library('email');

		$this->email->from('contacto@codigosanha.com', 'Codigosanha');
		$this->email->to($sendCorreos); 

		$this->email->subject('Eliminacion de Productos');
		$this->email->message('Mediante el PDF adjuntado se notifica la eliminacion de un producto en una orden.');   

		$this->email->attach($path_to_pdf_file,'application/pdf', "Eliminacion de Producto " . date("m-d H-i-s") . ".pdf", false);

		//$this->email->send();
		return $this->email->send();
	}

	protected function sendEmailDeleteOrden($orden,$detalles,$observaciones){

		$this->load->library('pdfgenerator');
		$data = array(
			'orden' => $orden, 
			'detalles' => $detalles,
			'observaciones' => $observaciones
		);
	    $html = $this->load->view('admin/correos/pdf_delete_orden', $data, true);
	    $filename = 'report_'.time();
	    $path_to_pdf_file = $this->pdfgenerator->generate($html, $filename, false, 'A4', 'portrait');

	    $correos = $this->Correos_model->getCorreos();
	    $sendCorreos   = array();
	    foreach ($correos as $c) {
	    	$sendCorreos[] = $c->correo; 
	    }

	   $this->load->library('email');

		$this->email->from('contacto@codigosanha.com', 'Codigosanha');
		$this->email->to($sendCorreos); 

		$this->email->subject('Eliminacion de Orden');
		$this->email->message('Mediante el PDF adjuntado se notifica la eliminacion de una orden.');   

		$this->email->attach($path_to_pdf_file,'application/pdf', "Eliminacion de Orden " . date("m-d H-i-s") . ".pdf", false);

		//$this->email->send();
		return $this->email->send();
	}

	public function venta_directa(){

		$data  = array(
			'categorias' => $this->Categorias_model->getCategorias(), 
			"clientes" => $this->Clientes_model->getSoloClientes(),
			"comprobantePredeterminado" => $this->Ordenes_model->comprobantePredeterminado(),
			"tarjetas" => $this->Tarjetas_model->getTarjetas(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/venta_directa",$data);
		$this->load->view("layouts/footer");
	
	}
}
