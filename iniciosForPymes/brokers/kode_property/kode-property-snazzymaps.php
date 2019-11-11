<?php
	
	
	add_filter('kodeproperty_pluginoption_panel', 'kodeproperty_register_property_snazzy');
	if( !function_exists('kodeproperty_register_property_snazzy') ){
		function kodeproperty_register_property_snazzy( $array ){	
			global $kodeproperty_plugin_option;
			//if empty
			if( empty($array['property-settings']['options']) ){
				return $array;
			}
			$property_head =  array(
				'title' => esc_html__('Property Options', 'kode-property-list'),				
				'icon' => 'fa fa-home',
			);
			
			$property_options_snazzy =  array(
				'title' => esc_html__('Google Map Styler', 'kode-property-list'),
				'options' => array(
					'map_icon' => array(
						'title' => __('Market Icon Default' , 'kode-property-list'),
						'button' => __('Upload', 'kode-property-list'),
						'type' => 'upload',
						'description' => 'Click here to Upload the market icon default.',
					),
					'map_zoom' => array(
						'title' => __('Market Zoom Default' , 'kode-property-list'),
						'type' => 'text',
						'description' => 'Higher number will be more zoomed in.',
						'default' => '8'
					),
					'kode-map-style' => array(
						'title' => esc_attr__('Select Map Style', 'kode-property-list'),
						'type' => 'radioheader',	
						'wrapper-class' => 'google-snazzy-maps',
						'description'=>esc_attr__('There are 3 Different Header Styles Available here. Click on the Drop Down menu and select the Header Style here from of your choice.', 'kode-property-list'),
						'options' => array(
							'unsaturated-browns'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/70-unsaturated-browns/70-unsaturated-browns.png',
							'apple-maps-esque'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/apple-maps-esque/42-apple-maps-esque.png',
							'avocado-world'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/avocado-world/35-avocado-world.png',
							'bentley'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/bentley/43-bentley.png',
							'blue-gray'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/blue-gray/60-blue-gray.png',
							'blue-water'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/blue-water/25-blue-water.png',
							'bluish'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/bluish/28-bluish.png',
							'bright-bubbly'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/bright-&-bubbly/17-bright-and-bubbly.png',
							'clean-cut'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/clean-cut/77-clean-cut.png',
							'cma'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/cma/68757-cma.png',
							'cobalt'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/cobalt/30-cobalt.png',
							'even-lighter'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/even-lighter/8381-even-lighter.png',
							'flat-green'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/flat-green/36-flat-green.png',
							'flat-map-with-labels'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/flat-map-with-labels/122-flat-map-with-labels.png',
							'friedmann'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/friedmann/68739-friedmann.png',
							'gowalla'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/gowalla/20-gowalla.png',
							'grass-is-greener-water-is-bluer'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/grass-is-greener.-water-is-bluer/82-grass-is-greener-water-is-bluer.png',
							'hopper'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/hopper/21-hopper.png',
							'icy-blue'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/icy-blue/7-icy-blue.png',
							'just-places'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/just-places/65-just-places.png',
							'light-gray'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/light-gray/132-light-gray.png',
							'light-green'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/light-green/59-light-green.png',
							'light-monochrome'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/light-monochrome/29-light-monochrome.png',
							'lunar-landscape'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/lunar-landscape/37-lunar-landscape.png',
							'midnight-commander'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/midnight-commander/2-midnight-commander.png',
							'mostly-grayscale'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/mostly-grayscale/4183-mostly-grayscale.png',
							'muted-blue'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/muted-blue/83-muted-blue.png',
							'muted-monotone'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/muted-monotone/91-muted-monotone.png',
							'nature'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/nature/47-nature.png',
							'novalie'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/novalie/68738-novalie.png',
							'pastel-tones'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/pastel-tones/84-pastel-tones.png',
							'purple-rain'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/purple-rain/98-purple-rain.png',
							'red-alert'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/red-alert/3-red-alert.png',
							'red-hues'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/red-hues/31-red-hues.png',
							'routexl'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/routexl/54-routexl.png',
							'rpn-map-style'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/rpn-map-style/63695-rpn-map-style.png',
							'shade-of-green'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/shade-of-green/75-shade-of-green.png',
							'shades-of-grey'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/shades-of-grey/38-shades-of-grey.png',
							'shift-worker'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/shift-worker/27-shift-worker.png',
							'shree'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/shree/68754-shree.png',
							'simple-light'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/simple-&-light/229-simple-and-light.png',
							'simple-labels'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/simple-labels/58-simple-labels.png',
							'snazzy-maps'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/snazzy-maps/12-snazzy-maps.png',
							'souldisco'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/souldisco/52-souldisco.png',
							'subtle-grayscale'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/subtle-grayscale/15-subtle-grayscale.png',
							'taste206'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/taste206/133-taste206.png',
							'the-propia-effect'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/the-propia-effect/111-the-propia-effect.png',
							'turquoise-water'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/turquoise-water/8-turquoise-water.png',
							'ultra-light-with-labels'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/ultra-light-with-labels/151-ultra-light-with-labels.png',
							'vitamin-c'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/vitamin-c/40-vitamin-c.png',
							'esperanto'=>KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/snazzymaps/esperanto/56-esperanto.png',
						),
					),
					
				)
			);	
			
			$array['property-settings']['options']['property-snazzy'] = $property_options_snazzy;
			
			
			return $array;
		}
	}
	
	
	
	if( !function_exists('kodeproperty_get_property_marker_style') ){
		function kodeproperty_get_property_marker_style( $styler_id='' ){
			global $kodeproperty_plugin_option;
			if(isset($styler_id) && $styler_id <> ''){
				$kodeproperty_plugin_option['kode-map-style'] = $styler_id;
			}
			$styler_html = '';
			if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'unsaturated-browns'){
				$styler_html = '
				[
					{
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#ff4400"
							},
							{
								"saturation": -68
							},
							{
								"lightness": -4
							},
							{
								"gamma": 0.72
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.icon"
					},
					{
						"featureType": "landscape.man_made",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#0077ff"
							},
							{
								"gamma": 3.1
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"hue": "#00ccff"
							},
							{
								"gamma": 0.44
							},
							{
								"saturation": -33
							}
						]
					},
					{
						"featureType": "poi.park",
						"stylers": [
							{
								"hue": "#44ff00"
							},
							{
								"saturation": -23
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"hue": "#007fff"
							},
							{
								"gamma": 0.77
							},
							{
								"saturation": 65
							},
							{
								"lightness": 99
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"gamma": 0.11
							},
							{
								"weight": 5.6
							},
							{
								"saturation": 99
							},
							{
								"hue": "#0091ff"
							},
							{
								"lightness": -86
							}
						]
					},
					{
						"featureType": "transit.line",
						"elementType": "geometry",
						"stylers": [
							{
								"lightness": -48
							},
							{
								"hue": "#ff5e00"
							},
							{
								"gamma": 1.2
							},
							{
								"saturation": -23
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"saturation": -64
							},
							{
								"hue": "#ff9100"
							},
							{
								"lightness": 16
							},
							{
								"gamma": 0.47
							},
							{
								"weight": 2.7
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'apple-maps-esque'){
				$styler_html ='
				[
					{
						"featureType": "landscape.man_made",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f7f1df"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#d0e3b4"
							}
						]
					},
					{
						"featureType": "landscape.natural.terrain",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.business",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.medical",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#fbd3da"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#bde6ab"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffe15f"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#efd151"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "black"
							}
						]
					},
					{
						"featureType": "transit.station.airport",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#cfb2db"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#a2daf2"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'avocado-world'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#aee2e0"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#abce83"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#769E72"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#7B8758"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#EBF4A4"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#8dab68"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#5B5B3F"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#ABCE83"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#A4C67D"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#9BBF72"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#EBF4A4"
							}
						]
					},
					{
						"featureType": "transit",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#87ae79"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#7f2200"
							},
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"visibility": "on"
							},
							{
								"weight": 4.1
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#495421"
							}
						]
					},
					{
						"featureType": "administrative.neighborhood",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'bentley'){
				$styler_html = '
				[
					{
						"featureType": "landscape",
						"stylers": [
							{
								"hue": "#F1FF00"
							},
							{
								"saturation": -27.4
							},
							{
								"lightness": 9.4
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.highway",
						"stylers": [
							{
								"hue": "#0099FF"
							},
							{
								"saturation": -20
							},
							{
								"lightness": 36.4
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.arterial",
						"stylers": [
							{
								"hue": "#00FF4F"
							},
							{
								"saturation": 0
							},
							{
								"lightness": 0
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"hue": "#FFB300"
							},
							{
								"saturation": -38
							},
							{
								"lightness": 11.2
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"hue": "#00B6FF"
							},
							{
								"saturation": 4.2
							},
							{
								"lightness": -63.4
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"hue": "#9FFF00"
							},
							{
								"saturation": 0
							},
							{
								"lightness": 0
							},
							{
								"gamma": 1
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'blue-gray'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#b5cbe4"
							}
						]
					},
					{
						"featureType": "landscape",
						"stylers": [
							{
								"color": "#efefef"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#83a5b0"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#bdcdd3"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#e3eed3"
							}
						]
					},
					{
						"featureType": "administrative",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": 33
							}
						]
					},
					{
						"featureType": "road"
					},
					{
						"featureType": "poi.park",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": 20
							}
						]
					},
					{},
					{
						"featureType": "road",
						"stylers": [
							{
								"lightness": 20
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'blue-water'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#444444"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f2f2f2"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 45
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#46bcec"
							},
							{
								"visibility": "on"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'bluish'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"hue": "#007fff"
							},
							{
								"saturation": 89
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "administrative.country",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'bright-bubbly'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"stylers": [
							{
								"color": "#19a0d8"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"weight": 6
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#e85113"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#efe9e4"
							},
							{
								"lightness": -40
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#efe9e4"
							},
							{
								"lightness": -20
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"lightness": 100
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"lightness": -100
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.icon"
					},
					{
						"featureType": "landscape",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "landscape",
						"stylers": [
							{
								"lightness": 20
							},
							{
								"color": "#efe9e4"
							}
						]
					},
					{
						"featureType": "landscape.man_made",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"lightness": 100
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"lightness": -100
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"hue": "#11ff00"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"lightness": 100
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.icon",
						"stylers": [
							{
								"hue": "#4cff00"
							},
							{
								"saturation": 58
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#f0e4d3"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#efe9e4"
							},
							{
								"lightness": -25
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#efe9e4"
							},
							{
								"lightness": -10
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'clean-cut'){
				$styler_html = '
				[
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"lightness": 100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#C6E2FF"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#C5E3BF"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#D1D1B8"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'cma'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#444444"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f2f2f2"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 45
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#cbcbcb"
							},
							{
								"visibility": "on"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'cobalt'){
				$styler_html = '
				[
					{
						"featureType": "all",
						"elementType": "all",
						"stylers": [
							{
								"invert_lightness": true
							},
							{
								"saturation": 10
							},
							{
								"lightness": 30
							},
							{
								"gamma": 0.5
							},
							{
								"hue": "#435158"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'even-lighter'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#6195a0"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f2f2f2"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#e6f3d6"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 45
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#f4d2c5"
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.text",
						"stylers": [
							{
								"color": "#4e4e4e"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#f4f4f4"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#787878"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#eaf6f8"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#eaf6f8"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'flat-green'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"hue": "#bbff00"
							},
							{
								"weight": 0.5
							},
							{
								"gamma": 0.5
							}
						]
					},
					{
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"stylers": [
							{
								"color": "#a4cc48"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"visibility": "on"
							},
							{
								"weight": 1
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"gamma": 1.14
							},
							{
								"saturation": -18
							}
						]
					},
					{
						"featureType": "road.highway.controlled_access",
						"elementType": "labels",
						"stylers": [
							{
								"saturation": 30
							},
							{
								"gamma": 0.76
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"weight": 0.4
							},
							{
								"lightness": -8
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"color": "#4aaecc"
							}
						]
					},
					{
						"featureType": "landscape.man_made",
						"stylers": [
							{
								"color": "#718e32"
							}
						]
					},
					{
						"featureType": "poi.business",
						"stylers": [
							{
								"saturation": 68
							},
							{
								"lightness": -61
							}
						]
					},
					{
						"featureType": "administrative.locality",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"weight": 2.7
							},
							{
								"color": "#f4f9e8"
							}
						]
					},
					{
						"featureType": "road.highway.controlled_access",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"weight": 1.5
							},
							{
								"color": "#e53013"
							},
							{
								"saturation": -42
							},
							{
								"lightness": 28
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'flat-map-with-labels'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#7fc8ed"
							},
							{
								"saturation": 55
							},
							{
								"lightness": -6
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels",
						"stylers": [
							{
								"hue": "#7fc8ed"
							},
							{
								"saturation": 55
							},
							{
								"lightness": -6
							},
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#83cead"
							},
							{
								"saturation": 1
							},
							{
								"lightness": -15
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#f3f4f4"
							},
							{
								"saturation": -84
							},
							{
								"lightness": 59
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "labels",
						"stylers": [
							{
								"hue": "#ffffff"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 100
							},
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#ffffff"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 100
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"hue": "#bbbbbb"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 26
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#ffcc00"
							},
							{
								"saturation": 100
							},
							{
								"lightness": -35
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#ffcc00"
							},
							{
								"saturation": 100
							},
							{
								"lightness": -22
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.school",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#d7e4e4"
							},
							{
								"saturation": -60
							},
							{
								"lightness": 23
							},
							{
								"visibility": "on"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'friedmann'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#444444"
							}
						]
					},
					{
						"featureType": "administrative.country",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"saturation": "-5"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f2f2f2"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 45
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#e8e8e8"
							},
							{
								"visibility": "on"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'gowalla'){
				$styler_html = '
				[
    {
        "featureType": "administrative.land_parcel",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "simplified"
            },
            {
                "lightness": 20
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#f49935"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#fad959"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#a1cdfc"
            },
            {
                "saturation": 30
            },
            {
                "lightness": 49
            }
        ]
    }
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'grass-is-greener-water-is-bluer'){
				$styler_html = '
				[
    {
        "stylers": [
            {
                "saturation": -100
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#0099dd"
            }
        ]
    },
    {
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#aadd55"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {}
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'hopper'){
				$styler_html = '
				[
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#165c64"
            },
            {
                "saturation": 34
            },
            {
                "lightness": -69
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#b7caaa"
            },
            {
                "saturation": -14
            },
            {
                "lightness": -18
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#cbdac1"
            },
            {
                "saturation": -6
            },
            {
                "lightness": -9
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#8d9b83"
            },
            {
                "saturation": -89
            },
            {
                "lightness": -12
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#d4dad0"
            },
            {
                "saturation": -88
            },
            {
                "lightness": 54
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#bdc5b6"
            },
            {
                "saturation": -89
            },
            {
                "lightness": -3
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#bdc5b6"
            },
            {
                "saturation": -89
            },
            {
                "lightness": -26
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#c17118"
            },
            {
                "saturation": 61
            },
            {
                "lightness": -45
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#8ba975"
            },
            {
                "saturation": -46
            },
            {
                "lightness": -28
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#a43218"
            },
            {
                "saturation": 74
            },
            {
                "lightness": -51
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#ffffff"
            },
            {
                "saturation": 0
            },
            {
                "lightness": 100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#ffffff"
            },
            {
                "saturation": 0
            },
            {
                "lightness": 100
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels",
        "stylers": [
            {
                "hue": "#ffffff"
            },
            {
                "saturation": 0
            },
            {
                "lightness": 100
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#ffffff"
            },
            {
                "saturation": 0
            },
            {
                "lightness": 100
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#3a3935"
            },
            {
                "saturation": 5
            },
            {
                "lightness": -57
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.medical",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#cba923"
            },
            {
                "saturation": 50
            },
            {
                "lightness": -46
            },
            {
                "visibility": "on"
            }
        ]
    }
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'icy-blue'){
				$styler_html = '
				[
    {
        "stylers": [
            {
                "hue": "#2c3e50"
            },
            {
                "saturation": 250
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 50
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'just-places'){
				$styler_html = '
				[
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#fffffa"
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "lightness": 50
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 40
            }
        ]
    }
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'light-gray'){
				$styler_html = '
				[
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#d3d3d3"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "color": "#808080"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#b3b3b3"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "weight": 1.8
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#d7d7d7"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ebebeb"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#a7a7a7"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#efefef"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#696969"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#737373"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#d6d6d6"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {},
    {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#dadada"
            }
        ]
    }
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'light-green'){
				$styler_html = '
				[
    {
        "stylers": [
            {
                "hue": "#baf4c4"
            },
            {
                "saturation": 10
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "color": "#effefd"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'light-monochrome'){
				$styler_html = '
				[
					{
						"featureType": "administrative.locality",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#2c2e33"
							},
							{
								"saturation": 7
							},
							{
								"lightness": 19
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#ffffff"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#ffffff"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 100
							},
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#bbc0c4"
							},
							{
								"saturation": -93
							},
							{
								"lightness": 31
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"hue": "#bbc0c4"
							},
							{
								"saturation": -93
							},
							{
								"lightness": 31
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels",
						"stylers": [
							{
								"hue": "#bbc0c4"
							},
							{
								"saturation": -93
							},
							{
								"lightness": -2
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#e9ebed"
							},
							{
								"saturation": -90
							},
							{
								"lightness": -8
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#e9ebed"
							},
							{
								"saturation": 10
							},
							{
								"lightness": 69
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#e9ebed"
							},
							{
								"saturation": -78
							},
							{
								"lightness": 67
							},
							{
								"visibility": "simplified"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'lunar-landscape'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"hue": "#ff1a00"
							},
							{
								"invert_lightness": true
							},
							{
								"saturation": -100
							},
							{
								"lightness": 33
							},
							{
								"gamma": 0.5
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#2D333C"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'midnight-commander'){
				$styler_html = '
				[
					{
						"featureType": "all",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "all",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 13
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#000000"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#144b53"
							},
							{
								"lightness": 14
							},
							{
								"weight": 1.4
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#08304b"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#0c4152"
							},
							{
								"lightness": 5
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#000000"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#0b434f"
							},
							{
								"lightness": 25
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#000000"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#0b3d51"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"color": "#146474"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#021019"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'mostly-grayscale'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": 33
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels",
						"stylers": [
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text",
						"stylers": [
							{
								"gamma": "0.75"
							}
						]
					},
					{
						"featureType": "administrative.neighborhood",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"lightness": "-37"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f9f9f9"
							}
						]
					},
					{
						"featureType": "landscape.man_made",
						"elementType": "geometry",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "40"
							},
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "-37"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "100"
							},
							{
								"weight": "2"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "labels.icon",
						"stylers": [
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "80"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "0"
							}
						]
					},
					{
						"featureType": "poi.attraction",
						"elementType": "geometry",
						"stylers": [
							{
								"lightness": "-4"
							},
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#c5dac6"
							},
							{
								"visibility": "on"
							},
							{
								"saturation": "-95"
							},
							{
								"lightness": "62"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"gamma": "1.00"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.text",
						"stylers": [
							{
								"gamma": "0.50"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.icon",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"gamma": "0.50"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#c5c6c6"
							},
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"lightness": "-13"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.icon",
						"stylers": [
							{
								"lightness": "0"
							},
							{
								"gamma": "1.09"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#e4d7c6"
							},
							{
								"saturation": "-100"
							},
							{
								"lightness": "47"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"lightness": "-12"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#fbfaf7"
							},
							{
								"lightness": "77"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"lightness": "-5"
							},
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "-15"
							}
						]
					},
					{
						"featureType": "transit.station.airport",
						"elementType": "geometry",
						"stylers": [
							{
								"lightness": "47"
							},
							{
								"saturation": "-100"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#acbcc9"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"saturation": "53"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"lightness": "-42"
							},
							{
								"saturation": "17"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"lightness": "61"
							}
						]
					}
				]
				';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'muted-blue'){
				$styler_html = '
				[
					{
						"featureType": "all",
						"stylers": [
							{
								"saturation": 0
							},
							{
								"hue": "#e7ecf0"
							}
						]
					},
					{
						"featureType": "road",
						"stylers": [
							{
								"saturation": -70
							}
						]
					},
					{
						"featureType": "transit",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"saturation": -60
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'muted-monotone'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"saturation": -100
							},
							{
								"gamma": 0.54
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"color": "#4d4946"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels.text",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "labels.text",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "transit.line",
						"elementType": "geometry",
						"stylers": [
							{
								"gamma": 0.48
							}
						]
					},
					{
						"featureType": "transit.station",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"gamma": 7.18
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'nature'){
				$styler_html = '
				[
					{
						"featureType": "landscape",
						"stylers": [
							{
								"hue": "#FFA800"
							},
							{
								"saturation": 0
							},
							{
								"lightness": 0
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.highway",
						"stylers": [
							{
								"hue": "#53FF00"
							},
							{
								"saturation": -73
							},
							{
								"lightness": 40
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.arterial",
						"stylers": [
							{
								"hue": "#FBFF00"
							},
							{
								"saturation": 0
							},
							{
								"lightness": 0
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"hue": "#00FFFD"
							},
							{
								"saturation": 0
							},
							{
								"lightness": 30
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"hue": "#00BFFF"
							},
							{
								"saturation": 6
							},
							{
								"lightness": 8
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"hue": "#679714"
							},
							{
								"saturation": 33.4
							},
							{
								"lightness": -25.4
							},
							{
								"gamma": 1
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'novalie'){
				$styler_html = '
				[
					{
						"featureType": "all",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"saturation": 36
							},
							{
								"color": "#000000"
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"featureType": "all",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#000000"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "all",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#a9cd49"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#000000"
							},
							{
								"weight": "1.06"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#000000"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 18
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 19
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#202020"
							},
							{
								"lightness": 17
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'pastel-tones'){
				$styler_html = '
				[
					{
						"featureType": "landscape",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 60
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 40
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "transit",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "administrative.province",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": 30
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ef8c25"
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#b6c54c"
							},
							{
								"lightness": 40
							},
							{
								"saturation": -40
							}
						]
					},
					{}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'purple-rain'){
				$styler_html = '
				[
					{
						"featureType": "road",
						"stylers": [
							{
								"hue": "#5e00ff"
							},
							{
								"saturation": -79
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"saturation": -78
							},
							{
								"hue": "#6600ff"
							},
							{
								"lightness": -47
							},
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"lightness": 22
							}
						]
					},
					{
						"featureType": "landscape",
						"stylers": [
							{
								"hue": "#6600ff"
							},
							{
								"saturation": -11
							}
						]
					},
					{},
					{},
					{
						"featureType": "water",
						"stylers": [
							{
								"saturation": -65
							},
							{
								"hue": "#1900ff"
							},
							{
								"lightness": 8
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"weight": 1.3
							},
							{
								"lightness": 30
							}
						]
					},
					{
						"featureType": "transit",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"hue": "#5e00ff"
							},
							{
								"saturation": -16
							}
						]
					},
					{
						"featureType": "transit.line",
						"stylers": [
							{
								"saturation": -72
							}
						]
					},
					{}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'red-alert'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffdfa6"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#b52127"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#c5531b"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#74001b"
							},
							{
								"lightness": -10
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#da3c3c"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#74001b"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#da3c3c"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#990c19"
							}
						]
					},
					{
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#74001b"
							},
							{
								"lightness": -8
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#6a0d10"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffdfa6"
							},
							{
								"weight": 0.4
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'red-hues'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"hue": "#dd0d0d"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"lightness": 100
							},
							{
								"visibility": "simplified"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'routexl'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"saturation": -10
							},
							{
								"lightness": 30
							}
						]
					},
					{
						"featureType": "landscape.man_made",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"saturation": -60
							},
							{
								"lightness": 10
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"saturation": -60
							},
							{
								"lightness": 60
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 60
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 60
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'rpn-map-style'){
				$styler_html = '
				[
					{
						"featureType": "administrative.country",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#1c99ed"
							}
						]
					},
					{
						"featureType": "administrative.country",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#1f79b5"
							}
						]
					},
					{
						"featureType": "administrative.province",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#6d6d6d"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "administrative.locality",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#555555"
							}
						]
					},
					{
						"featureType": "administrative.neighborhood",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#999999"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"color": "#f2f2f2"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "landscape.natural.landcover",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.attraction",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.business",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.government",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.medical",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#e1eddd"
							}
						]
					},
					{
						"featureType": "poi.place_of_worship",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.school",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.sports_complex",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "all",
						"stylers": [
							{
								"saturation": "-100"
							},
							{
								"lightness": "45"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ff9500"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"hue": "#009aff"
							},
							{
								"saturation": "100"
							},
							{
								"lightness": "5"
							}
						]
					},
					{
						"featureType": "road.highway.controlled_access",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.highway.controlled_access",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ff9500"
							}
						]
					},
					{
						"featureType": "road.highway.controlled_access",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road.highway.controlled_access",
						"elementType": "labels.icon",
						"stylers": [
							{
								"lightness": "1"
							},
							{
								"saturation": "100"
							},
							{
								"hue": "#009aff"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#8a8a8a"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit.station.airport",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "transit.station.airport",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"lightness": "33"
							},
							{
								"saturation": "-100"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "transit.station.bus",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "transit.station.rail",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"color": "#46bcec"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#4db4f8"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'shade-of-green'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#76aee3"
							},
							{
								"saturation": 38
							},
							{
								"lightness": -11
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#8dc749"
							},
							{
								"saturation": -47
							},
							{
								"lightness": -17
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#c6e3a4"
							},
							{
								"saturation": 17
							},
							{
								"lightness": -2
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#cccccc"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 13
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "administrative.land_parcel",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#5f5855"
							},
							{
								"saturation": 6
							},
							{
								"lightness": -31
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#ffffff"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": []
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'shades-of-grey'){
				$styler_html = '
				[
					{
						"featureType": "all",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"saturation": 36
							},
							{
								"color": "#000000"
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"featureType": "all",
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#000000"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "all",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 17
							},
							{
								"weight": 1.2
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 29
							},
							{
								"weight": 0.2
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 18
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 19
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#000000"
							},
							{
								"lightness": 17
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'shift-worker'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"saturation": -100
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.business",
						"elementType": "labels.text",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.business",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.place_of_worship",
						"elementType": "labels.text",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi.place_of_worship",
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"saturation": 50
							},
							{
								"gamma": 0
							},
							{
								"hue": "#50a5d1"
							}
						]
					},
					{
						"featureType": "administrative.neighborhood",
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#333333"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "labels.text",
						"stylers": [
							{
								"weight": 0.5
							},
							{
								"color": "#333333"
							}
						]
					},
					{
						"featureType": "transit.station",
						"elementType": "labels.icon",
						"stylers": [
							{
								"gamma": 1
							},
							{
								"saturation": 50
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'shree'){
				$styler_html = '
				[
					{
						"featureType": "landscape",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#FFBB00"
							},
							{
								"saturation": 43.400000000000006
							},
							{
								"lightness": 37.599999999999994
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#00FF6A"
							},
							{
								"saturation": -1.0989010989011234
							},
							{
								"lightness": 11.200000000000017
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#FFC200"
							},
							{
								"saturation": -61.8
							},
							{
								"lightness": 45.599999999999994
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#FF0300"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 51.19999999999999
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#FF0300"
							},
							{
								"saturation": -100
							},
							{
								"lightness": 52
							},
							{
								"gamma": 1
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "all",
						"stylers": [
							{
								"hue": "#0078FF"
							},
							{
								"saturation": -13.200000000000003
							},
							{
								"lightness": 2.4000000000000057
							},
							{
								"gamma": 1
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'simple-light'){
				$styler_html = '
				[
					{
						"featureType": "administrative",
						"elementType": "all",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#fcfcfc"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#fcfcfc"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#dddddd"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#dddddd"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#eeeeee"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#dddddd"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'simple-labels'){
				$styler_html = '
				[
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "labels.text",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'snazzy-maps'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#333739"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#2ecc71"
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"color": "#2ecc71"
							},
							{
								"lightness": -7
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#2ecc71"
							},
							{
								"lightness": -28
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#2ecc71"
							},
							{
								"visibility": "on"
							},
							{
								"lightness": -15
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#2ecc71"
							},
							{
								"lightness": -18
							}
						]
					},
					{
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#2ecc71"
							},
							{
								"lightness": -34
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#333739"
							},
							{
								"weight": 0.8
							}
						]
					},
					{
						"featureType": "poi.park",
						"stylers": [
							{
								"color": "#2ecc71"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#333739"
							},
							{
								"weight": 0.3
							},
							{
								"lightness": 10
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'souldisco'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"saturation": -100
							},
							{
								"gamma": 0.8
							},
							{
								"lightness": 4
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "landscape.natural",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#5dff00"
							},
							{
								"gamma": 4.97
							},
							{
								"lightness": -5
							},
							{
								"saturation": 100
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'subtle-grayscale'){
				$styler_html = '
				[
					{
						"featureType": "landscape",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 65
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 51
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.highway",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 30
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.local",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"lightness": 40
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "transit",
						"stylers": [
							{
								"saturation": -100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "administrative.province",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"lightness": -25
							},
							{
								"saturation": -100
							}
						]
					},
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"hue": "#ffff00"
							},
							{
								"lightness": -25
							},
							{
								"saturation": -97
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'taste206'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#a0d6d1"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#dedede"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#dedede"
							},
							{
								"lightness": 29
							},
							{
								"weight": 0.2
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#dedede"
							},
							{
								"lightness": 18
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f1f1f1"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#ffffff"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"saturation": 36
							},
							{
								"color": "#333333"
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f2f2f2"
							},
							{
								"lightness": 19
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#fefefe"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#fefefe"
							},
							{
								"lightness": 17
							},
							{
								"weight": 1.2
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'the-propia-effect'){
				$styler_html = '
				[
					{
						"featureType": "landscape",
						"stylers": [
							{
								"visibility": "simplified"
							},
							{
								"color": "#2b3f57"
							},
							{
								"weight": 0.1
							}
						]
					},
					{
						"featureType": "administrative",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"hue": "#ff0000"
							},
							{
								"weight": 0.4
							},
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "labels.text",
						"stylers": [
							{
								"weight": 1.3
							},
							{
								"color": "#FFFFFF"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f55f77"
							},
							{
								"weight": 3
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f55f77"
							},
							{
								"weight": 1.1
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f55f77"
							},
							{
								"weight": 0.4
							}
						]
					},
					{},
					{
						"featureType": "road.highway",
						"elementType": "labels",
						"stylers": [
							{
								"weight": 0.8
							},
							{
								"color": "#ffffff"
							},
							{
								"visibility": "on"
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "labels",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"weight": 0.7
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "poi",
						"stylers": [
							{
								"color": "#6c5b7b"
							}
						]
					},
					{
						"featureType": "water",
						"stylers": [
							{
								"color": "#f3b191"
							}
						]
					},
					{
						"featureType": "transit.line",
						"stylers": [
							{
								"visibility": "on"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'turquoise-water'){
				$styler_html = '
				[
					{
						"stylers": [
							{
								"hue": "#16a085"
							},
							{
								"saturation": 0
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{
								"lightness": 100
							},
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'ultra-light-with-labels'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#e9e9e9"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f5f5f5"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 17
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 29
							},
							{
								"weight": 0.2
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 18
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f5f5f5"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#dedede"
							},
							{
								"lightness": 21
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#ffffff"
							},
							{
								"lightness": 16
							}
						]
					},
					{
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"saturation": 36
							},
							{
								"color": "#333333"
							},
							{
								"lightness": 40
							}
						]
					},
					{
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#f2f2f2"
							},
							{
								"lightness": 19
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.fill",
						"stylers": [
							{
								"color": "#fefefe"
							},
							{
								"lightness": 20
							}
						]
					},
					{
						"featureType": "administrative",
						"elementType": "geometry.stroke",
						"stylers": [
							{
								"color": "#fefefe"
							},
							{
								"lightness": 17
							},
							{
								"weight": 1.2
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'vitamin-c'){
				$styler_html = '
				[
					{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#004358"
							}
						]
					},
					{
						"featureType": "landscape",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#1f8a70"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#1f8a70"
							}
						]
					},
					{
						"featureType": "road.highway",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#fd7400"
							}
						]
					},
					{
						"featureType": "road.arterial",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#1f8a70"
							},
							{
								"lightness": -20
							}
						]
					},
					{
						"featureType": "road.local",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#1f8a70"
							},
							{
								"lightness": -17
							}
						]
					},
					{
						"elementType": "labels.text.stroke",
						"stylers": [
							{
								"color": "#ffffff"
							},
							{
								"visibility": "on"
							},
							{
								"weight": 0.9
							}
						]
					},
					{
						"elementType": "labels.text.fill",
						"stylers": [
							{
								"visibility": "on"
							},
							{
								"color": "#ffffff"
							}
						]
					},
					{
						"featureType": "poi",
						"elementType": "labels",
						"stylers": [
							{
								"visibility": "simplified"
							}
						]
					},
					{
						"elementType": "labels.icon",
						"stylers": [
							{
								"visibility": "off"
							}
						]
					},
					{
						"featureType": "transit",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#1f8a70"
							},
							{
								"lightness": -10
							}
						]
					},
					{},
					{
						"featureType": "administrative",
						"elementType": "geometry",
						"stylers": [
							{
								"color": "#1f8a70"
							},
							{
								"weight": 0.7
							}
						]
					}
				]';
			}else if(isset($kodeproperty_plugin_option['kode-map-style']) && $kodeproperty_plugin_option['kode-map-style'] == 'esperanto'){
			$styler_html = '
			[
				{
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"color": "#ffffff"
						}
					]
				},
				{
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#000000"
						}
					]
				},
				{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [
						{
							"color": "#0000ff"
						}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#ff0000"
						}
					]
				},
				{
					"featureType": "road.highway",
					"elementType": "geometry.stroke",
					"stylers": [
						{
							"color": "#000100"
						}
					]
				},
				{
					"featureType": "road.highway.controlled_access",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#ffff00"
						}
					]
				},
				{
					"featureType": "road.highway.controlled_access",
					"elementType": "geometry.stroke",
					"stylers": [
						{
							"color": "#ff0000"
						}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#ffa91a"
						}
					]
				},
				{
					"featureType": "road.arterial",
					"elementType": "geometry.stroke",
					"stylers": [
						{
							"color": "#000000"
						}
					]
				},
				{
					"featureType": "landscape.natural",
					"stylers": [
						{
							"saturation": 36
						},
						{
							"gamma": 0.55
						}
					]
				},
				{
					"featureType": "road.local",
					"elementType": "geometry.stroke",
					"stylers": [
						{
							"color": "#000000"
						}
					]
				},
				{
					"featureType": "road.local",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"color": "#ffffff"
						}
					]
				},
				{
					"featureType": "landscape.man_made",
					"elementType": "geometry.stroke",
					"stylers": [
						{
							"lightness": -100
						},
						{
							"weight": 2.1
						}
					]
				},
				{
					"featureType": "landscape.man_made",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"invert_lightness": true
						},
						{
							"hue": "#ff0000"
						},
						{
							"gamma": 3.02
						},
						{
							"lightness": 20
						},
						{
							"saturation": 40
						}
					]
				},
				{
					"featureType": "poi.attraction",
					"stylers": [
						{
							"saturation": 100
						},
						{
							"hue": "#ff00ee"
						},
						{
							"lightness": -13
						}
					]
				},
				{
					"featureType": "poi.government",
					"stylers": [
						{
							"saturation": 100
						},
						{
							"hue": "#eeff00"
						},
						{
							"gamma": 0.67
						},
						{
							"lightness": -26
						}
					]
				},
				{
					"featureType": "poi.medical",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"hue": "#ff0000"
						},
						{
							"saturation": 100
						},
						{
							"lightness": -37
						}
					]
				},
				{
					"featureType": "poi.medical",
					"elementType": "labels.text.fill",
					"stylers": [
						{
							"color": "#ff0000"
						}
					]
				},
				{
					"featureType": "poi.school",
					"stylers": [
						{
							"hue": "#ff7700"
						},
						{
							"saturation": 97
						},
						{
							"lightness": -41
						}
					]
				},
				{
					"featureType": "poi.sports_complex",
					"stylers": [
						{
							"saturation": 100
						},
						{
							"hue": "#00ffb3"
						},
						{
							"lightness": -71
						}
					]
				},
				{
					"featureType": "poi.park",
					"stylers": [
						{
							"saturation": 84
						},
						{
							"lightness": -57
						},
						{
							"hue": "#a1ff00"
						}
					]
				},
				{
					"featureType": "transit.station.airport",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"gamma": 0.11
						}
					]
				},
				{
					"featureType": "transit.station",
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"color": "#ffc35e"
						}
					]
				},
				{
					"featureType": "transit.line",
					"elementType": "geometry",
					"stylers": [
						{
							"lightness": -100
						}
					]
				},
				{
					"featureType": "administrative",
					"stylers": [
						{
							"saturation": 100
						},
						{
							"gamma": 0.35
						},
						{
							"lightness": 20
						}
					]
				},
				{
					"featureType": "poi.business",
					"elementType": "geometry.fill",
					"stylers": [
						{
							"saturation": -100
						},
						{
							"gamma": 0.35
						}
					]
				},
				{
					"featureType": "poi.business",
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"color": "#69ffff"
						}
					]
				},
				{
					"featureType": "poi.place_of_worship",
					"elementType": "labels.text.stroke",
					"stylers": [
						{
							"color": "#c3ffc3"
						}
					]
				}
			]';
			}else{
				
			}
			
			return $styler_html;
		}
	}	
	?>