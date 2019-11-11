(function($){
	
	// use textarea to create slider selection
	$.fn.xpressCreateBooksSelection = function(){

		var textarea = $(this);
		var slider_wrapper = $('<div class="slider-wrapper"></div>');
		
		var add_button = $('<div class="add-more-images"><i class="fa fa-plus"></i></div>');
		add_button.click(function(){
			xpressSelectBooksImage(textarea);
		});
		
		var container = $('<div class="slider-container"></div>');		
		container.sortable({
			revert: 100,
			opacity: 0.8,
			tolerance: "pointer",
			helper: 'clone',
			stop: function(event, ui){
				xpressUpdateBooksOrder(textarea);
			}
		});
			
		// add the silder item before the textarea
		textarea.parent().prepend(slider_wrapper);	
		slider_wrapper.append( $('<div class="add-image-wrapper" ></div>')
						.append(add_button)
						.append('<span>Add Images</span>') )
						.append(container);		
						
		xpressCreateBooksSlide(textarea);
	}
	
	// update the slider order when takes an action
	function xpressUpdateBooksOrder(textarea){
		var slider_data = (textarea.val().length > 0)? $.parseJSON(textarea.val()): [];
		var slide_order = [];
		var slides = (slider_data[1])? slider_data[1]: {};
		var container = textarea.siblings('.slider-wrapper').children('.slider-container');
		
		var slide = {};
		container.children().each(function(){
			slide_order.push(parseInt($(this).attr('data-id')));
		});
		textarea.val(JSON.stringify([slide_order, slides]));
	}	
	
	// add new slides to container
	function xpressCreateBooksSlide(textarea){
		var slider_data = (textarea.val().length > 0)? $.parseJSON(textarea.val()): [];
		var slide_order = (slider_data[0])? slider_data[0]: [];
		var slides = (slider_data[1])? slider_data[1]: {};
		var container = textarea.siblings('.slider-wrapper').children('.slider-container');
		
		container.children().remove();
		for (var i=0; i<slide_order.length; i++){ 
			var slide = $('<div class="kode-slide-wrapper" data-id="' + slide_order[i] + '" ></div>');
			slide.click(function(){
				xpressCreateBooksOption(textarea, $(this).attr('data-id'));
			});
			
			slide.append( $('<img />')
					.attr('src', slides[slide_order[i]].thumbnail)
					.attr('width', slides[slide_order[i]].width)
					.attr('height', slides[slide_order[i]].height)
			);
			
			var remove = $('<div class="kode-delete-slide"></div>');
			remove.click(function(){
				var remove_button = $(this);
				$('body').kodeproperty_confirm({
					success: function(){
						remove_button.parent('.kode-slide-wrapper').slideUp(function(){
							$(this).remove();
							xpressUpdateBooksOrder(textarea);
						});					
					}
				});
				return false;
			});
			slide.append(remove);
			
			container.append(slide);
		}	
	}
	
	// clicking add more image button
	function xpressSelectBooksImage(textarea){
		var slider_data = (textarea.val().length > 0)? $.parseJSON(textarea.val()): [];
		var slide_order = (slider_data[0])? slider_data[0]: [];
		var slides = (slider_data[1])? slider_data[1]: {};

		var custom_uploader = wp.media({
			title: 'Select Books Images',
			button: { text: 'Add Images' },
			library : { type : 'image' },
			multiple: 'add'
		});
		custom_uploader.on('open',function() {
			var selection = custom_uploader.state().get('selection');
			for (var i=0; i<slide_order.length; i++){ 
				attachment = wp.media.attachment(slide_order[i]);
				attachment.fetch();
				selection.add( attachment ? [attachment] : [] );
			}
		});	
		custom_uploader.on('select', function() {
			var attachment = custom_uploader.state().get('selection').toJSON();

			for (var i=0; i<attachment.length; i++){ 
			
				// add new image if it isn't exists
				if( $.inArray(attachment[i].id, slide_order) < 0 ){
					slide_order.push(attachment[i].id);
					slides[attachment[i].id] = {};

					// initial slider value
					slides[attachment[i].id]['title'] = '';	
					slides[attachment[i].id]['caption'] = '';	
					slides[attachment[i].id]['caption-position'] = '';	
					slides[attachment[i].id]['slide-link'] = '';	
					slides[attachment[i].id]['url'] = '';	
					slides[attachment[i].id]['new-tab'] = 'enable';						
				}
				
				// add the slider data to slide array
				if( attachment[i].sizes.thumbnail ){
					slides[attachment[i].id].thumbnail = attachment[i].sizes.thumbnail.url;
					slides[attachment[i].id].width = attachment[i].sizes.thumbnail.width;
					slides[attachment[i].id].height = attachment[i].sizes.thumbnail.height;
				}else{
					slides[attachment[i].id].thumbnail = attachment[i].sizes.full.url;
					slides[attachment[i].id].width = attachment[i].sizes.full.width;
					slides[attachment[i].id].height = attachment[i].sizes.full.height;	
				}
			}
			textarea.val(JSON.stringify([slide_order, slides]));
			xpressCreateBooksSlide(textarea);
		});		
		custom_uploader.open();	
	}
	
	// create an overlay to customize each slider data
	function xpressCreateBooksOption(textarea, image_id){
		var overlay = (textarea.attr('data-overlay') == "true")? true: false;
		var caption = (textarea.attr('data-caption') == "true")? true: false;
		var editbox = $('<div class="edit-box-wrapper"></div>');
		
		// overlay section
		var editbox_overlay = $('<div class="edit-box-overlay"></div>');
		if(!overlay){ editbox_overlay.addClass('second-level'); }
		editbox_overlay.click(function(){
			xpressCloseBooksOption(editbox, textarea, image_id, overlay);
		});
		editbox.append(editbox_overlay);	
		
		// container section
		var editbox_container = $('<div class="edit-box-container"></div>');
		var edit_box_close = (overlay)? $('<div class="edit-box-close"></div>'):  $('<div class="edit-box-back"></div>');
		edit_box_close.click(function(){
			xpressCloseBooksOption(editbox, textarea, image_id, overlay);
		});		
		
		var edit_box_title = $('<div class="edit-box-title-wrapper"></div>')
								.append('<h3 class="edit-box-title">Books Options</div>')
								.append(edit_box_close);	
								
		var edit_box_content = $('<div class="edit-box-content"></div>');		
		var slider_option = xpressInitBooksOption(textarea, image_id, caption);
		slider_option.children().each(function(){
			var edit_box_input_outer = $('<div class="edit-box-input-wrapper"></div>');
			if( $(this).attr('data-wrapper-class') ){
				edit_box_input_outer.addClass($(this).attr('data-wrapper-class'));
			}
			
			// print input title
			if( $(this).attr('data-title') ){
				edit_box_input_outer.append('<div class="input-box-title">' + $(this).attr('data-title') + '</div>' );
			}				

			// print input option
			var edit_box_input = $('<div class="edit-box-input"></div>');
			switch ($(this).attr('data-type')){
				case 'checkbox' : edit_box_input.xpressEditBoxCheckBox($(this)); break;
				case 'combobox' : edit_box_input.xpressEditBoxCombobox($(this)); break;
				case 'text' : edit_box_input.xpressEditBoxInput($(this)); break;
				case 'textarea' : edit_box_input.xpressEditBoxTextArea($(this)); break;
			}
			edit_box_input.append('<div class="clear"></div>');
			edit_box_input_outer.append(edit_box_input);
			
			edit_box_content.append(edit_box_input_outer);		
		});
		
		// edit box save section
		var edit_box_saved = $('<div class="edit-box-saved">Save Changes</div>');
		edit_box_saved.click(function(){
			xpressCloseBooksOption(editbox, textarea, image_id, overlay);
		});			
		edit_box_content.append($('<div class="edit-box-save-wrapper"></div>').append(edit_box_saved));		

		editbox_container.append(edit_box_title);
		editbox_container.append(edit_box_content);
		editbox.append(editbox_container);								
		
		// create editbox
		$('body').append(editbox.fadeIn(150));
		if(overlay){ $('body').addClass('kode-disable-scroll'); }
		
		// bind the script that execute after the item is added
		editbox.xpressEditBoxLaterScript();
	}
	
	function xpressInitBooksOption(textarea, image_id, caption){
		var slider_data = $.parseJSON(textarea.val());
		var slides = slider_data[1][image_id];

		var slider_option = $('<div class="option-wrapper"></div>');
		
		slider_option.append(
			'<div data-name="slide-link" data-title="Slide Link" data-type="combobox">\
				{"none":"None","current":"Lightbox to Full Image","url":"Link to URL",\
				"image":"Lightbox Image","video":"Lightbox Video"}\
			</div>\
			<div data-name="url" data-title="Specify URL" data-type="text" data-wrapper-class="slide-link-wrapper url-wrapper image-wrapper video-wrapper" ></div>\
			<div data-name="button_txt" data-title="Button Text" data-type="text" data-wrapper-class="slide-link-wrapper url-wrapper image-wrapper video-wrapper" ></div>\
			<div data-name="new-tab" data-title="Open In New Window" data-type="checkbox" data-wrapper-class="slide-link-wrapper url-wrapper"></div>'
		);		
			
		slider_option.children().each(function(){
			if( slides[$(this).attr('data-name')] ){
				$(this).attr('data-value', slides[$(this).attr('data-name')]);
			}
		});
			
		return slider_option;
	}
	
	function xpressCloseBooksOption(editbox, textarea, image_id, overlay){
		var slider_data = $.parseJSON(textarea.val());
		var slide_order = slider_data[0];
		var slides = slider_data[1];
		
		// save the data
		editbox.find('[name]').each(function(){
			if( $(this).attr('type') == 'checkbox' ){
				if( $(this).attr('checked') ){
					slides[image_id][$(this).attr('name')] = 'enable';
				}else{
					slides[image_id][$(this).attr('name')] = 'disable';
				}			
			}else{
				slides[image_id][$(this).attr('name')] = $(this).val();
			}
		});
		textarea.val(JSON.stringify([slide_order, slides]));
		
		// close edit box
		editbox.fadeOut(150, function(){
			editbox.remove();
		});
		
		if(overlay){ $('body').removeClass('kode-disable-scroll'); }	
	}
	

})(jQuery);