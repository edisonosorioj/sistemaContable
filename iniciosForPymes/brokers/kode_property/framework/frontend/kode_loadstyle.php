<?php
	/*	
	*	Kodeforest Load Style
	*	---------------------------------------------------------------------
	*	This file create the custom style
	*	For Color Scheme, and Typography Options
	*	---------------------------------------------------------------------
	*/	
		
		
		$font_options_slug = 'style_option_slug';
		add_action('kodeproperty_save_' + $font_options_slug, 'kodeproperty_save_style_options');
		if( !function_exists('kodeproperty_save_style_options') ){
			function kodeproperty_save_style_options($options){
				$kodeproperty_func_utility = new kodeproperty_func_utility();
				// for multisite
				$file_url = KODEPROPERTY_PATH_DIR . 'framework/frontend/css/custom-style.css';
				if( is_multisite() && get_current_blog_id() > 1 ){
					$file_url = KODEPROPERTY_PATH_DIR . 'framework/frontend/css/style-custom' . get_current_blog_id() . '.css';
				}
				
				// write file content
				$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
				
				// for updating google font list to use on front end
				global $kodeproperty_font_controller_plugin; $google_font_list = array(); 
				
				foreach( $options as $menu_key => $menu ){
					if(!empty($menu['options'])){
						foreach( $menu['options'] as $submenu_key => $submenu ){
							if( !empty($submenu['options']) ){
								foreach( $submenu['options'] as $option_slug => $option ){
									if( !empty($option['selector']) ){
										// prevents warning message
										$option['data-type'] = (empty($option['data-type']))? 'color': $option['data-type'];
										
										if( !empty($kodeproperty_plugin_option[$option_slug]) ){
											$value = $kodeproperty_func_utility->kodeproperty_check_option_data_type($kodeproperty_plugin_option[$option_slug], $option['data-type']);
										}else{
											$value = '';
										}
										if($value){
											$kodeproperty_font = str_replace('#kode#', $value, $option['selector']) . "\r\n";
										}
										
										// updating google font list
										if( $menu_key == 'font-settings' ){
											if( !empty($kodeproperty_font_controller_plugin->google_font_list[$kodeproperty_plugin_option[$option_slug]]) ){
												$google_font_list[$kodeproperty_plugin_option[$option_slug]] = $kodeproperty_font_controller_plugin->google_font_list[$kodeproperty_plugin_option[$option_slug]];
											}
										}
									}
								}
							}
						}
					}
				}
				
				// update google font list
				// update_option('kodeproperty_google_font_list', $google_font_list);	

				$render_style = kodeproperty_generate_style_custom_plugin($kodeproperty_plugin_option,$page_options='no');
				
				$current_page =  wp_nonce_url(admin_url('admin.php?page=kodeprop_plugin'),'kode-property');
				if( !kodeproperty_write_filesystem_plugin($current_page, $file_url, $render_style) ){
					$ret = array(
						'status'=>'failed', 
						'message'=> '<span class="head">' . esc_html__('Cannot write style-custom.css file', 'kode-property') . '</span> ' .
							esc_html__('Please contact the administrator.' ,'kode-property')
					);	
					
					die(json_encode($ret));		
				}
				
			}
		}
		
		
		if( !function_exists('kodeproperty_generate_style_custom_plugin') ){
			function kodeproperty_generate_style_custom_plugin( $kodeproperty_plugin_options,$page_options= "" ){				
				// write file content
				if($page_options == 'Yes'){
					$kodeproperty_plugin_option = $kodeproperty_plugin_options;
					$k_option = 'custom_style';
					if(isset($_GET['layout']) && $_GET['layout'] == 'boxed'){
						$kodeproperty_plugin_option['enable-boxed-style'] = 'boxed-style';
					}else{
						$kodeproperty_plugin_option['enable-boxed-style'] = 'full-style';
					}
				}else{
					$kodeproperty_plugin_option = get_option('kodeproperty_admin_option', array());
					$k_option = 'default_stylesheet';
				}
				
				$style = '';
				
				
				if(!empty($kodeproperty_plugin_option['logo-width'])){
					if($kodeproperty_plugin_option['logo-width'] <> ''){
						if($kodeproperty_plugin_option['logo-width'] <> 0){
							$style .= '.logo img{';
							$style .= 'width:'.esc_attr($kodeproperty_plugin_option['logo-width']) .'px';
							$style .= '}' . "\r\n";
						}
						
					}
				}

				
				if(!empty($kodeproperty_plugin_option['logo-height'])){
					if($kodeproperty_plugin_option['logo-height'] <> ''){
						if($kodeproperty_plugin_option['logo-height'] <> 0){
							$style .= '.logo img{';
							$style .= 'height:'.esc_attr($kodeproperty_plugin_option['logo-height']) .'px';
							$style .= '}' . "\r\n";
						}
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navi-font-family'])){
					if($kodeproperty_plugin_option['navi-font-family'] <> ''){
						$style .= '.kode-navigation-wrapper, .kode-navigation-wrapper ul li{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['navi-font-family']) .'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['heading-font-family'])){
					if($kodeproperty_plugin_option['heading-font-family'] <> ''){
						$style .= '.kode-caption-title, .kode-caption-text, h1, h2, h3, h4, h5, h6{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['heading-font-family']) .'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navigation-font-family'])){
					if($kodeproperty_plugin_option['navigation-font-family'] <> ''){
						$style .= '.kf_main_navigation ul li a{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['navigation-font-family']) .'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navigation-font-size'])){
					if($kodeproperty_plugin_option['navigation-font-size'] <> ''){
						$style .= '.kf_main_navigation ul li a{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['navigation-font-size']) .'px';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navigation-line-height'])){
					if($kodeproperty_plugin_option['navigation-line-height'] <> ''){
						$style .= '.kf_main_navigation ul li a{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['navigation-line-height']) .'px';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navigation-font-weight'])){
					if($kodeproperty_plugin_option['navigation-font-weight'] <> ''){
						$style .= '.kf_main_navigation ul li a{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['navigation-font-weight']) .'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navigation-letter-spacing'])){
					if($kodeproperty_plugin_option['navigation-letter-spacing'] <> ''){
						$style .= '.kf_main_navigation ul li a{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['navigation-letter-spacing']) .'px';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['navigation-text-transform'])){
					if($kodeproperty_plugin_option['navigation-text-transform'] <> ''){
						$style .= '.kf_main_navigation ul li a{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['navigation-text-transform']) .'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//heading h1 typo
				
				if(!empty($kodeproperty_plugin_option['h1-font-family'])){
					if($kodeproperty_plugin_option['h1-font-family'] <> ''){
						$style .= 'body h1{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['h1-font-family']) .'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h1-font-size'])){
					if($kodeproperty_plugin_option['h1-font-size'] <> ''){
						$style .= 'body h1{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['h1-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h1-line-height'])){
					if($kodeproperty_plugin_option['h1-line-height'] <> ''){
						$style .= 'body h1{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['h1-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h1-font-weight'])){
					if($kodeproperty_plugin_option['h1-font-weight'] <> ''){
						$style .= 'body h1{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['h1-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h1-letter-spacing'])){
					if($kodeproperty_plugin_option['h1-letter-spacing'] <> ''){
						$style .= 'body h1{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['h1-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h1-text-transform'])){
					if($kodeproperty_plugin_option['h1-text-transform'] <> ''){
						$style .= 'body h1{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['h1-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end heading h1 typo
				
				//heading h2 typo
				
				if(!empty($kodeproperty_plugin_option['h2-font-family'])){
					if($kodeproperty_plugin_option['h2-font-family'] <> ''){
						$style .= 'body h2{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['h2-font-family']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h2-font-size'])){
					if($kodeproperty_plugin_option['h2-font-size'] <> ''){
						$style .= 'body h2{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['h2-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h2-line-height'])){
					if($kodeproperty_plugin_option['h2-line-height'] <> ''){
						$style .= 'body h2{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['h2-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h2-font-weight'])){
					if($kodeproperty_plugin_option['h2-font-weight'] <> ''){
						$style .= 'body h2{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['h2-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h2-letter-spacing'])){
					if($kodeproperty_plugin_option['h2-letter-spacing'] <> ''){
						$style .= 'body h2{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['h2-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h2-text-transform'])){
					if($kodeproperty_plugin_option['h2-text-transform'] <> ''){
						$style .= 'body h2{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['h2-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end heading h2 typo
				
				//heading h3 typo
				
				if(!empty($kodeproperty_plugin_option['h3-font-family'])){
					if($kodeproperty_plugin_option['h3-font-family'] <> ''){
						$style .= 'body h3{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['h3-font-family']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h3-font-size'])){
					if($kodeproperty_plugin_option['h3-font-size'] <> ''){
						$style .= 'body h3{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['h3-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h3-line-height'])){
					if($kodeproperty_plugin_option['h3-line-height'] <> ''){
						$style .= 'body h3{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['h3-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h3-font-weight'])){
					if($kodeproperty_plugin_option['h3-font-weight'] <> ''){
						$style .= 'body h3{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['h3-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h3-letter-spacing'])){
					if($kodeproperty_plugin_option['h3-letter-spacing'] <> ''){
						$style .= 'body h3{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['h3-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h3-text-transform'])){
					if($kodeproperty_plugin_option['h3-text-transform'] <> ''){
						$style .= 'body h3{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['h3-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end heading h3 typo
				
				//heading h4 typo
				
				if(!empty($kodeproperty_plugin_option['h4-font-family'])){
					if($kodeproperty_plugin_option['h4-font-family'] <> ''){
						$style .= 'body h4{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['h4-font-family']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h4-font-size'])){
					if($kodeproperty_plugin_option['h4-font-size'] <> ''){
						$style .= 'body h4{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['h4-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h4-line-height'])){
					if($kodeproperty_plugin_option['h4-line-height'] <> ''){
						$style .= 'body h4{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['h4-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h4-font-weight'])){
					if($kodeproperty_plugin_option['h4-font-weight'] <> ''){
						$style .= 'body h4{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['h4-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h4-letter-spacing'])){
					if($kodeproperty_plugin_option['h4-letter-spacing'] <> ''){
						$style .= 'body h4{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['h4-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h4-text-transform'])){
					if($kodeproperty_plugin_option['h4-text-transform'] <> ''){
						$style .= 'body h4{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['h4-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end heading h4 typo
				
				//heading h5 typo
				
				if(!empty($kodeproperty_plugin_option['h5-font-family'])){
					if($kodeproperty_plugin_option['h5-font-family'] <> ''){
						$style .= 'body h5{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['h5-font-family']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h5-font-size'])){
					if($kodeproperty_plugin_option['h5-font-size'] <> ''){
						$style .= 'body h5{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['h5-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h5-line-height'])){
					if($kodeproperty_plugin_option['h5-line-height'] <> ''){
						$style .= 'body h5{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['h5-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h5-font-weight'])){
					if($kodeproperty_plugin_option['h5-font-weight'] <> ''){
						$style .= 'body h5{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['h5-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h5-letter-spacing'])){
					if($kodeproperty_plugin_option['h5-letter-spacing'] <> ''){
						$style .= 'body h5{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['h5-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h5-text-transform'])){
					if($kodeproperty_plugin_option['h5-text-transform'] <> ''){
						$style .= 'body h5{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['h5-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end heading h5 typo
				
				//heading h6 typo
				
				if(!empty($kodeproperty_plugin_option['h6-font-family'])){
					if($kodeproperty_plugin_option['h6-font-family'] <> ''){
						$style .= 'body h6{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['h6-font-family']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h6-font-size'])){
					if($kodeproperty_plugin_option['h6-font-size'] <> ''){
						$style .= 'body h6{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['h6-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h6-line-height'])){
					if($kodeproperty_plugin_option['h6-line-height'] <> ''){
						$style .= 'body h6{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['h6-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h6-font-weight'])){
					if($kodeproperty_plugin_option['h6-font-weight'] <> ''){
						$style .= 'body h6{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['h6-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h6-letter-spacing'])){
					if($kodeproperty_plugin_option['h6-letter-spacing'] <> ''){
						$style .= 'body h6{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['h6-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['h6-text-transform'])){
					if($kodeproperty_plugin_option['h6-text-transform'] <> ''){
						$style .= 'body h6{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['h6-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end heading h6 typo
				
				//Paragraph Typo
				
				if(!empty($kodeproperty_plugin_option['body-font-family'])){
					if($kodeproperty_plugin_option['body-font-family'] <> ''){
						$style .= 'body, p{';
						$style .= 'font-family:'.esc_attr($kodeproperty_plugin_option['body-font-family']).'';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['body-font-size'])){
					if($kodeproperty_plugin_option['body-font-size'] <> ''){
						$style .= 'body, p{';
						$style .= 'font-size:'.esc_attr($kodeproperty_plugin_option['body-font-size']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['body-line-height'])){
					if($kodeproperty_plugin_option['body-line-height'] <> ''){
						$style .= 'body, p{';
						$style .= 'line-height:'.esc_attr($kodeproperty_plugin_option['body-line-height']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['body-font-weight'])){
					if($kodeproperty_plugin_option['body-font-weight'] <> ''){
						$style .= 'body, p{';
						$style .= 'font-weight:'.esc_attr($kodeproperty_plugin_option['body-font-weight']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['body-letter-spacing'])){
					if($kodeproperty_plugin_option['body-letter-spacing'] <> ''){
						$style .= 'body, p{';
						$style .= 'letter-spacing:'.esc_attr($kodeproperty_plugin_option['body-letter-spacing']) .'px ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				if(!empty($kodeproperty_plugin_option['body-text-transform'])){
					if($kodeproperty_plugin_option['body-text-transform'] <> ''){
						$style .= 'body, p{';
						$style .= 'text-transform:'.esc_attr($kodeproperty_plugin_option['body-text-transform']) .' ';
						$style .= '}' . "\r\n";
						
					}
				}
				
				//end Paragraph Typo
				
				$mega_menu = get_option('mega_main_menu_options');
				if(is_array($mega_menu)){
					$style .= '.kf_main_navigation ul li:before{';
					$style .= 'content:" " !important';
					$style .= '}' . "\r\n";
				}else{
					
					if(!empty($kodeproperty_plugin_option['navi-color'])){
						if($kodeproperty_plugin_option['navi-color'] <> ''){
							$style .= '.navigation ul > li > a, .navbar-nav > li > a{';
							$style .= 'color:'.esc_attr($kodeproperty_plugin_option['navi-color']).' !important';
							$style .= '}' . "\r\n";
							
						}
					}
					
					
					
					
					if(!empty($kodeproperty_plugin_option['navi-hover-bg'])){
						if($kodeproperty_plugin_option['navi-hover-bg'] <> ''){
							$style .= '.navigation ul > li:hover > a{';
							$style .= 'background-color:'.esc_attr($kodeproperty_plugin_option['navi-hover-bg']).' !important';
							$style .= '}' . "\r\n";
						}
					}
					
					if(!empty($kodeproperty_plugin_option['navi-dropdown-hover-bg'])){
						if($kodeproperty_plugin_option['navi-dropdown-hover-bg'] <> ''){
							$style .= '.navigation ul.sub-menu > li:hover > a{';
							$style .= 'background-color:'.esc_attr($kodeproperty_plugin_option['navi-dropdown-hover-bg']).' !important';
							$style .= '}' . "\r\n";
						}
					}
					
					if(!empty($kodeproperty_plugin_option['navi-hover-color'])){
						if($kodeproperty_plugin_option['navi-hover-color'] <> ''){
							$style .= '.navigation ul > li:hover > a, .navbar-nav > li:hover{';
							$style .= 'color:'.esc_attr($kodeproperty_plugin_option['navi-hover-color']).' !important';
							$style .= '}' . "\r\n";
							
						}
					}
					
					if(!empty($kodeproperty_plugin_option['navi-dropdown-bg'])){
						if($kodeproperty_plugin_option['navi-dropdown-bg'] <> ''){
							$style .= '.navigation .sub-menu, .navigation .children, .navbar-nav .children{';
							$style .= 'background:'.esc_attr($kodeproperty_plugin_option['navi-dropdown-bg']).' !important';
							$style .= '}' . "\r\n";
							
						}
					}
					if(!empty($kodeproperty_plugin_option['navi-dropdown-hover'])){
						if($kodeproperty_plugin_option['navi-dropdown-hover'] <> ''){
							$style .= '.navigation .menu .sub-menu li:hover a:before, .navigation .sub-menu li:hover a:before, .navbar-nav .children li:hover a:before{ ';
							$style .= 'color:'.esc_attr($kodeproperty_plugin_option['navi-dropdown-hover']).' !important';
							$style .= ' }' . "\r\n";
							
						}
					}

					if(!empty($kodeproperty_plugin_option['navi-dropdown-hover'])){
						if($kodeproperty_plugin_option['navi-dropdown-hover'] <> ''){
							$style .= '.navigation ul li ul > li:hover > a, .navbar-nav li ul > li:hover > a{ ';
							$style .= 'color:'.esc_attr($kodeproperty_plugin_option['navi-dropdown-hover']).' !important';
							$style .= ' }' . "\r\n";
							
						}
					}
					
					if(!empty($kodeproperty_plugin_option['navi-dropdown-color'])){
						if($kodeproperty_plugin_option['navi-dropdown-color'] <> ''){
							$style .= '.navigation .sub-menu li a, .navigation .children li a, .navbar-nav .children li a{ ';
							$style .= 'color:'.esc_attr($kodeproperty_plugin_option['navi-dropdown-color']).' !important';
							$style .= ' }' . "\r\n";
							
						}
					}	
					
					//Top Bar Text Color
					if(isset($kodeproperty_plugin_option['main-menu-text'])){
						if($kodeproperty_plugin_option['main-menu-text'] <> ''){
							$style .= '.kf_main_navigation .navigation > .menu > ul > li a, .kf_main_navigation .navigation ul.menu > li a{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['main-menu-text']) . ';  }' . "\r\n";
						}
					}
					 
					//Top Bar Text Color
					if(isset($kodeproperty_plugin_option['main-menu-active-link'])){
						if($kodeproperty_plugin_option['main-menu-active-link'] <> ''){
							$style .= '.kf_main_navigation .navigation > .menu > ul > li.current_page_item a, .kf_main_navigation .navigation ul.menu > li.current-menu-item.current_page_item a{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['main-menu-active-link']) . ';  }' . "\r\n";
						}
					}
					
					//Top Bar Text Color
					if(isset($kodeproperty_plugin_option['main-menu-active-link-bg'])){
						if($kodeproperty_plugin_option['main-menu-active-link-bg'] <> ''){
							$style .= '.kf_main_navigation .navigation > .menu > ul > li.current_page_item a, .kf_main_navigation .navigation ul.menu > li.current-menu-item.current_page_item a{';						
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['main-menu-active-link-bg']) . ';  }' . "\r\n";
						}
					}
					
					//Top Bar Text Color
					if(isset($kodeproperty_plugin_option['main-menu-active-link'])){
						if($kodeproperty_plugin_option['main-menu-active-link'] <> ''){
							$style .= '.kf_main_navigation .navigation .menu > ul > li.current_page_ancestor > a, .kf_main_navigation .navigation ul.menu > li.current_page_ancestor > a{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['main-menu-active-link']) . ';  }' . "\r\n";
						}
					}
					
					//Top Bar Text Color
					if(isset($kodeproperty_plugin_option['main-menu-active-link-bg'])){
						if($kodeproperty_plugin_option['main-menu-active-link-bg'] <> ''){
							$style .= '.kf_main_navigation .navigation ul.menu > li.current_page_ancestor > a{';						
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['main-menu-active-link-bg']) . ';  }' . "\r\n";
						}
					}
					
					 
					//Navigation Link Bg Color
					if(isset($kodeproperty_plugin_option['main-menu-link-background'])){
						if($kodeproperty_plugin_option['main-menu-link-background'] <> ''){						
							$style .= '.kf_main_navigation .navigation > .menu > ul > li a, .kf_main_navigation .navigation ul.menu > li a{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['main-menu-link-background']) . ';  }' . "\r\n";
						}
					}
					
					//Navigation Link Bg Hover Color
					if(isset($kodeproperty_plugin_option['main-menu-link-background-on-hover'])){
						if($kodeproperty_plugin_option['main-menu-link-background-on-hover'] <> ''){
							$style .= '.kf_main_navigation .navigation > .menu > ul > li:hover a, .kf_main_navigation .navigation ul.menu > li:hover a{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['main-menu-link-background-on-hover']) . ';  }' . "\r\n";
						}
					}
					
					//Navigation Link Bg Hover Color
					if(isset($kodeproperty_plugin_option['main-menu-link-color-on-hover'])){
						if($kodeproperty_plugin_option['main-menu-link-color-on-hover'] <> ''){
							$style .= '.kf_main_navigation .navigation > .menu > ul > li a:hover, .kf_main_navigation .navigation ul.menu > li a:hover{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['main-menu-link-color-on-hover']) . ';  }' . "\r\n";
						}
					}
					
					
					//Navigation Link Bg Hover Color
					if(isset($kodeproperty_plugin_option['main-menu-link-icon-color-on-hover'])){
						if($kodeproperty_plugin_option['main-menu-link-icon-color-on-hover'] <> ''){
							$style .= '.kf_main_navigation ul li:before{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['main-menu-link-icon-color-on-hover']) . ';  }' . "\r\n";
						}
					}
					
					
					//Sub Menu Configuration Bg Color
					if(isset($kodeproperty_plugin_option['submenu-background'])){
						if($kodeproperty_plugin_option['submenu-background'] <> ''){
							$style .= 'header .kf_logo_nav_wrap .kf_main_navigation .navigation > .menu > ul > li > ul.children li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li > ul.children li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li > ul.sub-menu li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['submenu-background']) . ' !important;  }' . "\r\n";
						}
					}
					
					
					//Sub Menu Configuration Bg Color
					if(isset($kodeproperty_plugin_option['submenu-bottom-border-color'])){
						if($kodeproperty_plugin_option['submenu-bottom-border-color'] <> ''){
							$style .= '.sub-menu, .children{';
							$style .= 'border-color: ' . esc_attr($kodeproperty_plugin_option['submenu-bottom-border-color']) . ' !important;  }' . "\r\n";
						}
					}
					
					
					
					if(isset($kodeproperty_plugin_option['submenu-link-color'])){
						if($kodeproperty_plugin_option['submenu-link-color'] <> ''){
							$style .= 'header .kf_logo_nav_wrap .kf_main_navigation .navigation > .menu > ul > li ul.children li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.children li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['submenu-link-color']) . ' !important;  }' . "\r\n";
						}
					}
					
					if(isset($kodeproperty_plugin_option['submenu-hover-link-color'])){
						if($kodeproperty_plugin_option['submenu-hover-link-color'] <> ''){
							$style .= 'header .kf_logo_nav_wrap .kf_main_navigation .navigation > .menu > ul > li ul.children li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.children li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li:hover, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li:hover{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['submenu-hover-link-color']) . ' !important;  }' . "\r\n";
						}
					}
					
					if(isset($kodeproperty_plugin_option['submenu-hover-link-hover-bg'])){
						if($kodeproperty_plugin_option['submenu-hover-link-hover-bg'] <> ''){
							$style .= 'header .kf_logo_nav_wrap .kf_main_navigation .navigation > .menu > ul > li ul.children li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.children li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li:hover a, header .kf_logo_nav_wrap .kf_main_navigation .navigation > ul > li ul.sub-menu li:hover, header .kf_logo_nav_wrap .kf_main_navigation .navigation ul.menu > li ul.sub-menu li:hover{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['submenu-hover-link-hover-bg']) . ' !important;  }' . "\r\n";
						}
					}
					
					
					//Sub Main Menu Text Color on Active Ancestor
					if(isset($kodeproperty_plugin_option['submenu-link-active-color'])){
						if($kodeproperty_plugin_option['submenu-link-active-color'] <> ''){
							$style .= '.kf_main_navigation .navigation .menu ul > li.current_page_ancestor ul.children li.current_page_item a, .kf_main_navigation .navigation ul.menu > li.current_page_ancestor li.current_page_item a{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['submenu-link-active-color']) . ' !important;  }' . "\r\n";
						}
					}
					
					//Sub Main Menu Background Color on Active Ancestor
					if(isset($kodeproperty_plugin_option['submenu-link-active-bg-color'])){
						if($kodeproperty_plugin_option['submenu-link-active-bg-color'] <> ''){
							$style .= '.kf_main_navigation .navigation .menu ul > li.current_page_ancestor ul.children li.current_page_item a, .kf_main_navigation .navigation .menu ul > li.current_page_ancestor li.current_page_item a, .kf_main_navigation .navigation ul.menu > li.current_page_ancestor li.current_page_item a{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['submenu-link-active-bg-color']) . ' !important;  }' . "\r\n";
						}
					}
					
					
					//Page Sub Menu Text Color on Active Ancestor
					if(isset($kodeproperty_plugin_option['submenu-link-active-color'])){
						if($kodeproperty_plugin_option['submenu-link-active-color'] <> ''){
							$style .= '.kf_main_navigation .navigation .menu ul > li.current_page_ancestor ul.children li.current_page_item a, .kf_main_navigation .navigation ul.menu > li.current-menu-ancestor.current_page_ancestor li.current-menu-item.current_page_item a{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['submenu-link-active-color']) . ' !important;  }' . "\r\n";
						}
					}
					
					//Page Menu Background Color on Active Ancestor
					if(isset($kodeproperty_plugin_option['submenu-link-active-bg-color'])){
						if($kodeproperty_plugin_option['submenu-link-active-bg-color'] <> ''){
							$style .= '.kf_main_navigation .navigation .menu ul > li.current_page_ancestor li.current-menu-item.current_page_item a, .kf_main_navigation .navigation ul.menu > li.current_page_ancestor li.current-menu-item.current_page_item a{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['submenu-link-active-bg-color']) . ' !important;  }' . "\r\n";
						}
					}
					
				}
				
				// Slider Caption Styling Starts
				if(isset($kodeproperty_plugin_option['caption-background-color-switch']) && $kodeproperty_plugin_option['caption-background-color-switch'] == 'enable'){
					if(isset($kodeproperty_plugin_option['caption-background-color'])){
						$style .= '.kode-caption .kode-caption-title:before,.kode-caption .kode-caption-title::after{';
						$style .= 'border-bottom-color:'.esc_attr($kodeproperty_plugin_option['caption-background-color']).' !important';
						$style .= '}' . "\r\n";				
						
						$style .= '.kode-caption .kode-caption-title{';
						$style .= 'background-color:'.esc_attr($kodeproperty_plugin_option['caption-background-color']).' !important';
						$style .= '}' . "\r\n";				
					}
				}
					
				if(isset($kodeproperty_plugin_option['caption-btn-color-border'])){
					$style .= '.kode-linksection, .kode-modren-btn{';
					$style .= 'border-color:'.esc_attr($kodeproperty_plugin_option['caption-btn-color-border']).' !important';
					$style .= '}' . "\r\n";		
				}
				
				if(isset($kodeproperty_plugin_option['caption-btn-color-bg'])){
					$style .= '.kode-linksection, .kode-modren-btn{';
					$style .= 'background:'.esc_attr($kodeproperty_plugin_option['caption-btn-color-bg']).' !important';
					$style .= '}' . "\r\n";		
				}
				// Slider Caption Styling Ends
				
				if(!empty($kodeproperty_plugin_option['header-background-opacity'])){
					if($kodeproperty_plugin_option['header-background-opacity'] <> ''){
						$style .= '#header-style-3 .kode_top_strip:before, .kode_header_7 .kode_top_eng:before{';
						$style .= 'opacity:'.esc_attr($kodeproperty_plugin_option['header-background-opacity']).' !important';
						$style .= '}' . "\r\n";
					}
				}
				
				if(!empty($kodeproperty_plugin_option['header-background-opacity'])){
					if($kodeproperty_plugin_option['header-background-opacity'] <> ''){
						$style .= '#header-style-3 .kode_top_strip:before, .kode_header_7 .kode_top_eng:before{';
						$style .= 'opacity:'.esc_attr($kodeproperty_plugin_option['header-background-opacity']).' !important';
						$style .= '}' . "\r\n";
					}
				}
				
				
				//Background As Pattern
				if(isset($kodeproperty_plugin_option['header-background-image'])){
					if($kodeproperty_plugin_option['header-background-image'] <> ''){
						if( !empty($kodeproperty_plugin_option['header-background-image']) && is_numeric($kodeproperty_plugin_option['header-background-image']) ){
							$alt_text = get_post_meta($kodeproperty_plugin_option['header-background-image'] , '_wp_attachment_image_alt', true);	
							$image_src = wp_get_attachment_image_src($kodeproperty_plugin_option['header-background-image'], 'full');
							
							$style .= '.kode_header_7 .kode_top_eng, .kode_top_strip{background:url(' . esc_url($image_src[0]).')}';
						}else if( !empty($kodeproperty_plugin_option['body-background-pattern']) ){
							$style .= '.kode_header_7 .kode_top_eng, .kode_top_strip{background:url(' . $kodeproperty_plugin_option['header-background-image'].')}';
						}
					}
				}
				
				//Background As Pattern
				if(isset($kodeproperty_plugin_option['kode-body-style'])){
					if($kodeproperty_plugin_option['kode-body-style'] == 'body-pattern'){
						if($kodeproperty_plugin_option['body-background-pattern'] <> ''){
							if( !empty($kodeproperty_plugin_option['body-background-pattern']) && is_numeric($kodeproperty_plugin_option['body-background-pattern']) ){
								// $alt_text = get_post_meta($kodeproperty_plugin_option['body-background-pattern'] , '_wp_attachment_image_alt', true);	
								// $image_src = wp_get_attachment_image_src($kodeproperty_plugin_option['body-background-image'], 'full');
								$style .= 'body{background:url(' . esc_url(KODEPROPERTY_PATH . '/images/pattern/pattern_'.$kodeproperty_plugin_option['body-background-pattern'].'.png') . ')}';
							}else if( !empty($kodeproperty_plugin_option['body-background-pattern']) ){
								$style .= 'body{background:url(' . esc_url(KODEPROPERTY_PATH . '/images/pattern/pattern_'.$kodeproperty_plugin_option['body-background-pattern'].'.png') . ')}';
							}
						}
					}
				}
				
				//Background As Image
				if(isset($kodeproperty_plugin_option['kode-body-style'])){
					if($kodeproperty_plugin_option['kode-body-style'] == 'body-background'){
						if($kodeproperty_plugin_option['body-background-image'] <> ''){
							if( !empty($kodeproperty_plugin_option['body-background-image']) && is_numeric($kodeproperty_plugin_option['body-background-image']) ){
								$alt_text = get_post_meta($kodeproperty_plugin_option['body-background-image'] , '_wp_attachment_image_alt', true);	
								$image_src = wp_get_attachment_image_src($kodeproperty_plugin_option['body-background-image'], 'full');
								$style .= 'body{background:url(' . esc_url($image_src[0]) . ')}';
								if($kodeproperty_plugin_option['kode-body-position'] == 'body-scroll'){
									$style .= 'body{background-attachment:scroll !important}';
								}else{
									$style .= 'body{background-attachment:fixed !important}';
								}
							}else if( !empty($kodeproperty_plugin_option['body-background-image']) ){
								$style .= 'body{background:url(' . esc_url($kodeproperty_plugin_option['body-background-image']) . ')}';
								if($kodeproperty_plugin_option['kode-body-position'] == 'body-scroll'){
									$style .= 'body{background-attachment:scroll !important}';
								}else{
									$style .= 'body{background-attachment:fixed !important}';
								}
							}
						}
					}
				}
				
				//Background As Color
				if(isset($kodeproperty_plugin_option['body-bg-color'])){
					if($kodeproperty_plugin_option['body-bg-color'] <> ''){
						$style .= 'body { ';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['body-bg-color']) . ';  }' . "\r\n";
					}
				}
				

				if(!empty($kodeproperty_plugin_option['enable-boxed-style'])){
					if($kodeproperty_plugin_option['enable-boxed-style'] == 'boxed-style'){
						if( !empty($kodeproperty_plugin_option['boxed-background-image']) && is_numeric($kodeproperty_plugin_option['boxed-background-image']) ){
							$alt_text = get_post_meta($kodeproperty_plugin_option['boxed-background-image'] , '_wp_attachment_image_alt', true);	
							$image_src = wp_get_attachment_image_src($kodeproperty_plugin_option['boxed-background-image'], 'full');
							$style .= 'body{background:url(' . esc_url($image_src[0]) . ')}';
						}else if( !empty($kodeproperty_plugin_option['boxed-background-image']) ){
							$style .= 'body{background:url(' . esc_url($kodeproperty_plugin_option['boxed-background-image']) . ')}';
						}
						
						$style .= '.logged-in.admin-bar .body-wrapper .kode-header-1{';
						$style .= 'margin-top:0px !important;';
						$style .= '}' . "\r\n";
						$style .= '.body-wrapper .kode-topbar:before{width:25%;}';
						$style .= '.body-wrapper #footer-widget .kode-widget-bg-footer:before{width:23em;}';
						$style .= '.body-wrapper .eccaption{top:40%;}';
						$style .= '.body-wrapper .main-content{background:#fff;}';
						$style .= '.body-wrapper {';
						$style .= 'background:#fff;width: 1200px;overflow:hidden; margin: 0 auto; margin-top: 40px; margin-bottom: 40px; box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);position:relative;';
						$style .= '}' . "\r\n";
					}
				}
				
				
				if(isset($kodeproperty_plugin_option['footer-background-opacity'])){
					if($kodeproperty_plugin_option['footer-background-opacity'] <> ''){
						$style .= '.footer:before{ ';
						$style .= 'opacity: ' . esc_attr($kodeproperty_plugin_option['footer-background-opacity']) . ';  }' . "\r\n";
					}
				}
				
				
				
				//Background As Color
				if(isset($kodeproperty_plugin_option['footer-background-color'])){
					if($kodeproperty_plugin_option['footer-background-color'] <> ''){
						$style .= 'footer:before{ ';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['footer-background-color'] ). ';  }' . "\r\n";
					}
				}
				
				if(!empty($kodeproperty_plugin_option['footer-background-image'])){
					if( !empty($kodeproperty_plugin_option['footer-background-image']) && is_numeric($kodeproperty_plugin_option['footer-background-image']) ){
						$alt_text = get_post_meta($kodeproperty_plugin_option['footer-background-image'] , '_wp_attachment_image_alt', true);	
						$image_src = wp_get_attachment_image_src($kodeproperty_plugin_option['footer-background-image'], 'full');
						$style .= '.footer{background:url(' . esc_url($image_src[0]) . ');background-size: cover;float: left;position: relative;width: 100%;}';
						$style .= '.lib-contact-section .kode-footer-style-thumb.kode-thumb{background-image:url(' . esc_url($image_src[0]) . ');}';
					}else if( !empty($kodeproperty_plugin_option['footer-background-image']) ){
						$style .= '.footer{background:url(' . esc_url($kodeproperty_plugin_option['footer-background-image']) . ');background-size: cover;float: left;position: relative;width: 100%;}';
						$style .= '.lib-contact-section .kode-footer-style-thumb.kode-thumb{background-image:url(' . esc_url($kodeproperty_plugin_option['footer-background-image']) . ');}';
					}
				}
				
				if(isset($kodeproperty_plugin_option['logo-bottom-margin'])){
					if($kodeproperty_plugin_option['logo-bottom-margin'] <> ''){
						$style .= 'a.logo{';
						$style .= 'margin-bottom: ' . esc_attr($kodeproperty_plugin_option['logo-bottom-margin']) . 'px;  }' . "\r\n";
					}
				}
				
				if(isset($kodeproperty_plugin_option['logo-top-margin'])){
					if($kodeproperty_plugin_option['logo-top-margin'] <> ''){
						$style .= 'a.logo{';
						$style .= 'margin-top: ' . esc_attr($kodeproperty_plugin_option['logo-top-margin']) . 'px;  }' . "\r\n";
					}
				}
				
				if(isset($kodeproperty_plugin_option['kode-top-bar-trans'])){
					if($kodeproperty_plugin_option['kode-top-bar-trans'] == 'colored'){
						if(isset($kodeproperty_plugin_option['top-bar-background-color'])){
							if($kodeproperty_plugin_option['top-bar-background-color'] <> ''){
								$style .= '.top-strip{';
								$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['top-bar-background-color']) . ';  }' . "\r\n";
							}
						}
					}
				}
				
				//Top Bar Background Color
				if(isset($kodeproperty_plugin_option['top-bar-background'])){
					if($kodeproperty_plugin_option['top-bar-background'] <> ''){
						$style .= '.kf_top_bar{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['top-bar-background']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-content'])){
					if($kodeproperty_plugin_option['top-bar-content'] <> ''){
						$style .= '.kf_top_bar, .kf_top_bar p, .kf_top_bar a,.kf_opening_time{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['top-bar-content']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Link Color
				if(isset($kodeproperty_plugin_option['top-bar-links'])){
					if($kodeproperty_plugin_option['top-bar-links'] <> ''){
						$style .= '.kf_top_bar .kf_top_social_icon li a{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['top-bar-links']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-links-hover-color'])){
					if($kodeproperty_plugin_option['top-bar-links-hover-color'] <> ''){
						$style .= '.kf_top_bar .kf_top_social_icon li a:hover{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['top-bar-links-hover-color']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-links-bgcolor'])){
					if($kodeproperty_plugin_option['top-bar-links-bgcolor'] <> ''){
						$style .= '.kf_top_bar .kf_top_social_icon li a{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['top-bar-links-bgcolor']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-links-hover-bgcolor'])){
					if($kodeproperty_plugin_option['top-bar-links-hover-bgcolor'] <> ''){
						$style .= '.kf_top_bar .kf_top_social_icon li a:hover{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['top-bar-links-hover-bgcolor']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-left-submit-btn-text-color'])){
					if($kodeproperty_plugin_option['top-bar-left-submit-btn-text-color'] <> ''){
						$style .= '.kf_list_free a{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['top-bar-left-submit-btn-text-color']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-left-submit-btn-bg-color'])){
					if($kodeproperty_plugin_option['top-bar-left-submit-btn-bg-color'] <> ''){
						$style .= '.kf_list_free{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['top-bar-left-submit-btn-bg-color']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-left-submit-btn-text-color-hover'])){
					if($kodeproperty_plugin_option['top-bar-left-submit-btn-text-color-hover'] <> ''){
						$style .= '.kf_list_free:hover, .kf_list_free:hover a{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['top-bar-left-submit-btn-text-color-hover']) . ';  }' . "\r\n";
					}
				}
				
				//Top Bar Text Color
				if(isset($kodeproperty_plugin_option['top-bar-left-submit-btn-text-bg-color-hover'])){
					if($kodeproperty_plugin_option['top-bar-left-submit-btn-text-bg-color-hover'] <> ''){
						$style .= '.kf_list_free:hover{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['top-bar-left-submit-btn-text-bg-color-hover']) . ';  }' . "\r\n";
					}
				}
				
				
				
				
				//Sub Header
				if(isset($kodeproperty_plugin_option['subheader-background'])){
					if($kodeproperty_plugin_option['subheader-background'] <> ''){
						$style .= '.kf_property_sub_banner{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['subheader-background']) . ' !important;  }' . "\r\n";
					}
				}
				
				//Sub Header Title Color
				if(isset($kodeproperty_plugin_option['subheader-title-color'])){
					if($kodeproperty_plugin_option['subheader-title-color'] <> ''){
						$style .= '.kf_sub_banner_hdg h3{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['subheader-title-color']) . ' !important;  }' . "\r\n";
					}
				}
				
				//Sub Header Title Color
				if(isset($kodeproperty_plugin_option['subheader-breadcrumb-bgcolor'])){
					if($kodeproperty_plugin_option['subheader-breadcrumb-bgcolor'] <> ''){
						$style .= '.kf_property_breadcrumb ul{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['subheader-breadcrumb-bgcolor']) . ' !important;  }' . "\r\n";
					}
				}
				
				//Sub Header Title Color
				if(isset($kodeproperty_plugin_option['subheader-breadcrumb-color'])){
					if($kodeproperty_plugin_option['subheader-breadcrumb-color'] <> ''){
						$style .= '.breadcrumb > li + li::before, .kf_property_breadcrumb ul li a, .kf_property_breadcrumb ul li strong{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['subheader-breadcrumb-color']) . ' !important;  }' . "\r\n";
					}
				}
				
				//Sub Header Title Color
				if(isset($kodeproperty_plugin_option['subheader-breadcrumb-hover-color'])){
					if($kodeproperty_plugin_option['subheader-breadcrumb-hover-color'] <> ''){
						$style .= '.kf_property_breadcrumb ul li a:hover{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['subheader-breadcrumb-hover-color']) . ' !important;  }' . "\r\n";
					}
				}
				
				
				if(isset($kodeproperty_plugin_option['nav-area-background-color'])){
					if($kodeproperty_plugin_option['nav-area-background-color'] <> ''){
						$style .= '.header_4 .kode_property_top_navi_row_4{ ';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['nav-area-background-color']) . ' !important;  }' . "\r\n";
					}
				}
				
				
				if(isset($kodeproperty_plugin_option['text-color'])){
					if($kodeproperty_plugin_option['text-color'] <> ''){
						$style .= '.kode-blog-content p{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['text-color']) . ' !important;  }' . "\r\n";
					}
				}
				
				
				
				if(isset($kodeproperty_plugin_option['color-scheme-one'])){
					if(empty($kodeproperty_plugin_option['color-scheme-one'])){
						$kodeproperty_plugin_option['color-scheme-one'] = '#03AF14';
					}
				}
				
				
				if(isset($kodeproperty_plugin_option['color-scheme-one'])){
					if($kodeproperty_plugin_option['color-scheme-one'] <> ''){
					$style .= '	
						/*Reviews of the Client Wrap Css*/
						.kf_client_review_slider .item:hover .kf_pet_testi_3::before
						/*property Listing 04 Wrap CSS*/';
						$style .= '	{
							border-color:' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' transparent transparent;	
						}';
						
						$style .= '
						/*Header Wrap Css*/
						.kf_top_social_icon ul li:hover a,
						.kf_callus i,
						.kf_phone_num h6,
						.kf_main_navigation ul li::before,
						.kf_main_navigation ul li.active > a,
						.kf_main_navigation ul li:hover > a,
						/*Banner Wrap Css*/
						/*Our Services Wrap Css*/
						.kf_property_services_wrap:hover i,
						.kf_property_services_wrap:hover h5 > a,
						/*Property Listing Wrap Css*/
						.kf_property_listing_wrap:hover .kf_property_listing_des h5 > a,
						.kf_property_listing_wrap:hover .kf_listing_total_price h4,
						/*Pagination Wrap Css*/
						.kf_property_pagination ul li a:hover,
						.kf_property_pagination ul li.active a,
						/*Most Recent Property Wrap Css*/
						/*Leased And Sold Property Wrap Css*/
						/*Property For Rent Wrap Css*/
						.kf_rent_property_des h6 > a:hover,
						.kf_rent_property_des ul li:hover i,
						/*Our Agent Wrap*/
						/*Number Counter Wrap Css*/
						/*Latest Blog Wrap Css*/
						/*Map Wrap Css*/
						/*Company Wrap Css*/
						/*Twitter Wrap Css*/
						/*Home Page Footer Widgets*/
						/*Home Page Footer*/
						/*Index Page 2 CSS*/
						/*Advance Search Css*/
						/*Sub Banner Wrap Css*/
						/*Know More About Property Wrap Css*/
						/*Heading Wrap Css*/
						/*Testmonial Wrap Start Wrap Css*/
						/*Core Value Wrap Start Wrap Css*/
						/*Blog Listing Wrap Css*/
						ul.kf_blog_listing_meta li:hover a,
						.kf_blog_listing_des > a:hover,
						/*Aside Bar Widgets Css*/
						.kf_aside_category ul li:hover:before,
						.kf_aside_category ul li:hover a,
						.kf_aside_category ul li:hover span,
						/*Featured Post Css*/
						.kf_aside_post_des h6 > a:hover,
						/*Featured Agent CSS*/
						.kf_aside_agent_des h6 > a:hover,
						.kf_aside_agent_des span i,
						/*Featured Properties CSS*/
						/*Search For Property Wrap CSS*/
						/*Blog Listing 2 Wrap Css*/
						ul.kf_blog_social_icon li:hover a,
						.kf_listing2_blog h4 > a:hover,
						/*Blog Detail Wrap Css*/
						ul.kf_tag_list li:hover a,
						.kf_property_detail_real ul li:hover i,
						.kf_property_detail_real ul li:hover  a,
						/*Comment CSS*/
						.kf_comment_des > a,
						.kf_comment_des h6 > a:hover,
						/*Post Comment CSS*/
						/*Blog Detail 2 Wrap Css*/
						.kf_property_detail_Essentail ul li:hover a,
						/*Comming Soon Page Css*/
						/*Team Detail Page Css*/
						/*Reviews of the Client Wrap Css*/
						.kf_pet_testi_3_fig_des h5 > a:hover,
						/*Property Meta Wrap Css*/
						/*property Listing 02 Wrap CSS*/
						.kf_property_caption h5 > a:hover,
						.kf_property_dolar li:hover a,
						ul.kf_listing_03_location li:hover a,
						/*property Listing 04 Wrap CSS*/
						/*Contact Us 03 Wrap Css*/
						/*Property Detail Page Css*/
						
						/*404 Page Page Css*/
						.kf_error_text h3,
						/*Submit Property Page Css*/
						/*ShortCode CSS*/
						.pet_love_content_list h6 > a:hover,
						.goal_des > ul > li::before,
						ul.kf_product_featured_list li:hover a,
						/* Envoto Listing Css */
						ul.envoto_ui_element li:hover a,
						ul.envoto_tweet_element li:hover a
						/*Login Page Css*/
						/*Header 3 Css Wrap*/
						.kode-pagination > a,
						.kf_logo_nav_wrap .kf_callus i,
						.kf_logo_nav_wrap .kf_phone_num h6,
						.kf_property_rent_wrap a.kode_link_1:hover,
						/* Gallery Wrap Start */{';
						$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' !important;  }' . "\r\n";

						$style .= '
						/*
							  ============================================================
								   Background Color
							  ============================================================
						*/
						.user-profile .close,
						/*Header Wrap Css*/
						.kf_list_free:hover,
						/*Navigation 2 CSS*/
						.dl-menuwrapper ul,
						.kf_logo_nav_style2 .kf_main_navigation > ul > li.active > a,
						.kf_logo_nav_style2 .kf_main_navigation > ul > li:hover > a,
						/*Banner Wrap Css*/
						.kf_banner_wrap .bx-wrapper .bx-controls-direction a:hover,
						/* DL Menu Wrap CSS */
						.dl-menuwrapper button,
						/*Our Services Wrap Css*/
						.kf_twitter_wrap_bg:before,
						.kf_property_services_wrap:hover h5 > a:before,
						/*Property Listing Wrap Css*/
						.kf_listing_overlay,
						/*Pagination Wrap Css*/
						/* Video Wrap Css */
						.kf_play_btn > a:hover,
						.kf_video_wrap > a:hover,
						.kf_video_wrap > a:hover > i:after,
						/*Most Recent Property Wrap Css*/
						/*Leased And Sold Property Wrap Css*/
						.kf_leased_property:after,
						/*Property For Rent Wrap Css*/
						.kf_rent_label,
						.kf_rent_property_des ul li:hover span,
						.kf_property_rent_wrap:hover .kf_rent_location,
						.kf_rent_property.owl-theme .owl-controls .owl-page.active span,
						.kf_rent_property.owl-theme .owl-controls .owl-page:hover span,
						/*Our Agent Wrap*/
						.kf_agent_slider.owl-theme .owl-controls .owl-buttons div:hover,
						/*Number Counter Wrap Css*/
						.kf_num_counter_bg:before,
						/*Latest Blog Wrap Css*/
						/*Map Wrap Css*/
						/*Company Wrap Css*/
						/*Twitter Wrap Css*/
						.kf_twitter_wrap_bg,
						/*Home Page Footer Widgets*/
						.widget > h6:before,
						/*Home Page Footer*/
						/*Index Page 2 CSS*/
						.kf_schedule_wrap,
						.kf_schedule_visit > a:hover,
						/*Advance Search Css*/
						.kf_search_field input[type="submit"],
						.kf_search_field button,
						/*Sub Banner Wrap Css*/
						/*Know More About Property Wrap Css*/
						.kf_know_property_bg,
						/*Heading Wrap Css*/
						.kf_heading_2 h3:before,
						/*Testmonial Wrap Start Wrap Css*/
						/*Core Value Wrap Start Wrap Css*/
						/* About Us Wrap Css */
						.kf_video_icon a:hover,
						/*Blog Listing Wrap Css*/
						.kf_blog_listing_wrap .bx-wrapper .bx-controls-direction a,
						/*Aside Bar Widgets Css*/
						/*Search For Property Wrap CSS*/
						.kf_search_property_wrap h6,
						.kf_property_field .kf_range_slider .ui-slider .ui-slider-range,
						.aside_hdg h5:after,
						h2.widget-title:after,
						.kf_property_field input[type="submit"],
						.kf_property_field button,
						/*Featured Post Css*/
						/*Featured Agent CSS*/
						/*Featured Properties CSS*/
						/*Blog Listing 2 Wrap Css*/
						.kf_listing2_blog_wrap:hover .kf_listing2_blog_des > a,
						/*Blog Detail Wrap Css*/
						.kf_property_detail_social_icon ul li a,
						/*Post Comment CSS*/
						.kf_commet_field input[type="submit"],
						.kf_commet_field button,
						/*Blog Detail 2 Wrap Css*/
						/*Comming Soon Page Css*/
						.kf_cooming_soon_form button:hover,
						/*Team Detail Page Css*/
						.member_contact_des i,
						.kf_member_contact_detail ul li:hover,
						/*Reviews of the Client Wrap Css*/
						.kf_client_review_slider.owl-theme .owl-controls .owl-page.active span,
						.kf_client_review_slider.owl-theme .owl-controls .owl-page:hover span,
						/*Property Meta Wrap Css*/
						/*property Listing 02 Wrap CSS*/
						/*property Listing 03 Wrap CSS*/
						.kf_listing_03_wrap:hover .kf_listing_total,
						/*property Listing 04 Wrap CSS*/
						.kf_listing_03_des > a:hover,
						/*Contact Us 03 Wrap Css*/
						.kf_content_us_icon:before,
						.kf_content_us_icon span:before,
						.kf_loging_input button,
						.kf_loging_input input[type="submit"],
						/*Property Detail Page Css*/
						.kf_property_detail_bed ul li:hover,
						.kf_property_detail_sale > a,
						.kf_property_detail_form button,
						.kf_property_detail_form input[type="submit"],
						/*404 Page Page Css*/
						.kf_go_back_bg,
						/*Submit Property Page Css*/
						.kf_submit_property_button button,
						/*ShortCode CSS*/
						.accordion.accordion-open,
						ul.kf_shortcode_social2 li:hover a,
						.kf_link_1:hover,
						.kf_hdr2_search .widget-search label,
						.kf_btn_1:hover,
						.kf-action7_content:hover a,
						.kf-action7_content:hover a:before,
						.pet_love_content ul li:hover span::before,
						.kf_price_table:hover .kf_table_price,
						.kf_price_table:hover .kf_table_price::before,
						/*Login Page Css*/
						.kf_login_1,
						/*Header 3 Css Wrap*/
						.top_navi_circal:hover a,
						.widget_kodeproperty_search_property_widget h2,
						.kf_hdr2_search > a:hover,
						.kf_hdr2_navigation,
						/* Gallery Wrap Start */
						/*Step 1 CSS*/
						.kf_property_rent_wrap a.kode_link_1:hover,
						.kf_submit_field span,
						.kf_submit_field_btn .previous,
						.kf_submit_field_btn .next,
						.kf_submit_field_btn .submit,
						/* Contact Us 1 Wrap */
						/*Submit Add Aside Bar Wrap*/
						#progressbar li:after,
						#progressbar li.active:before,  #progressbar li.active:after,
						.kf_listing_detail > a.kode_link_1:hover,
						.kf_video_wrap a:hover,
						.kf_recent_property_des > a.kode_link_1:hover,		
						.kf_listing_detail > a.kode_link_1:hover,
						.kf_property_services_wrap a.kode_link_1:hover,
						.kf_prdct_featured_wrap a.kode_link_1:hover,
						.form-submit input[type="submit"]:hover,
						.kf_leased_property.kf_sold_property a.kode_link_1:hover,
						.kf_commet_field input[type="submit"]:hover,
						.kf_commet_field button:hover,
						#mceu_0 > button:hover,
						.mce-toolbar .mce-ico:hover,
						.mce-btn button:hover,
						.user-profile ul li a:hover,
						.user-custom-pay-form,
						.kodehotel-form-button,
						.kf_author_wrap,
						.header_3 .kode_top_register_3 li .kode_property_right_3,
						.kode_location_search_button_4 button,
						.header_4 .kode_property_advance_search_4 button,
						.kode_property_account_list li a:hover,
						.pet_love_content:hover span,
						.kode-calculator-button input.calculator-button[type="button"],
						.woocommerce .woocommerce-Button,
						.kf_with_us_form button,
						/* bbpress */
						.bbp-breadcrumb,
						div.bbp-submit-wrapper #bbp_topic_submit,
						#bbpress-forums li.bbp-header .bbp-reply-content .subscription-toggle,
						#bbpress-forums #bbp_topic_submit, #bbpress-forums #bbp_reply_submit,
						.kode_property_amount_list li.kode_property_table,
						#filterable-item-filter-1 a
						{';
						$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' !important;  }' . "\r\n";
						
						
						$style .= '
						/*
						============================================================
						Border Color
						============================================================
						*/
						/*Header Wrap Css*/
						.kf_main_navigation ul ul,
						/*Banner Wrap Css*/
						.kf_video_wrap a:hover,
						.kf_listing_detail > a.kode_link_1:hover,
						.pet_love_content:hover span,
						.kf_recent_property_des > a.kode_link_1:hover,
						/*Our Services Wrap Css*/
						/*Property Listing Wrap Css*/
						.kf_listing_detail > a.kf_link_1:hover,
						/*Pagination Wrap Css*/
						.kf_property_listing_wrap:hover,
						/* Video Wrap Css */
						.kf_play_btn > a:hover,
						.kf_video_wrap > a:hover,
						/*Most Recent Property Wrap Css*/
						/*Leased And Sold Property Wrap Css*/
						/*Property For Rent Wrap Css*/
						/*Our Agent Wrap*/
						/*Number Counter Wrap Css*/
						/*Latest Blog Wrap Css*/
						/*Map Wrap Css*/
						/*Company Wrap Css*/
						.kf_compnay_wrap:hover,
						/*Twitter Wrap Css*/
						/*Home Page Footer Widgets*/
						/*Home Page Footer*/
						/*Index Page 2 CSS*/
						/*Advance Search Css*/
						/*Sub Banner Wrap Css*/
						/*Know More About Property Wrap Css*/
						/*Heading Wrap Css*/
						/*Testmonial Wrap Start Wrap Css*/
						/*Core Value Wrap Start Wrap Css*/
						/*Blog Listing Wrap Css*/
						.kf_blog_listing_pager a.active,
						.kf_blog_listing_pager a:hover,
						/*Aside Bar Widgets Css*/
						/*Search For Property Wrap CSS*/
						.kf_property_field .kf_range_slider .ui-slider .ui-slider-handle,
						/*Featured Post Css*/
						/*Featured Agent CSS*/
						/*Featured Properties CSS*/
						/*Blog Listing 2 Wrap Css*/
						.kf_listing2_blog_wrap:hover .kf_listing2_blog_des > a,
						/*Blog Detail Wrap Css*/
						/*Blog Detail 2 Wrap Css*/
						/*Comming Soon Page Css*/
						/*Team Detail Page Css*/
						/*Reviews of the Client Wrap Css*/
						.kf_client_review_slider .item:hover .kf_pet_testi_3,
						.kf_client_review_slider .item:hover .kf_pet_testi_3_fig figure img,
						/*Property Meta Wrap Css*/
						/*property Listing 02 Wrap CSS*/
						/*property Listing 04 Wrap CSS*/
						.kf_listing_03_des > a:hover,
						/*Contact Us 03 Wrap Css*/
						.kf_content_us_icon span:after,
						/*Property Detail Page Css*/
						/*404 Page Page Css*/
						/*Submit Property Page Css*/
						/*ShortCode CSS*/
						ul.kf_shortcode_social2 li:hover a,
						.kf_link_1:hover,
						.kf_prdct_featured_wrap a.kf_link_1:hover,
						.kf_price_table:hover,
						.kf_property_rent_wrap a.kode_link_1:hover,
						.kf_prdct_featured_wrap a.kode_link_1:hover,
						.kf_leased_property.kf_sold_property a.kode_link_1:hover,
						/*Login Page Css*/
						/*Header 3 Css Wrap*/
						.kf_recent_property_des > a.kode_link_1:hover,
						.kf_hdr2_search input[type="text"]:focus{';
						$style .= 'border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' !important;  }' . "\r\n";
					}						
				}
						if(isset($kodeproperty_plugin_option['color-scheme-two']) && $kodeproperty_plugin_option['color-scheme-two'] <> ''){
							$style .= '/*
								  ============================================================
									   Font Color
								  ============================================================
							*/
							/*Header Wrap Css*/
							/*Banner Wrap Css*/
							/*Our Services Wrap Css*/
							/*Property Listing Wrap Css*/
							/*Pagination Wrap Css*/
							.kf_num_count_wrap a:hover,
							/*Most Recent Property Wrap Css*/
							.kf_like_property > a:hover,
							/*Leased And Sold Property Wrap Css*/
							/*Property For Rent Wrap Css*/
							/*Our Agent Wrap*/
							.kf_agent_des h6 > a:hover,
							/*Number Counter Wrap Css*/
							/*Latest Blog Wrap Css*/
							.kf_blog_post_wrap:hover > h6,
							.kf_blog_des > h6 > a:hover,
							.kf_blog_post_wrap:hover .kf_blog_des > a,
							ul.kf_blog_post_meta li:hover i,
							ul.kf_blog_post_meta li:hover a,
							/*Map Wrap Css*/
							/*Company Wrap Css*/
							/*Twitter Wrap Css*/
							/*Home Page Footer Widgets*/
							/*Home Page Footer*/
							/*Col 1*/
							ul.kf_foo_address li:hover i,
							ul.kf_foo_address li:hover a,
							/*Col 2*/
							.kf_foo_listing_des > h6 > a:hover,
							/*Col 3*/
							.kf_foo_post_des p > a:hover,
							/*Col 4*/
							.kf_foo_property_type ul li:hover a,
							/*Copy Right Css*/
							.kf_copyright_element ul li:hover a,
							/*Index Page 2 CSS*/
							/*Advance Search Css*/
							.kf_search_field .amount,
							/*Sub Banner Wrap Css*/
							/*Know More About Property Wrap Css*/
							/*Heading Wrap Css*/
							/*Testmonial Wrap Start Wrap Css*/
							/*Core Value Wrap Start Wrap Css*/
							.kf_core_value_wrap ul li.active a,
							.kf_core_value_wrap ul li:hover a,
							/*Blog Listing Wrap Css*/
							/*Aside Bar Widgets Css*/
							/*Search For Property Wrap CSS*/
							/*Featured Post Css*/
							/*Featured Agent CSS*/
							/*Featured Properties CSS*/
							/*Blog Listing 2 Wrap Css*/
							/*Blog Detail Wrap Css*/
							/*Blog Detail 2 Wrap Css*/
							/*Comming Soon Page Css*/
							.kf_comming_counter ul.downcount li span,
							/*Team Detail Page Css*/
							.kf_team_detail_des ul.kf_recent_rating li:hover a,
							/*Reviews of the Client Wrap Css*/
							/*Property Meta Wrap Css*/
							/*property Listing 02 Wrap CSS*/
							/*property Listing 04 Wrap CSS*/
							.kf_listing_03_des ul.kf_recent_rating li:hover a,
							/*Contact Us 03 Wrap Css*/
							.kf_with_us_social ul li:hover a,
							.kf_login_password ul li:hover a,
							/*Property Detail Page Css*/
							/*404 Page Page Css*/
							.kf_404_wrap h2,
							.kf_not_found_wrap h2,
							/*Submit Property Page Css*/
							.kf_submit_property_newsletter a,
							/*ShortCode CSS*/
							.kf_link_2:hover,
							/*Login Page Css*/
							/*Header 3 Css Wrap*/
							.kf_hdr2_social_icon ul li:hover a,
							.kf_blog_post_wrap .kode-blog-content a.kode_link_2:hover,
							.kf_top_weather a:hover
							/* Gallery Wrap Start */{';
							$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
							$style .= '
							/*
								  ============================================================
									   Background Color
								  ============================================================
							*/
							/*Header Wrap Css*/
							.kf_top_bar,
							.no-touch .dl-menuwrapper li a:hover,
							/*Banner Wrap Css*/
							.kf_banner_wrap .bx-wrapper .bx-controls-direction a,
							/* DL Responsive CSS */
							.dl-menuwrapper button:hover,
							.dl-menuwrapper button.dl-active,
							.kf_hdr2_navigation .dl-trigger,
							/*Our Services Wrap Css*/
							/*Property Listing Wrap Css*/
							/*Pagination Wrap Css*/
							/*Most Recent Property Wrap Css*/
							/*Leased And Sold Property Wrap Css*/
							.header_3 .kode_top_register_3 li .kode_property_left_3,
							.kf_sold_property.kf_sold_property:after,
							.kf_leased_property a.kf_link_1:hover,
							/*Property For Rent Wrap Css*/
							/*Our Agent Wrap*/
							/*Number Counter Wrap Css*/
							/*Latest Blog Wrap Css*/
							.kf_blog_slider.owl-theme .owl-controls .owl-buttons div:hover,
							/*Map Wrap Css*/
							/*Company Wrap Css*/
							/*Twitter Wrap Css*/
							/*Home Page Footer Widgets*/
							.widget > h6:after,
							.kf_foo_listing_hover,
							/*Home Page Footer*/
							/*Col 1*/
							ul.kf_foo_social_icon li:hover a,
							/*Index Page 2 CSS*/
							.kf_schedule_visit > a,
							/*Advance Search Css*/
							.kf_search_tab_wrap ul li.active a,
							.kf_search_tab_wrap ul li:hover a,
							.kf_search_field input[type="submit"]:hover,
							.kf_search_field button:hover,
							.kf_range_slider .ui-widget-header,
							/*Sub Banner Wrap Css*/
							.kf_property_sub_banner,
							/*Know More About Property Wrap Css*/
							/*Heading Wrap Css*/
							.kf_heading_2 h3:after,
							/*Testmonial Wrap Start Wrap Css*/
							/*Core Value Wrap Start Wrap Css*/
							.kf_testimonial_wrap .bx-wrapper .bx-controls-direction a:hover,
							/*Blog Listing Wrap Css*/
							.kf_blog_listing_wrap .bx-wrapper .bx-controls-direction a:hover,
							/*Aside Bar Widgets Css*/
							/*Search For Property Wrap CSS*/
							.aside_hdg h5:before,
							h2.widget-title:before,
							.kf_property_field input[type="submit"]:hover,
							.kf_property_field button:hover,
							/*Featured Post Css*/
							/*Featured Agent CSS*/
							/*Featured Properties CSS*/
							/*Blog Listing 2 Wrap Css*/
							.kf_blog2_date:before,
							.kf_listing2_blog_des .bx-wrapper .bx-controls-direction a:hover,
							/*Blog Detail Wrap Css*/
							.kf_property_detail_social_icon ul li:hover a,
							/*Post Comment CSS*/
							.kf_commet_field input[type="submit"]:hover,
							.kf_commet_field button:hover,
							/*Blog Detail 2 Wrap Css*/
							/*Comming Soon Page Css*/
							.kf_cooming_soon_form button,
							/*Team Detail Page Css*/
							.kf_member_contact_detail ul li:hover .member_contact_des i,
							/*Reviews of the Client Wrap Css*/
							/*Property Meta Wrap Css*/
							.kf_property_view i:hover,
							/*property Listing 02 Wrap CSS*/
							.kf_property_more:hover,
							/*property Listing 04 Wrap CSS*/
							/*Contact Us 03 Wrap Css*/
							.kf_with_us_form button:hover,
							.kf_loging_input button:hover,
							.kf_loging_input input[type="submit"],
							.kf_loging_input input[type="text"]:focus + label,
							.kf_loging_input input[type="password"]:focus + label,
							/*Property Detail Page Css*/
							.kf_property_detail_form button:hover,
							.kf_property_detail_form input[type="submit"]:hover,
							/*404 Page Page Css*/
							/*Submit Property Page Css*/
							.kf_submit_property_button button:hover,
							/*ShortCode CSS*/
							.kf_table_price,
							.kf_table_price::before,
							/*Login Page Css*/
							.kf_login_social_icon ul li:hover a,
							/*Header 3 Css Wrap*/
							.top_navi_circal a,
							.kf_hdr2_search > a,
							.kf_menu_scl_icon ul li a,
							.header2 .kf_main_navigation > ul > li.active > a,
							.header2 .kf_main_navigation > ul > li:hover > a,
							/*2nd Ul*/
							.kf_leased_property a.kode_link_1:hover,
							.header2 .kf_main_navigation ul ul li:hover > a,
							/* Gallery Wrap Start */
							#filterable-item-filter-1 a:hover,
							.header_3 .kode_top_nav_search_row_3 li .kode_property_search_bar_3:hover,
							.edu_masonery_thumb:hover figure figcaption,
							#search-property-btn,
							.kf_twitter_wrap_bg::before,
							.kf_submit_field_btn input[type="button"],
							.kf_property_rent_wrap:hover .kf_rent_total_price,
							.header_4 .kode_property_top_nav_4,
							.kode_location_property_4,
							.header_4 .kode_property_icon_search_4 li a,
							.kode_location_button_feature_4,
							#bbpress-forums li.bbp-header,
							.bbp-admin-links a:hover,
							.subscription-toggle,
							.kf_loging_input label,
							#agent-contact-sub,
							.kode-cheaked-boxs li.selected-checkbox,
							#filterable-item-filter-1 > li .active{';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
							$style .= '
							.widget-filter input:checked + .radio-value{ ';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
							$style .= '
							.kf_property_sub_banner:before{ ';
							$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['subheader-background-color']) . ' !important;border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
							$style .= '
							.kf_property_sub_banner:before{ ';
							$style .= 'opacity: ' . esc_attr($kodeproperty_plugin_option['subheader-background-opacity']) . ' !important;border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
							$style .= '
							.kf_property_sub_banner{ ';
							$style .= 'background-attachment: ' . esc_attr($kodeproperty_plugin_option['subheader-bg-position']) . ' !important;border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
							
							$style .= '
							/*
							============================================================
							Border Color
							============================================================
							*/
							/*Header Wrap Css*/
							/*Banner Wrap Css*/
							.kf_banner_wrap,
							/*Our Services Wrap Css*/
							/*Property Listing Wrap Css*/
							/*Pagination Wrap Css*/
							/*Most Recent Property Wrap Css*/
							/*Leased And Sold Property Wrap Css*/
							/*Property For Rent Wrap Css*/
							.kf_blog_post_wrap .kode-blog-content a.kode_link_2:hover,
							
							/*Our Agent Wrap*/
							/*Number Counter Wrap Css*/
							/*Latest Blog Wrap Css*/
							.kf_blog_post_wrap:hover .kf_blog_des > a,
							/*Map Wrap Css*/
							/*Company Wrap Css*/
							/*Twitter Wrap Css*/
							/*Home Page Footer Widgets*/
							.kf_foo_featured_listing figure,
							/*Home Page Footer*/
							/*Index Page 2 CSS*/
							/*Advance Search Css*/
							.kf_range_slider .ui-slider .ui-slider-handle,
							/*Sub Banner Wrap Css*/
							/*Know More About Property Wrap Css*/
							/*Heading Wrap Css*/
							/*Testmonial Wrap Start Wrap Css*/
							/*Core Value Wrap Start Wrap Css*/
							/*Blog Listing Wrap Css*/
							/*Aside Bar Widgets Css*/
							/*Search For Property Wrap CSS*/
							.kf_property_field input[type="submit"]:hover,
							.kf_property_field button:hover,
							/*Featured Post Css*/
							/*Featured Agent CSS*/
							/*Featured Properties CSS*/
							/*Blog Listing 2 Wrap Css*/
							/*Blog Detail Wrap Css*/
							/*Blog Detail 2 Wrap Css*/
							/*Comming Soon Page Css*/
							/*Team Detail Page Css*/
							/*Reviews of the Client Wrap Css*/
							/*Property Meta Wrap Css*/
							/*property Listing 02 Wrap CSS*/
							/*property Listing 04 Wrap CSS*/
							.kf_property_more:hover,
							/*Contact Us 03 Wrap Css*/
							.kf_loging_input input[type="text"]:focus,
							/*Property Detail Page Css*/
							.kf_property_detail_form button:hover,
							.kf_property_detail_form input[type="submit"]:hover,
							.kf_property_detail_form input[type="text"]:focus,
							.kf_property_detail_form textarea:focus,
							.kf_leased_property a.kode_link_1:hover,
							/*404 Page Page Css*/
							/*Submit Property Page Css*/
							/*ShortCode CSS*/
							.kf_link_2:hover
							/*Login Page Css*/
							/*Header 3 Css Wrap*/
							/* Gallery Wrap Start */{';
							$style .= 'border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-two']) . ' !important;  }' . "\r\n";
							
						}
						
						
						$style .= '.header_3 .kode_top_bar_3{';
						$style .= 'border-top-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' !important;  }' . "\r\n";
						
						
						$style .= '.kf_login_colum{';
						$style .= 'border-bottom-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' !important;  }' . "\r\n";
						
						$style .= '.kode_location_property_4{';
						$style .= 'border-bottom-color: #fff !important;  }' . "\r\n";
						
						$style .= '.kf_login_1::before{';
						$style .= 'border-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one']) . ' transparent transparent !important;  }' . "\r\n";
						
						
						if(isset($kodeproperty_plugin_option['color-scheme-one']) && $kodeproperty_plugin_option['color-scheme-one'] <> ''){
							$style .= '.kode_pet_navigation ul.nav li a.current{';
							$style .= 'border-top-color: ' . esc_attr($kodeproperty_plugin_option['color-scheme-one'] ). ' !important;  }' . "\r\n";
						}
						
						if(isset($settings['caption-btn-color-switch']) && $settings['caption-btn-color-switch'] == 'enable'){
							if(isset($kodeproperty_plugin_option['caption-btn-color-hover']) && $kodeproperty_plugin_option['caption-btn-color-hover'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out:hover{';
								$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-color-hover']) . ' !important;  }' . "\r\n";
							}
							if(isset($kodeproperty_plugin_option['caption-btn-color']) && $kodeproperty_plugin_option['caption-btn-color'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out{';
								$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-color']) . ' !important;  }' . "\r\n";
							}
							
							if(isset($kodeproperty_plugin_option['caption-btn-color-border']) && $kodeproperty_plugin_option['caption-btn-color-border'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out{';
								$style .= 'outline-color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-color-border']) . ' !important;  }' . "\r\n";
							}
							
							if(isset($kodeproperty_plugin_option['caption-btn-color-bg']) && $kodeproperty_plugin_option['caption-btn-color-bg'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out{';
								$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-color-bg']) . ' !important;  }' . "\r\n";
							}
							
							if(isset($kodeproperty_plugin_option['caption-btn-hover-bg']) && $kodeproperty_plugin_option['caption-btn-hover-bg'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out:hover{';
								$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-hover-bg']) . ' !important;  }' . "\r\n";		
							}

							if(isset($kodeproperty_plugin_option['caption-btn-arrow-color']) && $kodeproperty_plugin_option['caption-btn-arrow-color'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out i{';
								$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-arrow-color']) . ' !important;  }' . "\r\n";		
							}
							
							if(isset($kodeproperty_plugin_option['caption-btn-arrow-hover']) && $kodeproperty_plugin_option['caption-btn-arrow-hover'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out:hover i{';
								$style .= 'color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-arrow-hover']) . ' !important;  }' . "\r\n";		
							}
							
							if(isset($kodeproperty_plugin_option['bx-arrow']) && $kodeproperty_plugin_option['bx-arrow'] == 'disable'){
								$style .= '.kode-item.kode-slider-item .kode-bxslider .bx-controls-direction{';
								$style .= 'display:none !important;  }' . "\r\n";		
							}
							
							if(isset($kodeproperty_plugin_option['caption-btn-arrow-bg']) && $kodeproperty_plugin_option['caption-btn-arrow-bg'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out:before{';
								$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-arrow-bg']) . ' !important;  }' . "\r\n";		
							}
							
							if(isset($kodeproperty_plugin_option['caption-btn-arrow-hover-bg']) && $kodeproperty_plugin_option['caption-btn-arrow-hover-bg'] <> ''){
								$style .= '.kode_link_1.kode-linksection.hvr-radial-out:hover:before{';
								$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['caption-btn-arrow-hover-bg']) . ' !important;  }' . "\r\n";	
							}
						}
						if(isset($kodeproperty_plugin_option['sidebar-tbn']) && $kodeproperty_plugin_option['sidebar-tbn'] == 'enable'){
							if(isset($kodeproperty_plugin_option['sidebar-bg-color'])){
								$style .= '
								.kode-sidebar.kode-left-sidebar,
								.kode-sidebar.kode-right-sidebar,
								.kode-widget.kode-sidebar-element{';
								$style .= 'background-color: ' . esc_attr($kodeproperty_plugin_option['sidebar-bg-color']) . ' !important;float:left;width:100%;}' . "\r\n";
							}
							
							if(isset($kodeproperty_plugin_option['sidebar-padding-top'])){
								$style .= '
								.kode-sidebar.kode-left-sidebar,
								.kode-sidebar.kode-right-sidebar,
								.kode-widget.kode-sidebar-element{';
								$style .= 'padding-top: ' . esc_attr($kodeproperty_plugin_option['sidebar-padding-top']) . 'px !important;}' . "\r\n";
							}
							if(isset($kodeproperty_plugin_option['sidebar-padding-bottom'])){
								$style .= '
								.kode-sidebar.kode-left-sidebar,
								.kode-sidebar.kode-right-sidebar,
								.kode-widget.kode-sidebar-element{';
								$style .= 'padding-bottom: ' . esc_attr($kodeproperty_plugin_option['sidebar-padding-bottom']) . 'px !important;}' . "\r\n";
							}
							if(isset($kodeproperty_plugin_option['sidebar-padding-left'])){
								$style .= '
								.kode-sidebar.kode-left-sidebar,
								.kode-sidebar.kode-right-sidebar,
								.kode-widget.kode-sidebar-element{';
								$style .= 'padding-left: ' . esc_attr($kodeproperty_plugin_option['sidebar-padding-left']) . 'px !important;}' . "\r\n";
							}
							if(isset($kodeproperty_plugin_option['sidebar-padding-right'])){
								$style .= '
								.kode-sidebar.kode-left-sidebar,
								.kode-sidebar.kode-right-sidebar,
								.kode-widget.kode-sidebar-element{';
								$style .= 'padding-right: ' . esc_attr($kodeproperty_plugin_option['sidebar-padding-right']) . 'px !important;}' . "\r\n";
							}
						}
						if(isset($kodeproperty_plugin_option['woo-post-title']) && $kodeproperty_plugin_option['woo-post-title'] == 'disable'){
							$style .= '.woocommerce-content-item .product .product_title.entry-title{ display:none;}';							
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-price']) && $kodeproperty_plugin_option['woo-post-price'] == 'disable'){
							$style .= '.woocommerce-content-item div[itemprop="offers"]{ display:none;}';
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-variable-price']) && $kodeproperty_plugin_option['woo-post-price'] == 'disable'){
							$style .= '.woocommerce-content-item div[itemprop="offers"]{ display:none;}';
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-related']) && $kodeproperty_plugin_option['woo-post-related'] == 'disable'){
							$style .= '.woocommerce-content-item .product .related.products{ display:none;}';
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-sku']) && $kodeproperty_plugin_option['woo-post-sku'] == 'disable'){
							$style .= '.woocommerce-content-item .product .sku_wrapper{ display:none;}';
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-category']) && $kodeproperty_plugin_option['woo-post-category'] == 'disable'){
							$style .= '.woocommerce-content-item .product .posted_in{ display:none; !important;}';
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-tags']) && $kodeproperty_plugin_option['woo-post-tags'] == 'disable'){
							$style .= '.woocommerce-content-item .product .tagged_as{ display:none !important;}';
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-outofstock']) && $kodeproperty_plugin_option['woo-post-outofstock'] == 'disable'){
							
						}
						
						if(isset($kodeproperty_plugin_option['woo-post-saleicon']) && $kodeproperty_plugin_option['woo-post-saleicon'] == 'disable'){
							$style .= '.woocommerce-content-item .product .onsale{ display:none;}';
						}

					
				return $style;
				
			}
		}
		
		