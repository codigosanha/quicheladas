<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditos extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Cuentas_cobrar_model");
		$this->load->model("Ventas_model");
		$this->load->helper("functions");
	}

	public function index()
	{

		$data  = array(
			'permisos' => $this->permisos,
			'cuentas' => $this->Cuentas_cobrar_model->getCuentas()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cuentas_cobrar/creditos",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/add");
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
			'cuenta_cobrar_id' => $idCuenta,
			'fecha' => date("Y-m-d H:i:s"),
		);

		if ($this->Cuentas_cobrar_model->savePago($data)) {

			if ($estado == 1) {
				$data = array(
					'estado' => 1, 
				);

				$this->Cuentas_cobrar_model->updateCuenta($idCuenta,$data);
			}
			redirect(base_url()."cuentas_cobrar/creditos");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."cuentas_cobrar/creditos");
		}
	
		
	}

	public function pagosByCuenta($idCuenta){
		$pagos = $this->Cuentas_cobrar_model->getPagosByCuenta($idCuenta);
		echo json_encode($pagos);
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
