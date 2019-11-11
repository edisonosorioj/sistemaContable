<?php
	/*	
	*	Kodeforest Theme Options panel
	*	---------------------------------------------------------------------
	*	This file create the theme options
	*	---------------------------------------------------------------------
	*	Settings - Options - Values
	*/	
	$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
	if( !class_exists('kodeproperty_pluginoption_panel') ){
		
		class kodeproperty_pluginoption_panel{
			
			public $settings;
			public $options;		
			public $value;
			
			function __construct($settings = array(), $options = array(), $value = array()){
				
				$default_config = array(
					'page_title' => esc_html__('Custom Option', 'kode-property'),
					'menu_title' => esc_html__('Custom Menu', 'kode-property'),
					'menu_slug' => 'custom-menu',
					'save_option' => 'kodeproperty_plugin_option',
					'role' => 'edit_plugin_options',
					'icon_url' => '',
					'position' => 23
				);
				
				$this->settings = wp_parse_args($settings, $default_config);
				$this->options = $options;
				$this->value = $value;				

				new kodeproperty_plugin_customizer($options);				
				
				// send the hook to create the admin menu
				add_action('admin_menu', array(&$this, 'kodeproperty_register_main_pluginoption'));
				
				// set the hook for saving the admin menu
				add_action('wp_ajax_kodeproperty_save_plugin_panel', array(&$this, 'kodeproperty_save_admin_panel'));
			}
			
			// create the admin menu
			function kodeproperty_register_main_pluginoption(){
				
				// add the hook to create admin option
				$page = add_menu_page($this->settings['page_title'], $this->settings['menu_title'], $this->settings['role'], $this->settings['menu_slug'], array(&$this, 'kodeproperty_create_pluginoption'), $this->settings['icon_url'], $this->settings['position']); 
 
				// include the script to admin option
				add_action('admin_print_styles-' . $page, array($this, 'kodeproperty_register_admin_option_style'));	
				add_action('admin_print_scripts-' . $page, array($this, 'kodeproperty_register_admin_option_script'));			
			}
						
			// include script and style when you're on admin option
			function kodeproperty_register_admin_option_style(){
				
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('kodeproperty-alert-box', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_msg.css');						
				wp_enqueue_style('font-awesome', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/font-awesome/css/font-awesome.min.css' );  //Font Awesome
				wp_enqueue_style('kodeproperty-admin-chosen', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kode-chosen/chosen.min.css');
				wp_enqueue_style('kodeproperty-admin-panel-html', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_element_meta.css');
				wp_enqueue_style('kodeproperty-admin-panel', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/css/kf_themeoption.css');						
				wp_enqueue_style('kodeproperty-date-picker', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
				
			}
			function kodeproperty_register_admin_option_script(){
				global $post;
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
				
				
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('jquery-ui-slider');
				wp_enqueue_script('wp-color-picker');							
				
				
				wp_enqueue_script('kodeproperty-alert-box', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_msg.js');
				wp_enqueue_script('kodeproperty-admin-panel', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_themeoption.js');
				wp_enqueue_script('kodeproperty-admin-chosen', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kode-chosen/chosen.jquery.min.js');
				wp_enqueue_script('kodeproperty-save-settings', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_save_settings.js');
				wp_enqueue_script('kodeproperty-admin-panel-html', KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/js/kf_element_meta.js');
				
				
			}
			
			// saving admin option
			function kodeproperty_save_admin_panel(){
				if( !check_ajax_referer('kodeproperty-create-nonce', 'security', false) ){
					die(json_encode(array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . esc_html__('Invalid Nonce', 'kode-property') . '</span> ' .
							esc_html__('Please refresh the page and try this again.' ,'kode-property')
					)));
				}
				
				if( isset($_POST['option']) ){		
					parse_str(kodeproperty_stripslashes($_POST['option']), $option ); 
					$option = kodeproperty_stripslashes($option);
					
					$old_option = get_option($this->settings['save_option']);
					  
					if($old_option == $option || update_option($this->settings['save_option'], $option)){
						$ret = array(
							'status'=> 'success', 
							'message'=> '<span class="head">' . esc_html__('Save Options Complete' ,'kode-property') . '</span> '
						);		
					}else{
						$ret = array(
							'status'=> 'failed', 
							'message'=> '<span class="head">' . esc_html__('Save Options Failed', 'kode-property') . '</span> ' .
							esc_html__('Please refresh the page and try this again.' ,'kode-property')
						);					
					}
				}else{
					$ret = array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . esc_html__('Cannot Retrieve Options', 'kode-property') . '</span> ' .
							esc_html__('Please refresh the page and try this again.' ,'kode-property')
					);	
				}
				
				do_action('kodeproperty_save_' + $this->settings['menu_slug'], $this->options);
				
				die(json_encode($ret));
			}
			
			// creating the content of the admin option
			function kodeproperty_create_pluginoption(){
				echo '<div class="kode-admin-panel-wrapper">';

				echo '<form action="#" method="POST" id="kode-admin-form" data-action="kodeproperty_save_plugin_panel" ';
				echo 'data-ajax="' . esc_url(KODEPROPERTY_AJAX) . '" ';
				echo 'data-security="' . wp_create_nonce('kodeproperty-create-nonce') . '" >';
				
				// print navigation section
				$this->kodeproperty_show_admin_nav();
				
				// print content section
				$this->kodeproperty_show_admin_content();
				
				echo '<div class="clear"></div>';
				echo '</form>';	

				echo '</div>'; // kode-admin-panel-wrapper
			}	

			function kodeproperty_show_admin_nav(){
				
				// admin navigation
				echo '<div class="clearfix clear"></div>';
				echo '<div class="kode-admin-nav-wrapper" id="kode-admin-nav" >';
					echo '<div class="kode-admin-head">';
						echo '<a href="'.esc_url(admin_url()).'admin.php?page=kodeprop_plugin"><img src="' . KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/admin-panel/admin-logo.png" alt="admin logo" /></a>';
						
						echo '<div class="kode-admin-head-gimmick"></div>';
					echo '</div>';
				
				$is_first = 'active';
				
				echo '<div class="kode-heading-option-title">';
				echo '<h2>'.esc_attr__('Theme Options - KodeForest','kode-property').'</h2>';
				echo '</div>';
				echo '<div class="kode-admin-head kode-admin-save-btn">';
				echo '<div class="kode-save-button">';
				echo '<img class="now-loading" src="' . KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/admin-panel/loading.gif" alt="loading" />';				
				echo '<input value="' . esc_html__('Save Changes', 'kode-property') . '" type="submit" class="kdf-button" />';
				echo '</div>'; 
				echo '<div class="kode-reset-button">';
				echo '<div id="reset_code" class="reset_default_code hide">';
				
				echo '</div>';
				echo '<a class="kdf-button" />' . esc_html__('Reset Default', 'kode-property') . '</a>';
				echo '<img class="now-loading" src="' . KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/admin-panel/loading.gif" alt="loading" />';				
				echo '</div>'; 
				echo '<div class="clear"></div>';
				echo '</div>'; // kode-admin-head
				
				echo '</div>'; // kode-admin-nav-wrapper				
			}
			
			function kodeproperty_show_admin_content(){
			
				$option_generator = new kodeproperty_generate_plugin_html();
				
				$is_first = 'active';
				
				// admin content
				echo '<div class="clearfix clear"></div>';
				echo '<div class="kode-admin-content-wrapper" id="kode-admin-content">';
				echo '<div class="kode-sidebar-menu-section">';
					echo '<ul class="admin-menu" >';
					foreach( $this->options as $menu_slug => $menu_settings ){
						echo '<li ';
						if($menu_slug == 'ticket-style'){
							if(isset($_GET['place']) && $_GET['place'] == 'membership'){ echo 'data-class="active"';}
						}
						echo ' class="' . esc_attr($menu_slug) . '-wrapper">';
						
						echo '<div class="menu-title">';
						if(isset($menu_settings['icon'])){
							echo '<i class="fa ' . esc_attr($menu_settings['icon']) . '" ></i>';
						}
						if(isset($menu_settings['title'])){
							echo '<span>' . esc_attr($menu_settings['title']) . '</span>';
						}
						echo '</div>';
						
						
						
						echo '</li>';
					}
					echo '</ul>';
					echo '<div class="kode-sidebar-section">';
						
						if(isset($_GET['place']) && $_GET['place'] == 'membership'){ $is_first = 'active';}						
						foreach( $this->options as $menu_slug => $menu_settings ){
							echo '<ul id="' . esc_attr($menu_slug) . '-wrapper" class="admin-sub-menu ' . esc_attr($is_first) . '">';
							if(!empty( $menu_settings['options'])){
								foreach( $menu_settings['options'] as $sub_menu_slug => $sub_menu_settings ){
									if( !empty($sub_menu_settings) ){
										if($sub_menu_slug == 'invoice-options'){
											if(isset($_GET['place']) && $_GET['place'] == 'membership'){ $is_first = 'active';}else{$is_first = $is_first;}
										}else{
											$is_first = '';
										}
										echo '<li class="' . esc_attr($sub_menu_slug) . '-wrapper ' . esc_attr($is_first) . ' admin-sub-menu-list" data-id="' . esc_attr($sub_menu_slug) . '" >';
										echo '<div class="sub-menu-title">';
										echo esc_attr($sub_menu_settings['title']);
										echo '</div>';
										echo '</li>';
										
										$is_first = '';
									}
								}
							}
							echo '</ul>';
						}
					echo '</div>';
				echo '</div>';
				$is_first = 'active';
				echo '<div class="kode-content-group">';
				foreach( $this->options as $menu_slug => $menu_settings ){
					if(!empty($menu_settings['options'])){
						foreach( $menu_settings['options'] as $sub_menu_slug => $sub_menu_settings ){
							if( !empty($sub_menu_settings) ){
								if($sub_menu_slug == 'invoice-options'){
									if(isset($_GET['place']) && $_GET['place'] == 'membership'){ $is_first = 'active';}else{$is_first = $is_first;}
								}else{
									if(isset($_GET['place']) && $_GET['place'] == 'membership'){
										$is_first = '';	
									}else{
										$is_first = $is_first;	
									}
									
								}
								echo '<div class="kode-content-section ' . esc_attr($is_first) . '" id="' . esc_attr($sub_menu_slug) . '" >';
								foreach( $sub_menu_settings['options'] as $option_slug => $option_settings ){
									$option_settings['slug'] = esc_attr($option_slug);
									$option_settings['name'] = esc_attr($option_slug);
									if( isset($this->value[$option_slug]) ){
										$option_settings['value'] = $this->value[$option_slug];
									}
									
									$option_generator->kodeproperty_generate_html($option_settings);
								}
								echo '</div>'; // Content Ends
							}
							$is_first = '';
						}
					}
				}								
				echo '</div>'; // Content Group Ends
				echo '</div>'; // Content Wrapper Ends
			
			}
			
		}
		
	}	
	
	