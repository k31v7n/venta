<?php 
class Conf_model extends CI_Model
{
	
	function getFormaPago(){
		return $this->db
					->get("tipo_pago")
					->result();
	}
}
?>