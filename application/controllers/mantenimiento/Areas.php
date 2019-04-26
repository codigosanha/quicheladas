<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Areas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'areas' => $this->Areas_model->getAreas(), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/areas/list",$data);
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

		$this->form_validation->set_rules("nombre","Nombre","required|is_unique[areas.nombre]");

		if ($this->form_validation->run()==TRUE) {

			$data  = array(
				'nombre' => $nombre,
			);

			if ($this->Areas_model->save($data)) {
				redirect(base_url()."mantenimiento/areas");
			}else{
				redirect(base_url()."mantenimiento/areas/add");
			}
		}
		else{
			/*redirect(base_url()."mantenimiento/categorias/add");*/
			$this->add();
		}

		
	}

	public function edit($id){
		$data  = array(
			'area' => $this->Areas_model->getArea($id), 
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/areas/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idArea = $this->input->post("idArea");
		$nombre = $this->input->post("nombre");

		$areaActual = $this->Areas_model->getArea($idArea);

		if ($nombre == $areaActual->nombre) {
			$is_unique = "";
		}else{
			$is_unique = "|is_unique[areas.nombre]";

		}

		$this->form_validation->set_rules("nombre","Nombre","required".$is_unique);
		if ($this->form_validation->run()==TRUE) {
			$data = array(
				'nombre' => $nombre, 
			);

			if ($this->Areas_model->update($idArea,$data)) {
				redirect(base_url()."mantenimiento/areas");
			}
			else{
				$this->session->set_flashdata("error","No se pudo actualizar la informacion");
				redirect(base_url()."mantenimiento/areas/edit/".$idArea);
			}
		}else{
			$this->edit($idArea);
		}

		
	}

	public function view($id){
		$data  = array(
			'area' => $this->Areas_model->getArea($id), 
		);
		$this->load->view("admin/areas/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Areas_model->update($id,$data);
		echo "mantenimiento/areas";
	}
	
	public function activar($id){
		$data  = array(
			'estado' => "1", 
		);
		$this->Areas_model->update($id,$data);
		redirect(base_url()."mantenimiento/areas");
	}
}
