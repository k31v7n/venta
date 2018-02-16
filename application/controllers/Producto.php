<?php
class Producto extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(login()){
			$this->load->model(array("Venta_model","Producto_model"));
			$this->datos['scripts'] = script();
		} else {
			redirect("sesion");
		}
		
	}

	function index(){
		$this->datos["venta"]     = $this->input->post("venta");
		$this->datos["categoria"] = $this->Producto_model->getcategoria();
		$this->datos["accion"]    = base_url("index.php/producto/buscar");
		$this->datos["productos"] = $this->Producto_model->getProductos(array("inicio" => 0));
		$limite = 10;
		$registros = count($this->datos["productos"]);
		if (count($this->datos["productos"]) == $limite)
		{
			$this->datos["vermas"] = $registros;
		}

		$this->load->view("categoria/cuerpo", $this->datos);
	}

	function buscar(){
		$this->datos["productos"] = $this->Producto_model->getProductos($_POST);
		$limite = 10;
		$registros = count($this->datos["productos"]);
		if (count($this->datos["productos"]) == $limite)
		{
			$this->datos["vermas"] = $registros;
		}

		$this->load->view("categoria/lista", $this->datos);
	}

	function agregarproducto($venta){
		$ven = new Venta_model($venta);
		$mensaje = '';
		$exito   = true;

		foreach($_POST['item'] as $row){
			$ven->verProducto($row['codigo']);
			$ven->verProductoAgregado($ven->producto->producto);
			$cantidad = $row['cantidad'];

			$ars['cantidad']     = $row['cantidad'];
			$ars['subtotal']     = $row['precio'] * $cantidad;
			$ars['total']        = $ars['subtotal'];
			$ars['precioventa'] = $row['precio'];

			if (!empty($ven->agregado)){
				$ncantidad       = $ven->agregado->cantidad + $cantidad;
				$ars['cantidad'] = $ncantidad;
				$ars['subtotal'] = $ven->agregado->precioventa * $ncantidad;
				$ars['total']    = $ars['subtotal'] - $ven->agregado->descuento;
			}

			if ($ven->agregarProducto($ars)){
				$mensaje .= "Producto {$ven->producto->codigo}, agregado<br>";
			} else {
				$mensaje .= $ven->getMensaje()."<br>";
				$exito   = false;
			}
		}

		$this->datos["mensaje"] = $mensaje;
		$this->datos["exito"]   = $exito;
		$this->datos["venta"]   = $venta;

		enviarJSON($this->datos);
	}
}
?>