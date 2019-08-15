<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_pagar_model extends CI_Model {

	public function getCuentas(){
		$this->db->select("cp.*,c.numero,tc.nombre as comprobante,p.nombre as proveedor");
		$this->db->from("cuentas_pagar cp");
		$this->db->join("compras c","cp.compra_id = c.id");
		$this->db->join("proveedores p","c.proveedor_id = p.id");
		$this->db->join("tipo_comprobante tc","c.comprobante_id = tc.id");
		$this->db->where("cp.estado",0);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getPagosByCuenta($idCuenta){
		$this->db->where("cuenta_pagar_id",$idCuenta);
		$resultados = $this->db->get("pagos");
		return $resultados->result();
	}

	public function saveCuenta($data){
		return $this->db->insert("cuentas_pagar",$data);
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
		return $this->db->update("cuentas_pagar",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("correos");
	}
	
}
