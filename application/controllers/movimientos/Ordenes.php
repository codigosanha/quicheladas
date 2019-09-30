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
		$this->load->model("Cupones_model");
		$this->load->model("Backend_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$configCorreos = 0;
		$configuracion = $this->Backend_model->getConfiguracion();
		$correos = $this->Correos_model->getCorreos();
		if ($configuracion != false && count($correos) > 0) {
			if ($configuracion->correo_remitente != '') {
				$configCorreos = 1;
			}
		}
		$firstArea = $this->Areas_model->getFirstArea();
		$data  = array(
			'permisos' => $this->permisos,
			'ordenes' => $this->Ordenes_model->getOrdenes(), 
			'areas' => $this->Areas_model->getAreas(),
			'mesasArea' => $this->Areas_model->getMesas($firstArea),
			'firstArea' => $firstArea,
			'caja_abierta' => $this->Caja_model->getCajaAbierta(),
			'configCorreos' => $configCorreos
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes/list",$data);
		$this->load->view("layouts/footer");

	}

	public function getExtras($idproducto){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}else{
			$resultados = $this->Productos_model->getExtras($idproducto);
			echo json_encode($resultados);
		}
		
	}

	public function getOrdenes(){
		$value = $this->input->post("value");
		$records_per_page = $this->input->post("records_per_page");
		$page_current = $this->input->post("page_current");

		$page = ($page_current - 1) * $records_per_page;

		$totalOrdenes  = $this->Ordenes_model->getOrdenesActual($value);
		$ordenes = $this->Ordenes_model->getOrdenesActual($value,$page,$records_per_page);
		$dataOrdenes = array();
		foreach ($ordenes as $orden) {
			
			$mesas = $this->Ordenes_model->getPedidosMesas($orden->id);
			$num_mesas = '';

			if (!empty($mesas)) {
				foreach ($mesas as $mesa) {
					$num_mesas .= $mesa->numero.','; 
				}
			}

			$data['id'] = $orden->id;
			$data['mesas'] = $num_mesas == '' ? '':substr($num_mesas,0,-1);
			$data['preparado'] = $orden->preparado;
			$data['tipo_consumo'] = $orden->tipo_consumo == 1 ? 'Comer en el Restaurant':'LLevar';

			$dataOrdenes[] = $data;
		}
		echo json_encode([
			'totalOrdenes' => count($totalOrdenes),
			'ordenes' => $dataOrdenes
		]);
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
		$tipo_consumo = $this->input->post("tipo_consumo");

		$dataPedido = array(
			"fecha" => date("Y-m-d"),
			"usuario_id" => $this->session->userdata("id"),
			"estado" => 1,
			'tipo_consumo' => $tipo_consumo
		);

		$pedido_id = $this->Ordenes_model->save($dataPedido);

		if ($pedido_id != false) {
			if (!empty($mesas)) {
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
			}
			for ($i=0; $i < count($productos) ; $i++) { 
				$dataPedidoProductos = array(
					"pedido_id" => $pedido_id,
					"producto_id" => $productos[$i],
					"cantidad" => $cantidades[$i],
					"codigo" => $codigos[$i]
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
				$this->saveExtrasProductoOrden($extras,$pedido_id);
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

	protected function saveExtrasProductoOrden($extras,$idOrden){
		for ($i=0; $i < count($extras); $i++) { 
			$extra = $extras[$i];
			$infoExtra = explode("*", $extra);
			$data = array(
				'orden_id' => $idOrden,
				'producto_id' => $infoExtra[1],
				'extra_id' => $infoExtra[0],
				'codigo' => $infoExtra[2]
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
		$mesas = $this->input->post("mesas");
		//$nuevamesa = $this->input->post("nuevamesa");
		$extras = $this->input->post("extras");
		$codigos = $this->input->post("codigos");


		if (!empty($mesas)) {

			$mesasPedidos = $this->Ordenes_model->getPedidosMesas($idPedido);
			
			foreach ($mesasPedidos as $m) {
				$dataMesas = array(
					"estado" => 1
				);
				$this->Ordenes_model->updateMesa($m->id,$dataMesas);
			}

			$this->Ordenes_model->deletePedidoMesas($idPedido);

			for ($i=0; $i < count($mesas); $i++) { 
				$dataMesas = array(
					"estado" => 0
				);
				$this->Ordenes_model->updateMesa($mesas[$i],$dataMesas);

				$dataPedidoMesas = array(
					'pedido_id' => $idPedido,
					'mesa_id' => $mesas[$i] 
				);
				$this->Ordenes_model->savePedidoMesa($dataPedidoMesas);
			}
		}

		$data  = array(
			'updated' => 2, 
		);
		$this->Ordenes_model->setUpdated($idPedido,$data);

		if ($productos) {
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
	                'codigo' => $codigos[$i]
	            );

	            $this->Ordenes_model->savePedidoProductos($dataDetalle);
	            $this->updateProductosAsociados($productos[$i],$cantidades[$i]);

			}
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

	    $configuracion = $this->Backend_model->getConfiguracion();
	   	$this->load->library('email');

		$this->email->from($configuracion->correo_remitente, APP_NAME);
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

	   	$configuracion = $this->Backend_model->getConfiguracion();
	   	$this->load->library('email');

		$this->email->from($configuracion->correo_remitente, APP_NAME);
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

	public function validarCupon(){
		$codigo = $this->input->post("codigo");
		$tipo_cupon = $this->input->post("tipo_cupon");
		$cupon = $this->Cupones_model->getCupon($codigo,$tipo_cupon);
		if ($cupon != false) {
			$data  = array('estado' => 0);
			$this->Cupones_model->updateCupon($cupon->id,$data);
			echo json_encode($cupon);

		}
		else{
			echo "0";
		}
	}
}
