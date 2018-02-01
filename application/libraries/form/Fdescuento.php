<?php

class Fdescuento
{

	protected $producto;
	protected $accion;

	public function __construct(){
		$this->procs    = & get_instance();
		$this->clase    = 'form-control';
		$this->datos    = array();
		$this->labclas  = array('class' => 'col-sm-2 control-label');
	}

	public function setproducto($producto){
		$this->producto = $producto;
	}

	public function setaccion($url){
		$this->accion = $url;
	}

	private function open(){
		$this->datos['open'] = form_open(
			$this->accion,
			array(
				"id"     => "formGuardar",
				"class"  => "form-horizontal",
				"method" => "post"
				)
		);
	}

	private function precio(){
		$this->datos['lab_precio'] = form_label(
			'Precio Venta',
			'precio',
			$this->labclas
		);

		$this->datos['precio'] = form_input(
			array(
				'id'       => 'precio',
				'name'     => 'precioventa',
				'class'    => $this->clase,
				'type'     => 'number',
				'step'     => '0.01',
				'readonly' => 'readonly',
				'value'    => (($this->producto) ? $this->producto->precioventa : 0)
			)
		);
	}

	private function subtotal(){
		$this->datos['lab_subtotal'] = form_label(
			'Subtotal',
			'subtotal',
			$this->labclas
		);

		$this->datos['subtotal'] = form_input(
			array(
				'id'       => 'subtotal',
				'name'     => 'subtotal',
				'class'    => $this->clase,
				'type'     => 'number',
				'step'     => '0.01',
				'readonly' => 'readonly',
				'value'    => (($this->producto) ? $this->producto->subtotal : 0)
			)
		);
	}

	private function porcentaje() {
		$this->datos['lab_porcentaje'] = form_label(
			'% Descuento',
			'porcentaje',
			$this->labclas
		);

		$this->datos['porcentaje'] = form_input(
			array(
				'id'     => 'porcentaje',
				'name'   => 'por_descuento',
				'class'  => $this->clase,
				'type'   => 'number',
				'step'   => '0.01',
				'onblur' => 'xdescuento()',
				'value'  => (($this->producto) ? $this->producto->por_descuento : 0)
			)
		);
	}

	private function totdescuento(){
		$this->datos['lab_totdescuento'] = form_label(
			'Total Descuento',
			'totaldesc',
			$this->labclas
		);

		$this->datos['totdescuento'] = form_input(
			array(
				'id'       => 'totaldesc',
				'name'     => 'descuento',
				'class'    => $this->clase,
				'type'     => 'number',
				'step'     => '0.01',
				'readonly' => 'readonly',
				'value'    => (($this->producto) ? $this->producto->descuento : 0)
			)
		);
	}

	private function cantidad() {
		$this->datos['lab_cantidad'] = form_label(
			'Cant. Producto',
			'cantidad',
			$this->labclas
		);


		$read['readonly'] = "readonly";
		if ($this->producto && $this->producto->cant_aplica){
			$read = array();
			$read['onblur']   = "xdescuento()";
		}
		$this->datos['cantidad'] = form_input(
			array_merge(
			array(
				'id'       => 'cantidad',
				'name'     => 'cant_aplica',
				'class'    => $this->clase,
				'type'     => 'number',
				'step'     => '0.01',
				'value'    => (($this->producto && $this->producto->cant_aplica) ? $this->producto->cant_aplica : $this->producto->cantidad)
			),
			$read
			)
		);
	}

	private function total(){
		$this->datos['lab_total'] = form_label(
			'Total',
			'total',
			$this->labclas
		);

		$this->datos['total'] = form_input(
			array(
				'id'       => 'total',
				'name'     => 'total',
				'class'    => $this->clase,
				'type'     => 'number',
				'step'     => '0.01',
				'readonly' => 'readonly',
				'value'    => (($this->producto) ? $this->producto->total : 0)
			)
		);
	}

	private function aplicar(){
		$this->datos["aplica"] = form_checkbox(
			array(
				"id"      => "aplica",
				"checked" => (($this->producto && $this->producto->cant_aplica) ? FALSE : TRUE),
				"value"   => (($this->producto) ? $this->producto->cantidad : 0)
			)
		);
	}

	private function close(){
		$this->datos['cerrar'] = form_close();
	}

	public function crear(){
		$this->open();
		$this->precio();
		$this->subtotal();
		$this->porcentaje();
		$this->totdescuento();
		$this->cantidad();
		$this->aplicar();
		$this->total();
		$this->close();
		return $this->datos;
	}
}
?>