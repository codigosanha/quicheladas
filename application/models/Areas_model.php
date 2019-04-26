<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_model extends CI_Model {

	public function getAreas(){
		$resultados = $this->db->get("areas");
		return $resultados->result();
	}
	public function getFirstArea(){
		$resultados = $this->db->get("areas");
		return $resultados->row()->id;
	}

	public function save($data){
		return $this->db->insert("areas",$data);
	}
	public function getArea($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("areas");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("areas",$data);
	}

	public function getMesas($idArea){
		$this->db->where("area_id",$idArea);
		$resultado = $this->db->get("mesas");
		return $resultado->result();
	}

	
}
