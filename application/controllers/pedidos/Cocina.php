<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cocina extends CI_Controller {

	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Cocina_model");
		$this->load->model("Subcategorias_model");
		$this->load->model("Ordenes_model");
		$this->load->helper("functions");
	}

	public function index()
	{
		$subcategoria = $this->Subcategorias_model->getIdSubcategoria('comida');
		$data  = array(
			'permisos' => $this->permisos,
			'pedidos' => $this->Cocina_model->getOrdenes($subcategoria,"0"),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/cocina/list",$data);
		$this->load->view("layouts/footer");

	}

	public function getPedidos(){
		$subcategoria = $this->Subcategorias_model->getIdSubcategoria('comida');
		$preparado = $this->input->post("preparado");
		/*$data  = array(
			'permisos' => $this->permisos,
			'pedidos' => $this->Cocina_model->getOrdenes($subcategoria,"0"),
		);*/
		$pedidos = $this->Cocina_model->getOrdenes($subcategoria,$preparado);

		echo json_encode($pedidos);
	}

	public function add(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/insumos/add");
		$this->load->view("layouts/footer");
	}

	public function store(){

		$nombre = $this->input->post("nombre");
		$unidad_medida_id = $this->input->post("unidad_medida_id");
		$cantidad = $this->input->post("cantidad");

		$data  = array(
			'nombre' => $nombre, 
			'unidad_medida_id' => $unidad_medida_id,
			'cantidad' => $cantidad,
		);

		if ($this->Insumos_model->save($data)) {
			redirect(base_url()."produccion/insumos");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."produccion/insumos");
		}
	
		
	}
	public function updatePedido(){
		$idPedido = $this->input->post("idPedido");
		$preparado = $this->input->post("preparado");
		
		$data = array(
			'preparado' => $preparado
		);

		if ($this->Cocina_model->updatePedido($idPedido,$data)) {
			echo "1";
		}else{
			echo "0";
		}
	}

	public function finalizarPreparacion($idPedido){
		$data = array(
			'preparado' => 2
		);

		if ($this->Cocina_model->updatePedido($idPedido,$data)) {
			$this->session->set_flashdata("success","Se marco el pedido como listo a entregar");
			redirect(base_url()."pedidos/cocina");
		}else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion del pedido");
			redirect(base_url()."pedidos/cocina");
		}
	}

	public function update(){
		$idInsumo = $this->input->post("idInsumo");
		$nombre = $this->input->post("nombre");
		$unidad_medida_id = $this->input->post("unidad_medida_id");
		$cantidad = $this->input->post("cantidad");

		$data  = array(
			'nombre' => $nombre, 
			'unidad_medida_id' => $unidad_medida_id,
			'cantidad' => $cantidad,
		);

		if ($this->Insumos_model->update($idInsumo,$data)) {
			redirect(base_url()."produccion/insumos");
		}
		else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion");
			redirect(base_url()."produccion/insumos/edit/".$idInsumo);
		}

		
	}

	public function view($id){
		$data  = array(
			'insumo' => $this->Insumos_model->getInsumo($id), 
		);
		$this->load->view("admin/insumos/view",$data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Insumos_model->update($id,$data);
		echo "produccion/insumos";
	}

	public function getInfoPedido(){
		$subcategoria = $this->Subcategorias_model->getIdSubcategoria('comida');
		$idPedido = $this->input->post("idPedido");
		$data["pedido"] = $this->Ordenes_model->getPedido($idPedido);
		$data["pedido_productos"] = $this->Cocina_model->getPedidoProductos($idPedido,$subcategoria);
		$data["pedido_mesas"] = $this->Ordenes_model->getPedidosMesas($idPedido);
		$this->load->view("admin/cocina/info_pedido",$data);
	}


}
