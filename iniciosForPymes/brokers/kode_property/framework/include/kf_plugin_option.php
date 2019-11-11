<?php
	/*	
	*	The KodeProperty Plguin File
	*	---------------------------------------------------------------------
	*	This file contains the Plugin option setting 
	*	---------------------------------------------------------------------
	*	http://stackoverflow.com/questions/2270989/what-does-apply-filters-actually-do-in-wordpress
	*/
	
	// create the main admin option
	if( is_admin() ){
		add_action('init', 'kodeproperty_create_pluginoption');
	}
	
	if( !function_exists('kodeproperty_create_pluginoption') ){
	
		function kodeproperty_create_pluginoption(){
			$kodeproperty_func_utility = new kodeproperty_func_utility();
			$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
			if(!isset($kodeproperty_plugin_option['sidebar-element'])){$kodeproperty_plugin_option['sidebar-element'] = array('blog','contact');}
			// Theme Options Default data
			$kodeproperty_default_data_array = array(
				'page_title' => 'Property Plugin' . esc_html__('Option', 'kode-property'),
				'menu_title' => 'Property Options',
				'menu_slug' => 'kodeprop_plugin',
				'save_option' => 'kodeproperty_plugin_option',
				'role' => 'edit_theme_options'
			);
			
			
			new kodeproperty_pluginoption_panel(
				
				// Theme Options Default data
				$kodeproperty_default_data_array,
				
				// Theme Options setting
				apply_filters('kodeproperty_pluginoption_panel',
					array(
						// general menu
						'property-settings' => array(
							'title' => esc_html__('Property Options', 'kode-property-list'),				
							'icon' => 'fa fa-home',
							'options' => array(
								'property_currency' => array(
									'title' => esc_html__('Property Setting', 'kode-property-list'),
									'options' => array(
										'property-listing-type' => array(
											'title' => __('Listing Type', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> array(
												'free'=> esc_attr__('Free','kode-property-list'),
												'paid'=> esc_attr__('Paid','kode-property-list')
											),
										),
										'property-free-listing' => array(
											'title' => esc_html__('Number of Free Listing', 'kode-property-list'),
											'type' => 'text',						
											'default' => '3',
											'description'=> esc_attr__('Free Listing Available.', 'kode-property-list'),
										),
										'property-free-listing-featured' => array(
											'title' => esc_html__('Number of Free Listing Featured', 'kode-property-list'),
											'type' => 'text',						
											'default' => '3',
											'description'=> esc_attr__('Free Listing Featured Available.', 'kode-property-list'),
										),
										'property-currency' => array(
											'title' => esc_html__('Property Currency', 'kode-property-list'),
											'type' => 'text',						
											'default' => '$',
											'description'=> esc_attr__('Property Currency For Search and Listing Options.', 'kode-property-list'),
										),
										'property-area-slug' => array(
											'title' => esc_html__('Property Area', 'kode-property-list'),
											'type' => 'combobox',
											'options' => array(
												'sqft' => esc_html__('SQFT', 'kode-property-list'),
												'marla' => esc_html__('Marla', 'kode-property-list'),
												'kanal' => esc_html__('Kanal', 'kode-property-list'),												
											),											
										),
									)
								),
								
								'property_search' => array(
									'title' => esc_html__('Property Search', 'kode-property-list'),
									'options' => array(
										'property-search-style' => array(
											'title' => esc_html__('Search Style', 'kode-property-list'),
											'type' => 'combobox',
											'options' => array(
												'0' => esc_html__('Not Selected', 'kode-property-list'),
												'1' => esc_html__('Advance Search', 'kode-property-list'),
												'2' => esc_html__('Compact Search', 'kode-property-list'),												
											),											
										),
										// 'search-sidebar-template' => array(
											// 'title' => esc_html__('Search Detail Default Sidebar', 'kode-property-list'),
											// 'type' => 'radioimage',
											// 'options' => array(
												// 'no-sidebar'=>		KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/no-sidebar.png',
												// 'both-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/both-sidebar.png', 
												// 'right-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/right-sidebar.png',
												// 'left-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/left-sidebar.png'
											// ),
										// ),
										// 'search-sidebar-left' => array(
											// 'title' => esc_html__('Search Detail Default Sidebar Left', 'kode-property-list'),
											// 'type' => 'combobox_sidebar',
											// 'wrapper-class' => 'left-sidebar-wrapper both-sidebar-wrapper search-sidebar-template-wrapper',
											// 'options' => $kodeproperty_plugin_option['sidebar-element'],		
										// ),
										// 'search-sidebar-right' => array(
											// 'title' => esc_html__('Search Detail Default Sidebar Right', 'kode-property-list'),
											// 'type' => 'combobox_sidebar',
											// 'wrapper-class' => 'right-sidebar-wrapper both-sidebar-wrapper search-sidebar-template-wrapper',
											// 'options' => $kodeproperty_plugin_option['sidebar-element'],
										// ),	
										
										'property-search-page' => array(
											'title' => __('Select Search Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
										),
										'property-search-tab-for-rent' => array(
											'title' => esc_html__('For Rent Tab', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide this tab from search form.', 'kode-property-list'),											
											'default' => 'enable'
										),
										'property-search-rent-option' => array(
											'title' => __('Select Rent Category', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list_id('status'),
											'description'=> esc_html__('Please select the list type which you want to search under rent properties.', 'kode-property-list'),
										),
										'property-search-tab-for-sale' => array(
											'title' => esc_html__('For Sale Tab', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide this tab from search form.', 'kode-property-list'),											
											'default' => 'enable'
										),
										'property-search-sale-option' => array(
											'title' => __('Select Sale Category', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list_id('status'),
											'description'=> esc_html__('Please select the list type which you want to search under rent properties.', 'kode-property-list'),
										),
										'property-search-tab-for-auction' => array(
											'title' => esc_html__('For Auction Tab', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide this tab from search form.', 'kode-property-list'),											
											'default' => 'enable'
										),
										'property-search-auction-option' => array(
											'title' => __('Select Auction Category', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list_id('status'),
											'description'=> esc_html__('Please select the list type which you want to search under rent properties.', 'kode-property-list'),
										),
									)
								),
								'property-user' => array(
									'title' => esc_html__('Property Submit / Login', 'kode-property-list'),
									'options' => array(
										'login-page' => array(
											'title' => __('Select Login Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
											'description'=> esc_html__('Please select the page where you have added the login element from pagebuilder.', 'kode-property-list'),
										),
										'register-page' => array(
											'title' => __('Select User Registration Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
											'description'=> esc_html__('Please select the page where you have added the register user element from pagebuilder.', 'kode-property-list'),
										),
										'submission-page' => array(
											'title' => __('Select Property Submission Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
											'description'=> esc_html__('Please select the page where you have added the Property Submission element from pagebuilder.', 'kode-property-list'),
										),
										'submission-edit-page' => array(
											'title' => __('Select Property Submission Edit Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
											'description'=> esc_html__('Please select the page where you have added the Property Submission edit element from pagebuilder.', 'kode-property-list'),
										),
										'membership-page' => array(
											'title' => __('Select Membership Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
											'description'=> esc_html__('Please select the page where you have added the Membership element from pagebuilder.', 'kode-property-list'),
										)
									)
								),
								'property-options' =>  array(
									'title' => esc_html__('Property Options', 'kode-property-list'),
									'options' => array(
										'single-related-property' => array(
											'title' => esc_html__('Related Property', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide the Related Properties on the Property Detail page.', 'kode-property-list'),											
											'default' => 'enable',
										),
										'single-agent-form' => array(
											'title' => esc_html__('Agent Form', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide the agent form on the property detail page.', 'kode-property-list'),											
											'default' => 'enable',
										),
										'single-property-comments' => array(
											'title' => __('Single Property Comments', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide the Comments on the Property Detail page.', 'kode-property-list'),											
											'default' => 'enable',
										),
										'for-label' => array(
											'title' => esc_html__('Label Tag', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('You can show or hide the for rent / for sale label in listing type from here.', 'kode-property-list'),											
											'default' => 'enable',
										),
										'property-thumbnail-size' => array(
											'title' => esc_html__('Single Post Thumbnail Size', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),
											'default'=> 'kodeproperty-post-thumbnail-size'
										),
										
									)
								),
								'property-features' =>  array(
									'title' => esc_html__('Property Filter Detail', 'kode-property-list'),
									'options' => array(
										'features-style'=> array(
											'title'=> __('Property Style' ,'kode-property-list'),
											'type'=> 'combobox',
											'options'=> array(
												'grid-view' => __('Grid View', 'kode-property-list'),
												'modern-grid-view' => __('Moderrn Grid View', 'kode-property-list'),
												'simple-full-view' => __('Simple Full View', 'kode-property-list'),
												'normal-full-view' => __('Normal Full View', 'kode-property-list'),
												'modern-full-view' => __('Modern Full View', 'kode-property-list'),
											),
											'wrapper-class'=> 'show-map-as-wrapper map-with-property-wrapper'
										),	
										'features-thumbnail-size' => array(
											'title' => esc_html__('Thumbnail Size', 'kf_kode-property'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_thumbnail_list(),
											'default'=> 'kode-post-thumbnail-size',
											'wrapper-class'=> 'show-map-as-wrapper map-with-property-wrapper'
										),
										'features-column'=> array(
											'title'=> __('Property Column Size' ,'kode-property-list'),
											'type'=> 'combobox',
											'options'=> array(
												'2' => __('2 Column', 'kode-property-list'),
												'3' => __('3 Column', 'kode-property-list'),
												'4' => __('4 Column', 'kode-property-list')
											),
											'wrapper-class' => 'show-map-as-wrapper map-with-property-wrapper grid-view-wrapper modern-grid-view-wrapper property-style-wrapper',
										),	
										'features-sidebar' => array(
											'title' => esc_html__('Property Filter Sidebar', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('Please enable / disable the property Property Filter Detail page sidebar from here.', 'kode-property-list'),
											'default' => 'enable',
										),
										'features-sidebar-template' => array(
											'title' => esc_html__('Property Filter Detail Sidebar', 'kode-property-list'),
											'type' => 'radioimage',
											'options' => array(
												'no-sidebar'=>		KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/no-sidebar.png',
												'both-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/both-sidebar.png', 
												'right-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/right-sidebar.png',
												'left-sidebar'=>	KODEPROPERTY_PATH_URL . '/framework/include/backend_assets/images/left-sidebar.png'
											),
										),
										'features-sidebar-left' => array(
											'title' => esc_html__('Property Filter Detail Sidebar Left', 'kode-property-list'),
											'type' => 'combobox_sidebar',
											'wrapper-class' => 'left-sidebar-wrapper both-sidebar-wrapper features-sidebar-template-wrapper',
											'options' => $kodeproperty_plugin_option['sidebar-element'],		
										),
										'features-sidebar-right' => array(
											'title' => esc_html__('Property Filter Detail Sidebar Right', 'kode-property-list'),
											'type' => 'combobox_sidebar',
											'wrapper-class' => 'right-sidebar-wrapper both-sidebar-wrapper features-sidebar-template-wrapper',
											'options' => $kodeproperty_plugin_option['sidebar-element'],
										),	
										'features-num-excerpt' => array(
											'title' => __('Num Excerpt', 'kode-property-list'),
											'type' => 'text',						
											'default' => '300',
											'description'=> esc_attr__('Number of Character Show on Excerpt.', 'kode-property-list'),
										),
										'features-fetch' => array(
											'title' => __('Properties Show', 'kode-property-list'),
											'type' => 'text',						
											'default' => '6',
											'description'=> esc_attr__('Number of Properties Show on page.', 'kode-property-list'),
										),
										'features-pagination' => array(
											'title' => esc_html__('Property Filter Pagination', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('Please enable / disable the property Property Filter Detail page Pagination from here.', 'kode-property-list'),
											'default' => 'enable',
										),
										'features-background' => array(
											'title' => __('Property Filter Header Background Image' , 'kode-property-list'),
											'button' => __('Upload', 'kode-property-list'),
											'type' => 'upload',
											'description' => 'Click here to Upload the Property Header Background Image.',
										),
										
									)
								),
								'mortgage-calculator' =>  array(
									'title' => esc_html__('Mortgage Calculator', 'kode-property-list'),
									'options' => array(
										'mortgage-calc' => array(
											'title' => __('Select Mortgage Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> '',
											'description'=> esc_html__('Please select the page where you have added the Mortgage Calculator element from pagebuilder.', 'kode-property-list'),
										),
										'calc_title' => array(
											'title' => esc_html__('Calculator Title', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the title to display for the Calculator', 'kode-property-list'),
											'default' => 'Mortgage Calculator',
										),
										'send_email_text' => array(
											'title' => esc_html__('Email Text', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the description for sending an email with PDF report.', 'kode-property-list'),											
											'default' => 'Send A PDF report to your email?',
										),
										'email_placeholder' => array(
											'title' => esc_html__('Email Label', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the placeholder text for the email field.', 'kode-property-list'),
											'default' => 'Your Email',
										),
										'purchase_price_label' => array(
											'title' => esc_html__('Amount Label', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the text for the Amount Field.', 'kode-property-list'),
											'default' => 'Mortgage Amount',
										),
										'purchase_price_info' => array(
											'title' => esc_html__('Amount Info Bubble', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the information bubble text for the Amount Field.', 'kode-property-list'),
											'default' => 'The total purchase price of the home you wish to buy.',
										),
										'purchase_price' => array(
											'title' => esc_html__('Default Purchase Price', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set a default purchase price for the calculator', 'kode-property-list'),
											'default' => '224,000.00',
										),
										'interest_rate_label' => array(
											'title' => esc_html__('Interest Label', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the text for the Interest Rate Field.', 'kode-property-list'),
											'default' => 'Interest Rate (%)',
										),
										'interest_rate_info' => array(
											'title' => esc_html__('Interest Info Bubble', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the information bubble text for the Interest Rate Field.', 'kode-property-list'),
											'default' => 'The expected percent interest rate you will get on your mortgage.',
										),
										'interest_rate' => array(
											'title' => esc_html__('Default Interest Rate (Percent)', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the default interest rate for the calculator', 'kode-property-list'),
											'default' => '5.5',
										),
										'down_payment_label' => array(
											'title' => esc_html__('Down Payment Label', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the text for the Down Payment Field.', 'kode-property-list'),
											'default' => 'Down Payment (%)',
										),
										'down_payment_info' => array(
											'title' => esc_html__('Down Payment Info Bubble', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the information bubble text for the Down Payment Field.', 'kode-property-list'),
											'default' => 'The percent down payment you wish to put towards the home.',
										),
										'down_payment_type' => array(
											'title' => esc_html__('Down Payment Label', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose whether to use percent or amount input for the down payment', 'kode-property-list'),
											'default' => 'percent',
											'options' => array(
												'percent' => esc_html__('Percent', 'kode-property-list'),
												'amount' => esc_html__('Amount', 'kode-property-list')
											)
										),
										'down_payment' => array(
											'title' => esc_html__('Default Down Payment', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the default down payment amount', 'kode-property-list'),
											'default' => '10',
										),
										'loan_term_label' => array(
											'title' => esc_html__('Loan Term Label', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the text for the Loan Term Field.', 'kode-property-list'),
											'default' => 'Term',
										),
										'loan_term_info' => array(
											'title' => esc_html__('Loan Term Info', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the information bubble text for the Loan Term Field.', 'kode-property-list'),
											'default' => 'The length of time it will take to repay the loan amount (30 years is common).',
										),
										'loan_term' => array(
											'title' => esc_html__('Default Loan Term', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the default loan term for the calculator', 'kode-property-list'),
											'default' => '30',
										),
										'enable_insurance' => array(
											'title' => esc_html__('Enable Insurance Cost Estimate', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose whether to give a homeowners insurance estimate', 'kode-property-list'),
											'default' => 'yes',
											'options' => array(
												'yes' => esc_html__('Yes', 'kode-property-list'),
												'no' => esc_html__('No', 'kode-property-list')
											)
										),
										'insurance_amount_percent' => array(
											'title' => esc_html__('Insurance Amount Type', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('This affects the value below as to whether it is a set amount or percent of the loan (divided by 12) per month', 'kode-property-list'),
											'default' => 'percent',
											'options' => array(
												'percent' => esc_html__('Percent', 'kode-property-list'),
												'amount' => esc_html__('Amount', 'kode-property-list')
											)
										),
										'insurance' => array(
											'title' => esc_html__('Monthly Insurance Cost Estimate', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the monthly insurance cost or the percent (depending on what whas chosen above) for the calculator', 'kode-property-list'),
											'default' => '56.00',
										),
										'enable_pmi' => array(
											'title' => esc_html__('Enable Monthly Insurance Cost Estimate', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose whether to give a PMI estimate', 'kode-property-list'),
											'default' => 'yes',
											'options' => array(
												'yes' => esc_html__('Yes', 'kode-property-list'),
												'no' => esc_html__('No', 'kode-property-list')
											)
										),
										'pmi' => array(
											'title' => esc_html__('Monthly PMI Cost Estimate', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the monthly PMI cost for the calculator. If you dont know, leave this as-is. This is just an average cost per 100,000 dollars borrowed.', 'kode-property-list'),
											'default' => '55.00',
										),
										'enable_taxes' => array(
											'title' => esc_html__('Enable Tax Cost Estimate', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose whether to give a tax estimate or not', 'kode-property-list'),
											'default' => 'yes',
											'options' => array(
												'yes' => esc_html__('Yes', 'kode-property-list'),
												'no' => esc_html__('No', 'kode-property-list')
											)
										),
										'tax_rate' => array(
											'title' => esc_html__('Tax Assessed', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the tax rate per 1000 dollars assessed. If you dont know, leave this as-is. This is just an average cost based on assessed value.', 'kode-property-list'),
											'default' => '10.00',
										),
										'disclaimer' => array(
											'title' => esc_html__('Disclaimer Notice', 'kode-property-list'),
											'type' => 'textarea',
											'description'=> esc_html__('Write the Disclaimer note here in the area.', 'kode-property-list'),
											'default' => 'Calculations by this calculator are estimates only. There is no warranty for the accuracy of the results or the relationship to your financial situation.',
										),
										'currency' => array(
											'title' => esc_html__('Currency Symbol', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the currency symbol used in the Calculator (default $)', 'kode-property-list'),
											'default' => '$',
										),
										'currency_format' => array(
											'title' => esc_html__('Currency Format', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose the currency format you would like to use.', 'kode-property-list'),
											'default' => 'standard',
											'options' => array(
												'standard' => esc_html__('Standard Format(e.g 100,000.00)', 'kode-property-list'),
												'switched' => esc_html__('Switched Format(e.g 100,000.00)', 'kode-property-list'),
												'spaces' => esc_html__('Spaces & Commas Format(e.g 100,000.00)', 'kode-property-list')
											)
										),
										'currency_side' => array(
											'title' => esc_html__('Currency Symbol Side', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose the side for the currency symbol.', 'kode-property-list'),
											'default' => 'left',
											'options' => array(
												'left' => esc_html__('Left (e.g 100,000.00)', 'kode-property-list'),
												'right' => esc_html__('Right (e.g 100,000.00)', 'kode-property-list'),
											)
										),
									)
								),
								'email-settings' =>  array(
									'title' => esc_html__('Email & PDF Settings', 'kode-property-list'),
									'options' => array(
										'allow_email' => array(
											'title' => esc_html__('Allow Email Report', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Choose whether to allow Email Reports to users or not', 'kode-property-list'),
											'default' => 'yes',
											'options' => array(
												'yes' => esc_html__('Yes', 'kode-property-list'),
												'no' => esc_html__('No', 'kode-property-list')
											)
										),
										'email_bcc' => array(
											'title' => esc_html__('BCC Email Address', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the email to receive a hidden copy (BCC - Blind Carbon Copy) of the user generated report', 'kode-property-list'),
											'default' => '',
										),
										'email_from' => array(
											'title' => esc_html__('From Email Address', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Set the From Address for the email sent to the user. Make sure that your server will allow the email you choose as the from address.', 'kode-property-list'),
											'default' => '',
										),
										'email_subject' => array(
											'title' => esc_html__('Custom Email Subject', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter the custom email subject here.', 'kode-property-list'),
											'default' => 'Mortgage calculation results',
										),
										'email_text' => array(
											'title' => esc_html__('Custom Email Text', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter the custom email text over here.', 'kode-property-list'),
											'default' => 'Attached are your custom results from our Calculator.  Feel free to contact us with any questions!',
										),
										'pdf_color' => array(
											'title' => esc_html__('Primary PDF Color', 'kode-property-list'),
											'type' => 'colorpicker',
											'description'=> esc_html__('Set your custom primary color for the PDF Results', 'kode-property-list'),
											'default' => '#00bfa5',
											'selector'=> ''
										),
										'logo_attachment_url' => array(
											'title' => __('PDF Logo or Header Image (jpeg or png)' , 'kode-property-list'),
											'button' => __('Upload', 'kode-property-list'),
											'type' => 'upload',
											'description' => 'Click here to Upload the image.',
										),
										'pdf_header' => array(
											'title' => esc_html__('PDF Header Large Text', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Large Text at the top of the PDF', 'kode-property-list'),
											'default' => 'Mortgage Estimate Result',
										),
										
									)
								),
							)
						),	
						// general menu
						'property-api-keys' => array(
							'title' => esc_html__('Property API Keys', 'kode-property-list'),				
							'icon' => 'fa fa-key',
							'options' => array(
								'g_api_configuration' => array(
									'title' => esc_html__('Google API', 'kode-property'),
									'options' => array(		
										'google-public-api' => array(
											'title' => esc_html__('Public Key (Sitekey) - Google Recaptcha', 'kode-property'),
											'type' => 'text',
											'default' => 'API KEY',
											'description' => 'Please add mail google public which also known as sitekey here
												<p>you can get API from here, https://www.google.com/recaptcha/admin#site/</p>
												<p>Step 1: Login to Your Gmail Account</p>
												<p>Step 2: It will redirect you back https://www.google.com/recaptcha/admin#site/ Register a new site add Label Anything for example : Kodeforest project </p>
												<p>Step 3: Add your domains for example: kodeforest.com one per line.</p>
												<p>Step 4: Click On Register</p>'
										),									
										'google-secret-api' => array(
											'title' => esc_html__('Secret Key(Secret) - Google Recaptcha', 'kode-property'),
											'type' => 'text',
											'description' => 'Please add secret key here 
												<p>you can get API from here, https://www.google.com/recaptcha/admin#site/</p>
												<p>Step 1: Login to Your Gmail Account</p>
												<p>Step 2: It will redirect you back https://www.google.com/recaptcha/admin#site/ Register a new site add Label Anything for example : Kodeforest project </p>
												<p>Step 3: Add your domains for example: kodeforest.com one per line.</p>
												<p>Step 4: Click On Register</p>'
										),
										'google-map-api' => array(
											'title' => esc_html__('Google Map Api', 'kode-property'),
											'type' => 'text',
											'description' => 'Please add google map api key here <p>You can get Google Map Api Key from https://developers.google.com/maps/web/.</p>
												<p>Step 1: Login to Your Gmail Account</p>
												<p>Step 2: It will redirect you back https://developers.google.com/maps/web/ Click on Get A Key > Popup Will Appear Click Continue.</p>
												<p>Step 3: It will take some time to take you right place where you should be.</p>
												<p>Step 4: On left of screen a dropdown and button will appear click on dropdown <strong>create new project</strong></p>
												<p>Step 5: Click on Continue After a while it will show you credential tab.</p>
												<p>Step 6: Add Name of Project And Under it add Your Site URl or Add *.</p>
												<p>Step 7: Click on Create and Grab your key and paste in Google MAP api.</p>
												'
										)
									)
								),
							)
						),
						'properties' => array(
							'title' => esc_html__('Properties', 'kode-property-list'),				
							'icon' => 'fa fa-building-o',
							'options' => array(
								'property-feature' => array(
									'title' => esc_html__('Property Features', 'kode-property-list'),
									'options' => array(
										'select-page' => array(
											'title' => __('Select Page', 'kode-property-list'),
											'type'=> 'combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_post_list_id('page'),
											'description'=> esc_html__('Please select the page.', 'kode-property-list'),
										),
										'select-features'=> array(
											'title'=> __('Features' ,'kode-property-list'),
											'type'=> 'multi-combobox',
											'options'=> $kodeproperty_func_utility->kodeproperty_get_term_list_id('features'),
											'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'kode-property-list')
										),												
										'select-style' => array(
											'title' => esc_html__('Select Style', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Select the style', 'kode-property-list'),
											'default' => 'style-1',
											'options' => array(
												'style-1' => esc_html__('Style 1', 'kode-property-list'),
												'style-2' => esc_html__('Style 2', 'kode-property-list'),
											)
										),
										'select-columns' => array(
											'title' => esc_html__('Select Columns', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Select Columns', 'kode-property-list'),
											'default' => '4',
											'options' => array(
												'1' => esc_html__('1 Column', 'kode-property-list'),
												'2' => esc_html__('2 Columns', 'kode-property-list'),
												'3' => esc_html__('3 Columns', 'kode-property-list'),
												'4' => esc_html__('4 Columns', 'kode-property-list'),
											)
										),
										'num-fetch' => array(
											'title' => esc_html__('Num Fetch', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter Number of Properties to fetch', 'kode-property-list'),
											'default' => '6',
										),
										'num-excerpt' => array(
											'title' => esc_html__('Num Description', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter Number of Description you want to pull Out', 'kode-property-list'),
											'default' => '200',
										),
										'pagination' => array(
											'title' => esc_html__('Pagination', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('Please enable / disable the Pagination from here.', 'kode-property-list'),
											'default' => 'enable',
										),
										'margin-bottom' => array(
											'title' => esc_html__('Margin Bottom', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Spaces After ending of this item', 'kode-property-list'),
											'default' => '20',
										),
										
									)
								),
								'property-status' => array(
									'title' => esc_html__('Property Status', 'kode-property'),
									'options' => array(
										'select-status' => array(
											'title' => __('Select Status', 'kode-property-list'),
											'type'=> 'multi-combobox',
											
											'options'=>$kodeproperty_func_utility->kodeproperty_get_term_list('status'),
											'description'=> esc_html__('Please select the Status.', 'kode-property-list'),
										),
										'select-style' => array(
											'title' => esc_html__('Select Style', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Select the style', 'kode-property-list'),
											'default' => 'style-1',
											'options' => array(
												'style-1' => esc_html__('Style 1', 'kode-property-list'),
												'style-2' => esc_html__('Style 2', 'kode-property-list'),
											)
										),
										'select-columns' => array(
											'title' => esc_html__('Select Columns', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Select Columns', 'kode-property-list'),
											'default' => '4',
											'options' => array(
												'1' => esc_html__('1 Column', 'kode-property-list'),
												'2' => esc_html__('2 Columns', 'kode-property-list'),
												'3' => esc_html__('3 Columns', 'kode-property-list'),
												'4' => esc_html__('4 Columns', 'kode-property-list'),
											)
										),
										'num-fetch' => array(
											'title' => esc_html__('Num Fetch', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter Number of Properties to fetch', 'kode-property-list'),
											'default' => '6',
										),
										'num-excerpt' => array(
											'title' => esc_html__('Num Description', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter Number of Description you want to pull Out', 'kode-property-list'),
											'default' => '200',
										),
										'pagination' => array(
											'title' => esc_html__('Pagination', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('Please enable / disable the Pagination from here.', 'kode-property-list'),
											'default' => 'enable',
										),
										'margin-bottom' => array(
											'title' => esc_html__('Margin Bottom', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Spaces After ending of this item', 'kode-property-list'),
											'default' => '20',
										),
										
									)
								),
								'listing-type' => array(
									'title' => esc_html__('Listing Type', 'kode-property'),
									'options' => array(
										'select-listing-type' => array(
											'title' => __('Select Listing Type', 'kode-property-list'),
											'type'=> 'multi-combobox',
											
											'options'=>$kodeproperty_func_utility->kodeproperty_get_term_list('status'),
											'description'=> esc_html__('Please select the Status.', 'kode-property-list'),
										),
										'select-style' => array(
											'title' => esc_html__('Select Style', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Select the style', 'kode-property-list'),
											'default' => 'style-1',
											'options' => array(
												'style-1' => esc_html__('Style 1', 'kode-property-list'),
												'style-2' => esc_html__('Style 2', 'kode-property-list'),
											)
										),
										'select-columns' => array(
											'title' => esc_html__('Select Columns', 'kode-property-list'),
											'type' => 'combobox',
											'description'=> esc_html__('Select Columns', 'kode-property-list'),
											'default' => '4',
											'options' => array(
												'1' => esc_html__('1 Column', 'kode-property-list'),
												'2' => esc_html__('2 Columns', 'kode-property-list'),
												'3' => esc_html__('3 Columns', 'kode-property-list'),
												'4' => esc_html__('4 Columns', 'kode-property-list'),
											)
										),
										'num-fetch' => array(
											'title' => esc_html__('Num Fetch', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter Number of Properties to fetch', 'kode-property-list'),
											'default' => '6',
										),
										'num-excerpt' => array(
											'title' => esc_html__('Num Description', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Enter Number of Description you want to pull Out', 'kode-property-list'),
											'default' => '200',
										),
										'pagination' => array(
											'title' => esc_html__('Pagination', 'kode-property-list'),
											'type' => 'checkbox',
											'description'=> esc_html__('Please enable / disable the Pagination from here.', 'kode-property-list'),
											'default' => 'enable',
										),
										'margin-bottom' => array(
											'title' => esc_html__('Margin Bottom', 'kode-property-list'),
											'type' => 'text',
											'description'=> esc_html__('Spaces After ending of this item', 'kode-property-list'),
											'default' => '20',
										),
										
									)
								),
							)
						),
						'importer' => array(
							'title' => esc_html__('Importer', 'kode-property-list'),				
							'icon' => 'fa fa-reply-all',
							'options' => array(
								'import-export-option' => array(
									'title' => esc_html__('Import/Export Option', 'kode-property'),
									'options' => array(
										'export-option' => array(
											'title' => esc_html__('Export Option', 'kode-property'),
											'type' => 'custom',
											'description'=> esc_html__('Here you can copy/download your themes current option settings. Keep this safe as you can use it as a backup should anything go wrong. Or you can use it to restore your settings on this site (or any other site). You also have the handy option to copy the link to yours sites settings. Which you can then use to duplicate on another site.', 'kode-property'),
											'option' => 
												'<input type="button" id="kode-export" class="kdf-button" value="' . esc_html__('Export', 'kode-property') . '" />' .
												'<textarea class="full-width"></textarea>'
										),
										'import-option' => array(
											'title' => esc_html__('Import Option', 'kode-property'),
											'type' => 'custom',
											'description'=> esc_html__('WARNING! This will overwrite any existing options, please proceed with caution!', 'kode-property'),
											'option' => 
												'<input type="button" id="kode-import" class="kdf-button" value="' . esc_html__('Import', 'kode-property') . '" />' .
												'<textarea class="full-width"></textarea>'
										),										
									)
								),
							),
						),	
					)	
				), 
				
				
				
				$kodeproperty_plugin_option
			);
			
		}
		
	}
	
	
	//Strip Down slashes
	if( !function_exists('kodeproperty_stripslashes') ){
		function kodeproperty_stripslashes($data){
			$data = is_array($data) ? array_map('stripslashes_deep', $data) : stripslashes($data);
			return $data;
		}
	}
	//Stop backslashes from Array
	if( !function_exists('kodeproperty_stopbackslashes') ){
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
	}
	//decode and Stop back slashes
	if( !function_exists('kodeproperty_decode_stopbackslashes') ){
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
	}	

?>