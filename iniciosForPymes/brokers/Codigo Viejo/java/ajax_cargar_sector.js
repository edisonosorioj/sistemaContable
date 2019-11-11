function cargar_sector_ciudad(){
	var ciudad_us = $('#cargar_ciudad').val();
	if (ciudad_us == 0) {
		$("#cargar_sectores").prop( "disabled", true );
	}else{
		$.ajax({
	        type:"POST",
	        url:"https://www.brokersfast.com.co/integrados/ajax/cargar_sector.php",
	        data:{ciudad:$('#cargar_ciudad').val()},
	        success:function(re){
	          $("#cargar_sectores").prop( "disabled", false );
	          $('#cargar_sectores').html(re).fadeIn(600);
	        },
	        error:function(xhr,status){ alert("se produjo un error"); }
        });
	}
}