<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Productos_model");
		$this->load->model("Compras_model");
		$this->load->model("Proveedores_model");
		$this->load->helper("functions");
	}

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
			'compras' => $this->Compras_model->getCompras(), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/compras/list",$data);
		$this->load->view("layouts/footer");
	}

	public function add(){

		$data = array(
			"tipocomprobantes" => $this->Compras_model->getComprobantes(),
			"proveedores" => $this->Proveedores_model->getProveedores(),
			"productos" => $this->Ventas_model->getProducts(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/compras/add",$data);
		$this->load->view("layouts/footer");
	}

	public function getProductos(){
		$valor = $this->input->post("valor");
		$productos = $this->Compras_model->getProductos($valor);
		echo json_encode($productos);
	}

	public function getProductoByCode(){
		$codigo_barra = $this->input->post("codigo_barra");
		$producto = $this->Compras_model->getProductoByCode($codigo_barra);

		if ($producto != false) {
			echo json_encode($producto);
		}else{
			echo "0";
		}
	}

	public function store(){
		$comprobante = $this->input->post("comprobante");
		$tipo_pago = $this->input->post("tipo_pago");
		$serie = $this->input->post("serie");
		$numero = $this->input->post("numero");
		$fecha_compra = $this->input->post("fecha_compra");
		$idproveedor = $this->input->post("idproveedor");
		$subtotal = $this->input->post("subtotal");
		$total = $this->input->post("total");

		$data = array(
			'serie' => $serie,
			'numero' => $numero,
			'fecha_compra' => $fecha_compra,
			'fecha_registro' => date("Y-m-d H:i:s"),
			'subtotal' => $subtotal,
			'total' => $total,
			'comprobante_id' => $comprobante,
			'proveedor_id' => $idproveedor,
			'tipo_pago' => $tipo_pago,
			'usuario_id' => $this->session->userdata('id'),
			'estado' => 1,
		);

		if ($this->Compras_model->save($data)) {
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			//echo "1";
			redirect(base_url()."movimientos/compras");
		}
		else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
				//echo "1";
			redirect(base_url()."movimientos/compras/add");
		}
	}


	public function view(){
		$idCompra = $this->input->post("id");
		$data = array(
			"compra" => $this->Compras_model->getCompra($idCompra),
			"detalles" =>$this->Compras_model->getDetalle($idCompra)
		);
		$this->load->view("admin/compras/view",$data);
	}
      
    public function getProveedores(){
    	$valor = $this->input->post("valor");
		$proveedores = $this->Compras_model->getProveedores($valor);
		echo json_encode($proveedores);
    }

}