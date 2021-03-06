<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_model extends CI_Model {

	public function getVentas($fecha = false){
		$this->db->select("v.*,c.nombre,tc.nombre as tipocomprobante, u.nombres");
		$this->db->from("ventas v");
		$this->db->join("clientes c","v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc","v.tipo_comprobante_id = tc.id");
		$this->db->join("usuarios u","v.usuario_id = u.id");
		if ($fecha !== false) {
			$this->db->where("v.fecha <=",$fecha);
		}
		
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else
		{
			return false;
		}
	}
	public function getVentasbyDate($fechainicio,$fechafin){
		$this->db->select("v.*,c.nombre,tc.nombre as tipocomprobante, u.nombres");
		$this->db->from("ventas v");
		$this->db->join("clientes c","v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc","v.tipo_comprobante_id = tc.id");
		$this->db->join("usuarios u","v.usuario_id = u.id");
		$this->db->where("v.fecha >=",$fechainicio);
		$this->db->where("v.fecha <=",$fechafin);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}else
		{
			return false;
		}
	}

	public function getVenta($id){
		$this->db->select("v.*,c.nombre,c.direccion,c.telefono,c.num_documento as documento,tc.nombre as tipocomprobante,tc.igv as porcentaje, CONCAT(u.nombres,' ',u.apellidos) as usuario");
		$this->db->from("ventas v");
		$this->db->join("clientes c","v.cliente_id = c.id");
		$this->db->join("tipo_comprobante tc","v.tipo_comprobante_id = tc.id");
		$this->db->join("usuarios u","v.usuario_id = u.id");
		$this->db->where("v.id",$id);
		$resultado = $this->db->get();
		return $resultado->row();
	}

	public function getDetalle($id){
		$this->db->select("dt.*,p.nombre,p.stock,p.condicion");
		$this->db->from("detalle_venta dt");
		$this->db->join("productos p","dt.producto_id = p.id");
		$this->db->where("dt.venta_id",$id);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getDetalleVenta($idVenta,$pedido_id){
		$this->db->select("dt.*,p.nombre,p.stock,p.condicion");
		$this->db->from("detalle_venta dt");
		$this->db->join("productos p","dt.producto_id = p.id");
		$this->db->where("dt.venta_id",$idVenta);
		$query = $this->db->get();
		$return = array();

	    foreach ($query->result() as $detalle)
	    {
	        $return[$detalle->id] = $detalle;
	        $return[$detalle->id]->precios_extras = $this->getPreciosExtras($pedido_id,$detalle->producto_id,$detalle->codigo); // Get the categories sub categories
	        $return[$detalle->id]->ofertas = $this->getOfertas($pedido_id,$detalle->producto_id,$detalle->codigo); // Get the categories sub categories
	    }

	    return $return;
	}

	public function getPreciosExtras($pedido,$producto,$codigo){
		$this->db->select("e.nombre, e.precio");
		$this->db->from("orden_producto_extra ope");
		$this->db->join('extras e',"ope.extra_id = e.id");
		$this->db->where('ope.orden_id',$pedido);
		$this->db->where('ope.producto_id',$producto);
		$this->db->where('ope.codigo',$codigo);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOfertas($pedido, $producto, $codigo)
	{

		$this->db->select("p.id,p.nombre, o.cantidad");
		$this->db->from("ofertas o");
		$this->db->join('productos p',"o.producto_complemento = p.id");
		$this->db->where('o.orden_id',$pedido);
		$this->db->where('o.producto_original',$producto);
		$this->db->where('o.codigo',$codigo);
		$query = $this->db->get();
		return $query->result();
	 
	}

	public function getComprobantes(){
		$resultados = $this->db->get("tipo_comprobante");
		return $resultados->result();
	}

	public function getComprobante($idcomprobante){
		$this->db->where("id",$idcomprobante);
		$resultado = $this->db->get("tipo_comprobante");
		return $resultado->row();
	}

	public function getproductos($valor){
		$this->db->select("id,codigo,nombre as label,precio,stock,condicion,asociado");
		$this->db->from("productos");
		$this->db->where('stock >=',1);
		$this->db->like("nombre",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}

	public function getproductosA($valor){
		$this->db->select("id,codigo,nombre as label,precio,stock,condicion");
		$this->db->from("productos");
		$this->db->like("nombre",$valor);
		$resultados = $this->db->get();
		return $resultados->result_array();
	}

	public function save($data){
		return $this->db->insert("ventas",$data);
	}

	public function lastID(){
		return $this->db->insert_id();
	}

	public function updateComprobante($idcomprobante,$data){
		$this->db->where("id",$idcomprobante);
		$this->db->update("tipo_comprobante",$data);
	}

	public function save_detalle($data){
		$this->db->insert("detalle_venta",$data);
	}

	public function years(){
		$this->db->select("YEAR(fecha) as year");
		$this->db->from("ventas");
		$this->db->group_by("year");
		$this->db->order_by("year","desc");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function montos(){
		$this->db->select("fecha, SUM(total) as monto");
		$this->db->from("ventas");
		$this->db->where("estado","1");
		$this->db->group_by("fecha");
		$this->db->order_by("fecha");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	
	public function montosMeses($year){
		$this->db->select("MONTH(fecha) as mes, SUM(total) as monto");
		$this->db->from("ventas");
		$this->db->where("estado","1");
		$this->db->where("fecha >=",$year."-01-01");
		$this->db->where("fecha <=",$year."-12-31");
		$this->db->group_by("mes");
		$this->db->order_by("mes");
		$resultados = $this->db->get();
		return $resultados->result();
	}



	public function savecliente($data){
		if ($this->db->insert("clientes",$data)) {
			return $this->db->insert_id();
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

	public function deleteDetail($id){
		$this->db->where("venta_id",$id);
		return $this->db->delete("detalle_venta");
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("ventas",$data);
	}

	public function comprobarPassword($password){
		$this->db->where("clave_permiso", $password);
		$resultados  = $this->db->get("configuraciones");
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

	public function saveNotificacion($data){
		$this->db->insert("notificaciones",$data);
	}

	public function updateNotificacion($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("notificaciones",$data);
	}

	public function getProducts(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();

		$productos = array();
		foreach ($resultados->result_array() as $resultado) {
			$productos[$resultado['id']] = $resultado;
		}

		return $productos;
	}

	public function productosVendidos($fechainicio, $fechafin){
		$this->db->select("p.id, p.nombre, p.condicion, p.stock, p.precio,SUM(dv.cantidad) as totalVendidos");
		$this->db->from("detalle_venta dv");
		$this->db->join("productos p", "dv.producto_id = p.id");
		$this->db->join("ventas v", "dv.venta_id = v.id");
		$this->db->where("v.fecha >=", $fechainicio);
		$this->db->where("v.fecha <=", $fechafin);
		$this->db->group_by("dv.producto_id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getLastProductos(){
		$this->db->select("p.*, c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->order_by('id',"desc");
		$this->db->limit(10);
		$resultados = $this->db->get();
		return $resultados->result();
	}
	
	public function getProductosStockMinimo(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$this->db->where("p.condicion","1");
		$this->db->where("stock <", 10);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getProductosmasVendidos(){
		$this->db->select("p.id, p.codigo, p.nombre, p.condicion, p.stock, p.precio,SUM(dv.cantidad) as totalVendidos, c.nombre as categoria");
		$this->db->from("detalle_venta dv");
		$this->db->join("productos p", "dv.producto_id = p.id");
		$this->db->join("ventas v", "dv.venta_id = v.id");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->order_by("totalVendidos", "desc"); 
		$this->db->limit(10);
		$this->db->group_by("dv.producto_id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getMejoresClientes(){
		$this->db->select("v.cliente_id,SUM(v.total) as total, c.nombre");
		$this->db->from("ventas v");
		$this->db->join("clientes c", "v.cliente_id = c.id");
		$this->db->order_by("total", "desc"); 
		$this->db->limit(10);
		$this->db->group_by("v.cliente_id");
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getCantidadProductoVenta($producto_id, $venta_id, $codigo){
		$this->db->where("producto_id",$producto_id);
		$this->db->where("venta_id",$venta_id);
		$this->db->where("codigo",$codigo);

		$resultados = $this->db->get("detalle_venta");
		return $resultados->row();
	}
}