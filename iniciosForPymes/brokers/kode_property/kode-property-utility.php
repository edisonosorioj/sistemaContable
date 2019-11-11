<?php
	/*	
	*	Kodeforest Functions Utility
	*	---------------------------------------------------------------------
	*	This file create Basic functions
	*	---------------------------------------------------------------------
	*	Settings - Options - Values
	*/	
	
	class kodeproperty_func_utility{
		
		
		public $kodeproperty_thumbnail_size = array(
			'kodeproperty-full-slider' => array('width'=>1600, 'height'=>900, 'crop'=>true),
			'kodeproperty-post-thumbnail-size' => array('width'=>385, 'height'=>545, 'crop'=>true),
			'kodeproperty-team-size' => array('width'=>350, 'height'=>350, 'crop'=>true),
			'kodeproperty-serv-size' => array('width'=>345, 'height'=>315, 'crop'=>true),
			'kodeproperty-small-serv-size' => array('width'=>260, 'height'=>325, 'crop'=>true),
			'kodeproperty-blog-size' => array('width'=>570, 'height'=>300, 'crop'=>true),
			'kodeproperty-property-modern' => array('width'=>370, 'height'=>225, 'crop'=>true),
			'kodeproperty-blog-post-size' => array('width'=>1170, 'height'=>350, 'crop'=>true),
		);
		
		
		
		
		function __construct(){
			
			
			
			add_action('init',array($this,'kodeproperty_get_term_list'));
			
			add_action('init',array($this,'kodeproperty_get_term_list_id'));
			
			add_action('init',array($this,'kodeproperty_get_term_list_detail'));
			add_action('init',array($this,'kodeproperty_get_term_list_emptyfirst'));
			
			add_filter( 'widget_text', array($this,'kodeproperty_enable_shortcode_filter' ));
			add_filter( 'the_content', array($this,'kodeproperty_enable_shortcode_filter' )); 
			
			add_filter( 'kodeproperty_text_filter', array($this,'kodeproperty_enable_shortcode_filter' )); 	
			add_filter( 'kodeproperty_the_content', array($this,'kodeproperty_enable_shortcode_filter' )); 	
			
			
			
			add_filter( 'body_class',array($this, 'kodeproperty_post_classes_plugin' ));
			
			
			// Create Sizes on the theme activation
			add_action( 'after_setup_theme', array($this,'kodeproperty_define_thumbnail_size'));
			
			add_filter('image_size_names_choose', array($this,'kodeproperty_define_custom_size_image'));
		}
		
			function kodeproperty_get_video($video, $size = 'full'){
				if( empty($video) ) return '';
				
				$video_size = kodeproperty_get_video_size($size);
				$width = $video_size['width']; 
				$height = $video_size['height']; 

				// video shortcode
				if(preg_match('#^\[video\s.+\[/video\]#', $video, $match)){ 
					return do_shortcode($match[0]);
					
				// embed shortcode
				}else if(preg_match('#^\[embed.+\[/embed\]#', $video, $match)){ 
					global $wp_embed; 
					return $wp_embed->run_shortcode($match[0]);
					
				// youtube link
				}else if(strpos($video, 'youtube') !== false){
					preg_match('#[?&]v=([^&]+)(&.+)?#', $video, $id);
					$id[2] = empty($id[2])? '': $id[2];
					return '<iframe src="http://www.youtube.com/embed/' . esc_attr($id[1]) . '?wmode=transparent' . esc_attr($id[2]) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" ></iframe>';
				
				// youtu.be link
				}else if(strpos($video, 'youtu.be') !== false){
					preg_match('#youtu.be\/([^?&]+)#', $video, $id);
					return '<iframe src="http://www.youtube.com/embed/' . esc_attr($id[1]) . '?wmode=transparent" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" ></iframe>';
				
				// vimeo link
				}else if(strpos($video, 'vimeo') !== false){
					preg_match('#https?:\/\/vimeo.com\/(\d+)#', $video, $id);
					return '<iframe src="http://player.vimeo.com/video/' . esc_attr($id[1]) . '?title=0&amp;byline=0&amp;portrait=0" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '"></iframe>';
				
				// another link
				}else if(preg_match('#^https?://\S+#', $video, $match)){ 	
					$path_parts = pathinfo($match[0]);
					if( !empty($path_parts['extension']) ){
						return do_shortcode('[video width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" src="' . esc_url($match[0]) . '" ][/video]');
					}else{
						global $wp_embed; 
						$video_embed = '[embed width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" ]' . esc_url($match[0]) . '[/embed]';
						return $wp_embed->run_shortcode($video_embed);
					}				
				}
				return '';
			}
		
			function kodeproperty_get_image($image, $size = 'full', $link = array(), $attr = ''){
				if( empty($image) ) return '';
			
				if( is_numeric($image) ){
					$alt_text = get_post_meta($image , '_wp_attachment_image_alt', true);	
					$image_src = wp_get_attachment_image_src($image, $size);	
					if( empty($image_src) ) return '';
					
					if( $link === true ){ 
						$image_full = wp_get_attachment_image_src($image, 'full');
						$link = array('url'=>esc_url($image_full[0]));
					}else if( !empty($link) && empty($link['url']) ){
						$image_full = wp_get_attachment_image_src($image, 'full');
						$link['url'] = esc_url($image_full[0]);				
					}
					$ret = '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_attr($alt_text) . '" width="' . esc_attr($image_src[1]) .'" height="' . esc_attr($image_src[2]) . '" ' . $attr . '/>';
				}else{
					if( $link === true ){ 
						$link = array('url'=>esc_url($image)); 
					}else if( !empty($link) && empty($link['url']) ){
						$link['url'] = esc_url($image);		
					}
					$ret = '<img src="' . esc_url($image) . '" alt="" ' . $attr . ' />';
				}
				
				if( !empty($link) ){
					$pretty_photo  = '<a href="' . esc_url($link['url']) . '" ';
					$pretty_photo .= (empty($link['id']))? '': 'data-pretty-group="kode-gal-' . $link['id'] . '" ';
					$pretty_photo .= (!empty($link['type']) && $link['type'] == 'link')? '': 'data-rel="prettyphoto[]" ';
					$pretty_photo .= (!empty($link['type']) && $link['type'] == 'video')? 'data-pretty-type="iframe" ': '';
					$pretty_photo .= (!empty($link['new-tab']) && $link['new-tab'] == 'enable')? 'target="_blank" ': '';
					$pretty_photo .= '>' . $ret;
					$pretty_photo .= (!empty($link['close-tag']))? '': '</a>';
					return $pretty_photo;
				}
				return $ret;
			}
		
			function kodeproperty_get_attachment_info($attachment_id, $type = '') {
				$attachment = get_post($attachment_id);
				if( !empty($attachment) ){
					$ret = array(
						'caption' => $attachment->post_excerpt,
						'description' => $attachment->post_content,
						'title' => $attachment->post_title
					);
					
					if( !empty($type) ) return $ret[$type];
					return $ret;
				}
				return array();
			}	
		
			function kodeproperty_get_slider_item( $settings ){
				$item_id = empty($settings['element-item-id'])? '': ' id="' . esc_attr($settings['element-item-id']) . '" ';
				$settings['slider-style'] = (empty($settings['slider-style']))? '5': $settings['slider-style'];
				global $kodeproperty_spaces;
				$margin = (!empty($settings['margin-bottom']) && 
					$settings['margin-bottom'] != $kodeproperty_spaces['bottom-item'])? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
				$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
				$settings['thumbnail-size'] = 'full';
				$ret  = '<div class="kode-item '.esc_attr($settings['slider-style']).' kode-slider-item" ' . $item_id . $margin_style . ' >';
				$ret .= kodeproperty_get_slider($settings['slider'], $settings['thumbnail-size'], $settings['slider-type']);
				$ret .= '</div>';
				return $ret;
			}
		
			function kodeproperty_get_post_slider_item( $settings ){
				$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

				global $kodeproperty_spaces;
				$margin = (!empty($settings['margin-bottom']) && 
					$settings['margin-bottom'] != $kodeproperty_spaces['bottom-item'])? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
				$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
				
				$slide_order = array();
				$slide_data = array();
				
				// query posts section
				$args = array('post_type' => 'post', 'suppress_filters' => false);
				$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
				$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
				$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
				$args['ignore_sticky_posts'] = 1;

				if( is_numeric($settings['category']) ){
					$args['category'] = (empty($settings['category']))? '': $settings['category'];	
				}else{ 
					if( !empty($settings['category']) || !empty($settings['tag']) ){
						$args['tax_query'] = array('relation' => 'OR');
						
						if( !empty($settings['category']) ){
							array_push($args['tax_query'], array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'category', 'field'=>'slug'));
						}
						if( !empty($settings['tag']) ){
							array_push($args['tax_query'], array('terms'=>explode(',', $settings['tag']), 'taxonomy'=>'post_tag', 'field'=>'slug'));
						}				
					}	
				}
				$query = new WP_Query( $args );	
				
				// set the excerpt length
				global $kodeproperty_theme_option, $kodeproperty_excerpt_length, $kodeproperty_excerpt_read_more; 
				$kodeproperty_excerpt_read_more = false;
				$kodeproperty_excerpt_length = $settings['num-excerpt'];
				add_filter('excerpt_length', 'kodeproperty_set_excerpt_length');

				global $post;
				while($query->have_posts()){ $query->the_post();
					$image_id = get_post_thumbnail_id();
					
					if( !empty($image_id) ){
						$slide_order[] = $image_id;
						$slide_data[$image_id] = array(	
							'title'=> esc_attr(get_the_title()),
							'slide-link'=> 'url',
							'url'=> esc_url(get_permalink()),
							'new-tab'=> 'disable',
							'caption-position'=>$settings['caption-style']
						);
						
						if( $settings['style'] == 'no-excerpt' ){
							$slide_data[$image_id]['caption']  = '<div class="kode-caption-date" >';
							$slide_data[$image_id]['caption'] .= '<i class="fa fa-calendar"></i>';
							$slide_data[$image_id]['caption'] .= esc_attr(get_the_time(get_option('date_format')));				
							$slide_data[$image_id]['caption'] .= '</div>';				
							
							$slide_data[$image_id]['caption'] .= '<div class="kode-title-link" >';
							$slide_data[$image_id]['caption'] .= '<i class="fa fa-angle-right" ></i>';
							$slide_data[$image_id]['caption'] .= '</div>';		
						}else{
							$slide_data[$image_id]['caption']  = '<div class="blog-info blog-date"><i class="fa fa-calendar"></i>';
							$slide_data[$image_id]['caption'] .= esc_attr(get_the_time(get_option('date_format')));		
							$slide_data[$image_id]['caption'] .= '</div>';
							$slide_data[$image_id]['caption'] .= '<div class="blog-info blog-comment"><i class="fa fa-comment"></i>';
							$slide_data[$image_id]['caption'] .= esc_attr(get_comments_number());
							$slide_data[$image_id]['caption'] .= '</div>';					
							$slide_data[$image_id]['caption'] .= '<div class="clear"></div>';					
							$slide_data[$image_id]['caption'] .= '<p>'.esc_attr(get_the_excerpt()).'</p>';
						}
					}
				}	
				
				$kodeproperty_excerpt_read_more = true;
				remove_filter('excerpt_length', 'kodeproperty_set_excerpt_length');
				
				if( $settings['style'] == 'no-excerpt' ){
					$settings['caption-style'] = 'no-excerpt';
				}
				
				$ret  = '<div class="kode-item kode-post-slider-item style-' . $settings['caption-style'] . '" ' . $item_id . $margin_style . ' >';
				$ret .= kodeproperty_get_slider(array($slide_order, $slide_data), $settings['thumbnail-size'], 'bxslider');
				$ret .= '</div>';
				return $ret;
			}
	
			function kodeproperty_get_slider( $slider_data, $thumbnail_size, $slider_type = 'flexslider' ){
				if( is_array($slider_data) ){
					$slide_order = $slider_data[0];
					$slide_data = $slider_data[1];
				}else{
					$slider_option = json_decode($slider_data, true);
					$slide_order = $slider_option[0];
					$slide_data = $slider_option[1];			
				}
				
				$slides = array();
				$slide_order = empty($slide_order)? array(): $slide_order;
				foreach($slide_order as $slide){
					$slides[$slide] = $slide_data[$slide];
				}
					
				if($slider_type == 'flexslider'){
					return kodeproperty_get_flex_slider($slides, array('size'=> $thumbnail_size));
				}else if($slider_type == 'nivoslider'){
					return kodeproperty_get_nivo_slider($slides, array('size'=> $thumbnail_size));
				}else if($slider_type == 'bxslider'){
					return kodeproperty_get_bx_slider($slides, array('size'=> $thumbnail_size));
				}else{
					return 'slider is not defined';
				}
				
			}
		
			function kodeproperty_get_flex_slider($slides, $settings = array()){
				global $kodeproperty_theme_option, $kodeproperty_gallery_id; $kodeproperty_gallery_id++;
				
				$ret  = '<div class="flexslider" ';
				$ret .= empty($settings['pausetime'])? 'data-pausetime="' . esc_attr($kodeproperty_theme_option['flex-pause-time']) . '" ': 
							'data-pausetime="' . esc_attr($settings['pausetime']) . '" ';
				$ret .= empty($settings['slidespeed'])? 'data-slidespeed="' . esc_attr($kodeproperty_theme_option['flex-slide-speed']) . '" ': 
							'data-slidespeed="' . esc_attr($settings['slidespeed']) . '" ';			
				$ret .= empty($settings['effect'])? 'data-effect="' . esc_attr($kodeproperty_theme_option['flex-slider-effects']) . '" ': 
							'data-effect="' . esc_attr($settings['effect']) . '" ';	
							
				$ret .= empty($settings['columns'])? '': 'data-columns="' . esc_attr($settings['columns']) . '" ';
				$ret .= empty($settings['carousel'])? '': 'data-type="carousel" ';
				$ret .= empty($settings['nav-container'])? '': 'data-nav-container="' . esc_attr($settings['nav-container']) . '" ';
				$ret .= '>';
				$ret .= '<ul class="slides" >';
				$title_font_size = '';
				if(isset($kodeproperty_theme_option['title-font-size'])){
					if($kodeproperty_theme_option['title-font-size'] == 0){
						$title_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['title-font-size']).'px';
					}
				}
				$caption_font_size = '';
				if(isset($kodeproperty_theme_option['caption-font-size'])){
					if($kodeproperty_theme_option['caption-font-size'] == 0){
						$caption_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['caption-font-size']).'px';
					}
				}
				$btn_bg_color_style = '';
				if(isset($kodeproperty_theme_option['caption-btn-color-switch']) && $kodeproperty_theme_option['caption-btn-color-switch'] == 'enable'){
					$btn_bg_color_style = 'style="color:'.esc_attr($kodeproperty_theme_option['caption-btn-color']).';background:'.esc_attr($kodeproperty_theme_option['caption-btn-color-bg']).'"';
				}
				
				$slides = empty($slides)? array(): $slides;
				foreach($slides as $slide_id => $slide){
					$ret .= '<li>';
					
					if( is_array($slide) ){

						// flex slider caption
						$caption = '';
						if( !empty($slide['title']) || !empty($slide['caption']) ){
							$slide['caption-position'] = empty($slide['caption-position'])? 'left': esc_attr($slide['caption-position']);
						
							$caption .= '<div class="kode-caption-wrapper position-' . esc_attr($slide['caption-position']) . '">';
							$caption .= '<div class="kode-caption-inner" >';
							$caption .= '<div class="kode-caption">';
							$caption .= empty($slide['title'])? '': '<div style="'.$title_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-title-color']).'" class="kode-caption-title">' . wp_kses($slide['title'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['caption'])? '': '<div style="'.$caption_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-desc-color']).'" class="kode-caption-text">' . wp_kses($slide['caption'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['button_txt'])? '': '<div '.$btn_bg_color_style.' class="kode_btn_store_1">' . esc_attr($slide['button_txt']) . ' <i class="fa fa-angle-right"></i></div>';
							$caption .= '</div>'; // kode-slider-caption
							$caption .= '</div>'; // kode-slider-caption-wrapper
							$caption .= '</div>';
						}				
					
						// flex slider link
						if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size'])) . $caption;
						}else if( $slide['slide-link'] == 'url' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab']), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'current' ){	
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'image' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'video' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}
					}else{
						$ret .= kodeproperty_get_image(esc_attr($slide), esc_attr($settings['size']), array('id'=>esc_attr($kodeproperty_gallery_id)));
					}
					$ret .= '</li>';
				}
				$ret .= '</ul>';
				$ret .= '</div>';
				
				return $ret;
			}
		
			
		
			function kodeproperty_get_wp_post_slider($settings = array()){
				global $kodeproperty_theme_option, $kodeproperty_gallery_id; $kodeproperty_gallery_id++;
				
				
				$ret .= '<ul class="slides" >';
				$title_font_size = '';
				if(isset($kodeproperty_theme_option['title-font-size'])){
					if($kodeproperty_theme_option['title-font-size'] == 0){
						$title_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['title-font-size']).'px';
					}
				}
				$caption_font_size = '';
				if(isset($kodeproperty_theme_option['caption-font-size'])){
					if($kodeproperty_theme_option['caption-font-size'] == 0){
						$caption_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['caption-font-size']).'px';
					}
				}
				$btn_bg_color_style = '';
				if(isset($kodeproperty_theme_option['caption-btn-color-switch']) && $kodeproperty_theme_option['caption-btn-color-switch'] == 'enable'){
					$btn_bg_color_style = 'style="color:'.esc_attr($kodeproperty_theme_option['caption-btn-color']).';background:'.esc_attr($kodeproperty_theme_option['caption-btn-color-bg']).'"';
				}
				$slides = empty($slides)? array(): $slides;
				foreach($slides as $slide_id => $slide){
					$ret .= '<li>';
					
					if( is_array($slide) ){

						// flex slider caption
						$caption = '';
						if( !empty($slide['title']) || !empty($slide['caption']) ){
							$slide['caption-position'] = empty($slide['caption-position'])? 'left': esc_attr($slide['caption-position']);
						
							$caption .= '<div class="kode-caption-wrapper position-' . esc_attr($slide['caption-position']) . '">';
							$caption .= '<div class="kode-caption-inner" >';
							$caption .= '<div class="kode-caption">';
							$caption .= empty($slide['title'])? '': '<div style="'.$title_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-title-color']).'" class="kode-caption-title">' . wp_kses($slide['title'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['caption'])? '': '<div style="'.$caption_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-desc-color']).'" class="kode-caption-text">' . wp_kses($slide['caption'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['button_txt'])? '': '<div '.$btn_bg_color_style.' class="kode_btn_store_1">' . esc_attr($slide['button_txt']) . ' <i class="fa fa-angle-right"></i></div>';
							$caption .= '</div>'; // kode-slider-caption
							$caption .= '</div>'; // kode-slider-caption-wrapper
							$caption .= '</div>';
						}				
					
						// flex slider link
						if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size'])) . $caption;
						}else if( $slide['slide-link'] == 'url' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab']), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'current' ){	
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'image' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'video' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}
					}else{
						$ret .= kodeproperty_get_image(esc_attr($slide), esc_attr($settings['size']), array('id'=>esc_attr($kodeproperty_gallery_id)));
					}
					$ret .= '</li>';
				}
				$ret .= '</ul>';
				$ret .= '</div>';
				
				return $ret;
			}
		
			function kodeproperty_get_bx_slider($slides, $settings = array()){
				global $kodeproperty_theme_option, $kodeproperty_gallery_id; $kodeproperty_gallery_id++;
				
				$ret  = '<div class="kode-bxslider" ';
				$ret .= empty($settings['pausetime'])? 'data-pausetime="' . esc_attr($kodeproperty_theme_option['bx-pause-time']) . '" ': 
							'data-pausetime="' . esc_attr($settings['pausetime']) . '" ';
				$ret .= empty($settings['slidespeed'])? 'data-slidespeed="' . esc_attr($kodeproperty_theme_option['bx-slide-speed']) . '" ': 
							'data-slidespeed="' . esc_attr($settings['slidespeed']) . '" ';			
				$ret .= empty($settings['effect'])? 'data-effect="' . esc_attr($kodeproperty_theme_option['bx-slider-effects']) . '" ': 
							'data-effect="' . esc_attr($settings['effect']) . '" ';	
							
				$ret .= empty($settings['columns'])? '': 'data-columns="' . esc_attr($settings['columns']) . '" ';
				$ret .= empty($settings['carousel'])? '': 'data-type="carousel" ';
				//$ret .= empty($settings['nav-container'])? '': 'data-nav-container="' . $settings['nav-container'] . '" ';
				$ret .= '>';
				if($kodeproperty_theme_option['bx-slider-effects'] == 'slide'){
					$ret .= '<ul data-min="'.esc_attr($kodeproperty_theme_option['bx-min-slide']).'" data-max="'.esc_attr($kodeproperty_theme_option['bx-max-slide']).'" data-margin="'.esc_attr($kodeproperty_theme_option['bx-slide-margin']).'" data-mode="horizontal" class="bxslider" >';
				}else{
					$ret .= '<ul data-mode="fade" class="bxslider">';
				}
				$title_font_size = '';
				if(isset($kodeproperty_theme_option['title-font-size'])){
					if($kodeproperty_theme_option['title-font-size'] == 0){
						$title_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['title-font-size']).'px';
					}
				}
				$caption_font_size = '';
				if(isset($kodeproperty_theme_option['caption-font-size'])){
					if($kodeproperty_theme_option['caption-font-size'] == 0){
						$caption_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['caption-font-size']).'px';
					}
				}
				$btn_bg_color_style = '';
				if(isset($kodeproperty_theme_option['caption-btn-color-switch']) && $kodeproperty_theme_option['caption-btn-color-switch'] == 'enable'){
					$btn_bg_color_style = 'style="color:'.esc_attr($kodeproperty_theme_option['caption-btn-color']).';background:'.esc_attr($kodeproperty_theme_option['caption-btn-color-bg']).'"';
				}
				$slides = empty($slides)? array(): $slides;
				foreach($slides as $slide_id => $slide){
					$ret .= '<li>';
					
					if( is_array($slide) ){

						// flex slider caption
						$caption = '';
						if( !empty($slide['title']) || !empty($slide['caption']) ){
							$slide['caption-position'] = empty($slide['caption-position'])? 'left': esc_attr($slide['caption-position']);
						
							$caption .= '<div class="kode-caption-wrapper position-' . esc_attr($slide['caption-position']) . '">';
							$caption .= '<div class="kode-caption-inner" >';
							$caption .= '<div class="kode-caption">';
							$caption .= empty($slide['title'])? '': '<div style="'.$title_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-title-color']).'" class="kode-caption-title">' . wp_kses($slide['title'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['caption'])? '': '<div style="'.$caption_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-desc-color']).'" class="kode-caption-text">' . wp_kses($slide['caption'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['button_txt'])? '': '<div '.$btn_bg_color_style.' class="kode_btn_store_1">' . esc_attr($slide['button_txt']) . ' <i class="fa fa-angle-right"></i></div>';
							$caption .= '</div>'; // kode-slider-caption
							$caption .= '</div>'; // kode-slider-caption-wrapper
							$caption .= '</div>';
						}				
					
						// bx slider link
						if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size'])) . $caption;
						}else if( $slide['slide-link'] == 'url' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab']), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'current' ){	
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'image' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}else if( $slide['slide-link'] == 'video' ){
							$ret .= kodeproperty_get_image(esc_attr($slide_id), esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>esc_attr($kodeproperty_gallery_id), 'close-tag'=>true));
							$ret .= $caption . '</a>';
						}
					}else{
						$ret .= kodeproperty_get_image($slide, esc_attr($settings['size']), array('id'=>esc_attr($kodeproperty_gallery_id)));
					}
					$ret .= '</li>';
				}
				$ret .= '</ul>';
				$ret .= '</div>';
				
				return $ret;
			}
		
			function kodeproperty_get_nivo_slider($slides, $settings = array()){
				global $kodeproperty_theme_option, $kodeproperty_gallery_id; $kodeproperty_gallery_id++;
				
				$i = 0; $caption = '';
				$ret  = '<div class="nivoSlider-wrapper">';
				$ret .= '<div class="nivoSlider" ';
				$ret .= empty($settings['pausetime'])? 'data-pausetime="' . esc_attr($kodeproperty_theme_option['nivo-pause-time']) . '" ': 
							'data-pausetime="' . esc_attr($settings['pausetime']) . '" ';
				$ret .= empty($settings['slidespeed'])? 'data-slidespeed="' . esc_attr($kodeproperty_theme_option['nivo-slide-speed']) . '" ': 
							'data-slidespeed="' . esc_attr($settings['slidespeed']) . '" ';			
				$ret .= empty($settings['effect'])? 'data-effect="' . esc_attr($kodeproperty_theme_option['nivo-slider-effects']) . '" ': 
							'data-effect="' . esc_attr($settings['effect']) . '" ';
				$ret .= '>';
				$title_font_size = '';
				if(isset($kodeproperty_theme_option['title-font-size'])){
					if($kodeproperty_theme_option['title-font-size'] == 0){
						$title_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['title-font-size']).'px';
					}
				}
				$caption_font_size = '';
				if(isset($kodeproperty_theme_option['caption-font-size'])){
					if($kodeproperty_theme_option['caption-font-size'] == 0){
						$caption_font_size = 'font-size:'.esc_attr($kodeproperty_theme_option['caption-font-size']).'px';
					}
				}
				$btn_bg_color_style = '';
				if(isset($kodeproperty_theme_option['caption-btn-color-switch']) && $kodeproperty_theme_option['caption-btn-color-switch'] == 'enable'){
					$btn_bg_color_style = 'style="color:'.esc_attr($kodeproperty_theme_option['caption-btn-color']).';background:'.esc_attr($kodeproperty_theme_option['caption-btn-color-bg']).'"';
				}
				$slides = empty($slides)? array(): $slides;
				foreach($slides as $slide_id => $slide){ 
					if( is_array($slide) ){

						// nivo slider caption
						$id = 'nivo-caption' . $kodeproperty_gallery_id . '-' . $i; $i++;
						if( !empty($slide['title']) || !empty($slide['caption']) ){
							$slide['caption-position'] = empty($slide['caption-position'])? 'left': esc_attr($slide['caption-position']);
							
							$caption .= '<div class="kode-nivo-caption" id="' . $id . '" >';
							$caption .= '<div class="kode-caption-wrapper position-' . $slide['caption-position'] . '">';
							$caption .= '<div class="kode-caption-inner" >';
							$caption .= '<div class="kode-caption">';
							$caption .= empty($slide['title'])? '': '<div style="'.$title_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-title-color']).'" class="kode-caption-title">' . wp_kses($slide['title'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['caption'])? '': '<div style="'.$caption_font_size.';color:'.esc_attr($kodeproperty_theme_option['caption-desc-color']).'" class="kode-caption-text">' . wp_kses($slide['caption'],array('a'=>array('class'=>array()),'div'=>array('class'=>array()),'span'=>array('class'=>array(),'id'=>array()))). '</div>';
							$caption .= empty($slide['button_txt'])? '': '<div '.$btn_bg_color_style.' class="kode_btn_store_1">' . esc_attr($slide['button_txt']) . ' <i class="fa fa-angle-right"></i></div>';
							$caption .= '</div>'; // kode-caption
							$caption .= '</div>'; // kode-caption-inner
							$caption .= '</div>'; // kode-caption-wrapper
							$caption .= '</div>'; // kode-nivo-caption
						}				
						
						// flex slider link
						$attr = ' title="#' . $id . '" '; 
						if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
							$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['size']), array(), $attr);
						}else if( $slide['slide-link'] == 'url' ){
							$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab'])), $attr);
						}else if( $slide['slide-link'] == 'current' ){	
							$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['size']), 
								array('id'=>esc_attr($kodeproperty_gallery_id)), $attr);
						}else if( $slide['slide-link'] == 'image' ){
							$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id)), $attr);
						}else if( $slide['slide-link'] == 'video' ){
							$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['size']), 
								array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>esc_attr($kodeproperty_gallery_id)), $attr);
						}
					}else{
						$ret .= kodeproperty_get_image($slide, esc_attr($settings['size']), array('id'=>$kodeproperty_gallery_id), $attr);
					}
				}
				$ret .= '</div>'; // nivoSlider
				$ret .= $caption;
				$ret .= '</div>'; // nivoSlider-wrapper
				
				return $ret;
			}
		
			function kodeproperty_get_work_gallery($kodeproperty_post_option,$col="",$num_fetch=""){
				global $kodeproperty_gallery_id, $kodeproperty_spaces; $kodeproperty_gallery_id++; 
				$ret = '';
				$slider_option = json_decode($kodeproperty_post_option['image-gallery'], true);
				$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
				$num_page = ceil(sizeof($kodeproperty_post_option['image-gallery']) / $num_fetch);
				$slide_order = $slider_option[0];
				$slide_data = $slider_option[1];					
				
				$slides = array();
				if(!empty($slide_order)){
					foreach( $slide_order as $slide_id ){
						$slides[$slide_id] = $slide_data[$slide_id];
					}
				}
				$kodeproperty_post_option['slider'] = $slides;
				$gallery_print = '';
				if(isset($kodeproperty_post_option['slider']) && $kodeproperty_post_option['slider'] <> ''){
					$gallery_print  = '<div class="kode_project_flick_wrap gallery-item"><ul>';
				
					$current_size = 0;
					foreach($kodeproperty_post_option['slider'] as $slide_id => $slide){
						if( ($current_size >= ($paged - 1) * $num_fetch) &&
							($current_size < ($paged) * $num_fetch) ){

							if( !empty($current_size) && ($current_size % $col == 0) ){
								$gallery_print .= '<li class="clear"></li>';
							}			
							$image_src = wp_get_attachment_image_src($slide_id, 'full');	
							$gallery_print .= '
							<li>
								<a href="'.esc_url($image_src[0]).'" data-gal="prettyphoto[]">';
									if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
										$gallery_print .= kodeproperty_get_image($slide_id, esc_attr($kodeproperty_post_option['thumbnail-size']));
									}else if($slide['slide-link'] == 'url' || $slide['slide-link'] == 'attachment'){		
										$gallery_print .= kodeproperty_get_image($slide_id, esc_attr($kodeproperty_post_option['thumbnail-size']), 
											array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab'])));				
									}else if($slide['slide-link'] == 'current'){
										$gallery_print .= kodeproperty_get_image($slide_id, esc_attr($kodeproperty_post_option['thumbnail-size']), 
											array('id'=>esc_attr($kodeproperty_gallery_id)));
									}else if($slide['slide-link'] == 'image'){
										$gallery_print .= kodeproperty_get_image($slide_id, esc_attr($kodeproperty_post_option['thumbnail-size']), 
											array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id)));
									}else if($slide['slide-link'] == 'video'){
										$gallery_print .= kodeproperty_get_image($slide_id, esc_attr($kodeproperty_post_option['thumbnail-size']), 
											array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>$kodeproperty_gallery_id));
									}
									$image_src = wp_get_attachment_image_src($slide_id, 'full');	
									if(!isset($slide['gallery_caption'])){
										$slide['gallery_caption'] = '';
									}
									if(!isset($slide['gallery_title'])){
										$slide['gallery_title'] = '';
									}
								$gallery_print .= '	
								</a>
							</li>';
							
						}
					$current_size ++;
					}					
				$gallery_print .= '</ul></div>  '; // kode-gallery-item
				
				}
				return $gallery_print;
			}
		
			function kodeproperty_get_gallery_item( $settings ){
				// title section	
				//$ret .= kodeproperty_get_item_title($settings);		
				$ret = '';
				$slider_option = json_decode($settings['slider'], true);
				
				$slide_order = $slider_option[0];
				$slide_data = $slider_option[1];					
				
				$slides = array();
				if(!empty($slide_order)){
					foreach( $slide_order as $slide_id ){
						$slides[$slide_id] = $slide_data[$slide_id];
					}
				}
				$settings['slider'] = $slides;
				
				//if( $settings['gallery-style'] == 'thumbnail' ) return kodeproperty_get_gallery_thumbnail($settings);
				return $ret . kodeproperty_get_gallery($settings);
			}
		
			function kodeproperty_get_gallery( $settings ){
				global $kodeproperty_gallery_id, $kodeproperty_spaces; $kodeproperty_gallery_id++; 

				$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

				$margin = (!empty($settings['margin-bottom']) && 
					$settings['margin-bottom'] != $kodeproperty_spaces['bottom-item'])? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
				$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
				
				// start printing gallery
				$current_size = 0;
				$settings['num-fetch'] = empty($settings['num-fetch'])? 9999: intval($settings['num-fetch']);
				$paged = (get_query_var('paged'))? get_query_var('paged') : 1;
				$num_page = ceil(sizeof($settings['slider']) / $settings['num-fetch']);
				
				$ret  = '<div class="'.esc_attr($settings['element-item-class']).' kode-style-gal-'.esc_attr($settings['style']).' kode-gallery kode-gutter-gallery bottom-spacer">';
				
				if($settings['style'] == 'simple-gallery'){
					if($settings['layout'] == 'without-space'){
						$ret  .= '<ul class="row kode-item kode-padding-free" ' . $item_id . $margin_style . '>';	
					}else{
						$ret  .= '<ul class="row kode-item" ' . $item_id . $margin_style . '>';	
					}
					foreach($settings['slider'] as $slide_id => $slide){
						if( ($current_size >= ($paged - 1) * $settings['num-fetch']) &&
							($current_size < ($paged) * $settings['num-fetch']) ){

							if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
								$ret .= '<li class="clear"></li>';
							}			
							$ret .= '<li class="gallery-item ' . kodeproperty_get_column_class('1/' . $settings['gallery-columns']) . '">';
								$ret .= '
								
								<div class="edu_masonery_thumb">
									<figure class="kode-ux effect-hera">';
										if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']));
										}else if($slide['slide-link'] == 'url' || $slide['slide-link'] == 'attachment'){		
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab'])));				
										}else if($slide['slide-link'] == 'current'){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('id'=>esc_attr($kodeproperty_gallery_id)));
										}else if($slide['slide-link'] == 'image'){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id)));
										}else if($slide['slide-link'] == 'video'){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>$kodeproperty_gallery_id));
										}
										$image_src = wp_get_attachment_image_src($slide_id, 'full');	
										if(!isset($slide['gallery_caption'])){
											$slide['gallery_caption'] = '';
										}
										if(!isset($slide['gallery_title'])){
											$slide['gallery_title'] = '';										
										}else{
											$ret .= '<figcaption><a href="'.esc_url($image_src[0]).'">' . esc_attr($slide['gallery_title']) . '</a></figcaption>';
										}
										$ret .= '
										<a data-rel="prettyphoto" href="'.esc_url($image_src[0]).'"><i class="fa fa-search"></i></a>
									</figure>';
								$ret .= '</div>'; // gallery item
							$ret .= '</li>'; // gallery column				
						}
						$current_size ++;
					}
					$ret .= '<li class="clear"></li>';
					$ret .= '</ul>'; // kode-gallery-item
				}else if($settings['style'] == 'gallery-slider'){
					if($settings['layout'] == 'without-space'){
						$ret  .= '<div data-slide="'.esc_attr($settings['gallery-columns']).'" data-small-slide="'.esc_attr($settings['gallery-columns']).'" class="owl-no-space owl-theme kode_video_list" ' . $item_id . $margin_style . '>';
					}else{
						$ret  .= '<div data-slide="'.esc_attr($settings['gallery-columns']).'" data-small-slide="'.esc_attr($settings['gallery-columns']).'" class="owl-carousel owl-theme kode_video_list" ' . $item_id . $margin_style . '>';
					}
					foreach($settings['slider'] as $slide_id => $slide){
						if( ($current_size >= ($paged - 1) * $settings['num-fetch']) &&
							($current_size < ($paged) * $settings['num-fetch']) ){

							if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
								$ret .= '';
							}
							$image_src = wp_get_attachment_image_src($slide_id, 'full');	
							$ret .= '<div class="item">
								<div class="edu_masonery_thumb">
									<figure class="kode-ux effect-hera">';
										if( empty($slide['slide-link']) || $slide['slide-link'] == 'none' ){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']));
										}else if($slide['slide-link'] == 'url' || $slide['slide-link'] == 'attachment'){		
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('url'=>esc_url($slide['url']), 'new-tab'=>esc_attr($slide['new-tab'])));				
										}else if($slide['slide-link'] == 'current'){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('id'=>esc_attr($kodeproperty_gallery_id)));
										}else if($slide['slide-link'] == 'image'){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('url'=>esc_url($slide['url']), 'id'=>esc_attr($kodeproperty_gallery_id)));
										}else if($slide['slide-link'] == 'video'){
											$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']), 
												array('url'=>esc_url($slide['url']), 'type'=>'video', 'id'=>$kodeproperty_gallery_id));
										}
										$image_src = wp_get_attachment_image_src($slide_id, 'full');	
										if(!isset($slide['gallery_caption'])){
											$slide['gallery_caption'] = '';
										}
										if(!isset($slide['gallery_title'])){
											$slide['gallery_title'] = '';
										}else{
											$ret .= '<figcaption><a href="'.esc_url($image_src[0]).'">' . esc_attr($slide['gallery_title']) . '</a></figcaption>';
										}
										$ret .= '									
										<a data-rel="prettyphoto" href="'.esc_url($image_src[0]).'"><i class="fa fa-search"></i></a>
									</figure>';
								$ret .= '</div>'; // gallery item
							$ret .= '</div>'; // gallery column				
						}
						$current_size ++;
					}
					//$ret .= '<div class="clear"></div>';
					$ret .= '</div>'; // kode-gallery-item
					
				}
				if( $settings['pagination'] == 'enable' ){
					$ret .= kodeproperty_get_pagination($num_page, $paged);
				}
				$ret .= '</div>'; // kode-gallery-item
				
				
				return $ret;
			}
		
			function kodeproperty_get_gallery_thumbnail( $settings ){
				$item_id = empty($settings['element-item-id'])? '': ' id="' . esc_attr($settings['element-item-id']) . '" ';

				global $kodeproperty_spaces;
				$margin = (!empty($settings['margin-bottom']) && 
					$settings['margin-bottom'] != $kodeproperty_spaces['bottom-item'])? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
				$margin_style = (!empty($margin))? ' style="' . esc_attr($margin) . '" ': '';			
				
				$ret  = '<div class="kode-gallery-item kode-item kode-gallery-thumbnail" ' . $item_id . $margin_style . '>';
				
				// full image
				$ret .= '<div class="kode-gallery-thumbnail-container">';
				foreach($settings['slider'] as $slide_id => $slide){
					$ret .= '<div class="kode-gallery-thumbnail" data-id="' . $slide_id . '" >';
					$ret .= kodeproperty_get_image($slide_id);
					if($settings['show-caption'] != 'no'){
						$ret .= '<div class="gallery-caption-wrapper">';
						$ret .= '<span class="gallery-caption">';
						$ret .= kodeproperty_get_attachment_info($slide_id, 'caption');
						$ret .= '</span>';
						$ret .= '</div>';
					}
					$ret .= '</div>';
				}
				$ret .= '</div>';
				
				// start printing gallery
				$current_size = 0;
				foreach($settings['slider'] as $slide_id => $slide){
					if( !empty($current_size) && ($current_size % $settings['gallery-columns'] == 0) ){
						$ret .= '<div class="clear"></div>';
					}			
				
					$ret .= '<div class="gallery-column ' . kodeproperty_get_column_class('1/' . $settings['gallery-columns']) . '">';
					$ret .= '<div class="gallery-item" data-id="' . $slide_id . '" >';
					$ret .= kodeproperty_get_image($slide_id, esc_attr($settings['thumbnail-size']));
					$ret .= '</div>'; // gallery item
					$ret .= '</div>'; // gallery column
					$current_size ++;
				}
				$ret .= '<div class="clear"></div>';
				
				$ret .= '</div>'; // kode-gallery-item
				
				return $ret;
			}
		
		function kodeproperty_get_social_shares(){	
			global $kodeproperty_plugin_option;
			$thumbnail = array();
			$page_title = rawurlencode(get_the_title());
			$current_url = KODEPROPERTY_HTTP . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>
			<ul class="kode-team-network-kick">
				<?php if($kodeproperty_plugin_option['facebook-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-facebook" href="http://www.facebook.com/share.php?u=<?php echo esc_url($current_url); ?>" data-original-title="Facebook"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['digg-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-digg" href="http://digg.com/submit?url=<?php echo esc_url($current_url); ?>&#038;title=<?php echo esc_attr($page_title); ?>" data-original-title="Digg"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['google-plus-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-google-plus" href="https://plus.google.com/share?url=<?php echo esc_url($current_url); ?>" data-original-title="Google PLus"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['linkedin-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo esc_url($current_url); ?>&#038;title=<?php echo esc_attr($page_title); ?>" data-original-title="Linkedin"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['my-space-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-steam" href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo esc_url($current_url); ?>" data-original-title="MySpace"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['pinterest-share'] == 'enable'){ $thumbnail_id = get_post_thumbnail_id( get_the_ID() );$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'large' ); ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($current_url); ?>&media=<?php echo esc_url($thumbnail[0]); ?>" data-original-title="Pinterest"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['reddit-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-reddit" href="http://reddit.com/submit?url=<?php echo esc_url($current_url); ?>&#038;title=<?php echo esc_attr($page_title); ?>" data-original-title="Reddit"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['stumble-upon-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-stumbleupon" href="http://www.stumbleupon.com/submit?url=<?php echo esc_url($current_url); ?>&#038;title=<?php echo esc_attr($page_title); ?>" data-original-title="Stumble"></a></li><?php }?>
				<?php if($kodeproperty_plugin_option['twitter-share'] == 'enable'){ ?><li><a title="" data-placement="top" data-toggle="tooltip" class="thbg-colorhover fa fa-twitter" href="http://twitter.com/home?status=<?php echo esc_attr(str_replace('%26%23038%3B', '%26', $page_title)) . ' - ' . esc_url($current_url); ?>" data-original-title="Twitter"></a></li><?php }?>
			</ul>
			<?php 
		}
	
		
		
		function kodeproperty_wp_kses_strip_tags($html){
			global $allowed_html;
			return wp_kses($html,$allowed_html);
		}
	

	
		// page builder content/text filer to execute the shortcode	
	
		
		function kodeproperty_content_filter( $content, $main_content = false ){
			if($main_content) return str_replace( ']]>', ']]&gt;', apply_filters('the_content', $content) );
			return apply_filters('kodeproperty_the_content', $content);
		}		
	
		
		function kodeproperty_text_filter( $text ){
			return apply_filters('kodeproperty_text_filter', $text);
		}
	
	
		// filter shortcode out if the plugin is not activated
	
		
		function kodeproperty_enable_shortcode_filter( $text ){
			if( !function_exists('kodeproperty_add_tinymce_button') ){
				$text = preg_replace('#\[kodeproperty_[^\]]+]#', '', $text);
				$text = preg_replace('#\[/kodeproperty_[^\]]+]#', '', $text);
			}
			return $text;
		}
	
	
		//Taxonomies List
	
		function kodeproperty_get_taxonomies_list($post_type='',$object='objects'){
			$get_list_tax = array();
			$taxonomy_objects = get_object_taxonomies( $post_type, $object );	
			if(!empty($taxonomy_objects)){
				foreach($taxonomy_objects as $keys => $values){
					 $get_list_tax[$keys] = $keys;
				}
			}
			return $get_list_tax;
		}
	
			
		// use for generating the option from admin panel
	
		function kodeproperty_check_option_data_type( $value, $data_type = 'color' ){
			if( $data_type == 'color' ){
				return (strpos($value, '#') === false)? '#' . $value: $value; 
			}else if( $data_type == 'text' ){
				return $value;
			}else if( $data_type == 'pixel' ){
				return (is_numeric($value))? $value . 'px': $value;
			}else if( $data_type == 'upload' ){
				if(is_numeric($value)){
					$image_src = wp_get_attachment_image_src($value, 'full');	
					return (!empty($image_src))? $image_src[0]: false;
				}else{
					return $value;
				}
			}else if( $data_type == 'font'){
				if( strpos($value, ',') === false ){
					return '"' . $value . '"';
				}
				return $value;
			}else if( $data_type == 'percent' ){
				return (is_numeric($value))? $value . '%': $value;
			}
		
		}
	
	
		// use for layouting the sidebar size
	
		function kodeproperty_get_sidebar_class( $sidebar = array() ){
			global $kodeproperty_theme_option;
			
			if( $sidebar['type'] == 'no-sidebar' ){
				return array_merge($sidebar, array('right'=>'', 'outer'=>'col-md-12', 'left'=>'col-md-12', 'center'=>'col-md-12'));
			}else if( $sidebar['type'] == 'both-sidebar' ){
				if( $kodeproperty_theme_option['both-sidebar-size'] == 3 ){
					return array_merge($sidebar, array('right'=>'col-md-3', 'outer'=>'col-md-3', 'left'=>'col-md-3', 'center'=>'col-md-6'));
				}else if( $kodeproperty_theme_option['both-sidebar-size'] == 4 ){
					return array_merge($sidebar, array('right'=>'col-md-4', 'outer'=>'col-md-4', 'left'=>'col-md-4', 'center'=>'col-md-4'));
				}
			}else{ 
			
				// determine the left/right sidebar size
				$size = ''; $center = '';
				switch ($kodeproperty_theme_option['sidebar-size']){
					case 1: $size = 'col-md-1'; $center = 'col-md-11'; break;
					case 2: $size = 'col-md-2'; $center = 'col-md-10'; break;
					case 3: $size = 'col-md-3'; $center = 'col-md-9'; break;
					case 4: $size = 'col-md-4'; $center = 'col-md-8'; break;
					case 5: $size = 'col-md-5'; $center = 'col-md-7'; break;
					case 6: $size = 'col-md-6'; $center = 'col-md-6'; break;
				}

				if( $sidebar['type'] == 'left-sidebar'){
					$sidebar['outer'] = $center;
					$sidebar['left'] = $size;
					$sidebar['center'] = $center;
					return $sidebar;
				}else if( $sidebar['type'] == 'right-sidebar'){
					$sidebar['outer'] = $center;
					$sidebar['right'] = $size;
					$sidebar['center'] = $center;
					return $sidebar;			
				}else{
					$sidebar['left'] = 'col-md-12';
					$sidebar['outer'] = 'col-md-12';
					$sidebar['center'] = 'col-md-12';
					return $sidebar;
				}
			}
		}
	
		// retrieve all posts as a list
	
		function kodeproperty_get_post_list_id( $post_type ){
			$post_list = get_posts(array('post_type' => $post_type, 'numberposts'=>1000));

			$ret = array();
			if( !empty($post_list) ){
				foreach( $post_list as $post_id ){
					$ret[$post_id->ID] = $post_id->post_title;
				}
			}
				
			return $ret;
		}	
	
	
		// retrieve all posts as a list
	
		function kodeproperty_get_post_list_id_firstempty( $post_type ){
			$post_list = get_posts(array('post_type' => $post_type, 'numberposts'=>1000));

			$ret = array('0'=>'');
			if( !empty($post_list) ){
				foreach( $post_list as $post_id ){
					$ret[$post_id->post_title] = $post_id->ID;
				}
			}
				
			return $ret;
		}	
	

		// retrieve all posts as a list
	
		function kodeproperty_get_post_list( $post_type ){
			$post_list = get_posts(array('post_type' => $post_type, 'numberposts'=>1000));

			$ret = array();
			if( !empty($post_list) ){
				foreach( $post_list as $post ){
					$ret[$post->post_name] = $post->post_title;
				}
			}
				
			return $ret;
		}	
	
	
	
	
		// retrieve all categories from each post type
	
		
		function kodeproperty_get_term_list( $taxonomy, $parent='' ){
			
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>0, 'parent'=>$parent) );
			

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				foreach( $term_list as $term ){
					if(isset($term->slug)){
						$ret[$term->slug] = $term->name;
					}
				}
			}
				
			return $ret;
		}	
	
	
		// retrieve all categories from each post type
	
		
		function kodeproperty_get_term_list_id( $taxonomy, $parent='' ){
			
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>0, 'parent'=>$parent) );
			

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				foreach( $term_list as $term ){
					if(isset($term->term_id)){
						$ret[$term->term_id] = $term->name;
					}
				}
			}
				
			return $ret;
		}	
	
	
	
	
		
		function kodeproperty_get_term_list_detail( $taxonomy, $parent='',$hidempty='' ){
			
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>1, 'parent'=>$parent) );			

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				foreach( $term_list as $term ){
					if(isset($term->slug)){
						$ret[$term->slug] = $term->name;
					}
				}
			}
				
			return $ret;
		}	
	
	
		// retrieve all categories from each post type
	
		
		function kodeproperty_get_term_list_emptyfirst( $taxonomy, $parent='' ){
			
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>0, 'parent'=>$parent) );

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				
				foreach( $term_list as $term ){
					if(isset($term->slug)){
						$ret[$term->name] = $term->slug;
					}
				}
			}			
			array_unshift($ret, esc_html__('No Value Selected' ,'kode-property'));
				
			return $ret;
		}	
	
	
	
		function kodeproperty_get_term_id( $taxonomy, $parent='' ){
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>0, 'parent'=>$parent) );

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				foreach( $term_list as $term ){
					$ret[$term->id] = $term->term_id;
				}
			}
				
			return $ret;
		}	
	
	
	
	
		function kodeproperty_get_sidebar_list(  ){
			$term_list = get_categories( array('taxonomy'=>$taxonomy, 'hide_empty'=>0, 'parent'=>$parent) );

			$ret = array();
			if( !empty($term_list) && empty($term_list['errors']) ){
				foreach( $term_list as $term ){
					$ret[$term->slug] = $term->name;
				}
			}
				
			return $ret;
		}	
	
	
		// string to css class name
	
		function kodeproperty_string_to_class($string){
			$class = preg_replace('#[^\w\s]#','',strtolower(strip_tags($string)));
			$class = preg_replace('#\s+#', '-', trim($class));
			return 'kode-skin-' . $class;
		}
	
	
		// calculate the size as a number ex "1/2" = 0.5
	
		function kodeproperty_item_size_to_num( $size ){
			if( preg_match('/^(\d+)\/(\d+)$/', $size, $size_array) )
			return $size_array[1] / $size_array[2];
			return 1;
		}	
	

		// create pagination link
	
		function kodeproperty_get_pagination($max_num_page, $current_page, $format = 'paged'){
			if( $max_num_page <= 1 ) return '';
		
			$big = 999999999; // need an unlikely integer
			return 	'<div class="kode-pagination">' . paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?' . $format . '=%#%',
				'current' => max(1, $current_page),
				'total' => $max_num_page,
				'prev_text'=> esc_html__('&lsaquo; Previous', 'kode-property'),
				'next_text'=> esc_html__('Next &rsaquo;', 'kode-property')
			)) . '</div>';
		}	
	
	
	
		//Strip Down slashes
	
		function kodeproperty_stripslashes($data){
			$data = is_array($data) ? array_map('stripslashes_deep', $data) : stripslashes($data);
			return $data;
		}
	
		//Stop backslashes from Array
	
		function kodeproperty_stopbackslashes($data){
			$data = str_replace('\\\\\\\\\\\\\"', '|bb6|', $data);
			$data = str_replace('\\\\\\\\\\\"', '|bb5|', $data);
			$data = str_replace('\\\\\\\\\"', '|bb4|', $data);
			$data = str_replace('\\\\\\\"', '|bb3|', $data);
			$data = str_replace('\\\\\"', '|bb2|', $data);
			$data = str_replace('\\\"', '|bb"|', $data);
			$data = str_replace('\\\\\\t', '|p2k|', $data);
			$data = str_replace('\\\\t', '|p1k|', $data);			
			$data = str_replace('\\\\\\n', '|p2k|', $data);
			$data = str_replace('\\\\n', '|p1k|', $data);
			return $data;
		}
	
		//decode and Stop back slashes
	
		function kodeproperty_decode_stopbackslashes($data){
			$data = str_replace('|bb6|', '\\\\\\"', $data);
			$data = str_replace('|bb5|', '\\\\\"', $data);
			$data = str_replace('|bb4|', '\\\\"', $data);
			$data = str_replace('|bb3|', '\\\"', $data);
			$data = str_replace('|bb2|', '\\"', $data);
			$data = str_replace('|bb"|', '\"', $data);
			$data = str_replace('|p2k|', '\\\t', $data);
			$data = str_replace('|p1k|', '\t', $data);			
			$data = str_replace('|p2k|', '\\\n', $data);
			$data = str_replace('|p1k|', '\n', $data);
			return $data;
		}
		
		//Define Classes
		function kodeproperty_post_classes_plugin( $classes ) {
			
			$classes[] = strtolower(str_replace(' ','-',get_option('current_theme'))).'-prop-plugin';
			
			return $classes;
		}
		
		
		
		
		function kodeproperty_define_thumbnail_size(){
			add_theme_support( 'post-thumbnails' );
		
			$kodeproperty_thumbnail_size = apply_filters('custom-thumbnail-size', $this->kodeproperty_thumbnail_size);		
			foreach($kodeproperty_thumbnail_size as $kodeproperty_size_slug => $kodeproperty_size){
				add_image_size($kodeproperty_size_slug, $kodeproperty_size['width'], $kodeproperty_size['height'], $kodeproperty_size['crop']);
			}
		}
		
		
		// add the image size filter to ThemeOptions
		
		function kodeproperty_define_custom_size_image( $sizes ){	
			$additional_size = array();
			
			$kodeproperty_thumbnail_size = apply_filters('custom-thumbnail-size', $this->kodeproperty_thumbnail_size);	
			foreach($kodeproperty_thumbnail_size as $kodeproperty_size_slug => $kodeproperty_size){
				$additional_size[$kodeproperty_size_slug] = $kodeproperty_size_slug;
			}
			
			return array_merge($sizes, $additional_size);
		}
		
		// Get All The Sizes
		function kodeproperty_get_thumbnail_list(){
			$kodeproperty_thumbnail_size = apply_filters('custom-thumbnail-size', $this->kodeproperty_thumbnail_size);		
			
			$sizes = array();
			foreach( get_intermediate_image_sizes() as $size ){
				if(in_array( $size, array( 'thumbnail', 'medium', 'large' )) ){
					$sizes[$size] = $size . ' -- ' . get_option($size . '_size_w') . 'x' . get_option($size . '_size_h');
				}else if( !empty($kodeproperty_thumbnail_size[$size]) ){
					$sizes[$size] = $size . ' -- ' . $kodeproperty_thumbnail_size[$size]['width'] . 'x' . $kodeproperty_thumbnail_size[$size]['height'];
				}else{
				
				}
			}
			$sizes['full'] = esc_html__('full size (Real Images)', 'kode-property');
			
			return $sizes;
		}	
		
		// Get All The Sizes
		function kodeproperty_get_thumbnail_list_emptyfirst(){
			$kodeproperty_thumbnail_size = apply_filters('custom-thumbnail-size', $this->kodeproperty_thumbnail_size);	
			
			$sizes = array('0'=>'');
			foreach( get_intermediate_image_sizes() as $size ){
				if(in_array( $size, array( 'thumbnail', 'medium', 'large' )) ){
					$sizes[$size . ' -- ' . get_option($size . '_size_w') . 'x' . get_option($size . '_size_h')] = $size;
				}else if( !empty($kodeproperty_thumbnail_size[$size]) ){
					$sizes[$size . ' -- ' . $kodeproperty_thumbnail_size[$size]['width'] . 'x' . $kodeproperty_thumbnail_size[$size]['height']] = $size;
				}else{
				
				}
			}
			$sizes['full size (Real Images)'] = esc_html__('full', 'kode-property');
			
			return $sizes;
		}	
		
	
	}
	

	$kodeproperty_func_utility = new kodeproperty_func_utility();

	
?>