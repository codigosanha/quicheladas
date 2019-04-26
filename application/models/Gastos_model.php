<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastos_model extends CI_Model {

	public function getGastos(){
		$this->db->order_by("id","desc");
		$resultados = $this->db->get("gastos");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("gastos",$data);
	}
	public function getCorreo($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("gastos");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("gastos",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("gastos");
	}
	
}
