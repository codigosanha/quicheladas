<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correos_model extends CI_Model {

	public function getCorreos(){
		$resultados = $this->db->get("correos");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("correos",$data);
	}
	public function getCorreo($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("correos");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("correos",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("correos");
	}
	
}
