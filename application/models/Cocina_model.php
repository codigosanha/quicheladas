<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cocina_model extends CI_Model {

	public function getOrdenes($subcategoria,$preparado){//preparado = 0 ->nuevo // preparado = 1 ->preparacion
		$this->db->where("fecha", date("Y-m-d"));
		$this->db->where("estado","1");
		$this->db->where("preparado", $preparado);
		$this->db->order_by("id","DESC");
		$resultados = $this->db->get("pedidos");


		$return = array();

	    foreach ($resultados->result() as $pedido)
	    {
	        $return[$pedido->id] = $pedido;

	        $return[$pedido->id]->productos = $this->getPedidoProductos($pedido->id,$subcategoria);
	        $return[$pedido->id]->mesas = $this->getPedidosMesas($pedido->id); // Get the categories sub categories
	    }

	    return $return;
	}

	public function getPedidosMesas($pedido_id)
	{	
		$this->db->select("m.id,m.numero");
		$this->db->from("pedidos_mesa pm");
		$this->db->join("mesas m", "pm.mesa_id = m.id");
	    $this->db->where('pm.pedido_id', $pedido_id);
	    $query = $this->db->get();
	    return $query->result();
	}


	public function getPedidoProductos($pedido_id,$subcategoria){
		$this->db->select("p.nombre, pp.cantidad");
		$this->db->from("pedidos_productos pp");
		$this->db->join("productos p", "pp.producto_id = p.id");
	    $this->db->where('p.subcategoria', $subcategoria);
	    $this->db->where('pp.pedido_id', $pedido_id);
	    $query = $this->db->get();
	    return $query->result();
	}

	public function save($data){
		return $this->db->insert("areas",$data);
	}
	public function getArea($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("areas");
		return $resultado->row();

	}

	public function updatePedido($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("pedidos",$data);
	}

	public function getMesas($idArea){
		$this->db->where("area_id",$idArea);
		$resultado = $this->db->get("mesas");
		return $resultado->result();
	}

	
}
