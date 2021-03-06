<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correos extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Correos_model");
		$this->load->model("Backend_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'correos' => $this->Correos_model->getCorreos(),
			'configuracion' => $this->Backend_model->getConfiguracion()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/correos/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/areas/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$correo = $this->input->post("correo");

		$this->form_validation->set_rules("correo","Correo","required|is_unique[correos.correo]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'correo' => $correo,
			);

			if ($this->Correos_model->save($data)) {
				redirect(base_url()."administrador/correos");
			}else{
				redirect(base_url()."administrador/correos");
			}
		}
		else{
			/*redirect(base_url()."administrador/categorias/add");*/
			$this->index();
		}

		
	}

	public function delete($id){
		
		$this->Correos_model->delete($id);
		redirect(base_url()."administrador/correos");
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

	public function saveCorreoRemitente(){
		$idConfiguracion = $this->input->post("idConfiguracion");
		$correo_remitente = $this->input->post("correo_remitente");
		$data  = array(
			'correo_remitente' => $correo_remitente, 
		);
		if (!empty($idConfiguracion)) {
			$resp = $this->Backend_model->updateCorreoRemitente($idConfiguracion, $data);
		}else{
			$resp = $this->Backend_model->saveCorreoRemitente($data);
		}

		if ($resp) {
			$this->session->set_flashdata('success','El correo remitente ha sido establecido con exito');
			redirect(base_url()."administrador/correos");
		}else {
			$this->session->set_flashdata('error','El correo remitente no ha sido establecido');
			redirect(base_url()."administrador/correos");
		}
	}
}
