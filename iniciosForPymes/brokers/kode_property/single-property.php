<?php get_header(); ?>
<div class="content">
<?php
$kode_prop = strtolower(str_replace(' ','-',get_option('current_theme')));
if($kode_prop == 'kode-property'){ ?><div class="container"><?php }else{?><div class="container-fluid kode-prop-plugin"><?php }?>
	
		<div class="row">
		<?php 
			$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
			$kodeproperty_func_utility = new kodeproperty_func_utility();
			$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true ));
			if( !empty($kodeproperty_post_option) ){
				$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );					
			}
			if( empty($kodeproperty_post_option['sidebar']) || $kodeproperty_post_option['sidebar'] == 'default-sidebar' ){
				$kodeproperty_sidebar = array(
					'type'=>$kodeproperty_plugin_option['post-sidebar-template'],
					'left-sidebar'=>$kodeproperty_plugin_option['post-sidebar-left'], 
					'right-sidebar'=>$kodeproperty_plugin_option['post-sidebar-right']
				); 
			}else{
				$kodeproperty_sidebar = array(
					'type'=>$kodeproperty_post_option['sidebar'],
					'left-sidebar'=>$kodeproperty_post_option['left-sidebar'], 
					'right-sidebar'=>$kodeproperty_post_option['right-sidebar']
				); 				
			}
			
			
			$kodeproperty_plugin_option['single-post-author'] = 'enable';
			$kodeproperty_post_option['property-bed'] = get_post_meta(get_the_ID(),'property-bed',true);
			$kodeproperty_post_option['property-bath'] = get_post_meta(get_the_ID(),'property-bath',true);
			$kodeproperty_post_option['property-garage'] = get_post_meta(get_the_ID(),'property-garage',true);
			$kodeproperty_post_option['property-price'] = get_post_meta(get_the_ID(),'property-price',true);
			$kodeproperty_post_option['property-space'] = get_post_meta(get_the_ID(),'property-space',true);
			$kodeproperty_post_option['property-location'] = get_post_meta(get_the_ID(),'property-location',true);
			$kodeproperty_post_option['property-lat'] = get_post_meta(get_the_ID(),'property-lat',true);
			$kodeproperty_post_option['property-lon'] = get_post_meta(get_the_ID(),'property-lon',true);
			$kodeproperty_post_option['property-agent'] = get_post_meta(get_the_ID(),'property-agent',true);
			$kodeproperty_sidebar = $kodeproperty_func_utility->kodeproperty_get_sidebar_class($kodeproperty_sidebar);			
			if($kodeproperty_sidebar['type'] == 'both-sidebar' || $kodeproperty_sidebar['type'] == 'left-sidebar'){ ?>
				<div class="<?php echo esc_attr($kodeproperty_sidebar['left'])?>">
					<?php get_sidebar('left'); ?>
				</div>	
			<?php } ?>
			<div class="<?php echo esc_attr($kodeproperty_sidebar['center'])?>">
				<div class="kode-item kode-team-full kode-single-detail">
				<?php while ( have_posts() ){ the_post();global $post; ?>
					<div class="kf_detail_information">
						<div class="kf_property_detail_img_row_new">
						<!--kf_property_img_datil strat-->
						<div class="kf_property_img_datil">
							<?php if(isset($kodeproperty_post_option['post_media_type']) && $kodeproperty_post_option['post_media_type'] == 'slider'){ ?>
								<?php if(isset($kodeproperty_post_option['slider']) && $kodeproperty_post_option['slider'] <> ''){ ?>
									<ul class="property_pager_item kode-bxslider-pager">
										<?php
											$slider_option = json_decode($kodeproperty_post_option['slider'], true);
											$slide_order = $slider_option[0];
											$slide_data = $slider_option[1];					
											
											$slides = array();
											if(!empty($slide_order)){
												foreach( $slide_order as $slide_id ){
													$slides[$slide_id] = $slide_data[$slide_id];
												}
											}
											$kodeproperty_post_slider['slider'] = $slides;
											foreach($kodeproperty_post_slider['slider'] as $slide_id => $slide){ 
											$kodeproperty_post_option['bed-icon'] = (empty($kodeproperty_post_option['bed-icon']))? 'fa fa-bed': $kodeproperty_post_option['bed-icon'];
											$kodeproperty_post_option['bath-icon'] = (empty($kodeproperty_post_option['bath-icon']))? 'icon-bath': $kodeproperty_post_option['bath-icon'];
											$kodeproperty_post_option['garage-icon'] = (empty($kodeproperty_post_option['garage-icon']))? 'fa fa-car': $kodeproperty_post_option['garage-icon'];
											$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '$': $kodeproperty_post_option['property-currency'];
											?>
											<li>
												<figure>
													<?php echo $kodeproperty_func_utility->kodeproperty_get_image($slide_id,$kodeproperty_post_option['property-thumbnail-size']);?>
												</figure>
												<!-- <div class="kf_property_detail_bed">
													<ul>
														<li>
															<a href="#">
																<span>
																	<?php echo esc_attr($kodeproperty_post_option['property-bed']);?>
																	<i class="<?php echo $kodeproperty_post_option['bed-icon'];?>"></i>
																</span>
																<?php echo esc_attr__('Bedrooms','kode-property-list');?>
															</a>
														</li>
														<li>
															<a href="#">
																<span>
																	<?php echo esc_attr($kodeproperty_post_option['property-bath']);?>
																	
																		<i class="<?php echo $kodeproperty_post_option['bath-icon'];?>"></i>
																	
																</span>
																<?php echo esc_attr__('Bathrooms','kode-property-list');?>
															</a>
														</li>
														<li>
															<a href="#">
																<span>
																	<?php echo esc_attr($kodeproperty_post_option['property-garage']);?>
																	
																		<i class="<?php echo $kodeproperty_post_option['garage-icon'];?>"></i>
																	
																</span>
																<?php echo esc_attr__('Garage','kode-property-list');?>
															</a>
														</li>														
													</ul>
												</div>
												<div class="kf_property_detail_sale">
													<a href="#"><?php echo esc_attr($kodeproperty_post_option['property-type']);?></a>
													<a href="#"><?php echo esc_attr($kodeproperty_post_option['property-currency']);?><?php echo esc_attr($kodeproperty_post_option['property-price']);?></a>
												</div> -->
											</li>
											<?php }									
										?>
									</ul>
								<?php 
									}
								}else if(isset($kodeproperty_post_option['post_media_type']) && $kodeproperty_post_option['post_media_type'] == 'video'){ ?>
									<?php 	$kodeproperty_post_option['bed-icon'] = (empty($kodeproperty_post_option['bed-icon']))? 'fa fa-bed': $kodeproperty_post_option['bed-icon'];
											$kodeproperty_post_option['bath-icon'] = (empty($kodeproperty_post_option['bath-icon']))? 'icon-bath': $kodeproperty_post_option['bath-icon'];
											$kodeproperty_post_option['garage-icon'] = (empty($kodeproperty_post_option['garage-icon']))? 'fa fa-car': $kodeproperty_post_option['garage-icon'];
											$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '$': $kodeproperty_post_option['property-currency'];
									 ?>
									
									<ul class="property_pager_item">
										<li>
											<figure>
												<?php echo kodeproperty_get_video($kodeproperty_post_option['kodeproperty_video'],$kodeproperty_post_option['property-thumbnail-size']); ?>
											</figure>
											<div class="kf_property_detail_bed">
												<ul>
													<li><a href="#"><span><?php echo esc_attr($kodeproperty_post_option['property-bed']);?><i class="<?php echo esc_attr($kodeproperty_post_option['bed-icon']);?>"></i></span><?php esc_attr_e('Bedrooms','kode-property-list');?></a></li>
													<li><a href="#"><span><?php echo esc_attr($kodeproperty_post_option['property-bath']);?><i class="<?php echo esc_attr($kodeproperty_post_option['bath-icon']);?>"></i></span><?php esc_attr_e('Bathrooms','kode-property-list');?></a></li>
													<li><a href="#"><span><?php echo esc_attr($kodeproperty_post_option['property-garage']);?><i class="<?php echo esc_attr($kodeproperty_post_option['garage-icon']);?>"></i></span><?php esc_attr_e('Garage','kode-property-list');?></a></li>
												</ul>
											</div>
											<div class="kf_property_detail_sale">
												<a href="#"><?php echo esc_attr($kodeproperty_post_option['property-type']);?></a>
												<a href="#"><?php echo esc_attr($kodeproperty_post_option['property-currency']);?><?php echo esc_attr($kodeproperty_post_option['property-price']);?></a>
											</div>
										</li>
									</ul>
								<?php }else{ ?>
									<?php 	
										$kodeproperty_post_option['bed-icon'] = (empty($kodeproperty_post_option['bed-icon']))? 'fa fa-bed': $kodeproperty_post_option['bed-icon'];
										$kodeproperty_post_option['bath-icon'] = (empty($kodeproperty_post_option['bath-icon']))? 'icon-bath': $kodeproperty_post_option['bath-icon'];
										$kodeproperty_post_option['garage-icon'] = (empty($kodeproperty_post_option['garage-icon']))? 'fa fa-car': $kodeproperty_post_option['garage-icon'];
										$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? '$': $kodeproperty_post_option['property-currency'];
									?>
								<ul class="property_pager_item">	
									<li>
										<figure>
											<?php echo get_the_post_thumbnail($post->ID, $kodeproperty_post_option['property-thumbnail-size']); ?>
										</figure>
										<div class="kf_property_detail_bed">
											<ul>
												<?php if(isset($kodeproperty_post_option['property-bed']) && $kodeproperty_post_option['property-bed'] <> ''){?>
													<li><a href="#"><span><?php echo esc_attr($kodeproperty_post_option['property-bed']);?><i class="<?php echo esc_attr($kodeproperty_post_option['bed-icon']);?>"></i></span><?php esc_attr_e('Bedrooms','kode-property-list');?></a></li>
												<?php }?>
												<?php if(isset($kodeproperty_post_option['property-bath']) && $kodeproperty_post_option['property-bath'] <> ''){?>
												<li><a href="#"><span><?php echo esc_attr($kodeproperty_post_option['property-bath']);?><i class="<?php echo esc_attr($kodeproperty_post_option['bath-icon']);?>"></i></span><?php esc_attr_e('Bathrooms','kode-property-list');?></a></li>
												<?php }?>
												<?php if(isset($kodeproperty_post_option['property-garage']) && $kodeproperty_post_option['property-garage'] <> ''){?>
												<li><a href="#"><span><?php echo esc_attr($kodeproperty_post_option['property-garage']);?><i class="<?php echo esc_attr($kodeproperty_post_option['garage-icon']);?>"></i></span><?php esc_attr_e('Garage','kode-property-list');?></a></li>
												<?php }?>
											</ul>
										</div>
										<div class="kf_property_detail_sale">
										<?php if(isset($kodeproperty_post_option['property-type']) && $kodeproperty_post_option['property-type'] <> ''){?>
											<a href="#"><?php echo esc_attr($kodeproperty_post_option['property-type']);?></a>
										<?php }?>
										<?php if(isset($kodeproperty_post_option['property-price']) && $kodeproperty_post_option['property-price'] <> ''){?>
											<a href="#"><?php echo esc_attr($kodeproperty_post_option['property-currency']);?><?php echo esc_attr($kodeproperty_post_option['property-price']);?></a>
										<?php }?>
										</div>
									</li>
								</ul>
							<?php }?>
						</div>
						
						<!--kf_property_img_datil end-->
						<?php if(isset($kodeproperty_post_option['post_media_type']) && $kodeproperty_post_option['post_media_type'] == 'slider'){ ?>
								<?php if(isset($kodeproperty_post_option['slider']) && $kodeproperty_post_option['slider'] <> ''){ ?>
						<!--kf_property_detail_img_row strat-->
						<div class="kf_property_detail_img_row" id="property_detail_pager">
							<?php
							$slider_option = json_decode($kodeproperty_post_option['slider'], true);
							$slide_order = $slider_option[0];
							$slide_data = $slider_option[1];					
							
							$slides = array();
							if(!empty($slide_order)){
								foreach( $slide_order as $slide_id ){
									$slides[$slide_id] = $slide_data[$slide_id];
								}
							}
							$kodeproperty_post_option['slider'] = $slides;
							$counter_id = 0;
							foreach($kodeproperty_post_option['slider'] as $slide_id => $slide){ 
							
							?>
							<a data-slide-index="<?php echo esc_attr($counter_id);?>" href="#">
								<?php echo $kodeproperty_func_utility->kodeproperty_get_image($slide_id,'full');?>
							</a>
							<?php 
							$counter_id++;
							}?>
						</div>
						<!--kf_property_detail_img_row end-->
							<?php }
						}?>
						</div>		
						<!--kf_property_detail_uptwon strat-->
						<div class="kf_property_detail_uptwon">
							<h3><?php the_title();?></h3>
							<ul>
								<?php 
								
								if(isset($kodeproperty_post_option['property-location']) && $kodeproperty_post_option['property-location'] <> ''){ ?>
									<li><i class="fa fa-map-marker"></i><a href="#"><?php echo esc_attr($kodeproperty_post_option['property-location']);?></a></li>
								<?php }?>
								<li><i class="fa fa-calendar"></i><a href="#"><?php echo esc_attr(get_the_date());?></a></li>
							</ul>
							<?php $content = get_the_content(); echo $content;?>
						</div>
						<!--kf_property_detail_uptwon end-->
						
						<!--kf_property_detail_link strat-->
						<div class="kf_property_detail_link">
							<div class="row">
								<div class="col-md-12">
									<div class="kf_property_detail_hdg">
										<h5><?php esc_attr_e('Información','kode-property-list');?></h5>
									</div>
								</div>
								<?php 
								$kodeproperty_post_option['kode-map-data'] = get_post_meta($post->ID,'kode-map-data',true);
								if(!empty($kodeproperty_post_option['kode-map-data'])){
									$kode_map_data = json_decode($kodeproperty_post_option['kode-map-data']);
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
								
								?>
								<div class="col-md-12">
									<div class="kf_property_detail_Essentail">
										<?php if(isset($kodeproperty_post_option['property-price']) && $kodeproperty_post_option['property-price'] <> ''){ ?>
										<a href="#"><?php esc_attr_e('Precio','kode-property-list');?>: <?php echo esc_attr($kodeproperty_post_option['property-currency']);?> <?php echo esc_attr($kodeproperty_post_option['property-price']);?></a>
										<?php }?>
										<?php if(isset($kodeproperty_post_option['property-type']) && $kodeproperty_post_option['property-type'] <> ''){ ?>
										<a href="#"><?php esc_attr_e('Para','kode-property-list');?>: <?php echo esc_attr($kodeproperty_post_option['property-type']);?></a>
										<?php }?>
										<?php if(isset($kodeproperty_post_option['property-price']) && $kodeproperty_post_option['property-price'] <> ''){ ?>
										<a href="#"><?php esc_attr_e('Tipo de Propiedad','kode-property-list');?>: <?php esc_attr_e('Resident','kode-property-list');?></a>
										<?php }?>
										<?php if(isset($property_city) && $property_city <> ''){ ?>
										<a href="#"><?php esc_attr_e('País','kode-property-list');?>: <?php echo esc_attr($property_city);?></a>
										<?php }?>
										<?php if(isset($property_area) && $property_area <> ''){ ?>
										<a href="#"><?php esc_attr_e('Area','kode-property-list');?>: <?php echo esc_attr($property_area);?></a>
										<?php }?>
										<?php if(isset($property_country) && $property_country <> ''){ ?>
										<a href="#"><?php esc_attr_e('Ciudad','kode-property-list');?>: <?php echo esc_attr($property_country);?></a>
										<?php }?>
										<?php if(isset($property_state) && $property_state <> ''){ ?>
										<a href="#"><?php esc_attr_e('Departamento','kode-property-list');?>: <?php echo esc_attr($property_state);?></a>
										<?php }?>
										<?php if(isset($kodeproperty_post_option['property-garage']) && $kodeproperty_post_option['property-garage'] <> ''){ ?>
										<a href="#"><?php esc_attr_e('Garage','kode-property-list');?>: <?php echo esc_attr($kodeproperty_post_option['property-garage']);?></a>
										<?php }?>
										<?php if(isset($kodeproperty_post_option['property-bed']) && $kodeproperty_post_option['property-bed'] <> ''){ ?>
										<a href="#"><?php esc_attr_e('Habitaciones','kode-property-list');?>: <?php echo esc_attr($kodeproperty_post_option['property-bed']);?></a>
										<?php }?>
										<?php if(isset($kodeproperty_post_option['property-bath']) && $kodeproperty_post_option['property-bath'] <> ''){ ?>
										<a href="#"><?php esc_attr_e('Baños','kode-property-list');?>: <?php echo esc_attr($kodeproperty_post_option['property-bath']);?></a>										
										<?php }?>
									</div>
								</div>
							</div>
						</div>
						<!--kf_property_detail_link end-->
						
						<!--kf_property_detail_link strat-->
						<div class="kf_property_detail_link">
							<div class="row">
								<div class="col-md-12">
									<div class="kf_property_detail_hdg">
										<h5><?php esc_attr_e('Comodidades','kode-property-list');?></h5>
									</div>
								</div>
								<div class="col-md-12">
									<div class="kf_property_detail_Essentail">
										<?php echo kodeproperty_get_property_info($post->ID,array('features'),'div','');?>
									</div>
								</div>
							</div>
						</div>
						<!--kf_property_detail_link end-->
						<?php if(isset($kodeproperty_post_option['property-location']) && $kodeproperty_post_option['property-location'] <> '') { ?>
						<!--kf_property_detail_map strat-->
						<div class="kf_property_detail_map">
							<h5><?php esc_attr_e('Map View','kode-property-list');?></h5>
							<p><?php esc_attr_e('Property Map View with Nearby Places, Movies, Bar, Beauty Saloon, Hospital','kode-property-list');?></p>
							<?php 
							if(!empty($kodeproperty_post_option['map_icon'])){
								if( is_numeric($kodeproperty_post_option['map_icon']) ){
									$image_src = wp_get_attachment_image_src($kodeproperty_post_option['map_icon'], 'full');	
									$map_icon = esc_url($image_src[0]);
								}else{
									$map_icon = esc_url($kodeproperty_post_option['map_icon']);
								}
							}	
							$icon_class = '';
							if(isset($map_icon) && $map_icon <> ''){ 
								$icon_class = 'icon : "'.$map_icon.'",';
							}
							 
							 ?>
							<script type="text/javascript">	
							  var map;
							  var infowindow;
							  var service;
							  function initMap() {
								var featureOpts = <?php echo kodeproperty_get_property_marker_style($kodeproperty_plugin_option['kode-map-style']);?>;
										
								var pyrmont = {lat: <?php echo $kodeproperty_post_option["property-lat"]?>, lng: <?php echo $kodeproperty_post_option["property-lon"]?>};
								var MY_MAPTYPE_ID = "custom_style";
								
								var mapOptions = {
									zoom: 15,
									center: pyrmont,									
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
										style: 'SMALL',
										//style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
										position: google.maps.ControlPosition.LEFT_TOP
									},
									streetViewControlOptions: {
										style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
										position: google.maps.ControlPosition.LEFT_TOP
									},
									styles: <?php echo kodeproperty_get_property_marker_style($kodeproperty_plugin_option['kode-map-style']);?>,
									
								};
								
								

								
								map = new google.maps.Map(document.getElementById("map_canvas_related"), mapOptions);
								
								
								// var panorama = new google.maps.StreetViewPanorama(
									// document.getElementById('street-view'), {
									  // position: pyrmont,
									  // pov: {
										// heading: 34,
										// pitch: 10
									  // }
									// });
								// map.setStreetView(panorama);
								
								var marker = new google.maps.Marker({
									  position: pyrmont,
									  map: map,
									  animation: google.maps.Animation.DROP,
									  <?php echo $icon_class;?>
									  title: "<?php echo get_the_title();?> - <?php echo $kodeproperty_post_option["property-location"]?>"
								});
								var styledMapOptions = {
									name: "Custom Style"
								};
								
								var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

								map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
								
								infowindow = new google.maps.InfoWindow({
									
								});
								
								var service = new google.maps.places.PlacesService(map);
								
							// bus_station_click
							// movie_station_click
							// food_station_click
							// store_station_click
							// parks_station_click
							// hospital_station_click
								google.maps.event.addDomListener(document.getElementById('food_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['restaurant']
									}, callback);
								});

								google.maps.event.addDomListener(document.getElementById('hospital_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['hospital']
									}, callback);
								});
								
								google.maps.event.addDomListener(document.getElementById('parks_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['park']
									}, callback);
								});
								
								google.maps.event.addDomListener(document.getElementById('bar_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['bar']
									}, callback);
								});
								
								google.maps.event.addDomListener(document.getElementById('bus_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['bus_station']
									}, callback);
								});
								
								google.maps.event.addDomListener(document.getElementById('store_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['store']
									}, callback);
								});
								
								google.maps.event.addDomListener(document.getElementById('movie_station_click'), 'click', function () {
									service.nearbySearch({
									  location: pyrmont,
									  radius: 500,
									  type: ['movie_theater']
									}, callback);
								});
								
								google.maps.event.addListener(infowindow, "domready", function() {

									// Reference to the DIV that wraps the bottom of infowindow
									var iwOuter = jQuery(".gm-style-iw");

									/* Since this div is in a position prior to .gm-div style-iw.
									 * We use jQuery and create a iwBackground variable,
									 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
									*/
									var iwBackground = iwOuter.prev();

									// Removes background shadow DIV
									iwBackground.children(":nth-child(2)").css({"display" : "none"});

									// Removes white background DIV
									iwBackground.children(":nth-child(4)").css({"display" : "none"});

									// Moves the infowindow 115px to the right.
									iwOuter.parent().parent().css({left: "115px"});

									// Moves the shadow of the arrow 76px to the left margin.
									iwBackground.children(":nth-child(1)").attr("style", function(i,s){ return s + "left: 76px !important;"});

									// Moves the arrow 76px to the left margin.
									iwBackground.children(":nth-child(3)").attr("style", function(i,s){ return s + "left: 76px !important;"});

									// Changes the desired tail shadow color.
									iwBackground.children(":nth-child(3)").find("div").children().css({"box-shadow": "rgba(72, 181, 233, 0.6) 0px 1px 6px", "z-index" : "1"});

									// Reference to the div that groups the close button elements.
									var iwCloseBtn = iwOuter.next();

									// Apply the desired effect to the close button
									iwCloseBtn.css({opacity: "1", right: "38px", top: "3px", border: "none", "border-radius": "13px", "box-shadow": "0 0 5px #3990B9"});

									// If the content of infowindow not exceed the set maximum height, then the gradient is removed.
									if(jQuery(".iw-content").height() < 140){
									  jQuery(".iw-bottom-gradient").css({display: "none"});
									}

									// The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
									iwCloseBtn.mouseout(function(){
									  jQuery(this).css({opacity: "1"});
									});
								});
								
								
							  }

							  function callback(results, status) {
								  
								  
								if (status === google.maps.places.PlacesServiceStatus.OK) {
									// createMarker(abc[0]);
								  for (var i = 0; i < results.length; i++) {
									createMarker(results[i]);
									
								  }
								}
							  }

							  function createMarker(place) {
								var placeLoc = place.geometry.location;
								var iconType = {};							
								iconType["atm"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/atm.png";
								iconType["bank"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/atm.png";
								iconType["bus_station"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/bus.png";
								iconType["restaurant"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/food.png";
								iconType["meal_delivery"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/food.png";
								
								iconType["meal_takeaway"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/food.png";
								iconType["food"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/food.png";
								
								iconType["lodging"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/food.png";
								iconType["night_club"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/movie.png";
								iconType["bakery"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/bakery.png";
								iconType["cafe"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/bakery.png";
								iconType["bar"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/bakery.png";
								iconType["parking"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/parking.png";
								iconType["park"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/park.png";
								iconType["beauty_salon"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/park.png";
								
								iconType["movie_theater"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/movie.png";
								
								iconType["hospital"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								iconType["doctor"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								iconType["physiotherapist"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								iconType["dentist"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								iconType["pharmacy"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								iconType["health"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								iconType["hair_care"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/hospital.png";
								
								iconType["store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["furniture_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["electronics_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["home_goods_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["shoe_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["clothing_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["book_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["hardware_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["car_repair"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["convenience_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["grocery_or_supermarket"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["florist"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["gas_station"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["jewelry_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								iconType["bicycle_store"] = "<?php echo KODEPROPERTY_PATH_URL?>/images/icons/store.png";
								
								
								
								var marker = new google.maps.Marker({
									map: map,
									animation: google.maps.Animation.DROP,
									icon : {
										url: iconType[place.types[0]],
										anchor: new google.maps.Point(35, 40),
										scaledSize: new google.maps.Size(35, 40)
									},
									position: place.geometry.location,
									
								});

								google.maps.event.addListener(marker, "click", function() {
									
									infowindow.setContent("<div class='kf_property_listing_wrap'><div class='kf_property_listing_des'><h5><a href=''>"+place.name+"</a></h5><p>"+place.types[0]+"</p><div class='kf_listing_total_price'><h4>"+place.geometry.location.lat()+" <br /> "+place.geometry.location.lng()+"</h4></div></div></div>");
									infowindow.open(map, this);
								    
								  //opening_hours.
								  //rating
								  //name
								  //place.geometry.location.lat()
								  //place.geometry.location.lng()
								  
									//var onChangeHandler = function() {
									  //calculateAndDisplayRoute(directionsService, directionsDisplay);
									//};
									// document.getElementById('start').addEventListener('change', onChangeHandler);
									// document.getElementById('end').addEventListener('change', onChangeHandler);

								  
								  jQuery("#lat").val(place.geometry.location.lat());
								  jQuery("#lng").val(place.geometry.location.lng());
									
								});
							  }
							  jQuery(document).ready(function(){
								initMap();  
							  });
							  
							</script>
							
							<div class="nearby_places">
								<div class="kode-sidebar-map">										
									<ul class="kode-cheaked-boxs">
										<li>
											<label for="bar">
												<input id="bar" type="checkbox">
												<span class="bar"><a data-toggle="tooltip" data-placement="top" title="Bar - Bear" id="bar_station_click"><i class="fa fa-beer"></i></a></span>
											</label>
										</li>
										<li>
											<label for="bus_station">
												<input id="bus_station" type="checkbox">
												<span class="bus_station"><a data-toggle="tooltip" data-placement="top" title="Bus Station" id="bus_station_click"><i class="fa fa-bus"></i></a></span>
											</label>
										</li>
										<li>
											<label for="movie">
												<input id="movie" type="checkbox">
												<span class="movie_station"><a data-toggle="tooltip" data-placement="top" title="Movie Theater" id="movie_station_click"><i class="fa fa-film"></i></a></span>												
											</label>
										</li>
										<li>
											<label for="food">
												<input id="food" type="checkbox">
												<span class="food_station"><a data-toggle="tooltip" data-placement="top" title="Food - Restaurants" id="food_station_click"><i class="fa fa-cutlery"></i></a></span>
											</label>
										</li>
										<li>
											<label for="store">
												<input id="store" type="checkbox">
												<span class="store_station"><a data-toggle="tooltip" data-placement="top" title="Stores" id="store_station_click"><i class="fa fa-shopping-cart"></i></a></span>
											</label>
										</li>
										<li>
											<label for="parks">
												<input id="parks" type="checkbox">
												<span class="parks_station"><a data-toggle="tooltip" data-placement="top" title="Parks" id="parks_station_click"><i class="fa fa-futbol-o"></i></a></span>
											</label>
										</li>
										<li>
											<label for="hospital">
												<input id="hospital" type="checkbox">
												<span class="hospital_station"><a data-toggle="tooltip" data-placement="top" title="Hospital - Medical" id="hospital_station_click"><i class="fa fa-hospital-o"></i></a></span>												
											</label>
										</li>
										<li>
											<a href="" class="all_cats"><?php echo esc_attr__('Reset','kode-property-list'); ?></a>
										</li>
									</ul>
								</div>
							
								<div class="kodeproperty_shortcode-map" id="map_canvas_related"></div>
								<!--<div id="street-view" style="height:350px;width:100%"></div>-->
								<input type="hidden" value="" name="lat" id="lat" />
								<input type="hidden" value="" name="lng" id="lng" />
							</div>
						</div>
						<!--kf_property_detail_map end-->
						<?php }?>
						<?php if(isset($kodeproperty_post_option['floor-plan-slider']) && $kodeproperty_post_option['floor-plan-slider'] <> '') { ?>
						<!--kf_property_detail_map strat-->
						<div class="kf_property_detail_map">
							<h5><?php esc_attr_e('Floor Plans','kode-property-list');?></h5>
							<?php
							$ret = '<ul>';
							$slider_option = json_decode($kodeproperty_post_option['floor-plan-slider'], true);
							$slide_order = $slider_option[0];
							$slide_data = $slider_option[1];					
							
							$slides = array();
							if(!empty($slide_order)){
								foreach( $slide_order as $slide_id ){
									$slides[$slide_id] = $slide_data[$slide_id];
								}
							}
							$kodeproperty_post_option['floor-plan-slider'] = $slides;
							foreach($kodeproperty_post_option['floor-plan-slider'] as $slide_id => $slide){
								$image_src = wp_get_attachment_image_src($slide_id, 'full');	
								$ret .= '
								<li>
									<figure>
										'.$kodeproperty_func_utility->kodeproperty_get_image($slide_id,'full').'
										<figcaption class="kf_floor_detail">
											<span class="kf_listing_overlay"></span>
											<h5><a data-gal="prettyphoto[]" href="'.esc_url($image_src[0]).'">'.esc_attr__('See More','kode-property-list').'</a></h5>
										</figcaption>
									</figure>
								</li>';								
							}
							echo $ret .= '</ul>';
							?>
						</div>
						<!--kf_property_detail_map end-->
						<?php } ?>
						
						<?php
						global $kodeproperty_plugin_option;
						if(isset($kodeproperty_post_option['property-agent']) && $kodeproperty_post_option['property-agent'] <> '' ){ 
						$agent_option = kodeproperty_decode_stopbackslashes(get_post_meta($kodeproperty_post_option['property-agent'], 'post-option', true ));
						if( !empty($agent_option) ){
							$agent_option = json_decode( $agent_option, true );					
						}
						$agent_option['designation'] = get_post_meta($kodeproperty_post_option['property-agent'],'designation',true);
						$agent_option['phone'] = get_post_meta($kodeproperty_post_option['property-agent'],'phone',true);
						$agent_option['website'] = get_post_meta($kodeproperty_post_option['property-agent'],'website',true);
						$agent_option['email'] = get_post_meta($kodeproperty_post_option['property-agent'],'email',true);
						$agent_option['facebook'] = get_post_meta($kodeproperty_post_option['property-agent'],'facebook',true);
						$agent_option['twitter'] = get_post_meta($kodeproperty_post_option['property-agent'],'twitter',true);
						$agent_option['youtube'] = get_post_meta($kodeproperty_post_option['property-agent'],'youtube',true);
						$agent_option['pinterest'] = get_post_meta($kodeproperty_post_option['property-agent'],'pinterest',true);
						
						$designation = (empty($agent_option['designation']))? ' ': $agent_option['designation'];
						$phone = (empty($agent_option['phone']))? ' ': $agent_option['phone'];
						$website = (empty($agent_option['website']))? ' ': $agent_option['website'];
						$email = (empty($agent_option['email']))? ' ': $agent_option['email'];
						$facebook = (empty($agent_option['facebook']))? ' ': $agent_option['facebook'];
						$twitter = (empty($agent_option['twitter']))? ' ': $agent_option['twitter'];
						$youtube = (empty($agent_option['youtube']))? ' ': $agent_option['youtube'];
						$pinterest = (empty($agent_option['pinterest']))? ' ': $agent_option['pinterest'];
						
						$kodeproperty_post_option['property-element-excerpt'] = (empty($kodeproperty_post_option['property-element-excerpt']))? '100': $kodeproperty_post_option['property-element-excerpt'];
						?>
						<!--kf_property_detail_content start-->
						<div class="kf_property_detail_content">
							<h5><?php esc_attr_e('Contact With Agents','kode-property-list');?></h5>
							<div class="row">
								<div class="col-md-4">
									<div class="kf_property_detail_agent">
										<figure>
											<?php echo get_the_post_thumbnail( $kodeproperty_post_option['property-agent'], $kodeproperty_post_option['agent-thumbnail-size']);?>
										</figure>
										<div class="kf_property_detail_social_icon">
											<?php $kodeproperty_func_utility->kodeproperty_get_social_shares()?>
										</div>
									</div>
								</div>
								<div class="col-md-4">		
									<div class="kf_property_detail_real">
										<h6><?php echo esc_attr(get_the_title($kodeproperty_post_option['property-agent']));?></h6>
										<span><?php echo esc_attr($designation)?></span>
										<ul>
											<li><i class="fa fa-envelope-o"></i><a target="_blank" href="mailto:<?php echo esc_attr($email)?>"><?php echo esc_attr($email)?></a></li>
											<li><i class="fa fa-phone"></i><?php echo esc_attr($phone)?></li>
											<li><i class="fa fa-link"></i><?php echo esc_attr($website)?></li>
											<!--<li><i class="fa fa-print"></i>+1 555 22 66 8812</li>-->
										</ul>
										<p><?php echo substr(get_the_content($kodeproperty_post_option['property-agent']),0,$kodeproperty_post_option['property-element-excerpt']);?></p>
									</div>
								</div>
								<?php if(isset($kodeproperty_plugin_option['single-agent-form']) && $kodeproperty_plugin_option['single-agent-form'] == 'enable'){ ?>
								<div class="col-md-4">		
									<div class="kf_property_detail_form">
										<h5><?php esc_attr_e('Send Us Messages','kode-property-list');?></h5>
										<form id="agent-contact" data-ajax="<?php echo KODEPROPERTY_AJAX; ?>" method="post">
											<input class="form_holder kode-require" name="your-name" type="text" placeholder="Your Name:" />
											<input class="form_holder kode-email" name="your-email" type="text" placeholder="Your Email:" />
											<textarea class="form_holder kode-require" name="your-message" placeholder="Messages:"></textarea>
											<div class="g-recaptcha" data-sitekey="<?php echo esc_attr($kodeproperty_plugin_option['google-public-api'])?>"></div>
											<input type="hidden" name="k_property_id" value="<?php echo esc_attr($post->ID)?>" />
											<input type="hidden" name="action" value="kode_user_submit_form" />
											<?php wp_nonce_field( 'kodeproperty-agent-create-nonce', 'security' ); ?>
											<div class="kodehotel-form-loading kodehotel-form-instant-payment-loading"><?php _e('loading', 'kode-property-list'); ?></div>
											<div class="kode-notice email-invalid" ><?php echo esc_attr__('Invalid Email Address ', 'kode-property-list'); ?></div>
											<div class="kode-notice require-field" ><?php echo esc_attr__('Please fill all required fields', 'kode-property-list'); ?></div>
											<div class="kode-notice alert-message" ></div>
											<div class="kode-profile-loader" ></div>
											<input type="button" id="agent-contact-sub" value="<?php esc_attr_e('submit','kode-property-list');?>" />
										</form>
										<script src="https://www.google.com/recaptcha/api.js"></script>
									</div>
								</div>
								<?php } ?>
							</div>
						<!--kf_detail_information end-->
						</div>
						<!--kf_property_detail_content end-->
						<?php }?>
						<?php if(isset($kodeproperty_plugin_option['single-related-property']) && $kodeproperty_plugin_option['single-related-property'] == 'enable'){ ?>
						<!--Property For Rent Wrap Start-->
						<?php echo kodeproperty_related_property($post->ID);?>
						<!--Property For Rent Wrap End-->
						<?php } ?>
					</div>
					<?php if(isset($kodeproperty_plugin_option['single-property-comments']) && $kodeproperty_plugin_option['single-property-comments'] == 'enable'){ ?>
						<?php comments_template( '', true ); ?>
					<?php } ?>
				<?php } ?>
				</div>
			</div>	
			<?php
			if($kodeproperty_sidebar['type'] == 'both-sidebar' || $kodeproperty_sidebar['type'] == 'right-sidebar' && $kodeproperty_sidebar['right'] != ''){ ?>
				<div class="<?php echo esc_attr($kodeproperty_sidebar['right'])?>">
					<?php get_sidebar('right'); ?>
				</div>	
			<?php } ?>
		</div><!-- Row -->	
	</div><!-- Container -->		
</div><!-- content -->
<?php get_footer(); ?>