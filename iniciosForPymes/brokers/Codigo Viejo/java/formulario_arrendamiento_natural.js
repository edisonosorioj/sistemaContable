	$(document).ready(function(){

		$("#situacion_laboral_conyuge_campos").hide();
		$("#situacion_labora_codeudor_uno").hide();
		$("#situacion_labora_codeudor_dos").hide();
		$("#otros_ingresos_codeudor_uno").hide();
		$("#Mensaje_informativo_de_clausula").hide();
		$("#otros_ingresos_codeudor_dos").hide();
        $("#Mensaje_informativo_de_clausula_codeudor_dos").hide();
		/*oculta sección de formulario de la situación laboral del conyuge*/
       $("#situacion_laboral_conyuge").change( function() {
        if ($(this).val() === "1" || $(this).val() === "6" ) {
            $("#situacion_laboral_conyuge_campos").show("swing");
        } else {
            $("#situacion_laboral_conyuge_campos").hide("linear");
        }
        })
       /*ocultar seccion de formulario de la situacion laboral del codeudor 1*/
        $("#trabaja_codeudor_uno").change( function() {
        if ($(this).val() === "1") {
            $("#situacion_labora_codeudor_uno").show("swing");
            $("#otros_ingresos_codeudor_uno").hide();
            $("#Mensaje_informativo_de_clausula").hide();
        }
        else if($(this).val() === "3"){
        	$("#otros_ingresos_codeudor_uno").show();
        	$("#Mensaje_informativo_de_clausula").hide();
        } else {
            $("#situacion_labora_codeudor_uno").hide("linear");
            $("#otros_ingresos_codeudor_uno").hide();
            $("#Mensaje_informativo_de_clausula").show();
        }
    	


    })
       
       	/*ocultar seccion de formulario de la situacion laboral del codeudor 2*/
        $("#trabajo_codeudor2_solicitante").change( function() {
        if ($(this).val() === "1") {
            $("#situacion_labora_codeudor_dos").show("swing");
            $("#otros_ingresos_codeudor_dos").hide();
            $("#Mensaje_informativo_de_clausula_codeudor_dos").hide();
        }
        else if($(this).val() === "3"){
        	$("#otros_ingresos_codeudor_dos").show();
        	$("#Mensaje_informativo_de_clausula_codeudor_dos").hide();
        } else {
            $("#situacion_labora_codeudor_dos").hide("linear");
            $("#otros_ingresos_codeudor_dos").hide();
            $("#Mensaje_informativo_de_clausula_codeudor_dos").show();
        }
    	
    })
        
    })
