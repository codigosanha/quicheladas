<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjetas extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Tarjetas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'tarjetas' => $this->Tarjetas_model->getTarjetas(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/tarjetas/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/areas/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[tarjetas.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre,
			);

			if ($this->Tarjetas_model->save($data)) {
				$this->session->set_flashdata("error","La Tarjeta ".$nombre." fue Agregada");
				redirect(base_url()."administrador/tarjetas");
			}else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."administrador/tarjetas");
			}
		}
		else{
			$this->index();
			
		}

	}

	public function update(){
		$idTarjeta = $this->input->post("idTarjeta");
		$nombre = $this->input->post("nombre");

		$tarjetaActual = $this->Tarjetas_model->getTarjeta($idTarjeta);

		if ($nombre == $tarjetaActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[tarjetas.nombre]";

		}

		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);

		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
			);

			if ($this->Tarjetas_model->update($idTarjeta,$data)) {
				$response = array(
					'status' => "1",
					'message' => 'Se actualizo la informacion de la tarjeta '.ucfirst($nombre)
				);
			}else{
				$response = array(
					'status' => "0",
					'message' => 'No se pudo actualizar el nombre de la tarjeta' 
				);
			}
		}else{
			$response = array(
				'status' => "0",
				'message' => "El nombre ingresado ya esta registrado", 
			);
		}
		echo json_encode($response);
	}

}
