<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumos_model extends CI_Model {

	public function getInsumos(){
		$this->db->where("estado","1");
		$resultados = $this->db->get("insumos");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("insumos",$data);
	}
	public function getInsumo($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("insumos");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("insumos",$data);
	}

	public function getProductosInsumos(){
		$this->db->group_by("producto_id");
		$resultados = $this->db->get("productos_insumos");
		return $resultados->result();
	}

	public function saveProductoInsumos($data){
		return $this->db->insert_batch("productos_insumos",$data);
	}

	public function getInsumosByProducto($producto_id){
		$this->db->where("producto_id",$producto_id);
		$resultados = $this->db->get("productos_insumos");
		return $resultados->result();
	}

	public function deleteInsumosFormProducto($producto_id){
		$this->db->where("producto_id", $producto_id);
		return $this->db->delete("productos_insumos");
	}
}
