<?php
class Producto_model extends CI_Model {

	function getcategoria(){
		return $this->db
					->get("categoria")
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
					->limit(10,$ars["inicio"])
					->get("producto a")
					->result();
	}
}
?>