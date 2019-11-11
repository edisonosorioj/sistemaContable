<?php
	/*	
	*	kode-property-list Property Option file
	*	---------------------------------------------------------------------
	*	This file creates all property options and attached to the theme
	*	---------------------------------------------------------------------
	*/
	
	// add a property option to property page
	if( is_admin() ){ add_action('after_setup_theme', 'kodeproperty_create_property_options'); add_action('init', 'kodeproperty_create_property_options');}
	if( !function_exists('kodeproperty_create_property_options') ){
	
		function kodeproperty_create_property_options(){
			global $kodeproperty_plugin_option;
			$kodeproperty_func_utility = new kodeproperty_func_utility();
			$kode_custom_fields = kode_custom_fields_post_type();
			if(empty($kode_custom_fields)){$kode_custom_fields = array();}
			if(!isset($kodeproperty_plugin_option['sidebar-element'])){$kodeproperty_plugin_option['sidebar-element'] = array('blog','contact');}
			if( !class_exists('kodeproperty_page_options') ) return;
			new kodeproperty_page_options( 
				
				// page option settings
				array(
					'page-layout' => array(
						'title' => __('Page Layout', 'kode-property-list-list'),
						'options' => array(
							'sidebar' => array(
								'type' => 'radioimage',
								'description' => 'Please select the side bar position from here.',
								'options' => array(
									'no-sidebar'=>		KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/no-sidebar.png',
									'both-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/both-sidebar.png', 
									'right-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/right-sidebar.png',
									'left-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/left-sidebar.png'
								),
								'default' => 'no-sidebar'
							),	
							'left-sidebar' => array(
								'title' => __('Left Sidebar' , 'kode-property-list-list'),
								'type' => 'combobox_sidebar',
								'options' => $kodeproperty_plugin_option['sidebar-element'],
								'wrapper-class' => 'sidebar-wrapper left-sidebar-wrapper both-sidebar-wrapper'
							),
							'right-sidebar' => array(
								'title' => __('Right Sidebar' , 'kode-property-list-list'),
								'type' => 'combobox_sidebar',
								'options' => $kodeproperty_plugin_option['sidebar-element'],
								'wrapper-class' => 'sidebar-wrapper right-sidebar-wrapper both-sidebar-wrapper'
							),						
						)
					),
					
					'page-option' => array(
						'title' => __('Page Option', 'kode-property-list-list'),
						'options' => array(
							'page-caption' => array(
								'title' => __('Page Caption' , 'kode-property-list-list'),
								'type' => 'text',
								'description' => 'Please enter the Caption for the page here.',
							),							
							'header-background' => array(
								'title' => __('Header Background Image' , 'kode-property-list-list'),
								'button' => __('Upload', 'kode-property-list-list'),
								'type' => 'upload',
								'description' => 'Click here to Upload the Header Background Image.',
							),
							'property-feature'=> array(
								'title'=> esc_html__('Feature Property' ,'kode-property-list-list'),
								'type'=> 'combobox',
								'options'=> array(
									'no' => esc_html__('No', 'kode-property-list-list'),
									'yes' => esc_html__('Yes', 'kode-property-list-list'),
								),
								'default'=>'no'
							),
							'header-element-title' => array(
								'header_title' => __('Address Detail' , 'kode-property-list-list'),
								'type' => 'header',								
								'wrapper-class' => 'kode-header-class',
							),
							'map_icon' => array(
								'title' => __('Market Icon of this Location' , 'kode-property-list-list'),
								'button' => __('Upload', 'kode-property-list-list'),
								'type' => 'upload',
								'description' => 'Click here to Upload the market icon of this location.',
							),
							'property-location' => array(
								'title' => __('Address' , 'kode-property-list-list'),
								'type' => 'text',
								'id' => 'property-address',
								'description' => 'Please enter the address of this property.',
							),
							'property-radius' => array(
								'title' => __('Radius' , 'kode-property-list-list'),
								'type' => 'text',
								'id' => 'property-radius',
								'description' => 'Please enter the address of this property.',
							),	
							'property-map' => array(
								'title' => __('Google Map' , 'kode-property-list-list'),
								'type' => 'map',
								'id' => 'property-map',
								'description' => 'Please enter the address of this property.',
							),
							'property-lat' => array(
								'title' => __('Location Latitude' , 'kode-property-list-list'),
								'type' => 'text',
								'id' => 'property-lat',
								'description' => 'Please enter the address of this property.',
							),	
							'property-lon' => array(
								'title' => __('Location Longitude' , 'kode-property-list-list'),
								'type' => 'text',
								'id' => 'property-lon',
								'description' => 'Please enter the address of this property.',
							),
							'property-element-detail' => array(
								'header_title' => __('Property Detail' , 'kode-property-list-list'),
								'type' => 'header',								
								'wrapper-class' => 'kode-header-class',
							),
							'property-type'=> array(
								'title'=> esc_html__('Propiedad para' ,'kode-property-list-list'),
								'type'=> 'combobox',
								'options'=> array(
									'sale' => esc_html__('Venta', 'kode-property-list-list'),
									'purchase' => esc_html__('Subastas', 'kode-property-list-list'),
									'rent' => esc_html__('Alquiler', 'kode-property-list-list'),
								),
								'default'=>'sale'
							),	
							'property-currency' => array(
								'title' => __('Property Price Prefix' , 'kode-property-list-list'),
								'type' => 'text',								
								'description' => 'Please enter the property price prefix for example: $',
							),
							'property-price' => array(
								'title' => __('Property Price' , 'kode-property-list-list'),
								'type' => 'text',								
								'description' => 'Please enter the property price without comma (,) or hyphen (-) or currency symbol for example: 5000.',
							),
							'property-space' => array(
								'title' => __('Property Space' , 'kode-property-list-list'),
								'type' => 'text',								
								'description' => 'Please enter the property space in square feet in numeric figure for you dont need to write sqft with it example:2000.',
							),
							'property-bed' => array(
								'title' => __('Bed' , 'kode-property-list-list'),
								'type' => 'text',								
								'description' => 'Please enter the bed rooms of this property.',
							),
							'bed-icon' => array(
								'title' => __('Bed Icon' , 'kode-property-list-list'),
								'type' => 'text',
								'default' => 'fa fa-bed',
								'description' => 'Please enter the font awesome / SVC icon code here.',
							),
							'property-bath' => array(
								'title' => __('Bath' , 'kode-property-list-list'),
								'type' => 'text',								
								'description' => 'Please enter the Baths of this property.',
							),
							'bath-icon' => array(
								'title' => __('Bath Icon' , 'kode-property-list-list'),
								'type' => 'text',
								'default' => 'fa fa-bed',
								'description' => 'Please enter the font awesome / SVC icon code here.',
							),
							'property-garage' => array(
								'title' => __('Garage' , 'kode-property-list-list'),
								'type' => 'text',								
								'description' => 'Please enter the garage of this property.',
							),
							'garage-icon' => array(
								'title' => __('Garage Icon' , 'kode-property-list-list'),
								'type' => 'text',
								'default' => 'fa fa-bed',
								'description' => 'Please enter the font awesome / SVC icon code here.',
							),
							'property-floor-plan'=> array(
								'title'=> esc_html__('Floor Plan' ,'kode-property-list-list'),
								'type'=> 'combobox',
								'options'=> array(
									'yes' => esc_html__('Yes', 'kode-property-list-list'),
									'no' => esc_html__('No', 'kode-property-list-list'),
								),
								'default'=>'no'
							),	
							'floor-plan-slider'=> array(
								'overlay'=> 'false',
								'caption'=> 'false',
								'type'=> 'slider',
								'wrapper-class' => 'property-floor-plan-wrapper yes-wrapper',
							),
							'property-element-media' => array(
								'header_title' => __('Property Feature Media' , 'kode-property-list-list'),
								'type' => 'header',								
								'wrapper-class' => 'kode-header-class',
							),
							'post_media_type' => array(
								'title' => esc_html__('Select Post Media' , 'kode-property-list-list'),
								'type' => 'combobox',
								'options' => array(				
									'video'=>	esc_html__('Video URL' , 'kode-property-list-list'),
									'featured_image'=>	esc_html__('Feature Image' , 'kode-property-list-list'),
									'slider'=>	esc_html__('Slider' , 'kode-property-list-list'),
								),
								'description'=> esc_html__('Select post media type.', 'kode-property-list-list')
							),	
							'kodeproperty_video' => array(
								'title' => esc_html__('Video URL' , 'kode-property-list-list'),
								'type' => 'text',
								'wrapper-class' => 'video-wrapper post_media_type-wrapper',
								'description' => esc_html__('Add video url, it could be uploaded video track or youtube, vimeo.', 'kode-property-list-list')
							),	
							'property-thumbnail-size' => array(
								'title' => esc_html__('Thumbnail Size', 'kode-property-list-list'),
								'type'=> 'combobox',
								'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),
								'wrapper-class' => 'video-wrapper slider-wrapper featured_image-wrapper post_media_type-wrapper',
								'default'=> 'kodeproperty-post-thumbnail-size'								
							),
							'slider'=> array(
								'overlay'=> 'false',
								'caption'=> 'false',
								'type'=> 'slider',
								'wrapper-class' => 'slider-wrapper post_media_type-wrapper',
							),
							'property-element-agent' => array(
								'header_title' => __('Property Agents' , 'kode-property-list-list'),
								'type' => 'header',								
								'wrapper-class' => 'kode-header-class',
							),
							'property-agent' => array(
								'title' => esc_html__('Agent', 'kode-property-list-list'),
								'type'=> 'combobox',
								'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('agent'),
								'default'=> 'kodeproperty-post-thumbnail-size'								
							),
							'property-element-excerpt' => array(
								'title' => esc_html__('Agent Description Length' , 'kode-property-list-list'),
								'type' => 'text',
								'description' => esc_html__('Agent Description Length in Characters for example: 20 Characters.', 'kode-property-list-list')
							),
							'agent-thumbnail-size' => array(
								'title' => esc_html__('Thumbnail Size', 'kode-property-list-list'),
								'type'=> 'combobox',
								'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),
								'wrapper-class' => 'video-wrapper featured_image-wrapper post_media_type-wrapper',
								'default'=> 'kodeproperty-post-thumbnail-size'								
							),
						)
					),
					
					$kode_custom_fields,

				),
				// page option attribute
				array(
					'post_type' => array('property'),
					'meta_title' => __('Property Option', 'kode-property-list-list'),
					'meta_slug' => 'property-page-option',
					'option_name' => 'post-option',
					'position' => 'normal',
					'priority' => 'high',
				)
			);
			
		}
	}	
	
	function kode_custom_fields_post_type(){
		global $kodeproperty_plugin_option;
		
		$extra_options_head = array( 									
			'title' => esc_html__('Extra Options', 'kode-property-list-list'),
			'options' => array(
			)
		);		
		
		$kode_custom_field = array();
		if(!empty($kodeproperty_plugin_option['kode_input_data'])){
			$kode_input_textfield = $kodeproperty_plugin_option['kode_input_data'];		
			for($i = 0; $i <= count($kode_input_textfield['title']); $i++){
				$item_count = count($kode_input_textfield['title']);
				if(!empty($kode_input_textfield['title'][$i])){
					$kode_input_slug = strtolower($kode_input_textfield['title'][$i]);
					$kode_input_slug = str_replace(' ','-',$kode_input_slug);
					$explode_array = count($kode_input_textfield['options']);
					
					if($kode_input_textfield['type'][$i] == 'dropdown'){
						
						$options_new = explode(PHP_EOL, $kode_input_textfield['options'][$i]);					
						
						$kode_custom_field[$kode_input_slug . '-custom-field'] = array(
							'title' => $kode_input_textfield['title'][$i],
							'type' => 'combobox',
							'options' => $options_new,
							'description' => 'Enter URL of your social profile here.'										
						);	
					}else{
						$kode_custom_field[$kode_input_slug . '-custom-field'] = array(
							'title' => $kode_input_textfield['title'][$i],
							'type' => 'text',
							'description' => 'Enter URL of your social profile here.'										
						);	
					}
					
				}
			}
		}
		
		$array = array();
		$array = $extra_options_head;
		$array['options'] = $kode_custom_field;
		
		return $array;
	}
	
	
	// add property in page builder area
	add_filter('kodeproperty_page_builder_option', 'kodeproperty_register_property_item');
	if( !function_exists('kodeproperty_register_property_item') ){
		function kodeproperty_register_property_item( $page_builder = array() ){
			$kodeproperty_func_utility = new kodeproperty_func_utility();
			global $kodeproperty_spaces;
		
			$page_builder['content-item']['options']['property'] = array(
				'title'=> __('Property', 'kode-property-list-list'), 
				'icon'=>'fa-home',
				'type'=>'item',
				'options'=>array(					
					'element-item-id' => array(
						'title' => esc_html__('Page Item ID', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item id.', 'kode-property-list-list')
					),
					'element-item-class' => array(
						'title' => esc_html__('Page Item Class', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item class.', 'kode-property-list-list')
					),	
					'property-filter'=> array(
						'title'=> __('Property Filter' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'show' => __('Show Filter', 'kode-property-list-list'),
							'hide' => __('Hide Filter', 'kode-property-list-list'),							
						),
					),
					'property-listing'=> array(
						'title'=> __('Property Listing' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'show' => __('Show Filter', 'kode-property-list-list'),
							'hide' => __('Hide Filter', 'kode-property-list-list'),
						),
					),
					'title-num-excerpt'=> array(
						'title'=> __('Title Num Length (Word)' ,'kode-property-list-list'),
						'type'=> 'text',	
						'default'=> '15',
						'description'=> __('This is a number of word (decided by spaces) that you want to show on the property title. <strong>Use 0 to hide the excerpt, -1 to show full posts and use the wordpress more tag</strong>.', 'kode-property-list-list')
					),
					'features'=> array(
						'title'=> __('Features' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('features'),
						'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'kode-property-list-list')
					),	
					'status'=> array(
						'title'=> __('Status' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('status'),
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'property-type'=> array(
						'title'=> __('Property Type' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('property-type'),
						'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'kode-property-list-list')
					),	
					'room-type'=> array(
						'title'=> __('Room Type' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('room-type'),
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'city'=> array(
						'title'=> __('City' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('city'),
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'country'=> array(
						'title'=> __('Country' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('country'),
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'neighborhood'=> array(
						'title'=> __('Neighborhood' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('neighborhood'),
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'property-listing-type'=> array(
						'title'=> __('Property Listing Type' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'simple' => __('Simple', 'kode-property-list-list'),
							'slider' => __('Slider', 'kode-property-list-list'),							
						),
					),					
					'property-style'=> array(
						'title'=> __('Property Style' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'grid-view' => __('Grid View', 'kode-property-list-list'),
							'modern-grid-view' => __('Moderrn Grid View', 'kode-property-list-list'),
							'simple-full-view' => __('Simple Full View', 'kode-property-list-list'),
							'normal-full-view' => __('Normal Full View', 'kode-property-list-list'),
							'modern-full-view' => __('Modern Full View', 'kode-property-list-list'),
						),
					),	
					'thumbnail-size' => array(
						'title' => esc_html__('Thumbnail Size', 'kf_kode-property-list'),
						'type'=> 'combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),
						'default'=> 'kode-post-thumbnail-size'
					),
					'property-column'=> array(
						'title'=> __('Property Column Size' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'2' => __('2 Column', 'kode-property-list-list'),
							'3' => __('3 Column', 'kode-property-list-list'),
							'4' => __('4 Column', 'kode-property-list-list')
						),
						'wrapper-class' => 'grid-view-wrapper modern-grid-view-wrapper property-style-wrapper',
					),						
					'num-fetch'=> array(
						'title'=> __('Num Fetch' ,'kode-property-list-list'),
						'type'=> 'text',	
						'default'=> '8',
						'description'=> __('Specify the number of propertys you want to pull out.', 'kode-property-list-list')
					),	
					'num-excerpt'=> array(
						'title'=> __('Num Excerpt' ,'kode-property-list-list'),
						'type'=> 'text',	
						'default'=> '20',						
					),
					'orderby'=> array(
						'title'=> __('Order By' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'date' => __('Publish Date', 'kode-property-list-list'), 
							'title' => __('Title', 'kode-property-list-list'), 
							'rand' => __('Random', 'kode-property-list-list'), 
						)
					),
					'order'=> array(
						'title'=> __('Order' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'desc'=>__('Descending Order', 'kode-property-list-list'), 
							'asc'=> __('Ascending Order', 'kode-property-list-list'), 
						)
					),			
					'pagination'=> array(
						'title'=> __('Enable Pagination' ,'kode-property-list-list'),
						'type'=> 'checkbox'
					),					
					'margin-bottom' => array(
						'title' => __('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => __('Spaces after ending of this item', 'kode-property-list-list')
					),				
				)
			);
			
			$page_builder['content-item']['options']['search-form'] = array(			
				'title'=> esc_html__('Search Form', 'kode-property-list-list'), 
				'icon'=>'fa-search',
				'type'=>'item',
				'options'=> array(
					'element-item-id' => array(
						'title' => esc_html__('Page Item ID', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item id.', 'kode-property-list-list')
					),
					'element-item-class' => array(
						'title' => esc_html__('Page Item Class', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item class.', 'kode-property-list-list')
					),	
					'search-sale'=> array(
						'title'=> esc_html__('Enable Sales Search' ,'kode-property-list-list'),
						'type'=> 'checkbox'
					),	
					'search-rent'=> array(
						'title'=> esc_html__('Enable Rent Search' ,'kode-property-list-list'),
						'type'=> 'checkbox'
					),	
					'search-purchase'=> array(
						'title'=> esc_html__('Enable Purchase Search' ,'kode-property-list-list'),
						'type'=> 'checkbox'
					),
					'margin-bottom' => array(
						'title' => esc_html__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Spaces after ending of this item', 'kode-property-list-list')
					),	
				)
			);
			
			
			$page_builder['content-item']['options']['submit-list'] = array(			
				'title'=> esc_html__('Submit Listing', 'kode-property-list-list'), 
				'icon'=>'fa-check',
				'type'=>'item',
				'options'=> array(
					'element-item-id' => array(
						'title' => esc_html__('Page Item ID', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item id.', 'kode-property-list-list')
					),
					'element-item-class' => array(
						'title' => esc_html__('Page Item Class', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item class.', 'kode-property-list-list')
					),
					'margin-bottom' => array(
						'title' => esc_html__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Spaces after ending of this item', 'kode-property-list-list')
					),	
				)
			);
			
			$page_builder['content-item']['options']['submit-edit'] = array(			
				'title'=> esc_html__('Edit Listing', 'kode-property-list-list'), 
				'icon'=>'fa-pencil-square-o',
				'type'=>'item',
				'options'=> array(
					'element-item-id' => array(
						'title' => esc_html__('Page Item ID', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item id.', 'kode-property-list-list')
					),
					'element-item-class' => array(
						'title' => esc_html__('Page Item Class', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item class.', 'kode-property-list-list')
					),
					'margin-bottom' => array(
						'title' => esc_html__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Spaces after ending of this item', 'kode-property-list-list')
					),	
				)
			);
			
			$page_builder['content-item']['options']['property-slider'] = array(		
				'title'=> esc_html__('Property Slider', 'kode-property-list-list'), 
				'icon'=>'fa-crosshairs',
				'type'=>'item',
				'options'=> array(
					'element-item-id' => array(
						'title' => esc_html__('Page Item ID', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item id.', 'kode-property-list-list')
					),
					'element-item-class' => array(
						'title' => esc_html__('Page Item Class', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item class.', 'kode-property-list-list')
					),	
					'features'=> array(
						'title'=> __('Features' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('features'),
						'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'kode-property-list-list')
					),	
					'status'=> array(
						'title'=> __('Status' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('status'),
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'orderby'=> array(
						'title'=> __('Order By' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'date' => __('Publish Date', 'kode-property-list-list'), 
							'title' => __('Title', 'kode-property-list-list'), 
							'rand' => __('Random', 'kode-property-list-list'), 
						)
					),
					'order'=> array(
						'title'=> __('Order' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'desc'=>__('Descending Order', 'kode-property-list-list'), 
							'asc'=> __('Ascending Order', 'kode-property-list-list'), 
						)
					),					
					'margin-bottom' => array(
						'title' => esc_html__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Spaces after ending of this item', 'kode-property-list-list')
					),	
				)
			);
			
			$page_builder['content-item']['options']['property-categories'] = array(		
				'title'=> esc_html__('Pro Category', 'kode-property-list-list'), 
				'icon'=>'fa-sun-o',
				'type'=>'item',
				'options'=> array(
					'element-item-id' => array(
						'title' => esc_html__('Page Item ID', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item id.', 'kode-property-list-list')
					),
					'element-item-class' => array(
						'title' => esc_html__('Page Item Class', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_html__('please add the page item class.', 'kode-property-list-list')
					),	
					'filter'=> array(
						'title'=> __('Select Filter' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_taxonomies_list('property',''),
						'description'=> __('select filter from list to show its categories.', 'kode-property-list-list')
					),
					'features'=> array(
						'title'=> __('Features' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('features'),
						'wrapper-class'=> 'filter-wrapper features-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'status'=> array(
						'title'=> __('Status' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('status'),
						'wrapper-class'=> 'filter-wrapper status-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'property-type'=> array(
						'title'=> __('Property Type' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('property-type'),
						'wrapper-class'=> 'filter-wrapper property-type-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'room-type'=> array(
						'title'=> __('Room Type' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('room-type'),
						'wrapper-class'=> 'filter-wrapper room-type-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'city'=> array(
						'title'=> __('City' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('city'),
						'wrapper-class'=> 'filter-wrapper city-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'country'=> array(
						'title'=> __('Country' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('country'),
						'wrapper-class'=> 'filter-wrapper country-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'neighborhood'=> array(
						'title'=> __('Neighborhood' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('neighborhood'),
						'wrapper-class'=> 'filter-wrapper neighborhood-wrapper',
						'description'=> __('Will be ignored when the property filter option is enabled.', 'kode-property-list-list')
					),
					'parent-fetch' => array(
						'title' => esc_html__('Fetch Parent Categories', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Fetch Parent Categories on the page', 'kode-property-list-list')
					),	
					'hide-empty'=> array(
						'title'=> __('Hide Empty Category' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'1' => __('Yes', 'kode-property-list-list'), 
							'0' => __('No', 'kode-property-list-list'), 
						)
					),
					'orderby'=> array(
						'title'=> __('Parent Order By' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'count' => __('Count', 'kode-property-list-list'), 
							'slug' => __('Slug', 'kode-property-list-list'), 
							'name' => __('Name', 'kode-property-list-list'), 
						)
					),
					'order'=> array(
						'title'=> __('Parent Order' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'DESC'=>__('Descending Order', 'kode-property-list-list'), 
							'ASC'=> __('Ascending Order', 'kode-property-list-list'), 
						)
					),
					'child-fetch' => array(
						'title' => esc_html__('Fetch Child Categories', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Fetch Child Categories on the page', 'kode-property-list-list')
					),	
					'child-orderby'=> array(
						'title'=> __('Child Order By' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'count' => __('Count', 'kode-property-list-list'), 
							'slug' => __('Slug', 'kode-property-list-list'), 
							'name' => __('Name', 'kode-property-list-list'), 
						)
					),
					'child-order'=> array(
						'title'=> __('Child Order' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'DESC'=>__('Descending Order', 'kode-property-list-list'), 
							'ASC'=> __('Ascending Order', 'kode-property-list-list'), 
						)
					),
					'margin-bottom' => array(
						'title' => esc_html__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',											
						'description' => esc_html__('Spaces after ending of this item', 'kode-property-list-list')
					),	
				)
			);
			
			
			$page_builder['content-item']['options']['modern-list'] = array(
				'title'=> __('Modern Listing', 'kode-property-list-list'), 
				'icon'=>'fa-outdent',
				'type'=>'item',
				'options'=>array(					
					'title-num-excerpt'=> array(
						'title'=> __('Title Num Length (Word)' ,'kode-property-list-list'),
						'type'=> 'text',	
						'default'=> '15',
						'description'=> __('This is a number of word (decided by spaces) that you want to show on the property title. <strong>Use 0 to hide the excerpt, -1 to show full posts and use the wordpress more tag</strong>.', 'kode-property-list-list')
					),
					'list-post'=> array(
						'title'=> __('Select Post' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('property'),
						'description'=> __('You can select candidate to show its biography.', 'kode-property-list-list')
					),
					'style'=> array(
						'title'=> __('List Style' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'full' => __('Full List', 'kode-property-list-list'), 
							'small' => __('Small List', 'kode-property-list-list'), 
						)
					),
					'thumbnail-size' => array(
						'title' => esc_html__('Thumbnail Size', 'kf_kode-property-list'),
						'type'=> 'combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),		
						'default'=> 'kode-post-thumbnail-size'
					),
					'orderby'=> array(
						'title'=> __('Order By' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'date' => __('Publish Date', 'kode-property-list-list'), 
							'title' => __('Title', 'kode-property-list-list'), 
							'rand' => __('Random', 'kode-property-list-list'), 
						)
					),
					'order'=> array(
						'title'=> __('Order' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'desc'=>__('Descending Order', 'kode-property-list-list'), 
							'asc'=> __('Ascending Order', 'kode-property-list-list'), 
						)
					),	
					'margin-bottom' => array(
						'title' => __('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => __('Spaces after ending of this item', 'kode-property-list-list')
					),				
				)
			);
			
			$page_builder['content-item']['options']['marker-slider'] = array(
				'title'=> esc_attr__('Property Marker', 'kode-property-list-list'), 
				'type'=>'item',
				'icon'=>'fa fa-map-marker',
				'options'=>array(					
				
					'features'=> array(
						'title'=> esc_attr__('Features' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('features'),
						'description'=> esc_attr__('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'kode-property-list-list')
					),	
					'status'=> array(
						'title'=> esc_attr__('Status' ,'kode-property-list-list'),
						'type'=> 'multi-combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list('status'),
						'description'=> esc_attr__('Will be ignored when the package filter option is enabled.', 'kode-property-list-list')
					),	
					'show-map-as'=> array(
						'title'=> __('Show as' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'map'=>__('Map Only', 'kode-property-list-list'), 
							'map-with-property'=> __('Map With Properties', 'kode-property-list-list'), 
						)
					),	
					'heading-title' => array(
						'title' => esc_attr__('Heading Title', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'wrapper-class'=> 'show-map-as-wrapper map-with-property-wrapper',
						'description' => esc_attr__('add title for of heading here', 'kode-property-list-list')
					),	
					'heading-caption' => array(
						'title' => esc_attr__('Heading Caption', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'wrapper-class'=> 'show-map-as-wrapper map-with-property-wrapper',
						'description' => esc_attr__('add caption or description for of heading here', 'kode-property-list-list')
					),	
					'property-style'=> array(
						'title'=> __('Property Style' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'grid-view' => __('Grid View', 'kode-property-list-list'),
							'modern-grid-view' => __('Moderrn Grid View', 'kode-property-list-list'),
							'simple-full-view' => __('Simple Full View', 'kode-property-list-list'),
							'normal-full-view' => __('Normal Full View', 'kode-property-list-list'),
							'modern-full-view' => __('Modern Full View', 'kode-property-list-list'),
						),
						'wrapper-class'=> 'show-map-as-wrapper map-with-property-wrapper'
					),	
					'thumbnail-size' => array(
						'title' => esc_html__('Thumbnail Size', 'kf_kode-property-list'),
						'type'=> 'combobox',
						'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),
						'default'=> 'kode-post-thumbnail-size',
						'wrapper-class'=> 'show-map-as-wrapper map-with-property-wrapper'
					),
					'property-column'=> array(
						'title'=> __('Property Column Size' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'2' => __('2 Column', 'kode-property-list-list'),
							'3' => __('3 Column', 'kode-property-list-list'),
							'4' => __('4 Column', 'kode-property-list-list')
						),
						'wrapper-class' => 'show-map-as-wrapper map-with-property-wrapper grid-view-wrapper modern-grid-view-wrapper property-style-wrapper',
					),					
					// 'marker-location'=> array(
						// 'title'=> esc_attr__('Select Center Location' ,'kode-property-list-list'),
						// 'type'=> 'combobox',
						//'options'=> $kodeproperty_func_utility->kodeproperty_get_all_posted_country_list(),
					// ),					
					'num-fetch'=> array(
						'title'=> esc_attr__('Num Fetch' ,'kode-property-list-list'),
						'type'=> 'text',	
						'default'=> '8',
						'description'=> esc_attr__('Specify the number of packages you want to pull out.', 'kode-property-list-list')
					),	
					'map-height'=> array(
						'title'=> esc_attr__('Map Height' ,'kode-property-list-list'),
						'type'=> 'text',	
						'default'=> '350',
						//'wrapper-class'=>'package-style-wrapper classic-package-wrapper classic-package-no-space-wrapper'
					),
					
					'orderby'=> array(
						'title'=> esc_attr__('Order By' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'date' => esc_attr__('Publish Date', 'kode-property-list-list'), 
							'title' => esc_attr__('Title', 'kode-property-list-list'), 
							'rand' => esc_attr__('Random', 'kode-property-list-list'), 
						)
					),
					'order'=> array(
						'title'=> esc_attr__('Order' ,'kode-property-list-list'),
						'type'=> 'combobox',
						'options'=> array(
							'desc'=>esc_attr__('Descending Order', 'kode-property-list-list'), 
							'asc'=> esc_attr__('Ascending Order', 'kode-property-list-list'), 
						)
					),			
					// 'pagination'=> array(
						// 'title'=> esc_attr__('Enable Pagination' ,'kode-property-list-list'),
						// 'type'=> 'checkbox'
					// ),					
					'margin-bottom' => array(
						'title' => esc_attr__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_attr__('Spaces after ending of this item', 'kode-property-list-list')
					),				
				)
			);
			
			
			$page_builder['content-item']['options']['mortgage-calc'] = array(
				'title'=> esc_attr__('Mortgage Calc', 'kode-property-list-list'), 
				'type'=>'item',
				'icon'=>'fa fa-calculator',
				'options'=>array(
					'margin-bottom' => array(
						'title' => esc_attr__('Margin Bottom', 'kode-property-list-list'),
						'type' => 'text',
						'default' => '',
						'description' => esc_attr__('Spaces after ending of this item', 'kode-property-list-list')
					),				
				)
			);
			
			
			
			return $page_builder;
		}
	}
	
	
	add_filter('kodeproperty_pluginoption_panel', 'kodeproperty_register_social_shares_pluginoption');
	if( !function_exists('kodeproperty_register_social_shares_pluginoption') ){
		function kodeproperty_register_social_shares_pluginoption( $array ){	
			if( empty($array['property-settings']['options']) ) return $array;
			
			$kodeproperty_social_shares = array(
				'digg'			=> esc_html__('Digg','kode-property-list'),			
				'facebook'		=> esc_html__('Facebook','kode-property-list'), 
				'google-plus' 	=> esc_html__('Google Plus','kode-property-list'),	
				'linkedin' 		=> esc_html__('Linkedin','kode-property-list'),
				'my-space' 		=> esc_html__('My Space','kode-property-list'),
				'pinterest' 	=> esc_html__('Pinterest','kode-property-list'),
				'reddit' 		=> esc_html__('Reddit','kode-property-list'),
				'stumble-upon' 	=> esc_html__('Stumble Upon','kode-property-list'),
				'twitter' 		=> esc_html__('Twitter','kode-property-list'),
			);	
			$header_social = array( 									
				'title' => esc_html__('Social Shares', 'kode-property-list'),
				'options' => array(
					'enable-social-share'=> array(
						'title' => esc_html__('Enable Social Share' ,'kode-property-list'),
						'type' => 'checkbox',
						'description' => 'Enable this option to show the social shares below each post'
					)
				)
			);
				
			foreach( $kodeproperty_social_shares as $social_slug => $social_name ){
				$header_social['options'][$social_slug . '-share'] = array(
					'title' => $social_name,
					'type' => 'checkbox',
					'description' => 'Enable this option to show the social Icon under post.'					
				);
			}
			
			$array['property-settings']['options']['social-shares'] = $header_social;
			return $array;
		}
	}	
	
	
	
	add_action('pre_post_update', 'kode_save_post_meta_option');
	if( !function_exists('kode_save_post_meta_option') ){
	function kode_save_post_meta_option( $post_id ){
			if( get_post_type() == 'property' && isset($_POST['post-option']) ){
				$kodeproperty_func_utility = new kodeproperty_func_utility();
				$post_option = $kodeproperty_func_utility->kodeproperty_stopbackslashes($kodeproperty_func_utility->kodeproperty_stripslashes($_POST['post-option']));
				$post_option = json_decode($kodeproperty_func_utility->kodeproperty_decode_stopbackslashes($post_option), true);
				
				
				if(isset($post_option['property-lat']) && $post_option['property-lat'] <> ''){
					$url = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$post_option['property-lat'].','.$post_option['property-lon'].'&sensor=false');
					// $data = json_decode($url);					
					update_post_meta($post_id, 'kode-map-data', $url);
				}
				
				if(!empty($post_option['property-location'])){
					update_post_meta($post_id, 'property-location', esc_attr($_POST['property-location']));
				}else{
					delete_post_meta($post_id, 'property-location');
				}
				
				if(!empty($post_option['property-radius'])){
					update_post_meta($post_id, 'property-radius', esc_attr($_POST['property-radius']));
				}else{
					delete_post_meta($post_id, 'property-radius');
				}
				
				if(!empty($post_option['property-map'])){
					update_post_meta($post_id, 'property-map', esc_attr($_POST['property-map']));
				}else{
					delete_post_meta($post_id, 'property-map');
				}
				
				if(!empty($post_option['property-lat'])){
					update_post_meta($post_id, 'property-lat', esc_attr($_POST['property-lat']));
				}else{
					delete_post_meta($post_id, 'property-lat');
				}
				
				if(!empty($post_option['property-lon'])){
					update_post_meta($post_id, 'property-lon', esc_attr($_POST['property-lon']));
				}else{
					delete_post_meta($post_id, 'property-lon');
				}
				
				if(!empty($post_option['property-type'])){
					update_post_meta($post_id, 'property-type', esc_attr($_POST['property-type']));
				}else{
					delete_post_meta($post_id, 'property-type');
				}
				
				if(!empty($post_option['property-price'])){
					update_post_meta($post_id, 'property-price', esc_attr($_POST['property-price']));
				}else{
					delete_post_meta($post_id, 'property-price');
				}
				
				if(!empty($post_option['property-currency'])){
					update_post_meta($post_id, 'property-currency', esc_attr($_POST['property-currency']));
				}else{
					delete_post_meta($post_id, 'property-currency');
				}
				
				if(!empty($post_option['property-space'])){
					update_post_meta($post_id, 'property-space', esc_attr($_POST['property-space']));
				}else{
					delete_post_meta($post_id, 'property-space');
				}
				
				if(!empty($post_option['property-bed'])){
					update_post_meta($post_id, 'property-bed', esc_attr($_POST['property-bed']));
				}else{
					delete_post_meta($post_id, 'property-bed');
				}
				
				if(!empty($post_option['property-bath'])){
					update_post_meta($post_id, 'property-bath', esc_attr($_POST['property-bath']));
				}else{
					delete_post_meta($post_id, 'property-bath');
				}
				
				if(!empty($post_option['property-garage'])){
					update_post_meta($post_id, 'property-garage', esc_attr($_POST['property-garage']));
				}else{
					delete_post_meta($post_id, 'property-garage');
				}
				
				if(!empty($post_option['property-floor-plan'])){
					update_post_meta($post_id, 'property-floor-plan', esc_attr($_POST['property-floor-plan']));
				}else{
					delete_post_meta($post_id, 'property-floor-plan');
				}
				
				if(!empty($post_option['floor-plan-slider'])){
					update_post_meta($post_id, 'floor-plan-slider', esc_attr($_POST['floor-plan-slider']));
				}else{
					delete_post_meta($post_id, 'floor-plan-slider');
				}
				
				if(!empty($post_option['property-agent'])){
					update_post_meta($post_id, 'property-agent', esc_attr($_POST['property-agent']));
				}else{
					delete_post_meta($post_id, 'property-agent');
				}
				
				if(!empty($post_option['property-profile'])){
					update_post_meta($post_id, 'property-profile', esc_attr($_POST['property-profile']));
				}else{
					delete_post_meta($post_id, 'property-profile');
				}
				
				if(!empty($post_option['guest-email'])){
					update_post_meta($post_id, 'guest-email', esc_attr($_POST['guest-email']));
				}else{
					delete_post_meta($post_id, 'guest-email');
				}
				
				if(!empty($post_option['agent-name'])){
					update_post_meta($post_id, 'agent-name', esc_attr($_POST['agent-name']));
				}else{
					delete_post_meta($post_id, 'agent-name');
				}
				
				if(!empty($post_option['agent-email'])){
					update_post_meta($post_id, 'agent-email', esc_attr($_POST['agent-email']));
				}else{
					delete_post_meta($post_id, 'agent-email');
				}
				
				if(!empty($post_option['agent-phone'])){
					update_post_meta($post_id, 'agent-phone', esc_attr($_POST['agent-phone']));
				}else{
					delete_post_meta($post_id, 'agent-phone');
				}
				
				
			}
		}
	}
	
	