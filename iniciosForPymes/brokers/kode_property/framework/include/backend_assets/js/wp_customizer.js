(function($){

	var color_option = [
		{name: "top-bar-text-color", selector: ".top-navigation-wrapper{ color: #kode#; }"},
	];
	
	var customizer_style = $('<style id="customizer-style"></style>');
	$("head").append(customizer_style);	
	
	function generate_dynamic_style(index, value){
		color_option[index].style = color_option[index].selector.replace('#kode#', value);
		
		var new_style = '';
		for(var i=0; i<color_option.length; i++){
			if(color_option[i].style){
				new_style += color_option[i].style + '\r\n';
			}
		}
		customizer_style.html(new_style);
	}
	
	// Theme Color Option
	$.each(color_option, function(index, value){
		wp.customize('kodeproperty_customizer[' + value.name + ']', function(value){
			value.bind(function(to){
				generate_dynamic_style(index, to);
			});
		});		
	
	});
	
	// Site title and description.
	wp.customize('blogname', function(value){
		value.bind(function(to){
			$('.site-title').text(to);
		});
	});
	wp.customize('blogdescription', function(value){
		value.bind(function(to){
			$('.site-description').text(to);
		});
	});
	
})(jQuery);