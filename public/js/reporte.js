function editaVenta(venta){
	var url = base_url("index.php/reporte/formedita/"+venta);
	$.post(url, function(data){
		document.getElementById("FormEditar").innerHTML = data;
	})
}

$(document).on("submit", "#FormGuardar", function(event){
	event.preventDefault();
	var url = this.action;
	var datos = $(this).serialize();
	$.post(url,datos, function(data){
		notificar(data.exito, data.mensaje);
	})
	buscar(true);
})

$(document).on("submit", "#FormBusca", function(event){
	event.preventDefault();
	buscar();
})

function buscar(rec=''){
	if(!rec){
		$("#inicio").val(0);
	}

	var url    = $("#FormBusca").attr("action");
	var datos  = $("#FormBusca").serialize();

	$.post(url,datos, function(data){
		document.getElementById("Listado").innerHTML = data;
	})
}

function cargarMas(cant){
	var inicio = parseInt($("#inicio").val()) + parseInt(cant);
	$("#inicio").val(inicio);

	var url    = $("#FormBusca").attr("action");
	var datos  = $("#FormBusca").serialize();

	$.post(url,datos, function(data){
		$("#verMas").remove();
		$("#Listado").append(data);
	})
}