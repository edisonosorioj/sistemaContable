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