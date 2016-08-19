
//Session
$(function(){
	$('#button_send').live('click',function(){
		var f = $('#login_form');
		var l = f.find('#login');		
		var p = f.find('#password');
		var error = false;

		if(l.val() == ''){
			error = true;
			alert('Debes poner el login');
		}

		if(p.val() == ''){
			error = true;
			alert('Debes poner el password');
		}

		if(error == false){
			f.submit();	
		}
		
	});

});


//General
$(function(){
	$("#search").keyup(function(){
		if($(this).val() != ""){
			$("#table_result #rows").hide();
			$("#table_result td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else{
			$("#table_result #rows").show();
		}
	});
});

$.extend($.expr[":"], 
{
    "contains-ci": function(elem, i, match, array) 
	{
		return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
	}
});

//Inicio

$(".menu").mouseover(function() {

	$(this).animate({ backgroundColor: "#2e374b" }, 200);

	}).mouseout(function() {

    	$(this).animate({ backgroundColor: "#4267b2" }, 200);

	});

$(function(){
	$('#ini-desde').on('change', function(){
		var desde = $('#ini-desde').val();
		var hasta = $('#ini-hasta').val();
		var url = '../php/TotalEgresoIngreso.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#tablaTotal').html(datos);
		}
	});
	return false;
	});
	
	$('#ini-hasta').on('change', function(){
		var desde = $('#ini-desde').val();
		var hasta = $('#ini-hasta').val();
		var url = '../php/TotalEgresoIngreso.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#tablaTotal').html(datos);
		}
	});
	return false;
	});

});


//Clientes
$("#new").click(function(evento){
        evento.preventDefault();
        $("#destino").load("../html/form.html");
  });


function hideForm(){
	$('#formadd').hide();
}


//Egresos

$("#newCompra").click(function(evento){
        evento.preventDefault();
        $("#destino").load("../html/formCompras.html");
});


//Creditos

// $("#newCredito").click(function(evento){
//         evento.preventDefault();
//         $("#destino").load("../html/formCredito.html");
// });


//Ingresos

$("#newIngreso").click(function(evento){
        evento.preventDefault();
        $("#destino").load("../html/formIngreso.php");
});

$(function(){
	$('#bd-desde').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../php/busca_ingreso_fecha.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
	$('#bd-hasta').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../php/busca_ingreso_fecha.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});


});

