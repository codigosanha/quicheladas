<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cupones extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Cupones_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'configuraciones' => $this->Cupones_model->getConfiguraciones(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cupones/configuraciones",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cupones/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$tipo_cupon = $this->input->post("tipo_cupon");
		$valor = $this->input->post("valor");
		$monto_minimo = $this->input->post("monto_minimo");
		$monto_maximo = $this->input->post("monto_maximo");
		$fecha_inicio = $this->input->post("fecha_inicio");
		$fecha_final = $this->input->post("fecha_final");

		$data  = array(
			'tipo_cupon' => $tipo_cupon,
			'valor' => $valor,
			'monto_maximo' => $monto_maximo,
			'monto_minimo' => $monto_minimo,
			'fecha_final' => $fecha_final,
			'fecha_inicio' => $fecha_inicio,
		);

		if ($this->Cupones_model->saveConfiguracion($data)) {
			redirect(base_url()."administrador/cupones");
		}else{
			redirect(base_url()."administrador/cupones/add");
		}
	
	}

	public function edit($id){
		$data = array(
			'configuracion' => $this->Cupones_model->getConfiguracion($id)
		);

	
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cupones/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idConfiguracion = $this->input->post("idConfiguracion");
		$tipo_cupon = $this->input->post("tipo_cupon");
		$valor = $this->input->post("valor");
		$monto_minimo = $this->input->post("monto_minimo");
		$monto_maximo = $this->input->post("monto_maximo");
		$fecha_inicio = $this->input->post("fecha_inicio");
		$fecha_final = $this->input->post("fecha_final");

		$data  = array(
			'tipo_cupon' => $tipo_cupon,
			'valor' => $valor,
			'monto_maximo' => $monto_maximo,
			'monto_minimo' => $monto_minimo,
			'fecha_final' => $fecha_final,
			'fecha_inicio' => $fecha_inicio,
		);

		if ($this->Cupones_model->updateConfiguracion($idConfiguracion,$data)) {
			redirect(base_url()."administrador/cupones");
		}else{
			redirect(base_url()."administrador/cupones/edit/".$idConfiguracion);
		}
	
	}

	public function delete($id){
		
		$this->Cupones_model->delete($id);
		redirect(base_url()."administrador/cupones");
	}

	public function pdf()
	{
	    $this->load->library('pdfgenerator');

	    $html = $this->load->view('admin/correos/pdf', '', true);
	    $filename = 'report_'.time();
	    $path_to_pdf_file = $this->pdfgenerator->generate($html, $filename, false, 'A4', 'portrait');

	   $this->load->library('email');

		$this->email->from('contacto@codigosanha.com', 'Codigosanha');
		$this->email->to(['yonybrondy17@gmail.com','yony_brondy@hotmail.com']); 

		$this->email->subject('Eliminacion de Productos');
		$this->email->message('Mediante el PDF adjuntado se notifica la eliminacion de un producto en una orden.');   

		$this->email->attach($path_to_pdf_file,'application/pdf', "Eliminacion de Producto " . date("m-d H-i-s") . ".pdf", false);

		//$this->email->send();
		$r = $this->email->send();
	    if (!$r) {
	        redirect(base_url()."dashboard");
	    } else {
	        
	        redirect(base_url()."administrador/correos");
	    }

		
	}
}
