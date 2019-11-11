<?php
	/**
	* 	Contains methods for customizing the theme customization screen.
	* 
	* 	@link http://codex.wordpress.org/Theme_Customization_API
	*/
	 
	if( !class_exists('kodeproperty_pluginoption_selector') ){
		class kodeproperty_pluginoption_selector{
			
			public $admin_option;
			public $kodeproperty_plugin_option;
			
			function __construct($admin_option){
				$this->admin_option = $admin_option;				
				add_action('wp', array(&$this, 'sync_kodeproperty_plugin_option'));
			}
			
			// sync the color option with theme option
			function sync_kodeproperty_plugin_option(){
				$this->kodeproperty_plugin_option = $this->admin_option;
			}
		}
	}
	 
	if( !class_exists('kodeproperty_plugin_customizer') ){
		class kodeproperty_plugin_customizer{
			
			public $admin_option;
			
			function __construct($admin_option){
				$this->admin_option = $admin_option;
				
				// call this to add it to customizer.js file
				// $this->print_color_variable(); 
				
				// add action to set the theme customizer
				add_action('customize_register', array(&$this, 'register_option'));
				add_action('customize_save_after', array(&$this, 'sync_kodeproperty_plugin_option')); 
			}
			
			function register_option($wp_customize){
				$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
				
				
				$priority = 1000;
				foreach($this->admin_option as $tabs){
					foreach($tabs['options'] as $section_slug => $section){
					
						// check whether there're color option in this section
						$has_option = false;
						if( !empty($section['options']) ){
							foreach($section['options'] as $option){
								if($option['type'] == 'colorpicker'){
									$has_option = true; continue;
								}
							}
						}
						
						// create option
						if( !$has_option ) continue;
						$wp_customize->add_section($section_slug, array(
							'title' => esc_html__('Color :', 'kode-property') . ' ' . esc_attr($section['title']), 
							'priority' => esc_attr($priority), 
							'capability' => 'edit_plugin_options'));
						foreach($section['options'] as $option_slug => $option){
							if($option['type'] != 'colorpicker') continue;

							$wp_customize->add_setting('kodeproperty_customizer[' . esc_attr($option_slug) . ']', array(
								'default' => esc_attr($kodeproperty_plugin_option[$option_slug]),
								'type' => 'option',
								'capability' => 'edit_plugin_options',
								'transport' => 'postMessage',
								'sanitize_callback' => 'esc_url_raw',
							)); 					
							$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $option_slug,
								array(
									'label' => esc_html__('Color :', 'kode-property') . ' ' . esc_attr($option['title']),
									'section' => esc_attr($section_slug),
									'settings' => 'kodeproperty_customizer[' . esc_attr($option_slug) . ']',
									'priority' => esc_attr($priority),
								) 
							));
							$priority++;
						}
						
						$wp_customize->get_setting('blogname')->transport = 'postMessage';
						$wp_customize->get_setting('blogdescription')->transport = 'postMessage';				
						
					}

				}
			}
			
			// sync the color option with theme option
			function sync_kodeproperty_plugin_option(){
				$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
				$customizer_option = get_option('kodeproperty_customizer', array());
				
				foreach( $customizer_option as $option_slug => $option_val ){
					$kodeproperty_plugin_option[$option_slug] = $option_val;
				}
				
				update_option('kodeproperty_plugin_option', $kodeproperty_plugin_option);
				delete_option('kodeproperty_customizer');
				
				kodeproperty_generate_style_custom($this->admin_option);
				
				kodeproperty_save_font_options($this->admin_option);
				
			}
			
			// print the variable to use in kode-customer.js file.
			function kodeproperty_show_color_variable(){
				echo 'var color_option = [<br>';
				foreach($this->admin_option as $tabs){
					foreach($tabs['options'] as $section){
						foreach($section['options'] as $option_slug => $option){
							if($option['type'] == 'colorpicker'){
								echo '{name: "' . esc_attr($option_slug) . '", selector: "' . esc_attr(str_replace('"', '\"', $option['selector'])) . '"},<br>';
							}
						}
					}
				}
				echo '];';
			}
		}
	}

	add_action('customize_preview_init' , 'kodeproperty_register_customizer_script');
	if( !function_exists('kodeproperty_register_customizer_script')){
		function kodeproperty_register_customizer_script(){
			wp_enqueue_script('kodeproperty-customize', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/wp_customizer.js', array(), '', true);	
		}
	}