<?php
if (! function_exists('verDatos')) {
	function verDatos($arre, $dato) {
		if (isset($arre[$dato]) && (!empty($arre[$dato]) || ($arre[$dato] == 0) || ($arre[$dato] == "")) ) {
			return true;
		}
		return false;
	}
}

if (! function_exists('enviarJSON')) {
	function enviarJSON($datos){
		header('Content-type: application/json');
		echo json_encode($datos);
	}
}

if (! function_exists('link_script'))
{
	function link_script($src, $print = FALSE)
	{
		if ($print) {
			$link = "<script type='text/javascript'>\n" . file_get_contents(base_url($src)) . "\n</script>\n";
		} else {
			$CI =& get_instance();
			$link = '<script type="text/javascript" ';

			if (preg_match('#^([a-z]+:)?//#i', $src))
			{
				$link .= 'src="'.$src.'" ';
			}
			else
			{
				$link .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
			}

			$link .= "></script>\n";
		}

		return $link;
	}
}

if(!function_exists('script')){
	function script(){
		$script = array(
                    (object)array('ruta' => 'public/js/venta.js', 'print' => TRUE),
                    (object)array('ruta' => 'public/js/pedido.js', 'print' => TRUE),
                    (object)array('ruta' => 'public/js/producto.js', 'print' => TRUE)
                );
		return $script;
	}
}


if ( ! function_exists('formatoFecha')) {
	function formatoFecha($fecha = '', $tipo = 1) {
		if (!empty($fecha)) {
			if ($fecha == "0000-00-00" || $fecha == ' "' || $fecha == '" ' || $fecha == '"') {
				return null;
			} else {
				switch ($tipo) {
					case 1:
						$formato = 'd/m/Y H:i:s';
						break;
					case 2:
						$formato = 'd/m/Y';
						break;
					case 3: 
						$fh = explode('/', $fecha);
						return $fh[2].'-'.$fh[1].'-'.$fh[0];
						break;
					default:
						$formato = 'Y-m-d';
						break;
				}
				$date = new DateTime($fecha);
				return $date->format($formato);
			}
		} else {
			return $fecha;
		}
	}

	if (! function_exists('login')) {
		function login(){
			if(isset($_SESSION["UsuarioID"])){
				return true;
			} else {
				return false;
			}
		}
	}
}
?>