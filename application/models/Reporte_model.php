<?php 
class Reporte_model extends CI_Model
{
	
	function getVentas($ars=array()){
		if($this->input->post('fecha') && $this->input->post('fecha_vendido')){
			$this->db->where("date(fecha) BETWEEN '{$ars["fecha"]}' and '{$ars["fecha_vendido"]}'");
		}

		return $this->db->select("
								a.*, 
								b.total,
								c.nombre as usuario, 
								d.nombre as estado")
						->from("venta a")
						->join("venta_generada b","a.venta = b.venta")
						->join("usuario c","a.usuario = c.usuario")
						->join("status d","a.status = d.status")
						->where("a.status", 2)
						->where("a.usuario", $_SESSION["UsuarioID"])
						->limit(10, $ars['inicio'])
						->get()
						->result();
	}


}
?>