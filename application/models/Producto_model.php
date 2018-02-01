<?php
class Producto_model extends CI_Model {

	function getcategoria(){
		return $this->db
					->get("categoria")
					->result();
	}
	function getProductos($categoria=""){
		if ($categoria){
			$this->db->where("a.categoria", $categoria);
		}

		return $this->db
					->select("a.*, b.nombre as ncategoria")
					->join("categoria b","a.categoria = b.categoria")
					->get("producto a")
					->result();
	}
}
?>