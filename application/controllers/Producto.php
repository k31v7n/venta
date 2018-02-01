<?php
class Producto extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array("Venta_model","Producto_model"));
		$this->datos['scripts'] = script();
	}

	function index(){
		$this->datos["venta"] = $this->input->post("venta");
		$this->datos["categoria"] = $this->Producto_model->getcategoria();

		$this->load->view("categoria/cuerpo", $this->datos);
	}

	function buscar($categoria = ""){
		$this->datos["productos"] = $this->Producto_model->getProductos($categoria);
		$this->load->view("categoria/lista", $this->datos);
	}
}
?>