<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apertura_cierre extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Caja_model");
		$this->load->model("Ventas_model");
		$this->load->model("Tarjetas_model");
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

	public function check_pending_orders(){
		echo $this->Caja_model->check_pending_orders();
	}

	public function cerrarCaja(){
		
		$idCaja = $this->input->post("idCaja");
		$observacion = $this->input->post("observaciones");
		$montoEfectivo = $this->input->post("monto_efectivo");
		$fecha = date("Y-m-d H:i:s");
		$data  = array( 
			'fecha_cierre' => $fecha,
			'estado' => 0,
			'observacion' => $observacion,
			'monto_efectivo' => $montoEfectivo
		);

		if ($this->Caja_model->update($idCaja,$data)) {
			$this->session->set_userdata("idCaja",$idCaja);
			$this->session->set_flashdata("cierre",$idCaja);
			redirect(base_url()."caja/apertura_cierre");
		}
		else{

			$this->session->set_flashdata("error","No se pudo cerrar la caja");
			redirect(base_url()."caja/apertura_cierre");
		}
		
		
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

	public function viewCorte($id){
		$data  = array(
			'tarjetas' => $this->Tarjetas_model->getTarjetas(),
			'caja' => $this->Caja_model->getCaja($id),
			"descuentos" => $this->Caja_model->getDescuentos($id),
			"gastos" => $this->Caja_model->getGastos($id),
			"creditos" => $this->Caja_model->getCreditos($id),
		);
		$this->load->view("admin/caja/corte",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Categorias_model->update($id,$data);
		echo "mantenimiento/categorias";
	}


	public function printCaja($idCaja = false){
		if (!$idCaja) {
			$idCaja = $this->session->userdata("idCaja");
		}
		$caja = $this->Caja_model->getCaja($idCaja);
		$cajero_nombre = getUsuario($caja->usuario_id)->nombres;
		$tarjetas = $this->Caja_model->getTarjetas($idCaja);
		$descuentos = $this->Caja_model->getDescuentos($idCaja);
		$gastos = $this->Caja_model->getGastos($idCaja);
		$creditos = $this->Caja_model->getCreditos($idCaja);
		$total_creditos = getMontos("monto_credito",$idCaja);
		$total_descuentos = getTotalDescuentos($idCaja);
		$total_efectivo = getMontos('monto_efectivo',$idCaja);
		$total_ventas = getMontoVentas($idCaja);
		$total_gastos = getGastos($idCaja);
		$numero_ventas = getNumeroVentas($idCaja);


		$ticket = "caja";
		$from = "caja";
		$caja = json_encode($caja);
		$tarjetas = json_encode($tarjetas);
		$gastos = json_encode($gastos);
		$descuentos = json_encode($descuentos);
		$creditos = json_encode($creditos);
		redirect("http://localhost/print_quicheladas/imprimir/?caja=$caja&cajero_nombre=$cajero_nombre&tarjetas=$tarjetas&descuentos=$descuentos&gastos=$gastos&creditos=$creditos&total_creditos=$total_creditos&total_descuentos=$total_descuentos&total_efectivo=$total_efectivo&total_ventas=$total_ventas&total_gastos=$total_gastos&numero_ventas=$numero_ventas&ticket=$ticket&from=$caja");
	}
}
