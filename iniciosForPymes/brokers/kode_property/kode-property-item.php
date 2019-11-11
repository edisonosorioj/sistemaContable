<?php
	/*	
	*	Kodeforest Team Listing
	*	---------------------------------------------------------------------
	*	This file contains functions that help you create property item
	*	---------------------------------------------------------------------
	*/
	
	//Team Listing
	if( !function_exists('kodeproperty_get_property_item') ){
		function kodeproperty_get_property_item( $settings ){
			// $settings['category'];
			// $settings['tag'];
			// $settings['num-excerpt'];
			// $settings['num-fetch'];
			// $settings['property-style'];
			// $settings['order'];
			// $settings['orderby'];
			// $settings['order'];
			// $settings['margin-bottom'];
			// query posts section
			
			global $kodeproperty_plugin_option;
			
			
			
			$args = array('post_type' => 'property', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : 1;

			if( !empty($settings['features']) || (!empty($settings['status'])) || (!empty($settings['property-type'])) || (!empty($settings['room-type'])) || (!empty($settings['city'])) || (!empty($settings['country'])) || (!empty($settings['neighborhood'])) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['features']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['features']), 'taxonomy'=>'features', 'field'=>'slug'));
				}
				if( !empty($settings['status'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['status']), 'taxonomy'=>'status', 'field'=>'slug'));
				}	
				if( !empty($settings['property-type'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['property-type']), 'taxonomy'=>'property-type', 'field'=>'slug'));
				}
				if( !empty($settings['room-type'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['room-type']), 'taxonomy'=>'room-type', 'field'=>'slug'));
				}
				if( !empty($settings['city'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['city']), 'taxonomy'=>'city', 'field'=>'slug'));
				}
				if( !empty($settings['country'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['country']), 'taxonomy'=>'country', 'field'=>'slug'));
				}
				if( !empty($settings['neighborhood'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['neighborhood']), 'taxonomy'=>'neighborhood', 'field'=>'slug'));
				}
			}

			// create the property filter
			$settings['num-excerpt'] = empty($settings['num-excerpt'])? 0: $settings['num-excerpt'];
			$settings['property-column'] = empty($settings['property-column'])? 4: $settings['property-column'];
			$settings['property-filter'] = empty($settings['property-filter'])? 'hide': $settings['property-filter'];
			$settings['property-listing-type'] = empty($settings['property-listing-type'])? 'simple': $settings['property-listing-type'];
			
			$size = $settings['property-column'];
			$layout_select_full = add_query_arg( 'style', 'full' , esc_url(get_permalink()) );	
			$layout_select_grid = add_query_arg( 'style', 'grid' , esc_url(get_permalink()) );	
			$property_list_type = '';
			if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
				$property_list_type = 'bxslider';
			}
			
			//Show filter on top of the property listing
			if(isset($settings['property-filter']) && $settings['property-filter'] == 'show'){
				$property  = '
				<!--Property Meta Wrap Start-->
				<div class="kf_property_meta">
					<h5>'.esc_attr__('Listado de Propiedades','kode-property-list').'</h5>
					<form action="'.esc_url(get_permalink()).'" method="get">
					<div class="kf_view_type">
						<div class="kf_property_view">
							<span>'.esc_attr__('Ver por:','kode-property-list').'</span>
							<select onchange="this.form.submit()" name="orderby" class="chosen-select">
								<option>'.esc_attr__('Todos','kode-property-list').'</option>';
								$property  .= '
								<option ';
								if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){$property  .= 'selected';}
								$property  .= '
								 value="date">'.esc_attr__('Fecha de Publicación','kode-property-list').'</option>';
								$property  .= '
								<option ';
								if(isset($_GET['orderby']) && $_GET['orderby'] == 'title'){$property  .= 'selected';}
								$property  .= ' value="title">'.esc_attr__('Titulo','kode-property-list').'</option> <option ';							
								if(isset($_GET['orderby']) && $_GET['orderby'] == 'rand'){$property  .= 'selected';}
								$property  .= ' 
								 value="rand">'.esc_attr__('Aleatorio','kode-property-list').'</option>
							</select>						
						</div>
						
						<div class="kf_property_view">
							<span>'.esc_attr__('Orden por:','kode-property-list').'</span>
							<select onchange="this.form.submit()" name="order" class="chosen-select">
								<option >'.esc_attr__('Any','kode-property-list').'</option>';
								$property  .= '<option '; if(isset($_GET['order']) && $_GET['order'] == 'asc'){$property  .= 'selected';} 
								$property  .= ' value="asc">'.esc_attr__('Ascendiente','kode-property-list').'</option>
								<option ';
								if(isset($_GET['order']) && $_GET['order'] == 'desc'){$property  .= 'selected';} 
								$property  .= ' value="DESC">'.esc_attr__('Aleatorio','kode-property-list').'</option>
							</select>
						</div>
						
						<div class="kf_property_view">
							<span>'.esc_attr__('Modo de Vista:','kode-property-list').'</span>
							<a href="'.esc_url($layout_select_full).'"><i class="fa fa-th-list"></i></a>
							<a href="'.esc_url($layout_select_grid).'"><i class="fa fa-th-large"></i></a>
						</div>
					</div>
					</form>
				</div>
				<!--Property Meta Wrap End-->';
				if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
					$property  .= '<div class="kode-property kode-property-classic"><div class="owl-carousel" data-slide="'.esc_attr($settings['property-column']).'" data-small-slide="'.esc_attr($settings['property-column']).'" >';
				}else{
					$property  .= '<div class="kode-property kode-property-classic col-md-12"><div class="row">';
				}
				if(isset($_GET['style']) && $_GET['style'] == 'grid'){
					$settings['property-style'] = 'grid-view';
				}else if(isset($_GET['style']) && $_GET['style'] == 'full'){				
					$settings['property-style'] = 'simple-full-view';
				}else{
					
				}
				
				if(isset($_GET['order']) && $_GET['order'] == 'asc'){
					$args['order'] = 'asc';
				}else if(isset($_GET['order']) && $_GET['order'] == 'desc'){
					$args['order'] = 'desc';
				}else{
					
				}
				
				if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){
					$args['orderby'] = 'date';
				}else if(isset($_GET['order']) && $_GET['order'] == 'title'){
					$args['orderby'] = 'title';
				}else if(isset($_GET['order']) && $_GET['order'] == 'rand'){
					$args['orderby'] = 'rand';
				}else{
					
				}
			}else{
				$property = '';
				if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
					$property  .= '<div class="kode-property kode-property-classic"><div class="owl-carousel" data-slide="'.esc_attr($settings['property-column']).'" data-small-slide="'.esc_attr($settings['property-column']).'" >';
				}else{
					$property  .= '<div class="kode-property kode-property-classic col-md-12"><div class="row">';
				}
			}
			$query = new WP_Query( $args );
			$settings['title-num-excerpt'] = (empty($settings['title-num-excerpt']))? '15': $settings['title-num-excerpt'];
			$current_size = 0;
			while($query->have_posts()){
				$query->the_post();
				global $kodeproperty_post_option,$post,$kodeproperty_post_settings;
					$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
					if( !empty($kodeproperty_post_option) ){
						$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );
					}
					
					$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
					$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
					$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
					if($property_lat == ''){
						$property_lat = '-37.8172141';
					}
					$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
					if($property_long == ''){
						$property_long = '144.95592540000007';
					}
					$property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
					if($property_loc == ''){
						$property_loc = ' no address ';
					}
					$kodeproperty_post_option['property-bed'] = (empty($kodeproperty_post_option['property-bed']))? ' ': $kodeproperty_post_option['property-bed'];	
					if($kodeproperty_post_option['property-bed'] == ''){
						$kodeproperty_post_option['property-bed'] = '';
					}
					$kodeproperty_post_option['property-bath'] = (empty($kodeproperty_post_option['property-bath']))? ' ': $kodeproperty_post_option['property-bath'];	
					if($kodeproperty_post_option['property-bath'] == ''){
						$kodeproperty_post_option['property-bath'] = '';
					}
					$kodeproperty_post_option['property-space'] = (empty($kodeproperty_post_option['property-space']))? ' ': $kodeproperty_post_option['property-space'];	
					if($kodeproperty_post_option['property-space'] == ''){
						$kodeproperty_post_option['property-space'] = '';
					}
					$kodeproperty_post_option['property-garage'] = (empty($kodeproperty_post_option['property-garage']))? ' ': $kodeproperty_post_option['property-garage'];	
					if($kodeproperty_post_option['property-garage'] == ''){
						$kodeproperty_post_option['property-garage'] = '';
					}		
					$address = '';
					$property_city = '';
					$property_area = '';
					$property_country = '';
					$property_state = '';					
					$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
					if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
						if(!empty($kode_map_data)){
							$kode_map_data = json_decode($kode_map_data);
							$status = $kode_map_data->status;
							
							if($status == "OK"){
								$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
								$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
								$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
								// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
							}else{
								$property_area = 'No Area Found';
								$property_city = 'No City Found';
							}	
						}
						
					}
				$image_src_full = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				if($settings['property-style'] == 'simple-full-view'){
					$property .= '
					<div class="kf_listing_03_wrap">
						<div class="kf_property_img_03">
							<figure>
								'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
								<figcaption class="kf_listing_img_des">
									<div class="kf_listing_overlay"></div>
									<a href="'.esc_url($image_src_full[0]).'" data-rel="prettyPhoto[]"><i class="fa fa-plus"></i></a>
								</figcaption>
							</figure>
						</div>
						<div class="kf_listing_03_des">
							<div class="kf_property_caption">
								<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
								<ul class="kf_listing_03_location">
									<li><i class="fa fa-map-marker"></i><a href="#">'.esc_attr($property_loc).'</a></li>
									<li><i class="fa fa-phone"></i><a href="#">'.esc_attr__('888.111.22.444','kode-property-list').'</a></li>
								</ul>
							</div>
							<div class="kf_listing_total">
								<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
							</div>
							
							<p>'.esc_attr(substr(get_the_content(),0,$settings['num-excerpt'])).'</p>
							<ul class="kf_property_dolar">
								<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Beds:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-bed']).'</a></li>
								<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Baths:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-bath']).'</a></li>
								<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Space:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
							</ul>';
							if(isset($kodeproperty_plugin_option['property-see-more']) && $kodeproperty_plugin_option['property-see-more'] <> ''){
							$property .= '<a href="'.esc_url(get_permalink()).'" class="kf_sm_btn kf_link_1">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-see-more']).'</a>';
							}
						$property .= '</div>
					</div>';
				}else if($settings['property-style'] == 'normal-full-view'){
					$property .= '
					<div class="kf_listing_03_wrap kf_listing_04_wrap">
						<div class="kf_property_img_03">
							<figure>
								'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
								<figcaption class="kf_listing_img_des">
									<div class="kf_listing_overlay"></div>
									<h3>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h3>
								</figcaption>
							</figure>
						</div>
						<div class="kf_listing_03_des">
							<div class="kf_property_caption">
								<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
								<ul class="kf_listing_03_location">
									<li><i class="fa fa-map-marker"></i><a href="#">'.esc_attr($property_loc).'</a></li>
									<li><i class="fa fa-phone"></i><a href="#">'.esc_attr__('888.111.22.444','kode-property-list').'</a></li>
								</ul>
							</div>
							<ul class="kf_recent_rating">
								<li><a href="#"><i class="fa fa-star-half-full"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
								<li><a href="#"><i class="fa fa-star"></i></a></li>
							</ul>
							<p>'.esc_attr(substr(get_the_content(),0,$settings['num-excerpt'])).'</p>
							<ul class="kf_foo_listing_meta">
								<li><i class="fa fa-arrows-alt"></i>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
								<li><i class="fa fa-bed"></i>'.esc_attr__('Bedrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</li>
								<li><i class="icon-bath"></i>'.esc_attr__('Bathrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bath']).'</li>
							</ul>';
							if(isset($kodeproperty_plugin_option['property-see-more']) && $kodeproperty_plugin_option['property-see-more'] <> ''){
							$property .= '<a href="'.esc_url(get_permalink()).'">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-see-more']).'</a>';
							}
						$property .= '</div>
					</div>';
				}else if($settings['property-style'] == 'modern-full-view'){
					$property .= '
					<div class="kf_listing_outer_wrap">
						<div class="kf_property_img">
							<figure>
								'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
							</figure>
						</div>
						<div class="kf_property_place">
							<div class="kf_property_caption">
								<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
								<p><i class="fa fa-map-marker"></i>'.esc_attr($property_loc).'</p>
							</div>
							<h5>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h5>
							<ul class="kf_property_dolar">
								<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Area:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
								<li><i class="fa fa-bed"></i><a href="#">'.esc_attr__('Bedroom:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</a></li>
								<li><i class="fa fa-bed"></i><a href="#">'.esc_attr__('Bathrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bath']).'</a></li>
							</ul>
							<ul class="kf_property_dolar">';
									if($kodeproperty_post_option['property-garage'] <> ''){
										$property .= '<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Garage:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-garage']).'</a></li>';
                                    }
									$property .= '
								<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Space:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
							</ul>';
							if(isset($kodeproperty_plugin_option['property-more-information']) && $kodeproperty_plugin_option['property-more-information'] <> ''){
							$property .= '<a href="'.esc_url(get_permalink()).'" class="kf_property_more">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-more-information']).'</a>';
							}
						$property .= '</div>
					</div>';
				}else if($settings['property-style'] == 'grid-view'){
					if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
						$property .= '<div class="property-full-size-wrapper">';
					}else{
						$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
					}

					//Caja Visualizadora Propiedades
						$property .= '<div class="kf_property_listing_wrap">
                        	<figure>
                            	'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
                                <figcaption class="kf_listing_detail">
                                	<span class="kf_listing_overlay"></span>
										<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('Ver Más','kode-property-list').'</a>
                                </figcaption>
                            </figure>
                            <div class="kf_property_listing_des">
                            	<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
                                <p>'.esc_attr(substr(get_the_content(),0,90)).'</p>
                                
                            </div>
                        </div>
					</div>';
				}else if($settings['property-style'] == 'modern-grid-view'){
					if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
						$property .= '<div class="property-full-size-wrapper">';
					}else{
						$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
					}
					$property .= '
						<div class="kf_property_rent_wrap">
							<figure>
								'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
								<figcaption class="kf_listing_detail">
									<span class="kf_listing_overlay"></span>
										<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('View Detail','kode-property-list').'</a>
									<div class="kf_rent_label">';									
									$property .= '	<p>'. esc_attr__('Rent','kode-property-list').'</p>';
									$property .= '	
									</div>
								</figcaption>
							</figure>
							<div class="kf_rent_property_des">
								<h6><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h6>
								<ul>
									<li>
										<i class="fa fa-bed"></i>
										<p>'.esc_attr__('bedroom','kode-property-list').'</p>
										<span>'.esc_attr($kodeproperty_post_option['property-bed']).'</span>
									</li>
									<li>
										<i class="icon-bath"></i>
										<p>'.esc_attr__('Bathroom','kode-property-list').'</p>
										<span>'.esc_attr($kodeproperty_post_option['property-bath']).'</span>
									</li>';
									if($kodeproperty_post_option['property-garage'] <> ''){
										$property .= '<li>
										<i class="fa fa-car"></i>
										<p>'.esc_attr__('Garage','kode-property-list').'</p>
										<span>'.esc_attr($kodeproperty_post_option['property-garage']).'</span>
									</li>';
                                    }
									$property .= '
									
								</ul>
							</div>
							<div class="kf_rent_location">
								<h6><i class="fa fa-map-marker"></i>'.esc_attr($property_city).'</h6>
								<div class="kf_rent_total_price">
									<h6>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h6>
								</div>
							</div>
						</div>
					</div>';
				}else{
						if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
							$property .= '<div class="property-full-size-wrapper">';
						}else{
							$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
						}
						$property .= '
						<div class="kf_property_listing_wrap">
                        	<figure>
                            	'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
                                <figcaption class="kf_listing_detail">
                                	<span class="kf_listing_overlay"></span>
                                	<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('View Detail','kode-property-list').'</a>
                                </figcaption>
                            </figure>
                            <div class="kf_property_listing_des">
                            	<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
                                <p>'.esc_attr(substr(get_the_content(),0,$settings['num-excerpt'])).'</p>
                                <div class="kf_listing_total_price">
                                	<h4>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h4>
                                </div>
                                <ul>
                                	<li>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('Beds','kode-property-list').'</li>
									<li>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('Bath','kode-property-list').'</li>
									';
									if($kodeproperty_post_option['property-garage'] <> ''){
										$property .= '<li>'.esc_attr($kodeproperty_post_option['property-garage']).' '.esc_attr__('Garage','kode-property-list').'</li>';
                                    }
									$property .= '
									<li>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
                                </ul>
                            </div>
                        </div>
					</div>';
				}
				$current_size++;
			}
			wp_reset_postdata();
			if( $settings['pagination'] == 'enable' ){
				$property .= kodeproperty_get_pagination($query->max_num_pages, $args['paged']);
			}
			
			$property .= '</div></div>';	
					
			return $property;
		}
	}	//Team Listing
	
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Properties Search Filter
	/*-----------------------------------------------------------------------------------*/
	if(!function_exists('kodeproperty_search')){
		function kodeproperty_search($search_args){

			/* taxonomy query and meta query arrays */
			$tax_query = array();
			$meta_query = array();

			/* Keyword Based Search */
			if( isset ( $_GET['keyword'] ) ) {
				$keyword = trim( $_GET['keyword'] );
				if ( ! empty( $keyword ) ) {
					$search_args['s'] = $keyword;
				}
			}
			
		
			
			/* Property Bedrooms Parameter */
			if((!empty($_GET['area'])) &&  !empty($_GET['space']) && !empty($_GET['type'])){
				
				$meta_query = array(
					'relation' => 'AND',
					array(
						'key' => 'property-location',
						'value' => $_GET['area'],
						'compare' => 'like',					
					),
					array(
						'key' => 'property-space',
						'value' => $_GET['space'],
						'compare' => 'like',					
					),
					array(
						'key' => 'property-type',
						'value' => $_GET['type'],
						'compare' => 'like',					
					),
				);
			}else{			
				/* Property Bedrooms Parameter */
				if((!empty($_GET['area'])) && ( $_GET['area'] != '' ) ){
					$meta_query[] = array(
						'key' => 'property-location',
						'value' => $_GET['area'],
						'compare' => 'like',					
					);
				}
				
				/* Property Bedrooms Parameter */
				if((!empty($_GET['space'])) && ( $_GET['space'] != '' ) ){
					$meta_query[] = array(
						'key' => 'property-space',
						'value' => $_GET['space'],
						'compare' => 'like',					
					);
				}
				
				/* Property Bedrooms Parameter */								
				if( isset($_GET['property-for']) && ($_GET['property-for'] != 'Any')){
					$meta_query[] = array(
						'key' => 'property-type',
						'value' => $_GET['property-for'],
						'compare' => 'like',					
					);
				}
				
			}
			
			// $max_price = '';
			// $min_price = '';
			// $new_price = '';
			// if(isset($_GET['price']) && $_GET['price'] <> ''){
				// $new_price = explode('-',$_GET['price']);
				// $min_price = strip_tags($new_price[0]);
				// $max_price = strip_tags($new_price[1]);
				// $max_price = str_replace("$", "", $new_price[1], $count);
				// $min_price = str_replace("$", "", $new_price[0], $count);
				$min_price = '';
				$max_price = '';
				if(isset($_GET['min-price']) && $_GET['min-price'] <> ''){
					$min_price = $_GET['min-price'];
				}
				
				if(isset($_GET['max-price']) && $_GET['max-price'] <> ''){
					$max_price = $_GET['max-price'];
				}
				/* Logic for Min and Max Price Parameters */
				if( isset($min_price) && ($min_price != 'any') && isset($max_price) && ($max_price != 'any') ){
					
					$min_price = doubleval($min_price);
					$max_price = doubleval($max_price);
					if( $min_price >= 0 && $max_price > $min_price ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => array( $min_price, $max_price ),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
					}
				}else if( isset($min_price) && ($min_price != 'any') ){
					$min_price = doubleval($min_price);
					if( $min_price > 0 ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => $min_price,
							'type' => 'NUMERIC',
							'compare' => '>='
						);
					}
				}else if( isset($max_price) && ($max_price != 'any') ){
					$max_price = doubleval($max_price);
					if( $max_price > 0 ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => $max_price,
							'type' => 'NUMERIC',
							'compare' => '<='
						);
					}
				}
				
				$min_bed = '';
				$max_bed = '';
				if(isset($_GET['min-bed']) && $_GET['min-bed'] <> ''){
					$min_bed = $_GET['min-bed'];
				}
				
				if(isset($_GET['max-bed']) && $_GET['max-bed'] <> ''){
					$max_bed = $_GET['max-bed'];
				}
				/* Logic for Min and Max bed Parameters */
				if( isset($min_bed) && ($min_bed != 'any') && isset($max_bed) && ($max_bed != 'any') ){
					
					$min_bed = doubleval($min_bed);
					$max_bed = doubleval($max_bed);
					if( $min_bed >= 0 && $max_bed > $min_bed ){
						$meta_query[] = array(
							'key' => 'property-bed',
							'value' => array( $min_bed, $max_bed ),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
					}
				}else if( isset($min_bed) && ($min_bed != 'any') ){
					$min_bed = doubleval($min_bed);
					if( $min_bed > 0 ){
						$meta_query[] = array(
							'key' => 'property-bed',
							'value' => $min_bed,
							'type' => 'NUMERIC',
							'compare' => '>='
						);
					}
				}else if( isset($max_bed) && ($max_bed != 'any') ){
					$max_bed = doubleval($max_bed);
					if( $max_bed > 0 ){
						$meta_query[] = array(
							'key' => 'property-bed',
							'value' => $max_bed,
							'type' => 'NUMERIC',
							'compare' => '<='
						);
					}
				}
			// }
		
			// /* if more than one taxonomies exist then specify the relation */
			$tax_count = count( $tax_query );
			if( $tax_count > 1 ){
				$tax_query['relation'] = 'AND';
			}

			/* if more than one meta query elements exist then specify the relation */
			$meta_count = count( $meta_query );
			if( $meta_count > 1 ){
				$meta_query['relation'] = 'AND';
			}

			if( $tax_count > 0 ){
				$search_args['tax_query'] = $tax_query;
			}

			/* if meta query has some values then add it to base home page query */
			
			$search_args['meta_query'] = $meta_query;
			

			/* Sort By Price */
			if( (isset($min_price) && ($min_price != 'any')) || ( isset($max_price) && ($max_price != 'any') ) ){
				$search_args['orderby'] = 'meta_value_num';
				$search_args['meta_key'] = 'property-price';
				$search_args['order'] = 'ASC';
			}
			
			

			return $search_args;
		}
	}
	add_filter('kode_search_parameters','kodeproperty_search');
	
	
	if( !function_exists('kodeproperty_get_search_form') ){
		function kodeproperty_get_search_form(){
			$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
			$kodeproperty_action = '';
			if(isset($kodeproperty_plugin_option['property-search-page'])){
				$kodeproperty_action = $kodeproperty_plugin_option['property-search-page'];
			}
			global $kodeproperty_plugin_option;
			
			$ret = '
			<!--Advance Search Wrap Start-->
			<div class="kf_advance_search_bg">
				<div class="container">
					<!--Tab Link Wrap Start-->
					<div class="kf_search_tab_wrap">
						<ul data-tabs="tabs">
							<li class="active"><a data-toggle="tab" href="#listing">'.esc_attr__('Todos','kode-property-list').'</a></li>';
							if(isset($kodeproperty_plugin_option['property-search-tab-for-rent']) && $kodeproperty_plugin_option['property-search-tab-for-rent'] == 'enable'){
							$ret .= '<li><a data-toggle="tab" href="#rent">'.esc_attr__('Alquiler','kode-property-list').'</a></li>';
							}
							if(isset($kodeproperty_plugin_option['property-search-tab-for-sale']) && $kodeproperty_plugin_option['property-search-tab-for-sale'] == 'enable'){
							$ret .= '<li><a data-toggle="tab" href="#sale">'.esc_attr__('Venta','kode-property-list').'</a></li>';
							}
							if(isset($kodeproperty_plugin_option['property-search-tab-for-auction']) && $kodeproperty_plugin_option['property-search-tab-for-auction'] == 'enable'){
							$ret .= '<li><a data-toggle="tab" href="#auction">'.esc_attr__('Subastas','kode-property-list').'</a></li>';
							}
							$ret .= '
						</ul>
					</div>
					<!--Tab Link Wrap End-->
					
					<!--Search Form Wrap Start-->
					<div class="tab-content">
						<div class="tab-pane active" id="listing">
							<div class="kf_advacnce_search_form">
								<form action="'.esc_url(get_permalink($kodeproperty_action)).'" method="get">
									<div class="row">
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Palabras Claves','kode-property-list').'</label>
												<input type="text" name="keyword" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Area','kode-property-list').'</label>
												<input type="text" name="space" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Departamento','kode-property-list').'</label>
												<select name="state" class="chosen-select">';
													$kodeproperty_get = kodeproperty_get_term_list('state');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Tipo de Propiedad','kode-property-list').'</label>
												<select name="type" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>';
													$kodeproperty_get = kodeproperty_get_term_list('status');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Min Cuartos','kode-property-list').'</label>
												<select name="min-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Max Cuartos','kode-property-list').'</label>
												<select name="max-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Min Precio','kode-property-list').'</label>
												<select name="min-price" class="chosen-select">
													'.kodeproperty_min_prices_list().'
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Max Precio','kode-property-list').'</label>
												<select name="max-price" class="chosen-select">
													'.kodeproperty_max_prices_list().'
												</select>
											</div>
										</div>
										<div class="col-md-4 col-sm-6">
											<div class="kf_search_field">
												<input type="submit" value="'.esc_attr__('Buscar Propiedad','kode-property-list').'">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane" id="rent">
							<div class="kf_advacnce_search_form">
								<form action="'.esc_url(get_permalink($kodeproperty_action)).'" method="get">
									<div class="row">
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Palabras Claves','kode-property-list').'</label>
												<input type="text" name="keyword" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Area','kode-property-list').'</label>
												<input type="text" name="space" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Departamento','kode-property-list').'</label>
												<select name="state" class="chosen-select">';
													$kodeproperty_get = kodeproperty_get_term_list('state');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Tipo de Propiedad','kode-property-list').'</label>
												<select name="type" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>';
													$kodeproperty_get = kodeproperty_get_term_list('status');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Min Cuartos','kode-property-list').'</label>
												<select name="min-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Max Cuartos','kode-property-list').'</label>
												<select name="max-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field kf_range_slider">
												<label>'.esc_attr__('Rango de Precio','kode-property-list').'</label>
												<input type="text" name="price" class="amount" readonly >
												<div class="kf_range_slider">
													<span>'.esc_attr__('Min','kode-property-list').'</span>
													<div data-amount=".amount" data-currency="'.esc_attr($kodeproperty_plugin_option['property-currency']).'" class="slider-range"></div>
													<span>'.esc_attr__('Max','kode-property-list').'</span>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<input type="hidden" name="property-for" value="rent" />
												<input type="hidden" name="listing-type" value="'.esc_attr($kodeproperty_plugin_option['property-search-rent-option']).'" />
												<input type="submit" value="'.esc_attr__('Buscar Propiedad','kode-property-list').'">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="tab-pane" id="sale">
							<div class="kf_advacnce_search_form">
								<form action="'.esc_url(get_permalink($kodeproperty_action)).'" method="get">
									<div class="row">
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Palabras Claves','kode-property-list').'</label>
												<input type="text" name="keyword" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Area','kode-property-list').'</label>
												<input type="text" name="space" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Departamento','kode-property-list').'</label>
												<select name="state" class="chosen-select">';
													$kodeproperty_get = kodeproperty_get_term_list('state');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Tipo de Propiedad','kode-property-list').'</label>
												<select name="type" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>';
													$kodeproperty_get = kodeproperty_get_term_list('status');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Min Cuartos','kode-property-list').'</label>
												<select name="min-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Max Cuartos','kode-property-list').'</label>
												<select name="max-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field kf_range_slider">
												<label>'.esc_attr__('Rango de Precio','kode-property-list').'</label>
												<input type="text" name="price" class="amount" readonly >
												<div class="kf_range_slider">
													<span>'.esc_attr__('Min','kode-property-list').'</span>
													<div data-amount=".amount" data-currency="'.esc_attr($kodeproperty_plugin_option['property-currency']).'" class="slider-range"></div>
													<span>'.esc_attr__('Max','kode-property-list').'</span>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<input type="hidden" name="property-for" value="sale" />
												<input type="hidden" name="listing-type" value="'.esc_attr($kodeproperty_plugin_option['property-search-sale-option']).'" />
												<input type="submit" value="'.esc_attr__('Buscar Propiedad','kode-property-list').'">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						<div class="tab-pane" id="auction">
							<div class="kf_advacnce_search_form">
								<form action="'.esc_url(get_permalink($kodeproperty_action)).'" method="get">
									<div class="row">
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Palabras Claves','kode-property-list').'</label>
												<input type="text" name="keyword" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Area','kode-property-list').'</label>
												<input type="text" name="space" />
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Departamento','kode-property-list').'</label>
												<select name="state" class="chosen-select">';
													$kodeproperty_get = kodeproperty_get_term_list('state');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Tipo de Propiedad','kode-property-list').'</label>
												<select name="type" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>';
													$kodeproperty_get = kodeproperty_get_term_list('status');
													foreach($kodeproperty_get as $keys => $values){
														$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
													}
													$ret .= '
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Min Cuartos','kode-property-list').'</label>
												<select name="min-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-6">
											<div class="kf_search_field">
												<label>'.esc_attr__('Max Cuartos','kode-property-list').'</label>
												<select name="max-bed" class="chosen-select">
													<option>'.esc_attr__('Todos','kode-property-list').'</option>
													<option>'.esc_attr__('2','kode-property-list').'</option>
													<option>'.esc_attr__('3','kode-property-list').'</option>
													<option>'.esc_attr__('4','kode-property-list').'</option>
													<option>'.esc_attr__('5','kode-property-list').'</option>
												</select>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field kf_range_slider">
												<label>'.esc_attr__('Rango de Precio','kode-property-list').'</label>
												<input type="text" name="price" class="amount" readonly>
												<div class="kf_range_slider">
													<span>'.esc_attr__('Min','kode-property-list').'</span>
													<div data-amount=".amount" data-currency="'.esc_attr($kodeproperty_plugin_option['property-currency']).'" class="slider-range"></div>
													<span>'.esc_attr__('Max','kode-property-list').'</span>
												</div>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="kf_search_field">
												<input type="hidden" name="property-for" value="auction" />
												<input type="hidden" name="listing-type" value="'.esc_attr($kodeproperty_plugin_option['property-search-auction-option']).'" />
												<input type="submit" value="'.esc_attr__('Buscar Propiedad','kode-property-list').'">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--Search Form Wrap End-->
				</div>
			</div>
			<!--Advance Search Wrap Start-->';
			
			if(isset($kodeproperty_plugin_option['property-search-page']) && $kodeproperty_plugin_option['property-search-page'] <> ''){
				return $ret;
			}
		}
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	// Numbers loop
	/*-----------------------------------------------------------------------------------*/
	if(!function_exists('kodeproperty_numbers_list')){
		function kodeproperty_numbers_list($numbers_list_for){
			$numbers_array = array(1,2,3,4,5,6,7,8,9,10);
			$searched_value = '';
			$html = '';
			if($numbers_list_for == 'days'){
				if(isset($_GET['days'])){
					$searched_value = $_GET['days'];
				}
			}
			
			if(!empty($numbers_array)){
				foreach($numbers_array as $number){
					if($searched_value == $number){
						$html .= '<option value="'.$number.'" selected="selected">'.$number.'</option>';
					}else {
						$html .= '<option value="'.$number.'">'.$number.'</option>';
					}
				}
			}

			if($searched_value == 'any' || empty($searched_value)) {
				$html .= '<option value="any" selected="selected">'.__( 'Any', 'kode-property-list').'</option>';
			} else {
				$html .= '<option value="any">'.__( 'Any', 'kode-property-list').'</option>';
			}
			return $html;
		}
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Properties sorting
	/*-----------------------------------------------------------------------------------*/
	if( !function_exists( 'kodeproperty_sort_books' ) ){
		/**
		 * @param $property_query_args
		 * @return mixed
		 */
		function kodeproperty_sort_books($property_query_args){
			if (isset($_GET['sortby'])) {
				$orderby = $_GET['sortby'];
				if ($orderby == 'price-asc') {
					$property_query_args['orderby'] = 'meta_value_num';
					$property_query_args['meta_key'] = 'property-price';
					$property_query_args['order'] = 'ASC';
				} else if ($orderby == 'price-desc') {
					$property_query_args['orderby'] = 'meta_value_num';
					$property_query_args['meta_key'] = 'property-price';
					$property_query_args['order'] = 'DESC';
				} else if ($orderby == 'date-asc') {
					$property_query_args['orderby'] = 'date';
					$property_query_args['order'] = 'ASC';
				} else if ($orderby == 'date-desc') {
					$property_query_args['orderby'] = 'date';
					$property_query_args['order'] = 'DESC';
				}
			}
			return $property_query_args;
		}
	}
	
	/*-----------------------------------------------------------------------------------*/
	// Maximum Prices
	/*-----------------------------------------------------------------------------------*/
	if(!function_exists('kodeproperty_max_prices_list')){
		function kodeproperty_max_prices_list(){

			$max_price_array = array( 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000 );
			$maximum_price = '';
			$html = '';
			if(isset($_GET['max-price'])){
				$maximum_price = doubleval($_GET['max-price']);
			}
			
			if($maximum_price == 'any' || empty($maximum_price)) {
				$html .= '<option value="any" selected="selected">'.__( 'Todos', 'kode-property-list').'</option>';
			} else {
				$html .= '<option value="any">'.__( 'Todos', 'kode-property-list').'</option>';
			}

			if(!empty($max_price_array)){
				foreach($max_price_array as $price){
					if($maximum_price == $price){
						$html .= '<option value="'.$price.'" selected="selected">'.get_custom_price($price).'</option>';
					}else {
						$html .= '<option value="'.$price.'">'.get_custom_price($price).'</option>';
					}
				}
			}
			
			return $html;
		}
	}
	
	/*-----------------------------------------------------------------------------------*/
	// Minimum Prices
	/*-----------------------------------------------------------------------------------*/
	if(!function_exists('kodeproperty_min_prices_list')){
		function kodeproperty_min_prices_list(){
			$min_price_array = array( 1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000 );

			$minimum_price = '';
			$html = '';
			if(isset($_GET['min-price'])){
				$minimum_price = doubleval($_GET['min-price']);
			}
			
			
			if($minimum_price == 'any' || empty($minimum_price)) {
				$html .= '<option value="any" selected="selected">'.__( 'Todos', 'kode-property-list').'</option>';
			} else {
				$html .= '<option value="any">'.__( 'Todos', 'kode-property-list').'</option>';
			}

			if(!empty($min_price_array)){
				foreach($min_price_array as $price){
					if($minimum_price == $price){
						$html .= '<option value="'.esc_attr($price).'" selected="selected">'.esc_attr(get_custom_price($price)).'</option>';
					}else {
						$html .= '<option value="'.esc_attr($price).'">'.get_custom_price($price).'</option>';
					}
				}
			}

			
			
			return $html;

		}
	}
	
	/*-----------------------------------------------------------------------------------*/
	/*	Get Currency
	/*-----------------------------------------------------------------------------------*/
	if(!function_exists('get_theme_currency')){
		function get_theme_currency(){
			$currency = get_option( 'theme_currency_sign' );
			if(!empty($currency)){
				return $currency;
			}
			return __('$','kode-property-list');
		}
	}
	
	if(!function_exists('get_custom_price')){
		function get_custom_price($amount){
			$amount = doubleval($amount);
			if($amount){
				$currency = get_theme_currency();
				$decimals = intval(get_option( 'theme_decimals'));
				$decimal_point = get_option( 'theme_dec_point' );
				$thousands_separator = get_option( 'theme_thousands_sep' );
				$currency_position = get_option( 'theme_currency_position' );
				$formatted_price = number_format($amount,$decimals, $decimal_point, $thousands_separator);
				if($currency_position == 'after'){
					return $formatted_price . $currency;
				}else{
					return $currency . $formatted_price;
				}
			} else {
				return false;
			}
		}
	}
	
	
	add_action( 'wp_ajax_kode_search_sub_action', 'kodeproperty_search_user_submit' );
	add_action( 'wp_ajax_nopriv_kode_search_sub_action', 'kodeproperty_search_user_submit' );
	if( !function_exists('kodeproperty_search_user_submit') ){
		function kodeproperty_search_user_submit(){
			
		}
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Properties Search Filter
	/*-----------------------------------------------------------------------------------*/
	if(!function_exists('kodeproperty_search_sidebar')){
		function kodeproperty_search_sidebar($search_args){

			/* taxonomy query and meta query arrays */
			$tax_query = array();
			$meta_query = array();

			/* Keyword Based Search */
			if( isset ( $_GET['keyword'] ) ) {
				$keyword = trim( $_GET['keyword'] );
				if ( ! empty( $keyword ) ) {
					$search_args['s'] = $keyword;
				}
			}
			
		
			
			/* Property Bedrooms Parameter */
			if((!empty($_GET['location'])) &&  !empty($_GET['space']) && !empty($_GET['type'])){
				
				$meta_query = array(
					'relation' => 'AND',
					array(
						'key' => 'property-location',
						'value' => $_GET['location'],
						'compare' => 'like',					
					),
					
					// array(
						// 'key' => 'property-space',
						// 'value' => $_GET['space'],
						// 'compare' => 'like',					
					// ),
					// array(
						// 'key' => 'property-type',
						// 'value' => $_GET['type'],
						// 'compare' => 'like',					
					// ),
				);
			}else{			
				/* Property Bedrooms Parameter */
				if((!empty($_GET['location'])) && ( $_GET['location'] != '' ) ){
					$meta_query[] = array(
						'key' => 'property-location',
						'value' => $_GET['location'],
						'compare' => 'like',					
					);
				}
				
				/* Property Bedrooms Parameter */
				// if((!empty($_GET['space'])) && ( $_GET['space'] != '' ) ){
					// $meta_query[] = array(
						// 'key' => 'property-space',
						// 'value' => $_GET['space'],
						// 'compare' => 'like',					
					// );
				// }
				
				/* Property Bedrooms Parameter */								
				// if( isset($_GET['property-for']) && ($_GET['property-for'] != 'Any')){
					// $meta_query[] = array(
						// 'key' => 'property-type',
						// 'value' => $_GET['property-for'],
						// 'compare' => 'like',					
					// );
				// }
				
			}
			
			if(isset($_GET['space']) && $_GET['space'] <> ''){
				$new_space = explode('-',$_GET['space']);
				$min_space = strip_tags($new_space[0]);
				$max_space = strip_tags($new_space[1]);
				// $max_price = str_replace("$", "", $new_price[1], $count);
				// $min_price = str_replace("$", "", $new_price[0], $count);
				// $min_price = '';
				// $max_price = '';
				// if(isset($_GET['min-price']) && $_GET['min-price'] <> ''){
					// $min_price = $_GET['min-price'];
				// }
				
				// if(isset($_GET['max-price']) && $_GET['max-price'] <> ''){
					// $max_price = $_GET['max-price'];
				// }
				/* Logic for Min and Max Price Parameters */
				if( isset($min_space) && ($min_space != 'any') && isset($max_space) && ($max_space != 'any') ){
					
					$min_space = doubleval($min_space);
					$max_space = doubleval($max_space);
					if( $min_space >= 0 && $max_space > $min_space ){
						$meta_query[] = array(
							'key' => 'property-space',
							'value' => array( $min_space, $max_space ),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
					}
				}else if( isset($min_space) && ($min_space != 'any') ){
					$min_space = doubleval($min_space);
					if( $min_space > 0 ){
						$meta_query[] = array(
							'key' => 'property-space',
							'value' => $min_space,
							'type' => 'NUMERIC',
							'compare' => '>='
						);
					}
				}else if( isset($max_space) && ($max_space != 'any') ){
					$max_space = doubleval($max_space);
					if( $max_space > 0 ){
						$meta_query[] = array(
							'key' => 'property-space',
							'value' => $max_space,
							'type' => 'NUMERIC',
							'compare' => '<='
						);
					}
				}
			}
			
			
			if(isset($_GET['max-bed']) && $_GET['max-bed'] <> ''){				
				$min_bed = strip_tags($_GET['min-bed']);
				$max_bed = strip_tags($_GET['max-bed']);
				// $max_price = str_replace("$", "", $new_price[1], $count);
				// $min_price = str_replace("$", "", $new_price[0], $count);
				// $min_price = '';
				// $max_price = '';
				// if(isset($_GET['min-price']) && $_GET['min-price'] <> ''){
					// $min_price = $_GET['min-price'];
				// }
				
				// if(isset($_GET['max-price']) && $_GET['max-price'] <> ''){
					// $max_price = $_GET['max-price'];
				// }
				/* Logic for Min and Max Price Parameters */
				if( isset($min_bed) && ($min_bed != 'any') && isset($max_bed) && ($max_bed != 'any') ){
					
					$min_bed = doubleval($min_bed);
					$max_bed = doubleval($max_bed);
					if( $min_bed >= 0 && $max_bed > $min_bed ){
						$meta_query[] = array(
							'key' => 'property-bed',
							'value' => array( $min_bed, $max_bed ),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
					}
				}else if( isset($min_bed) && ($min_bed != 'any') ){
					$min_bed = doubleval($min_bed);
					if( $min_bed > 0 ){
						$meta_query[] = array(
							'key' => 'property-bed',
							'value' => $min_bed,
							'type' => 'NUMERIC',
							'compare' => '>='
						);
					}
				}else if( isset($max_bed) && ($max_bed != 'any') ){
					$max_bed = doubleval($max_bed);
					if( $max_bed > 0 ){
						$meta_query[] = array(
							'key' => 'property-bed',
							'value' => $max_bed,
							'type' => 'NUMERIC',
							'compare' => '<='
						);
					}
				}
			}
			
			
			// $max_price = '';
			// $min_price = '';
			// $new_price = '';
			if(isset($_GET['price']) && $_GET['price'] <> ''){
				$new_price = explode('-',$_GET['price']);
				$min_price = preg_replace('/[^0-9]/s', '', $new_price[0]);
				$max_price = preg_replace('/[^0-9]/s', '', $new_price[1]);	
				// $max_price = str_replace("$", "", $new_price[1], $count);
				// $min_price = str_replace("$", "", $new_price[0], $count);
				// $min_price = '';
				// $max_price = '';
				// if(isset($_GET['min-price']) && $_GET['min-price'] <> ''){
					// $min_price = $_GET['min-price'];
				// }
				
				// if(isset($_GET['max-price']) && $_GET['max-price'] <> ''){
					// $max_price = $_GET['max-price'];
				// }
				/* Logic for Min and Max Price Parameters */
				if( isset($min_price) && ($min_price != 'any') && isset($max_price) && ($max_price != 'any') ){
					
					$min_price = doubleval($min_price);
					$max_price = doubleval($max_price);
					if( $min_price >= 0 && $max_price > $min_price ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => array( $min_price, $max_price ),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
					}
				}else if( isset($min_price) && ($min_price != 'any') ){
					$min_price = doubleval($min_price);
					if( $min_price > 0 ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => $min_price,
							'type' => 'NUMERIC',
							'compare' => '>='
						);
					}
				}else if( isset($max_price) && ($max_price != 'any') ){
					$max_price = doubleval($max_price);
					if( $max_price > 0 ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => $max_price,
							'type' => 'NUMERIC',
							'compare' => '<='
						);
					}
				}
			}
			
			if(isset($_GET['min-price']) && $_GET['min-price'] <> ''){
				// $new_price = explode('-',$_GET['price']);
				$min_price = strip_tags($_GET['min-price']);
				$max_price = strip_tags($_GET['max-price']);
				// $max_price = str_replace("$", "", $new_price[1], $count);
				// $min_price = str_replace("$", "", $new_price[0], $count);
				// $min_price = '';
				// $max_price = '';
				// if(isset($_GET['min-price']) && $_GET['min-price'] <> ''){
					// $min_price = $_GET['min-price'];
				// }
				
				// if(isset($_GET['max-price']) && $_GET['max-price'] <> ''){
					// $max_price = $_GET['max-price'];
				// }
				/* Logic for Min and Max Price Parameters */
				if( isset($min_price) && ($min_price != 'any') && isset($max_price) && ($max_price != 'any') ){
					
					$min_price = doubleval($min_price);
					$max_price = doubleval($max_price);
					if( $min_price >= 0 && $max_price > $min_price ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => array( $min_price, $max_price ),
							'type' => 'NUMERIC',
							'compare' => 'BETWEEN'
						);
					}
				}else if( isset($min_price) && ($min_price != 'any') ){
					$min_price = doubleval($min_price);
					if( $min_price > 0 ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => $min_price,
							'type' => 'NUMERIC',
							'compare' => '>='
						);
					}
				}else if( isset($max_price) && ($max_price != 'any') ){
					$max_price = doubleval($max_price);
					if( $max_price > 0 ){
						$meta_query[] = array(
							'key' => 'property-price',
							'value' => $max_price,
							'type' => 'NUMERIC',
							'compare' => '<='
						);
					}
				}
			}
		
			// /* if more than one taxonomies exist then specify the relation */
			if( isset($_GET['listing-type']) && ($_GET['listing-type'] != 'any') ){
				$list_type = $_GET['listing-type'];
				
				$tax_query[] = array(
					'taxonomy' => 'status',
					'field'=> 'term_id',
					'terms' => array($list_type),
					'operator' => 'IN'
				);
			
			}
			
			$tax_count = count( $tax_query );
			if( $tax_count > 1 ){
				$tax_query['relation'] = 'AND';
			}

			/* if more than one meta query elements exist then specify the relation */
			$meta_count = count( $meta_query );
			if( $meta_count > 1 ){
				$meta_query['relation'] = 'AND';
			}
			
			
			
			

			if( $tax_count > 0 ){
				$search_args['tax_query'] = $tax_query;
			}

			/* if meta query has some values then add it to base home page query */
			
			$search_args['meta_query'] = $meta_query;
			

			/* Sort By Price */
			if( (isset($min_price) && ($min_price != 'any')) || ( isset($max_price) && ($max_price != 'any') ) ){
				$search_args['orderby'] = 'meta_value_num';
				$search_args['meta_key'] = 'property-price';
				$search_args['order'] = 'ASC';
			}
			
			if( (isset($min_space) && ($min_space != 'any')) || ( isset($max_space) && ($max_space != 'any') ) ){
				$search_args['orderby'] = 'meta_value_num';
				$search_args['meta_key'] = 'property-space';
				$search_args['order'] = 'ASC';
			}
			
			

			return $search_args;
		}
	}
	add_filter('kodesearch_parameters','kodeproperty_search_sidebar');
	
	
	
	if(!function_exists('kodeproperty_get_all_posted_country')){
		function kodeproperty_get_all_posted_country(){
			$property_argu = array(
				'post_type' => 'property',
				'posts_per_page' => -1,				
			);
									
			$prop_query = new WP_Query( $property_argu );	
			$property_loc = array();
			while ( $prop_query->have_posts() ) {
				$prop_query->the_post();
				global $post,$product;
				$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
				if( !empty($kodeproperty_post_option) ){
					$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );
				}
				$property_price = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
				//$property_price = $kodeproperty_post_option['property-price'];
				$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
				if($property_lat == ''){
					$property_lat = '-37.8172141';
				}
				$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
				if($property_long == ''){
					$property_long = '144.95592540000007';
				}
				// $property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
				// if($property_loc == ''){
					// $property_loc = ' no address ';
				// }	
				$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
				if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
					if(!empty($kode_map_data)){
						$kode_map_data = json_decode($kode_map_data);
						$status = $kode_map_data->status;
						$address = '';
						$property_city = '';
						$property_area = '';
						$property_country = '';
						$property_state = '';
						if($status == "OK"){
							$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
							$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
							$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
							// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
						}else{
							$property_area = 'No Area Found';
							$property_city = 'No City Found';
						}
						$property_loc[$property_country] = $property_city;
					}
				}
			}
			wp_reset_postdata();
			return $property_loc;
		}	
	}
	
	if(!function_exists('kodeproperty_get_all_posted_country_list')){
		function kodeproperty_get_all_posted_country_list(){
			$property_argu = array(
				'post_type' => 'property',
				'posts_per_page' => -1,
			);
									
			$prop_query = new WP_Query( $property_argu );	
			$property_loc = array();
			while ( $prop_query->have_posts() ) {
				$prop_query->the_post();
				global $post,$product;
				$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
				if( !empty($kodeproperty_post_option) ){
					$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );
				}
				$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
				$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
				if($property_lat == ''){
					$property_lat = '-37.8172141';
				}
				$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
				if($property_long == ''){
					$property_long = '144.95592540000007';
				}
				// $property_loc = (empty($kodeproperty_post_option['property-location']))? 'no address': $kodeproperty_post_option['property-location'];	
				// if($property_loc == ''){
					// $property_loc = 'no address';
				// }	
				$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
				if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
					if(!empty($kode_map_data)){
						$kode_map_data = json_decode($kode_map_data);
						$status = $kode_map_data->status;
						$address = '';
						$property_city = '';
						$property_area = '';
						$property_country = '';
						$property_state = '';
						if($status == "OK"){
							$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
							$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
							$property_country = $kode_map_data->results[0]->address_components[5]->long_name;
							$property_state = $kode_map_data->results[0]->address_components[4]->long_name;							
							
						}else{
							$property_area = 'No Area Found';
							$property_city = 'No City Found';
						}
						
						$property_loc[$property_lat.'-'.$property_long] = $property_country;
					}
				}
			}
			wp_reset_postdata();
			return $property_loc;
		}	
	}
	
	if(!function_exists('kodeproperty_get_all_posted_country_list_vc')){
		function kodeproperty_get_all_posted_country_list_vc(){
			$property_argu = array(
				'post_type' => 'property',
				'posts_per_page' => -1,
			);
									
			$prop_query = new WP_Query( $property_argu );	
			$property_loc = array();
			while ( $prop_query->have_posts() ) {
				$prop_query->the_post();
				global $post,$product;
				$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
				if( !empty($kodeproperty_post_option) ){
					$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );
				}
				$property_price = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
				$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
				if($property_lat == ''){
					$property_lat = '-37.8172141';
				}
				$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
				if($property_long == ''){
					$property_long = '144.95592540000007';
				}
				// $property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
				// if($property_loc == ''){
					// $property_loc = ' no address ';
				// }	
				$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
				if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
					if(!empty($kode_map_data)){
						$kode_map_data = json_decode($kode_map_data);
						$status = $kode_map_data->status;
						$address = '';
						$property_city = '';
						$property_area = '';
						$property_country = '';
						$property_state = '';
						if($status == "OK"){
							$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
							$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
							$property_country = $kode_map_data->results[0]->address_components[5]->long_name;
							$property_state = $kode_map_data->results[0]->address_components[4]->long_name;							
							
						}else{
							$property_area = 'No Area Found';
							$property_city = 'No City Found';
						}
						$property_loc[$property_country] = $property_lat.'-'.$property_long;
					}
				}
			}
			wp_reset_postdata();
			return $property_loc;
		}	
	}
	
	function get_all_get(){
		$output = "?"; 
		$firstRun = true; 
		foreach($_GET as $key=>$val) {
			if($key != $parameter) {
				if(!$firstRun) { 
					$output .= "&"; 
				} else { 
					$firstRun = false; 
				} 
				$output .= $key."=".$val;
			} 
		} 
		return $output;
	}  
	
	if(!function_exists('kodeproperty_get_search_form_result')){
		function kodeproperty_get_search_form_result(){
			global $post;
			$property = '';
			$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
			if(isset($kodeproperty_plugin_option['property-search-page'])){
				if($kodeproperty_plugin_option['property-search-page'] == $post->ID){
					$layout_select_full = add_query_arg( 'style', 'full' , esc_url(get_permalink()) );	
					$layout_select_grid = add_query_arg( 'style', 'grid' , esc_url(get_permalink()) );	
					$layout_select_modern = add_query_arg( 'style', 'modern' , esc_url(get_permalink()) );
					$layout_select_simple = add_query_arg( 'style', 'simple' , esc_url(get_permalink()) );	
					// $property .= kodeproperty_get_search_form();
					$property .= '<div class="container">';
						$property .= '<div class="row">';
						
						$property .= '<!--Property Meta Wrap Start-->
							<div class="kf_property_meta">
								<h5>'.esc_attr__('Listado de Propiedades','kode-property-list').'</h5>
								
								<form action="'.esc_url(get_permalink()).'" method="get">								
									<div class="kf_view_type">
										<div class="kf_property_view">
											<span>'.esc_attr__('Ver po por:','kode-property-list').'</span>
											<select onchange="this.form.submit()" name="orderby" class="chosen-select">
												<option>'.esc_attr__('Todos','kode-property-list').'</option>';
												$property .= '
												<option ';
												if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){$property  .= 'selected';}
												$property .= '
												 value="date">'.esc_attr__('Fecha Publicación','kode-property-list').'</option>';
												$property .= '
												<option ';
												if(isset($_GET['orderby']) && $_GET['orderby'] == 'title'){$property  .= 'selected';}
												$property .= ' value="title">'.esc_attr__('Titulo','kode-property-list').'</option> <option ';							
												if(isset($_GET['orderby']) && $_GET['orderby'] == 'rand'){$property  .= 'selected';}
												$property .= ' 
												 value="rand">'.esc_attr__('Aleatorio','kode-property-list').'</option>
											</select>						
										</div>
										
										<div class="kf_property_view">
											<span>'.esc_attr__('Orden por:','kode-property-list').'</span>
											<select onchange="this.form.submit()" name="order" class="chosen-select">
												<option >'.esc_attr__('Todos','kode-property-list').'</option>';
												$property .= '<option '; if(isset($_GET['order']) && $_GET['order'] == 'asc'){$property  .= 'selected';} 
												$property .= ' value="asc">'.esc_attr__('Ascendiente','kode-property-list').'</option>
												<option ';
												if(isset($_GET['order']) && $_GET['order'] == 'desc'){$property  .= 'selected';} 
												$property .= ' value="desc">'.esc_attr__('Descendiente','kode-property-list').'</option>
											</select>
										</div>
										
										<div class="kf_property_view">
											<span>'.esc_attr__('Modo de Vista:','kode-property-list').'</span>
											<a href="'.esc_url($layout_select_full).'"><i class="fa fa-th-list"></i></a>
											<a href="'.esc_url($layout_select_grid).'"><i class="fa fa-th-large"></i></a>
											<a href="'.esc_url($layout_select_modern).'"><i class="fa fa-bars"></i></a>
											<a href="'.esc_url($layout_select_simple).'"><i class="fa fa-cog"></i></a>											
										</div>
									</div>
								</form>
							</div>';
							$property .= '<div class="col-md-3">';
								// $property .= '
								// <div class="widget-filter aside_hdg">
									// <h5>'.esc_attr__('Your Search Filter','kode-property-list').'</h5>
									// <p>Add Filter to get exact what you are looking for.</p>
									// <div class="choose-one">';
									 
									// if(isset($_GET)){
										// $property .= '<ul>';
										// $keyword_val = add_query_arg( 'keyword', $_GET['keyword'] , esc_url(get_permalink($kodeproperty_plugin_option['property-search-page'])) );	
										
										// foreach($_GET as $key => $value){
											
											// if($key == 'keyword'){
													
											// }else{
												
												// $meta_val = add_query_arg( $key, $value , esc_url($keyword_val) );	
												  // $property .= '<li>';
													  // $property .= '<span>'.$key.' : '.$value.' </span>';
													  // $property .= '<a href="'.esc_url($meta_val).'"> <i class="fa fa-times"></i></a>';
												  // $property .= '</li>';
											// }
										// }
										// $property .= '</ul>';
									// }
									// $property .= '	
									// </div>
								// </div>';
								$property .= '	
								<form id="search-property" action="" data-ajax="'.esc_url(KODEPROPERTY_AJAX).'">
									<div class="widget-filter aside_hdg">
										<h5>'.esc_attr__('Search Property','kode-property-list').'</h5>
										<div class="kf_search_field">
											<input type="text" name="keyword" placeholder="Search Here"/>
										</div>
									</div>';
								$property .= '<div class="widget-filter aside_hdg">
									<h5>'.esc_attr__('Property Price Filter','kode-property-list').'</h5>
									<p>'.esc_attr__('Add filter to get exact results you are looking for.','kode-property-list').'</p>
									<div class="choose-one">
										<label>
											<span class="radio">
												<input type="radio" name="price" value="500-1000" data-val="" ';
												if( isset($_GET['price']) && $_GET['price'] == '500-1000' ){ $property .=  'checked';}
												$property .= '
												 />
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">'.esc_attr($kodeproperty_plugin_option['property-currency']).'500-$1000</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="price" value="1001-1500" data-val="" ';
												if(isset($_GET['price']) && $_GET['price'] == '1001-1500'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>												
											</span>
											<span class="option-item">'.esc_attr($kodeproperty_plugin_option['property-currency']).'1001-'.esc_attr($kodeproperty_plugin_option['property-currency']).'1500</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="price" value="2000-3000" data-val="" ';
												if(isset($_GET['price']) && $_GET['price'] == '2000-3000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>												
											</span>
											<span class="option-item">'.esc_attr($kodeproperty_plugin_option['property-currency']).'2000-'.esc_attr($kodeproperty_plugin_option['property-currency']).'3000</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="price" value="3001-4000" data-val="" ';
												if(isset($_GET['price']) && $_GET['price'] == '3001-4000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>												
											</span>
											<span class="option-item">'.esc_attr($kodeproperty_plugin_option['property-currency']).'3001-'.esc_attr($kodeproperty_plugin_option['property-currency']).'4000</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="price" value="4001-5000" data-val="" ';
												if(isset($_GET['price']) && $_GET['price'] == '4001-5000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">'.esc_attr($kodeproperty_plugin_option['property-currency']).'4001-'.esc_attr($kodeproperty_plugin_option['property-currency']).'5000</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="price" value="" ';
												if(isset($_GET['price']) && $_GET['price'] == ''){$property .= 'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">'.esc_attr__('Show All...','kode-property-list').'</span>
										</label>
									</div>
								</div>';
								$property .= '
								<div class="widget-filter aside_hdg">
									<h5>Space in Sqft</h5>
									<p>Add Filter to get exact what you are looking for.</p>
									<div class="choose-one">
										<label>
											<span class="radio">
												<input type="radio" name="space" value="0-1000"  data-val="" ';
												if(isset($_GET['space']) && $_GET['space'] == '0-1000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">'.esc_attr__('Less than 1000 sqft','kode-property-list').'</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="space" value="1000-2000" data-val="" ';
												if(isset($_GET['space']) && $_GET['space'] == '1000-2000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">1000 sqft - 2000 sqft</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="space" value="2001-3000" data-val="" ';
												if(isset($_GET['space']) && $_GET['space'] == '2001-3000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>												
											</span>
											<span class="option-item">2001 sqft - 3000 sqft</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="space" value="3001-4000" data-val="" ';
												if(isset($_GET['space']) && $_GET['space'] == '3001-4000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">3001 sqft - 4000 sqft</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="space" value="4001-5000" data-val="" ';
												if(isset($_GET['space']) && $_GET['space'] == '4001-5000'){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">4001 sqft - 5000 sqft</span>
										</label>
										<label>
											<span class="radio">
												<input type="radio" name="space" value="" data-val="" ';
												if(isset($GET['space']) && $GET['space'] == ''){$property .=  'checked';}
												$property .= '
												>
												<span class="radio-value" aria-hidden="true"></span>
											</span>
											<span class="option-item">'.esc_attr__('Show All...','kode-property-list').'</span>
										</label>
									</div>
								</div>';
								$property .= '
								<div class="widget-filter aside_hdg">
									<h5>'.esc_attr__('Country','kode-property-list').'</h5>
									<p>'.esc_attr__('Add Filter to get exact what you are looking for.','kode-property-list').'</p>
									<div class="choose-one">';
										$country_list = kodeproperty_get_all_posted_country();									
										foreach($country_list as $country => $city){
											$country;
											$city;
											$property .= '
												<label>
													<span class="radio">
														<input type="radio" name="location" value="'.esc_attr($country).'"  data-val="" ';
														if(isset($_GET['location']) && $_GET['location'] == $country){$property .=  'checked';}
														$property .= '
														>
														<span class="radio-value" aria-hidden="true"></span>
													</span>
													<span class="option-item">'.esc_attr($country).'</span>
												</label>';
										}
										$property .= '
									</div>
									<div class="widget-filter aside_hdg">
										<h5>'.esc_attr__('City','kode-property-list').'</h5>
										<p>'.esc_attr__('Add Filter to get exact what you are looking for.','kode-property-list').'</p>
										<div class="choose-one">';
										$country_list = kodeproperty_get_all_posted_country();
										// print_r($country_list);
											foreach($country_list as $country => $city){
												$country;
												$city;
												$property .= '
													<label>
														<span class="radio">
															<input type="radio" name="location" value="'.esc_attr($city).'"  data-val="" ';
															if(isset($_GET['location']) && $_GET['location'] == $city){$property .=  'checked';}
															$property .= '
															>
															<span class="radio-value" aria-hidden="true"></span>
														</span>
														<span class="option-item">'.esc_attr($city).'</span>
													</label>';
											}
											$property .= '
										</div>
									</div>
									<div class="filter-btn">
										<div class="kodehotel-form-loading kodehotel-form-instant-payment-loading">'.esc_attr__('loading', 'kode-property-list').'</div>
										<div class="kode-notice require-field" >'.esc_attr__('Please fill all required fields', 'kode-property-list').'</div>
										<div class="kode-notice alert-message" ></div>
										<div class="kode-profile-loader" ></div>										
										<!--<input type="hidden" name="action" id="action" class="action" value="kode_search_sub_action" />-->
										<input type="submit" id="search-property-btn" value="'.esc_attr__('Get Results','kode-property-list').'" />
									</div>
								</div>';
							$property .= '
							</form>
							</div>';
							$property .= '<div class="col-md-9">';
								$paged = (get_query_var('paged'))? get_query_var('paged') : 1; 
								$property .= '<div class="thebookstore-search">';						
								// echo '<h4>'.esc_attr__('Your Search Listing','kode-property-list').'</h4>';
									$thebookstore = '';
									$kodeproperty_search_args = array(
										'post_type' => 'property',
										'posts_per_page' => -1,
										'paged' => $paged,
										// 'meta_query' => array(
											// 'relation' => 'AND',
											// array(
												// 'key' => 'condition',
												// 'value' => 'used',
												// 'compare' => 'like'
											// ),
											// array(
												// 'key' => 'language',
												// 'value' => 'french',										
												// 'compare' => 'like'
											// )
										// )
									
									);
								
									// Apply Search Filter
									$kodeproperty_search_args = apply_filters('kodesearch_parameters',$kodeproperty_search_args);
									// echo '<pre>';print_r($kodeproperty_search_args);
									
									// $kodeproperty_search_args = kodeproperty_sort_books($kodeproperty_search_args);
									// print_r($kodeproperty_search_args);
									if(isset($_GET['style']) && $_GET['style'] == 'grid'){
										$settings['property-style'] = 'grid-view';
										$settings['thumbnail-size'] = array(350,350);
									}else if(isset($_GET['style']) && $_GET['style'] == 'full'){				
										$settings['property-style'] = 'simple-full-view';
										$settings['thumbnail-size'] = array(370,225);
									}else if(isset($_GET['style']) && $_GET['style'] == 'modern'){				
										$settings['property-style'] = 'modern-full-view';
										$settings['thumbnail-size'] = array(350,350);
									}else if(isset($_GET['style']) && $_GET['style'] == 'simple'){				
										$settings['property-style'] = 'normal-full-view';
										$settings['thumbnail-size'] = array(370,225);
									}else{
										$settings['thumbnail-size'] = array(350,350);
										$settings['property-style'] = 'grid-view';
									}
									
									if(isset($_GET['order']) && $_GET['order'] == 'asc'){
										$kodeproperty_search_args['order'] = 'asc';
									}else if(isset($_GET['order']) && $_GET['order'] == 'desc'){
										$kodeproperty_search_args['order'] = 'desc';
									}else{
										
									}
									
									if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){
										$kodeproperty_search_args['orderby'] = 'date';
									}else if(isset($_GET['order']) && $_GET['order'] == 'title'){
										$kodeproperty_search_args['orderby'] = 'title';
									}else if(isset($_GET['order']) && $_GET['order'] == 'rand'){
										$kodeproperty_search_args['orderby'] = 'rand';
									}else{
										
									}
									$settings['title-num-excerpt'] = 30;
									$search_query = new WP_Query( $kodeproperty_search_args );							
									if ( $search_query->have_posts() ) {
										$post_count = 0;
										$current_size = 0;
										$size = 3;
										$thumbnail_size = 'small-grid-size';
										$property .= '<div class="row books-property-list books-property">';
										while ( $search_query->have_posts() ) {
											$search_query->the_post();
											global $post,$product;
											$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
											if( !empty($kodeproperty_post_option) ){
												$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );
											}
											$property_price = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
											//$property_price = $kodeproperty_post_option['property-price'];
											$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
											$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
											
											$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
											if($property_lat == ''){
												$property_lat = '-37.8172141';
											}
											$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
											if($property_long == ''){
												$property_long = '144.95592540000007';
											}
											$property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
											if($property_loc == ''){
												$property_loc = ' no address ';
											}	
											$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
											if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
												if(!empty($kode_map_data)){
													$kode_map_data = json_decode($kode_map_data);
													$status = $kode_map_data->status;
													$address = '';
													$property_city = '';
													$property_area = '';
													$property_country = '';
													$property_state = '';
													if($status == "OK"){
														$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
														$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
														$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
														// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
													}else{
														$property_area = 'No Area Found';
														$property_city = 'No City Found';
													}	
												}
												
											}
											
											if( $current_size % $size == 0 ){
												$property .=  '<div class="clear"></div>';
											}	
											
											$image_src_full = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
											if($settings['property-style'] == 'simple-full-view'){
												$property .= '
												<div class="kf_listing_03_wrap">
													<div class="kf_property_img_03">
														<figure>
															'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
															<figcaption class="kf_listing_img_des">
																<div class="kf_listing_overlay"></div>
																<a href="'.esc_url($image_src_full[0]).'" data-rel="prettyPhoto[]"><i class="fa fa-plus"></i></a>
															</figcaption>
														</figure>
													</div>
													<div class="kf_listing_03_des">
														<div class="kf_property_caption">
															<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
															<ul class="kf_listing_03_location">
																<li><i class="fa fa-map-marker"></i><a href="#">'.esc_attr($property_loc).'</a></li>
																<li><i class="fa fa-phone"></i><a href="#">'.esc_attr__('888.111.22.444','kode-property-list').'</a></li>
															</ul>
														</div>
														<div class="kf_listing_total">
															<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
														</div>
														
														<p>'.esc_attr(substr(get_the_content(),0,75)).'</p>
														<ul class="kf_property_dolar">
															<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Beds:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-bed']).'</a></li>
															<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Baths:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-bath']).'</a></li>
															<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Space:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
														</ul>';
														if(isset($kodeproperty_plugin_option['property-see-more']) && $kodeproperty_plugin_option['property-see-more'] <> ''){
														$property .= '<a href="'.esc_url(get_permalink()).'" class="kf_sm_btn kf_link_1">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-see-more']).'</a>';
														}
													$property .= '</div>
												</div>';
											}else if($settings['property-style'] == 'normal-full-view'){
												$property .= '
												<div class="kf_listing_03_wrap kf_listing_04_wrap">
													<div class="kf_property_img_03">
														<figure>
															'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
															<figcaption class="kf_listing_img_des">
																<div class="kf_listing_overlay"></div>
																<h3>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h3>
															</figcaption>
														</figure>
													</div>
													<div class="kf_listing_03_des">
														<div class="kf_property_caption">
															<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
															<ul class="kf_listing_03_location">
																<li><i class="fa fa-map-marker"></i><a href="#">'.esc_attr($property_loc).'</a></li>
																<li><i class="fa fa-phone"></i><a href="#">'.esc_attr__('888.111.22.444','kode-property-list').'</a></li>
															</ul>
														</div>
														<ul class="kf_recent_rating">
															<li><a href="#"><i class="fa fa-star-half-full"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
															<li><a href="#"><i class="fa fa-star"></i></a></li>
														</ul>
														<p>'.esc_attr(substr(get_the_content(),0,70)).'</p>
														<ul class="kf_foo_listing_meta">
															<li><i class="fa fa-arrows-alt"></i>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
															<li><i class="fa fa-bed"></i>'.esc_attr__('Bedrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</li>
															<li><i class="icon-bath"></i>'.esc_attr__('Bathrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bath']).'</li>
														</ul>';
														if(isset($kodeproperty_plugin_option['property-see-more']) && $kodeproperty_plugin_option['property-see-more'] <> ''){
														$property .= '<a href="'.esc_url(get_permalink()).'">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-see-more']).'</a>';
														}
													$property .= '</div>
												</div>';
											}else if($settings['property-style'] == 'modern-full-view'){
												$property .= '
												<div class="kf_listing_outer_wrap">
													<div class="kf_property_img">
														<figure>
															'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
														</figure>
													</div>
													<div class="kf_property_place">
														<div class="kf_property_caption">
															<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
															<p><i class="fa fa-map-marker"></i>'.esc_attr($property_loc).'</p>
														</div>
														<h5>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h5>
														<ul class="kf_property_dolar">
															<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Area:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
															<li><i class="fa fa-bed"></i><a href="#">'.esc_attr__('Bedroom:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</a></li>
															<li><i class="fa fa-bed"></i><a href="#">'.esc_attr__('Bathrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bath']).'</a></li>
														</ul>
														<ul class="kf_property_dolar">
															<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Garage:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-garage']).'</a></li>
															<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Space:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
														</ul>';
														if(isset($kodeproperty_plugin_option['property-more-information']) && $kodeproperty_plugin_option['property-more-information'] <> ''){
														$property .= '<a href="'.esc_url(get_permalink()).'" class="kf_property_more">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-more-information']).'</a>';
														}
													$property .= '</div>
												</div>';
											}else if($settings['property-style'] == 'grid-view'){
												if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
													$property .= '<div class="property-full-size-wrapper">';
												}else{
													$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
												}
												
													$property .= '<div class="kf_property_listing_wrap">
														<figure>
															'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
															<figcaption class="kf_listing_detail">
																<span class="kf_listing_overlay"></span>';
																if(isset($kodeproperty_plugin_option['property-view-detail']) && $kodeproperty_plugin_option['property-view-detail'] <> ''){
																	$property .= '<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-view-detail']).'</a>';
																}
															$property .= '	
															</figcaption>
														</figure>
														<div class="kf_property_listing_des">
															<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
															<p>'.esc_attr(substr(get_the_content(),0,70)).'</p>
															<div class="kf_listing_total_price">
																<h4>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h4>
															</div>
															<ul>
																<li>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('Beds','kode-property-list').'</li>
																<li>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('Bath','kode-property-list').' </li>
																<li>'.esc_attr($kodeproperty_post_option['property-garage']).' '.esc_attr__('Garage','kode-property-list').'</li>
																<li>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
															</ul>
														</div>
													</div>
												</div>';
											}else if($settings['property-style'] == 'modern-grid-view'){
												if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
													$property .= '<div class="property-full-size-wrapper">';
												}else{
													$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
												}
												$property .= '
													<div class="kf_property_rent_wrap">
														<figure>
															'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
															<figcaption class="kf_listing_detail">
																<span class="kf_listing_overlay"></span>
																	<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('View Detail','kode-property-list').'</a>	
																<div class="kf_rent_label">';
																$property .= '	<p>'. esc_attr__('Rent','kode-property-list').'</p>';
																$property .= '	
																</div>
															</figcaption>
														</figure>
														<div class="kf_rent_property_des">
															<h6><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h6>
															<ul>
																<li>
																	<i class="fa fa-bed"></i>
																	<p>'.esc_attr__('Bedroom','kode-property-list').' </p>
																	<span>'.esc_attr($kodeproperty_post_option['property-bed']).'</span>
																</li>
																<li>
																	<i class="icon-bath"></i>
																	<p>'.esc_attr__('Bathroom','kode-property-list').'</p>
																	<span>'.esc_attr($kodeproperty_post_option['property-bath']).'</span>
																</li>
																<li>
																	<i class="fa fa-car"></i>
																	<p>'.esc_attr__('Garage','kode-property-list').'</p>
																	<span>'.esc_attr($kodeproperty_post_option['property-garage']).'</span>
																</li>
															</ul>
														</div>
														<div class="kf_rent_location">
															<h6><i class="fa fa-map-marker"></i>'.esc_attr($property_city).'</h6>
															<div class="kf_rent_total_price">
																<h6>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h6>
															</div>
														</div>
													</div>
												</div>';
											}else{
													if(isset($settings['property-listing-type']) && $settings['property-listing-type'] == 'slider'){
														$property .= '<div class="property-full-size-wrapper">';
													}else{
														$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
													}
													$property .= '
													<div class="kf_property_listing_wrap">
														<figure>
															'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
															<figcaption class="kf_listing_detail">
																<span class="kf_listing_overlay"></span>
																<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('View Detail','kode-property-list').'</a>
															</figcaption>
														</figure>
														<div class="kf_property_listing_des">
															<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
															<p>'.esc_attr(substr(get_the_content(),0,70)).'</p>
															<div class="kf_listing_total_price">
																<h4>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h4>
															</div>
															<ul>
																<li>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('Beds','kode-property-list').'</li>
																<li>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('Bath','kode-property-list').' </li>
																<li>'.esc_attr($kodeproperty_post_option['property-garage']).' '.esc_attr__('Garage','kode-property-list').'</li>
																<li>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
															</ul>
														</div>
													</div>
												</div>';
											}											
											$current_size++;
										}
										wp_reset_postdata();
										$property .= '</div>';
										$property .= kodeproperty_get_pagination($search_query->max_num_pages, $paged);
									}else{
										$property .= '<div class="alert-wrapper"><h4>'. esc_attr__('No Property Found!', 'kode-property-list').'</h4></div>
										<a class="go-back-alt" href="'.esc_url(get_permalink($kodeproperty_plugin_option['property-search-page'])).'" >'.esc_attr__('Go Back','kode-property-list').'</a>
										';
									}				
									
								$property .= '</div>';					
							$property .= '</div>';
						$property .= '</div>';
					$property .= '</div>';
					
					echo $property;
				}
			}
		}
	}
	
	
	if( !function_exists('kodeproperty_property_slider') ){
		function kodeproperty_property_slider($settings){
			
			
			$args = array('post_type' => 'property', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : 1;

			if( !empty($settings['features']) || (!empty($settings['status'])) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['features']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['features']), 'taxonomy'=>'features', 'field'=>'slug'));
				}
				if( !empty($settings['status'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['status']), 'taxonomy'=>'status', 'field'=>'slug'));
				}				
			}			
			

			// create the property filter
			$settings['num-excerpt'] = empty($settings['num-excerpt'])? 0: $settings['num-excerpt'];
			$query = new WP_Query( $args );
			$settings['title-num-excerpt'] = (empty($settings['title-num-excerpt']))? '15': $settings['title-num-excerpt'];
			$current_size = 0;
			$ret = '<div class="kode-property-bxslider-custom-class"><ul class="banner_bxslider bxslider" data-mode="fade">';
			while($query->have_posts()){ $query->the_post();
				global $kodeproperty_post_option,$post,$kodeproperty_post_settings;
				$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
				if( !empty($kodeproperty_post_option) ){
					$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );					
				}
				$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
				$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
				$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
				if($property_lat == ''){
					$property_lat = '-37.8172141';
				}
				$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
				if($property_long == ''){
					$property_long = '144.95592540000007';
				}
				$property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
				if($property_loc == ''){
					$property_loc = ' no address ';
				}	
				$kodeproperty_post_option['property-bed'] = (empty($kodeproperty_post_option['property-bed']))? ' ': $kodeproperty_post_option['property-bed'];	
				if($kodeproperty_post_option['property-bed'] == ''){
					$kodeproperty_post_option['property-bed'] = '';
				}
				$kodeproperty_post_option['property-bath'] = (empty($kodeproperty_post_option['property-bath']))? ' ': $kodeproperty_post_option['property-bath'];	
				if($kodeproperty_post_option['property-bath'] == ''){
					$kodeproperty_post_option['property-bath'] = '';
				}
				$kodeproperty_post_option['property-space'] = (empty($kodeproperty_post_option['property-space']))? ' ': $kodeproperty_post_option['property-space'];	
				if($kodeproperty_post_option['property-space'] == ''){
					$kodeproperty_post_option['property-space'] = '';
				}
				$kodeproperty_post_option['property-garage'] = (empty($kodeproperty_post_option['property-garage']))? ' ': $kodeproperty_post_option['property-garage'];	
				if($kodeproperty_post_option['property-garage'] == ''){
					$kodeproperty_post_option['property-garage'] = '';
				}
				$ret .= '
				<li>
					'.get_the_post_thumbnail($post->ID, 'full').'
					<!--Schedule Visit Wrap Start-->
					<div class="kf_schedule_wrap">
						<h3>'.esc_attr(substr(get_the_title(),0,10)).'</h3>
						<p>'.esc_attr($property_loc).'</p>
						<ul class="kf_schedule_room">
							<li>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('Bedroom','kode-property-list').' </li>
							<li>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('Bathroom','kode-property-list').' </li>
							<li>'.esc_attr($kodeproperty_post_option['property-space']).' '.esc_attr__('Sq Ft Area','kode-property-list').' </li>
						</ul>
						<div class="kf_schedule_visit">
							<h4>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h4>
							<a href="'.esc_url(get_permalink()).'">'.esc_attr__('Schedule Visit','kode-property-list').'</a>
						</div>
					</div>
					<!--Schedule Visit Wrap End-->
				</li>';
			}	
			$ret .= '</ul></div>';
			wp_reset_postdata();
			return $ret;
		}
	}
	
	
	if( !function_exists('kodeproperty_modern_list_property') ){
		function kodeproperty_modern_list_property($settings){
			
			$args = array('post_type' => 'property', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$settings['list-post'] = (empty($settings['list-post']))? '': $settings['list-post'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : 1;

			if( !empty($settings['features']) || (!empty($settings['status'])) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['features']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['features']), 'taxonomy'=>'features', 'field'=>'slug'));
				}
				if( !empty($settings['status'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['status']), 'taxonomy'=>'status', 'field'=>'slug'));
				}				
			}			
			

			// create the property filter
			$settings['num-excerpt'] = empty($settings['num-excerpt'])? 0: $settings['num-excerpt'];
			
			$settings['title-num-excerpt'] = (empty($settings['title-num-excerpt']))? '15': $settings['title-num-excerpt'];
			$current_size = 0;
			$property_post = get_post($settings['list-post']);
			$property_post_id = $property_post->ID;
			$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta($settings['list-post'], 'post-option', true ));
			if( !empty($kodeproperty_post_option) ){
				$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );					
			}
			$property_price = $kodeproperty_post_option['property-price'];
			$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
			$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
			$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
			if($property_lat == ''){
				$property_lat = '-37.8172141';
			}
			$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
			if($property_long == ''){
				$property_long = '144.95592540000007';
			}
			$property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
			if($property_loc == ''){
				$property_loc = ' no address ';
			}				
			$kode_map_data = get_post_meta($settings['list-post'],'kode-map-data',true);
			if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
				if(!empty($kode_map_data)){
					$kode_map_data = json_decode($kode_map_data);
					$status = $kode_map_data->status;
					$address = '';
					$property_city = '';
					$property_area = '';
					$property_country = '';
					$property_state = '';
					if($status == "OK"){
						$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
						$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
						$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
						// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
					}else{
						$property_area = 'No Area Found';
						$property_city = 'No City Found';
					}	
				}
				
			}
			if(isset($settings['style']) && $settings['style'] == 'full'){
			$ret = '<div class="col-md-12">
			<div class="kf_recent_property_wrap">
				<figure>
					'.get_the_post_thumbnail($property_post->ID, $settings['thumbnail-size']).'
				</figure>
				<div class="kf_like_property">
					<a href="#"><i class="fa fa-heart"></i></a>
				</div>
				<div class="kf_recent_visible_des">
					<h5>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h5>
					<p>'.esc_attr($property_city).'</p>
				</div>
				<div class="kf_recent_property_des">
					<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
					<p>'.substr($property_post->post_content,0,100).'</p>
					
					<ul class="kf_recent_rating">
						<li><a href="#"><i class="fa fa-star"></i></a></li>
						<li><a href="#"><i class="fa fa-star"></i></a></li>
						<li><a href="#"><i class="fa fa-star"></i></a></li>
						<li><a href="#"><i class="fa fa-star"></i></a></li>
						<li><a href="#"><i class="fa fa-star-half-full"></i></a></li>
					</ul>
					
					<div class="kf_recent_property_meta">
						<ul>
							<li>
								<i class="fa fa-list"></i>
								<div class="kf_recent_meta_des">
									<p>'.esc_attr__('Listing ID: 1234','kode-property-list').'</p>
								</div>
							</li>
							
							<li>
								<i class="fa fa-map-marker"></i>
								<div class="kf_recent_meta_des">
									<p>'.esc_attr__('Location','kode-property-list').': '.esc_attr($property_area).' - '.esc_attr($property_city).'</p>
								</div>
							</li>
							
							<li>
								<i class="fa fa-dollar"></i>
								<div class="kf_recent_meta_des">
									<p>'.esc_attr__('Type: For','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-type']).'</p>
								</div>
							</li>
							
							<li>
								<i class="fa fa-bed"></i>
								<div class="kf_recent_meta_des">
									<p>'.esc_attr__('Bedrooms :','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</p>
								</div>
							</li>
						</ul>
					</div>
					
					<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('Book Now','kode-property-list').'</a>
				</div>
			</div></div>';
			}else{
				$ret = '<div class="kode-compact-style col-md-12"><div class="kf_recent_property_wrap">
					<figure>
						'.get_the_post_thumbnail($settings['list-post'], $settings['thumbnail-size']).'
					</figure>
					<div class="kf_like_property">
						<a href="'.esc_url(get_permalink()).'"><i class="fa fa-heart"></i></a>
					</div>
					<div class="kf_recent_visible_des">
						<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
						<p>'.esc_attr($property_loc).'</p>
					</div>
					<div class="kf_recent_property_des">
						<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
						<p>'.esc_attr(substr($property_post->post_content,0,50)).'</p>
						<a href="'.esc_url(get_permalink($settings['list-post'])).'" class="kode-size-medium kode_link_1">'.esc_attr__('Book Now','kode-property-list').'</a>
					</div>
				</div></div>';
			}
			return $ret;
		}
	}
	
	
	
	if( !function_exists('kodeproperty_get_property_info') ){
		function kodeproperty_get_property_info( $property_id='', $array = array(), $wrapper = true, $sep = '',$div_wrap = 'div' ){
			global $kodeproperty_plugin_option; $ret = '';
			if( empty($array) ) return $ret;
			//$exclude_meta = empty($kodeproperty_plugin_option['post-meta-data'])? array(): esc_attr($kodeproperty_plugin_option['post-meta-data']);
			
			foreach($array as $post_info){
				
				if( !empty($sep) ) $ret .= $sep;

				switch( $post_info ){
					case 'date':
						$ret .= '<'.esc_attr($div_wrap).' class="kodeproperty-info kodeproperty-date"><i class="fa fa-clock-o"></i>';
						$ret .= '<a href="' . esc_url(get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d'))) . '">';
						$ret .= esc_attr(get_the_time());
						$ret .= '</a>';
						$ret .= '</'.esc_attr($div_wrap).'>';
						break;
					case 'features':
						$tag = get_the_term_list($property_id, 'features', '', ' ' , '' );
						if(empty($tag)) break;					
						
						$ret .= '<'.esc_attr($div_wrap).' class="kodeproperty-info kodeproperty-tags">';
						$ret .= $tag;						
						$ret .= '</'.esc_attr($div_wrap).'>';					
						break;
					case 'status':
						$category = get_the_term_list($property_id, 'status', '', ' ' , '' );
						if(empty($category)) break;
						
						$ret .= '<'.esc_attr($div_wrap).' class="kodeproperty-info kodeproperty-category">';
						$ret .= $category;					
						$ret .= '</'.esc_attr($div_wrap).'>';			
						break;
					case 'comment':
						$ret .= '<'.esc_attr($div_wrap).' class="kodeproperty-info kodeproperty-comment"><i class="fa fa-comment-o"></i>';
						$ret .= '<a href="' . esc_url(get_permalink($property_id)) . '#respond" >' . esc_attr(get_comments_number()) . ' Comments</a>';						
						$ret .= '</'.esc_attr($div_wrap).'>';					
						break;
					case 'author':
						ob_start();
						the_author_posts_link();
						$author = ob_get_contents();
						ob_end_clean();
						
						$ret .= '<'.esc_attr($div_wrap).' class="kodeproperty-info kodeproperty-author"><i class="fa fa-user"></i>';
						$ret .= $author;
						$ret .= '</'.esc_attr($div_wrap).'>';			
						break;						
				}
			}
			
			
			if($wrapper && !empty($ret)){
				return '<div class="kode-kodeproperty-info kode-info-new">' . $ret . '<div class="clear"></div></div>';
			}else if( !empty($ret) ){
				return $ret;
			}
			return '';			
		}
	}
	
	// Related Posts Function, matches posts by tags - call using joints_related_posts(); )
	if( !function_exists('kodeproperty_related_property') ){
		function kodeproperty_related_property($post_id) {
			global $post,$kodeproperty_plugin_option;
			$tags = wp_get_post_terms($post_id, 'status', array("fields" => "all"));
			$tag_arr = '';
			if($tags) {
				$tag_array = array();
				foreach( $tags as $tag ) {
					$tag_arr .= $tag->slug . ',';			
				}
				
				if( !empty($tag_arr)){
					$args['tax_query'] = array('relation' => 'OR');
					
					if( !empty($tag_arr)){
						array_push($args['tax_query'], array('terms'=>explode(',', $tag_arr), 'taxonomy'=>'status', 'field'=>'slug'));
					}				
				}
				
				$args['post_type'] = 'property';
				$args['numberposts'] = 3;
				$args['post__not_in'] = array($post_id);
				
				$related_posts = get_posts( $args );			
				if($related_posts) {
					echo '<div class="kf_related_property">';
					echo '<h5>'.esc_attr__("Propiedades Relacionadas","kode-property").'</h5>';
					echo '<div class="row">';
						foreach ( $related_posts as $post ) : setup_postdata( $post );
						$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta($post->ID, 'post-option', true ));
						if( !empty($kodeproperty_post_option) ){
							$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );					
						}
						$address = '';
						$property_city = '';
						$property_area = '';
						$property_country = '';
						$property_state = '';
						$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
						$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
						$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
						if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
							if(!empty($kode_map_data)){
								$kode_map_data = json_decode($kode_map_data);
								$status = $kode_map_data->status;
								
								if($status == "OK"){
									$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
									$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
									$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
									// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
								}else{
									$property_area = 'No Area Found';
									$property_city = 'No City Found';
								}	
							}
							
						}
						$image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');?>
							
							<div class="col-md-4">
								<div class="kf_property_rent_wrap">
									<figure>
										<img alt="<?php the_title(); ?>" src="<?php echo esc_url($image_src[0])?>">
										<figcaption class="kf_listing_detail">
											<span class="kf_listing_overlay"></span>
											<a class="kode-size-medium kode_link_1" href="<?php echo esc_url(get_permalink())?>"><?php esc_attr_e('Ver Detalles','kode-property-list');?></a>
											<?php if(isset($kodeproperty_plugin_option['for-label']) && $kodeproperty_plugin_option['for-label'] == 'enable'){ ?>
											<div class="kf_rent_label">
												<p><?php echo esc_attr__('Para','kode-property-list');?> <?php echo esc_attr($kodeproperty_post_option['property-type'])?></p>
											</div>
											<?php } ?>
										</figcaption>
									</figure>
									<div class="kf_rent_property_des">
										<h6><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_title());?></a></h6>
										<ul>
											<li>
												<i class="fa fa-bed"></i>
												<p><?php echo esc_attr__('Habitaciones','kode-property-list');?></p>
												<span><?php echo esc_attr($kodeproperty_post_option['property-bed'])?></span>
											</li>
											<li>
												<i class="icon-bath"></i>
												<p><?php esc_attr_e('Baños','kode-property-list');?></p>
												<span><?php echo esc_attr($kodeproperty_post_option['property-bath'])?></span>
											</li>
											<li>
												<i class="fa fa-car"></i>
												<p><?php esc_attr_e('Garaje','kode-property-list');?></p>
												<span><?php echo esc_attr($kodeproperty_post_option['property-garage'])?></span>
											</li>
										</ul>
									</div>
									<div class="kf_rent_location">
										<h6><i class="fa fa-map-marker"></i><?php echo esc_attr($property_city) .' '.esc_attr($property_state);?></h6>
										<div class="kf_rent_total_price">
											<h6><?php echo esc_attr($kodeproperty_post_option['property-currency'])?><?php echo esc_attr($kodeproperty_post_option['property-price'])?></h6>
										</div>
									</div>
								</div>
								
							</div>
						<?php endforeach;
						echo '</div>';
					
				} wp_reset_postdata();
		
				echo '</div>';
			}
		}
	}
	
	
	
	//Package Listing
	if( !function_exists('kodeproperty_get_property_marker_item') ){
		function kodeproperty_get_property_marker_item( $settings ){
			
			// $ddd = kodeproperty_get_all_posted_country_list();
			// $settings['category'];
			// $settings['tag'];
			// $settings['num-excerpt'];
			// $settings['num-fetch'];
			// $settings['property-style'];
			// $settings['scope'];
			// $settings['order'];
			// $settings['margin-bottom'];
			// query posts section
			$args = array('post_type' => 'property', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : 1;
			$margin = (!empty($settings['margin-bottom']))? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
			$margin_style = (!empty($margin))? ' style="' . esc_attr($margin) . '" ': '';
			if( !empty($settings['category']) || (!empty($settings['tag'])) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['features']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['features']), 'taxonomy'=>'features', 'field'=>'slug'));
				}
				if( !empty($settings['status'])){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['status']), 'taxonomy'=>'status', 'field'=>'slug'));
				}				
			}
			if(isset($_GET['style']) && $_GET['style'] == 'grid'){
				$settings['property-style'] = 'grid-view';
			}else if(isset($_GET['style']) && $_GET['style'] == 'full'){				
				$settings['property-style'] = 'simple-full-view';
			}else{
				
			}
			
			if(isset($_GET['order']) && $_GET['order'] == 'asc'){
				$args['order'] = 'asc';
			}else if(isset($_GET['order']) && $_GET['order'] == 'desc'){
				$args['order'] = 'desc';
			}else{
				
			}
			
			if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){
				$args['orderby'] = 'date';
			}else if(isset($_GET['order']) && $_GET['order'] == 'title'){
				$args['orderby'] = 'title';
			}else if(isset($_GET['order']) && $_GET['order'] == 'rand'){
				$args['orderby'] = 'rand';
			}else{
				
			}
			
			$args = apply_filters('kodesearch_parameters',$args);
			$query = new WP_Query( $args );
			global $kodeproperty_plugin_option;
			$kodeproperty_plugin_option['map_zoom'] = (empty($kodeproperty_plugin_option['map_zoom']))? '7': $kodeproperty_plugin_option['map_zoom'];
			
			// create the property filter
			$settings['num-excerpt'] = empty($settings['num-excerpt'])? 0: esc_attr($settings['num-excerpt']);
			$current_size = 0;?>
				<!--<script src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
				<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJpjV0pzrXXJvqePBFPKSQY8TMeJlz87w&libraries=places&sensor=false"></script>-->
				<script type="text/javascript">
					var geocoder = new google.maps.Geocoder();
					var iconURLPrefix = "images";
					var icons = [ <?php
						while($query->have_posts()){
							$query->the_post();
							global $post;
							$property_option = json_decode(kodeproperty_decode_stopbackslashes(get_post_meta($post->ID, 'post-option', true)), true);
							if(isset($property_option['map_icon']) && $property_option['map_icon'] <> ''){
								$map_icon = $property_option['map_icon'];
								if(!empty($property_option['map_icon'])){
									if( is_numeric($property_option['map_icon']) ){
										$image_src = wp_get_attachment_image_src($property_option['map_icon'], 'full');	
										echo $map_icon = "'".esc_url($image_src[0])."',";
									}else{
										echo $map_icon = "'".esc_url($property_option['map_icon'])."',";
									}
								}else{
									echo $map_icon = "'".KODEPROPERTY_PATH_URL.'/images/map-icon-2.png'."',";
								}	
							}else{
								echo $map_icon = "'".KODEPROPERTY_PATH_URL.'/images/map-icon-2.png'."',";
							}
						} ?>								
					];
					
					function kode_initialize(){
						var MY_MAPTYPE_ID = 'custom_style';
						var icons_length = icons.length;
						var shadow = {
						  anchor: new google.maps.Point(16,16),
						  
						  url: iconURLPrefix + 'msmarker.shadow.png'
						};
						var featureOpts = <?php echo kodeproperty_get_property_marker_style($kodeproperty_plugin_option['kode-map-style']);?>;
						var myOptions = {
						  center: new google.maps.LatLng(16,18),
						  mapTypeId: MY_MAPTYPE_ID,
						  mapTypeControl: false,
						  streetViewControl: true,
						  panControl: true,						  
						  scrollwheel: false,
						  draggable: true,	  
						  zoom: <?php echo esc_attr($kodeproperty_plugin_option['map_zoom'])?>,
						}
						var map = new google.maps.Map(document.getElementById("kode_map_canv"), myOptions);
						var styledMapOptions = {
							name: 'Custom Style'
						};

						var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

						map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
						var bounds = new google.maps.LatLngBounds();
						var infowindow = new google.maps.InfoWindow({
						  maxWidth: 350,
						});
						var marker;
						var markers = new Array();
						var iconCounter = 0;
						<?php 
						$counter_map = 0;
						while($query->have_posts()){
							$query->the_post();
							global $post;
							$counter_map++;
							$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
							if( !empty($kodeproperty_post_option) ){
								$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );					
							}
							$property_price = $kodeproperty_post_option['property-price'];
							$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
							$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
							$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
							if($property_lat == ''){
								$property_lat = '-37.8172141';
							}
							$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
							if($property_long == ''){
								$property_long = '144.95592540000007';
							}
							$property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
							if($property_loc == ''){
								$property_loc = ' no address ';
							}
							
							if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
								if(!empty($kode_map_data)){
									$kode_map_data = json_decode($kode_map_data);
									$status = $kode_map_data->status;
									$address = '';
									$property_city = '';
									$property_area = '';
									$property_country = '';
									$property_state = '';
									if($status == "OK"){
										$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
										$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
										$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
										// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
									}else{
										$property_area = 'No Area Found';
										$property_city = 'No City Found';
									}	
								}
								
							}
							if(!empty($kodeproperty_post_option['map_icon'])){
								if( is_numeric($kodeproperty_post_option['map_icon']) ){
									$image_src = wp_get_attachment_image_src($kodeproperty_post_option['map_icon'], 'full');	
									$map_icon = esc_url($image_src[0]);
								}else{
									$map_icon = esc_url($kodeproperty_post_option['map_icon']);
								}
							}	
							
							?>
							var i = <?php echo esc_attr($counter_map);?>;

							marker = new google.maps.Marker({
								position: new google.maps.LatLng(<?php echo esc_attr($property_lat)?>, <?php echo esc_attr($property_long)?>),
								// position: results[0].geometry.location,
								map: map,
								icon : icons[iconCounter],
								panControl:true,
								zoomControl:true,
								mapTypeControl:true,
								scaleControl:true,
								streetViewControl:true,
								overviewMapControl:true,
								rotateControl:true,
								fullscreenControl: true,
								mapTypeControlOptions: {
									style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
									position: google.maps.ControlPosition.TOP_CENTER
								},
								zoomControlOptions: {
									position: google.maps.ControlPosition.LEFT_CENTER
								},
								streetViewControlOptions: {
									position: google.maps.ControlPosition.LEFT_TOP
								},
								animation: google.maps.Animation.DROP,
								shadow: shadow
							});
							
							bounds.extend(marker.position);
							markers.push(marker);
							var markerCluster = new MarkerClusterer(map, markers, {imagePath: '<?php echo KODEPROPERTY_PATH_URL?>/images/m'});
							google.maps.event.addListener(marker, 'click', (function(marker, i) {
								return function() {
									infowindow.setContent('<div class="kf_property_listing_wrap"><figure><?php echo get_the_post_thumbnail($post->ID, array(570,300))?><figcaption class="kf_listing_detail"><span class="kf_listing_overlay"></span><a class="kode-size-medium kode_link_1" href="<?php echo esc_url(get_permalink())?>"><?php esc_attr_e('View Detail','kode-property-list');?></a></figcaption></figure><div class="kf_property_listing_des"><h5><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_title());?></a></h5><p><?php echo esc_attr(strip_tags(substr(get_the_content(),0,80)));?></p><div class="kf_listing_total_price"><h4>$<?php echo esc_attr($property_price);?></h4></div><ul><li><?php echo esc_attr($kodeproperty_post_option['property-bed']);?> <?php esc_attr_e('Beds','kode-property-list');?></li><li><?php echo esc_attr($kodeproperty_post_option['property-bath']);?> <?php esc_attr_e('Bath','kode-property-list');?></li><li><?php echo esc_attr($kodeproperty_post_option['property-garage']);?> <?php esc_attr_e('Garage','kode-property-list');?></li><li><?php echo esc_attr($kodeproperty_post_option['property-space']);?> <?php esc_attr_e('Sqft','kode-property-list');?></li></ul></div></div>');
									infowindow.open(map, marker);
								}
							})(marker, i));
							map.fitBounds(bounds);
							iconCounter++;
							// We only have a limited number of possible icon colors, so we may have to restart the counter
							if(iconCounter >= icons_length){
								iconCounter = 0;
							}
							
						 
						  <?php }
						  wp_reset_postdata();?>
						  
						    // *
							  // START INFOWINDOW CUSTOMIZE.
							  // The google.maps.event.addListener() event expects
							  // the creation of the infowindow HTML structure 'domready'
							  // and before the opening of the infowindow, defined styles are applied.
							  // *
							  google.maps.event.addListener(infowindow, 'domready', function() {

								// Reference to the DIV that wraps the bottom of infowindow
								var iwOuter = jQuery('.gm-style-iw');

								/* Since this div is in a position prior to .gm-div style-iw.
								 * We use jQuery and create a iwBackground variable,
								 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
								*/
								var iwBackground = iwOuter.prev();

								// Removes background shadow DIV
								iwBackground.children(':nth-child(2)').css({'display' : 'none'});

								// Removes white background DIV
								iwBackground.children(':nth-child(4)').css({'display' : 'none'});

								// Moves the infowindow 115px to the right.
								iwOuter.parent().parent().css({left: '115px'});

								// Moves the shadow of the arrow 76px to the left margin.
								iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

								// Moves the arrow 76px to the left margin.
								iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

								// Changes the desired tail shadow color.
								iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

								// Reference to the div that groups the close button elements.
								var iwCloseBtn = iwOuter.next();

								// Apply the desired effect to the close button
								iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: 'none', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

								// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
								if(jQuery('.iw-content').height() < 140){
								  jQuery('.iw-bottom-gradient').css({display: 'none'});
								}

								// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
								iwCloseBtn.mouseout(function(){
								  jQuery(this).css({opacity: '1'});
								});
							  });
					}
						google.maps.event.addDomListener(window, "load", kode_initialize);
				</script>
			<?php 
			if(isset($settings['show-map-as']) && $settings['show-map-as'] == 'map-with-property'){
				$layout_select_full = add_query_arg( 'style', 'full' , esc_url(get_permalink()) );	
				$layout_select_grid = add_query_arg( 'style', 'grid' , esc_url(get_permalink()) );	
				echo '
				<!--Property Meta Wrap Start-->
				<div class="kf_property_meta">
					<div class="col-md-4">
					<div class="kf-ggl-search-field widget widget-search">
						<form class="kode-search" method="get" id="kode-searchform" action="'.esc_url(get_permalink()).'">';
						if(isset($_GET['keyword'])){
							echo '<input type="text" name="keyword" id="keyword" autocomplete="off" data-default="Search Property.." value="'.esc_attr($_GET['keyword']).'" />';
						}else{
							echo '<input type="text" name="keyword" id="keyword" autocomplete="off" data-default="Search Property.." value="" />';
						}
						echo '
						<label><input type="submit" value=""></label>
					  </form>
					</div>
					</div>
					<div class="col-md-8">
					<form action="'.esc_url(get_permalink()).'" method="get">
					<div class="kf_view_type">
						<div class="kf_property_view">
							<span>'.esc_attr__('Sort By:','kode-property-list').'</span>
							<select onchange="this.form.submit()" name="orderby" class="chosen-select">
								<option>Any</option>';
								$property  .= '
								<option ';
								if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){$property  .= 'selected';}
								$property  .= '
								 value="date">'.esc_attr__('Publish Date','kode-property-list').'</option>';
								$property  .= '
								<option ';
								if(isset($_GET['orderby']) && $_GET['orderby'] == 'title'){$property  .= 'selected';}
								$property  .= ' value="title">'.esc_attr__('Title','kode-property-list').'</option> <option ';							
								if(isset($_GET['orderby']) && $_GET['orderby'] == 'rand'){$property  .= 'selected';}
								$property  .= ' 
								 value="rand">'.esc_attr__('Random','kode-property-list').'</option>
							</select>						
						</div>
						
						<div class="kf_property_view">
							<span>Order By:</span>
							<select onchange="this.form.submit()" name="order" class="chosen-select">
								<option >'.esc_attr__('Any','kode-property-list').'</option>';
								$property  .= '<option '; if(isset($_GET['order']) && $_GET['order'] == 'asc'){$property  .= 'selected';} 
								$property  .= ' value="asc">'.esc_attr__('ASC','kode-property-list').'</option>
								<option ';
								if(isset($_GET['order']) && $_GET['order'] == 'desc'){$property  .= 'selected';} 
								$property  .= ' value="desc">'.esc_attr__('DESC','kode-property-list').'</option>
							</select>
						</div>
						
						<div class="kf_property_view">
							<span>'.esc_attr__('Select View:','kode-property-list').'</span>
							<a href="'.esc_url($layout_select_full).'"><i class="fa fa-th-list"></i></a>
							<a href="'.esc_url($layout_select_grid).'"><i class="fa fa-th-large"></i></a>
						</div>
					</div>
					</form>
					</div>
				</div>
				<!--Property Meta Wrap End-->
				<div class="kode-google-map-container">				
				
				<div id="kode_map_canv" class="kode_map kode-ggl-map-pos-abs" '.$margin_style.'></div>';	
			}else{
				echo '<div id="kode_map_canv" class="kode_map" '.$margin_style.'></div>';	
			}
			
			if(isset($settings['show-map-as']) && $settings['show-map-as'] == 'map-with-property'){				
			
				$settings['heading-title'] = (empty($settings['heading-title']))? 'Property Listing': $settings['heading-title'];
				$settings['heading-caption'] = (empty($settings['heading-caption']))? 'Property Listing': $settings['heading-caption'];
				$property .= '<div class="col-md-4">
				<div class="row">
				
				</div>
				</div><div class="kode-property kode-property-classic col-md-8">				
				<div class="kf_heading_1">
					<h3 style="color:#333">'.esc_attr($settings['heading-title']).'</h3>
					<p style="color:#333">'.esc_attr($settings['heading-caption']).'</p>
					<span class="kf_property_line"></span>
				</div>
				<div class="row">';
				if(isset($_GET['style']) && $_GET['style'] == 'grid'){
					$settings['property-style'] = 'grid-view';
				}else if(isset($_GET['style']) && $_GET['style'] == 'full'){				
					$settings['property-style'] = 'simple-full-view';
				}else{
					
				}
				
				if(isset($_GET['order']) && $_GET['order'] == 'asc'){
					$args['order'] = 'asc';
				}else if(isset($_GET['order']) && $_GET['order'] == 'desc'){
					$args['order'] = 'desc';
				}else{
					
				}
				
				if(isset($_GET['orderby']) && $_GET['orderby'] == 'date'){
					$args['orderby'] = 'date';
				}else if(isset($_GET['order']) && $_GET['order'] == 'title'){
					$args['orderby'] = 'title';
				}else if(isset($_GET['order']) && $_GET['order'] == 'rand'){
					$args['orderby'] = 'rand';
				}else{
					
				}
				$map_args = array('post_type' => 'property', 'suppress_filters' => false);
				$map_args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
				$map_args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
				$map_args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
				$map_args['paged'] = (get_query_var('paged'))? get_query_var('paged') : 1;
				$map_args = apply_filters('kodesearch_parameters',$map_args);
				$margin = (!empty($settings['margin-bottom']))? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
				$margin_style = (!empty($margin))? ' style="' . esc_attr($margin) . '" ': '';
				if( !empty($settings['category']) || (!empty($settings['tag'])) ){
					$map_args['tax_query'] = array('relation' => 'OR');
					
					if( !empty($settings['features']) ){
						array_push($map_args['tax_query'], array('terms'=>explode(',', $settings['features']), 'taxonomy'=>'features', 'field'=>'slug'));
					}
					if( !empty($settings['status'])){
						array_push($map_args['tax_query'], array('terms'=>explode(',', $settings['status']), 'taxonomy'=>'status', 'field'=>'slug'));
					}				
				}			
				$map_query = new WP_Query( $map_args );
				$settings['title-num-excerpt'] = (empty($settings['title-num-excerpt']))? '15': $settings['title-num-excerpt'];
				
				$current_size = 0;
				$size = $settings['property-column'];
				
				while($map_query->have_posts()){
					$map_query->the_post();
					global $kodeproperty_post_option,$post,$kodeproperty_post_settings;
						$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
						if( !empty($kodeproperty_post_option) ){
							$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );
						}
						$property_lat = (empty($kodeproperty_post_option['property-lat']))? '-37.8172141': $kodeproperty_post_option['property-lat'];
						if($property_lat == ''){
							$property_lat = '-37.8172141';
						}
						$property_long = (empty($kodeproperty_post_option['property-lon']))? '144.95592540000007': $kodeproperty_post_option['property-lon'];	
						if($property_long == ''){
							$property_long = '144.95592540000007';
						}
						$property_loc = (empty($kodeproperty_post_option['property-location']))? ' no address ': $kodeproperty_post_option['property-location'];	
						if($property_loc == ''){
							$property_loc = ' no address ';
						}
						$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '': $kodeproperty_post_option['property-currency'];
						$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? '': $kodeproperty_post_option['property-price'];
						$kodeproperty_post_option['property-bed'] = (empty($kodeproperty_post_option['property-bed']))? '': $kodeproperty_post_option['property-bed'];
						$kodeproperty_post_option['property-bath'] = (empty($kodeproperty_post_option['property-bath']))? '': $kodeproperty_post_option['property-bath'];
						$kodeproperty_post_option['property-space'] = (empty($kodeproperty_post_option['property-space']))? '': $kodeproperty_post_option['property-space'];
						$kode_map_data = get_post_meta($post->ID,'kode-map-data',true);
						if(isset($kodeproperty_post_option['property-lat']) && $kodeproperty_post_option['property-lat'] <> ''){
							if(!empty($kode_map_data)){
								$kode_map_data = json_decode($kode_map_data);
								$status = $kode_map_data->status;
								$address = '';
								$property_city = '';
								$property_area = '';
								$property_country = '';
								$property_state = '';
								if($status == "OK"){
									$property_city =  $kode_map_data->results[0]->address_components[2]->long_name;
									$property_area =  $kode_map_data->results[0]->address_components[3]->long_name;
									$property_country = $kode_map_data->results[0]->address_components[4]->long_name;
									// $property_state = $kode_map_data->results[0]->address_components[5]->long_name;
								}else{
									$property_area = 'No Area Found';
									$property_city = 'No City Found';
								}	
							}
							
						}
					$image_src_full = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
					if($settings['property-style'] == 'simple-full-view'){
						$property .= '
						<div class="col-md-12">
						<div class="kf_listing_03_wrap">
							<div class="kf_property_img_03">
								<figure>
									'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
									<figcaption class="kf_listing_img_des">
										<div class="kf_listing_overlay"></div>
										<a href="'.esc_url($image_src_full[0]).'" data-rel="prettyPhoto[]"><i class="fa fa-plus"></i></a>
									</figcaption>
								</figure>
							</div>
							<div class="kf_listing_03_des">
								<div class="kf_property_caption">
									<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
									<ul class="kf_listing_03_location">
										<li><i class="fa fa-map-marker"></i><a href="#">'.esc_attr($property_loc).'</a></li>
										<li><i class="fa fa-phone"></i><a href="#">888.111.22.444</a></li>
									</ul>
								</div>
								<div class="kf_listing_total">
									<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
								</div>
								
								<p>'.esc_attr(substr(get_the_content(),0,75)).'</p>
								<ul class="kf_property_dolar">
									<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Beds:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-bed']).'</a></li>
									<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Baths:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-bath']).'</a></li>
									<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Space:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
								</ul>';
								if(isset($kodeproperty_plugin_option['property-see-more']) && $kodeproperty_plugin_option['property-see-more'] <> ''){
								$property .= '<a href="'.esc_url(get_permalink()).'" class="kf_sm_btn kf_link_1">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-see-more']).'</a>';
								}
							$property .= '</div>
						</div></div>';
					}else if($settings['property-style'] == 'normal-full-view'){
						$property .= '
						<div class="col-md-12">
						<div class="kf_listing_03_wrap kf_listing_04_wrap">
							<div class="kf_property_img_03">
								<figure>
									'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
									<figcaption class="kf_listing_img_des">
										<div class="kf_listing_overlay"></div>
										<h3>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h3>
									</figcaption>
								</figure>
							</div>
							<div class="kf_listing_03_des">
								<div class="kf_property_caption">
									<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
									<ul class="kf_listing_03_location">
										<li><i class="fa fa-map-marker"></i><a href="#">'.esc_attr($property_loc).'</a></li>
										<li><i class="fa fa-phone"></i><a href="#">'.esc_attr__('888.111.22.444','kode-property-list').'</a></li>
									</ul>
								</div>
								<ul class="kf_recent_rating">
									<li><a href="#"><i class="fa fa-star-half-full"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
									<li><a href="#"><i class="fa fa-star"></i></a></li>
								</ul>
								<p>'.esc_attr(substr(get_the_content(),0,70)).'</p>
								<ul class="kf_foo_listing_meta">
									<li><i class="fa fa-arrows-alt"></i>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
									<li><i class="fa fa-bed"></i>'.esc_attr__('Bedrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</li>
									<li><i class="icon-bath"></i>'.esc_attr__('Bathrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bath']).'</li>
								</ul>';
								if(isset($kodeproperty_plugin_option['property-see-more']) && $kodeproperty_plugin_option['property-see-more'] <> ''){
								$property .= '<a href="'.esc_url(get_permalink()).'">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-see-more']).'</a>';
								}
							$property .= '</div>
						</div></div>';
					}else if($settings['property-style'] == 'modern-full-view'){
						$property .= '
						<div class="col-md-12">
						<div class="kf_listing_outer_wrap">
							<div class="kf_property_img">
								<figure>
									'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
								</figure>
							</div>
							<div class="kf_property_place">
								<div class="kf_property_caption">
									<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
									<p><i class="fa fa-map-marker"></i>'.esc_attr($property_loc).'</p>
								</div>
								<h5>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h5>
								<ul class="kf_property_dolar">
									<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Area:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
									<li><i class="fa fa-bed"></i><a href="#">'.esc_attr__('Bedroom:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bed']).'</a></li>
									<li><i class="fa fa-bed"></i><a href="#">'.esc_attr__('Bathrooms:','kode-property-list').' '.esc_attr($kodeproperty_post_option['property-bath']).'</a></li>
								</ul>
								<ul class="kf_property_dolar">
									<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Garage:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-garage']).'</a></li>
									<li><i class="fa fa-arrows"></i><a href="#">'.esc_attr__('Space:','kode-property-list').'  '.esc_attr($kodeproperty_post_option['property-space']).'</a></li>
								</ul>';
								if(isset($kodeproperty_plugin_option['property-more-information']) && $kodeproperty_plugin_option['property-more-information'] <> ''){
								$property .= '<a href="'.esc_url(get_permalink()).'" class="kf_property_more">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-more-information']).'</a>';
								}
							$property .= '</div>
						</div></div>';
					}else if($settings['property-style'] == 'grid-view'){
						
							$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
						
						
							$property .= '<div class="kf_property_listing_wrap">
								<figure>
									'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
									<figcaption class="kf_listing_detail">
										<span class="kf_listing_overlay"></span>';
										if(isset($kodeproperty_plugin_option['property-view-detail']) && $kodeproperty_plugin_option['property-view-detail'] <> ''){
											$property .= '<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'. sprintf(__('%s','kode-property-list'),$kodeproperty_plugin_option['property-view-detail']).'</a>';
										}
									$property .= '	
									</figcaption>
								</figure>
								<div class="kf_property_listing_des">
									<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
									<p>'.esc_attr(substr(get_the_content(),0,70)).'</p>
									<div class="kf_listing_total_price">
										<h4>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h4>
									</div>
									<ul>
										<li>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('Beds','kode-property-list').'</li>
										<li>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('Bath','kode-property-list').'</li>
										<li>'.esc_attr($kodeproperty_post_option['property-garage']).' '.esc_attr__('Garage','kode-property-list').'</li>
										<li>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
									</ul>
								</div>
							</div>
						</div>';
					}else if($settings['property-style'] == 'modern-grid-view'){
						
						$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
						
						$property .= '
							<div class="kf_property_rent_wrap">
								<figure>
									'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
									<figcaption class="kf_listing_detail">
										<span class="kf_listing_overlay"></span>
											<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('View Detail','kode-property-list').'</a>
										<div class="kf_rent_label">';
										$property .= '<p>'. esc_attr__('Rent','kode-property-list').'</p>';
										$property .= '	
										</div>
									</figcaption>
								</figure>
								<div class="kf_rent_property_des">
									<h6><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h6>
									<ul>
										<li>
											<i class="fa fa-bed"></i>
											<p>'.esc_attr__('bedroom','kode-property-list').'</p>
											<span>'.esc_attr($kodeproperty_post_option['property-bed']).'</span>
										</li>
										<li>
											<i class="icon-bath"></i>
											<p>'.esc_attr__('Bathroom','kode-property-list').'</p>
											<span>'.esc_attr($kodeproperty_post_option['property-bath']).'</span>
										</li>
										<li>
											<i class="fa fa-car"></i>
											<p>'.esc_attr__('Garage','kode-property-list').'</p>
											<span>'.esc_attr($kodeproperty_post_option['property-garage']).'</span>
										</li>
									</ul>
								</div>
								<div class="kf_rent_location">
									<h6><i class="fa fa-map-marker"></i>'.esc_attr($property_city).'</h6>
									<div class="kf_rent_total_price">
										<h6>'.esc_attr($kodeproperty_post_option['property-currency']).' '.esc_attr($kodeproperty_post_option['property-price']).'</h6>
									</div>
								</div>
							</div>
						</div>';
					}else{
							
							$property .= '<div class="' . esc_attr(kodeproperty_get_column_class('1/' . $size)) . '">';
							
							$property .= '
							<div class="kf_property_listing_wrap">
								<figure>
									'.get_the_post_thumbnail($post->ID, $settings['thumbnail-size']).'
									<figcaption class="kf_listing_detail">
										<span class="kf_listing_overlay"></span>
										<a href="'.esc_url(get_permalink()).'" class="kode-size-medium kode_link_1">'.esc_attr__('View Detail','kode-property-list').'</a>
									</figcaption>
								</figure>
								<div class="kf_property_listing_des">
									<h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(substr(get_the_title(),0,$settings['title-num-excerpt'])).'</a></h5>
									<p>'.esc_attr(substr(get_the_content(),0,70)).'</p>
									<div class="kf_listing_total_price">
										<h4>'.esc_attr($kodeproperty_post_option['property-currency']).''.esc_attr($kodeproperty_post_option['property-price']).'</h4>
									</div>
									<ul>
										<li>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('Beds','kode-property-list').'</li>
										<li>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('Bath','kode-property-list').'</li>
										<li>'.esc_attr($kodeproperty_post_option['property-garage']).' '.esc_attr__('Garage','kode-property-list').'</li>
										<li>'.esc_attr($kodeproperty_post_option['property-space']).'</li>
									</ul>
								</div>
							</div>
						</div>';
					}
					$current_size++;
				}
				wp_reset_postdata();

				// $property .= kodeproperty_get_pagination($query->max_num_pages, $args['paged']);
				
				echo $property .= '</div></div></div>';	
			}
		}
	}
	
	
	function kodeproperty_all_taxonomy_array($taxonomy){
		$property_features = get_terms(
			array(
				$taxonomy
			),
			array(
				'orderby'       => 'name',
				'order'         => 'ASC',
				'hide_empty'    => false,
				'parent' => 0
			)
		);
		
		$property_fea_array = array();
		foreach($property_features as $property_feature){
			$property_fea_array[$property_feature->term_id] = $property_feature->name;
		}
		return $property_fea_array;
	}
	
	function kodeproperty_post_taxonomy_array($post_id,$taxonomy){
		$features = wp_get_post_terms( $post_id, $taxonomy );
		
		$property_fea_array = array();
		if(!empty($features)){
			foreach($features as $property_feature){
				$property_fea_array[$property_feature->term_id] = $property_feature->name;
			}
		}
		
		return $property_fea_array;
	}
	
	function kodeproperty_remaining_tax_list($post_id,$taxonomy){
		$remain_tax_list = '';
		$all_taxonomy = kodeproperty_all_taxonomy_array($taxonomy);
		$post_taxonomy = kodeproperty_post_taxonomy_array($post_id,$taxonomy);
		if(!empty($post_taxonomy)){
			$remain_tax_list = array_diff($all_taxonomy,$post_taxonomy);
		}
		return $remain_tax_list;
	}	
	
	// ajax to save form data
	add_action( 'wp_ajax_kode_user_submit_form', 'kodeproperty_agent_submit_form' );
	add_action( 'wp_ajax_nopriv_kode_user_submit_form', 'kodeproperty_agent_submit_form' );
	if( !function_exists('kodeproperty_agent_submit_form') ){
		function kodeproperty_agent_submit_form(){
			// Nonce is checked, get the POST data and sign user on
			foreach ($_REQUEST as $keys=>$values) {
				$$keys = $values;
			}
			
			$ret = array();
			if( false && !check_ajax_referer('kodeproperty-agent-create-nonce', 'security', false) ){
				$ret['status'] = 'failed'; 
				$ret['message'] = __('The page has been expired. Please refresh the page to try this again.', 'kode-property-list');
			}else{
				
				global $kodeproperty_plugin_option;
				
				$siteKey = $kodeproperty_plugin_option['google-public-api'];
				$secret = $kodeproperty_plugin_option['google-secret-api'];
				// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
				$lang = "en";
				// The response from reCAPTCHA
				$resp = null;
				// The error code from reCAPTCHA, if any
				$error = null;
				$reCaptcha = new ReCaptcha($secret);
				// Was there a reCAPTCHA response?
				if(isset($_POST["g-recaptcha-response"])){
					if ($_POST["g-recaptcha-response"]) {
						$resp = $reCaptcha->verifyResponse(
							$_SERVER["REMOTE_ADDR"],
							$_POST["g-recaptcha-response"]
						);
					}
				}	
				
				if ($resp != null && $resp->success) {
					
					$records = get_option('kode_agent_form',array());
					$item_id = sizeof($records); 	
					$abc = array();
					$post_new_id = rand();
					if(!empty($records)){
						$counter = 0;
						$counter_new = $item_id+1;
						
						if(is_array($records)){
							foreach($records as $record){
								$records[$counter_new]['name'] = $_POST['your-name'];
								$records[$counter_new]['email'] = $_POST['your-email'];
								$records[$counter_new]['message'] = $_POST['your-message'];
								$records[$counter_new]['property_id'] = $_POST['k_property_id'];
								$counter++;						
							}
							update_option('kode_agent_form',$records);
						}else{
							$record = array();
							$record[$item_id]['name'] = $_POST['your-name'];
							$record[$item_id]['email'] = $_POST['your-email'];
							$record[$item_id]['message'] = $_POST['your-message'];
							$record[$item_id]['property_id'] = $_POST['k_property_id'];
							update_option('kode_agent_form',$record);
						}
					}else{
						$record = array();
						$record[$item_id]['name'] = $_POST['your-name'];
						$record[$item_id]['email'] = $_POST['your-email'];
						$record[$item_id]['message'] = $_POST['your-message'];
						$record[$item_id]['property_id'] = $_POST['k_property_id'];						
						update_option('kode_agent_form',$record);
					}
					
					$ret['status'] = 'success'; 
					$ret['message'] = __('Form Submitted!', 'kode-property-list');
					$ret['amount'] = $_POST['amount'];
					$ret['detail'] = $_POST['detail'];
					
				}else{
					$ret['status'] = 'failed'; 
					$ret['message'] = __('Form Failed!', 'kode-property-list');
					$ret['amount'] = $_POST['amount'];
					$ret['detail'] = $_POST['detail'];
				}
				
			}
			die(json_encode($ret));
		}
	}	
	
	
	if( !function_exists('kodeproperty_mortgage_calculator') ){
		function kodeproperty_mortgage_calculator(){
			$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
			
			// Individual Form Overrides
			$enable_insurance = '';
			if (isset($kodeproperty_plugin_option['enable_insurance']) && $kodeproperty_plugin_option['enable_insurance'] != '') {
				$enable_insurance = 'data-enableinsurance="' . $kodeproperty_plugin_option['enable_insurance'] . '" ';
			}
			$insurance_amount_percent = '';
			if (isset($kodeproperty_plugin_option['insurance_amount_percent']) && $kodeproperty_plugin_option['insurance_amount_percent'] != '') {
				$insurance_amount_percent = 'data-insuranceamountpercent="' . $kodeproperty_plugin_option['insurance_amount_percent'] . '" ';
			}
			$monthly_insurance = '';
			if (isset($kodeproperty_plugin_option['monthly_insurance']) && $kodeproperty_plugin_option['monthly_insurance'] != '') {	
				$monthly_insurance = 'data-monthlyinsurance="' . $kodeproperty_plugin_option['monthly_insurance'] . '" ';
			}
			$enablepmi = '';
			if (isset($kodeproperty_plugin_option['enable_pmi']) && $kodeproperty_plugin_option['enable_pmi'] != '') {	
				$enablepmi = 'data-enablepmi="' . $kodeproperty_plugin_option['enable_pmi'] . '" ';
			}			
			$monthly_pmi = '';
			if (isset($kodeproperty_plugin_option['monthly_pmi']) && $kodeproperty_plugin_option['monthly_pmi'] != '') {	
				$monthly_pmi = 'data-monthlypmi="' . $kodeproperty_plugin_option['monthly_pmi'] . '" ';
			}
			$enable_taxes = '';
			if (isset($kodeproperty_plugin_option['enable_taxes']) && $kodeproperty_plugin_option['enable_taxes'] != '') {	
				$enable_taxes = 'data-enabletaxes="' . $kodeproperty_plugin_option['enable_taxes'] . '" ';
			}
			$tax_rate = '';
			if (isset($kodeproperty_plugin_option['tax_rate']) && $kodeproperty_plugin_option['tax_rate'] != '') {				
				$tax_rate = 'data-taxrate="' . $kodeproperty_plugin_option['tax_rate'] . '" ';
			}
			$disclaimer = '';
			if (isset($kodeproperty_plugin_option['disclaimer']) && $kodeproperty_plugin_option['disclaimer'] != '') {				
				$disclaimer = 'data-disclaimer="' . $kodeproperty_plugin_option['disclaimer'] . '" ';
			}
			$currency_symbol = '';
			if (isset($kodeproperty_plugin_option['currency']) && $kodeproperty_plugin_option['currency'] != '') {				
				$currency_symbol = 'data-currencysymbol="' . $kodeproperty_plugin_option['currency'] . '" ';
			}
			$kodeproperty_plugin_option['currency'] = empty($kodeproperty_plugin_option['currency'])? '$':$kodeproperty_plugin_option['currency'];
			$currency_side = '';
			if (isset($kodeproperty_plugin_option['currency_side']) && $kodeproperty_plugin_option['currency_side'] != '') {								
				$currency_side = 'data-currencyside="' . $kodeproperty_plugin_option['currency_side'] . '" ';
			}
			$currency_format = '';
			if (isset($kodeproperty_plugin_option['currency_format']) && $kodeproperty_plugin_option['currency_format'] != '') {							
				$currency_format = 'data-currencyformat="' . $kodeproperty_plugin_option['currency_format'] . '" ';
			}			
			$down_payment_type = '';
			if (isset($kodeproperty_plugin_option['down_payment_type']) && $kodeproperty_plugin_option['down_payment_type'] != '') {							
				$down_payment_type = 'data-downpaytype="' . $kodeproperty_plugin_option['down_payment_type'] . '" ';
			}
			$allow_email = '';
			if (isset($kodeproperty_plugin_option['allowemail']) && $kodeproperty_plugin_option['allowemail'] != '') {							
				$allow_email = 'data-allowemail="' . $kodeproperty_plugin_option['allowemail']  . '" ';
			}
			$bcc_email = '';
			if (isset($kodeproperty_plugin_option['bcc_email']) && $kodeproperty_plugin_option['bcc_email'] != '') {							
				$bcc_email = 'data-bccemail="' . $kodeproperty_plugin_option['bcc_email'] . '" ';
			}
			$from_email = '';
			if (isset($kodeproperty_plugin_option['from_email']) && $kodeproperty_plugin_option['from_email'] != '') {							
				$from_email = 'data-fromemail="' . $kodeproperty_plugin_option['from_email'] . '" ';
			}
			$email_subject = '';
			if (isset($kodeproperty_plugin_option['email_subject']) && $kodeproperty_plugin_option['email_subject'] != '') {							
				$email_subject = 'data-fromemail="' . $kodeproperty_plugin_option['email_subject'] . '" ';
			}
			$emailcontent = '';
			if (isset($kodeproperty_plugin_option['email_content']) && $kodeproperty_plugin_option['email_content'] != '') {							
				$emailcontent = 'data-emailcontent="' . $kodeproperty_plugin_option['email_content'] . '" ';
			}
			$pdf_color = '';
			if (isset($kodeproperty_plugin_option['pdf_color']) && $kodeproperty_plugin_option['pdf_color'] != '') {							
				$pdf_color = 'data-pdfcolor="' . $kodeproperty_plugin_option['pdf_color'] . '" ';
			}
			$pdf_logo = '';
			if (isset($kodeproperty_plugin_option['pdf_logo']) && $kodeproperty_plugin_option['pdf_logo'] != '') {							
				$pdf_logo = 'data-pdflogo="' . $kodeproperty_plugin_option['pdf_logo'] . '" ';
			}	
			$pdf_header = '';
			if (isset($kodeproperty_plugin_option['pdf_header']) && $kodeproperty_plugin_option['pdf_header'] != '') {							
				$pdf_header = 'data-pdfheader="' . $kodeproperty_plugin_option['pdf_header'] . '" ';
			}
			$form_elemets = $enable_insurance.' '.$insurance_amount_percent.' '.$monthly_insurance.' '.$enablepmi.' '.$monthly_pmi.' '.$enable_taxes.' '.$tax_rate.' '.$disclaimer.' '.$currency_symbol.' '.$currency_side.' '.$currency_format.' '.$down_payment_type.' '.$allow_email.' '.$bcc_email.' '.$from_email.' '.$email_subject.' '.$emailcontent.' '.$pdf_color.' '.$pdf_logo.' '.$pdf_header;
			
			$purchase_price = '';
			if (isset($kodeproperty_plugin_option['purchase_price']) && $kodeproperty_plugin_option['purchase_price'] != '') {							
				$purchase_price = $kodeproperty_plugin_option['purchase_price'];
			}
			$interest_rate = '';
			if (isset($kodeproperty_plugin_option['interest_rate']) && $kodeproperty_plugin_option['interest_rate'] != '') {							
				$interest_rate = $kodeproperty_plugin_option['interest_rate'];
			}
			$down_payment = '';
			if (isset($kodeproperty_plugin_option['down_payment']) && $kodeproperty_plugin_option['down_payment'] != '') {							
				$down_payment = $kodeproperty_plugin_option['down_payment'];
			}
			$loan_term = '';
			if (isset($kodeproperty_plugin_option['loan_term']) && $kodeproperty_plugin_option['loan_term'] != '') {							
				$loan_term = $kodeproperty_plugin_option['loan_term'];
			}
			$calc_title = '';
			if (isset($kodeproperty_plugin_option['calc_title']) && $kodeproperty_plugin_option['calc_title'] != '') {							
				$calc_title = $kodeproperty_plugin_option['calc_title'];
			}
			$send_email_text = '';
			if (isset($kodeproperty_plugin_option['send_email_text']) && $kodeproperty_plugin_option['send_email_text'] != '') {							
				$send_email_text = $kodeproperty_plugin_option['send_email_text'];
			}
			$email_placeholder = '';
			if (isset($kodeproperty_plugin_option['email_placeholder']) && $kodeproperty_plugin_option['email_placeholder'] != '') {							
				$email_placeholder = $kodeproperty_plugin_option['email_placeholder'];
			}
			$purchase_price_label = '';
			if (isset($kodeproperty_plugin_option['purchase_price_label']) && $kodeproperty_plugin_option['purchase_price_label'] != '') {							
				$purchase_price_label = $kodeproperty_plugin_option['purchase_price_label'];
			}
			$interest_rate_label = '';
			if (isset($kodeproperty_plugin_option['interest_rate_label']) && $kodeproperty_plugin_option['interest_rate_label'] != '') {							
				$interest_rate_label = $kodeproperty_plugin_option['interest_rate_label'];
			}
			$purchase_price_info = '';
			if (isset($kodeproperty_plugin_option['purchase_price_info']) && $kodeproperty_plugin_option['purchase_price_info'] != '') {							
				$purchase_price_info = $kodeproperty_plugin_option['purchase_price_info'];
			}
			$interest_rate_info = '';
			if (isset($kodeproperty_plugin_option['interest_rate_info']) && $kodeproperty_plugin_option['interest_rate_info'] != '') {							
				$interest_rate_info = $kodeproperty_plugin_option['interest_rate_info'];
			}
			$down_payment_info = '';
			if (isset($kodeproperty_plugin_option['down_payment_info']) && $kodeproperty_plugin_option['down_payment_info'] != '') {							
				$down_payment_info = $kodeproperty_plugin_option['down_payment_info'];
			}
			$loan_term_info = '';
			if (isset($kodeproperty_plugin_option['loan_term_info']) && $kodeproperty_plugin_option['loan_term_info'] != '') {							
				$loan_term_info = $kodeproperty_plugin_option['loan_term_info'];
			}
			
			$html = '
			<div class="col-md-12">
			<div class="kode-calculator-wrap">
			   <h5>'.esc_attr($calc_title).'</h5>
			   <form '.$form_elemets.' class="kode-custom-mortgage-form" method="post" data-security="'.wp_create_nonce('realestate-mortgage-nonce').'" data-ajax="'.esc_url(KODEPROPERTY_AJAX).'" data-ajax="'.esc_url(KODEPROPERTY_AJAX).'" >
					
					<!--KODE CALCULATOR Start-->
					<div class="kode-calculator-input">
					  <a class="kode-info" href="#" data-toggle="tooltip" data-placement="left" title="'.esc_attr($purchase_price_info).'">
						<i class="fa fa-info"></i>
					   </a>
					   <b>'.$kodeproperty_plugin_option['currency'].'</b>
					   <input class="input-price" type="text" id="mortgage-amount" placeholder="'.esc_attr($purchase_price_label).'" value="'.esc_attr($purchase_price).'" />
					   <div class="err-msg"></div>
					   <label>'.esc_attr($purchase_price_label).'</label>
					</div>
					<!--KODE CALCULATOR END-->
					<!--KODE CALCULATOR Start-->
					<div class="kode-calculator-input">
					  <a class="kode-info" href="#" data-toggle="tooltip" data-placement="left" title="'.esc_attr($interest_rate_info).'">
						<i class="fa fa-info"></i>
					   </a>
					   <input type="text" id="mortgage-interest-rate" placeholder="Interest Rate" value="'.esc_attr($interest_rate).'" />
					   <label>'.esc_attr($interest_rate_label).'</label>
					   <div class="err-msg"></div>
					</div>
					<!--KODE CALCULATOR END-->
					<!--KODE CALCULATOR Start-->
					<div class="kode-calculator-input">
					  <a class="kode-info" href="#" data-toggle="tooltip" data-placement="left" title="'.esc_attr($down_payment_info).'">
						<i class="fa fa-info"></i>
					   </a>
					   <input type="text" id="mortgage-down-payment" placeholder="Down Payment" value="'.esc_attr($down_payment).'" />
					   <label>'.esc_attr__('Down Payment (%)','kode-property-list').'</label>
					   <div class="err-msg"></div>
					</div>
					<!--KODE CALCULATOR END-->
					<!--KODE CALCULATOR Start-->
					<div class="kode-calculator-input">
						<a class="kode-info" href="#" data-toggle="tooltip" data-placement="left" title="'.esc_attr($loan_term_info).'">
							<i class="fa fa-info"></i>
						</a>
						<div class="kode-calculator-checkbox">
							<input type="radio" class="term-duration" name="term-select" id="term-months">
							<label for="term-months">'.esc_attr__('Months','kode-property-list').'</label>
						</div>
						<div class="kode-calculator-checkbox">
							<input type="radio" checked="checked" class="term-duration" name="term-select" id="term-years">
							<label for="term-years">'.esc_attr__('Years','kode-property-list').'</label>
						</div>
						<div class="err-msg"></div>
					   <input type="text" id="term-duration" placeholder="30" value="'.esc_attr($loan_term).'" />
					   <label>'.esc_attr__('terms','kode-property-list').'</label>
					</div>
					<!--KODE CALCULATOR Start-->
					<div class="kode-calculator-input">						
						<div class="kode-calculator-checkbox">
							<input type="checkbox" id="send-email-to-user">
							<label for="send-email-to-user">'.esc_attr($send_email_text).'</label>							
						</div>
						<input class="input-email" type="text" id="user-email-id" placeholder="'.esc_attr($email_placeholder).'">
						<div class="err-msg"></div>
					</div>
					<div class="progresso"></div>
					<p class="kode-msg-list"></p>
					<input type="hidden" value="kode_action_mortgage" id="data_action" />
					<!--KODE CALCULATOR END-->
					<div class="kode-calculator-button">
						<input type="button" class="calculator-button" value="Calculate" />					   
					</div>
			   </form>			   
			</div>
			</div>
			<div id="showcontent"></div>
			';
			
			return $html;
		}
	}
	
	
	// Match the values
	if( !function_exists('kodeproperty_match_page_builder_plugin') ){
		function kodeproperty_match_page_builder_plugin($array, $item_type, $type, $data = array()){
			if(isset($array)){
				foreach($array as $item){
					if($item['item-type'] == $item_type && $item['type'] == $type){
						if(empty($data)){
							return true;
						}else{	
							if( strpos($item['option'][$data[0]], $data[1]) !== false ) return true;
						}
					}
					if($item['item-type'] == 'wrapper'){
						if( kodeproperty_match_page_builder_plugin($item['items'], $item_type, $type) ) return true;
					}
				}
			}
			return false;
		}
	}	
	
	
	

	// set the global variable based on the opened page, post, ...
	add_action('wp', 'kodeproperty_define_global_variable_plugin');
	if( !function_exists('kodeproperty_define_global_variable_plugin') ){
		function kodeproperty_define_global_variable_plugin(){
			global $post;		
			if( is_page() ){
				global $kodeproperty_content_raw,$kodeproperty_post_option;				
				$kodeproperty_content_raw = json_decode(kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'kodeproperty_content', true)), true);
				$kodeproperty_content_raw = (empty($kodeproperty_content_raw))? array(): $kodeproperty_content_raw;
				$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta($post->ID, 'post-option', true));
			}else if( is_single() || (!empty($post)) ){
				global $kodeproperty_post_option;			
				$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta($post->ID, 'post-option', true));
			}
			
			
		}
	}	
	
	
	add_action('init', 'kodeproperty_mortgage_list');
	if( !function_exists('kodeproperty_mortgage_list') ){
		function kodeproperty_mortgage_list(){
			global $kodeproperty_content_raw;
				if( is_page() && kodeproperty_match_page_builder_plugin($kodeproperty_content_raw, 'item', 'mortgage-calc' ) ){
					wp_register_script('kodeproperty-kode-mortgage', KODEPROPERTY_PATH.'/js/kode-mortgage.js', false, '1.0', true);
					wp_enqueue_script('kodeproperty-kode-mortgage');

					wp_register_script('kodeproperty-autoNumeric', KODEPROPERTY_PATH.'/js/autoNumeric.js', false, '1.0', true);
					wp_enqueue_script('kodeproperty-autoNumeric');

					wp_register_script('kodeproperty-mprogress', KODEPROPERTY_PATH.'/framework/include/frontend_assets/process/mprogress.js', false, '1.0', true);
					wp_enqueue_script('kodeproperty-mprogress');	
					wp_enqueue_style( 'kodeproperty-mprogress', KODEPROPERTY_PATH . '/framework/include/frontend_assets/process/mprogress.css' );  //mprogress				
				}

				wp_localize_script( 'kodeproperty-kode-mortgage', 'ajax_mort_object', array( 
					'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
					'kodeNonce' => wp_create_nonce( 'realestate-mortgage-nonce' ),
					'loadingmessage' => __('Sending user info, please wait...','kode-property-list')
				));
				
				// Enable the user with no privileges to run ajax_login() in AJAX
				$kodeproperty_mortgage_ajax = new kodeproperty_mortgage_ajax();
				add_action( 'wp_ajax_kode_action_mortgage', array($kodeproperty_mortgage_ajax, 'property_mortgage_callback'));
				add_action( 'wp_ajax_nopriv_kode_action_mortgage', array($kodeproperty_mortgage_ajax, 'property_mortgage_callback'));

		}	
	}
	
	function kode_get_property_array_diff($abc,$kode_cate_feature){
		$settings = array();
		$settings['filter'] = $abc;
		$terms_list_d = get_terms( array('taxonomy'=>$settings['filter'], 'hide_empty'=>0, 'number'=>0) );
		foreach($terms_list_d as $term_list_d){
			$term_list_a[] = $term_list_d->slug;
		}
		
		$category_diff = array_diff($term_list_a,$kode_cate_feature);
		foreach($category_diff as $cat_diff){
			$term = get_term_by('slug', $cat_diff, $settings['filter']);
			$kode_category[] = $term->term_taxonomy_id;
		}
		
		return $kode_category;
	}
	
	if( !function_exists('kodeproperty_cat_elements') ){
		function kodeproperty_cat_elements($settings=array()){
			$settings['filter'];
			$settings['orderby'] = (empty($settings['orderby']))? 'count': $settings['orderby'];
			$settings['order'] = (empty($settings['order']))? 'DESC': $settings['order'];
			$settings['child-orderby'] = (empty($settings['child-orderby']))? 'count': $settings['child-orderby'];
			$settings['child-order'] = (empty($settings['child-order']))? 'DESC': $settings['child-order'];
			$settings['parent-fetch'] = (empty($settings['parent-fetch']))? '4': $settings['parent-fetch'];
			$settings['child-fetch'] = (empty($settings['child-fetch']))? '5': $settings['child-fetch'];
			$settings['hide-empty'] = (empty($settings['hide-empty']))? '0': $settings['hide-empty'];
			
			$kode_cate = explode(',', $settings['filter']);			
			if($settings['filter'] == 'features'){
				$kode_cate_feature = explode(',', $settings['features']);
			}
			if($settings['filter'] == 'status'){
				$kode_cate_feature = explode(',', $settings['status']);
			}
			if($settings['filter'] == 'property-type'){
				$kode_cate_feature = explode(',', $settings['property-type']);
			}
			if($settings['filter'] == 'room-type'){
				$kode_cate_feature = explode(',', $settings['room-type']);
			}
			if($settings['filter'] == 'city'){
				$kode_cate_feature = explode(',', $settings['city']);
			}
			if($settings['filter'] == 'country'){
				$kode_cate_feature = explode(',', $settings['country']);
			}
			if($settings['filter'] == 'neighborhood'){
				$kode_cate_feature = explode(',', $settings['neighborhood']);
			}
			// print_r($kode_cate_feature);
			// $kode_cate_status = explode(',', $settings['status']);
			// $kode_cate_prop_type = explode(',', $settings['property-type']);
			// $kode_cate_room_type = explode(',', $settings['room-type']);
			// $kode_cate_city = explode(',', $settings['city']);
			// $kode_cate_country = explode(',', $settings['country']);
			// $kode_cate_neighborhood = explode(',', $settings['neighborhood']);
			
			$ret = '
			<div class="property-sale-rent">
				<div class="container">
					<div class="row">';
						$category_diff = kode_get_property_array_diff($settings['filter'],$kode_cate_feature);
						
						// $category_diff = implode(',', $category_diff);
						// print_r($category_diff);
						
						// $kode_category = array_diff($terms_list_d,$kode_cate_feature);
						// print_r($category_diff);
						$terms_list = get_terms( array('taxonomy'=>$settings['filter'],'hide_empty'=>$settings['hide-empty'],'orderby' => $settings['orderby'],'order' => $settings['order'],'parent'=>0,'number'=>$settings['parent-fetch']));
						$counter_cat = 0;
						foreach($terms_list as $term_list){
							$ret .= '
							<div class="col-md-3">
								<div class="property-category">
									<div class="category-header">
										<i class="fa fa-home"></i>
										<h4>'.esc_attr($term_list->name).'</h4>
										<a href="'.get_term_link($term_list).'">(View All)</a>
									</div>
									<ul>';
										$child_terms_list = get_terms( array('taxonomy'=>$settings['filter'], 'hide_empty'=>$settings['hide-empty'],'orderby' => $settings['child-orderby'],'order' => $settings['child-order'],'parent'=>$term_list->term_id,'number'=>$settings['child-fetch']) );
										foreach($child_terms_list as $child_term_list){
											$ret .= '<li><a href="'.get_term_link($child_term_list).'">'.esc_attr($child_term_list->name).'<span>'.esc_attr($child_term_list->count).'</span></a></li>';
										}
									$ret .= '	
									</ul>
								</div>
							</div>';
						}
						$ret .= '
					</div>
				</div>
			</div>';
			
			return $ret;
			
		}
	}
	// kodeproperty_cat_elements();
	
	
	