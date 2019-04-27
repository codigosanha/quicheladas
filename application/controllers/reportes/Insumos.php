<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumos extends CI_Controller {
private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Insumos_model");
		$this->load->helper("functions");
	}

	public function index(){
		$date = date("Y-m-d");
		if ($this->input->post("buscar")) {
			$date = $this->input->post("date");
		}

		$data = array(
			"insumos" => $this->Insumos_model->getInsumosByDate($date),
			"date" => $date,

		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/insumos",$data);
		$this->load->view("layouts/footer");
	}
}