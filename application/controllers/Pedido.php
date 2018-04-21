<?php
class Pedido extends CI_Controller
{

	function __construct() {
		parent:: __construct();
		$this->load->model(array(
						"Venta_model"
						));

		$this->datos['scripts'] = script();
	}

	public function index(){

		if (isset($_SESSION['UsuarioID'])) {
			$ven = new Venta_model();

			if ($ven->CrearVenta()) {
				$mensaje = "Venta # {$ven->venta->venta}, fue creada";
				$exito   = 1;
				$this->datos['venta'] = $ven->venta->venta;
			} else {
				$mensaje = $ven->getMensaje();
			}
		} else {
			$mensaje = "Faltan datos necesarios (US)";
			$exito   = 0;
		}

		$this->datos['mensaje'] = $mensaje;
		$this->datos['exito']   = $exito;

		enviarJSON($this->datos);
	}

	public function agregarProducto(){
		$exito   = false;
		if ($this->input->post('venta') && $this->input->post('codigo')) {
			$ven = new Venta_model($this->input->post('venta'));
			$ven->verProducto($this->input->post('codigo'));

			if (!empty($ven->producto)) {
				$ven->verProductoAgregado($ven->producto->producto);
				$ars = array();
				$valor           = 1;
				$ars["cantidad"] = 1;

				if(verDatos($_POST, "cantidad")){
					$valor           = $_POST["cantidad"];
					$ars["cantidad"] = $valor;
				}

				$ars["subtotal"]     = $ven->producto->precio_venta * $valor;
				$ars["total"]        = $ars["subtotal"];
				$ars["precioventa"] = $ven->producto->precio_venta;
				#$valor = ($this->input->post("cantidad")) ? $this->input->post("cantidad") : 1;

				if (!empty($ven->agregado)) {
					$cantidad        = $ven->agregado->cantidad + $valor;
					$ars['cantidad']    = $cantidad;
					$ars["precioventa"] = $ven->agregado->precioventa;
					$ars['subtotal']    = $ven->agregado->precioventa * $cantidad;
					$ars['total']       = $ars['subtotal'] - $ven->agregado->descuento;
				}

				if ($ven->agregarProducto($ars)){
					$mensaje = "Producto {$ven->producto->codigo}, agregado";
					$exito   = true;
				} else {
					$mensaje = $ven->getMensaje();
				}
			} else {
				$mensaje = "No existe producto";
			}

		} else {
			$mensaje = "Código Inválido";
		}

		$this->datos['mensaje'] = $mensaje;
		$this->datos['exito']   = $exito;
		$this->datos['venta']   = $this->input->post('venta');

		enviarJSON($this->datos);

	}

	function formcobrar($venta){
		$ven = new Venta_model($venta);
		$this->datos["montos"] = $ven->getResumenVenta();
		$this->datos["accion"] = base_url("index.php/pedido/cobrar");
		$this->datos["venta"]  = $venta;

		$this->load->view("venta/formcobrar", $this->datos);
	}

	function cobrar(){
		$ven = new Venta_model($_POST["venta"]);
		if (!$this->input->post("cliente")){
			$_POST["cliente"] = "C/F";
		}

		if(!$this->input->post("nit")){
			$_POST["nit"] = "S/N";
		}

		if(!$this->input->post("direccion")){
			$_POSt["direccion"] = "S/D";
		}

		//$monto = $_POST["efectivo"] + $_POST["tarjeta"] + $_POST["credito"];
		$resumen = $ven->getResumenVenta();
		$topagos = sumatotal($ven->getFormaPago(), "monto");

		if($resumen->total == $topagos) {
			if($ven->guardarCobro($_POST)){
				$this->datos["venta"]   = $_POST["venta"];
				$this->datos["ultima"]  = $ven->getUltimaVenta();
				$this->datos["detalle"] = $ven->verVentaGenerada();

			} else {
				$this->datos["mensaje"] = $ven->getMensaje();
			}
		} else {
			$this->datos["mensaje"] = "El monto total no es igual al de la venta";
			$this->datos["venta"]    = $_POST["venta"];
		}

		$this->load->view("venta/detallecobro", $this->datos);
	}

	function formtipopago($venta){
		$v = new Venta_model($venta);
		$lpago  = $v->getFormaPago();
		$vtotal = $v->getResumenVenta()->total;
		$spago  = sumatotal($lpago, 'monto');

		$this->datos["plista"]  = $lpago;
		$this->datos["agrmas"]  = ($vtotal == $spago)?true:false;
		$this->datos["idventa"] = $venta;
		$this->datos["tpago"]   = $this->Conf_model->getFormaPago();
		$this->load->view("venta/pago", $this->datos);	
	}

	function guardapago(){
		$exito   = 0;
		$mensaje = "";
		if($this->Venta_model->guardaFormapago($_POST)){
			$mensaje.= "Actualizacón correcta en la forma de pago";
			$exito   = 1;
		} else {
			$mensaje.= $this->Venta_model->getMensaje();
		}

		$this->datos["mensaje"] = $mensaje;
		$this->datos["exito"]   = $exito;

		enviarJSON($this->datos);
	}
}
?>