function cargarCobro(venta){
	var url = base_url("index.php/pedido/formcobrar/"+venta);
	cerrar("resumencont","cobrarform");

	$.post(url, function(data){
		document.getElementById("contCobrar").innerHTML = data;
	})
}

$(document).on("submit", "#formCobrar", function(event){
	event.preventDefault();
	cerrar("","cobrarform");
	var url = this.action;
	var datos = $(this).serialize();

	$.post(url, datos, function(data){
		document.getElementById("contCobrar").innerHTML = data;
	})
})