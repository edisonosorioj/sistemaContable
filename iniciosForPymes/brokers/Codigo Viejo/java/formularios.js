$( document ).ready(function() {
    $('#departamento_us').prop('disabled', true);
    $('#departamento_us_doc').prop('disabled', true);
    $('#ciudad_us').prop('disabled', true);
    $('#ciudad_us_doc').prop('disabled', true);

    var myInput = document.getElementById('conf_email_us');
	  myInput.onpaste = function(e) {
	    e.preventDefault();
	    alert("Esta acción está prohibida");
	}

});