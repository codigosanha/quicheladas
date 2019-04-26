<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidades_medidas_model extends CI_Model {

	public function getMedidas(){
		$resultados = $this->db->get("unidades_medidas");
		return $resultados->result();
	}
	

	public function save($data){
		return $this->db->insert("unidades_medidas",$data);
	}
	public function getMedidasProducto($idproducto){
		$this->db->select("um.id,pum.id as idpum, um.nombre, pum.cantidad, pum.precio");
		$this->db->from("productos_unidades_medidas pum");
		$this->db->join("unidades_medidas um", "pum.unidad_medida_id = um.id");
		$this->db->where("pum.producto_id",$idproducto);
		$this->db->where("pum.estado",1);
		$resultado = $this->db->get();
		return $resultado->result();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("unidades_medidas",$data);
	}

	public function getMesas($idArea){
		$this->db->where("area_id",$idArea);
		$resultado = $this->db->get("mesas");
		return $resultado->result();
	}

	
}
