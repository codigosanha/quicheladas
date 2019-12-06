<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caja_model extends CI_Model {

	public function getCajas(){
		$this->db->order_by("id", "desc");
		return $this->db->get('caja')->result();
	}

	public function getCajaAbierta(){
		$this->db->where("estado","1");
		$resultado = $this->db->get('caja');
		if ($resultado->num_rows() > 0 ) {
			return $resultado->row();
		}
		return false;
	}

	public function getCajaByDate($operacion){
		$this->db->select("c.*, u.nombres, u.apellidos");
		$this->db->from("caja c");
		$this->db->join("usuarios u", "c.usuario_id = u.id");
		$this->db->where("c.operacion",$operacion);
		$this->db->where("c.fecha >=",date("Y-m-d 00:00:00"));
		$this->db->where("c.fecha <=",date("Y-m-d 23:59:59"));
		$resultados = $this->db->get("caja");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

	public function save($data){
		return $this->db->insert("caja",$data);
	}
	public function getCaja($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("caja");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("caja",$data);
	}


	public function sumaVentasHoy(){
		$this->db->select("SUM(total) as total");
		$this->db->where("fecha", date("Y-m-d"));
		$this->db->where("estado","1");
		$resultados = $this->db->get("ventas");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}

	}

	public function check_pending_orders(){
		$this->db->where("estado",1);
		$resultados = $this->db->get("pedidos");
		return $resultados->num_rows();
	}

	public function getDescuentos($id){
		$this->db->where("caja_id", $id);
		$this->db->where("descuento >", "0.00");
		$resultados = $this->db->get("ventas");
		return $resultados->result();
	}

	public function getGastos($id){
		$this->db->where("caja_id", $id);
		$resultados = $this->db->get("gastos");
		return $resultados->result();
	}

	public function getCreditos($id){
		$this->db->where("caja_id", $id);
		$this->db->where("monto_credito >", "0");
		$resultados = $this->db->get("ventas");
		return $resultados->result();
	}

	public function getTarjetas($caja_id){
		$resultados = $this->db->get("tarjetas");
		$return = array();

	    foreach ($resultados->result() as $tarjeta)
	    {
	        $return[$tarjeta->id] = $tarjeta;
	        $return[$tarjeta->id]->totalTarjeta = $this->getTotalTarjeta($caja_id,$tarjeta->id); // Get the categories sub categories
	    }

	    return $return;
	}

	public function getTotalTarjeta($idCaja,$idTarjeta)
		{
			$this->db->select('SUM(monto_tarjeta) as total');
			$this->db->from('ventas');
			$this->db->where('caja_id',$idCaja);
			$this->db->where('tarjeta_id',$idTarjeta);
			$this->db->group_by('caja_id');
			$query = $this->db->get();
			if ($query->num_rows() > 0 ) {
				return number_format($query->row()->total, 2, '.', '');
			}
			return '0.00';
		}
}
