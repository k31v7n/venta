<?php 
class Sesion_model extends CI_Model
{
	
	public function verificarUsuario($ars=array()){
		$acceder = $this->db
						->where("alias", $ars["usuario"])
						->where("password", $ars["password"])
						->get("usuario");
		if($acceder->num_rows() > 0){
			return $acceder->row();
		} else {
			return false;
		}
	}

	public function getEmpresaUsuario($user){
		return $this->db
					->where("empresa", $user)
					->get("empresa")
					->row();
	}	
}
?>