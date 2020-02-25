<?php 
class Sesion_model extends CI_Model
{
	
	public function verificarUsuario($ars=array())
	{
		$tmp = $this->db
					->where("alias", $ars["usuario"])
					->where("password", sha1($ars["password"]))
					->get("usuario");

		if ($tmp->num_rows() > 0) {
			return $tmp->row();
		}
		
		return false;
	}

	public function getEmpresaUsuario($user)
	{
		return $this->db
					->where("empresa", $user)
					->get("empresa")
					->row();
	}	
}
?>