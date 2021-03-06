<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
	private $permisos;
	public $products;
	public function __construct(){
		parent::__construct();

		$this->permisos = $this->backend_lib->control();
		$this->load->model("Ventas_model");
		$this->load->model("Clientes_model");
		$this->load->model("Productos_model");
		$this->load->model("Ordenes_model");
		$this->load->model("Caja_model");
		$this->load->model("Cuentas_cobrar_model");
		$this->load->model("Cupones_model");
		$this->load->library('phpqrcode/qrlib');
		if (empty($this->products)) {
			$this->products = $this->Ventas_model->getProducts();
		}
		$this->load->helper("functions");
		
	}

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
			'ventas' => $this->Ventas_model->getVentas(date("Y-m-d")), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ventas/list",$data);
		$this->load->view("layouts/footer");
	}

	public function add(){

		$data = array(
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"tipoclientes" => $this->Clientes_model->getTipoClientes(),
			"tipodocumentos" => $this->Clientes_model->getTipoDocumentos(),
			"estado" => "2",
			"productos" => $this->Ventas_model->getProducts(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ventas/add",$data);
		$this->load->view("layouts/footer");
	}

	public function getproductos(){

		$stockProducto = $this->products;

		$valor = $this->input->post("valor");
		$productos = $this->Ventas_model->getproductos($valor);
		$productosAutcomplete = array();
		foreach ($productos as $producto) {
			$productos_asociados = $this->Productos_model->getProductosA($producto["id"]);

			if (!empty($productos_asociados)) {
				$verificacion = 0;
				foreach ($productos_asociados as $productoA) {
					//recuperamos la informacion de los productos Asociados
					$productoAsociadoActual = $this->Productos_model->getProducto($productoA->producto_asociado);
					//comparamos el stock del producto con la cantidad del producto asociado
					if ($stockProducto[$productoA->producto_asociado]['stock'] >= $productoA->cantidad) {
						$verificacion= $verificacion + 1;
					}
				}

				if ($verificacion == count($productos_asociados)) {
					$productosAutcomplete[] = $producto;
				}
			}else{
				if ($this->products[$producto['id']]['stock'] >= 1) {
					$productosAutcomplete[] = $producto;
				}
			}

		}

		echo json_encode($productosAutcomplete);
	}

	//metodo para mostrar productos en la accion de asociar
	public function getproductosA(){
		$valor = $this->input->post("valor");
		$productos = $this->Ventas_model->getproductosA($valor);
		echo json_encode($productos);
	}

	public function store(){

		$caja_abierta = $this->Caja_model->getCajaAbierta();
		$fecha = date("Y-m-d H:i:s");
		$idPedido = $this->input->post("idPedido");
		$subtotal = $this->input->post("subtotal");
		$iva = $this->input->post("iva");
		$descuento = $this->input->post("descuento");
		$total = $this->input->post("total");
		$idcomprobante = $this->input->post("idComprobante");
		$idcliente = $this->input->post("idcliente");
		$idusuario = $this->session->userdata("id");
		$numero = $this->input->post("numero");
		$serie = $this->input->post("serie");
		$estado = 1;
		$estadoPedido = $this->input->post("estadoPedido");
		$tipo_pago = $this->input->post("tipo_pago");

		$idproductos = $this->input->post("productos");
		$precios = $this->input->post("precios");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");
		$descuentos = $this->input->post("descuentos");
		$pedidoproductos = $this->input->post("pedidoproductos");
		$codigos = $this->input->post("codigos");

		switch ($tipo_pago) {
			case '1':
				$monto_efectivo = $total;
				$monto_credito = 0;
				$monto_tarjeta = 0;
				$tarjeta_id = 0;
				break;
			case '2':
				$monto_efectivo = 0;
				$monto_credito = 0;
				$monto_tarjeta = $total;
				$tarjeta_id = $this->input->post("tarjeta");
				break;
			case '3':
				
				$monto_credito = 0;
				$monto_tarjeta = $this->input->post("monto_tarjeta");
				$monto_efectivo = $total - $monto_tarjeta;
				$tarjeta_id = $this->input->post("tarjeta");
				break;

			default:
				if (!empty($this->input->post("monto_efectivo"))) {
					$monto_efectivo = $this->input->post("monto_efectivo");
				}else{
					$monto_efectivo = 0;
				}
				
				$monto_tarjeta = 0;
				$monto_credito = $total - $monto_efectivo;
				$tarjeta_id = 0;
				break;
		}

		$data = array(
			'fecha' => $fecha,
			'subtotal' => $subtotal,
			'igv' => $iva,
			//'iva' => $iva,
			'descuento' => $descuento,
			'total' => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'cliente_id' => $idcliente,
			'usuario_id' => $idusuario,
			'num_documento' => $numero,
			'serie' => $serie,
			'estado' => $estado,
			'caja_id' => $caja_abierta->id,
			'monto_efectivo' => $monto_efectivo,
			'monto_credito' => $monto_credito,
			'monto_tarjeta' => $monto_tarjeta,
			'tipo_pago' => $tipo_pago,
			'tarjeta_id' => $tarjeta_id,
			'pedido_id' => $idPedido,
			'hora' => date("H:i A")
		);

		if ($this->Ventas_model->save($data)) {
			$idventa = $this->Ventas_model->lastID();
			if ($tipo_pago == 4) {
				$dataCuenta  = array(
					'venta_id' => $idventa,
					'fecha' => $fecha,
					'monto' => $monto_credito,
					'estado' => 0 
				);

				$this->Cuentas_cobrar_model->saveCuenta($dataCuenta);
			}
			$this->updateComprobante($idcomprobante);
			$this->updatePedidoProductos($pedidoproductos,$cantidades);
			$this->save_detalle($idproductos,$idventa,$precios,$cantidades,$importes,$descuentos,$codigos);
			$cupon = $this->generarCupon($total,$fecha);
			if ($estadoPedido == 1) {
				$mesas = $this->Ordenes_model->getPedidosMesas($idPedido);
				$dataMesa = array(
					"estado" => 1
				);

				foreach ($mesas as $mesa) {
					$this->Ordenes_model->updateMesa($mesa->id,$dataMesa);
				}

				$dataPedido = array("estado" => 0);
				$this->Ordenes_model->update($idPedido,$dataPedido);
			}
			
			$data = array(
				"venta" => $this->Ventas_model->getVenta($idventa),
				"detalles" =>$this->Ventas_model->getDetalle($idventa),
				"cupon" => $cupon
			);
			$this->load->view("admin/ventas/view2",$data);

			$this->session->set_userdata("venta", $idventa);

		}else{
			//redirect(base_url()."movimientos/ventas/add");
			echo "0";
		}
	}

	public function printVenta($idventa=false){
		if (!$idventa) {
			$idventa = $this->session->userdata("venta");
		}
		$venta = $this->Ventas_model->getVenta($idventa);
	
		$detalles = $this->Ventas_model->getDetalleVenta($idventa,$venta->pedido_id);
		$pedido = getPedido($venta->pedido_id);
		$infoMesasArea = "";
		if ($venta->pedido_id != 0){
				if ($pedido->tipo_consumo == 1){
					$infoMesasArea = getMesasFromPedido($venta->pedido_id);
				}
				
			}

		$ticket = "venta";
		$from = "ventas";
		$venta = json_encode($venta);
		$detalles = json_encode($detalles);
		$pedido = json_encode($pedido);
		$infoMesasArea = json_encode($infoMesasArea);
		redirect("http://localhost/print_quicheladas/imprimir/?venta=$venta&detalles=$detalles&infoMesasArea=$infoMesasArea&pedido=$pedido&&ticket=$ticket&from=$from");

		//header("location:http://localhost/test/print");
	}

	public function printVenta2($idventa=false){

		if (!$idventa) {
			$idventa = $this->session->userdata("venta");
		}
		
		$this->load->library("EscPos.php");
		$connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS-58C");

		try {
			$venta = $this->Ventas_model->getVenta($idventa);
			$detalles = $this->Ventas_model->getDetalleVenta($idventa,$venta->pedido_id);
			
			/*$connector = new Escpos\PrintConnectors\NetworkPrintConnector("192.168.1.43", 9100);*/
			/* Information for the receipt */
			$items = array();
			$extras_items = array();
			foreach($detalles as $detalle){
				
				$htmlExtras = "";
				$totalExtras = 0.00;
				//$extras = getPreciosExtras($venta->pedido_id,$detalle->producto_id,$detalle->codigo);

				if (!empty($detalle->precios_extras)) {
					foreach ($detalle->precios_extras as $e) {
						$nombre = $e->nombre;

						$importe = $e->precio * $detalle->cantidad;
						if ($importe == 0) {
							$importe = "";
						}else{
							$importe = number_format($importe, 2, '.', '');
						}
						
						$htmlExtras .= new item("",$nombre,$importe);
						$totalExtras = $totalExtras + $e->precio;
					}
					$extras_items[] = $htmlExtras;
				}else{
					$extras_items[] = "";
				}
				
				$items[] = new item($detalle->cantidad,$detalle->nombre,number_format($detalle->importe - ($totalExtras * $detalle->cantidad), 2, '.', ''));
				
			
			}
			$logo = "img/quicheladas3.png";
			$img_logo = Escpos\EscposImage::load($logo,false);
			$printer = new Escpos\Printer($connector);
			
			$printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
			
			/* Name of shop */
			$printer -> selectPrintMode();
			$printer -> setEmphasis(true);
			$printer -> text("Quicheladas\n");
			$printer->bitImage($img_logo);
			$printer -> setEmphasis(false);
			$printer -> selectPrintMode();
			$printer -> text("3a. Calle 1-06 Zona 1, 2do. Nivel Farmacia\n");
			$printer -> text("Batres Don Paco Santa Cruz del Quiche\n");
			$printer -> feed();
			$printer -> setEmphasis(true);
			$printer -> text($venta->tipocomprobante."\n");
			$printer -> setEmphasis(false);
			$printer -> text($venta->serie ." - ".$venta->num_documento."\n");
			$printer -> feed();
		
			$printer -> setJustification(Escpos\Printer::JUSTIFY_LEFT);
			$pedido = getPedido($venta->pedido_id);

			if ($venta->pedido_id != 0){
				if ($pedido->tipo_consumo == 1){
					$infoMesasArea = getMesasFromPedido($venta->pedido_id);
					$printer -> setEmphasis(true);
					$printer -> text("Area:");
					$printer -> setEmphasis(false);
					$printer -> text($infoMesasArea['area']."\n");

					$printer -> setEmphasis(true);
					$printer -> text("Mesa(s)");
					$printer -> setEmphasis(false);
					$printer -> text(substr($infoMesasArea['mesas'], 0,-1)."\n");
				}
				
			}
			if ($venta->pedido_id!=0){
				$printer -> setEmphasis(true);
				$printer -> text("El consumo es :");
				$printer -> setEmphasis(false);
				if ($pedido->tipo_consumo == 1) {
					$printer -> text("En el Restaurant\n");
				}else{
					$printer -> text("Para Llevar\n");
				}
			}
			$printer -> setEmphasis(true);
			$printer -> text("Estado:");
			$printer -> setEmphasis(false);
		
			if ($venta->estado == "1") {
				$printer -> text("Pagado\n");
            }else if($venta->estado == "2"){
            	$printer -> text("Pendiente\n");
            }else{
            	$printer -> text("Anulado\n");
            } 

            $printer -> setEmphasis(true);
			$printer -> text("Cliente:");
			$printer -> setEmphasis(false);
			$printer -> text($venta->nombre."\n");
            
			if ($venta->pedido_id!=0){
				if ($pedido->tipo_consumo == 2){
					$printer -> setEmphasis(true);
					$printer -> text("Telefono:");
					$printer -> setEmphasis(false);
					$printer -> text($venta->telefono."\n");

					$printer -> setEmphasis(true);
					$printer -> text("Direccion:");
					$printer -> setEmphasis(false);
					$printer -> text($venta->direccion."\n");
				}
			}
		
			$printer -> setEmphasis(true);
			$printer -> text("Fecha y Hora:");
			$printer -> setEmphasis(false);
			$printer -> text($venta->fecha." ".$venta->hora."\n");

			$printer -> setEmphasis(true);
			$printer -> text("Cajero:");
			$printer -> setEmphasis(false);
			$printer -> text($venta->usuario."\n");
            
			$printer->setEmphasis(true);
			$printer->text($this->addSpaces('CANT.', 5) . $this->addSpaces('DESCRIPCION', 20) . $this->addSpaces('IMPORTE', 7,LEFT) . "\n");
			/* Items */
			$printer -> setEmphasis(false);
			foreach ($items as $key => $item) {
			    $printer -> text($item);
			    $printer -> text($extras_items[$key]);
			}
			$printer -> setEmphasis(true);
			$printer -> text($this->addSpaces('SUBTOTAL',20,LEFT).$this->addSpaces($venta->subtotal,12,LEFT)."\n");
			$printer -> text($this->addSpaces('DESCUENTO',20,LEFT).$this->addSpaces($venta->descuento,12,LEFT)."\n");
			$printer -> text($this->addSpaces('TOTAL',20,LEFT).$this->addSpaces($venta->total,12,LEFT)."\n");
			$printer -> setEmphasis(false);
			$printer -> feed();
			$printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);
			$printer -> text("Gracias por su preferencia\n");
			$printer -> text("Si el servicio fue de tu agrado, agradeceremos una Propina\n");
			$printer -> text("Recuerda visitarnos en:\n");
			$printer -> text("www.quicheladas.com\n");
			$printer -> text("Quicheladas y Ceviches\n");
			
			$printer -> feed();
			$printer -> feed();
			
			/* Cut the receipt and open the cash drawer */
			$printer -> cut();
			$printer -> pulse();
			$printer -> close();
			/* A wrapper to do organise item names & prices into columns */
			$this->session->set_flashdata("success", "Se imprimio la venta ".$venta->serie."-".$venta->num_documento);

			redirect(base_url()."movimientos/ventas");
		} catch (Exception $e) {
			//echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
			$this->session->set_flashdata("error",$e -> getMessage());

			redirect(base_url()."movimientos/ventas");
		}
	}

	protected function addSpaces($text,$length,$dir = RIGHT,$character =' '){
		if ($dir == LEFT) {
			return str_pad($text, $length, $character, STR_PAD_LEFT);
		}else{
			return str_pad($text, $length); 
		}
		
	}

	protected function generarCupon($total,$fecha){
		$configuracion_cupon = $this->Cupones_model->checkConfiguracion($total,$fecha);
		if ($configuracion_cupon != false) {
			$codigo = substr(md5(microtime()),rand(0,26),5);

			$SERVERFILEPATH = FCPATH .'assets/images/qrcode/';
		   
			$folder = $SERVERFILEPATH;
			$file_name1 = $codigo.".png";
			$file_name = $folder.$file_name1;
			QRcode::png($codigo,$file_name,'H',8,1);

			$data  = array(
				'codigo' => $codigo,
				'tipo_cupon' => $configuracion_cupon->tipo_cupon,
				'valor' => $configuracion_cupon->valor,
				'estado' => 1,
				'fecha_limite' => $configuracion_cupon->fecha_final
			);
			return $this->Cupones_model->generarCupon($data);
		}

		return false;

	}

	public function save_venta_directa(){
		$caja_abierta = $this->Caja_model->getCajaAbierta();
		$fecha = date("Y-m-d");
		
		$subtotal = $this->input->post("subtotal");
		$iva = $this->input->post("iva");
		$descuento = $this->input->post("descuento");
		$total = $this->input->post("total");
		$idcomprobante = $this->input->post("idComprobante");
		$idcliente = $this->input->post("idcliente");
		$idusuario = $this->session->userdata("id");
		$numero = $this->input->post("numero");
		$serie = $this->input->post("serie");
		$estado = 1;
		$tipo_pago = $this->input->post("tipo_pago");

		$idproductos = $this->input->post("productos");
		$precios = $this->input->post("precios");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");
		$descuentos = $this->input->post("descuentos");
		$codigos = $this->input->post("codigos");
		$extras = $this->input->post("extras");
		$productosC = $this->input->post("productosC");
		$cantidadesC = $this->input->post("cantidadesC");
		switch ($tipo_pago) {
			case '1':
				$monto_efectivo = $total;
				$monto_credito = 0;
				$monto_tarjeta = 0;
				$tarjeta_id = 0;
				break;
			case '2':
				$monto_efectivo = 0;
				$monto_credito = 0;
				$monto_tarjeta = $total;
				$tarjeta_id = $this->input->post("tarjeta");
				break;
			case '3':
				
				$monto_credito = 0;
				$monto_tarjeta = $this->input->post("monto_tarjeta");
				$monto_efectivo = $total - $monto_tarjeta;
				$tarjeta_id = $this->input->post("tarjeta");
				break;

			default:
				if (!empty($this->input->post("monto_efectivo"))) {
					$monto_efectivo = $this->input->post("monto_efectivo");
				}else{
					$monto_efectivo = 0;
				}
				
				$monto_tarjeta = 0;
				$monto_credito = $total - $monto_efectivo;
				$tarjeta_id = 0;
				break;
		}


		$data = array(
			'fecha' => $fecha,
			'subtotal' => $subtotal,
			'igv' => $iva,
			//'iva' => $iva,
			'descuento' => $descuento,
			'total' => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'cliente_id' => $idcliente,
			'usuario_id' => $idusuario,
			'num_documento' => $numero,
			'serie' => $serie,
			'estado' => $estado,
			'caja_id' => $caja_abierta->id,
			'monto_efectivo' => $monto_efectivo,
			'monto_credito' => $monto_credito,
			'monto_tarjeta' => $monto_tarjeta,
			'tipo_pago' => $tipo_pago,
			'tarjeta_id' => $tarjeta_id,
			'pedido_id' => 0,
			'hora' => date("H:i A")
		);
		//print_r($data);
		if ($this->Ventas_model->save($data)) {
			$idventa = $this->Ventas_model->lastID();
			$this->updateComprobante($idcomprobante);
			$this->save_detalle($idproductos,$idventa,$precios,$cantidades,$importes,$descuentos,$codigos);
			if (!empty($extras)) {
				$this->saveExtrasProductoOrden($extras,0);
			}

			if (!empty($productosC)) {
				$this->saveOfertas($productosC,$cantidadesC,0,$idventa);
			}
	
			
			$data = array(
				"venta" => $this->Ventas_model->getVenta($idventa),
				"detalles" =>$this->Ventas_model->getDetalle($idventa)
			);
			$this->load->view("admin/ventas/view2",$data);
			$this->session->set_userdata("venta", $idventa);

		}else{
			//redirect(base_url()."movimientos/ventas/add");
			echo "0";
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

	protected function saveOfertas($productosC,$cantidadesC,$idOrden,$idVenta){
		for ($i=0; $i < count($productosC); $i++) { 
			$pc = $productosC[$i];
			$infoPc = explode("*", $pc);

			$detalleV = $this->Ventas_model->getCantidadProductoVenta($infoPc[1],$idVenta, $infoPc[2]);
			$data = array(
				'orden_id' => $idOrden,
				'producto_original' => $infoPc[1],
				'producto_complemento' => $infoPc[0],
				'codigo' => $infoPc[2],
				'cantidad' => $cantidadesC[$i]
			);
			$this->Ordenes_model->saveOferta($data);

			$infoproducto= $this->Productos_model->getProducto($infoPc[0]);
			if ($infoproducto->condicion) {
				$dataProducto["stock"] = $infoproducto->stock - ($detalleV->cantidad * $cantidadesC[$i]);
				$this->Productos_model->update($infoproducto->id, $dataProducto);
			}
			
		}
	}

	protected function updatePedidoProductos($pedidoproductos,$cantidades){
		for ($i=0; $i < count($pedidoproductos); $i++) { 
			$infoP = $this->Ordenes_model->getPedidoProducto($pedidoproductos[$i]);

			$pagados = $infoP->pagados + $cantidades[$i];
			$estado = 0;
			if ($infoP->cantidad == $pagados) {
				$estado = 1;
			}

			$data  = array(
				"estado" => $estado,
				"pagados" => $pagados
			);

			$this->Ordenes_model->updatePedidoProductos($pedidoproductos[$i],$data);
		}
	}

	protected function updateComprobante($idcomprobante){
		$comprobanteActual = $this->Ventas_model->getComprobante($idcomprobante);
		$data  = array(
			'cantidad' => $comprobanteActual->cantidad + 1, 
		);
		$this->Ventas_model->updateComprobante($idcomprobante,$data);
	}

	protected function save_detalle($productos,$idventa,$precios,$cantidades,$importes,$descuentos,$codigos){
		for ($i=0; $i < count($productos); $i++) { 
			$data  = array(
				'producto_id' => $productos[$i], 
				'venta_id' => $idventa,
				'precio' => $precios[$i],
				'cantidad' => $cantidades[$i],
				'importe'=> $importes[$i],
				'descuento' => $descuentos[$i],
				'codigo'=> $codigos[$i]
			);

			$this->Ventas_model->save_detalle($data);
		}
	}

	protected function updateProductosAsociados($idproducto){
		$productosA = $this->Productos_model->getProductosA($idproducto);
		if (!empty($productosA)) {
			foreach ($productosA as $productoA) {
				$productoActual = $this->Productos_model->getProducto($productoA->producto_asociado);

				if ($productoActual->condicion != 0) {
					$this->updateProducto($productoA->producto_asociado,$productoA->cantidad);
				}
				
			}
		}
	}

	protected function updateProducto($idproducto,$cantidad){
		$productoActual = $this->Productos_model->getProducto($idproducto);
		$data = array(
			'stock' => $productoActual->stock - $cantidad, 
		);
		$this->Productos_model->update($idproducto,$data);
	}

	public function view(){
		$idventa = $this->input->post("id");
		$data = array(
			"venta" => $this->Ventas_model->getVenta($idventa),
			"detalles" =>$this->Ventas_model->getDetalle($idventa)
		);
		$this->load->view("admin/ventas/view2",$data);
	}

	public function edit($id)
	{
		$data  = array(
			'venta' => $this->Ventas_model->getVenta($id), 
			"detalles" =>$this->Ventas_model->getDetalle($id),
			"tipocomprobantes" => $this->Ventas_model->getComprobantes(),
			"clientes" => $this->Clientes_model->getClientes(),
			"estado" => "2",
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ventas/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function savecliente(){
		$nombre = $this->input->post("nombre");
		//$tipodocumento = $this->input->post("tipodocumento");
		//$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		//$num_documento = $this->input->post("numero");

		$data  = array(
			'nombre' => $nombre, 
		//	'tipo_documento_id' => $tipodocumento,
		//	'tipo_cliente_id' => $tipocliente,
			'direccion' => $direccion,
			'telefono' => $telefono,
		//	'num_documento' => $num_documento,
			'estado' => "1"
		);
		$cliente = $this->Ventas_model->savecliente($data);
		if (!$cliente) {
			echo "0";
		}
		else{
			$data  = array(
				'id' => $cliente, 
				'nombres' => $nombre,
			);
			echo json_encode($data);
		}
		
	}

	public function update(){
		$idventa = $this->input->post("idventa");
		$fecha = $this->input->post("fecha");
		$subtotal = $this->input->post("subtotal");
		$iva = $this->input->post("iva");
		$descuento = $this->input->post("descuento");
		$total = $this->input->post("total");
		$idcomprobante = $this->input->post("idcomprobante");
		$idcliente = $this->input->post("idcliente");
		$idusuario = $this->session->userdata("id");
		$numero = $this->input->post("numero");
		$serie = $this->input->post("serie");
		$estado = $this->input->post("estado");

		$idproductos = $this->input->post("idproductos");
		$precios = $this->input->post("precios");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");

		$data = array(
			'fecha' => $fecha,
			'subtotal' => $subtotal,
			'igv' => $iva,
			'descuento' => $descuento,
			'total' => $total,
			'tipo_comprobante_id' => $idcomprobante,
			'cliente_id' => $idcliente,
			'usuario_id' => $idusuario,
			'num_documento' => $numero,
			'serie' => $serie,
			'estado' => $estado
		);

		$detalles = $this->Ventas_model->getDetalle($idventa);
        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->producto_id);


            $productosAsociados = $this->Productos_model->getProductosA($detalle->producto_id);

        	foreach ($productosAsociados as $productoA) {
        		$infoproductoA = $this->Productos_model->getProducto($productoA->producto_asociado);

        		$dataProductoA = array(
                    'stock' => $infoproductoA->stock + $productoA->cantidad, 
                );

                $this->Productos_model->update($productoA->producto_asociado,$dataProductoA);

        	}



            $dataProducto = array(
                'stock' => $infoproducto->stock + $detalle->cantidad, 
            );

            if ($infoproducto->condicion == "1") {
            	$this->Productos_model->update($detalle->producto_id,$dataProducto);

            }

        }
        $this->Ventas_model->deleteDetail($idventa);
        //reponer cantidad de productos asociados
        /*for($i = 0; $i < count($idproductos); $i++){
        	$productosAsociados = $this->Productos_model->getProductosA($idproductos[$i]);

        	foreach ($productosAsociados as $productoA) {
        		$infoproductoA = $this->Productos_model->getProducto($productoA->producto_asociado);

        		$dataProductoA = array(
                    'stock' => $infoproductoA->stock + $productoA->cantidad, 
                );

                $this->Productos_model->update($productoA->producto_asociado,$dataProductoA);

        	}


        }*/


        if ($this->Ventas_model->update($idventa, $data)) {
            //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
            for ($i = 0; $i < count($idproductos);$i++) {
                $infoproducto = $this->Productos_model->getProducto($idproductos[$i]);

                $dataProducto = array(
                    'stock' => $infoproducto->stock - $cantidades[$i], 
                );

                if ($infoproducto->condicion == "1") {
                	$this->Productos_model->update($idproductos[$i],$dataProducto);
                	$productoActual = $this->Productos_model->getProducto($idproductos[$i]);
					if ($productoActual->stock <= $productoActual->stock_minimo) {
						$data = array(
							'estado' => 0,
							'producto_id' => $idproductos[$i] 
						);
						$this->Ventas_model->saveNotificacion($data);
					}
	            }


                $dataDetalle  = array(
                    'venta_id'     => $idventa, 
                    'producto_id'     => $idproductos[$i],
                    'cantidad' => $cantidades[$i],
                    'precio' => $precios[$i],
                    'importe' => $importes[$i],
                );

                $this->Ventas_model->save_detalle($dataDetalle);
                $this->updateProductosAsociados($idproductos[$i]);
            }
            echo "1";
            //redirect(base_url() . "movimientos/ventas");
        } else {
            //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
            //redirect(base_url() . "movimientos/ventas/edit/" . $idarea);
            echo "0";
        }
	}


    public function delete($idventa)
    {
       
        $detalles = $this->Ventas_model->getDetalle($idventa);
        foreach ($detalles as $detalle) {
            $infoproducto = $this->Productos_model->getProducto($detalle->producto_id);

            $dataProducto = array(
                'stock' => $infoproducto->stock + $detalle->cantidad, 
            );

            $this->Productos_model->update($detalle->producto_id,$dataProducto);
        }
        //$this->Ventas_model->deleteDetail($idventa);
        $data  = array(
            'estado' => "0", 
        );
        $this->Ventas_model->update($idventa,$data);
        echo "movimientos/ventas";

    }

    public function pagar(){
    	$idventa = $this->input->post("id");

    	$data  = array(
            'estado' => "1", 
        );
        $this->Ventas_model->update($idventa,$data);
        echo "movimientos/ventas";
    }

    public function comprobarPassword(){
    	$password = $this->input->post("password");

    	if (!$this->Ventas_model->comprobarPassword($password)) {
    		echo "0";
    	}else{
    		echo "1";
    	}
    }

    public function descontarStock(){
    	$idproducto = $this->input->post("idproducto");
    	$stock = $this->input->post("stock");
    	$asociado = $this->input->post("asociado");

    	$this->products[$idproducto]['stock'] = $this->products[$idproducto]['stock'] - $stock;
    	echo json_encode($this->products);



    }

    public function verStock(){
    	
    	echo json_encode($this->products);



    }

}


class item
{
    private $quantity;
    private $name;
    private $amount;
    public function __construct($quantity = '', $name = '', $amount = '')
    {
        $this -> quantity = $quantity;
        $this -> name = $name;
        $this -> amount = $amount;
    }
    
    public function __toString()
    {
        $numberColsQuantity = 3;
        $numberColsName = 22;
        $numberColsAmount = 7;
    
        $quantity = str_pad($this -> quantity, $numberColsQuantity) ;
        $name = str_pad($this -> name, $numberColsName) ;
       
        $amount = str_pad($this -> amount, $numberColsAmount, ' ', STR_PAD_LEFT);
        return "$quantity$name$amount\n";
    }
}