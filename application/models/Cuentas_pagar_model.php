<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_cobrar_model extends CI_Model {

	public function getCuentas(){
		
		$this->db->where("estado",0);
		$resultados = $this->db->get("cuentas_cobrar");
		return $resultados->result();
	}

	public function getPagosByCuenta($idCuenta){
		$this->db->where("cuenta_cobrar_id",$idCuenta);
		$resultados = $this->db->get("pagos");
		return $resultados->result();
	}

	public function saveCuenta($data){
		return $this->db->insert("cuentas_cobrar",$data);
	}

	public function savePago($data){
		return $this->db->insert("pagos",$data);
	}

	public function getCorreo($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("correos");
		return $resultado->row();

	}

	public function updateCuenta($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("cuentas_cobrar",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("correos");
	}
	
}
