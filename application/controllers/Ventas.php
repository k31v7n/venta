<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
	function __construct(){
		parent:: __construct();
		if(login()){
			$this->load->model(array(
						"Venta_model"
						));
			$this->datos['scripts'] = script();
		} else {
			redirect("sesion");
		}
	}

	public function index() {
		$this->datos['menu']   = "menu";
		$this->datos['vista']  = "pedido/cuerpo";
		$this->datos['ultima'] = $this->Venta_model->getUltimaVenta();
		$this->load->view("principal", $this->datos);
	}

	public function Ventascreadas(){
		$this->datos['lista'] = $this->Venta_model->getVentas();
		$this->load->view("pedido/lista", $this->datos);
	}

	public function listaventaproducto($venta){
		$vnt = new Venta_model($venta);
		$this->datos['listapro'] = $vnt->getProductosVenta();
		$this->load->view("detalle/lista", $this->datos);
	}

	public function formcaptura($venta){
		$ven = new Venta_model($venta);
		$this->datos['accion'] = base_url('index.php/pedido/agregarProducto');
		$this->datos["venta"]  = $ven->venta;
		$this->load->view("pedido/form", $this->datos);
	}

	public function accionventa($venta, $opcion){
		$ven   = new Venta_model($venta);
		$exito = false;

		switch ($opcion) {
			case 1: # Campo Cantidad
				$cam = (($ven->venta->campocantidad == 0) ? 1 : 0);
				$arg["campocantidad"] = $cam;

				if($ven->actualizaVenta($arg)){
					$mensaje = "El campo fue deshabilitado";

					if($ven->venta->campocantidad == 1){
						$mensaje = "El campo fue habilitado";
					}
					$exito = true;
				}
				break;
			case 2: # Reiniciar Venta
				$mensaje = "¡Error! al reiniciar la venta";

				$productos = $ven->getProductosVenta();
				foreach($productos as $row){
					$arg["eliminado"] = 1;
					$ven->verProductoAgregado($row->producto);
					$ven->agregarProducto($arg);
				}

				if (count($ven->getProductosVenta()) == 0){
					$mensaje = "Fue reiniciado la venta correctamente";
					$exito	 = true;
				}

				break;
			case 3: # Anular
				$arg["anulado"] = 1;
				$arg["fecha_anulado"] = date("Y-m-d H:i:s");

				$mensaje = "¡Error!, no fue posible anular la venta";

				if($ven->actualizaVenta($arg)){
					$mensaje = "Se anulo la venta {$ven->venta->venta} correctamente";
					$exito   = true;
				}
				$this->datos['venta'] = $this->Venta_model->getUltimaVenta();
				break;
			default:
				$exito = false;
				break;
		}

		$this->datos["mensaje"] = $mensaje;
		$this->datos["exito"]   = $exito;
		enviarJSON($this->datos);
	}

	public function aplicadescuento($venta){
		$this->load->library("form/Fdescuento");

		$vnt  = new Venta_model($venta);
		$form = new Fdescuento();
		$detalle = $vnt->verProductoAgregado($this->input->post('producto'));
		if ($vnt->agregado) {
			$form->setproducto($vnt->agregado);
		}

		$form->setaccion(base_url("index.php/ventas/guardadescuento/{$venta}/{$vnt->agregado->producto}"));

		$this->datos['nombre'] = ($vnt->agregado) ? $vnt->agregado->nombre:'';
		$this->datos['codigo'] = ($vnt->agregado) ? $vnt->agregado->codigo:'';

		$datos = array_merge($this->datos, $form->crear());
		$this->load->view("detalle/descuento", $datos);
	}

	public function guardadescuento($venta, $producto){
		$exito = true;

		$vet = new Venta_model($venta);
		$vet->verProductoAgregado($producto);

		if($this->input->post("cant_aplica") > $vet->agregado->cantidad){
			$mensaje = "La cantidad de productos que aplica ";
			$mensaje.= "descuento es mayor a la cantidad registrada";
			$exito  = false;
		}

		if ($exito) {
			if ($vet->agregarProducto($_POST)){
				$mensaje = "Se agrego el descuento al producto {$vet->agregado->codigo}";
			} else {
				$mensaje = $vet->getMensaje();
				$exito   = false;
			}
		}

		$this->datos['mensaje'] = $mensaje;
		$this->datos['exito']   = $exito;
		$this->datos['venta']   = $venta;

		enviarJSON($this->datos);
	}

	public function form_eliminar(){
		$ven = new Venta_model($this->input->post('venta'));
		$ven->verProductoAgregado($this->input->post('producto'));

		$this->datos['producto'] = $ven->agregado;

		$this->load->view("detalle/eliminar", $this->datos);
	}

	public function eliminarproducto(){
		$ven = new Venta_model($_POST["venta"]);
		$ven->verProductoAgregado($_POST["producto"]);
		$exito = true;

		if ($this->input->post("todo") or $this->input->post("unico")){
			$arg["eliminado"] = 1;
		}

		if ($this->input->post("cantidad")){
			if($ven->agregado->cantidad == $_POST["cantidad"]){
				$arg["eliminado"] = 1;
			} else {
				$arg["cantidad"]      = $ven->agregado->cantidad - $_POST["cantidad"];
				$arg["descuento"]     = 0;
				$arg["por_descuento"] = 0;
				$arg["cant_aplica"]	  = 0;
				$arg["subtotal"]	  = $arg["cantidad"] * $ven->agregado->precioventa;
				$arg["total"]		  = $arg["cantidad"] * $ven->agregado->precioventa;
			}
		}

		if(!empty($arg)){
			if ($ven->agregarProducto($arg)){
				$mensaje = "Se eliminó correctamente";
			} else {
				$mensaje = $ven->getMensaje();
				$exito = false;
			}
		} else {
			$mensaje = "¡Error!, debe ingresar una cantidad";
			$exito   = false;
		}

		$this->datos['mensaje'] = $mensaje;
		$this->datos['venta']   = $_POST["venta"];
		$this->datos['exito']   = $exito;

		enviarJSON($this->datos);
	}

	public function resumenventa($venta){
		$ven = new Venta_model($venta);
		$this->datos["resumen"] = $ven->getResumenVenta();
		$this->datos["venta"]   = $venta;

		$this->load->view("venta/resumen", $this->datos);
	}


}
?>