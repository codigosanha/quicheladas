<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_model extends CI_Model {

	public function getProveedores(){
		$this->db->select("p.*");
		$this->db->from("proveedores p");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("proveedores",$data);
	}
	public function getProveedor($id){
		$this->db->select("p.*");
		$this->db->from("proveedores p");
		$this->db->where("p.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("proveedores",$data);
	}
}
