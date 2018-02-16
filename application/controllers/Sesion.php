<?php 
class Sesion extends CI_Controller
{
	
	function __construct() {
		parent::__construct();
		$this->load->model(array("Sesion_model"));
	}

	function index(){
		if(!login()){
			$this->datos["vista"]  = "sesion/cuerpo";
			$this->datos["accion"] = base_url("index.php/sesion/iniciar");
	 		$this->load->view("principal", $this->datos);
	 	} else {
	 		redirect("ventas");
	 	}
	}

	function iniciar(){
		if($this->input->post("usuario") && $this->input->post("password")) {
			$verificar = $this->Sesion_model->verificarUsuario($_POST);
			if($verificar){
				$_SESSION["UsuarioID"] = $verificar->usuario;
				$_SESSION["UserName"]  = $verificar->nombre;
				redirect("ventas");
			} else {
				$_SESSION["mensaje"] = "Usuario o contraseña incorrectos";
				redirect("sesion");
			}
		} else {
			$_SESSION["mensaje"] = "Faltan datos para acceder";
			redirect("sesion");
		}
	}

	function cerrarSesion(){
		session_destroy();
		redirect("sesion");
	}
}
?>