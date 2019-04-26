<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Usuarios_model");
		$this->load->model("Ventas_model");
		$this->load->helper("functions");
	}


	public function index(){

		$data = array(
			"usuario" => $this->Usuarios_model->getUsuario($this->session->userdata("id"))
		);

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/usuarios/perfil",$data);
		$this->load->view("layouts/footer");

	}

	public function infousuario(){

		$id = $this->input->post("idUsuario");

		$nombres = $this->input->post("nombres");

		$email = $this->input->post("email");

		$sexo = $this->input->post("sexo");



		$data = array(

			"nombres" => $nombres,

			"email" => $email,

			"sexo" => $sexo,

		);



		if ($this->Usuarios_model->update($id, $data)) {

			$this->session->set_flashdata("success", "El cambio de informacion del usuario fue éxitoso");

			$this->session->set_userdata("nombres",$nombres);

			redirect(base_url()."usuario/perfil");

		}

	}

	public function changePassword(){

		$id = $this->input->post("idUsuario");

		$password = $this->input->post("newpass");

		$data = array(

			"password" => sha1($password),

		);



		if ($this->Usuarios_model->update($id, $data)) {

			$this->session->set_flashdata("success", "El cambio de contraseña fue éxitoso");

			redirect(base_url()."usuario/perfil");

		}

	}

}