function base_url(url){
	var base = window.location.origin+"/venta/";
	return base+url;
}

function verCargando(id,opc){
	var url = base_url('public/img/cargando.gif');
	var eti = "<img src='"+url+"' alt=''>";

	switch(opc){
		case 1:
			var img = "<p class='text-center'>"+eti+"</p>";
			break;
		case 2:
			var img = "<tr><td colspan='100%' class='text-center'>"+eti+"</td></tr>";
			break;
		default:
			var img = "<p class='text-center'>Cargando ...</p>";
			break;
	}

	document.getElementById(id).innerHTML = img;
}

$(document).on("click", ".vetsopc", function(){
	$(".opc-vent li").removeClass("activa activas");
	$(this).addClass("activas");
})


function paraPestanias(){
    var tam = window.innerWidth.toString();
    if (tam <= 767){
      	$(".ventanas").attr({"data-toggle":"collapse","data-target":"#myNavbar"});
      } else {
      	$(".ventanas").removeAttr("data-toggle","data-target");
      }
}

$(window).resize(function(){
	paraPestanias();
})

$(document).ready(function(){
	if($(window).width() <= 767){
		$(".ventanas").attr({"data-toggle":"collapse","data-target":"#myNavbar"});
	} else {
      	$(".ventanas").removeAttr("data-toggle","data-target");
     }
})

function notificar(tipo,mensaje){
	var xtipo = (tipo == 1) ? "success" : "error";
	$.notify(mensaje,xtipo);
}

function activarBoton(id, texto) {
  $("#" + id).attr("data-loading-text", texto);
  $("#" + id).button('loading');
}

function cerrar(id1="", id2=""){
	if (id1) {
		$("#"+id1).hide();
	}

	if (id2){
		$("#"+id2).show();
	}
}