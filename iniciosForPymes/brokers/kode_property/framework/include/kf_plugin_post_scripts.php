<?php
	/*	
	*	Kodeforest Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls page builder  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('kodeproperty_page_options') ){
		
		class kodeproperty_page_options{

			public $settings;
			public $options;
		
			function __construct($options = array(),$settings = array() ){
				
				$default_setting = array(
					'post_type' => array('page'),
					'meta_title' => esc_html__('Page Option', 'kode-property'),
					'meta_slug' => 'kodeforest-page-option',
					'option_name' => 'post-option',
					'position' => 'side',
					'priority' => 'high',
				);
				
				$this->settings = wp_parse_args($settings, $default_setting);
				$this->options = $options;
				
				// send the hook to create custom meta box
				add_action('add_meta_boxes', array(&$this, 'add_page_option_meta'));

				// add hook to save page options
				add_action('pre_post_update', array(&$this, 'kodeproperty_save_page_option'));
			}			
			
			// load the necessary script for the page builder item
			function kodeproperty_load_admin_script(){
				global $post,$kodeproperty_plugin_option;
				$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
				
				if(isset($_GET['post-id'])){
					$post_option = kodeproperty_decode_stopbackslashes(get_post_meta($_GET['post-id'], 'post-option', true));
				}else{
					$post_option = array();
				}
				$post_option['property-lat'] = (empty($post_option['property-lat']))? '46.15242437752303': $post_option['property-lat'];
				$post_option['property-lon'] = (empty($post_option['property-lon']))? '2.7470703125': $post_option['property-lon'];
				// wp_enqueue_script('kf-gomap-api', 'https://maps.googleapis.com/maps/api/js?key='.esc_attr($kodeproperty_plugin_option['google-map-api']).'&libraries=places');
				// wp_enqueue_script('kf-gomap-api', 'http://maps.googleapis.com/maps/api/js?libraries=places&key='.$kodeproperty_plugin_option['google-map-api']);
				// wp_register_script('kf-gomap-api', 'https://maps.googleapis.com/maps/api/js?key='.esc_attr($kodeproperty_plugin_option['google-map-api']).'&libraries=places&sensor=true', false, '1.0', true);
				// wp_enqueue_script('kf-gomap-api');
				wp_enqueue_script('kf-gomap-api', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key='.esc_attr($kodeproperty_plugin_option['google-map-api']).'');
				wp_register_script('kodeproperty-locationpicker', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/locationpicker.js');
				wp_localize_script( 'kodeproperty-locationpicker', 'LOC', array('lat'=>$post_option['property-lat'],'lon'=>$post_option['property-lon']) );
				wp_enqueue_script('kodeproperty-locationpicker');
				// wp_enqueue_script('dsidx', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_filter.js');
				// wp_localize_script( 'dsidx', 'dsidxAjaxHandler', array('ajaxurl'=>admin_url( 'admin-ajax.php' )) );
				// wp_enqueue_script('dsidx');
			
				add_action('admin_enqueue_scripts', array(&$this, 'kodeproperty_enqueue_wp_media') );
				
				// include the sidebar generator style
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('kodeproperty-alert-box', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_msg.css');	
				wp_enqueue_style('kodeproperty-page-option', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_pageoption.css');
				wp_enqueue_style( 'font-awesome', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/font-awesome/css/font-awesome.min.css' );  //Font Awesome
				wp_enqueue_style('kodeproperty-admin-panel-html', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_element_meta.css');	
				wp_enqueue_style('kodeproperty-admin-chosen', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kode-chosen/chosen.min.css');
				wp_enqueue_style('kodeproperty-edit-box', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_popup_window.css');		
				wp_enqueue_style('kodeproperty-page-builder', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_pagebuilder.css');		
				// wp_enqueue_script('kodeproperty-datetime', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kodeproperty-datetime.css');	
				wp_enqueue_style('kodeproperty-date-picker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');								

				// include the sidebar generator script
				wp_enqueue_script('wp-color-picker');
				wp_enqueue_script('kodeproperty-utility', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_filter.js');	
				// wp_enqueue_script('kodeproperty-datetime', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kodeproperty-datetime.js');	
				
				
				wp_enqueue_script('kodeproperty-alert-box', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_msg.js');
				wp_enqueue_script('kodeproperty-admin-panel-html', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_element_meta.js');
				wp_enqueue_script('kodeproperty-edit-box', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_popup_window.js');	
				wp_enqueue_script('kodeproperty-save-settings', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_save_settings.js');
				wp_enqueue_script('kodeproperty-slider-selection', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_media_center.js');
				wp_enqueue_script('kodeproperty-gallery-selection', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kode-gallery-selection.js');
				wp_enqueue_script('kodeproperty-admin-chosen', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kode-chosen/chosen.jquery.min.js');
				wp_enqueue_script('kodeproperty-page-builder', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_pagebuilder.js');
				wp_enqueue_script('jquery-ui-datepicker');	
			}			
			
			//Media Manager
			function kodeproperty_enqueue_wp_media(){
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
			}
			
			// create the page builder meta at the add_meta_boxes hook
			function add_page_option_meta(){
				global $post;
				if(!empty($post)){
					if( in_array($post->post_type, $this->settings['post_type']) ){
						$this->kodeproperty_load_admin_script();
					
						foreach( $this->settings['post_type'] as $post_type ){
							add_meta_box(
								$this->settings['meta_slug'],
								$this->settings['meta_title'],
								array(&$this, 'create_page_option_elements'),
								$post_type,
								$this->settings['position'],
								$this->settings['priority']
							);			
						}
					}
				}
			}
		
			// start creating the page builder element
			function create_page_option_elements(){
				global $post;

				$option_value = kodeproperty_decode_stopbackslashes(get_post_meta( $post->ID, $this->settings['option_name'], true ));
				if( !empty($option_value) ){
					$option_value = json_decode( $option_value, true );					
				}
	
				$option_generator = new kodeproperty_generate_plugin_html();
				
				echo '<div class="kode-page-option-wrapper position-' . esc_attr($this->settings['position']) . '" >';
				
				foreach( $this->options as $option_section ){
					echo '<div class="kode-page-option">';
					echo '<div class="kode-page-option-title">' . esc_attr($option_section['title']) . '</div>';
					echo '<div class="kode-page-option-input-wrapper row">';
					
					foreach ( $option_section['options'] as $option_slug => $option ){
						$option['slug'] = $option_slug;
						$option['name'] = $option_slug;
						if( !empty($option_value) && isset($option_value[$option_slug]) ){
							$option['value'] = $option_value[$option_slug];
						}
						
						$option_generator->kodeproperty_generate_html( $option );
					}
					
					echo '</div>'; // page-option-input-wrapper
					echo '</div>'; // page-option-title
					
					
				}
				echo '<textarea class="kode-input-hidden" name="' . esc_attr($this->settings['option_name']) . '"></textarea>';
				echo '</div>'; // kode-page-option-wrapper
			}
			
			// save page option setting
			function kodeproperty_save_page_option( $post_id ){
				if( isset($_POST[$this->settings['option_name']]) ){
					update_post_meta($post_id, $this->settings['option_name'], kodeproperty_stopbackslashes($_POST[$this->settings['option_name']]));
				}
			}
			
		}
		
		
	}

?>