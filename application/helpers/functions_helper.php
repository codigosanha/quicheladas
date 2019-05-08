
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if(!function_exists('getInsumos'))
{
	function getInsumos($producto_id)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();


		$ci->db->select("pi.cantidad, i.nombre, um.nombre as unidad_medida");
		$ci->db->from("productos_insumos pi");
		$ci->db->join('insumos i',"pi.insumo_id = i.id");
		$ci->db->join('unidades_medidas um',"i.unidad_medida_id = um.id");
		$ci->db->where('pi.producto_id',$producto_id);
		$query = $ci->db->get();
		$insumos = "";
		foreach ($query->result() as $row) {
			$insumos .= $row->cantidad." ".$row->unidad_medida." de ".$row->nombre.", ";
		}

		return $insumos;
	 
	}
}
 
if(!function_exists('getPreciosExtras'))
{
	function getPreciosExtras($pedido, $producto, $codigo)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();


		$ci->db->select("e.nombre, e.precio");
		$ci->db->from("orden_producto_extra ope");
		$ci->db->join('extras e',"ope.extra_id = e.id");
		$ci->db->where('ope.orden_id',$pedido);
		$ci->db->where('ope.producto_id',$producto);
		$ci->db->where('ope.codigo',$codigo);
		$query = $ci->db->get();
		return $query->result();
	 
	}
}

if(!function_exists('getVenta'))
{
	function getVenta($idVenta)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idVenta);
		$query = $ci->db->get('ventas');
		return $query->row();
	 
	}
}

if(!function_exists('getCliente'))
{
	function getCliente($idCliente)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idCliente);
		$query = $ci->db->get('clientes');
		return $query->row();
	 
	}
}

if(!function_exists('getTotalAbonos'))
{
	function getTotalAbonos($idCuenta)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('cuenta_cobrar_id',$idCuenta);
		$query = $ci->db->get('pagos');
		$total = 0;
		foreach ($query->result() as $row) {
			$total = $total + $row->monto;
		}

		return $total;
	 
	}
}


if(!function_exists('getComprobante'))
{
	function getComprobante($idComprobante)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idComprobante);
		$query = $ci->db->get('tipo_comprobante');
		return $query->row();
	 
	}
}

if(!function_exists('getUnidadMedida'))
{
	function getUnidadMedida($idMedida)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idMedida);
		$query = $ci->db->get('unidades_medidas');
		return $query->row();
	 
	}
}
 
if(!function_exists('getArea'))
{
	function getArea($idArea)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idArea);
		$query = $ci->db->get('areas');
		return $query->row();
	 
	}
}

if(!function_exists('getUsuario'))
{
	function getUsuario($idUsuario)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idUsuario);
		$query = $ci->db->get('usuarios');
		return $query->row();
	 
	}
}

if(!function_exists('getProveedor'))
{
	function getProveedor($idProveedor)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idProveedor);
		$query = $ci->db->get('proveedores');
		return $query->row();
	 
	}
}

if(!function_exists('getProducto'))
{
	function getProducto($idProducto)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('id',$idProducto);
		$query = $ci->db->get('productos');
		return $query->row();
	 
	}
}

if(!function_exists('getMesasFromPedido'))
{
	function getMesasFromPedido($idPedido)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select("m.numero,m.area_id");
		$ci->db->from("pedidos_mesa pm");
		$ci->db->join("mesas m", "pm.mesa_id = m.id");
		$ci->db->where('pm.pedido_id',$idPedido);
		$query = $ci->db->get();
		$mesas = "";
		foreach ($query->result() as $row) {
			$mesas .= $row->numero.",";
			$area = $row->area_id;
		}

		return array(
			'mesas' => $mesas, 
			'area' => getArea($area)->nombre
		);
	 
	}
}

if(!function_exists('getNumeroVentas'))
{
	function getNumeroVentas($idCaja)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();

		$ci->db->where('caja_id',$idCaja);
		$query = $ci->db->get('ventas');
		return $query->num_rows();
	 
	}
}


if(!function_exists('getMontoVentas'))
{
	function getMontoVentas($idCaja)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select('SUM(total) as total');
		$ci->db->from('ventas');
		$ci->db->where('caja_id',$idCaja);
		$ci->db->group_by('caja_id');
		$query = $ci->db->get();
		if ($query->num_rows() > 0 ) {
			return number_format($query->row()->total, 2, '.', '');
		}
		return '0.00';
	 
	}
}

if(!function_exists('getMontos'))
{
	function getMontos($campo,$idCaja)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select('SUM('.$campo.') as total');
		$ci->db->from('ventas');
		$ci->db->where('caja_id',$idCaja);
		$ci->db->group_by('caja_id');
		$query = $ci->db->get();
		if ($query->num_rows() > 0 ) {
			return number_format($query->row()->total, 2, '.', '');
		}
		return '0.00';
	 
	}
}

if(!function_exists('getTotalTarjeta'))
{
	function getTotalTarjeta($idCaja,$idTarjeta)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select('SUM(monto_tarjeta) as total');
		$ci->db->from('ventas');
		$ci->db->where('caja_id',$idCaja);
		$ci->db->where('tarjeta_id',$idTarjeta);
		$ci->db->group_by('caja_id');
		$query = $ci->db->get();
		if ($query->num_rows() > 0 ) {
			return number_format($query->row()->total, 2, '.', '');
		}
		return '0.00';
	 
	}
}

if(!function_exists('getTotalDescuentos'))
{
	function getTotalDescuentos($idCaja)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select('SUM(descuento) as total');
		$ci->db->from('ventas');
		$ci->db->where('caja_id',$idCaja);
		$ci->db->group_by('caja_id');
		$query = $ci->db->get();
		if ($query->num_rows() > 0 ) {
			return number_format($query->row()->total, 2, '.', '');
		}
		return '0.00';
	 
	}
}

if(!function_exists('getGastos'))
{
	function getGastos($idCaja)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select('SUM(monto) as monto');
		$ci->db->from('gastos');
		$ci->db->where('caja_id',$idCaja);
		$ci->db->group_by('caja_id');
		$query = $ci->db->get();
		if ($query->num_rows() > 0 ) {
			return $query->row()->monto;
		}
		return '0.00';
	 
	}
}


if(!function_exists('getProductosFromPedido'))
{
	function getProductosFromPedido($pedido_id)
	{
	    //asignamos a $ci el super objeto de codeigniter
		//$ci será como $this
		$ci =& get_instance();
		$ci->db->select('p.nombre, pp.cantidad');
		$ci->db->from('pedidos_productos pp');
		$ci->db->join("productos p", "pp.producto_id = p.id");
		$ci->db->where('pp.pedido_id',$pedido_id);
		$query = $ci->db->get();
		return $query->result();
	 
	}
}



//end application/helpers/ayuda_helper.php