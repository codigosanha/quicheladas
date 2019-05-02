<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ajuste extends CI_Controller {



	private $permisos;

	public function __construct(){

		parent::__construct();

		$this->permisos = $this->backend_lib->control();

		$this->load->model("Ajustes_model");

		$this->load->model("Productos_model");

		$this->load->helper("functions");

		//$this->load->library("Configuraciones_lib");

	}



	public function index()

	{

		$data  = array(

			'ajustes' => $this->Ajustes_model->getAjustes(),

			'ajusteActual' => $this->Ajustes_model->ajusteActual(),

			'permisos' => $this->permisos, 

		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");

		$this->load->view("admin/ajustes/list",$data);

		$this->load->view("layouts/footer");



	}



	public function add(){



		$data = array(

			'productos' => $this->Ajustes_model->getProductos(),

		);



		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");

		$this->load->view("admin/ajustes/add",$data);

		$this->load->view("layouts/footer");

	}



	public function store(){



		$usuario_id = $this->session->userdata("id");

		$fecha = date("Y-m-d H:i:s");

		$productos = $this->input->post("productos");

	

		$stocks_bd = $this->input->post("stocks_bd");

		$stocks_fisico = $this->input->post("stocks_fisico");

		$stocks_diferencia = $this->input->post("stocks_diferencia");




		$data  = array(

			'fecha' => $fecha, 

			'usuario_id' => $usuario_id,

		);

		$ajuste_id = $this->Ajustes_model->save($data);

		if ($ajuste_id != false) {

			$this->saveAjusteProductos($ajuste_id,$productos,$stocks_bd,$stocks_fisico,$stocks_diferencia);
			$this->session->set_flashdata("success","No se pudo guardar la informacion");

			redirect(base_url()."mantenimiento/ajuste");
		}

		else{

			$this->session->set_flashdata("error","No se pudo guardar la informacion");

			redirect(base_url()."mantenimiento/ajuste/add");

		}

		

	}



	protected function saveAjusteProductos($ajuste_id,$productos,$stocks_bd,$stocks_fisico,$stocks_diferencia){

		for ($i=0; $i < count($productos); $i++) { 



			$data = array(

				'ajuste_id' => $ajuste_id,

				'producto_id' => $productos[$i],

				'stock_bd' => $stocks_bd[$i],

				'stock_fisico' => $stocks_fisico[$i],

				'diferencia_stock' => $stocks_diferencia[$i]

			);



			$this->Ajustes_model->saveAjusteProductos($data);

		}

	} 



	public function edit($id){

		$data  = array(

			'ajuste' => $this->Ajustes_model->getAjuste($id),

			'ajustes' => $this->Ajustes_model->getAjusteProductos($id), 

		);

		$this->load->view("layouts/header");

		$this->load->view("layouts/aside");

		$this->load->view("admin/ajustes/edit",$data);

		$this->load->view("layouts/footer");

	}



	public function update(){

		$idAjuste = $this->input->post("idAjuste");

		$productos = $this->input->post("productos");

		$stocks_fisico = $this->input->post("stocks_fisico");

		$stocks_diferencia = $this->input->post("stocks_diferencia");



		for ($i=0; $i < count($productos); $i++) { 

			$data = array(

				'stock_fisico' => $stocks_fisico[$i],

				'diferencia_stock' => $stocks_diferencia[$i],

			);



			$this->Ajustes_model->updateAjuste($idAjuste,$productos[$i],$data);

		}



		

		$this->session->set_flashdata("success","La informacion del ajuste se actualizo");

		redirect(base_url()."mantenimiento/ajuste");

		

	}



	public function printAjuste($arrayAjustes,$tipoAjuste,$ajuste_id){

		$this->load->library("EscPos.php");

		try {

			

			$connector = new Escpos\PrintConnectors\WindowsPrintConnector("LPT1");

			/*$connector = new Escpos\PrintConnectors\NetworkPrintConnector("192.168.1.43", 9100);*/

			/* Information for the receipt */

			$items = array();

			for ($i=0; $i < count($arrayAjustes); $i++) { 

				$items[] = new item($arrayAjustes[$i]['cantidad'],getProducto($arrayAjustes[$i]['producto_id'])->nombre,$arrayAjustes[$i]['importe']);

			}

			

			$printer = new Escpos\Printer($connector);

			$printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);

			

			/* Name of shop */

			$printer -> selectPrintMode();

			$printer -> text($this->configuraciones_lib->getEmpresa()."\n");

			$printer -> selectPrintMode();

			$printer -> text($this->configuraciones_lib->getDescripcion()."\n");

			$printer -> text("RNC: ".$this->configuraciones_lib->getRNC()."\n");

			$printer -> text("TELEFONO: ".$this->configuraciones_lib->getTelefono()."\n");

			$printer -> text($this->configuraciones_lib->getDireccion()."\n");

			$printer -> setJustification(Escpos\Printer::JUSTIFY_RIGHT);

			$printer -> text(date('d/m/Y', strtotime(getAjuste($ajuste_id)->fecha))."\n");

			$printer -> feed();

			/* Title of receipt */

			$printer -> setJustification(Escpos\Printer::JUSTIFY_CENTER);

			$printer -> setEmphasis(true);

			$printer -> text("AJUSTE DE INVENTARIO"."\n");

			$printer -> feed();

			$printer -> text("PRODUCTOS ".$tipoAjuste."\n");

			$printer -> setEmphasis(false);

			$printer -> feed();



			$printer->setJustification(Escpos\Printer::JUSTIFY_LEFT);

			$printer->setEmphasis(true);

			$printer->text($this->addSpaces('CANT.', 7) . $this->addSpaces('DESCRIPCION', 15) . $this->addSpaces('IMPORTE', 8,LEFT) . "\n");

			/* Items */

			$printer -> setEmphasis(false);

			foreach ($items as $item) {

			    $printer -> text($item);

			}

			

			$printer -> feed();

			

			

			/* Cut the receipt and open the cash drawer */

			$printer -> cut();

			$printer -> pulse();

			$printer -> close();

			/* A wrapper to do organise item names & prices into columns */

			

		} catch (Exception $e) {

			//echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";

			$this->session->set_flashdata("error", "Error al intentar imprimir el ajuste de inventario");



			redirect(base_url()."mantenimiento/ajuste");

		}





	}



	protected function addSpaces($text,$length,$dir = RIGHT,$character =' '){

		if ($dir == LEFT) {

			return str_pad($text, $length, $character, STR_PAD_LEFT);

		}else{

			return str_pad($text, $length); 

		}

		

	}

}

class item

{

    private $quantity;

    private $name;

    private $amount;

    public function __construct($quantity = '', $name = '', $amount = '')

    {

        $this -> quantity = $quantity;

        $this -> name = $name;

        $this -> amount = $amount;

    }

    

    public function __toString()

    {

        $numberColsQuantity = 7;

        $numberColsName = 15;

        $numberColsAmount = 8;

    

        $quantity = str_pad($this -> quantity, $numberColsQuantity) ;

        $name = str_pad($this -> name, $numberColsName) ;

       

        $amount = str_pad($this -> amount, $numberColsAmount, ' ', STR_PAD_LEFT);

        return "$quantity$name$amount\n";

    }

}