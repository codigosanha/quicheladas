<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastos extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Gastos_model");
		$this->load->model("Caja_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'gastos' => $this->Gastos_model->getGastos() ,
			'caja_abierta' => $this->Caja_model->getCajaAbierta()
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/gastos/list",$data);
		$this->load->view("layouts/footer");

	}


	public function store(){
		$caja_abierta = $this->Caja_model->getCajaAbierta();
		$monto = $this->input->post("monto");
		$observaciones = $this->input->post("observaciones");
		$nombre = $this->input->post("nombre");
		$data  = array(
			'monto' => $monto, 
			'observaciones' => $observaciones,
			'nombre' => $nombre,
			'fecha' => date("Y-m-d H:i:s"),
			'usuario_id' => $this->session->userdata("id"),
			'caja_id' => $caja_abierta->id,
		);

		if ($this->Gastos_model->save($data)) {
			redirect(base_url()."caja/gastos");
		}else{
			redirect(base_url()."caja/gastos");
		}
		
	}


	public function delete($id){

		if ($this->Gastos_model->delete($id)) {
			//echo "1";
			redirect(base_url()."caja/gastos");
		}else{
			//echo "0";
			redirect(base_url()."caja/gastos");
		}
		
	}
}
