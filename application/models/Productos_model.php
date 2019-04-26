<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

	public function getProductos(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function deleteExtra($idextra){
		$this->db->where("id",$idextra);
		return $this->db->delete("extras");
	}

	public function updateUnidadMedida($id, $data){
		$this->db->where("id",$id);
		return $this->db->update("productos_unidades_medidas", $data);
	}

	public function countExtras($idproducto){
		$this->db->where("producto_id", $idproducto);
		return $this->db->get('extras')->num_rows();
	}
	
	public function getLastProductos(){
		$this->db->select("p.*, c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->order_by('id',"desc");
		$this->db->limit(5);
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getProductosConStock(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
	    $this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.condicion","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function setear_stock_negative($data){
		$this->db->where("condicion",1);
		$this->db->where("stock <", 0);
		return $this->db->update("productos", $data);
	}
	
	public function getProducto($id){
		$this->db->select("p.*,c.nombre as categoria, sc.nombre as subcat");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->join("subcategorias sc","p.subcategoria = sc.id");
		$this->db->where("p.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}
	public function getProductosA($id){

		$this->db->select("p.codigo,p.nombre,pa.*");
		$this->db->from("productos_asociados pa");
		$this->db->join("productos p", "pa.producto_asociado = p.id");
		$this->db->where("pa.producto_id",$id);
		$resultado = $this->db->get();

		return $resultado->result();
	}
	public function save($data){
		if ($this->db->insert("productos",$data)) {
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	public function saveAsociados($data){
		return $this->db->insert("productos_asociados",$data);
			
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("productos",$data);
	}

	public function deleteProductosAsociados($idproducto){
		$this->db->where("producto_id",$idproducto);
		return $this->db->delete("productos_asociados");
	}

	public function getExtras($idproducto){
		$this->db->where("producto_id",$idproducto);
		return $this->db->get("extras")->result();
	}

	public function saveExtra($data){
		return $this->db->insert("extras",$data);
	}

	public function saveMedida($data){
		return $this->db->insert("productos_unidades_medidas",$data);
	}

	public function check_extra_producto($idproducto,$nombre){

		$this->db->where("nombre",$nombre);
		$this->db->where("producto_id",$idproducto);
		$resultado = $this->db->get("extras");
		if ($resultado->num_rows() > 0) {
			return TRUE;
		}
		return FALSE;

	}

}