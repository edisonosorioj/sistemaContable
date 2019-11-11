(function($){	

	$(document).ready(function(){

		$("div#sidebar-element").click(function () {
			var clone_item = $(this).parents().siblings('.sidebar-default-k').find('.default-sidebar-item').clone(true);
			var input_id = $(this).siblings().attr('data-slug');
			var clone_val = $(this).siblings('input.kode-upload-box-input').val();
			if (clone_val.indexOf("&") > 0) {
				alert('You can\'t use the special charactor ( such as & ) as the sidebar name.');
				return;
			}
			if (clone_val == '' || clone_val == 'type title here') return;
			clone_item.removeClass('default-sidebar-item').addClass('sidebar-item');
			clone_item.attr('id',' ');
			clone_item.find('input').attr('name', function () {
				return input_id + '[]';
			});
			clone_item.find('input').attr('data-slug', function () {
				return input_id + '[]';
			});
			clone_item.find('input').attr('value', clone_val);
			clone_item.find('.slider-item-text').html(clone_val);
			$("#selected-sidebar").append(clone_item);
			$(".sidebar-item").show();
			$('input.kode-upload-box-input').val('type title here');
		});
		$(".sidebar-item").css('display', 'block');
		$(".panel-delete-sidebar").click(function () {
			var remove_button = $(this);
			$('body').kodeproperty_confirm({
				success: function(){
					remove_button.parent('.sidebar-item').slideUp(function(){
						$(this).remove();							
					});					
				}
			});
			return false;
		});
	
		if($('#kode-admin-navvvvvvv').length){
			// grab the initial top offset of the navigation 
			var stickyNavTop = $('#kode-admin-nav').offset().top;
			// our function that decides weather the navigation bar should have "fixed" css position or not.
			var stickyNav = function(){
				var scrollTop = $(window).scrollTop(); // our current vertical position from the top
				// if we've scrolled more than the navigation, change its position to fixed to stick to top,
				// otherwise change it back to relative
				if (scrollTop > stickyNavTop) { 
					$('#kode-admin-form').addClass('sticky');
				} else {
					$('#kode-admin-form').removeClass('sticky'); 
				}
			};
			stickyNav();
			// and run it again every time you scroll
			$(window).scroll(function() {
				stickyNav();
			});
		}	
		
		//Chosen Script
		$('.kode-combobox-wrapper select').chosen();

		// animate the admin menu
		$('#kode-admin-content').each(function(){
			var admin_menu = $(this).children('.kode-sidebar-menu-section').children('ul.admin-menu');
			var admin_sub_menu = $(this).children('.kode-sidebar-menu-section').children('.kode-sidebar-section');
			var content_area = $(this).children('.kode-content-group');
			
			admin_menu.children('li').click(function(){
				admin_menu.find('li').attr('data-class',' ');
				var id = $(this).attr('class');
				$(this).attr('data-class','active');
				var selected_bar = $(this).parent().parent().find('.admin-sub-menu');
				$(this).parent().parent().find('.admin-sub-menu').hide();
				$('#'+id).show();				
				var selected_id_default = $('#'+id).first('li').children().attr('data-id');				
				content_area.children('.kode-content-section').css('display', 'none');
				content_area.children('#' + selected_id_default).fadeIn();
			})
			
			admin_sub_menu.find('li.admin-sub-menu-list').click(function(){
				admin_sub_menu.find('li.admin-sub-menu-list').removeClass('active');
				$(this).addClass('active');				
				var selected_id = $(this).attr('data-id');
				content_area.children('.kode-content-section').css('display', 'none');
				content_area.children('#' + selected_id).fadeIn();
			});
		});
		
		// export option
		$('#kode-export').click(function(){
			$(this).siblings('textarea').html($('#kode-admin-form').serialize());
		});
		
		$('.kode-combobox-wrapper select').chosen();
		
		
		// import option
		$('#kode-import').click(function(){
			var data = $(this).siblings('textarea').val();	
			if( data ){
				var admin_form = $('#kode-admin-form');
				var ajax_url = admin_form.attr('data-ajax');
				var nonce = admin_form.attr('data-security');
				var action = admin_form.attr('data-action');	

				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: { 'security': nonce, 'action': action, 'option': data },
					dataType: 'json',
					beforeSend: function(){
						admin_form.find('.now-loading').animate({'opacity': 1}, 300);
					},
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Importing Error</span> Please make sure that the data is corrected.', 
							status: 'failed'
						});
					},
					success: function(data){
						location.reload();
					}
					
				});

			}else{
				$('body').kodeproperty_alert({'text': 'Please fill the exported data in the textarea.'});
			}
			
		});
		
		// save admin menu
		$('#kode-admin-form').submit(function(){
			var admin_form = $(this);
		
			var ajax_url = admin_form.attr('data-ajax');
			var nonce = admin_form.attr('data-security');
			var action = admin_form.attr('data-action');

			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: { 'security': nonce, 'action': action, 'option': jQuery(this).serialize() },
				dataType: 'json',
				beforeSend: function(){
					admin_form.find('.now-loading').animate({'opacity': 1}, 300);
				},
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').kodeproperty_alert({
						text: '<span class="head">Sending Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					$('body').kodeproperty_alert({text: data.message, status: data.status, duration: 1500});
				},
				complete: function(data){
					admin_form.find('.now-loading').animate({'opacity': 0}, 300);
				}
				
			});
			
			return false;
		});	

		
		// save admin menu
		$('a.kdf-button').on('click',function(){
			var admin_form = $('#kode-admin-form');
			var admin_form_data = $('#reset_code').text();			
			var ajax_url = admin_form.attr('data-ajax');
			var nonce = admin_form.attr('data-security');
			var action = admin_form.attr('data-action');
			
			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: { 'security': nonce, 'action': action, 'option': admin_form_data },
				dataType: 'json',
				beforeSend: function(){
					admin_form.find('.now-loading').animate({'opacity': 1}, 300);
				},
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').kodeproperty_alert({
						text: '<span class="head">Sending Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					$('body').kodeproperty_alert({text: 'Your Settings Are Restored to Default.', status: data.status, duration: 1500});
				},
				complete: function(data){
					admin_form.find('.now-loading').animate({'opacity': 0}, 300);
				}
				
			});
			
			return false;
		});	
		
		
		// save admin menu
		$('.kode-cf-post-meta li').on('click',function(){
			var click_event = $(this).attr('class');
			// text = text.replace(dd, 'new');
			var event_id = click_event.replace('cf', 'kode');			
			var clone_item = $(this).parents().parents().siblings('.kode-cf-meta-content').children('#'+event_id).clone(true);
			clone_item.removeAttr('id');
			// var input_id = $(this).siblings().attr('data-name');
			$("#kode-meta-content-sec").children('.kode-cf-text').find('.kode-cf-item').attr('class','kode-cf-item');
			$("#kode-meta-content-sec").children('.kode-cf-text').find('.kode-cf-item-content').attr('class','kode-cf-item-content');
			clone_item.children('.kode-cf-item').attr('class', function () {
				return 'kode-cf-item';
			});
			clone_item.children('.kode-cf-item-content').attr('class', function () {
				return 'kode-cf-item-content';
			});
			// clone_item.find('input').attr('name', function () {
				// return input_id + '[]';
			// });
			
			clone_item.find('input').each(function() {
				var $t = $(this);
				var dd = $t.attr('data-name');
				$t.attr('name',dd);
				$t.attr('value','default');
			});
			clone_item.find('input[type="hidden"]').each(function() {
				var $t = $(this);
				var dd = $t.attr('data-name');
				var val = $t.attr('data-value');
				$t.attr('name',dd);			
				$t.attr('value',val);
			});
			clone_item.find('select').each(function() {
				var $t = $(this);
				var dd = $t.attr('data-name');
				$t.attr('name',dd);
				
			});
			clone_item.removeClass('hide');
			$("#kode-meta-content-sec").append(clone_item);
			// $("#kode-meta-content-sec").sortable();
		});
		$(".item-cf-delete").click(function () {
			var remove_button = $(this);
			$('body').kodeproperty_confirm({
				success: function(){
					remove_button.parent().parent().slideUp(function(){
						$(this).remove();							
					});					
				}
			});
			return false;
		});
		$(".item-cf-edit").click(function () {
			var edit_button = $(this);			
			if($(this).hasClass('item-cf-edit')){        
				$(this).toggleClass("open-this-box item-cf-edit");
				edit_button.parent().siblings().fadeIn();
			}else{
				edit_button.parent().siblings().fadeOut();
				
				$(this).toggleClass("item-cf-edit open-this-box");
			}
			return false;
		});
		$("#kode-meta-content-sec").sortable();
		
		// save admin menu
		$('#kode-custom-field-form .kdf-button').on('click',function(){
			var admin_form = $('#kode-custom-field-form');
			var ajax_url = admin_form.attr('data-ajax');
			var nonce = admin_form.attr('data-security');
			var action = admin_form.attr('data-action');
			
			$.ajax({
				type: 'POST',
				url: ajax_url,
				data: { 'security': nonce, 'action': action, 'option': jQuery(this).serialize() },
				dataType: 'json',
				beforeSend: function(){
					admin_form.find('.now-loading').animate({'opacity': 1}, 300);
				},
				error: function(a, b, c){
					console.log(a, b, c);
					$('body').kodeproperty_alert({
						text: '<span class="head">Sending Error</span> Please refresh the page and try this again.', 
						status: 'failed'
					});
				},
				success: function(data){
					$('body').kodeproperty_alert({text: 'Your Settings Are Restored to Default.', status: data.status, duration: 1500});
				},
				complete: function(data){
					admin_form.find('.now-loading').animate({'opacity': 0}, 300);
				}
				
			});
			
			return false;
		});	
		
	});
})(jQuery);



