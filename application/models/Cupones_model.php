<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cupones_model extends CI_Model {

	public function getConfiguraciones(){
		$resultados = $this->db->get("configuraciones_cupones");
		return $resultados->result();
	}

	public function saveConfiguracion($data){
		return $this->db->insert("configuraciones_cupones",$data);
	}
	public function getConfiguracion($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("configuraciones_cupones");
		return $resultado->row();

	}

	public function updateConfiguracion($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("configuraciones_cupones",$data);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("configuraciones_cupones");
	}

	public function checkConfiguracion($total, $fecha){
		$this->db->where("'$total' between monto_minimo and monto_maximo AND '$fecha' between fecha_inicio and fecha_final");
		$resultado = $this->db->get("configuraciones_cupones");

		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}

		return false;

	}

	public function generarCupon($data){
		if($this->db->insert("cupones_generados",$data)){
			$this->db->where("id", $this->db->insert_id());
			$resultado = $this->db->get("cupones_generados");
			if ($resultado->num_rows() > 0 ) {
				return $resultado->row();
			}
			return false;
		}else{
			return false;
		}
	}

	public function getCupon($codigo,$tipo_cupon){
		$this->db->where("codigo", $codigo);
		$this->db->where("tipo_cupon", $tipo_cupon);
		$this->db->where("fecha_limite >=", date("y-m-d"));
		$this->db->where("estado",1);
		$resultado = $this->db->get("cupones_generados");
		if ($resultado->num_rows() > 0 ) {
			return $resultado->row();
			# code...
		}
		return false;
	}

	public function updateCupon($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("cupones_generados",$data);
	}
	
}
