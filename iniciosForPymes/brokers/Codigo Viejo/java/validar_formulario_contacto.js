$("#formulario_de_contacto").submit(function() {
	var titulo_contacto = $("#titulo_contacto").val();
	var nombres_us = $("#nombres_us").val();
	var apellidos_us = $("#apellidos_us").val();
	var correo_contac = $("#correo_contac").val();
	var summernote = $("#summernote").val();

	if (titulo_contacto == '' || titulo_contacto == 0) {
        $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
        burbuja_error('Por favor escriba el título del mensaje','#cont_error_titulo_contact_us','.contenedor_cabecera_forms');
        $("#titulo_contacto").focus();
        return false;
	}else{
		if (titulo_contacto.length <= 3 || titulo_contacto.length > 50) {
            $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
            burbuja_error('Su título debe contener mínimo 4 caracteres, máximo 50','#cont_error_titulo_contact_us','.contenedor_cabecera_forms');
            $("#titulo_contacto").focus();
            return false;
		}else{
			if (nombres_us == '' || nombres_us == 0) {
                $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                burbuja_error('Por favor digite su nombre correctamente','#cont_error_nombre_contact_us','.contenedor_cabecera_forms');
                $("#nombres_us").focus();
                return false;
            }else{
            	if (nombres_us.length <= 2 || nombres_us.length > 30) {
                    $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                    burbuja_error('Su nombre debe contener mínimo 3 caracteres, máximo 30','#cont_error_nombre_contact_us','.contenedor_cabecera_forms');
                    $("#nombres_us").focus();
                    return false;
                }else{
                	if (apellidos_us == '' || apellidos_us == 0) {
                        $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                        burbuja_error('Por favor digite su apellido correctamente','#cont_error_apellido_contact_us','.contenedor_cabecera_forms');
                        $("#apellidos_us").focus();
                        return false;
                    }else{
                    	if (apellidos_us.length <= 2 || apellidos_us.length > 30) {
                            $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                            burbuja_error('Su apellido debe contener mínimo 3 caracteres, máximo 30','#cont_error_apellido_contact_us','.contenedor_cabecera_forms');
                            $("#apellidos_us").focus();
                            return false;
                        }else{
                        	if (correo_contac == '' || correo_contac == 0 || correo_contac.indexOf('@') == false) {
                                $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                                burbuja_error('Por favor digite su correo electrónico correctamente','#cont_error_email_contact_us','.contenedor_cabecera_forms');
                                $("#correo_contac").focus();
                                return false;
                            }else{
                            	if (correo_contac.length <= 4 || correo_contac.length > 50) {
                                    $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                                    burbuja_error('Su correo electrónico debe contener mínimo 5 caracteres, máximo 50','#cont_error_email_contact_us','.contenedor_cabecera_forms');
                                    $("#correo_contac").focus();
                                    return false;
                                }else{
                                	if (summernote == '' || summernote == 0) {
	                                    $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
	                                    burbuja_error('Por favor escriba un mensaje','#cont_error_mensaje_contact_us','#nombres_us');
	                                    $("#summernote").focus();
	                                    return false;
                                	}else{
                                		if (summernote.length <= 30) {
                                            $('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                                            burbuja_error('Su mensaje debe contener mínimo 30 caracteres','#cont_error_mensaje_contact_us','#nombres_us');
	                                        $("#summernote").focus();
	                                        return false;
                                		}else{
                                			$('#cont_error_titulo_contact_us').fadeOut(600);$('#cont_error_nombre_contact_us').fadeOut(600);$('#cont_error_apellido_contact_us').fadeOut(600);$('#cont_error_email_contact_us').fadeOut(600);$('#cont_error_mensaje_contact_us').fadeOut(600);
                                			return true;
                                		}
                                	}
                                }
                            }
                        }
                    }
                }
            }
		}
	}
});