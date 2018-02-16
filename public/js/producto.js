function abrirProducto(venta){
	var url = base_url("index.php/producto");
	var datos = {"venta":venta};
	verCargando("ventaProductos", 1);

	$.post(url, datos, function(data){
		document.getElementById("ventaProductos").innerHTML = data;
	})
}

function asignar($cate=""){
	$("#categoria").val($cate);
	$("#inpBuscar").val("");
	buscarProducto();
}

function buscarProducto(){
	$("#inicio").val(0);
	var url   = $("#formProducto").attr("action");
	var datos = $("#formProducto").serialize();

	$.post(url, datos, function(data){
		document.getElementById("ListaProducto").innerHTML = data;
	})
}

$(document).on("click",".catego", function(){
	$(".categorias li").removeClass("blanco");
	$(this).addClass("blanco");
})

function agregarProducto(venta){
	if($(".item-pro").is(":checked")) {
	var item = [];
	$(".item-pro:checked").each(function(){
		var corre = $(this).attr("corre");
		var dato = {
					"codigo"   :$(this).attr("value"),
					"precio"   :$("#precio"+corre).val(),
					"cantidad" :$("#cantidad"+corre).val()
					};
		item.push(dato);
	})
	var datos = {'item':item};
} else {
	notificar(0,"Seleccione un producto");
}
	var url = base_url("index.php/producto/agregarproducto/"+venta);
	$.post(url, datos, function(data){
		notificar(data.exito, data.mensaje);
		if(data.exito){
			cargarListaProductos(data.venta);
			cargarResumen(data.venta);
		}
	})
}

function proBuscar(){
	buscarProducto();
}

function cargarMas(reg){
	var inicio = parseInt($("#inicio").val()) + reg;
	$("#inicio").val(inicio);

	$("#textmas").html("Cargando...");
	
	var url   = $("#formProducto").attr("action");
	var datos = $("#formProducto").serialize();

	$.post(url, datos, function(data){
		$("#vermas").remove();
		$("#ListaProducto").append(data);
	})

}
