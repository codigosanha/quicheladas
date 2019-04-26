<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades_medidas extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Unidades_medidas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'medidas' => $this->Unidades_medidas_model->getMedidas(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/unidades_medidas/list",$data);
		$this->load->view("layouts/footer");

	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/unidades_medidas/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[unidades_medidas.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre,
			);

			if ($this->Unidades_medidas_model->save($data)) {
				redirect(base_url()."mantenimiento/unidades_medidas");
			}else{
				redirect(base_url()."mantenimiento/unidades_medidas");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->index();
		}

		
	}

	public function edit($id){
		$data  = array(
			'area' => $this->Unidades_medidas_model->getArea($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/unidades_medidas/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idUnidad = $this->input->post("idUnidad");
		$nombre = $this->input->post("nombre");

		$unidadMedidaActual = $this->Unidades_medidas_model->getUnidadMedida($idArea);

		if ($nombre == $unidadMedidaActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[unidades_medidas.nombre]";

		}

		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
			);

			if ($this->Unidades_medidas_model->update($idArea,$data)) {
				redirect(base_url()."mantenimiento/unidades_medidas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/unidades_medidas/edit");
			}
		}else{
			$this->edit($idArea);
		}

		
	}

	public function view($id){
		$data  = array(
			'area' => $this->Unidades_medidas_model->getArea($id), 
		);
		$this->load->view("admin/unidades_medidas/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Unidades_medidas_model->update($id,$data);
		echo "mantenimiento/unidades_medidas";
	}
	
	public function activar($id){
		$data  = array(
			'estado' => "1", 
		);
		$this->Unidades_medidas_model->update($id,$data);
		redirect(base_url()."mantenimiento/unidades_medidas");
	}
}
