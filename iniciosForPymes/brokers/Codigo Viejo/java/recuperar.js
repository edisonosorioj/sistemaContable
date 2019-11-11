function desplegar_form_recover(valor){

    $("#cont_cabecera_form_recover").html('<div><img src="./imagenes/iconos/contacto.png"/></div><p>Por favor escriba su correo electrónico registrado.</p>');
    $('#cont_form_recover_select').fadeOut(600);

	if (valor == 1) { $('#formulario_de_recupercion_activacion').fadeIn(600); }else{ if (valor == 2) { $('#formulario_de_recupercion').fadeIn(600); } }

}