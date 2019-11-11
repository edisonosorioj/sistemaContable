function cargar_ciudades(){
	var departamento_us = $('#departamento_cargar_ciudad').val();
	if (departamento_us == 0) {
		$("#cargar_ciudad").prop( "disabled", true );
	}else{
		$.ajax({
	        type:"POST",
	        url:"https://www.brokersfast.com.co/integrados/ajax/cargar_ciudad.php",
	        data:{departamento:$('#departamento_cargar_ciudad').val()},
	        success:function(re){
	          $("#cargar_ciudad").prop( "disabled", false );
	          $('#cargar_ciudad').html(re).fadeIn(600);
	        },
	        error:function(xhr,status){ alert("se produjo un error"); }
        });
	}
}

function cargar_expedicion_ciudades(){
	var departamento_exp_doc = $('#departamento_expedicion_cargar_ciudad').val();
	if (departamento_exp_doc == 0) {
		$("#cargar_expedicion_ciudad").prop( "disabled", true );
	}else{
		$.ajax({
	        type:"POST",
	        url:"https://www.brokersfast.com.co/integrados/ajax/cargar_ciudad.php",
	        data:{departamento:$('#departamento_expedicion_cargar_ciudad').val()},
	        success:function(re){
	          $("#cargar_expedicion_ciudad").prop( "disabled", false );
	          $('#cargar_expedicion_ciudad').html(re).fadeIn(600);
	        },
	        error:function(xhr,status){ alert("se produjo un error"); }
        });
	}
}