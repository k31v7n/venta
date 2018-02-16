<?php 
class Reporte extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		if(login()){
			$this->datos["scripts"] = array(
								(object)array('ruta' => 'public/js/reporte.js', 'print' => TRUE)
								);
			$this->load->model(array("Reporte_model","Venta_model"));
		} else {
			redirect("sesion");
		}
		
	}

	function index(){
		$this->datos["menu"]  = "menu";
		$this->datos["vista"] = "reporte/venta/cuerpo";
		$this->datos["accion"] = base_url("index.php/reporte/buscar_ventas");
		$this->datos["ventas"] = $this->Reporte_model->getVentas(array("inicio" => 0));
		$contar = count($this->datos["ventas"]);
		$limite = 10;
		if ($contar == $limite){
			$this->datos['mas'] = $contar;
		}
		$this->load->view("principal", $this->datos);
	}

	function buscar_ventas(){
		$this->datos["ventas"] = $this->Reporte_model->getVentas($_POST);
		$contar = count($this->datos["ventas"]);
		$limite = 10;
		if ($contar == $limite){
			$this->datos['mas'] = $contar;
		}
		$this->load->view("reporte/venta/lista", $this->datos);
	}

	function formedita($venta){
		$ven = new Venta_model($venta);
		$this->datos["venta"]  = $ven->venta;
		$this->datos["accion"] = base_url("index.php/reporte/ventaGuarda");
		$this->load->view("reporte/venta/fedita", $this->datos);
	}

	function ventaGuarda(){
		$ven = new Venta_model($this->input->post("venta"));
		$exito = true;
		if($ven->actualizaVenta($_POST)){
			$mensaje = "Actualización correcta";
		} else {
			$mensaje = "Error al Actualizar";
			$exito   = false;
		}

		$this->datos["mensaje"] = $mensaje;
		$this->datos["exito"]   = $exito;
		enviarJSON($this->datos);
	}
}
?>