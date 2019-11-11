jQuery(document).ready(function($){		
	$('#publish, #preview-action a, #save-post').click(function(){

		var page_option = $('.kode-page-option-wrapper');
		
		// save each page option to the hidden textarea
		page_option.each(function(){
		
			// jquery object that contains each option value
			var page_option = new Object();
			
			$(this).find('[data-slug]').each(function(){
			
				// input type = text
				if( $(this).attr('type') == 'text' || $(this).attr('type') == 'hidden' ){
					page_option[$(this).attr('data-slug')] = $(this).val();
					
				// input type = checkbox
				}else if( $(this).attr('type') == 'checkbox' ){
					if( $(this).attr('checked') ){
						page_option[$(this).attr('data-slug')] = 'enable';
					}else{
						page_option[$(this).attr('data-slug')] = 'disable'
					}
					
				// input type = radio
				}else if( $(this).attr('type') == 'radio' ){
					if( $(this).attr('checked') ){
						page_option[$(this).attr('data-slug')] = $(this).val();
					}
					
				// input type = combobox
				}else if( $(this).is('select') ){
					page_option[$(this).attr('data-slug')] = $(this).val();
					
				// input type = textarea
				}else if( $(this).is('textarea') ){
					page_option[$(this).attr('data-slug')] = $(this).val();
				}

			});
		
			$(this).children('textarea.kode-input-hidden').val(JSON.stringify(page_option));
		});

	});
	
	// load page builder meta
	$('#kode-load-demo').each(function(){
		var post_id = $(this).attr('data-id');
		var ajax_url = $(this).attr('data-ajax');
		var action = $(this).attr('data-action');	
		
		$(this).children('input[type="button"]').click(function(){
			var button_slug = $(this).attr('data-slug');
			$('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {'action': action, 'post_id':post_id , 'slug': button_slug},
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed'
						});
					},
					success: function(data){
						location.reload();
					}
				});	
			}});	
		});
		$(this).children().children('input[type="button"]').click(function(){
			var button_slug = $(this).attr('data-slug');
			$('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {'action': action, 'post_id':post_id , 'slug': button_slug},
					dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed'
						});
					},
					success: function(data){
						location.reload();
					}
				});	
			}});	
		});
	});
	
	// load page builder meta
	$('#kode-load-demo').each(function(){
		var post_id = $(this).attr('data-id');
		var ajax_url = $(this).attr('data-ajax');
		var action = 'kodeproperty_delete_settings';	
		
		$(this).children().children('.panel-delete-sidebar').click(function(){

			var clone_val = $(this).siblings('#k_input_append').val();
			var del = $(this).parent().remove();			
			var myStr = clone_val;
			myStr = myStr.toLowerCase();
			myStr = myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");   //this one
			myStr = myStr.replace(/\s+/g, "-");
			
			var form_submit = $('#kode-load-demo :input').serialize();			
			$('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {'action': action,'slug': myStr,'form_data':form_submit},
					// dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed'
						});
					},
					success: function(data){
						location.reload();
					}
				});	
			}});
			
		});
	});
	
	
	// load page builder meta
	$('#kode-save-settings').each(function(){
		var post_id = $(this).attr('data-id');
		var ajax_url = $(this).attr('data-ajax');
		var action = $(this).attr('data-action');	
		
		
		
		$(this).children('.btn_save_set').click(function(){
			
			var clone_item = $(this).parents().siblings('.custom-styles').clone(true);
			var input_id = $(this).siblings().attr('data-slug');
			var clone_val = $(this).siblings('#k-set-value').val();
			var post_option = $("input[value='post-option']").attr('id');
			var kodeproperty_content = $("input[value='kodeproperty_content']").attr('id');
			var button_slug = $(this).siblings('#k-set-value').val();
			if (clone_val.indexOf("&") > 0) {
				alert('You can\'t use the special charactor ( such as & ) as the sidebar name.');
				return;
			}
			if (clone_val == '' || clone_val == 'type title here') return;
			
			clone_item.removeClass('custom-styles').addClass('custom-style');
			clone_item.attr('id',' ');
			clone_item.find('input#kode-custom-style').attr('name', function () {
				return input_id + '[]';
			});
			clone_item.find('input#kode-custom-style').attr('data-slug', function () {
				return input_id + '[]';
			});
			
			var myStr = clone_val;
			myStr = myStr.toLowerCase();
			myStr = myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");   //this one
			myStr = myStr.replace(/\s+/g, "-");
			
			
			post_option = post_option.replace("key","value");   //this one
		
			kodeproperty_content = kodeproperty_content.replace("key","value");   //this one

			var p_option = $("#"+post_option).val();
			var k_option = $("#"+kodeproperty_content).val();
			
			clone_item.find('input#kode-custom-style').attr('value', clone_val);
			clone_item.find('input#k_input_append').attr('value', clone_val);
			clone_item.find('input#k_input_append').attr('data-slug', myStr);
			clone_item.find('.slider-item-text').html(clone_val);
			$("#kode-load-demo").append(clone_item);
			var form_submit = $('#kode-load-demo :input').serialize();			
			$('input#k-set-value').val('type title here');
			// $('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					data: {'action': action,'slug': myStr,'data_value': clone_val,'kodeproperty_content':k_option,'post_option':p_option,'form_data':form_submit},
					url: ajax_url,
					// dataType: 'json',
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed'
						});
					},
					success: function(data){
						// location.reload();
					}
				});	
			// }});	
		});
	});
	
});	