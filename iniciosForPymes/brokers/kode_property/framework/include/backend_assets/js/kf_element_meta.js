(function($){	
	$(document).ready(function(){

		// Wp Color Picker
		$('.kode-option-input .wp-color-picker').wpColorPicker();		
		
		// animate font family section
		var kodeproperty_custom_font_list = [];
		$('select.kode-font-combobox').change(function(){
			var font_family = $(this).val();
			var sample_font = $(this).parent().siblings('.kode-sample-font');
			var selected_option = $(this).children('option:selected');
			
			if( selected_option.attr('data-type') == 'web-safe-font' ){
				sample_font.css('font-family', font_family);
			}else if( selected_option.attr('data-type') == 'google-font' ){
				$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', selected_option.attr('data-url')) );
				sample_font.css('font-family', font_family + ', BlankSerif');
			}else if( selected_option.attr('data-type') == 'custom-font' ){
				if( kodeproperty_custom_font_list.indexOf(font_family) <= 0 ){
					var new_font = '@font-face {';
					new_font    += 'font-family: "' + font_family + '";'
					new_font    += 'src: url("' + selected_option.attr('data-eot') + '");';
					new_font    += 'src: url("' + selected_option.attr('data-eot') + '?#iefix") format("embedded-opentype"),';
					new_font    += 'url("' + selected_option.attr('data-ttf') + '") format("truetype");';
					new_font    += '}';
					
					$('head').append($('<style type="text/css"></style>').append(new_font));
					kodeproperty_custom_font_list.push(font_family);
				}
				sample_font.css('font-family', font_family + ', BlankSerif');
			}
		
		});
		$('select.kode-font-combobox').trigger('change');
		
		
		// kodeforest combobox
		$('.kode-option-input select').not('multiple').change(function(){
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';
			$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).slideDown(300);
				}else{
					$(this).slideUp(300);
				}
			});
		});
		
		// kodeforest multiple Select
		$('.kode-option-input select').not('multiple').each(function(){
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';

			$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).css('display', 'block');
				}else{
					$(this).css('display', 'none');
				}
			});
		});		
		
		// animate checkbox
		$('.kode-option-input input[type="checkbox"]').click(function(){	
			if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
				var wrapper = $(this).attr('data-slug') + '-wrapper';		
				var selected_wrapper = $(this).val() + '-wrapper';
				$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
					$(this).slideUp(300);			
				});
			}else{
				var wrapper = $(this).attr('data-slug') + '-wrapper';		
				var selected_wrapper = $(this).val() + '-wrapper';
				$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
						
					$(this).slideDown(300);		
				});
			}
		});
		
		// kodeforest multiple Select
		$('.kode-option-input input[type="checkbox"]').each(function(){
			if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
				var wrapper = $(this).attr('data-slug') + '-wrapper';		
				var selected_wrapper = $(this).val() + '-wrapper';
				$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
					$(this).css('display', 'block');
				});
			}else{
				var wrapper = $(this).attr('data-slug') + '-wrapper';		
				var selected_wrapper = $(this).val() + '-wrapper';
				$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
					$(this).css('display', 'none');
				});
			}
		});	
				
		// KodeForest radio image 
		$('.kode-option-input input[type="radio"]').change(function(){
			$(this).parent().siblings('label').children('input').attr('checked', false); 
			$(this).parent().addClass('active').siblings('label').removeClass('active');
			
			// animate the related section
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';
			$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).slideDown(300);
				}else{
					$(this).slideUp(300);
				}
			});
		});
		
		$('.kode-option-input input[type="radio"]:checked').each(function(){	
			// trigger the default value
			var wrapper = $(this).attr('data-slug') + '-wrapper';
			var selected_wrapper = $(this).val() + '-wrapper';

			$(this).parents('.kode-option-wrapper').siblings('.' + wrapper).each(function(){
				if($(this).hasClass(selected_wrapper)){
					$(this).css('display', 'block');
				}else{
					$(this).css('display', 'none');
				}
			});
		});	
		
		var checked = $('.player-row .player_selected:checked');
		if(checked.length){
			checked.addClass('enable');
			checked.parent().parent().find('input[type="text"]').removeAttr('disabled');
			checked.parent().parent().find('input[type="radio"]').removeAttr('disabled');
			checked.parent().parent().find('.select-pos').removeAttr('disabled');
		}
		
		$('.player-row input[type="checkbox"]').click(function(){
			if( $(this).hasClass('enable') ){
				$(this).removeClass('enable');
				$(this).parent().parent().find('input[type="text"]').prop('disabled', true);
				$(this).parent().parent().find('input[type="radio"]').prop('disabled', true);
				$(this).parent().parent().find('.select-pos').prop('disabled', 'disabled');
			}else{
				$(this).addClass('enable');
				$(this).parent().parent().find('.select-pos').removeAttr('disabled');
				$(this).parent().parent().find('input[type="text"]').removeAttr('disabled');
				$(this).parent().parent().find('input[type="radio"]').removeAttr('disabled');
			}
		});	
		
		//
		
		// load page builder meta
		$('select[name="select_team_first"]').change(function(){
			var post_id = $(this).parent().attr('data-id');
			var ajax_url = $(this).parent().attr('data-ajax');
			var action = $(this).parent().attr('data-action');
			var settings = $(this).parent().attr('data-settings');
			var team_id = $(this).val();			
			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: {'action': action,'team_id': team_id,'post_id':post_id,'settings':settings},
				// dataType: 'json',
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').kodeproperty_alert({
						text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					$('.player_line_up_class_first').children('.kode-option').children().remove();
					$('.player_line_up_class_first').children('.kode-option').html(data);
				}
			});				
		});
		
		// load page builder meta
		$('select[name="select_team_second"]').change(function(){
			var post_id = $(this).parent().attr('data-id');
			var ajax_url = $(this).parent().attr('data-ajax');
			var action = $(this).parent().attr('data-action');
			var settings = $(this).parent().attr('data-settings');
			var team_id = $(this).val();			
			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: {'action': action,'team_id': team_id,'post_id':post_id,'settings':settings},
				// dataType: 'json',
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').kodeproperty_alert({
						text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					$('.player_line_up_class_second').children('.kode-option').children().remove();
					$('.player_line_up_class_second').children('.kode-option').html(data);
				}
			});				
		});
		
		
		// animate checkbox
		$('.kode-option-input input[type="checkbox"]').click(function(){	
			if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
				$(this).siblings('.checkbox-appearance').removeClass('enable');
				$(this).siblings('.checkbox-appearance').addClass('disable');
			}else{
				$(this).siblings('.checkbox-appearance').addClass('enable');
				$(this).siblings('.checkbox-appearance').removeClass('disable');
			}
		});
		
		
		
		// animate upload button
		$('.kode-option-input .kode-upload-box-input').change(function(){		
			$(this).siblings('.kode-upload-box-hidden').val($(this).val());
			if( $(this).val() == '' ){ 
				$(this).siblings('.kode-upload-img-sample').addClass('blank'); 
			}else{
				$(this).siblings('.kode-upload-img-sample').attr('src', $(this).val()).removeClass('blank');
			}
		});
		
		$('.kode-option-input .kode-upload-box-button').click(function(){
			var upload_button = $(this);
			var data_type = upload_button.attr('data-type');
			if( data_type == 'all' ){ data_type = ''; }
			
			var custom_uploader = wp.media({
				title: upload_button.attr('data-title'),
				button: { text: upload_button.attr('data-button') },
				library : { type : data_type },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				if( data_type == 'image' ){
					upload_button.siblings('.kode-upload-img-sample').attr('src', attachment.url).removeClass('blank');
				}
				upload_button.siblings('.kode-upload-img-sample').attr('src', attachment.url).removeClass('blank');
				upload_button.siblings('.kode-upload-box-input').val(attachment.url);
				upload_button.siblings('.kode-upload-box-hidden').val(attachment.id);
			}).open();			
		});
		
		// kodeforest sliderbar item
		$('.kode-option-input .kode-sliderbar').each(function(){
			$(this).slider({ min:10, max:72, value: $(this).attr('data-value'),
				slide: function(event, ui){
					$(this).siblings('.kode-sliderbar-text-hidden').val(ui.value);
					$(this).siblings('.kode-sliderbar-text').html(ui.value + ' px');
				}
			});
		});		
		
		// font family section
		var kodeproperty_custom_font_list = [];
		$('select.kode-font-combobox').change(function(){
			var font_family = $(this).val();
			var sample_font = $(this).parent().siblings('.kode-sample-font');
			var selected_option = $(this).children('option:selected');
			
			if( selected_option.attr('data-type') == 'web-safe-font' ){
				sample_font.css('font-family', font_family);
			}else if( selected_option.attr('data-type') == 'google-font' ){
				$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', selected_option.attr('data-url')) );
				sample_font.css('font-family', font_family + ', BlankSerif');
			}else if( selected_option.attr('data-type') == 'custom-font' ){
				if( kodeproperty_custom_font_list.indexOf(font_family) <= 0 ){
					var new_font = '@font-face {';
					new_font    += 'font-family: "' + font_family + '";'
					new_font    += 'src: url("' + selected_option.attr('data-eot') + '");';
					new_font    += 'src: url("' + selected_option.attr('data-eot') + '?#iefix") format("embedded-opentype"),';
					new_font    += 'url("' + selected_option.attr('data-ttf') + '") format("truetype");';
					new_font    += '}';
					
					$('head').append($('<style type="text/css"></style>').append(new_font));
					kodeproperty_custom_font_list.push(font_family);
				}
				sample_font.css('font-family', font_family + ', BlankSerif');
			}
		
		});
		$('select.kode-font-combobox').trigger('change');
		
		// initiate slider selector		
		$('textarea.kode-slider-selection').each(function(){
			$(this).xpressCreateSliderSelection();	
		});
		
		// initiate slider selector		
		$('textarea.kode-gallery-selection').each(function(){
			$(this).xpressCreateGallerySelection();
		});
	});	
})(jQuery);