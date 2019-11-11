jQuery(document).ready(function($) {
	
	"use strict";
	
	
	
	/* ==============================================================
	Ajax Submission
	============================================================== */
    $('form#submit-listing').on('submit', function(e){
        $('form#submit-listing p.kode-msg-list').show().text(ajax_submit_object.loadingmessage);
		$('form#submit-listing').addClass('form-working');
		var action = $('form#submit-listing #data_action').val();
		var property_status = "";
		$("input[name='property-status']:checkbox").each(function () {
			var ischecked = $(this).is(":checked");
			if (ischecked) {
				property_status += $(this).val() + ",";
			}
		});
		var property_features = "";
		$("input[name='property-features']:checkbox").each(function () {
			var ischecked = $(this).is(":checked");
			if (ischecked) {
				property_features += $(this).val() + ",";
			}
		});
		tinyMCE.triggerSave();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_submit_object.ajaxurl,			
			data: { 
                'action': action, //calls wp_ajax_nopriv_ajaxlogin
                'title': $('form#submit-listing #property-title').val(), 
                'description': $('form#submit-listing #property-description').val(), 
				'security': $('form#submit-listing #security').val(),
				'features': property_features,
				'status': property_status,
				'property-bed': $('form#submit-listing #property-bed').val(),
				'property-bath': $('form#submit-listing #property-bath').val(),
				'property-garage': $('form#submit-listing #property-garage').val(),
				'property-feature': $('form#submit-listing #property-feature').val(),
				'property-price': $('form#submit-listing #property-price').val(),
				'property-address': $('form#submit-listing #property-address-loc').val(), 
				'property-lat': $('form#submit-listing #property-lat-loc').val(),
				'property-lon': $('form#submit-listing #property-lon-loc').val(),
				'property-area': $('form#submit-listing #property-area').val(),
				'property-profile': $('form#submit-listing #property-profile').val(),
				'guest-email': $('form#submit-listing #guest-email').val(),
				'agent-name': $('form#submit-listing #agent-name').val(),
				'agent-email': $('form#submit-listing #agent-email').val(),
				'agent-phone': $('form#submit-listing #agent-phone').val(),
				'property-currency': $('form#submit-listing #property-currency').val(),
				'property-user': $('form#submit-listing #property-user').val(),
				'property_id': $('form#submit-listing #property_id').val(),
				'property-feature-image': $('form#submit-listing #kode-feature-image').val(),
				'property-feature-image-meta': $('form#submit-listing #kode_image_upload_meta').val(),
				'property-feature-video': $('form#submit-listing #kode-feature-video').val(),
				'property-feature-video-meta': $('form#submit-listing #kode_video_upload_meta').val(),
                'g-recaptcha-response': $('form#submit-listing [name="g-recaptcha-response"]').val() 
			},
			success: function(data){
				$('body').addClass(data.sendout);
                $('form#submit-listing p.kode-msg-list').text(data.message);
				$('form#submit-listing').addClass('form-working');
                if (data.loggedin == true){
                    document.location.href = ajax_submit_object.redirecturl;
                }else{
					$('#submit-listing p.kode-msg-list').text(data.message);
					grecaptcha.reset();
				}
            }
        });
        e.preventDefault();
    });
	
	
	// paypal form
	jQuery(document).ready(function($){
	
			
		// Uploading files
		var file_frame;
		 
		jQuery('.kode_wpmu_button').on('click', function( event ){
		 
			event.preventDefault();
		 
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
			  file_frame.open();
			  return;
			}
		 
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			  title: jQuery( this ).data( 'uploader_title' ),
			  button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			  },
			  multiple: false  // Set to true to allow multiple files to be selected
			});
		 
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var attachment = file_frame.state().get('selection').first().toJSON();

				// Do something with attachment.id and/or attachment.url here
				// write the selected image url to the value of the #cupp_meta text field				
				jQuery('.kode_image_meta').val('');
				jQuery('#kode_image_upload_meta').val(attachment.id);
				jQuery('#kode_image_upload_edit_meta').val('/wp-admin/post.php?post='+attachment.id+'&action=edit&image-editor');
				jQuery('.kode-image-current-img').attr('value', attachment.url);
			
			});
		 
			// Finally, open the modal
			file_frame.open();
		});
		// Update hidden field meta when external option url is entered
		jQuery('#kode_image_meta').blur(function(event) {
			if( '' !== $(this).val() ) {
				jQuery('#kode_image_upload_meta').val('');
				jQuery('.kode-current-img').attr('src', $(this).val()).removeClass('placeholder');
			}
		});

		// Remove Image Function
		jQuery('.edit_options').hover(function(){
			jQuery(this).stop(true, true).animate({opacity: 1}, 100);
		}, function(){
			jQuery(this).stop(true, true).animate({opacity: 0}, 100);
		});

		jQuery('.remove_img').on('click', function( event ){
			var placeholder = jQuery('#kode_image_placeholder_meta').val();

			jQuery(this).parent().fadeIn('fast', function(){
				// jQuery(this).remove();
				jQuery('.kode-image-current-img').addClass('placeholder').attr('src', placeholder);
			});
			jQuery('#kode_image_upload_meta, #kode_image_upload_edit_meta, #kode_image_meta').val('');
		});

	});
		// paypal form
	jQuery(document).ready(function($){
	
			
		// Uploading files
		var file_frame;
		 
		jQuery('.kode_button_vid').on('click', function( event ){
		 
			event.preventDefault();
		 
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
			  file_frame.open();
			  return;
			}
		 
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			  title: jQuery( this ).data( 'uploader_title' ),
			  button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			  },
			  multiple: false  // Set to true to allow multiple files to be selected
			});
		 
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var attachment = file_frame.state().get('selection').first().toJSON();

				// Do something with attachment.id and/or attachment.url here
				// write the selected image url to the value of the #cupp_meta text field				
				jQuery('.kode_video_meta').val('');
				jQuery('#kode_video_upload_meta').val(attachment.id);
				jQuery('#kode_video_upload_edit_meta').val('/wp-admin/post.php?post='+attachment.id+'&action=edit&image-editor');
				jQuery('.kode-video-current-vid').attr('value', attachment.url);
			
			});
		 
			// Finally, open the modal
			file_frame.open();
		});

	  // Update hidden field meta when external option url is entered
		jQuery('#kode_video_meta').blur(function(event) {
			if( '' !== $(this).val() ) {
				jQuery('#kode_video_upload_meta').val('');
				jQuery('.kode-current-video').attr('src', $(this).val()).removeClass('placeholder');
			}
		});

		// Remove Image Function
		jQuery('.edit_options').hover(function(){
			jQuery(this).stop(true, true).animate({opacity: 1}, 100);
		}, function(){
			jQuery(this).stop(true, true).animate({opacity: 0}, 100);
		});

		jQuery('.remove_img').on('click', function( event ){
			var placeholder = jQuery('#kode_image_placeholder_meta').val();

			jQuery(this).parent().fadeIn('fast', function(){
				// jQuery(this).remove();
				jQuery('.kode-video-current-img').addClass('placeholder').attr('src', placeholder);
			});
			jQuery('#kode_video_upload_meta, #kode_video_upload_edit_meta, #kode_video_meta').val('');
		});

	});
	
	
	
	/* ==============================================================
	Show and hide elements on select
	============================================================== */
	$('.kf_step2_field select').not('multiple').change(function(){		
		var wrapper = $(this).attr('data-slug') + '-wrapper';
		var selected_wrapper = $(this).val() + '-wrapper';				

		$(this).parents('.col-md-6').siblings().children('.' + wrapper).each(function(){
			
			if($(this).hasClass(selected_wrapper)){
				$(this).parent().slideDown(300);
			}else{
				$(this).parent().slideUp(300);
			}
		});
	});
	
	/* ==============================================================
	Show and hide elements on select
	============================================================== */
	$('.kf_step2_field select').not('multiple').each(function(){		
		var wrapper = $(this).attr('data-slug') + '-wrapper';
		var selected_wrapper = $(this).val() + '-wrapper';				

		$(this).parents('.col-md-6').siblings().children('.' + wrapper).each(function(){
			
			if($(this).hasClass(selected_wrapper)){
				$(this).parent().css('display', 'block');
			}else{
				$(this).parent().css('display', 'none');
			}
		});
	});
	
	
	/* ==============================================================
	select Chosen
	============================================================== */
	if($('.select-profile').length){
		$('.select-profile').chosen();
	}
	
	
	/* ==============================================================
	File Upload Script Start
	============================================================== */
	if($('#uploadBtn').length){
		document.getElementById("uploadBtn").onchange = function () {
			document.getElementById("uploadFile").value = this.value;
		};
	}

	if($('#uploadBtn1').length){
		document.getElementById("uploadBtn1").onchange = function () {
			document.getElementById("uploadFile1").value = this.value;
		};
	}

	if($('#uploadBtn2').length){
		document.getElementById("uploadBtn2").onchange = function () {
			document.getElementById("uploadFile2").value = this.value;
		};
	}

	/* ==============================================================
	Jquery Step Script Start
	============================================================== */
   //jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
	
	$(".next").click(function(){
		
		$('form#submit-listing').removeClass('form-working');
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent().parent();
		next_fs = $(this).parent().parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				// current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
				
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
		$('html, body').animate({scrollTop : 0},700);
	});
	
	$(".previous").click(function(){
		
		$('form#submit-listing').removeClass('form-working');
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent().parent();
		previous_fs = $(this).parent().parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;					
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
		$('html, body').animate({scrollTop : 0},700);
	});
});
