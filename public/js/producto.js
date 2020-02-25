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

function 	abrirForm(args){
	var carga = 1;
	var datos = "";
	switch(args.opcion){
		case 1:
			var url = base_url("index.php/producto/form_categoria/");
			var id  = "Fcategoria";
			break;
		case 2:
			break;
		case 3:
			var url   = base_url("index.php/producto/listacategoria/");
			var id    = "clista";
			var carga = 2;
			break;
		case 4:
			var url   = base_url("index.php/producto/listaproductos/");
			var id    = "ListaProductos";
			var carga = 2;
			var datos = {"inicio":0,"categoria":args.registro};
			$("#xcategoria").val(args.registro);
			document.getElementById("nocategoria").innerHTML = args.nombre;
			cerrar('Fproducto');
			break;
		case 5:
			if($("#xcategoria").val() == '') {
				alerta({"titulo":"Producto","mensaje":"Es necesario seleccionar una categoria"});
				return false;
			}
			var url   = base_url("index.php/producto/nuevoproducto/");
			var id    = "Fproducto";
			var datos = {"categoria":$("#xcategoria").val()};
			break;
		default:
			break;
	}

	if (args.registro) {
		var url = url+args.registro;
	}
	verCargando(id,carga);

	$.post(url, datos, function(data){
		document.getElementById(id).innerHTML = data;
		abrir(id);
	})

}

$(document).on("submit","#FxormProducto", function(event){
	event.preventDefault();

	var url = this.action;
	var datos = $(this).serialize();
	activarBoton("btnGuardar","Guardando...");

	$.post(url, datos, function(data){
		notificar(data.exito, data.mensaje);
		abrirForm({"opcion":data.opcion,"registro":data.producto});
		abrirForm({"opcion":4,"registro":data.registro});
		abrirForm({"opcion":3})
	})
})