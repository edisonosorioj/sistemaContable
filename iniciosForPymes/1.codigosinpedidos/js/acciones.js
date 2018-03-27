
//General Acción Buscar
$(function(){
	$("#search").keyup(function(){
		if($(this).val() != ""){
			$("#table #rows").hide();
			$("#table td:contains-ci('" + $(this).val() + "')").parent("tr").show();
		}
		else{
			$("#table #rows").show();
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