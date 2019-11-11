function cargar_departamento(){
	var pais_us = $('#pais_cargar_departamento').val();
	if (pais_us == 0) {
		$("#departamento_cargar_ciudad").prop( "disabled", true );
		$("#cargar_ciudad").prop( "disabled", true );
	}else{
		$.ajax({
	        type:"POST",
	        url:"https://www.brokersfast.com.co/integrados/ajax/cargar_departamento.php",
	        data:{pais:$('#pais_cargar_departamento').val()},
	        success:function(r){
	          $("#departamento_cargar_ciudad").prop( "disabled", false );
	          $('#departamento_cargar_ciudad').html(r).fadeIn(600);
	        },
	        error:function(xhr,status){ alert("se produjo un error"); }
        });
	}
}

function cargar_expedicion_departamento(){
	var pais_exp_doc = $('#pais_expedicion_cargar_departamento').val();
	if (pais_exp_doc == 0) { 
		$("#departamento_expedicion_cargar_ciudad").prop( "disabled", true );
		$("#cargar_expedicion_ciudad").prop( "disabled", true );
	}else{
		$.ajax({
	        type:"POST",
	        url:"https://www.brokersfast.com.co/integrados/ajax/cargar_departamento.php",
	        data:{pais:$('#pais_expedicion_cargar_departamento').val()},
	        success:function(r){
	          $("#departamento_expedicion_cargar_ciudad").prop( "disabled", false );
	          $('#departamento_expedicion_cargar_ciudad').html(r).fadeIn(600);
	        },
	        error:function(xhr,status){ alert("se produjo un error"); }
        });
	}
}