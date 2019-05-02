<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ajustes_model extends CI_Model {

	public function getAjustes(){

		

		$resultado = $this->db->get("ajustes");

		return $resultado->result();

	}

	public function getProductos(){
		$this->db->where("condicion",1);
		$resultados = $this->db->get("productos");
		return $resultados->result();
	}

	public function ajusteActual(){

		$this->db->where("DATE(fecha)",date("Y-m-d"));

		$resultado = $this->db->get("ajustes");

		if ($resultado->num_rows() > 0) {

			return true;

		}else{

			return false;

		}

		

	}

	public function getAjuste($id){

		$this->db->where("id", $id);

		$resultado = $this->db->get("ajustes");

		return $resultado->row();

	}



	public function save($data){

		if ($this->db->insert("ajustes",$data)) {

			return $this->db->insert_id();

		}

		return false;

	}



	public function getAjusteProductos($idajuste){

		$this->db->where("ajuste_id",$idajuste);

		return $this->db->get("ajustes_productos")->result();

	}



	public function saveAjusteProductos($data){

		return $this->db->insert("ajustes_productos",$data);

	}



	public function updateAjuste($idajuste,$idproducto,$data){

		$this->db->where("ajuste_id",$idajuste);

		$this->db->where("producto_id",$idproducto);

		return $this->db->update("ajustes_productos",$data);

	}



	

}