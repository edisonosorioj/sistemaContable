<?php
	/*	
	*	Kodeforest Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls admin  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	
	if( !class_exists('kodeproperty_generate_plugin_html') ){
		
		class kodeproperty_generate_plugin_html{
			
			public $kodeproperty_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
			
			// decide to generate each option by type
			function kodeproperty_generate_html($settings = array()){
				echo '<div class="kode-option-wrapper ';
				echo (isset($settings['wrapper-class']))? $settings['wrapper-class'] : '';
				echo '">';
				
				$description_class = empty($settings['description'])? '': 'with-description';
				echo '<div class="kode-option ' . esc_attr($description_class) . '">';
				
				// option title
				if( !empty($settings['title']) ){
					echo '<div class="kode-option-title">' . esc_attr($settings['title']) . '</div>';
				}
				
				// input option
				switch ($settings['type']){
					case 'text': $this->kodeproperty_show_text_input($settings); break;
					case 'invoices': $this->kodeproperty_show_invoice_rec($settings); break;
					case 'import-first': $this->kodeproperty_show_importer_first_default($settings); break;
					case 'export-widgets': $this->kodeproperty_show_export_widgets($settings); break;
					case 'importer': $this->kodeproperty_show_importer($settings); break;
					case 'default-importer': $this->kodeproperty_show_importer_default($settings); break;
					case 'server-config': $this->kodeproperty_show_simple_text($settings); break;
					case 'textarea': $this->kodeproperty_show_textarea($settings); break;
					case 'combobox': $this->kodeproperty_show_combobox($settings); break;					
					case 'combobox_sidebar': $this->kodeproperty_show_combobox_sidebar($settings); break;					
					case 'multi-combobox': $this->kodeproperty_show_multi_combobox($settings); break;
					case 'checkbox': $this->kodeproperty_show_checkbox($settings); break;
					case 'radioimage': $this->kodeproperty_show_radio_image($settings); break;
					case 'radioheader': $this->kodeproperty_show_radio_header_image($settings); break;
					case 'colorpicker': $this->kodeproperty_show_color_picker($settings); break;					
					case 'sliderbar': $this->kodeproperty_show_slider_bar($settings); break;
					case 'slider': $this->kodeproperty_show_slider($settings); break;
					case 'gallery': $this->kodeproperty_show_gallery($settings); break;
					case 'sidebar': $this->kodeproperty_show_sidebar_data($settings); break;
					case 'map': $this->kodeproperty_show_map($settings); break;
					case 'font_option': $this->kodeproperty_print_font_combobox($settings); break;
					case 'upload': $this->kodeproperty_show_upload_box($settings); break;
					case 'header': $this->kodeproperty_show_header_box($settings); break;
					case 'custom': $this->kodeproperty_show_custom_option($settings); break;					
					case 'date-picker': $this->kodeproperty_show_date_picker($settings); break;
					case 'custom-fields': $this->kodeproperty_custom_fields_picker($settings); break;
				}
				
				// input descirption
				if( !empty($settings['description']) ){
					echo '<div class="kode-input-description"><span>' . wp_kses($settings['description'],array('br'=>array(),'p'=>array(),'strong'=>array(),'a'=>array('href'=>array(),'class'=>array()))) . '<span></div>';
					echo '<div class="clear"></div>';
				}
				
				echo '</div>'; // kode-option
				echo '</div>'; // kode-option-wrapper				
			}
			
			
			function kodeproperty_show_export_widgets($settings = array()){
				$widget_list = array(0=>'sidebars_widgets');
				$widget_array = kodeproperty_get_widget_name_value();
				if(!empty($widget_array)){
					foreach($widget_array as $widget){
						$widget_list[] = $widget;
					}	
				}
				
				$widget_data = array();
				if(!empty($widget_list)){
					foreach($widget_list as $widget){
						$widget_data[$widget] = get_option($widget);
					}
				}
				
				echo '<div class="export_widgets kode-option-input ';
				echo (!empty($settings['class']))? esc_attr($settings['class']): '';
				echo '">';
				
				echo '<textarea ';
				echo (!empty($settings['class']))? 'class="' . esc_attr($settings['class']) . '"': '';
				echo '>';
				print_r(serialize($widget_data));
				echo '</textarea>';
				echo '</div>';
				
				
				
			}
			
			function kodeproperty_show_invoice_rec($settings = array()){
					global $wpdb;
					
					if(isset($_GET['transaction-type']) && $_GET['transaction-type'] == 'delete'){
						$wpdb->delete( 
							$wpdb->prefix . 'kodeproperty_payment',
							array('id'=>$_GET['id']), 
							array('%d') 
						);
						// $wpdb->delete( 
							// $wpdb->prefix . 'gdlr_hotel_booking',
							// array('payment_id'=>$id), 
							// array('%d') 
						// );
					}else if(isset($_GET['transaction-type']) && $_GET['transaction-type'] == 'read' || isset($_GET['transaction-type']) && $_GET['transaction-type'] == 'unread' ){
						if($_GET['transaction-type'] == 'read'){
							$status = 'read';
						}else if($_GET['transaction-type'] == 'unread'){
							$status = '';
						}

						
						// $wpdb->update( $wpdb->prefix . 'kodeproperty_payment', 
							// array(
								// 'total_price'=>$kodeproperty_post_option['membership-price'], 
								// 'pay_amount'=>$_POST['price'], 							
								// 'booking_data'=>serialize($charge), 
								// 'contact_info'=>$author_user->user_email, 
								// 'payment_status'=>'paid', 
								// 'payment_date'=>date('Y-m-d H:i:s'),
								// 'customer_code'=>$_POST['invoice']
							// ),
							// array('id'=>$_POST['invoice']), 
							// array('%s', '%s', '%s'), 
							// array('%d')
						// );	
						$wpdb->update(
							$wpdb->prefix . 'kodeproperty_payment',
							array('payment_status'=>$status),
							array('id'=>$_GET['id']), 
							array('%s'),
							array('%d')
						);
					}else if(isset($_GET['transaction-type']) && $_GET['transaction-type'] == 'approve' || isset($_GET['transaction-type']) && $_GET['transaction-type'] == 'reject' || isset($_GET['transaction-type']) && $_GET['transaction-type'] == 'pending' ){
						if($_GET['transaction-type'] == 'approve'){
							$status = 'paid';
						}else{
							$status = $_GET['transaction-type'];
						}

						
						// $wpdb->update( $wpdb->prefix . 'kodeproperty_payment', 
							// array(
								// 'total_price'=>$kodeproperty_post_option['membership-price'], 
								// 'pay_amount'=>$_POST['price'], 							
								// 'booking_data'=>serialize($charge), 
								// 'contact_info'=>$author_user->user_email, 
								// 'payment_status'=>'paid', 
								// 'payment_date'=>date('Y-m-d H:i:s'),
								// 'customer_code'=>$_POST['invoice']
							// ),
							// array('id'=>$_POST['invoice']), 
							// array('%s', '%s', '%s'), 
							// array('%d')
						// );	
						$wpdb->update(
							$wpdb->prefix . 'kodeproperty_payment',
							array('payment_status'=>$status),
							array('id'=>$_GET['id']), 
							array('%s'),
							array('%d')
						);
					}else{
						
					}
					
					if(function_exists('kodeproperty_send_notification')){
						echo kodeproperty_send_notification();
					}
					echo '
					<div class="kode_property_amont">
						<ul class="kode_property_amount_list">
							<li class="kode_property_table">
								<div class="kode_property_reference">
									<h6>Package</h6>
								</div>
								<div class="kode_property_Customer">
									<h6>Customer Email</h6>
								</div>
								<div class="kode_property_Due">
									<h6>Due Date</h6>
								</div>
								<div class="kode_property_Amount">
									<h6>Amount</h6>
								</div>
								<div class="kode_property_Stauts">
									<h6>Stauts</h6>
								</div>
								<div class="kode_property_Action">
									<h6>Action</h6>
								</div>
							</li>
							'.kodeproperty_get_all_package_purchase_info('dd').'
						</ul>
					</div>';
				
				
			}
			
			function kodeproperty_show_importer_default($settings = array()){				
				echo '
				<div class="kode-importer-more">
					<input type="hidden" class="dummy_url" data-slug="'.esc_attr($settings['dummy']).'"/>
					<div data-ajax="' . esc_url(KODEPROPERTY_AJAX) . '" data-action="load_demo_data_default" class="kode-import-more">
						<img class="now-loading" src="' . esc_attr(KODEPROPERTY_PATH_URL) . '/framework/include/backend_assets/images/admin-panel/loading.gif" alt="loading" />
						<a class="import-now">Import Now</a>
					</div>
				</div>';
				
				
				
			}
			
			function kodeproperty_show_importer_first_default($settings = array()){
				
				echo '
				<div class="kode-importer-default-first">
					<div class="kode-import-progress">
						<img src="' . esc_url(KODEPROPERTY_PATH_URL) . '/framework/include/backend_assets/images/admin-panel/dummy-loader.gif" alt="loading" />
						<h2 class="import-pro-head">Import in Progress</h2>
						<p>Please wait it will take a while to import the dummy data.</p>
					</div>
					<div class="kode-import-completed">
						<img src="' . esc_url(KODEPROPERTY_PATH_URL) . '/framework/include/backend_assets/images/tick.png" alt="complete" />
						<h2 class="import-pro-head">Import is Completed!</h2>
						<p>View <a href="'.esc_url(home_url('/')).'">Front Page</a> - Go to <a href="'.esc_url(admin_url()).'admin.php?page='.KODEPROPERTY_SLUG.'">Theme Options</a>.</p>
						<div class="abc-import"></div>
					</div>
				</div>';
				
				
				
			}
			
			
			function kodeproperty_show_importer($settings = array()){
				echo '
				<img class="now-loading" src="' . esc_url(KODEPROPERTY_PATH_URL) . '/framework/include/backend_assets/images/admin-panel/loading.gif" alt="loading" />
				<div  class="kode-importer-image">
					<div class="figure">
						<img src="'.esc_url($settings['image']).'" alt="'.esc_attr($settings['title']).'" / >
					</div>
					<div class="kode-importer-head">
						<h3>'.esc_attr($settings['title']).'</h3>
						<span>'.esc_attr($settings['desc']).'</span>
					</div>
					<input type="hidden" class="dummy_url" data-slug="'.esc_attr($settings['dummy']).'"/>
					<input type="hidden" class="options_url" data-slug="'.esc_attr($settings['options']).'"/>
					<input type="hidden" class="widgets_url" data-slug="'.esc_attr($settings['widgets']).'"/>
					<input type="hidden" class="dummy_menu_url" data-slug="'.esc_attr($settings['menu']).'"/>
					<div data-ajax="' . esc_url(KODEPROPERTY_AJAX) . '" data-action="demo_data_load" class="kode-import-now">
						<img class="now-loading" src="' . esc_url(KODEPROPERTY_PATH_URL) . '/framework/include/backend_assets/images/admin-panel/loading.gif" alt="loading" />
						<a class="import-now">'.esc_attr__('Import Now','kode-property').'</a>
						<a target="_blank" href="' . esc_url($settings['live']) . '" class="live-url">'.esc_attr__('Live URL','kode-property').'</a>
						<a class="import-now-menu">'.esc_attr__('Import Menu','kode-property').'</a>
					</div>
				</div>';
				
				
				
			}
			
			
			function kodeproperty_field_option_html($html_title,$disable=false,$html_name,$options=array(),$html_descrip,$html_value=''){
				$ret = '
				<div class="cf-add-title">
					<div class="kode-option-title">'.$html_title.'</div>
					<div class="kode-option-input">';
							if($disable == true){
								$ret .= '<select name="'.$html_name.'" id="">';
							}else{
								$ret .= '<select data-name="'.$html_name.'" id="">';
							}
							foreach($options as $option){
								$ret .= '
								<option ';
								if($html_value == $option){$ret .= 'selected';}
								$ret .= ' 
								>'.$option.'</option>';
							}
							$ret .= '
						</select>
					</div>
					<div class="kode-input-description">
						<span>'.$html_descrip.'</span>
					</div>
				</div>';
				
				return $ret;
			}
			
			
			function kodeproperty_field_text_html($html_title,$disable=false,$html_name,$html_descrip,$html_value=''){
				$ret = '
				<div class="cf-add-title">
					<div class="kode-option-title">'.$html_title.'</div>
					<div class="kode-option-input">';
						if($disable == true){
							$ret .= '<input type="text" value="" name="'.$html_name.'" id="" class="kdf-text-input">';
						}else{
							$ret .= '<input type="text" value="" data-name="'.$html_name.'" id="" class="kdf-text-input">';
						}
					$ret .= '	
					</div>
					<div class="kode-input-description">
						<span>'.$html_descrip.'</span>
					</div>
				</div>';
				
				return $ret;
			}
			
			function kodeproperty_field_textarea_html($html_title,$disable=false,$html_name,$html_descrip,$html_value=''){
				$ret = '
				<div class="cf-add-title">
					<div class="kode-option-title">'.$html_title.'</div>
					<div class="kode-option-input">';
						if($disable == true){
							$ret .= '<textarea name="'.$html_name.'" id="" class="kdf-dropdown-input">'.$html_value.'</textarea>';
						}else{
							$ret .= '<textarea data-name="'.$html_name.'" id="" class="kdf-dropdown-input">'.$html_value.'</textarea>';
						}
						
					$ret .= '</div>
					<div class="kode-input-description">
						<span>'.$html_descrip.'</span>
					</div>
				</div>';
				
				return $ret;
			}
			
			
			
			
				function kodeproperty_custom_fields_picker($settings = array()){
					global $kodeproperty_plugin_option;
					
					$post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true));
					if( !empty($post_option) ){
						$post_option = json_decode( $post_option, true );					
					}
					// print_r($kodeproperty_plugin_option['kode_input_textfield']);
					
					$ret = '
					<div class="kode-custom-fields-head">
						<div class="kode-cf-head">
							<span class="cf-title">Click to Add</span>
							<ul class="kode-cf-post-meta">
								<li class="cf-text-field"><i class="fa fa-pencil"></i> Text</li>
								<li class="cf-textarea-field"><i class="fa fa-list-alt"></i> Textarea</li>
								<li class="cf-dropdown-field"><i class="fa fa-download"></i> Dropdown</li>
								<li class="cf-checkbox-field"><i class="fa fa-check-square"></i> Checkbox</li>
								<li class="cf-radiobtn-field"><i class="fa fa-dot-circle-o"></i> Radio Button</li>
							</ul>
						</div>
						<div class="kf-header-ele-section">
							<div class="field-name">Field Name</div>
							<div class="field-type">Field Type</div>
						</div>
						<div id="kode-meta-content-sec" class="kode-cf-meta-content">';
							$ret .= '
							<!-- Custom Text Fields-->
							<div id="kode-text-field" class="kode-cf-text hide">
								<div class="kode-cf-item">
									<input type="hidden" data-name="kode_input_data[type][]" placeholder="text" data-value="text" />
									<div class="item-cf-title"><input type="text" data-name="kode_input_data[title][]" placeholder="TextField" value="textfield"/>  <span>Text</span></div>								<div class="item-cf-delete"><i class="fa fa-times"></i></div>
									<div class="item-cf-edit"><i class="fa fa-gear"></i></div>
								</div>
								<div class="kode-cf-item-content">
									<div class="cf-post-options">
										'.$this->kodeproperty_field_option_html('Required',false,'kode_input_data[required][]',$options=array('Yes','No'),'Please add the name of the text field','').'
										'.$this->kodeproperty_field_text_html('Meta Key',false,'kode_input_data[meta_key][]','Please add the name of the meta key here do not add space special symbol or special character.',$html_value).'
										'.$this->kodeproperty_field_text_html('Place Holder',false,'kode_input_data[placeholer][]','Please add the Placeholder value of the text field.',$html_value).'
										<input type="hidden" data-name="kode_input_data[options][]" value="simple-text-field" />
										'.$this->kodeproperty_field_option_html('Enable Search',false,'kode_input_data[search][]',$options=array('Yes','No'),'Please add the search name of the text field.','').'
										'.$this->kodeproperty_field_text_html('Icons',false,'kode_input_data[icons][]','Please add the icon name of the text field.',$html_value).'
									</div>
								</div>
							</div>
							
							<!-- Custom Text Area-->
							<div id="kode-textarea-field" class="kode-cf-text hide">
								<div class="kode-cf-item">									
									<input type="hidden" data-name="kode_input_data[type][]" placeholder="textarea" data-value="textarea" />
									<div class="item-cf-title"><input type="text" data-name="kode_input_data[title][]" placeholder="Textarea" value="textarea"/>  <span>Textarea</span></div>								<div class="item-cf-delete"><i class="fa fa-times"></i></div>
									<div class="item-cf-edit"><i class="fa fa-gear"></i></div>
								</div>
								<div class="kode-cf-item-content">
									<div class="cf-post-options">
										'.$this->kodeproperty_field_option_html('Required',false,'kode_input_data[required][]',$options=array('Yes','No'),'Please add the name of the text field','').'
										'.$this->kodeproperty_field_text_html('Meta Key',false,'kode_input_data[meta_key][]','Please add the name of the meta key here do not add space special symbol or special character.',$html_value).'
										'.$this->kodeproperty_field_text_html('Place Holder',false,'kode_input_data[placeholer][]','Please add the Placeholder value of the text field.',$html_value).'
										<input type="hidden" data-name="kode_input_data[options][]" value="simple-textarea-field" />
										'.$this->kodeproperty_field_option_html('Enable Search',false,'kode_input_data[search][]',$options=array('Yes','No'),'Please add the search name of the text field.','').'
										'.$this->kodeproperty_field_text_html('Icons',false,'kode_input_data[icons][]','Please add the icon name of the text field.',$html_value).'
									</div>
								</div>
							</div>
							
							
							<!-- Custom Dropdown-->
							<div id="kode-dropdown-field" class="kode-cf-text hide">
								<div class="kode-cf-item">
									<input type="hidden" data-name="kode_input_data[type][]" placeholder="dropdown" data-value="dropdown" />
									<div class="item-cf-title"><input type="text" data-name="kode_input_data[title][]" placeholder="TextField" value="textfield"/>  <span>Dropdown</span></div>								<div class="item-cf-delete"><i class="fa fa-times"></i></div>
									<div class="item-cf-edit"><i class="fa fa-gear"></i></div>
								</div>
								<div class="kode-cf-item-content">
									<div class="cf-post-options">
										'.$this->kodeproperty_field_option_html('Required',false,'kode_input_data[required][]',$options=array('Yes','No'),'Please add the name of the text field','').'
										'.$this->kodeproperty_field_text_html('Meta Key',false,'kode_input_data[meta_key][]','Please add the name of the meta key here do not add space special symbol or special character.',$html_value).'
										'.$this->kodeproperty_field_text_html('Place Holder',false,'kode_input_data[placeholer][]','Please add the Placeholder value of the text field.',$html_value).'
										'.$this->kodeproperty_field_textarea_html('Options',false,'kode_input_data[options][]','Please add the options one per line.',$html_value='').'
										'.$this->kodeproperty_field_option_html('Enable Search',false,'kode_input_data[search][]',$options=array('Yes','No'),'Please add the search name of the text field.','').'
										'.$this->kodeproperty_field_text_html('Icons',false,'kode_input_data[icons][]','Please add the icon name of the text field.',$html_value).'
									</div>
								</div>
							</div>
							
							<!-- Custom Checkbox-->
							<div id="kode-checkbox-field" class="kode-cf-text hide">
								<div class="kode-cf-item">
									<input type="hidden" data-name="kode_input_data[type][]" placeholder="checkbox" data-value="checkbox" />
									<div class="item-cf-title"><input type="text" data-name="kode_input_data[title][]" placeholder="TextField" value="textfield"/>  <span>Checkbox</span></div>								<div class="item-cf-delete"><i class="fa fa-times"></i></div>
									<div class="item-cf-edit"><i class="fa fa-gear"></i></div>
								</div>
								<div class="kode-cf-item-content">
									<div class="cf-post-options">
										'.$this->kodeproperty_field_option_html('Required',false,'kode_input_data[required][]',$options=array('Yes','No'),'Please add the name of the text field','').'
										'.$this->kodeproperty_field_text_html('Meta Key',false,'kode_input_data[meta_key][]','Please add the name of the meta key here do not add space special symbol or special character.',$html_value).'
										'.$this->kodeproperty_field_text_html('Place Holder',false,'kode_input_data[placeholer][]','Please add the Placeholder value of the text field.',$html_value).'
										'.$this->kodeproperty_field_textarea_html('Options',false,'kode_input_data[options][]','Please add the options one per line.',$html_value='').'
										'.$this->kodeproperty_field_option_html('Enable Search',false,'kode_input_data[search][]',$options=array('Yes','No'),'Please add the search name of the text field.','').'
										'.$this->kodeproperty_field_text_html('Icons',false,'kode_input_data[icons][]','Please add the icon name of the text field.',$html_value).'
									</div>
								</div>
							</div>
							
							<!-- Custom radiobtn-->
							<div id="kode-radiobtn-field" class="kode-cf-text hide">
								<div class="kode-cf-item">
									<input type="hidden" data-name="kode_input_data[type][]" placeholder="radio" data-value="radio" />
									<div class="item-cf-title"><input type="text" data-name="kode_input_data[title][]" placeholder="TextField" value="textfield"/>  <span>radio</span></div>								<div class="item-cf-delete"><i class="fa fa-times"></i></div>
									<div class="item-cf-edit"><i class="fa fa-gear"></i></div>
								</div>
								<div class="kode-cf-item-content">
									<div class="cf-post-options">
										'.$this->kodeproperty_field_option_html('Required',false,'kode_input_data[required][]',$options=array('Yes','No'),'Please add the name of the text field','').'
										'.$this->kodeproperty_field_text_html('Meta Key',false,'kode_input_data[meta_key][]','Please add the name of the meta key here do not add space special symbol or special character.',$html_value).'
										'.$this->kodeproperty_field_text_html('Place Holder',false,'kode_input_data[placeholer][]','Please add the Placeholder value of the text field.',$html_value).'
										'.$this->kodeproperty_field_textarea_html('Options',false,'kode_input_data[options][]','Please add the options one per line.',$html_value='').'
										'.$this->kodeproperty_field_option_html('Enable Search',false,'kode_input_data[search][]',$options=array('Yes','No'),'Please add the search name of the text field.','').'
										'.$this->kodeproperty_field_text_html('Icons',false,'kode_input_data[icons][]','Please add the icon name of the text field.',$html_value).'
									</div>
								</div>
							</div>
							
							<!-- Custom Text Fields-->';
							$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
							if(!empty($kodeproperty_plugin_option['kode_input_data'])){
								$input_textfield = $kodeproperty_plugin_option['kode_input_data'];
								for($i = 0; $i <= count($input_textfield['title']); $i++){
									$item_count = count($input_textfield['title']);
									if(!empty($input_textfield['title'][$i])){
										$ret .= '
										<!-- Custom Text Fields-->
										<div class="kode-cf-text">
											<div class="kode-cf-item">
												<input type="hidden" name="kode_input_data[type][]" placeholder="'.$input_textfield['type'][$i].'" value="'.$input_textfield['type'][$i].'" />
												<div class="item-cf-title"><input type="text" name="kode_input_data[title][]" placeholder="TextField" value="'.esc_attr($input_textfield['title'][$i]).'"/> <span>'.$input_textfield['type'][$i].'</span></div>
												<div class="item-cf-delete"><i class="fa fa-times"></i></div>
												<div class="item-cf-edit"><i class="fa fa-gear"></i></div>
											</div>
											<div class="kode-cf-item-content">
												<div class="cf-post-options">';
													$ret .= $this->kodeproperty_field_option_html('Required',true,'kode_input_data[required][]',$options=array('Yes','No'),'Please add the name of the text field',$input_textfield['required'][$i]);
													$ret .= $this->kodeproperty_field_text_html('Meta Key',true,'kode_input_data[meta_key][]','Please add the name of the meta key here do not add space special symbol or special character.',$input_textfield['meta_key'][$i]);
													$ret .= $this->kodeproperty_field_text_html('Place Holder',true,'kode_input_data[placeholer][]','Please add the Placeholder value of the text field.',$input_textfield['placeholer'][$i]);
														if($input_textfield['type'][$i] == 'radio' || $input_textfield['type'][$i] == 'checkbox' || $input_textfield['type'][$i] == 'dropdown'){
															$ret .= $this->kodeproperty_field_textarea_html('Options',true,'kode_input_data[options][]','Please add the options one per line.',$input_textfield['options'][$i]);
														}else{
															$ret .= '<input type="hidden" name="kode_input_data[options][]" value="simple-textarea-field" />';
														}
													$ret .= $this->kodeproperty_field_option_html('Enable Search',true,'kode_input_data[search][]',$options=array('Yes','No'),'Please add the search name of the text field.',$input_textfield['search'][$i]);
													$ret .= $this->kodeproperty_field_text_html('Icons',true,'kode_input_data[icons][]','Please add the icon name of the text field.',$input_textfield['icons'][$i]);
													$ret .= '
												</div>
											</div>
										</div>
										<!-- Custom Text Fields-->';
									}
								}
							}
							$ret .= '
						</div>					
					</div>';
					
					echo $ret;
				}
			
			
			
			function kodeproperty_show_map($settings = array()){
				global $kodeproperty_plugin_option;
				$post_option = kodeproperty_decode_stopbackslashes(get_post_meta(get_the_ID(), 'post-option', true));
				if( !empty($post_option) ){
					$post_option = json_decode( $post_option, true );					
				}
				$property_radius = (empty($post_option['property-radius']))? '300': $post_option['property-radius'];
				global $post;
				if(get_post_type() == 'property'){
					$property_lat = get_post_meta($post->ID,'property-lat',true);
					$property_lon = get_post_meta($post->ID,'property-lon',true);
					if($property_lat == ''){
						$property_lat = '-37.8172141';
					}
					if($property_lon == ''){
						$property_lon = '-37.8172141';
					}
					echo '<script>
						jQuery(document).ready(function($){
							if($("#property-map").length){
								$("#property-map").locationpicker({
									location: {
										latitude: '.esc_attr($property_lat).',
										longitude: '.esc_attr($property_lon).'
									},
									radius: '.esc_attr($property_radius).',
									inputBinding: {
										latitudeInput: $("#property-lat"),
										longitudeInput: $("#property-lon"),
										radiusInput: $("#property-radius"),
										locationNameInput: $("#property-address")
									},
									enableAutocomplete: true
								});
							}
						});
						</script>';
				}else{
					$property_lat = (empty($post_option['property-lat']))? '-37.8172141': $post_option['property-lat'];
					if($property_lat == ''){
						$property_lat = '-37.8172141';
					}
					$property_lon = (empty($post_option['property-lon']))? '144.95592540000007': $post_option['property-lon'];	
					if($property_lon == ''){
						$property_lon = '144.95592540000007';
					}
					
					echo '<script>
						jQuery(document).ready(function($){
							if($("#property-map").length){
								$("#property-map").locationpicker({
									location: {
										latitude: '.esc_attr($property_lat).',
										longitude: '.esc_attr($property_lon).'
									},
									radius: '.esc_attr($property_radius).',
									inputBinding: {
										latitudeInput: $("#property-lat"),
										longitudeInput: $("#property-lon"),
										radiusInput: $("#property-radius"),
										locationNameInput: $("#property-address")
									},
									enableAutocomplete: true
								});
							}
						});
						</script>';
				}
				
				echo '<div id="property-map" style="width: 100%; height: 400px;"></div>';
			}
			
			function kodeproperty_show_sidebar_data($settings = array()){
				global $kodeproperty_plugin_option;
				// print_R($kodeproperty_plugin_option);
				// print_r($settings);
				
				echo '<div class="kode-option-input">';
				echo '<input type="text" class="kode-upload-box-input" data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($settings['placeholder']) . '" rel="' . esc_attr($settings['placeholder']) . '">';
				echo '<div id="' . esc_attr($settings['slug']) . '" class="kdf-button">'.esc_html__('Add','kode-property').'</div>';
				
				echo '<div class="clear"></div>';
				echo '</div>';
					
				echo '<div id="selected-sidebar" class="sidebar-default-k">';
					echo '<div class="default-sidebar-item" id="sidebar-item">';
						echo '<div class="panel-delete-sidebar"></div>';
						echo '<div class="slider-item-text"></div>';
						echo '<input type="hidden" id="sidebar">';
					echo '</div>';
					if(!empty($kodeproperty_plugin_option['sidebar-element'])){
						if(isset($settings['value'] )){
							foreach($settings['value'] as $item){
								echo '
								<div id=" " class="sidebar-item" style="">
									<div class="panel-delete-sidebar"></div>
									<div class="slider-item-text">'.esc_attr($item).'</div>
									<input type="hidden" id="sidebar" name="' . esc_attr($settings['slug']) . '[]" data-slug="' . esc_attr($settings['slug']) . '[]" value="'.esc_attr($item).'">
								</div>';
							}
						}
					}
				echo '</div>';	

			
			}
			
			// print custom option
			function kodeproperty_show_simple_text($settings = array()){
				echo '<div class="kode-simple-text">';
				 if ( function_exists( 'wp_get_theme' ) ) {
					$theme_data = wp_get_theme();
					$item_uri = $theme_data->get( 'ThemeURI' );
					$theme_name = $theme_data->get( 'Name' );
					$version = $theme_data->get( 'Version' );
				}
				echo '<div class="kode-system-diagnose"><ul>';
					echo'<li><strong>Theme Name:</strong><span>'.esc_attr($theme_name).'</span></li>';
					echo '<li><strong>Theme Version:</strong><span>'.esc_attr($version).'</span></li>';
					echo'<li><strong>Site URL:</strong><span>'.esc_url(home_url('/')).'</span></li>';
					echo '<li><strong>Author URL:</strong><span>'.esc_attr($item_uri).'</span></li>';

					if ( is_multisite() ) {
						echo '<li><strong>WordPress Version:</strong><span>'. 'WPMU ' . esc_attr(get_bloginfo( 'version' )).'</span></li>';
					} else {
						echo '<li><strong>WordPress Version:</strong><span>'. 'WP ' . esc_attr(get_bloginfo( 'version' )).'</span></li>';
					}
					echo '<li><strong>Web Server Info:</strong><span>'.esc_html( $_SERVER['SERVER_SOFTWARE'] ).'</span></li>';
					if ( function_exists( 'phpversion' ) ) {
						echo '<li><strong>PHP Version:</strong><span>'. esc_html( phpversion() ).'</span></li>';
					}
					if ( function_exists( 'size_format' ) ) {
						echo '<li><strong>WP Memory Limit:</strong>';
						$mem_limit = WP_MEMORY_LIMIT;
						if ( $mem_limit < 67108864 ) {
							echo '<span class="error">' . size_format( $mem_limit ) .' - Recommended memory limit should be at least 64MB. Please refer to : <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">Increasing memory allocated to PHP</a> for more information</span>';
						} else {
							echo '<span>' . esc_attr(size_format( $mem_limit )) . '</span>';
						}
						echo '</li>';
						echo'<li><strong>WP Max Upload Size:</strong><span>'. esc_attr(size_format( wp_max_upload_size() )) .'</span></li>';
					}
					if ( function_exists( 'ini_get' ) ) {
						echo '<li><strong>PHP Time Limit:</strong><span>'. esc_attr(ini_get( 'max_execution_time' )) .'</span></li>';
					}
					if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
						echo '<li><strong>WP Debug Mode:</strong><span>Enabled</span></li>';
					} else {
						echo '<li><strong>WP Debug Mode:</strong><span class="error">Disabled</span></li>';
					}
					echo '</ul></div>';
				echo '</div>';
			}
			
			
			// print custom option
			function kodeproperty_show_custom_option($settings = array()){
				echo '<div class="kode-option-input">';
				echo wp_kses($settings['option'],
					array(
						'textarea' => array(
							'class'=>array(),
							'id'=>array(),
							'value'=>array(),
							'name'=>array(),					
						),
						'input' => array(
							'type'=>array(),
							'class'=>array(),
							'id'=>array(),
							'value'=>array(),
							
						),
					)
				);
				echo '</div>';
			}
			
			
			
			// print the input text
			function kodeproperty_show_text_input($settings = array()){
				global $post;
				if(get_post_type() == 'property'){
					$settings_value = get_post_meta($post->ID,esc_attr($settings['slug']),true);
					if(!isset($settings_value) || $settings_value == '' || $settings_value == ' '){
						
					}else{
						$settings['value'] = $settings_value;
					}
				}else{
					
				}
				$settings_id = '';
				if( !empty($settings['id']) ){
					$settings_id = $settings['id'];
				}else if( !empty($settings['id']) ){
					$settings_id = $settings['id'];
				}
				echo '<div class="kode-option-input">';
				echo '<input type="text" class="kdf-text-input" id="' . esc_attr($settings_id) . '" name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				if( isset($settings['value']) ){
					echo 'value="' . esc_attr($settings['value']) . '" ';
				}else if( !empty($settings['default']) ){
					echo 'value="' . esc_attr($settings['default']) . '" ';
				}
				echo '/>';
				echo '</div>';
			}
			
			//Header Box
			function kodeproperty_show_header_box($settings = array()){
				echo '<div class="page-builder-head-wrapper">
					<h4 class="page-builder-head add-content">'.$settings['header_title'].'</h4>
				</div>';
			}
			
			
			// print the date picker
			function kodeproperty_show_date_picker($settings = array()){
				echo '<div class="kode-option-input">';
				echo '<input type="text" class="kdf-text-input kode-date-picker" name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				if( isset($settings['value']) ){
					echo 'value="' . esc_attr($settings['value']) . '" ';
				}else if( !empty($settings['default']) ){
					echo 'value="' . esc_attr($settings['default']) . '" ';
				}
				echo '/>';
				echo '</div>';
			}			
			
			// print the textarea
			function kodeproperty_show_textarea($settings = array()){
				global $post;
				if(get_post_type() == 'property'){
					$settings['value'] = get_post_meta($post->ID,esc_attr($settings['slug']),true);
				}else{
					
				}
				echo '<div class="kode-option-input ';
				echo (!empty($settings['class']))? esc_attr($settings['class']): '';
				echo '">';
				
				echo '<textarea name="' . esc_attr($settings['slug']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				echo (!empty($settings['class']))? 'class="' . esc_attr($settings['class']) . '"': '';
				echo '>';
				if( isset($settings['value']) ){
					echo esc_attr($settings['value']);
				}else if( !empty($settings['default']) ){
					echo esc_attr($settings['default']);
				}
				echo '</textarea>';
				echo '</div>';
			}		

			// print the combobox
			function kodeproperty_show_combobox($settings = array()){
				
				global $post;
				echo '<div class="kode-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				if(isset($settings['ajax']) && !empty($settings['ajax'])){
					echo '<div data-settings="'.$settings['settings'].'" data-ajax="' . KODEPROPERTY_AJAX . '" data-id="' . $post->ID . '" data-action="'.$settings['ajax'].'" class="kode-combobox-wrapper">';	
				}else{
					echo '<div class="kode-combobox-wrapper">';	
				}
				
				echo '<select name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" >';
				foreach($settings['options'] as $slug => $name ){
					echo '<option value="' . esc_attr($slug) . '" ';
					echo ($value == $slug)? 'selected ': '';
					echo '>' . esc_attr($name) . '</option>';
				
				}
				echo '</select>';
				echo '</div>'; // kode-combobox-wrapper
				
				echo '</div>';
			}
			
			// print the combobox
			function kodeproperty_show_combobox_sidebar($settings = array()){
				echo '<div class="kode-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}
				
				echo '<div class="kode-combobox-wrapper">';
				echo '<select name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['name']) . '" >';
				foreach($settings['options'] as $slug => $name ){
					echo '<option value="' . esc_attr($name) . '" ';
					echo ($value == $name)? 'selected ': '';
					echo '>' . esc_attr($name) . '</option>';
				
				}
				echo '</select>';
				echo '</div>'; // kode-combobox-wrapper
				
				echo '</div>';
			}
			
			// print the combobox
			function kodeproperty_show_multi_combobox($settings = array()){
				echo '<div class="kode-option-input">';

				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}else{
					$value = array();
				}

				echo '<div class="kode-multi-combobox-wrapper">';
				echo '<select name="' . esc_attr($settings['name']) . '[]" data-slug="' . esc_attr($settings['slug']) . '" multiple >';
				foreach($settings['options'] as $slug => $name ){
					echo '<option value="' . esc_attr($slug) . '" ';
					echo (in_array($slug, $value))? 'selected ': '';
					echo '>' . esc_attr($name) . '</option>';
				
				}
				echo '</select>';
				echo '</div>'; // kode-combobox-wrapper
				
				echo '</div>';
			}			

			
			// print the checkbox ( enable / disable )
			function kodeproperty_show_checkbox($settings = array()){
				echo '<div class="kode-option-input">';
				
				$value = 'enable';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				echo '
					<div class="onoffswitch primary inline-block">
						<div class="checkbox-appearance ' . esc_attr($value) . '" > </div>
						<input type="hidden" name="' . esc_attr($settings['name']) . '" value="disable" />
						<input type="checkbox" name="' . esc_attr($settings['name']) . '" class="onoffswitch-checkbox" id="' . esc_attr($settings['slug']) . '-id" data-slug="' . esc_attr($settings['slug']) . '" ';
						echo ($value == 'enable')? 'checked': '';
						echo ' value="enable">
						<label class="onoffswitch-label" for="' . esc_attr($settings['slug']) . '-id">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
				</div>';
			}		

			// print the radio image
			function kodeproperty_show_radio_image($settings = array()){
				echo '<div class="kode-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				$i = 0;
				foreach($settings['options'] as $slug => $name ){
					echo '<label for="' . esc_attr($settings['slug']) . '-id' . $i . '" class="radio-image-wrapper ';
					echo ($value == $slug)? 'active ': '';
					echo '">';
					echo '<img src="' . esc_url($name) . '" alt="" />';
					echo '<div class="selected-radio"></div>';

					echo '<input type="radio" name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
					echo 'id="' . esc_attr($settings['slug']) . '-id' . $i . '" value="' . esc_attr($slug) . '" ';
					echo ($value == $slug)? 'checked ': '';
					echo ' />';
					
					echo '</label>';
					
					$i++;
				}
				
				echo '<div class="clear"></div>';
				echo '</div>';
			}
			
			
			// print the radio image
			function kodeproperty_show_radio_header_image($settings = array()){
				echo '<div class="kode-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				$i = 0;
				foreach($settings['options'] as $slug => $name ){
					echo '<label for="' . esc_attr($settings['slug']) . '-id' . $i . '" class="radio-image-wrapper radio-header-wrapper ';
					echo ($value == $slug)? 'active ': '';
					echo '">';
					echo '<img src="' . esc_url($name) . '" alt="" />';
					echo '<div class="selected-radio"></div>';

					echo '<input type="radio" name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
					echo 'id="' . esc_attr($settings['slug']) . '-id' . $i . '" value="' . esc_attr($slug) . '" ';
					echo ($value == $slug)? 'checked ': '';
					echo ' />';
					
					echo '</label>';
					
					$i++;
				}
				
				echo '<div class="clear"></div>';
				echo '</div>';
			}
			
			

			// print color picker
			function kodeproperty_show_color_picker($settings = array()){
				echo '<div class="kode-option-input">';
				
				echo '<input type="text" class="wp-color-picker" name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				if( !empty($settings['value']) ){
					echo 'value="' . esc_attr($settings['value']) . '" ';
				}else if( !empty($settings['default']) ){
					echo 'value="' . esc_attr($settings['default']) . '" ';
				}
				
				if( !empty($settings['default']) ){
					echo 'data-default-color="' . esc_attr($settings['default']) . '" ';
				}
				echo '/>';
				
				echo '</div>';
			}	
			
			
			// print slider bar
			function kodeproperty_show_slider_bar($settings = array()){
				echo '<div class="kode-option-input">';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				// create a blank box for javascript
				echo '<div class="kode-sliderbar" data-value="' . esc_attr($value) . '" ></div>';
				
				echo '<input type="text" class="kode-sliderbar-text-hidden" name="' . esc_attr($settings['name']) . '" ';
				echo 'data-slug="' . esc_attr($settings['slug']) . '" value="' . esc_attr($value) . '" />';
				
				// this will be the box that shows the value
				echo '<div class="kode-sliderbar-text">' . esc_attr($value) . 'px</div>';
				
				echo '<div class="clear"></div>';
				echo '</div>';			
			}

			// print slider
			function kodeproperty_show_slider($settings = array()){
				echo '<div class="kode-option-input ';
				echo (!empty($settings['class']))? esc_attr($settings['class']): '';
				echo '">';
				
				echo '<textarea name="' . esc_attr($settings['slug']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				echo 'class="kode-input-hidden kode-slider-selection" data-overlay="true" data-caption="true" >';
				if( isset($settings['value']) ){
					echo esc_attr($settings['value']);
				}else if( !empty($settings['default']) ){
					echo esc_attr($settings['default']);
				}
				echo '</textarea>';
				echo '</div>';
			}	

			// print Gallery
			function kodeproperty_show_gallery($settings = array()){
				echo '<div class="kode-option-input ';
				echo (!empty($settings['class']))? esc_attr($settings['class']): '';
				echo '">';
				
				echo '<textarea name="' . esc_attr($settings['slug']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				echo 'class="kode-input-hidden kode-gallery-selection" data-overlay="true" data-caption="true" >';
				if( isset($settings['value']) ){
					echo esc_attr($settings['value']);
				}else if( !empty($settings['default']) ){
					echo esc_attr($settings['default']);
				}
				echo '</textarea>';
				echo '</div>';
			}				
			
			// print upload box
			function kodeproperty_show_upload_box($settings = array()){
				echo '<div class="kode-option-input">';
				
				$value = ''; $file_url = '';
				$settings['data-type'] = empty($settings['data-type'])? 'image': $settings['data-type'];
				$settings['data-type'] = ($settings['data-type']=='upload')? 'image': $settings['data-type'];
				
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				if( is_numeric($value) ){ 
					$file_url = wp_get_attachment_url($value);
				}else{
					$file_url = $value;
				}
				
				// example image url
				echo '<img class="kode-upload-img-sample ';
				echo (empty($file_url) || $settings['data-type'] != 'image')? 'blank': '';
				echo '" ';
				echo (!empty($file_url) && $settings['data-type'] == 'image')? 'src="' . esc_url($file_url) . '" ': ''; 
				echo '/>';
				echo '<div class="clear"></div>';
				
				// input link url
				echo '<input type="text" class="kode-upload-box-input" value="' . esc_url($file_url) . '" />';					
				
				// hidden input
				echo '<input type="hidden" class="kode-upload-box-hidden" ';
				echo 'name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" ';
				echo 'value="' . esc_attr($value) . '" />';
				
				// upload button
				echo '<input type="button" class="kode-upload-box-button kdf-button" ';
				echo 'data-title="' . esc_attr($settings['title']) . '" ';
				echo 'data-type="' . esc_attr($settings['data-type']) . '" ';				
				echo 'data-button="';
				echo (empty($settings['button']))? esc_html__('Insert Image', 'kode-property'):$settings['button'];
				echo '" ';
				echo 'value="' . esc_html__('Upload', 'kode-property') . '"/>';
				
				echo '<div class="clear"></div>';
				echo '</div>';
			}			

			// print the font combobox
			function kodeproperty_print_font_combobox($settings = array()){
				echo '<div class="kode-option-input">';
				
				$value = '';
				if( !empty($settings['value']) ){
					$value = $settings['value'];
				}else if( !empty($settings['default']) ){
					$value = $settings['default'];
				}
				
				echo '<input class="kode-sample-font" ';
				echo 'value="' . esc_html__('Sample Font', 'kode-property') . '" ';
				echo (!empty($value))? 'style="font-family: ' . $value . ';" />' : '/>';
				
				echo '<div class="kode-combobox-wrapper">';
				echo '<select name="' . esc_attr($settings['name']) . '" data-slug="' . esc_attr($settings['slug']) . '" class="kode-font-combobox" >';
				do_action('kodeproperty_print_all_font_list', $value);
				echo '</select>';
				echo '</div>'; // kode-combobox-wrapper
				
				echo '</div>';
			}	
			
			
		}

	}
		
?>