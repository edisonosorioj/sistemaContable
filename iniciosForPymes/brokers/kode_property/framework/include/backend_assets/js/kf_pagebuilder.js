(function($){
	
	// update each input when there're any changes
	function xpressUpdateInputBox(){
		$('#page-builder-content-item').find('.content-section-wrapper').each(function(){
			var page_builder = [];
			$('.kode-combobox-wrapper select').chosen();
			$(this).find('.page-builder-item-area').children().each(function(){
				if( $(this).hasClass('kode-draggable-item') ){
					page_builder.push($(this).xpressSaveItem());
				}else if( $(this).hasClass('kode-draggable-wrapper') ){
					page_builder.push($(this).xpressSaveItemWrapper());
				}
			});

			// input area
			$(this).children('.kode-input-hidden').val(JSON.stringify(page_builder));			
		});
	}
	
	
	
	$.fn.xpressSaveItemWrapper = function(){
		var item = new Object();
		
		item['item-type'] = 'wrapper';
		item['item-builder-title'] = $(this).children('.kode-item').find('input.kode-draggable-text-input').val();
		item['type'] = $(this).attr('data-type');
		item['items'] = [];
		item['option'] = new Object();
		
		// assign the item size if any
		if( $(this).children('.kode-item').children('.kode-draggable-head').find('.kode-size-text').length > 0 ){
			item['size'] = $(this).find('.kode-size-text').html();
		}

		// add the option attribute
		$(this).children('.kode-item-option').children().each(function(){	
			if( $(this).attr('data-value') ){
				eval("item['option']['" + $(this).attr('data-name') + "']= $(this).attr('data-value')");
			}else if( $(this).attr('data-default') ){
				eval("item['option']['" + $(this).attr('data-name') + "']= $(this).attr('data-default')");
			}else{
				eval("item['option']['" + $(this).attr('data-name') + "']=''");
			}
		});
				
		// add the child item
		$(this).children('.kode-item').children('.kode-sortable').children().each(function(){
			if( $(this).hasClass('kode-draggable-item') ){
				item['items'].push($(this).xpressSaveItem());
			}else if( $(this).hasClass('kode-draggable-wrapper') ){
				item['items'].push($(this).xpressSaveItemWrapper());
			}			
			
		});
		
		return item;
	}
	$.fn.xpressSaveItem = function(){
		var item = new Object();
		item['item-type'] = 'item';
		item['item-builder-title'] = $(this).children('.kode-item').find('input.kode-draggable-text-input').val();
		item['type'] = $(this).attr('data-type');
		item['option'] = new Object();

		$(this).children('.kode-item-option').children().each(function(){	
			if( $(this).attr('data-value') ){
				eval("item['option']['" + $(this).attr('data-name') + "']=$(this).attr('data-value')");
			}else if($(this).attr('data-default')){
				eval("item['option']['" + $(this).attr('data-name') + "']=$(this).attr('data-default')");
			}else{
				eval("item['option']['" + $(this).attr('data-name') + "']=''");
			}
		});
		
		return item;
	}	
	
	// make the elements sortable
	$.fn.xpressSortable = function(){
		$(this).sortable({
			revert: 100,
			opacity: 0.8,
			tolerance: "pointer",
			placeholder: 'kode-placeholder',
			connectWith: ".kode-sortable",
			start: function(e, ui){
				changed = true;
				
				var kodeproperty_placeholder = $('<div class="kode-placeholder"></div>');
				kodeproperty_placeholder.height(ui.item.outerHeight());

				ui.placeholder.removeClass();
				ui.placeholder.addClass(ui.item.attr('class')).append(kodeproperty_placeholder);
				
				if( ui.item.hasClass('kode-draggable-wrapper') ){
					ui.placeholder.addClass('kode-placeholder-wrapper');
					ui.placeholder.addClass(ui.item.attr('data-type') + '-placeholder');
				}
			},
			receive: function( event, ui ){
				if( $(this).hasClass('kode-inner-sortable') &&
				   ((ui.item.hasClass('kode-draggable-wrapper') &&
					!$(this).hasClass('color-wrapper-sortable') &&
					!$(this).hasClass('parallax-bg-wrapper-sortable') &&
					!$(this).hasClass('full-size-wrapper-sortable')) ||
				    (ui.item.attr('data-type') == 'parallax-bg-wrapper' ||
					ui.item.attr('data-type') == 'color-wrapper' ||
					ui.item.attr('data-type') == 'full-size-wrapper'))
				){
					changed = false;
					ui.sender.sortable("cancel");
				}else{
					ui.item.parents('.kode-sortable').removeClass('blank');
				}
			},
			remove: function( event, ui ){
				if( $(this).children().length <= 0 ){
					$(this).addClass('blank');
				}
			},
			stop: function( event, ui ){
				if( changed ){
					changed = false;
				
					xpressUpdateInputBox();
				}
			}
		});
		
		
	}
	
	function kodeproperty_sortable_item(item){
		item.find('.kode-sortable').sortable({ 
			connectWith				: '.kode-sortable',
			cursor					: 'move',
			forcePlaceholderSize	: true, 
			placeholder				: 'kode-placeholder',
			items					: '.kode-draggable-item',
			opacity					: 0.9,			
		});
		return item;
	}
	
	function kodeproperty_sortable_filter_wrap(item){
		item.find('.kode-sortable').sortable({ 
			connectWith				: '.kode-sortable',
			cursor					: 'move',
			forcePlaceholderSize	: true, 
			placeholder				: 'kode-placeholder',
			items					: '.kode-draggable-wrapper',
			opacity					: 0.9,			
		});
		return item;
	}
	
	
	// add the action to draggable item
	$.fn.xpressDraggable = function(){
		
		// bind the wrapper sortable
		$(this).find('.kode-sortable').xpressSortable();
		
		// bind the item builder name button
		$(this).children('.kode-item').find('input.kode-draggable-text-input').change(function(){
			xpressUpdateInputBox();
		});
		
		// bind the delete item button
		$(this).find('.kode-delete-item').click(function(){
			$(this).closest('.kode-draggable').slideUp(200, function(){
				var sortable_section = $(this).parent('.kode-sortable');				
				if( sortable_section.children().length <= 1 ){
					sortable_section.addClass('blank');
				}	
				
				$(this).remove();
				xpressUpdateInputBox();				
			});							
		});
		
		// bind the edit item button
		$(this).find('.kode-edit-item').click(function(){
			$(this).xpressEditBox( function(){
				xpressUpdateInputBox();
			});
		});
		
		// bind the increase / decrease size button
		var item_size = [
			{ key: '1/5', value: 'one-fifth column' },
			{ key: '1/4', value: 'three columns' },	
			{ key: '1/3', value: 'four columns' },
			{ key: '2/5', value: 'two-fifth column' },	
			{ key: '1/2', value: 'six columns' },	
			{ key: '3/5', value: 'three-fifth column' },
			{ key: '2/3', value: 'eight columns' },
			{ key: '3/4', value: 'nine columns' },	
			{ key: '4/5', value: 'four-fifth column' },
			{ key: '1/1', value: 'tweleve columns' }		
		];
		
		// bind the clone item button
		$(this).find('.kode-clone-item').click(function(){
			var element = $(this).closest('.kode-draggable');
			
			// sortable destroy, clone & init for cloned element
			var column = element.siblings('.kode-draggable-wrapper');
			if(column.length){
				var clone = element.clone(true);
				kodeproperty_sortable_filter_wrap(element);
				kodeproperty_sortable_filter_wrap(clone);
			}else{
				element.find('.kode-sortable').sortable('destroy');
				var clone = element.clone(true);
				kodeproperty_sortable_item(element);
				kodeproperty_sortable_item(clone);
			}		
			
			
			element.after(clone);
			xpressUpdateInputBox();				
						
		});

		$(this).find('.kode-increase-size, .kode-decrease-size').click(function(){
			var draggable_item = $(this).closest('.kode-draggable');
			var size_text = $(this).parent('.kode-size-control').siblings('.kode-size-text');
			var current_size = size_text.html();
			
			// get the current size and remove the class out
			var index = 0;
			for (index = 0; index < item_size.length; index++) {
				if( item_size[index].key == current_size ){ break; }
			}
			draggable_item.removeClass(item_size[index].value);
			
			// change to next size
			if( $(this).hasClass('kode-increase-size') && (index <= item_size.length-2)  ){
				index++;
			}else if( $(this).hasClass('kode-decrease-size') && (index >= 1) ){
				index--;
			}
			size_text.html(item_size[index].key);
			draggable_item.addClass(item_size[index].value);
			
			xpressUpdateInputBox();
		});

	}

	$(document).ready(function(){
		$('.kode-combobox-wrapper select').chosen();
	
		var page_builder = $('#kode-page-builder');
		
		var add_item_section = page_builder.children('#page-builder-add-item');
		var default_item_section = page_builder.children('#page-builder-default-item');
		var content_item_section = page_builder.children('#page-builder-content-item');
		
		// add action to the saved items
		page_builder.find('.kode-draggable').xpressDraggable();
		
		// make the wrapper elements sortable
		content_item_section.find('.kode-sortable').xpressSortable();
		
		// add new item to the sortable area
		$('.k_list_item').click(function(){
			var selected_item = $(this).data('slug');
			var container_area = content_item_section.find('.with-sidebar-section .kode-sortable-wrapper').children('.kode-sortable');
	
			var kbuilder_item = default_item_section.children('#' + selected_item + '-default').children('.kode-draggable').clone().css('display', 'none');
			kbuilder_item.appendTo(container_area.removeClass('blank')).fadeIn(200).xpressDraggable();
			
			xpressUpdateInputBox();
		});
		
		
	
	});
})(jQuery);

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
	
	// datepicker
	$('.kode-date-picker').datepicker({
		dateFormat : 'yy-mm-dd',
		yearRange: "-100:+0",
		changeMonth: true,
		changeYear: true
	});	
});	