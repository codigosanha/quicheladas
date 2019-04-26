<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apertura_cierre extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Caja_model");
		$this->load->model("Ventas_model");
		$this->load->helper("functions");
	}

	public function index()
	{

		$data  = array(
			'permisos' => $this->permisos,
			'cajas' => $this->Caja_model->getCajas(), 
			'caja_abierta' => $this->Caja_model->getCajaAbierta(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/caja/aperturas_cierres",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$monto = $this->input->post("monto");
		$fecha = date("Y-m-d H:i:s");
		$data  = array(
			'monto_apertura' => $monto, 
			'fecha_apertura' => $fecha,
			'usuario_id' => $this->session->userdata("id"),
			'estado' => 1
		);

		if ($this->Caja_model->save($data)) {
			$this->session->set_flashdata("success","Por el usuario ".getUsuario($this->session->userdata("id"))->username." con fecha y hora : ".$fecha);
			redirect(base_url()."caja/apertura_cierre");
		}
		else{
			$this->session->set_flashdata("error","No se pudo abrir la caja");
			redirect(base_url()."caja/apertura_cierre");
		}	
	}

	public function cerrarCaja(){
		$caja_abierta = $this->Caja_model->getCajaAbierta();
		$observacion = $this->input->post("observacion");
		$fecha = date("Y-m-d H:i:s");
		$data  = array( 
			'fecha_cierre' => $fecha,
			'estado' => 0,
			'observacion' => $observacion
		);

		if ($this->Caja_model->update($caja_abierta->id,$data)) {
			

			$response  = array(
				'status' => 1, 
				'message' => "Por el usuario ".getUsuario($this->session->userdata("id"))->username." con fecha y hora : ".$fecha
			);
		}
		else{
			$response  = array(
				'status' => 0, 
				'message' => "No se pudo cerrar la caja activa"
			);
		}

		echo json_encode($response);
	}

	public function edit($id){
		$data  = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idapertura = $this->input->post("idapertura");
		$monto = $this->input->post("monto");

		$data = array(
			"monto" => $monto,
		);

		if ($this->Caja_model->update($idapertura,$data)) {
			redirect(base_url()."caja/apertura");
		}
		else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion");
			redirect(base_url()."mantenimiento/categorias/edit/".$idCategoria);
		}

		
	}

	public function view($id){
		$data  = array(
			'categoria' => $this->Categorias_model->getCategoria($id), 
		);
		$this->load->view("admin/categorias/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Categorias_model->update($id,$data);
		echo "mantenimiento/categorias";
	}
}
