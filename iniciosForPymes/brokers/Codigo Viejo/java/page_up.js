$( document ).ready(function() {
    var alto_pantalla_a = $('#altura_ventana').height() / 2;

    $(window).on('scroll', function(){
		if ($(window).scrollTop() > alto_pantalla_a) {
	    	$('#button_up_pag').fadeIn(600);
	    }else{
	    	$('#button_up_pag').fadeOut(600);
	    }
	});
});
function desplazar_pagina_arriba(){
	$('html, body').animate({ scrollTop: $('body').offset().top }, 1000);
}