jQuery(document).ready(function($){		
	
	// load page builder meta
	$('.kode-import-now').each(function(){
		var k_ajax_admin = $(this);
		var ajax_url = $(this).attr('data-ajax');
		var action = $(this).attr('data-action');	
		
		$(this).children('.import-now').click(function(){
			var dummy = $(this).parent().parent().children('input.dummy_url').attr('data-slug');
			var options = $(this).parent().parent().children('input.options_url').attr('data-slug');
			var widgets = $(this).parent().parent().children('input.widgets_url').attr('data-slug');
			$('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {'action': action, 'dummy': dummy, 'options': options, 'widgets': widgets },
					dataType: 'json',
					beforeSend: function(){
						k_ajax_admin.find('.now-loading').animate({'opacity': 1}, 300);
						$('body').addClass('ajax_working_wait');
					},
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed'
						});
						$('.after-import').addClass('import-error');
						$('#importer-options').addClass('main-import-completed');
						// location.reload();
					},
					success: function(data){
						$('body').kodeproperty_alert({
							text: '<span class="head">Dummy Data Imported</span> Please Visit your Site now!.'+data+'', 
							status: 'success'
						});
						$('.after-import').addClass('import-success');
						$('#importer-options').addClass('main-import-completed');
						// location.reload();
					},
					complete: function(data){
						$('body').removeClass('ajax_working_wait');
						k_ajax_admin.find('.now-loading').animate({'opacity': 0}, 300);
						$('.after-import').addClass('import-completed');
						$('.kode-import-completed').find('.abc-import').append(data.statusText);
						 
						$('#importer-options').addClass('main-import-completed');
						// location.reload();
					}
				});	
			}});	
		});
		
		$(this).children('.import-now-menu').click(function(){
			var dummy = $(this).parent().parent().children('input.dummy_menu_url').attr('data-slug');
			var options = $(this).parent().parent().children('input.options_url').attr('data-slug');
			var widgets = $(this).parent().parent().children('input.widgets_url').attr('data-slug');
			$('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {'action': 'demo_data_load_menu', 'menu_dummy': dummy, 'options': options, 'widgets': widgets },
					dataType: 'json',
					beforeSend: function(){
						k_ajax_admin.find('.now-loading').animate({'opacity': 1}, 300);
						$('body').addClass('ajax_working_wait');
					},
					error: function(a, b, c){
						console.log(a, b, c);
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed'
						});
						$('.after-import').addClass('import-error');
						$('#importer-options').addClass('main-import-completed');
						// location.reload();
					},
					success: function(data){
						$('body').kodeproperty_alert({
							text: '<span class="head">Dummy Data Imported</span> Please Visit your Site now!.'+data+'', 
							status: 'success'
						});
						$('.after-import').addClass('import-success');
						$('#importer-options').addClass('main-import-completed');
						// location.reload();
					},
					complete: function(data){
						$('body').removeClass('ajax_working_wait');
						k_ajax_admin.find('.now-loading').animate({'opacity': 0}, 300);
						$('.after-import').addClass('import-completed');
						$('.kode-import-completed').find('.abc-import').append(data.statusText);
						 
						$('#importer-options').addClass('main-import-completed');
						// location.reload();
					}
				});	
			}});	
		});
	});
	
	// load page builder meta
	$('.kode-import-more').each(function(){
		
		var k_ajax_admin = $(this);
		var ajax_url = $(this).attr('data-ajax');
		var action = $(this).attr('data-action');	
		
		$(this).children('.import-now').click(function(){
			var dummy = $(this).parent().parent().children('input').attr('data-slug');
			$('body').kodeproperty_confirm({ success: function(){
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {'action': action, 'dummy': dummy},
					dataType: 'json',
					beforeSend: function(){
						k_ajax_admin.find('.now-loading').animate({'opacity': 1}, 300);
						$('body').addClass('ajax_working_wait');
					},
					error: function(data){
						$('body').kodeproperty_alert({
							text: '<span class="head">Loading Error</span> Please refresh the page and try this again.', 
							status: 'failed',
						});
						$('.after-import').addClass('import-error');
						// location.reload();
					},
					success: function(data){
						$('body').kodeproperty_alert({
							text: '<span class="head">Dummy Data Imported</span> Please Visit your Site now!.'+data+'', 
							status: 'success'
						});
						$('.after-import').addClass('import-completed');
						// location.reload();
					},
					complete: function(data){
						$('body').removeClass('ajax_working_wait');
						k_ajax_admin.find('.now-loading').animate({'opacity': 0}, 300);
						$('.after-import').addClass('import-completed');
						// location.reload();
					}
				});	
			}});	
		});
	});
	
});	