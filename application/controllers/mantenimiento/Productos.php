<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	private $permisos;

	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Productos_model");
		$this->load->model("Categorias_model");
		$this->load->model("Ventas_model");
		$this->load->model("Subcategorias_model");
		$this->load->model("Unidades_medidas_model");
	}

	public function index()
	{
		$data  = array(
			'permisos' => $this->permisos,
			'productos' => $this->Productos_model->getProductos(),
			'productoslast' => $this->Productos_model->getLastProductos(),
			'medidas' => $this->Unidades_medidas_model->getMedidas(),
		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/list",$data);
		$this->load->view("layouts/footer");

	}
	public function add(){
		
		$data =array( 
			"categorias" => $this->Categorias_model->getCategorias(),
			"subcategorias" => $this->Subcategorias_model->getSubcategorias(),
			"productos" => $this->Productos_model->getProductos(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/add",$data);
		$this->load->view("layouts/footer");
	}

	public function store(){

		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$precio = $this->input->post("precio");
		$precio_compra = $this->input->post("precio_compra");
		
		$categoria = $this->input->post("categoria");
		$subcategoria = $this->input->post("subcategoria");
		$stockminimo = $this->input->post("stockminimo");
		$condicion = $this->input->post("condicion");
		//productos Asociados
		$idproductosA = $this->input->post("idproductosA");
		$cantidadA = $this->input->post("cantidadA");
		$cantidad_descuento = $this->input->post("cantidad_descuento");
		$monto_descuento = $this->input->post("monto_descuento");

		$nombres = $this->input->post("nombres");
		$cantidades = $this->input->post("cantidades");

		$categorias = $this->input->post("categorias");
		$cant_categorias = $this->input->post("cant_categorias");

		$this->form_validation->set_rules("codigo","Codigo","required|is_unique[productos.codigo]");
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio","Precio","required");
		if ($condicion=="0") {
			$stock = 1 ;
			$stockminimo = 0 ;
		}else{
			$stock = 0;
		}
		
		if ($this->form_validation->run()) {
			$imagen = 'image_default.jpg';
			if (!empty($_FILES['imagen']['name'])) {
				$config['upload_path']          = './assets/imagenes_productos/';
                $config['allowed_types']        = 'gif|jpg|png';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('imagen'))
                {
  					$data = array('upload_data' => $this->upload->data());
                    $imagen = $data['upload_data']['file_name'];
                } 
                
			}
			$data  = array(
				'codigo' => $codigo, 
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'precio_compra' => $precio_compra,
				'stock' => $stock,
				'categoria_id' => $categoria,
				"subcategoria" => $subcategoria,
				'estado' => "1",
				'stock_minimo' => $stockminimo,
				'condicion' => $condicion,
				'imagen' => $imagen,
				'cantidad_descuento' => $cantidad_descuento,
				'monto_descuento' => $monto_descuento,
				'categorias_asociadas' => count($categorias)
			);
			$producto_id = $this->Productos_model->save($data);
			if ($producto_id != false) {
				if (!empty($idproductosA)) {
					//Guardar productos Asociados
					for($i = 0; $i < count($idproductosA); $i++){
						$dataA = array(
							"producto_id" => $producto_id,
							"producto_asociado" => $idproductosA[$i],
							"cantidad" => $cantidadA[$i]
						);

						$this->Productos_model->saveAsociados($dataA);
					}
				}

				$this->saveMedidas($nombres,$cantidades,$producto_id);
				if (!empty($categorias)) {
					$this->saveCategoriasAsociadas($producto_id,$categorias, $cant_categorias);
				}
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/add");
			}
		}
		else{
			$this->add();
		}

		
	}

	protected function saveCategoriasAsociadas($producto_id,$categorias, $cant_categorias){
		for ($i=0; $i < count($categorias); $i++) { 
			$data["producto_id"] = $producto_id;
			$data["categoria_id"] = $categorias[$i];
			$data["cantidad"] = $cant_categorias[$i];
			$this->Productos_model->saveCategoriasAsociadas($data);
		}
	}

	protected function saveMedidas($nombres, $cantidades, $producto_id){
		for ($i=0; $i < count($nombres); $i++) { 
			
		}
	}

	public function edit($id){
		$data =array( 
			"producto" => $this->Productos_model->getProducto($id),
			"productosAsociados" => $this->Productos_model->getProductosA($id),
			"categorias" => $this->Categorias_model->getCategorias(),
			"subcategorias" => $this->Subcategorias_model->getSubcategorias(),
			'categorias_asociadas' => $this->Productos_model->getCategoriasAsociaadas($id)
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/productos/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idproducto = $this->input->post("idproducto");
		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$descripcion = $this->input->post("descripcion");
		$precio = $this->input->post("precio");
		$precio_compra = $this->input->post("precio_compra");

		$categoria = $this->input->post("categoria");
		$subcategoria = $this->input->post("subcategoria");
		$stockminimo = $this->input->post("stockminimo");
		$condicion = $this->input->post("condicion");
		$cantidad_descuento = $this->input->post("cantidad_descuento");
		$monto_descuento = $this->input->post("monto_descuento");

		//productos Asociados
		$idproductosA = $this->input->post("idproductosA");
		$cantidadA = $this->input->post("cantidadA");

		$categorias = $this->input->post("categorias");
		$cant_categorias = $this->input->post("cant_categorias");

		$productoActual = $this->Productos_model->getProducto($idproducto);

		if ($codigo == $productoActual->codigo) {
			$is_unique = '';
		}
		else{
			$is_unique = '|is_unique[productos.codigo]';
		}

		$this->form_validation->set_rules("codigo","Codigo","required".$is_unique);
		$this->form_validation->set_rules("nombre","Nombre","required");
		$this->form_validation->set_rules("precio","Precio","required");
		if ($condicion=="0") {
			$stock = 1 ;
			$stockminimo = 0 ;
		}

		if ($this->form_validation->run()) {

			$imagen = $productoActual->imagen;
			if (!empty($_FILES['imagen']['name'])) {
				$config['upload_path']          = './assets/imagenes_productos/';
                $config['allowed_types']        = 'gif|jpg|png';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('imagen'))
                {
  					$data = array('upload_data' => $this->upload->data());
                    $imagen = $data['upload_data']['file_name'];
                } 
                
			}
			$data  = array(
				'codigo' => $codigo, 
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'precio' => $precio,
				'precio_compra' => $precio_compra,
				'categoria_id' => $categoria,
				'subcategoria' => $subcategoria,
				'stock_minimo' => $stockminimo,
				'condicion' => $condicion,
				'imagen' => $imagen,
				'cantidad_descuento' => $cantidad_descuento,
				'monto_descuento' => $monto_descuento,
			);
			if ($this->Productos_model->update($idproducto,$data)) {

				$this->Productos_model->deleteProductosAsociados($idproducto);

				if (!empty($idproductosA)) {
					//Guardar productos Asociados
					for($i = 0; $i < count($idproductosA); $i++){
						$dataA = array(
							"producto_id" => $idproducto,
							"producto_asociado" => $idproductosA[$i],
							"cantidad" => $cantidadA[$i]
						);

						$this->Productos_model->saveAsociados($dataA);
					}
				}

				if (!empty($categorias)) {
					$this->Productos_model->deleteCategoriasAsociadas($idproducto);
					$this->saveCategoriasAsociadas($idproducto,$categorias, $cant_categorias);
				}
				redirect(base_url()."mantenimiento/productos");
			}
			else{
				$this->session->set_flashdata("error","No se pudo guardar la informacion");
				redirect(base_url()."mantenimiento/productos/edit/".$idproducto);
			}
		}else{
			$this->edit($idproducto);
		}

		
	}
	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Productos_model->update($id,$data);
		
		echo "mantenimiento/productos";
	}

	public function view($id){
		$data  = array(
			'producto' => $this->Productos_model->getProducto($id), 
			'productosA' => $this->Productos_model->getProductosA($id), 

		);
		$this->load->view("admin/productos/view",$data);
	}


	public function getExtras($idproducto){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}else{
			$resultados = $this->Productos_model->getExtras($idproducto);
			echo json_encode($resultados);
		}
		
	}

	public function getMedidasProducto($idproducto){
		
			$resultados = $this->Unidades_medidas_model->getMedidasProducto($idproducto);
			echo json_encode($resultados);
		
		
	}

	public function saveExtra(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}else{
			$idProducto = $this->input->post("idProducto");
			$nombre = $this->input->post("nombre");
			$precio =  $this->input->post("precio");

            
            $this->form_validation->set_rules('nombre', 'Nombre del Extra', 'trim|required|callback_check_extra',
                    array(
                    	'required' => 'El  %s. es obligatorio',
                    	'check_extra'     => 'El  %s. ya fue agregada para este producto'
                    )
            );
            

            if ($this->form_validation->run() == FALSE)
            {
            	$errors = validation_errors();
                $response  = array(
                 	'status' => 0, 
                 	'error' => $errors
                );
                echo json_encode($response);
            }
            else
            {
                $data  = array(
                	'producto_id' => $idProducto,
                	'nombre' => $nombre,
                	'precio' => $precio, 
                );
                if ($this->Productos_model->saveExtra($data)) {
                	$this->verificarExtras($idProducto);
                	$response  = array(
	                 	'status' => 1, 
	                 	'message' => "El extra fue agregado al producto"
	                );
	                echo json_encode($response);
                }
                else{
                	$response  = array(
	                 	'status' => 0, 
	                 	'error' => "No se a podido guardar el extra"
	                );
	                echo json_encode($response);
                }
            }
		}
	}

	public function saveMedida(){
		
		$idProducto = $this->input->post("idProducto");
		$unidad_medida_id = $this->input->post("unidad_medida_id");
		$cantidad =  $this->input->post("cantidad");
      	$precio =  $this->input->post("precio");
        $data  = array(
        	'producto_id' => $idProducto,
        	'unidad_medida_id' => $unidad_medida_id,
        	'cantidad' => $cantidad, 
        	'precio' => $precio,
        );
        if ($this->Productos_model->saveMedida($data)) {
        	$response  = array(
             	'status' => 1, 
             	'message' => "La unidade de medida fue agregado al producto"
            );
            echo json_encode($response);
        }
        else{
        	$response  = array(
             	'status' => 0, 
             	'error' => "No se a podido guardar el extra"
            );
            echo json_encode($response);
        
        }
	}


	public function check_extra($name){
		$idProducto = $this->input->post("idProducto");

		if ($this->Productos_model->check_extra_producto($idProducto,$name)) {
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function verificarExtras($idproducto){
		$cant = $this->Productos_model->countExtras($idproducto);
		$data = array(
			'cantidad_extras' => $cant, 
		);
		$this->Productos_model->update($idproducto,$data);
	}

	public function deleteExtra($idExtra){
		if ($this->Productos_model->deleteExtra($idExtra)) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function deleteUnidadMedida($idpum){
		$data = array(
			'estado' => 0, 
		);
		if ($this->Productos_model->updateUnidadMedida($idpum,$data)) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function updateMedidaProducto(){
		$idpum = $this->input->post("idpum");
		$cantidad = $this->input->post("cantidad");
		$precio = $this->input->post("precio");

		$data = array(
			
			'cantidad' => $cantidad,
			'precio' => $precio,
		);
		if ($this->Productos_model->updateUnidadMedida($idpum,$data)) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function updateExtraProducto(){
		$idExtra = $this->input->post("idExtra");
		$nombre = $this->input->post("nombre");
		$precio = $this->input->post("precio");

		$data = array(
			
			'nombre' => $nombre,
			'precio' => $precio,
		);
		if ($this->Productos_model->updateExtraProducto($idExtra,$data)) {
			echo "1";
		}
		else{
			echo "0";
		}
	}

	public function changeStatus(){
		$producto_id = $this->input->post("producto_id");
		$status = $this->input->post("status");
		$data["estado"] = $status;
		if ($this->Productos_model->update($producto_id, $data)) {
			echo "1";
		}else{
			echo "0";
		}
	}

	public function getProductosByCategoria(){
		$categoria_id = $this->input->post("categoria_id");
		$productos = $this->Productos_model->getProductosByCategoria($categoria_id);
		echo json_encode($productos);
	}

}