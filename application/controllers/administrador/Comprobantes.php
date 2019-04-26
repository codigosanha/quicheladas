<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Comprobantes extends CI_Controller {

	private $permisos;

	public function __construct(){

		parent::__construct();

		$this->permisos = $this->backend_lib->control();

		$this->load->model("Permisos_model");

		$this->load->model("Usuarios_model");

		$this->load->model("Comprobantes_model");

	}



	public function index(){

		$data  = array(

			'permisos' => $this->permisos,

			'comprobantes' => $this->Comprobantes_model->getComprobantes()

		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");

		$this->load->view("admin/comprobantes/list",$data);

		$this->load->view("layouts/footer");

	}



	public function add(){

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");

		$this->load->view("admin/comprobantes/add");

		$this->load->view("layouts/footer");

	}



	public function store(){

		$nombre = $this->input->post("nombre");

		$serie = $this->input->post("serie");

		$numero_inicial = $this->input->post("numero_inicial");

		$limite = $this->input->post("limite");

		$cantidad = 0;


		$solicitar_nit = $this->input->post("solicitar_nit");



		$data = array(

			"nombre" => $nombre,

			"serie" => strtoupper($serie),

			"numero_inicial" => $numero_inicial,

			"limite" => $limite,

			"cantidad" => $cantidad,

			"solicitar_nit" => $solicitar_nit,

		);



		if ($this->Comprobantes_model->save($data)) {

			redirect(base_url()."administrador/comprobantes");

		}else{

			$this->session->set_flashdata("error","No se pudo guardar la informacion");

			redirect(base_url()."administrador/comprobantes/add");

		}

		

	}



	public function edit($id){

		$data  = array(

			'comprobante' => $this->Comprobantes_model->getComprobante($id), 

		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");

		$this->load->view("admin/comprobantes/edit",$data);

		$this->load->view("layouts/footer");

	}



	public function update(){

		$idcomprobante = $this->input->post("idcomprobante");

		$nombre = $this->input->post("nombre");

		$numero_inicial = $this->input->post("numero_inicial");

		$serie = $this->input->post("serie");

		$limite = $this->input->post("limite");

		

		$solicitar_nit = $this->input->post("solicitar_nit");

		$data = array(

			"nombre" => $nombre,

			"serie" => strtoupper($serie),

			"numero_inicial" => $numero_inicial,

			"limite" => $limite,

			"solicitar_nit" => $solicitar_nit,

		);



		if ($this->Comprobantes_model->update($idcomprobante,$data)) {

			redirect(base_url()."administrador/comprobantes");

		}else{

			$this->session->set_flashdata("error","No se pudo guardar la informacion");

			redirect(base_url()."administrador/comprobantes/edit/".$idcomprobante);

		}

	}



	public function delete($id){

		$this->Comprobantes_model->delete($id);

		redirect(base_url()."administrador/comprobantes");

	}



	public function establecerPredeterminado(){

		$comprobante = $this->input->post("comprobante");

		$data = [

			"predeterminado" => 1

		];



		if ($this->Comprobantes_model->update($comprobante,$data)) {

			$data = [

				'predeterminado' => 0

			];

			$this->Comprobantes_model->removePredeterminado($comprobante,$data);

			$this->session->set_flashdata("success","Se establecio el comprobante predeterminado");

			redirect(base_url()."administrador/comprobantes");

		} else {

			$this->session->set_flashdata("error","No se pudo establecer el comprobante predeterminado");

			redirect(base_url()."administrador/comprobantes");

		}

	}

}