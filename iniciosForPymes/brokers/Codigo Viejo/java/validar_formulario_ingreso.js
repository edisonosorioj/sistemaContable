$("#formulario_ingreso_us").submit(function() {
	var email_us_ingreso = $("#email_us_ingreso").val();
	var clave_us_ingreso = $("#clave_us_ingreso").val();

	if (email_us_ingreso == '' || email_us_ingreso == 0) {
		$('#cont_error_email_ingreso_us').fadeOut(600);$('#cont_error_pass_ingreso_us').fadeOut(600);
		burbuja_error('Por favor escriba el correo electronico registrado','#cont_error_email_ingreso_us','.contenedor_cabecera_forms_titulo');
        $("#email_us_ingreso").focus();
        return false;
	}else{
		if (email_us_ingreso.length <= 4 || email_us_ingreso.length > 50) {
			$('#cont_error_email_ingreso_us').fadeOut(600);$('#cont_error_pass_ingreso_us').fadeOut(600);
			burbuja_error('Su correo electrónico debe contener mínimo 5 caracteres, máximo 50','#cont_error_email_ingreso_us','.contenedor_cabecera_forms_titulo');
            $("#correo_contac").focus();
            return false;
		}else{
			if (clave_us_ingreso == '' || clave_us_ingreso == 0) {
				$('#cont_error_email_ingreso_us').fadeOut(600);$('#cont_error_pass_ingreso_us').fadeOut(600);
                burbuja_error('Por favor escriba su contraseña','#cont_error_pass_ingreso_us','.contenedor_cabecera_forms_titulo');
                $("#correo_contac").focus();
                return false;
			}else{
				if (clave_us_ingreso.length <= 3 || clave_us_ingreso.length > 10) {
					$('#cont_error_email_ingreso_us').fadeOut(600);$('#cont_error_pass_ingreso_us').fadeOut(600);
                    burbuja_error('Su contraseña debe contener mínimo 4 caracteres, máximo 10','#cont_error_pass_ingreso_us','.contenedor_cabecera_forms_titulo');
                    $("#correo_contac").focus();
                    return false;
				}else{
					$('#cont_error_email_ingreso_us').fadeOut(600);$('#cont_error_pass_ingreso_us').fadeOut(600);
					return true;
				}
			}
		}
	}

});