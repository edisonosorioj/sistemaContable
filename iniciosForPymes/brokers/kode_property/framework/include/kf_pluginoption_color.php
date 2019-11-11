<?php
	/*	
	*	Kode Property Theme option color File
	*	---------------------------------------------------------------------
	*	This file contains the color option setting 
	*	---------------------------------------------------------------------
	*	http://stackoverflow.com/questions/2270989/what-does-apply-filters-actually-do-in-wordpress
	*/
	
	add_filter('kodeproperty_pluginoption_panel', 'kodeproperty_register_property_plugin_option_color');
	if( !function_exists('kodeproperty_register_property_plugin_option_color') ){
		function kodeproperty_register_property_plugin_option_color( $array ){	
			global $kodeproperty_plugin_option;
			//if empty
			if( empty($array['property-settings']['options']) ){
				return $array;
			}
			$property_head =  array(
				'title' => esc_html__('Color Options', 'kode-property'),				
				'icon' => 'fa-eyedropper',
			);
			
			$property_general =  array(
				'title' => esc_html__('General', 'kode-property'),
				'options' => array(
					'color-scheme-one' => array(
						'title' => esc_html__('Color Scheme First', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change the theme skin Color of your site.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'color-scheme-two' => array(
						'title' => esc_html__('Color Scheme Two', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change the theme skin Color of your site.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'body-background' => array(
						'title' => esc_html__('Body Background', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change the Overall Color Scheme of your site.',
						'default' => '#ffffff',
						'selector'=> ''
					),
				)
			);	
			
			$property_header =  array(
				'title' => esc_html__('Header Top Bar', 'kode-property'),
				'options' => array(
				
					'top-bar-background' => array(
						'title' => esc_html__('Top Bar background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-content' => array(
						'title' => esc_html__('Top Bar Text Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar text Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-links' => array(
						'title' => esc_html__('Top Bar Links Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Links Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-links-hover-color' => array(
						'title' => esc_html__('Links Hover Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Links Hover Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-links-bgcolor' => array(
						'title' => esc_html__('Links Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Links Background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-links-hover-bgcolor' => array(
						'title' => esc_html__('Links Hover Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Links Hover Background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-left-submit-btn-text-color' => array(
						'title' => esc_html__('Top Bar Submit Button Text Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Submit Button Text Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-left-submit-btn-bg-color' => array(
						'title' => esc_html__('Top Bar Submit Button Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Submit Button Background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-left-submit-btn-text-color-hover' => array(
						'title' => esc_html__('Top Bar Submit Button Text Hover Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Submit Button Text Hover Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'top-bar-left-submit-btn-text-bg-color-hover' => array(
						'title' => esc_html__('Top Bar Submit Button Background Hover Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Top Bar Submit Button Background Hover Color.',
						'default' => '#ffffff',
						'selector'=> ''
					)
				)
			);
			
			$property_menu =  array(
				'title' => esc_html__('Navigation', 'kode-property'),
				'options' => array(
					'nav-area-background-color' => array(
						'title' => esc_html__('Navigation Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Navigation Background Color Note: this will work only on Header Style 2 and Header Style 4.',
						'default' => '#ffffff',
						'wrapper-class'=> 'kode-header-style-wrapper header-style-4-wrapper header-style-2-wrapper',
						'selector'=> ''
					),
					'main-menu-text' => array(
						'title' => esc_html__('Menu Link Text Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Link Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'main-menu-link-background' => array(
						'title' => esc_html__('Menu Link Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Link background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'main-menu-active-link' => array(
						'title' => esc_html__('Menu Active Link Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Active Link Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'main-menu-active-link-bg' => array(
						'title' => esc_html__('Menu Active Link Background', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Active Link background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
					'main-menu-link-background-on-hover' => array(
						'title' => esc_html__('Menu Link Hover Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Link Background Color on Hover.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'main-menu-link-color-on-hover' => array(
						'title' => esc_html__('Menu Link Color on Hover', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Link Color on Hover.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'main-menu-link-icon-color-on-hover' => array(
						'title' => esc_html__('Menu Link Icon Color on Hover', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Link Icon Color on Hover.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'main-menu-link-active-color' => array(
						'title' => esc_html__('Menu Active Link Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Main Menu Active Link Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-background' => array(
						'title' => esc_html__('Submenu | Background', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-bottom-border-color' => array(
						'title' => esc_html__('Submenu Border Bottom Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu Border Bottom Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-link-color' => array(
						'title' => esc_html__('Submenu | Link Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu Link Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-hover-link-color' => array(
						'title' => esc_html__('Submenu | Hover Link Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu Hover Link Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-hover-link-hover-bg' => array(
						'title' => esc_html__('Submenu | Hover Link Background', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu Hover Link Background.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-link-active-color' => array(
						'title' => esc_html__('Sub Menu Active Link Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu Active Link Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'submenu-link-active-bg-color' => array(
						'title' => esc_html__('Sub Menu Active Link BG Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Submenu Active Sub Menu Active Link BG Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					
				)
			);		
			
			$property_subheader =  array(
				'title' => esc_html__('Subheader', 'kode-property'),
				'options' => array(
					'subheader-background' => array(
						'title' => esc_html__('Subheader Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Subheader Background.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'subheader-title-color' => array(
						'title' => esc_html__('Subheader Title Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Subheader Title Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'subheader-breadcrumb-bgcolor' => array(
						'title' => esc_html__('Breadcrumb Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Subheader Breadcrumb background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'subheader-breadcrumb-color' => array(
						'title' => esc_html__('Breadcrumb Text Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Subheader Breadcrumb Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'subheader-breadcrumb-hover-color' => array(
						'title' => esc_html__('Breadcrumb Text Color on Hover', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Subheader Breadcrumb Color on Hover.',
						'default' => '#ffffff',
						'selector'=> ''
					),
				)
			);

			
			$property_content =  array(
				'title' => esc_html__('Text and Paragraph', 'kode-property'),
				'options' => array(
					'text-color' => array(
						'title' => esc_html__('Text/Paragraph Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Text/Content Paragraph text Color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'link-color' => array(
						'title' => esc_html__('Link color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Link/Anchor Color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'link-hover-color' => array(
						'title' => esc_html__('Link Hover color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Link/Anchor hover Color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'note-color' => array(
						'title' => esc_html__('Note color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Note (eg. Blog meta, Filters, Widgets meta) Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'list-color' => array(
						'title' => esc_html__('List color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change (Ordered, Unordered & Bullets List) Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'button-bg-color' => array(
						'title' => esc_html__('Button Background', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Button background Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'button-color' => array(
						'title' => esc_html__('Button color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Button text Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
				)
			);	
			
			$property_footer =  array(
				'title' => esc_html__('Footer', 'kode-property'),
				'options' => array(
					'footer-theme-color' => array(
						'title' => esc_html__('Footer Theme Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Footer Color scheme.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'footer-bg-color' => array(
						'title' => esc_html__('Footer Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Footer background color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'footer-heading-color' => array(
						'title' => esc_html__('Footer Heading Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Footer heading color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'footer-text-color' => array(
						'title' => esc_html__('Footer Text Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Footer Text/Content Color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'footer-link-color' => array(
						'title' => esc_html__('Footer Link Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Footer Link/Anchor Color.',
						'default' => '#000000',
						'selector'=> ''
					),
					'footer-link-hover-color' => array(
						'title' => esc_html__('Footer Link Hover Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change footer link hover Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'footer-link-hover-bgcolor' => array(
						'title' => esc_html__('Footer Link Hover Background Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change footer link hover Backgroung Color.',
						'default' => '#ffffff',
						'selector'=> ''
					),
					'footer-note-color' => array(
						'title' => esc_html__('Footer Note Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change footer note color(eg widgets meta).',
						'default' => '#ffffff',
						'selector'=> ''
					),
				)
			);
			
			$property_headings =  array(
				'title' => esc_html__('Headings', 'kode-property'),
				'options' => array(
					'heading-h1-color' => array(
						'title' => esc_html__('Heading H1 Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Heading h1 color.',
						'default' => '#222222',
						'selector'=> ''
					),
					'heading-h2-color' => array(
						'title' => esc_html__('Heading H2 Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Heading h2 color.',
						'default' => '#222222',
						'selector'=> ''
					),
					'heading-h3-color' => array(
						'title' => esc_html__('Heading H3 Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Heading h3 color.',
						'default' => '#222222',
						'selector'=> ''
					),
					'heading-h4-color' => array(
						'title' => esc_html__('Heading H4 Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Heading h4 color.',
						'default' => '#222222',
						'selector'=> ''
					),
					'heading-h5-color' => array(
						'title' => esc_html__('Heading H5 Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Heading h5 color.',
						'default' => '#222222',
						'selector'=> ''
					),
					'heading-h6-color' => array(
						'title' => esc_html__('Heading H6 Color', 'kode-property'),
						'type' => 'colorpicker',
						'description' => 'This Color Picker allows you to change Heading h6 color.',
						'default' => '#222222',
						'selector'=> ''
					),
				)
			);
			
			$array['color-settings'] = $property_head;
			$array['color-settings']['options']['general'] = $property_general;
			$array['color-settings']['options']['header'] = $property_header;
			$array['color-settings']['options']['menu'] = $property_menu;
			$array['color-settings']['options']['subheader'] = $property_subheader;
			$array['color-settings']['options']['content'] = $property_content;
			$array['color-settings']['options']['footer'] = $property_footer;
			$array['color-settings']['options']['headings'] = $property_headings;
			
			return $array;
		}
	}