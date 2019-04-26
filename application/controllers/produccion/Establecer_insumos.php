<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establecer_insumos extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Insumos_model");
		$this->load->model("Productos_model");
		$this->load->model("Unidades_medidas_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'productos_insumos' => $this->Insumos_model->getProductosInsumos(),
			'insumos' => $this->Insumos_model->getInsumos(),
			'productos' => $this->Productos_model->getProductos()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/insumos/productos_insumos",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/insumos/add");
		$this->load->view("layouts/footer");
	}

	public function store(){



		$producto_id = $this->input->post("producto_id");
		$insumos = $this->input->post("insumos");
		$cantidades = $this->input->post("cantidades");

		for ($i=0; $i < count($insumos); $i++) { 
			$data[]  = array(
				'producto_id' => $producto_id,
				'insumo_id' => $insumos[$i],
				'cantidad' => $cantidades[$i] 
			);
		}

		if ($this->Insumos_model->saveProductoInsumos($data)) {
			redirect(base_url()."produccion/establecer_insumos");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."produccion/establecer_insumos");
		}
	
		
	}

	public function edit($id){
		$data  = array(
			'insumo' => $this->Insumos_model->getInsumo($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/insumos/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		
		$producto_id = $this->input->post("idProducto");
		$insumos = $this->input->post("insumos");
		$cantidades = $this->input->post("cantidades");

		if ($this->Insumos_model->deleteInsumosFormProducto($producto_id)) {
			for ($i=0; $i < count($insumos); $i++) { 
				$data[]  = array(
					'producto_id' => $producto_id,
					'insumo_id' => $insumos[$i],
					'cantidad' => $cantidades[$i] 
				);
			}

			if ($this->Insumos_model->saveProductoInsumos($data)) {
				redirect(base_url()."produccion/establecer_insumos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."produccion/establecer_insumos");
			}
		}
	}

	public function view($id){
		$data  = array(
			'insumo' => $this->Insumos_model->getInsumo($id), 
		);
		$this->load->view("admin/insumos/view",$data);
	}

	public function delete($id){
		
		$this->Insumos_model->deleteInsumosFormProducto($id);
		redirect(base_url()."produccion/establecer_insumos");
	}

	public function getInsumosByProducto(){
		$idProducto = $this->input->post("idProducto");
		$insumos = $this->Insumos_model->getInsumosByProducto($idProducto);
		echo json_encode($insumos);
	}
}
