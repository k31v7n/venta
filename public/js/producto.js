function abrirProducto(venta){
	var url = base_url("index.php/producto");
	var datos = {"venta":venta};
	verCargando("ventaProductos", 1);

	$.post(url, datos, function(data){
		document.getElementById("ventaProductos").innerHTML = data;
	})
	setTimeout(function(){buscarProducto();}, 10);
}

function buscarProducto(cate=""){
	var url = base_url("index.php/producto/buscar/"+cate);
	$.post(url, function(data){
		document.getElementById("ListaProducto").innerHTML = data;
	})
}

$(document).on("click",".catego", function(){
	$(".categorias li").removeClass("blanco");
	$(this).addClass("blanco");
})