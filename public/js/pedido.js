function cargarCobro(venta){
	var url = base_url("index.php/pedido/formcobrar/"+venta);
	$(".btnV").removeAttr("disabled");

	verCargando("ventaProductos",1);
	$.post(url, function(data){
		document.getElementById("ventaProductos").innerHTML = data;
		formpago(venta);
	})
}

$(document).on("submit", "#formCobrar", function(event){
	event.preventDefault();

	var url = this.action;
	var datos = $(this).serialize();

	$.post(url, datos, function(data){
		document.getElementById("ventaProductos").innerHTML = data;
	})
})

function formpago(venta){
	var url = base_url("index.php/pedido/formtipopago/"+venta);
	$.post(url, function(data){
		document.getElementById("Formpagox").innerHTML = data;
	})
}

function agregapago(venta, pago=''){
	var tipo  = document.getElementById("pago").value;
	var monto = document.getElementById("monto").value;
	if((tipo && monto) || pago){
		var url = base_url("index.php/pedido/guardapago");
		if(!pago){
			var datos = {
						"tipo_pago":tipo,
						"monto"    :monto,
						"venta"    :venta
						};
		} else {
			var datos = {
						"pago"    : pago,
						"anulado" : 1
						};
		}
		$.post(url, datos, function(data){
			notificar(data.exito, data.mensaje);
			formpago(venta);
		})
	} else {
		alerta({
			"titulo":"Pago", 
			"mensaje":"Es necesario seleccionar una forma de pago y asignar un monto"});
	}
	
}