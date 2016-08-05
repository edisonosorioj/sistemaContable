
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

//Clientes
$("#new").click(function(evento){
        evento.preventDefault();
        $("#destino").load("../html/form.html");
  });


function hideForm(){
	$('#formadd').hide();
}

function editarCliente(id)
{
  var id = id;
  $.post('http://localhost/sistemaContable/php/clientes.php',{id:id});
}

//Compras

$("#newCompra").click(function(evento){
        evento.preventDefault();
        $("#destino").load("../html/formCompras.html");
});

























