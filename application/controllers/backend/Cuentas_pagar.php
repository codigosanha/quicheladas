<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Cuentas_pagar extends CI_Controller {

	//private $permisos;
	public function __construct(){
		parent::__construct();
		//$this->permisos = $this->backend_lib->control();
		$this->load->model("Cuentas_pagar_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$data  = array(
			//"permisos" => $this->permisos,
			"cuentas_pagar" => $this->Cuentas_pagar_model->getCuentas(), 
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cuentas_pagar/list",$data);
		$this->load->view("layouts/footer");

	}

		public function abonar(){

		$idCuenta = $this->input->post("idCuenta");
		$monto = $this->input->post("monto");
		$monto_abonado = $this->input->post("monto_abonado");
		$saldo_pendiente = $this->input->post("saldo_pendiente");
		$monto_abonar = $this->input->post("monto_abonar");

		$abono = $monto_abonado + $monto_abonar;
		$estado =0;
		if ($monto == $abono) {
			$estado = 1;
		}

		$data  = array(
			'monto' => $monto_abonar, 
			'cuenta_pagar_id' => $idCuenta,
			'fecha' => date("Y-m-d H:i:s"),
		);

		if ($this->Cuentas_pagar_model->savePago($data)) {

			if ($estado == 1) {
				$data = array(
					'estado' => 1, 
				);

				$this->Cuentas_pagar_model->updateCuenta($idCuenta,$data);
			}
			redirect(base_url()."backend/cuentas_pagar");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."backend/cuentas_pagar");
		}
	
		
	}

	public function pagosByCuenta($idCuenta){
		$pagos = $this->Cuentas_pagar_model->getPagosByCuenta($idCuenta);
		echo json_encode($pagos);
	}


	public function add(){
		$contenido_externo = array(
			"title" => "cuentas_pagar", 
			"contenido" => $this->load->view("admin/cuentas_pagar/add","", TRUE)
		);
		$this->load->view("admin/template",$contenido_externo);
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[calidades.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				"nombre" => $nombre, 
				"descripcion" => $descripcion,
				"estado" => "1"
			);

			if ($this->Cuentas_pagar_model->insert("cuentas_pagar", $data)) {
				redirect(base_url()."almacen/calidades");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."almacen/calidades/add");
			}
		}
		else{
			$this->add();
		}
	}

	public function edit($id){
		$contenido_interno  = array(
			//"permisos" => $this->permisos,
			"calidad" => $this->Cuentas_pagar_model->get_record("cuentas_pagar","id=$id"), 
		);

		$contenido_externo = array(
			"title" => "cuentas_pagar", 
			"contenido" => $this->load->view("admin/cuentas_pagar/edit", $contenido_interno, TRUE)
		);
		$this->load->view("admin/template",$contenido_externo);
	}

	public function update(){
		$idCalidad = $this->input->post("idCalidad");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");

		$sucursalActual = $this->Cuentas_pagar_model->get_record("cuentas_pagar","id=$idCalidad");

		if ($nombre == $sucursalActual->nombre) {
			$is_unique_nombre = "";
		}else{
			$is_unique_nombre = "|is_unique[calidades.nombre]";
		}

		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique_nombre);

		if ($this->form_validation->run()==TRUE) {
			$data = array(
				"nombre" => $nombre,
				"descripcion" => $descripcion,
			);

			if ($this->Cuentas_pagar_model->update("cuentas_pagar","id=$idCalidad",$data)) {
				redirect(base_url()."almacen/calidades");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."almacen/calidades/edit/".$idCalidad);
			}
		}else{
			$this->edit($idCalidad);
		}

		
	}

	public function view($id){
		$data  = array(
			"calidad" => $this->Cuentas_pagar_model->get_record("cuentas_pagar", "id=$id"), 
		);
		$this->load->view("admin/cuentas_pagar/view",$data);
	}

	public function habilitar($id){
		$data  = array(
			"estado" => "1", 
		);
		$this->Cuentas_pagar_model->update("cuentas_pagar","id=$id",$data);
		echo "almacen/calidades";
	}

	public function deshabilitar($id){
		$data  = array(
			"estado" => "0", 
		);
		$this->Cuentas_pagar_model->update("cuentas_pagar","id=$id",$data);
		echo "almacen/calidades";
	}
}
