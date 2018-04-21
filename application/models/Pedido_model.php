<?php

class Pedido_model extends CI_Model
{
	public $mensaje;
	public $producto=array();
	public $agregado=array();
	public $fac;
	public $vdato;
	public $cdato;

	public function setMensaje($msj){
		$this->mensaje = $msj;
	}

	public function getMensaje(){
		return $this->mensaje;
	}

	public function 	verProducto($codigo)
	{
		$this->producto = $this->db
							   ->where('codigo', $codigo)
							   ->get('producto')
							   ->row();
	}

	public function getVentas()
	{
		return $this->db->where('anulado',0)
						->where('status', 1)
						->where('usuario', $_SESSION['UsuarioID'])
					    ->get('venta')
					    ->result();
	}

	public function verProductoAgregado($id)
	{
		if ($this->venta) {
			$this->db->where("a.venta", $this->venta->venta);
		}

		$this->agregado = $this->db
							   ->select("a.*, b.nombre, b.codigo")
							   ->where("a.producto", $id)
							   ->where("eliminado", 0)
							   ->join("producto b","a.producto = b.producto","left")
							   ->get("venta_producto a")
							   ->row();
	}

	public function agregarProducto($ars=array())
	{
		if($this->agregado) {
			$this->db->where("venta_producto", $this->agregado->venta_producto)
					 ->where("venta", $this->venta->venta);

			if ($this->db->update("venta_producto",$ars)) {
				$this->verProducto($this->agregado->codigo);
				return true;

			} else {
				$this->setMensaje("Error al actualizar el registro (BD)");
				return false;
			}

		} else {
			$cantidad = ($ars["cantidad"]) ? $ars["cantidad"] : 1;
			$this->db
				 ->set('venta', $this->venta->venta)
				 ->set('producto', $this->producto->producto);
				 #->set('cantidad', $cantidad)
				 #->set('precioventa', $this->producto->precio_venta);
				 #->set('subtotal', $this->producto->precio_venta)
				 #->set('total', $this->producto->precio_venta);

			if ($this->db->insert("venta_producto", $ars)) {
				$this->verProducto($this->producto->codigo);
				return true;
			} else {
				$this->setMensaje("Error al agregar producto (BD)");
				return false;
			}
		}
	}

	function verVentaGenerada(){
		return $this->db->select("
								a.numero,
								a.serie,
								b.total,
								b.subtotal,
								b.descuento,
								b.venta,
								c.nombre,
								c.nit,
								c.direccion,
								sum(cantidad) as articulos
								")
						->from("factura a")
						->join("venta_generada b","a.factura= b.factura")
						->join("cliente c","b.cliente = c.cliente")
						->join("venta_producto d","b.venta = d.venta")
						->where("b.venta", $this->venta->venta)
						->where("d.eliminado", 0)
						->where("a.anulado", 0)
						->get()
						->row();
	}

	function verFactura($factura){
		$this->fac = $this->db
						  ->where("factura", $factura)
						  ->get("factura")
						  ->row();
	}

	function getfacturacorrelativo(){
		return $this->db->select("
								(correlativo + 1) as numero,
								serie
								")
						->from("factura_correlativo")
						->get()
						->row();
	}

	function setdatoventa($indice,$valor){
		$this->vdato[$indice] = $valor;
	}

	function set_datosVenta($arg=array()){
		if(verDatos($arg, "cliente")){
			$this->cdato["nombre"] = $arg["cliente"];
		}

		if(isset($this->empresa)){
			$this->cdato["empresa"] = $this->empresa;
		}

		if(verDatos($arg, "nit")){
			$this->cdato["nit"] = $arg["nit"];
		}

		if(verDatos($arg, "direccion")){
			$this->cdato["direccion"] = $arg["direccion"];
		}

		if(verDatos($arg, "venta")){
			$this->vdato["venta"] = $arg["venta"];
		}

		if(verDatos($arg, "descuento")){
			$this->vdato["descuento"] = $arg["descuento"];
		}

		if(verDatos($arg, "subtotal")){
			$this->vdato["subtotal"] = $arg["subtotal"];
		}

		if(verDatos($arg, "total")){
			$this->vdato["total"] = $arg["total"];
		}
	}

	function cerrarVenta(){
		return $this->db->select("
								now() as fecha_vendido,
								2 as status")
						->get()
						->row_array();
	}

	function actualizaCorrelativo(){
		$this->db
			->set("correlativo", $this->fac->numero)
			->update("factura_correlativo");
	}

	function guardarCobro($arg=array()){
		$this->set_datosVenta($arg);
		# Traer Correlativo
		$fac = $this->getfacturacorrelativo();
		$this->db
			 ->set("numero",  $fac->numero)
			 ->set("serie",   $fac->serie)
			 ->set("empresa", $this->empresa)
			 ->set("monto",   $arg["total"]);

		if($this->db->insert("factura")){
			$this->verFactura($this->db->insert_id());
			$ven = new Venta_model($this->vdato["venta"]);

			$this->db->insert("cliente", $this->cdato);
			$this->setdatoventa("cliente", $this->db->insert_id());
			$this->setdatoventa("factura", $this->fac->factura);

			$this->db
				 ->set("usuario", $_SESSION["UsuarioID"])
				 ->set("fecha_acepta", "now()", false);

			if($this->db->insert("venta_generada", $this->vdato)){
				$ven->verunaVenta($this->vdato["venta"]);
				$ven->actualizaVenta($this->cerrarVenta());
				$this->actualizaCorrelativo();
			}
			return true;

		} else {
			$this->setMensaje("Error al guardar la factura (DB)");
		}

		return false;

	}

	function guardaFormapago($args=array()){
		if(verDatos($args, "pago")){
			$this->db
				 ->where("pago", $args["pago"]);
			if($this->db->update("pago", $args)){
				return true;
			} else {
				$this->setMensaje("Error al actualizar el producto (DB)");
				return false;
			}
		} else {
			$this->db
				 ->set("usuario", $_SESSION["UsuarioID"]);
			if($this->db->insert("pago", $args)){
				return true;
			} else {
				$this->setMensaje("Error al agregar la forma de pago (DB)");
				return true;
			}
		}
		return false;
	}

	function getFormaPago(){
		return $this->db
					->where("venta", $this->venta->venta)
					->where("anulado", 0)
					->join("pago b","a.tipo_pago = b.tipo_pago")
					->get("tipo_pago a")
					->result();

	}
}
?>
