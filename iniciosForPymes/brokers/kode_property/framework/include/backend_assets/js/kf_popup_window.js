(function($){	
	
	// trigger this function to save the tabs data
	function xpressSaveTabAction( textarea ){
		var accordion = [];
		var container = textarea.siblings('.tabs-container');
		
		container.children().each(function(){
			var item = new Object;
		
			$(this).find('[data-name]').each(function(){
				eval("item['" + $(this).attr('data-name') + "']= $(this).val()");
			});
			
			accordion.push(item);
		});
		
		textarea.val(JSON.stringify(accordion));
	}
	
	// use this function to crate the tab item
	function xpressCreateTabItem( options ){
        var settings = $.extend({
			textarea: '',
			active: false,
			default_item: '',
			title: '',
			value: ''
        }, options);		
	
		var tab_item = $('<div class="tab-item-wrapper"></div>');
		var tab_head = $('<div class="tab-item-head"></div>');
		var tab_text = $('<span class="tab-item-head-text">' + settings.title + '<span>');
		var tab_head_open = $('<div class="tab-item-head-open"></div>');
		var tab_content = $('<div class="tab-item-content"></div>');
		
		if( settings.active ){ 
			tab_head_open.addClass('active'); 
		}else{
			tab_content.css('display', 'none'); 
		}
		
		// bind open tab button
		tab_head_open.click(function(){
			if( $(this).hasClass('active') ){
				$(this).removeClass('active');
				$(this).parent('.tab-item-head').siblings('.tab-item-content').slideUp();
			}else{
				$(this).addClass('active');
				$(this).parent('.tab-item-head').siblings('.tab-item-content').slideDown();
			}				
		});
		
		var tab_head_delete = $('<div class="tab-item-head-delete"></div>');
		
		tab_head_delete.click(function(){
			$('body').kodeproperty_confirm({
				success: function(){
					tab_item.slideUp(function(){
						$(this).remove();
						xpressSaveTabAction(settings.textarea);
					});				
				}
			});

		});		

		// create and slide the tab item
		tab_head.append(tab_text)
				.append(tab_head_open)
				.append(tab_head_delete);
		tab_item.append(tab_head)
				.append(tab_content.append(settings.default_item));

		// assign the value
		if( settings.value ){
			tab_item.find('[data-name]').each(function(){
				$(this).val( settings.value[$(this).attr('data-name')] );
			});
		}				
				
		// bind upload button ( if any )
		tab_item.find('.kode-upload-wrapper .kdf-text-input').each(function(){
			if( $(this).val() ){
				$(this).siblings('.kode-upload-img-sample').attr('src', $(this).val()).removeClass('blank');
			}
			
			$(this).change(function(){
				$(this).siblings('.kode-upload-box-hidden').val($(this).val());
				if( $(this).val() == '' ){ 
					$(this).siblings('.kode-upload-img-sample').addClass('blank').trigger('change'); 
				}else{
					$(this).siblings('.kode-upload-img-sample').attr('src', $(this).val()).removeClass('blank').trigger('change');
				}
			});
		});
		tab_item.find('.kode-upload-box-button').click(function(){
			var upload_button = $(this);
			var custom_uploader = wp.media({
				title: 'Author Image',
				button: { text: 'Assign Image' },
				library : { type : 'image' },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				upload_button.siblings('.kode-upload-img-sample').attr('src', attachment.url).removeClass('blank');
				upload_button.siblings('.kdf-text-input').val(attachment.url);
				upload_button.siblings('.kode-upload-box-hidden').val(attachment.id).trigger('change');
			}).open();			
		});		
				
		// bind the changes event
		tab_item.find('[data-name]').change(function(){
			xpressSaveTabAction(settings.textarea);
				
			if( $(this).attr('data-name') == 'kdf-tab-title' ){
				tab_text.html($(this).val());
			}
		});				
				
		return tab_item;
	}
	
	// a function to initaite the tabs input
	$.fn.xpressAddMoreTabs = function( options ){
        var settings = $.extend({
			default_item: '',
			default_title: '',
			textarea: '',
        }, options);		
	
		// initiate the tab section
		var tabs = $('<div class="tab-wrapper"></div>');
		var add_button = $('<div class="add-more-tabs"><i class="fa fa-plus"></i></div>');
		var container = $('<div class="tabs-container"></div>');
		container.sortable({
			revert: 100,
			opacity: 0.8,
			forcePlaceholderSize: true,
			placeholder: 'kode-placeholder',
			update: function(){
				xpressSaveTabAction(settings.textarea);
			}
		});
		tabs.append( $('<div class="add-button-wrapper" ></div>')
						.append(add_button)
						.append('<span>ADD MORE TABS</span>') )
			.append( container )
			.append( settings.textarea );
		
		// create the accordion from saved value
		if( settings.textarea.val() ){
			var current_item = $.parseJSON(settings.textarea.val());
			for (var i=0; i<current_item.length; i++){
				var item_title = current_item[i]['kdf-tab-title'];
				if( !item_title ){ item_title = settings.default_title; }
				
				var tab_item = xpressCreateTabItem({
					default_item : settings.default_item, 
					title : item_title,
					value: current_item[i],
					textarea: settings.textarea
				});
				container.append(tab_item);
			}
		}
			
		// add action to add new tab item
		add_button.click(function(){	

			var tab_item = xpressCreateTabItem({
				default_item : settings.default_item, 
				title : settings.default_title,
				active : true,
				textarea: settings.textarea
			});
			container.append(tab_item.css('display','none'));
			tab_item.slideDown(300);	

			// update the tab textarea
			xpressSaveTabAction(settings.textarea);
		});
			
		$(this).append( tabs );
	}
	
	$.fn.xpressEditBoxTab = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).xpressAddMoreTabs({
			default_item	: 	'<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Title</div>\
									<input type="text" class="kdf-text-input" data-name="kdf-tab-title" />\
								</div>\
								<div class="edit-box-input-wrapper">\
									<div class="input-box-title">Content</div>\
									<textarea data-name="kdf-tab-content" ></textarea>\
								</div>', 
			default_title	: 	option.attr('data-default-title'),
			textarea		: 	$('<textarea class="kode-input-hidden" name="' + option.attr('data-name') + '">' + value + '</textarea>')
		});
	}
	
	var kodeproperty_tmce_set = false;
	
	// create a kode editbox to the bottom of body section
	$.fn.xpressEditBox = function( ending ){
		
		// trigger the visual editor for the first time
		if( !kodeproperty_tmce_set ){
			if( $('#wp-content-wrap').hasClass('html-active') ){
				$('#content-tmce').trigger('click');
				kodeproperty_tmce_set = true;
			}
		}
	
		var editbox = $('<div class="edit-box-wrapper"></div>');
		var editboxoption = $(this).closest('.kode-draggable').children('.kode-item-option');
		
		editbox.xpressCreateEditBoxContainer( editboxoption, ending  );
		editbox.xpressCreateEditBoxOverlay( editboxoption, ending  );
		
		// add editbox at the bottom of body selector
		$('#page-builder-content-item').append(editbox.fadeIn(150)).addClass('kode-disable-scroll');
		
		// bind the script that execute after the item is added
		editbox.xpressEditBoxLaterScript();
	}
	
	// create and bind events to background overlay
	$.fn.xpressCreateEditBoxOverlay = function( editboxoption, ending ){
		var editbox = $(this);
		var editbox_overlay = $('<div class="edit-box-overlay"></div>');
		
		editbox_overlay.click(function(){
			$(this).xpressRemoveEditBox( editbox, editboxoption, ending );
		});
		editbox.append(editbox_overlay);	
	}
	
	// create and bind events to background overlay
	$.fn.xpressCreateEditBoxContainer = function( options, ending ){
		var editbox = $(this);
		var editbox_container = $('<div class="edit-box-container"></div>');
		
		// bind the editbox close / create the editbox title section
		var edit_box_close = $('<div class="edit-box-close"></div>');
		edit_box_close.click(function(){
			$(this).xpressRemoveEditBox( editbox, options, ending );
		});		
		
		// edit box id 
		var edit_box_head = $('<div class="edit-box-input-head" ></div>')
								.append('<span>ID :</span> ')
								.append($('<input type="text" name="page-item-id" value="' + options.children('[data-name="page-item-id"]').attr('data-value') + '" />'));
							
		var edit_box_title = $('<div class="edit-box-title-wrapper"></div>')
								.append('<h3 class="edit-box-title">Options</div>')
								//.append(edit_box_head)
								.append(edit_box_close);

		// create the editbox content section
		var edit_box_content = $('<div class="edit-box-content"></div>');
		options.children().each(function(){
			if( $(this).attr('data-name') == 'page-item-id' ) return;
		
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
				case 'colorpicker' : edit_box_input.xpressEditBoxColor($(this)); break;
				case 'combobox' : edit_box_input.xpressEditBoxCombobox($(this)); break;
				case 'combobox_sidebar' : edit_box_input.xpressEditBoxCombobox_Sidebar($(this)); break;				
				case 'multi-combobox' : edit_box_input.xpressEditBoxMultipleCombobox($(this)); break;
				case 'slider' : edit_box_input.xpressEditBoxSlider($(this)); break;
				case 'gallery' : edit_box_input.xpressEditBoxGallery($(this)); break;
				case 'tab' : edit_box_input.xpressEditBoxTab($(this)); break;				
				case 'radioimage' : edit_box_input.xpressEditBoxRadioImage($(this)); break;
				case 'styles' : edit_box_input.xpressEditBoxStyleImage($(this)); break;
				case 'text' : edit_box_input.xpressEditBoxInput($(this)); break;
				case 'textarea' : edit_box_input.xpressEditBoxTextArea($(this)); break;
				case 'tinymce' : edit_box_input.xpressEditBoxTinyMCE($(this)); break;				
				case 'upload' : edit_box_input.xpressEditBoxUpload($(this)); break;
			}
			edit_box_input.append('<div class="clear"></div>');
			edit_box_input_outer.append(edit_box_input);
			
			// print input description
			if( $(this).attr('data-description') ){
				edit_box_input.addClass('with-description');
				edit_box_input_outer.append('<div class="edit-box-description">' + $(this).attr('data-description') + '</div>' );
				edit_box_input_outer.append('<div class="clear"></div>');
			}	
			
			edit_box_content.append(edit_box_input_outer);
		});
		
		// edit box save section
		var edit_box_saved = $('<div class="edit-box-saved">Save Changes</div>');
		edit_box_saved.click(function(){
			$(this).xpressRemoveEditBox( editbox, options, ending );
		});			
		edit_box_content.append($('<div class="edit-box-save-wrapper"></div>').append(edit_box_saved));
		
		editbox_container.append(edit_box_title);
		editbox_container.append(edit_box_content);
		editbox.append(editbox_container);
	}	
	
	// save the settings and remove the editbox
	$.fn.xpressRemoveEditBox = function( editbox, options, ending ){
	
		// save the data when the box is about to close
		editbox.find('.edit-box-input-wrapper, .edit-box-input-head').each(function(){
			
			var data_name = '';
			var data_value = '';
			
			$(this).find('[name]').each(function(){
					data_name = $(this).attr('name');
					
					// input type = text
					if( $(this).attr('type') == 'text' ){
						data_value = $(this).val();
						
						if( data_name == 'page-item-id' ){
							data_value = kodeproperty_css_name_check(data_value);
						}
						
					// input type = checkbox
					}else if( $(this).attr('type') == 'checkbox' ){
						if( $(this).attr('checked') ){
							data_value = 'enable';
						}else{
							data_value = 'disable';
						}
					
					// input type = tinymce
					}else if( $(this).is('textarea[id^=kode-editor-]') ){
					
						if( typeof(tinyMCE) != "undefined" && typeof(tinyMCE.majorVersion) != "undefined" && 
							tinyMCE.majorVersion >= 4 ){

							var temp_tmce = tinyMCE.get($(this).attr('id'))
							if( temp_tmce.isHidden() ){
								window.switchEditors.go(tinymce_id, 'tmce');
								temp_tmce.setContent( window.switchEditors.wpautop(current_tinymce.find('#'+tinymce_id).val()), {format:'raw'} );							
							}
							data_value = temp_tmce.getContent()
							temp_tmce = temp_tmce.remove();			
						}else{
							tinyMCE.execCommand("mceRemoveControl", false, $(this).attr('id'));
							tinyMCE.triggerSave();
							data_value = $(this).val();	
						}

					// input type = textarea
					}else if( $(this).is('textarea') ){
						data_value = $(this).val();
						
					// input type = multi-combobox
					}else if( $(this).is('select[multiple]') ){
						if( $(this).val() ){
							data_value = $(this).val().join();
						}

					// input type = combobox					
					}else if( $(this).is('select') ){
						data_value = $(this).val();
					
					// input type = radioimage
					}else if( $(this).is('input[type="radio"]:checked') ){
						data_value = $(this).val();
					}
			
			});

			// assign the value back to default area
			options.children('[data-name="' + data_name + '"]').attr('data-value', data_value);
		
		});
	
		// remove the box out
		editbox.fadeOut(150, function(){
			editbox.remove();
		});
		
		$('body').removeClass('kode-disable-scroll');
		
		if(typeof(ending) == 'function'){ 
			ending();
		}
	}
	
	
	
	/*------------------------------------------------*/
	/*--------     ELEMENT INPUT SECTION     ---------*/
	/*------------------------------------------------*/
	
	$.fn.xpressEditBoxInput = function( option ){	
		var value = option.attr('data-value');
		if ((typeof value == 'undefined') && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
		
		$(this).append( '<input type="text" name="' + option.attr('data-name') + '" class="kdf-text-input" value="' + kodeproperty_esc_attr(value) + '" />');
	}
	
	$.fn.xpressEditBoxTextArea = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}
	
		$(this).append( '<textarea name="' + option.attr('data-name') + '">' + value + '</textarea>');
	}	
	
	$.fn.xpressEditBoxSlider = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}

		var textarea = $('<textarea></textarea>')
							.addClass('kode-input-hidden kode-slider-selection')
							.attr('name', option.attr('data-name'))
							.attr('data-overlay', option.attr('data-overlay'))
							.attr('data-caption', option.attr('data-caption'))
							.val(value);
		
		$(this).append(textarea);
	}	
	
	$.fn.xpressEditBoxGallery = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined' && option.attr('data-default')) {
			value = option.attr('data-default');
		}else if(typeof value == 'undefined'){
			value = '';
		}

		var textarea = $('<textarea></textarea>')
							.addClass('kode-input-hidden kode-gallery-selection')
							.attr('name', option.attr('data-name'))
							.attr('data-overlay', option.attr('data-overlay'))
							.attr('data-caption', option.attr('data-caption'))
							.val(value);
		
		$(this).append(textarea);
	}	
	
	$.fn.xpressEditBoxCheckBox = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}	
		
		// create the checkbox
		var checkbox_wrapper = $('<div class="onoffswitch primary inline-block">');
		var checkbox = $('<input type="checkbox" class="onoffswitch-checkbox" id="' + option.attr('data-name') + '-id" name="' + option.attr('data-name') + '" />');		
		if( value == 'enable' ){
			checkbox.attr('checked','checked');
		}
		
		// bind the checkbox script
		checkbox.click(function(){	
			if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
				$(this).siblings('.checkbox-appearance').removeClass('enable');
				$(this).siblings('.checkbox-appearance').addClass('disable');
			}else{
				$(this).siblings('.checkbox-appearance').addClass('enable');
				$(this).siblings('.checkbox-appearance').removeClass('disable');
			}
		});
		
		checkbox_wrapper.append('<div class="checkbox-appearance ' + value + '" > </div>');			
		checkbox_wrapper.append( checkbox );	
		checkbox_wrapper.append('<label class="onoffswitch-label" for="' + option.attr('data-name') + '-id"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label>');	
		
		$(this).append( checkbox_wrapper );
		
		
		
		
	}	
		
	$.fn.xpressEditBoxCombobox = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}		
	
		var combobox = $('<select name="' + option.attr('data-name') + '"></select>');
		var options = $.parseJSON( option.html() );

		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				if( property == value ){
					combobox.append('<option value="' + property + '" selected >' + options[property] + '</option>');
				}else{
					combobox.append('<option value="' + property + '" >' + options[property] + '</option>');
				}				
			}
		}		
		
		$(this).append($('<div class="kode-combobox-wrapper"></div>').append(combobox));
	}	
	
	$.fn.xpressEditBoxCombobox_Sidebar = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}		
	
		var combobox = $('<select name="' + option.attr('data-name') + '"></select>');
		var options = $.parseJSON( option.html() );

		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				if( options[property] == value ){
					combobox.append('<option value="' + options[property] + '" selected >' + options[property] + '</option>');
				}else{
					combobox.append('<option value="' + options[property] + '" >' + options[property] + '</option>');
				}				
			}
		}		
		
		$(this).append($('<div class="kode-combobox-wrapper"></div>').append(combobox));
	}
	
	$.fn.xpressEditBoxRadioImage = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}		
	
		var radio_image = '';
		var options = $.parseJSON( option.html() );
		
		var i = 0;
		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				radio_image += '<label for="' + option.attr('data-name') + '-id' + i + '" class="radio-image-wrapper ';
				radio_image += (value == property)? 'active ': '';
				radio_image += '">';
				radio_image += '<img src="' + options[property] + '" alt="" />';
				radio_image += '<div class="selected-radio"></div>';

				radio_image += '<input type="radio" name="' + option.attr('data-name') + '" ';
				radio_image += 'id="' + option.attr('data-name') + '-id' + i + '" value="' + property + '" ';
				radio_image += (value == property)? 'checked ': '';
				radio_image += ' />';

				radio_image += '</label>';	
				i++;
			}
		}		
		
		$(this).append(radio_image);
	}
	
	$.fn.xpressEditBoxStyleImage = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}		
	
		var radio_image = '';
		var options = $.parseJSON( option.html() );
		
		var i = 0;
		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				radio_image += '<label for="' + option.attr('data-name') + '-id' + i + '" class="radio-image-wrapper ';
				radio_image += (value == property)? 'active ': '';
				radio_image += '">';
				radio_image += '<img src="' + options[property] + '" alt="" />';
				radio_image += '<div class="selected-radio"></div>';

				radio_image += '<input type="radio" name="' + option.attr('data-name') + '" ';
				radio_image += 'id="' + option.attr('data-name') + '-id' + i + '" value="' + property + '" ';
				radio_image += (value == property)? 'checked ': '';
				radio_image += ' />';

				radio_image += '</label>';	
				i++;
			}
		}		
		
		$(this).append(radio_image);
	}	
	
	$.fn.xpressEditBoxMultipleCombobox = function( option ){	
		var value;
		if (typeof option.attr('data-value') != 'undefined') {
			value = option.attr('data-value').split(',');
		}else if( typeof option.attr('data-default') != 'undefined' ){
			value = option.attr('data-default').split(',');
		}else{
			value = [];
		}
	
		var combobox = $('<select multiple name="' + option.attr('data-name') + '"></select>');
		var options = $.parseJSON( option.html() );

		for (var property in options) {
			if (options.hasOwnProperty(property)) {
				if( value.indexOf(property) >= 0 ){
					combobox.append('<option value="' + property + '" selected >' + options[property] + '</option>');
				}else{
					combobox.append('<option value="' + property + '" >' + options[property] + '</option>');
				}				
			}
		}		

		$(this).append($('<div class="kode-multi-combobox-wrapper"></div>').append(combobox));
	}		
	
	$.fn.xpressEditBoxColor = function( option ){	
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			value = option.attr('data-default');
		}
		
		var color_picker = $('<input type="text" />');
			color_picker.addClass('kode-colorpicker')
						.attr('name', option.attr('data-name'))
						.attr('data-default-color', option.attr('data-default'))
						.val(value);
		
		$(this).append( color_picker );
	}	
	
	$.fn.xpressEditBoxUpload = function( option ){	
	
		// create upload html section
		var upload_wrapper = $('<div class="kode-upload-wrapper" ></div>');
		var sample_image = $('<img class="kode-upload-img-sample" />');
		var input_text = $('<input type="text" class="kdf-text-input" />');
		if( option.html() ){
			sample_image.attr('src', option.html());
			input_text.val(option.html());
		}else{
			sample_image.addClass('blank');
		}
		var input_hidden = $('<input type="text" />')
									.addClass('kode-upload-box-hidden')
									.attr('name', option.attr('data-name'))
									.val(option.attr('data-value'));
		var upload_button = $('<input type="button" />')
									.addClass('kode-upload-box-button kdf-button')
									.val(option.attr('data-button'));
		
		// upload script
		input_text.change(function(){	
			option.html($(this).val());
			input_hidden.val($(this).val());
			
			if( $(this).val() == '' ){ 
				sample_image.addClass('blank'); 
			}else{
				sample_image.attr('src', $(this).val()).removeClass('blank');
			}
		});		
		upload_button.click(function(){
			var custom_uploader = wp.media({
				title: option.attr('data-title'),
				button: { text: upload_button.val() },
				library : { type : 'image' },
				multiple: false
			}).on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				
				sample_image.attr('src', attachment.url).removeClass('blank');
				input_text.val(attachment.url);
				input_hidden.val(attachment.id);
				option.html(attachment.url);
			}).open();			
		});		
		
		upload_wrapper.append(sample_image).append('<div class="clear"></div>')
						.append(input_text)
						.append(input_hidden)
						.append(upload_button);
		$(this).append(upload_wrapper);
	}	
	
	$.fn.xpressEditBoxTinyMCE = function( option ){	
		var container = $(this);
		var tinymce_id = 'kode-editor-' + option.attr('data-name');
		var value = option.attr('data-value');
		if (typeof value == 'undefined') {
			if( option.attr('data-default') ){
				value = option.attr('data-default');
			}else{
				value = '';
			}
		}	
		 
		current_tinymce = $('<div class="kode-tinymce wp-core-ui wp-editor-wrap tmce-active" data-id="' + tinymce_id + '" >\
							<div class="wp-editor-tools hide-if-no-js">\
							<div class="wp-media-buttons">\
							<a href="#" class="button insert-media add_media" data-editor="' + tinymce_id + '" title="Add Media">\
							<span class="wp-media-buttons-icon"></span>Add Media\
							</a>\
							</div>\
							<div class="wp-editor-tabs">\
							<a class="wp-switch-editor switch-html" >Text</a>\
							<a class="wp-switch-editor switch-tmce" >Visual</a>\
							</div>\
							</div>\
							<div class="wp-editor-container">\
							<textarea class="wp-editor-area" rows="20" cols="40" name="' + option.attr('data-name') + '" id="' + tinymce_id + '">' + kodeproperty_esc_attr(value) + '</textarea>\
							</div>\
							</div>');
							
		container.append(current_tinymce);					
	}		
	
	// Bind the srcipt that execute after the edit box is added to the content
	$.fn.xpressEditBoxLaterScript = function(){
		
		// color picker script
		$(this).find('.kode-colorpicker').wpColorPicker();
	
		// combobox script
		$(this).find('select').not('[multiple]').each(function(){
			$(this).change(function(){
				var wrapper = $(this).attr('name') + '-wrapper';
				var selected_wrapper = $(this).val() + '-wrapper';
			
				$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
					if($(this).hasClass(selected_wrapper)){
						$(this).slideDown(300);
					}else{
						$(this).slideUp(300);
					}			
				});
			});
			$(this).each(function(){
				var wrapper = $(this).attr('name') + '-wrapper';
				var selected_wrapper = $(this).val() + '-wrapper';

				$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
					if($(this).hasClass(selected_wrapper)){
						$(this).css('display', 'block');
					}else{
						$(this).css('display', 'none');
					}			
				});
			});			
		});
		
		// combobox script
		$(this).find('input[type="checkbox"]').each(function(){
			$(this).change(function(){
				if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
					var wrapper = $(this).attr('name') + '-wrapper';		
					var selected_wrapper = $(this).val() + '-wrapper';
					$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
							
						$(this).slideDown(300);		
					});
					
				}else{
					var wrapper = $(this).attr('name') + '-wrapper';		
					var selected_wrapper = $(this).val() + '-wrapper';
					$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
						$(this).slideUp(300);			
					});
				}
			});
			$(this).each(function(){
				if( $(this).siblings('.checkbox-appearance').hasClass('enable') ){
					var wrapper = $(this).attr('data-slug') + '-wrapper';		
					var selected_wrapper = $(this).val() + '-wrapper';
					$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
						$(this).css('display', 'block');
					});
				}else{
					var wrapper = $(this).attr('data-slug') + '-wrapper';		
					var selected_wrapper = $(this).val() + '-wrapper';
					$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
						$(this).css('display', 'none');
					});
				}
			});			
		});
			
		// combobox script
		$(this).find('input[type="radio"]').each(function(){
			$(this).change(function(){
				$(this).parent().siblings('label').children('input').attr('checked', false); 
				$(this).parent().addClass('active').siblings('label').removeClass('active');
				
				var wrapper = $(this).attr('name') + '-wrapper';
				var selected_wrapper = $(this).val() + '-wrapper';
				$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
					if($(this).hasClass(selected_wrapper)){
						$(this).slideDown(300);
					}else{
						$(this).slideUp(300);
					}
				});
			});
			$(this).each(function(){
				$(this).parent().siblings('label').children('input').attr('checked', false); 
				$(this).parent().addClass('active').siblings('label').removeClass('active');
				
				var wrapper = $(this).attr('name') + '-wrapper';
				var selected_wrapper = $(this).val() + '-wrapper';
				$(this).parents('.edit-box-input-wrapper').siblings('.' + wrapper).each(function(){
					if($(this).hasClass(selected_wrapper)){
						$(this).css('display', 'block');
					}else{
						$(this).css('display', 'none');
					}
				});
				
			});			
		});
		
		// radio-image-script
		$('.radio-image-wrapper input[type="radio"]').change(function(){
			$(this).parent().siblings('label').children('input').attr('checked', false); 
			$(this).parent().addClass('active').siblings('label').removeClass('active');
		});
		
		// slider script
		$(this).find('textarea.kode-slider-selection').each(function(){
			$(this).xpressCreateSliderSelection();	
		});
		
		// Gallery script
		$(this).find('textarea.kode-gallery-selection').each(function(){
			$(this).xpressCreateGallerySelection();
		});
	
		// for tiny mce
		$(this).find('.kode-tinymce').each(function(){
			current_tinymce = $(this);
			tinymce_id = $(this).attr('data-id');
			
			// add the quick tag to html editor area
			quicktags({ id: tinymce_id });
			QTags._buttonsInit(); 
		
			if( typeof(tinyMCE) != "undefined" && typeof(tinyMCE.majorVersion) != "undefined" && 
				tinyMCE.majorVersion >= 4 ){
				
				var temp_settings = tinyMCEPreInit.mceInit.content; // tinyMCE.editors[0].settings;
				temp_settings.selector = "#" + tinymce_id
				temp_settings.toolbar1 = temp_settings.toolbar1.replace(',wp_fullscreen', '');
				temp_settings.force_br_newlines = true;
				temp_settings.force_p_newlines = true;
				temp_settings.forced_root_blocks = false;
				tinyMCE.init(temp_settings);
				
				// bind the html/visual editor button
				current_tinymce.find('.wp-switch-editor').each(function(){
					$(this).click(function(){					
						if( $(this).hasClass('switch-html') ){
							current_tinymce.removeClass('tmce-active').addClass('html-active');
							window.switchEditors.go(tinymce_id, 'html');
						}else if( $(this).hasClass('switch-tmce') ){
							current_tinymce.removeClass('html-active').addClass('tmce-active');
							window.switchEditors.go(tinymce_id, 'tmce');
							tinyMCE.get(tinymce_id).setContent(
								window.switchEditors.wpautop(current_tinymce.find('#'+tinymce_id).val()), {format:'raw'}
							);
						}
					});
				});		
		
			}else{

				// bind the html/visual editor button
				current_tinymce.find('.wp-switch-editor').each(function(){
					$(this).removeAttr('onClick');
					$(this).click(function(){					
						if( $(this).hasClass('switch-html') ){
							current_tinymce.removeClass('tmce-active').addClass('html-active');
							tinyMCE.execCommand("mceRemoveControl", false, tinymce_id);					
						}else if( $(this).hasClass('switch-tmce') ){
							current_tinymce.removeClass('html-active').addClass('tmce-active');
							tinyMCE.execCommand("mceAddControl", false, tinymce_id);

							window.tinyMCE.get(tinymce_id).setContent(
								window.switchEditors.wpautop(current_tinymce.find('#'+tinymce_id).val()), {format:'raw'}
							);
						}
					});
					
					if( $(this).hasClass('switch-tmce') ){ 
						$(this).trigger('click'); 
					}
				});				
			}
			
		});

	}

})(jQuery);
