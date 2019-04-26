<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjetas_model extends CI_Model {

	public function getTarjetas(){
		$resultados = $this->db->get("tarjetas");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("tarjetas",$data);
	}
	public function getTarjeta($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("tarjetas");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("tarjetas",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("tarjetas");
	}
	
}
