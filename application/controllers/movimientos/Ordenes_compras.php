<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_compras extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Productos_model");
		$this->load->model("Ordenes_compras_model");
		$this->load->model("Compras_model");
		$this->load->model("Proveedores_model");
		$this->load->helper("functions");
	}

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
			'ordenes_compras' => $this->Ordenes_compras_model->getOrdenes(), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes_compras/list",$data);
		$this->load->view("layouts/footer");
	}

	public function add(){
		$data = array(
			"proveedores" => $this->Proveedores_model->getProveedores(),
	
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes_compras/add",$data);
		$this->load->view("layouts/footer");
	}

	public function getProductos(){
		$valor = $this->input->post("valor");
		$productos = $this->Ordenes_compras_model->getProductos($valor);
		echo json_encode($productos);
	}

	public function getProductoByCode(){
		$codigo_barra = $this->input->post("codigo_barra");
		$producto = $this->Ordenes_compras_model->getProductoByCode($codigo_barra);

		if ($producto != false) {
			echo json_encode($producto);
		}else{
			echo "0";
		}
	}

	public function store(){
	
		$tipo_pago = $this->input->post("tipo_pago");
		$numero = $this->input->post("numero");
		$fecha = date("Y-m-d");
		$proveedor_id = $this->input->post("proveedor_id");
		$total = $this->input->post("total");
		$idproductos = $this->input->post("idproductos");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");
		$idMedidas = $this->input->post("idMedidas");
		$cantidadesMedida = $this->input->post("cantidadesMedida");
		

		$data = array(
			'fecha' => $fecha,
			'total' => $total,
			'proveedor_id' => $proveedor_id,
			'tipo_pago' => $tipo_pago,
			'usuario_id' => $this->session->userdata('id'),
			'estado' => "Registrada",
			'numero' => $numero
		);

		if ($this->Ordenes_compras_model->save($data)) {
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			//echo "1";
			redirect(base_url()."movimientos/ordenes_compras");
		}
		else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
				//echo "1";
			redirect(base_url()."movimientos/ordenes_compras/add");
		}
	}


	public function view($idOrden){
		$data = array(
			"orden" => $this->Ordenes_compras_model->getOrden($idOrden),
			"detalles" =>$this->Ordenes_compras_model->getDetalle($idOrden)
		);
		$this->load->view("admin/ordenes_compras/view",$data);
	}
      
    public function getProveedores(){
    	$valor = $this->input->post("valor");
		$proveedores = $this->Ordenes_compras_model->getProveedores($valor);
		echo json_encode($proveedores);
    }

    public function edit($idOrden){
		$data = array(
			"proveedores" => $this->Proveedores_model->getProveedores(),
			"orden" => $this->Ordenes_compras_model->getOrden($idOrden),
			"detalles" =>$this->Ordenes_compras_model->getDetalle($idOrden),
			"tipocomprobantes" => $this->Compras_model->getComprobantes(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/ordenes_compras/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idOrden = $this->input->post("idOrden");
		$numero = $this->input->post("numero");
		$estado = $this->input->post("estado");
		$tipo_pago = $this->input->post("tipo_pago");
		$fecha = date("Y-m-d");
		$proveedor_id = $this->input->post("proveedor_id");
		$total = $this->input->post("total");
		$idproductos = $this->input->post("idproductos");
		$cantidades = $this->input->post("cantidades");
		$importes = $this->input->post("importes");
		$idMedidas = $this->input->post("idMedidas");
		$cantidadesMedida = $this->input->post("cantidadesMedida");
		
		$data = array(
			'fecha' => $fecha,
			'total' => $total,
			'proveedor_id' => $proveedor_id,
			'tipo_pago' => $tipo_pago,
			'usuario_id' => $this->session->userdata('id'),
			"estado" => $estado,
			"numero" => $numero
		);

		if ($this->Ordenes_compras_model->update($idOrden,$data)) {

			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			//echo "1";
			redirect(base_url()."movimientos/ordenes_compras");
		}
		else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
				//echo "1";
			redirect(base_url()."movimientos/ordenes_compras/edit/".$idOrden);
		}
	}

	public function cancelar($idOrden){
		$data = array(
			"estado" => "Cancelada"
		);

		if($this->Ordenes_compras_model->updateEstado($idOrden,$data)){
			echo "1";
		}else{
			echo "0";
		}

	}

}