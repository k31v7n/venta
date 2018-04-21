<?php
class Venta_model extends Pedido_model {

	public $venta;
	public $empresa;

	function __construct($id=''){
		if (!empty($id)) {
			$this->verunaVenta($id);
		}
		$this->empresa = $_SESSION["EmpresaID"];
	}

	public function verunaVenta($id){
		$this->venta = $this->db->where("venta", $id)
								->get("venta")
								->row();
	}

	public function actualizaVenta($arg = array()){
		$this->db
			 ->where("venta", $this->venta->venta);
		if ($this->db->update("venta", $arg)){
			$this->verunaVenta($this->venta->venta);
			return true;
		}

		return false;
	}

	public function getUltimaVenta(){
		$ver = $this->db->select("ifNULL(max(venta),0) as venta")
						->from("venta")
						->where("usuario", $_SESSION['UsuarioID'])
						->where("anulado", 0)
						->where("status", 1)
						->get();

		if ($ver->num_rows() > 0){
			return $ver->row()->venta;
		} else {
			return 3;
		}
	}

	public function CrearVenta() {
		$crea = $this->db->set("fecha","now()",false)
				         ->set("usuario", $_SESSION['UsuarioID'])
				 		 ->set("status", 1)
				 		 ->set("empresa", $this->empresa)
				 	 	 ->insert("venta");

		if ($crea) {
			$xid = $this->db->insert_id();
			$this->verunaVenta($xid);
			return true;

		} else {
			$this->setMensaje("¡Error!, no es posible crear la venta (BD)");
		}

		return false;
	}

	public function getProductosVenta(){
		if(isset($this->venta->venta)){
			return $this->db
						->select("
								a.*,
								b.nombre,
								b.codigo
								")
						->from("venta_producto a")
						->join("producto b","a.producto = b.producto")
						->where("a.venta", $this->venta->venta)
						->where("a.eliminado", 0)
						->get()
						->result();
		}
	}

	public function getResumenVenta(){
		if(isset($this->venta->venta)){
			return $this->db->select("
									IFNULL(SUM(cantidad),0) as cantidad,
									IFNULL(sum(descuento),0) as descuento,
									IFNULL(sum(subtotal),0) as subtotal,
									IFNULL(sum(total),0) as total
									")
							->from("venta_producto")
							->where("venta", $this->venta->venta)
							->where("eliminado", 0)
							->get()
							->row();
		}
	}

}
?>