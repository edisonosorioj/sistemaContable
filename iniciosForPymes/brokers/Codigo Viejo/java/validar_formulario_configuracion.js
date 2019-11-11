
function desplegar_campos_situacion_laboral(){
	var cod_situacion_laboral = $('#situacion_us_laboral').val();
	if (cod_situacion_laboral == '' || cod_situacion_laboral == 0) {
        $('#contenedor_campos_empleado').fadeOut(600);
	    $('#contenedor_campos_independiente').fadeOut(600);
	    $('#contenedor_campos_empleo_otro').fadeOut(600);
	}else{
		if (cod_situacion_laboral == 1) {
			$('#contenedor_campos_empleado').fadeIn(600);
			$('#contenedor_campos_independiente').fadeOut(600);
			$('#contenedor_campos_empleo_otro').fadeOut(600);
		}else{
			if (cod_situacion_laboral == 2) {
				$('#contenedor_campos_empleado').fadeOut(600);
			    $('#contenedor_campos_independiente').fadeIn(600);
			    $('#contenedor_campos_empleo_otro').fadeOut(600);
			}else{
				if (cod_situacion_laboral == 3) {
					$('#contenedor_campos_empleado').fadeOut(600);
			        $('#contenedor_campos_independiente').fadeOut(600);
			        $('#contenedor_campos_empleo_otro').fadeIn(600);
				}
			}
		}
	}
}

function desplegar_campos_estado_civil(){
	var cod_estado_civil = $('#estado_civil_config').val();
	if (cod_estado_civil == 1 || cod_estado_civil == 6) {
		$('#campos_config_estado_civil').fadeIn(600);
	}else{
        $('#campos_config_estado_civil').fadeOut(600);
        $('#situacion_us_laboral_conyuge').fadeOut(600);
	}
}

function desplegar_campos_situacion_laboral_conyuge(){
	var cod_situacion_laboral_conyuge = $('#situacion_laboral_conyuge_config').val();
	if (cod_situacion_laboral_conyuge == 1) {
		$('#situacion_us_laboral_conyuge').fadeIn(600);
	}else{
		$('#situacion_us_laboral_conyuge').fadeOut(600);
	}
}

function desplegar_campos_bien_propiedad(){
	var propiedad_adquirida_select = $('#propiedad_adquirida_select').val();
	if (propiedad_adquirida_select == 1) {
		$('#propiedades_adquiridas_us_config').fadeIn(600);
	}else{
		$('#propiedades_adquiridas_us_config').fadeOut(600);
	}
}

function desplegar_campos_bien_vehiculo(){
	var vehiculo_adquirido_us_config = $('#vehiculo_adquirido_us_config').val();
	if (vehiculo_adquirido_us_config == 1) {
		$('#vehiculos_adquiridos_us_config').fadeIn(600);
	}else{
		$('#vehiculos_adquiridos_us_config').fadeOut(600);
	}
}

function desplegar_campos_operacion_internacional(){
	var operaciones_internacionales_us_config = $('#operaciones_internacionales_us_config').val();
	if (operaciones_internacionales_us_config == 1) {
		$('#campos_operaciones_internacionales').fadeIn(600);
	}else{
		$('#campos_operaciones_internacionales').fadeOut(600);
	}
}

function estado_select_pais_dep(){
    var pais_us = $("#pais_us").val();
    var departamento_us = $("#departamento_us").val();
    if (pais_us == '' || pais_us == 0) {
        $('#departamento_us').prop('disabled', true);
        $('#departamento_us').val('0');
        $('#ciudad_us').prop('disabled', true);
        $('#ciudad_us').val('0');
    }
    if (departamento_us == '' || departamento_us == 0) {
        $('#ciudad_us').prop('disabled', true);
        $('#ciudad_us').val('0');
    }
}