<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {
	public function getID($link){
		$this->db->like("link",$link);
		$resultado = $this->db->get("menus");
		return $resultado->row();
	}

	public function getPermisos($menu,$rol){
		$this->db->where("menu_id",$menu);
		$this->db->where("rol_id",$rol);
		$resultado = $this->db->get("permisos");
		return $resultado->row();
	}

	public function rowCount($tabla){
		if ($tabla != "ventas") {
			$this->db->where("estado","1");
		}
		$resultados = $this->db->get($tabla);
		return $resultados->num_rows();
	}

	public function getParents($rol)
	{
		$this->db->select("m.*");
		$this->db->from("menus m");
		$this->db->join("permisos p", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("p.read","1");
		$this->db->where("m.parent","0");

		$this->db->where("m.estado",1);
		$this->db->order_by("m.orden");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}

	public function getChildren($rol,$idMenu)
	{
		$this->db->select("m.*");
		$this->db->from("menus m");
		$this->db->join("permisos p", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("p.read","1");
		$this->db->where("m.parent",$idMenu);
		$this->db->where("m.estado",1);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}
	public function stockminimo(){
		$this->db->where("estado","1");
		$query = $this->db->get("productos");
		$return = array();

	    foreach ($query->result() as $producto)
	    {
	    	if ($producto->stock <= $producto->stock_minimo) {
	    		$return[$producto->id] = $producto;
	    	}
	        
	    }

	    return $return;

	}

	public function getNotificaciones(){

		$this->db->select("n.*, p.nombre, p.stock, p.stock_minimo");
		$this->db->from("notificaciones n");
		$this->db->join("productos p", "n.producto_id = p.id");
		$this->db->where("n.estado","0");
		$this->db->order_by("n.id","DESC");
		$resultados = $this->db->get();

		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}

	public function getMesasPrendidas(){

		$this->db->select("pp.pedido_id, SUM(pp.cantidad) as cantidad");
		$this->db->from("pedidos_productos pp");
		$this->db->join("pedidos p", "pp.pedido_id = p.id");
		$this->db->where("p.fecha",date("Y-m-d"));
		$this->db->where("p.estado",1);
		$this->db->order_by("cantidad", "desc"); 
		$this->db->limit(4);
		$this->db->group_by("pp.pedido_id");
		$resultados = $this->db->get();
		return $resultados->result();

	}

	public function getConfiguracion(){
		$resultado = $this->db->get("configuraciones");
		if ($resultado->num_rows() > 0) {
			return $resultado->row();
		}
		return false;
	}

	public function saveCorreoRemitente($data){
		return $this->db->insert("configuraciones", $data);
	}

	public function updateCorreoRemitente($idConfiguracion, $data){
		$this->db->where("id", $idConfiguracion);
		return $this->db->update("configuraciones", $data);
	}
	
}