function burbuja_error(texto,id_burbuja,scrolltop){
    $(id_burbuja).fadeIn(600);
    $(id_burbuja).html(texto);
    $('html, body').animate({ scrollTop: $(scrolltop).offset().top }, 1000);
}