<?php
class Producto extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(login()){
			$this->load->model(array("Venta_model","Producto_model"));
			$this->datos['scripts'] = array(
                    (object)array('ruta' => 'public/js/producto.js', 'print' => TRUE));
		} else {
			redirect("sesion");
		}
		
	}

	function index(){
		$this->datos["venta"]     = $this->input->post("venta");
		$this->datos["categoria"] = $this->Producto_model->getcategoria();
		$this->datos["accion"]    = base_url("index.php/producto/buscar");
		$this->datos["productos"] = $this->Producto_model->getProductos(array("inicio" => 0));
		$limite = 10;
		$registros = count($this->datos["productos"]);
		if (count($this->datos["productos"]) == $limite)
		{
			$this->datos["vermas"] = $registros;
		}

		$this->load->view("categoria/cuerpo", $this->datos);
	}

	function buscar(){
		$this->datos["productos"] = $this->Producto_model->getProductos($_POST);
		$limite = 10;
		$registros = count($this->datos["productos"]);
		if (count($this->datos["productos"]) == $limite)
		{
			$this->datos["vermas"] = $registros;
		}

		$this->load->view("categoria/lista", $this->datos);
	}

	function agregarproducto($venta){
		$ven = new Venta_model($venta);
		$mensaje = '';
		$exito   = true;

		foreach($_POST['item'] as $row){
			$ven->verProducto($row['codigo']);
			$ven->verProductoAgregado($ven->producto->producto);
			$cantidad = $row['cantidad'];

			$ars['cantidad']     = $row['cantidad'];
			$ars['subtotal']     = $row['precio'] * $cantidad;
			$ars['total']        = $ars['subtotal'];
			$ars['precioventa'] = $row['precio'];

			if (!empty($ven->agregado)){
				$ncantidad       = $ven->agregado->cantidad + $cantidad;
				$ars['cantidad'] = $ncantidad;
				$ars['subtotal'] = $ven->agregado->precioventa * $ncantidad;
				$ars['total']    = $ars['subtotal'] - $ven->agregado->descuento;
			}

			if ($ven->agregarProducto($ars)){
				$mensaje .= "Producto {$ven->producto->codigo}, agregado<br>";
			} else {
				$mensaje .= $ven->getMensaje()."<br>";
				$exito   = false;
			}
		}

		$this->datos["mensaje"] = $mensaje;
		$this->datos["exito"]   = $exito;
		$this->datos["venta"]   = $venta;

		enviarJSON($this->datos);
	}

	function mantenimiento(){
		$this->datos["menu"]      = "menu";
		$this->datos["vista"]     = "producto/cuerpo";
		$this->datos["categoria"] = $this->Producto_model->getcategoria();
		$this->load->view("principal", $this->datos);
	}

	function form_categoria($categoria=""){
		$ca = new Producto_model($categoria);
		$datos['categoria'] = $ca->cate;
		$datos['accion']    = base_url("index.php/producto/guardacategoria/{$categoria}");

		$this->load->view("producto/form_categoria", $datos);
	}

	function listacategoria(){
		$datos["categoria"]  = $this->Producto_model->getcategoria();
		$this->load->view("producto/clista", $datos);
	}

	function guardacategoria($categoria=""){
		$ca = new Producto_model($categoria);
		$dato["exito"]    = 0;
		$dato["registro"] = $categoria;
		$dato["opcion"]   = 1;

		if(verDatos($_POST, "nombre")){
			if($ca->guardaCategaria($_POST)){
				$dato["mensaje"] = "Se guardó la categoria {$ca->cate->nombre}";
				$dato["exito"]	= 1;
				$dato["registro"] = $ca->cate->categoria;
			} else {
				$dato["mensaje"] = $ca->getmensaje();
			}
		}
		enviarJSON($dato);
	}

	function listaproductos($categoria){
		$this->datos['lista'] = $this->Producto_model->getProductos($_POST);
		$this->load->view("producto/plista", $this->datos);
	}

	function nuevoproducto($producto=""){
		$pro = new Producto_model($this->input->post("categoria"));
		$this->datos['ncategoria'] = $pro->cate->nombre;
		$this->load->library("form/Fproducto");
		$p = new Fproducto();
		$p->setUrl(base_url("index.php/producto/guardaproducto/{$pro->cate->categoria}/{$producto}"));	
		$p->setdatoproducto($pro->verunProducto($producto));
		$ver = array_merge($this->datos, $p->crear());
		$this->load->view("producto/form_producto", $ver);
	}

	function guardaproducto($categoria, $producto=""){
		$pro = new Producto_model($categoria);
		$pro->verunProducto($producto);
		$data['exito']    = 0;
		$dato["registro"] = $categoria;
		$dato["opcion"]   = 5;
		if($pro->guardaproducto($_POST)) {
			$mensaje = "Se actualizó la lista de productos";
			$data['exito'] = 1;
			$data['opcion'] = 5;
			$data['producto'] = $pro->producto->producto;
			$dato["registro"] = $pro->producto->categoria;
		} else {
			$mensaje = $pro->getmensaje();
		}
		$data['mensaje'] = $mensaje;
		enviarJSON($data);
	}
}
?>