<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mesas_model extends CI_Model {

	public function getMesas($estado=false){
		$this->db->select("m.*,a.nombre as area");
		$this->db->from("mesas m");
		$this->db->join("areas a", "m.area_id = a.id");
		if ($estado!=false) {
			$this->db->where("m.estado",$estado); 
		}
		
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("mesas",$data);
	}
	public function getCategoria($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("mesas");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("mesas",$data);
	}
	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("mesas");
	}
}
