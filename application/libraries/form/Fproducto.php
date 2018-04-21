<?php 
class Fproducto {
	private $args;
	private $accion;
	private $pdato;

	function __construct(){
		$this->datos = array();
		$this->clase = "form-control";
		$this->labcl = array("class" => "col-sm-2 control-label"); 
	}

	function setdatoproducto($args=array()){
		$this->pdato = $args;
	}

	function setUrl($url){
		$this->accion = $url;
	}

	function label($nombre){
		$nom = str_replace(" ", "", strtolower($nombre));
		$this->datos["lab_{$nom}"] = form_label(
			$nombre,
			$nom,
			$this->labcl
		);

		return $this->datos;
	}

	function openform(){
		$this->datos['openform'] = form_open(
			$this->accion,
			array(
				"method" => "POST",
				"class"  => "form-horizontal",
				"id"     => "FxormProducto"
			)
		);
	}
	function nombre(){
		$this->label("Nombre");
		$this->datos['nombre'] = form_input(
			array(
				"id"    => "nombre",
				"name"  => "nombre",
				"class" => "form-control"
			),
			(($this->pdato)?$this->pdato->nombre:"")
		);
	}

	function codigoalterno(){
		$this->label("Codigo Alterno");
		$this->datos['codigoalterno'] = form_input(
			array(
				"id"    => "codigoalterno",
				"name"  => "codigo_alterno",
				"class" => "form-control"
			),
			(($this->pdato)?$this->pdato->codigo_alterno:"")
		);
	}

	function precio_original(){
		$this->label("Precio Compra");
		$this->datos['preciocompra'] = form_input(
			array(
				"id"    => "preciocompra",
				"name"  => "precio_original",
				"class" => "form-control",
				"type"  => "number",
				"steep" => "0.01"
			),
			(($this->pdato)?$this->pdato->precio_original:"")
		);
	}

	function precio_venta(){
		$this->label("Precio Venta");
		$this->datos['precioventa'] = form_input(
			array(
				"id"    => "precioventa",
				"name"  => "precio_venta",
				"class" => "form-control",
				"type"  => "number",
				"steep" => "0.01"
			),
			(($this->pdato)?$this->pdato->precio_venta:"")
		);
	}

	function cantidad(){
		$this->label("Cantidad");
		$this->datos['cantidad'] = form_input(
			array(
				"id"    => "cantidad",
				"name"  => "cantidad",
				"class" => "form-control",
				"type"  => "number"
			),
			(($this->pdato)?$this->pdato->cantidad:"")
		);
	}

	function button(){
		$this->datos['button'] = form_button(
			array(
				"id"    => "btnGuardar",
				"class" => "btn btn-sm btn-info",
				"type"  => "submit"
			),
			"<i class='glyphicon glyphicon-floppy-disk'></i> Guardar"
		);
	}

	function closeform(){
		$this->datos['closeform'] = form_close();
	}

	function crear(){
		$this->openform();
		$this->nombre();
		$this->codigoalterno();
		$this->precio_original();
		$this->precio_venta();
		$this->cantidad();
		$this->button();
		$this->closeform();

		return $this->datos;
	}
}
?>