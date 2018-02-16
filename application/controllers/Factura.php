<?php 
class Factura extends CI_Controller
{
	
	function __construct(){
		parent:: __construct();
		if(login()){
			$this->load->model("Venta_model");
		} else {
			redirect("session");
		}
	}

	function index(){ echo "hola :D";}

	public function imprimir($venta){
		$v = new Venta_model($venta);
		$this->load->view("factura/imprimir");
	}
}
?>