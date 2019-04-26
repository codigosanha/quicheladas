<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumos extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Insumos_model");
		$this->load->model("Unidades_medidas_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'insumos' => $this->Insumos_model->getInsumos(),
			'unidades_medidas' => $this->Unidades_medidas_model->getMedidas()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/insumos/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/insumos/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$unidad_medida_id = $this->input->post("unidad_medida_id");
		$cantidad = $this->input->post("cantidad");

		$data  = array(
			'nombre' => $nombre, 
			'unidad_medida_id' => $unidad_medida_id,
			'cantidad' => $cantidad,
		);

		if ($this->Insumos_model->save($data)) {
			redirect(base_url()."produccion/insumos");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."produccion/insumos");
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
		$idInsumo = $this->input->post("idInsumo");
		$nombre = $this->input->post("nombre");
		$unidad_medida_id = $this->input->post("unidad_medida_id");
		$cantidad = $this->input->post("cantidad");

		$data  = array(
			'nombre' => $nombre, 
			'unidad_medida_id' => $unidad_medida_id,
			'cantidad' => $cantidad,
		);

		if ($this->Insumos_model->update($idInsumo,$data)) {
			redirect(base_url()."produccion/insumos");
		}
		else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion");
			redirect(base_url()."produccion/insumos/edit/".$idInsumo);
		}

		
	}

	public function view($id){
		$data  = array(
			'insumo' => $this->Insumos_model->getInsumo($id), 
		);
		$this->load->view("admin/insumos/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Insumos_model->update($id,$data);
		echo "produccion/insumos";
	}
}
