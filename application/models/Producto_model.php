<?php
class Producto_model extends CI_Model {

	public $cate;
	private $mensaje;
	public $producto;

	function __construct($id=''){
		if(!empty($id)){
			$this->verCategoria($id);
		}
	}

	function setmensaje($mensaje){
		$this->mensaje = $mensaje;
	}

	function getmensaje(){
		return $this->mensaje;
	}

	function getcategoria(){

		return $this->db
					->select("
						a.categoria,
						a.nombre,
						b.nombre as empresa
						")
					->join("empresa b","a.empresa = b.empresa")
					->where("a.empresa", $_SESSION["EmpresaID"])
					->where("a.anulado",0)
					->get("categoria a")
					->result();
	}

	function getProductos($ars=array()){
		if (isset($ars['categoria']) && $ars['categoria']){
			$this->db->where("a.categoria", $ars['categoria']);
		}

		if (verDatos($ars, "termino")){
			$this->db->like("a.nombre", $ars["termino"],'after');
		}

		return $this->db
					->select("a.*, b.nombre as ncategoria")
					->join("categoria b","a.categoria = b.categoria")
					->where("b.empresa", $_SESSION["EmpresaID"])
					->where("a.anulado",0)
					->limit(10,$ars["inicio"])
					->get("producto a")
					->result();
	}

	function verCategoria($categoria){
		$this->cate = $this->db
						   ->where("categoria", $categoria)
						   ->get("categoria")
						   ->row();
	}

	function guardaCategaria($args=array()){
		if($this->cate){
			$this->db
				 ->where("categoria", $this->cate->categoria);
			if($this->db->update("categoria", $args)){
				$this->verCategoria($this->cate->categoria);
				return true;

			} else {
				$this->setmensaje("Error al actualizar la categoria (DB)");
			}
		} else {
			$this->db
				 ->set("usuario", $_SESSION["UsuarioID"])
				 ->set("empresa", $_SESSION["EmpresaID"])
				 ->set("fecha_registro","now()",false);
			if($this->db->insert("categoria", $args)){
				$this->verCategoria($this->db->insert_id());
				return true;
			} else {
				$this->setmensaje("Error al insertar la categoria (DB)");
			}
		}

		return false;
	}

	function verunProducto($prod=""){
		$pro = $this->db
					->where("producto", $prod)
					->get("producto")
					->row();
					
		$this->producto = $pro;

		return $pro;
	}

	function guardaproducto($args=array()) {
		if($this->producto) {
			$this->db
				 ->where("producto", $this->producto->producto);
			if($this->db->update("producto", $args)){
				$this->verunProducto($this->producto->producto);
				return true;
			} else {
				$this->setmensaje("Error al actualizar el producto (DB)");
			}
		} else {
			$this->db
				 ->set("categoria", $this->cate->categoria)
				 ->set("usuario", $_SESSION["UsuarioID"])
				 ->set("fecha_registro","now()",false);
			if($this->db->insert("producto",$args)){
				$this->verunProducto($this->db->insert_id());
				return true;
			} else {
				$this->setmensaje("Error al insertar el producto (DB)");
			}
		}

		return false;
	}
}
?>