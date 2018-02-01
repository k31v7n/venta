<?php
if (! function_exists('verDatos')) {
	function verDatos($arre, $dato) {
		if (isset($arre[$dato]) && (!empty($arre[$dato]) || ($arre[$dato]==0)) ) {
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
?>