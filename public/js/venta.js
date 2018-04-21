function cargarVenta(venta='', opc=''){
	$("#numeroventa").html(venta);
	cerrar("cobrarform","resumencont");

	var descuento = document.querySelector("#descuentoProducto");
	if(descuento){
		$("#descuentoProducto").hide();
	}

	if (opc) {
		var url = base_url("index.php/ventas/Ventascreadas/");
		$.post(url, function(data) {
			document.getElementById("Listapestanias").innerHTML = data;
		})
	}

	cargaAtributos(venta);
}

function cargaAtributos(venta){
	cargarformCaptura(venta);
	cargarListaProductos(venta);
	cargarResumen(venta);
}

function nuevaVenta(){
	activarBoton("btncrea","Creando...");
	$.confirm({
		keyboardEnabled: true,
	    title: 'Nueva Venta',
	    content: '¿Está seguro de continuar?',
	    confirmButton: 'SI',
    	cancelButton: 'NO',
	    confirm: function(){
	    	var url = base_url("index.php/pedido");

	    	$.post(url, function(data) {
	    		notificar(data.exito, data.mensaje);
	    		cargarVenta(data.venta,1);

	    	})
	    },
	    cancel: function(){
	    	$("#btncrea").button('reset');
	    }
	});
}

function cargarformCaptura(venta){
	var url = base_url("index.php/ventas/formcaptura/"+venta);
	$.post(url, function(data){
		document.getElementById("formCaptura").innerHTML = data;
	})
}

function cargarListaProductos(venta){
	var url = base_url("index.php/ventas/listaventaproducto/"+venta);
	$.post(url, function(data){
		document.getElementById("ventaProductos").innerHTML = data;
	})
}

function cargarResumen(venta){
	var url = base_url("index.php/ventas/resumenventa/"+venta);
	$.post(url, function(data){
		document.getElementById("contResumen").innerHTML = data;
	})
}

$(document).on("submit", "form#formGuardar",function(e){
	e.preventDefault();

	var url = this.action;
	var datos = $(this).serialize();

	$.post(url, datos, function(data) {
		notificar(data.exito,data.mensaje);
		cargarVenta(data.venta);
		document.getElementById("codigo").value = "";
	})
})

function cargardescuento(venta,producto){
	var url = base_url("index.php/ventas/aplicadescuento/")+venta;
	$("#descuentoProducto").show();
	verCargando("descuentoProducto",1);

	$.post(url, {'producto': producto}, function(data){
		document.getElementById("descuentoProducto").innerHTML = data;
	})
}

$(document).on("click", "#aplica", function(){
	if($(this).is(":checked")){
		$("#cantidad").attr({"readonly":"readonly"});
		$("#cantidad").removeAttr("onblur");
		$("#cantidad").val(this.value);
		xdescuento();
	} else {
		$("#cantidad").removeAttr("readonly","onblur");
		$("#cantidad").attr({"onblur":"xdescuento()"});
	}
})

function xdescuento(){
	var precio     = document.getElementById("precio").value;
	var cantidad   = document.getElementById("cantidad").value;
	var porcentaje = document.getElementById("porcentaje").value;
	var subtotal   = document.getElementById("subtotal").value;


	var descuento  = ((precio * cantidad) * porcentaje) / 100;
	var total      = subtotal - descuento;

	document.getElementById("totaldesc").value = descuento;
	document.getElementById("total").value = total;
	if (porcentaje == 0){
		document.getElementById("cantidad").value = 0;
	}

}

function eleminarProducto(venta, producto){
	var comple = venta+"/"+producto;

	$.confirm({
		keyboardEnabled: true,
		title: 'Eliminar producto',
		confirmButton: 'Aceptar',
	    cancelButton: 'Cancelar',
	    content: function() {
	        var self = this;
	        return $.ajax({
				url: base_url("index.php/ventas/form_eliminar/"),
				data: ({"venta":venta, "producto":producto}),
				method: 'post'
	        }).done(function (response) {
	            self.setContent(response);
	        }).fail(function(){
	            self.setContent("Error al eliminar archivo");
	        });
	    },
	    confirm: function(){
			var unico   = this.$content.find('input#unico').val();
			var cantidad = this.$content.find('input#cantidad').val();
			var todo = "";
			if(this.$content.find('input#todo').is(":checked")){
				var todo =  this.$content.find('input#todo').val();
			}

			var url    = base_url("index.php/ventas/eliminarproducto");
			var datos  = {
						"todo":todo,
						"unico":unico,
						"cantidad":cantidad,
						"venta": venta,
						"producto": producto
						};

			$.post(url, datos, function(data){
				notificar(data.exito, data.mensaje);
				cargarVenta(data.venta);
			})
	    }
	});
}

function accionVenta(venta, opcion){
	switch(opcion){
		case 1:
			var titulo = "Campo Cantidad";
			var conte  = "¿Está seguro de habilitar o deshabilitar este campo?"
		break;
		case 2:
			var titulo = "Reinicar Venta "+venta;
			var conte  = "Si se reinicia perderá todo lo ingresado ¿Está seguro de continuar?"
		break;
		case 3:
			var titulo = "Anular Venta" + venta;
			var conte  = "¿Está seguo de anular la venta?"
		break;
	}
	$.confirm({
		keyboardEnabled: true,
		title: titulo,
		content: conte,
		confirmButton:"SI",
		cancelButton:"NO",
		confirm: function(){
			var comple = venta+"/"+opcion;
			var url = base_url("index.php/ventas/accionventa/"+comple);
			$.post(url, function(data){
				notificar(data.exito, data.mensaje);
				var opc = (opcion == 3)? 1: '';
				var ven = (opcion == 3)? data.venta : venta;
				cargarVenta(ven,opc);
			})
		}
	})
}