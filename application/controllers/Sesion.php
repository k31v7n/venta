<?php 
class Sesion extends CI_Controller
{
   public function __construct()
   {
      parent::__construct();
      $this->load->model("Sesion_model");
   }

   public function index()
   {
      if (!login()) {
         $this->load->view('principal', [
            'vista' => 'sesion/cuerpo',
            'accion' => base_url("index.php/sesion/iniciar")
         ]);
      } else {
         redirect("ventas");
      }
   }

   public function iniciar()
   {
      if ($this->input->post("usuario") && 
         $this->input->post("password")) {

         $verificar = $this->Sesion_model->verificarUsuario($_POST);

         if ($verificar) {
            $empresa = $this->Sesion_model->getEmpresaUsuario($verificar->empresa);

            if ($empresa) {
               $_SESSION["EmpresaID"]     = $empresa->empresa;
               $_SESSION["NombreEmpresa"] = $empresa->nombre;
               $_SESSION["UsuarioID"]     = $verificar->usuario;
               $_SESSION["UserName"]      = $verificar->nombre;
               redirect("ventas");
            } else {
               $_SESSION["mensaje"] = "No tiene ninguna empresa asignada";
               redirect("sesion");
            }
         } else {
            $_SESSION["mensaje"] = "Usuario o contraseña incorrectos";
            redirect("sesion");
         }
      } else {
         $_SESSION["mensaje"] = "Faltan datos para acceder";
         redirect("sesion");
      }
   }

   public function cerrarSesion()
   {
      session_destroy();
      redirect("sesion");
   }
}
?>