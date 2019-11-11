<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

class kodeproperty_extend_vc_property_addon {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'kodeproperty_vc_notice' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'property_item', array( $this, 'kodeproperty_print_element' ) );
        // Register CSS and JS
         add_action( 'wp_enqueue_scripts', array( $this, 'kodeproperty_load_style' ) );
    }
 
    public function kodeproperty_vc_notice() {
        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            // add_action('admin_notices', array( $this, 'kodeproperty_print_vc_notice' ));
            return;
        }
 
        /*
        Add your Visual Composer logic here.
        Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.
        More info: http://kb.wpbakery.com/index.php?title=Vc_map
        */
        vc_map( array(
            "name" => __("Property", 'vc_extend'),
            //"description" => __("Fetch all the property posts from by category or tags.", 'vc_extend'),
			"description" => __("KodeForest", 'vc_extend'),
            "base" => "property_item",
            "class" => "",
            "controls" => "full",
            "icon" => 'call-to-action', // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('KodeForest', 'kode-property-list'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
           'admin_enqueue_css' => array(plugins_url('assets/vc_style_extend.css', __FILE__)), // This will load css file in the VC backend editor
           "params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Element Item Id", 'kode-property-list'),
					"param_name" => "element_item_id",
					"value" => __(" ", 'vc_extend'),
					"description" => __("please add the page item id.", 'vc_extend')
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Element Item Id", 'kode-property-list'),
					"param_name" => "element_item_class",
					"value" => __(" ", 'vc_extend'),
					"description" => __("please add the page item id.", 'vc_extend')
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Property Filter', 'kode-property-list' ),
					'param_name' => 'property_filter',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-filter',
						__( 'Show', 'kode-property-list' ) => 'show',
						__( 'Hide', 'kode-property-list' ) => 'hide',
					),
					'description' => __( 'Show Filter of Property.', 'kode-property-list' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Property Listing', 'kode-property-list' ),
					'param_name' => 'property_listing',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-filter',
						__( 'Show', 'kode-property-list' ) => 'show',
						__( 'Hide', 'kode-property-list' ) => 'hide',
					),
					'description' => __( 'Show property listing or hide it from here.', 'kode-property-list' )
				),	
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Title Word Limit", 'kode-property-list'),
					"param_name" => "title_num_excerpt",
					"value" => __(" ", 'vc_extend'),
					"description" => __("Specify the number of title words to pull out.", 'vc_extend')
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Select Features', 'kode-property-list' ),
					'param_name' => 'features',
					'value' => kodeproperty_get_term_list_emptyfirst('features'),
					'description' => __( 'Select Features.', 'kode-property-list' )
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Select Status', 'kode-property-list' ),
					'param_name' => 'status',
					'value' => kodeproperty_get_term_list_emptyfirst('status'),
					'description' => __( 'Select Status.', 'kode-property-list' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Property Listing Type', 'kode-property-list' ),
					'param_name' => 'property_listing_type',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-filter',
						__( 'Simple', 'kode-property-list' ) => 'simple',
						__( 'Slider', 'kode-property-list' ) => 'slider',
					),
					'description' => __( 'Show property listing simple or in slider.', 'kode-property-list' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Property Listing Style', 'kode-property-list' ),
					'param_name' => 'property_style',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-filter',
						__( 'Grid View', 'kode-property-list' ) => 'grid-view',
						__( 'Modern Grid View', 'kode-property-list' ) => 'modern-grid-view',
						__( 'Simple Full View', 'kode-property-list' ) => 'simple-full-view',
						__( 'Normal Full View', 'kode-property-list' ) => 'normal-full-view',
						__( 'Modern Full View', 'kode-property-list' ) => 'modern-full-view',
					),
					'description' => __( 'Show property listing style.', 'kode-property-list' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Select Thumbnail', 'kode-property-list' ),
					'param_name' => 'thumbnail_size',
					'value' => kodeproperty_get_thumbnail_list_emptyfirst(),
					'description' => __( 'Select Thumbnail.', 'kode-property-list' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Property Column Size', 'kode-property-list' ),
					'param_name' => 'property_column',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-filter',
						__( '2 COlumn', 'kode-property-list' ) => '2',
						__( '3 Column', 'kode-property-list' ) => '3',
						__( '4 COlumn', 'kode-property-list' ) => '4',
					),
					'description' => __( 'Show property column size works only at grid and modern grid.', 'kode-property-list' )
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Num Fetch", 'kode-property-list'),
					"param_name" => "num_fetch",
					"value" => __(" ", 'vc_extend'),
					"description" => __("Specify the number of propertys you want to pull out.", 'vc_extend')
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Num Excerpt", 'kode-property-list'),
					"param_name" => "num_excerpt",
					"value" => __(" ", 'vc_extend'),
					"description" => __("Specify the number of propertys description you want to pull out.", 'vc_extend')
				),				
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order By', 'kode-property-list' ),
					'param_name' => 'orderby',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-category',
						__( 'Publish Date', 'kode-property-list' ) => 'date',
						__( 'Title', 'kode-property-list' ) => 'title',
						__( 'Random', 'kode-property-list' ) => 'rand',
					),				
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order', 'kode-property-list' ),
					'param_name' => 'order',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-category',
						__( 'Descending Order', 'kode-property-list' ) => 'desc',
						__( 'Ascending Order', 'kode-property-list' ) => 'asc'						
					),				
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Pagination', 'kode-property-list' ),
					'param_name' => 'pagination',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-category',
						__( 'Enable', 'kode-property-list' ) => 'enable',
						__( 'Disable', 'kode-property-list' ) => 'disable'						
					),				
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Margin Bottom", 'kode-property-list'),
					"param_name" => "margin_bottom",
					"value" => __(" ", 'vc_extend'),
					"description" => __("Specify the number to add margin at bottom of the element.", 'vc_extend')
				),
            )
        ) );
    }
	
	
    
    /*
    Shortcode logic how it should be rendered
    */
    public function kodeproperty_print_element( $atts, $content = null ) {
		extract( shortcode_atts( array( 
			'element_item_id' => '',
			'element_item_class' => '',
			'property_filter' => '',
			'property_listing' => '',
			'title_num_excerpt' => '',
			'features' => '',
			'status' => '',
			'property_listing_type' => '',
			'property_style' => '',
			'thumbnail_size' => '',
			'property_column' => '',
			'num_fetch' => '',
			'num_excerpt' => '',
			'orderby' => '',
			'order' => '',
			'pagination' => '',
			'margin_bottom' => '',
		), $atts ) );
		
		

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content	
		$settings['element-item-id'] = empty($element_item_id)? ' ': $element_item_id;	
		$settings['element-item-class'] = empty($element_item_class)? ' ': $element_item_class;	
		$settings['property-filter'] = empty($property_filter)? ' ': $property_filter;		
		$settings['property-listing'] = empty($property_listing)? ' ': $property_listing;		
		$settings['title-num-excerpt'] = empty($title_num_excerpt)? 30: $title_num_excerpt;		
		$settings['features'] = empty($features)? ' ': $features;
		$settings['status'] = empty($status)? ' ': $status;		
		$settings['property-listing-type'] = empty($property_listing_type)? ' ': $property_listing_type;		
		$settings['property-style'] = empty($property_style)? ' ': $property_style;		
		$settings['thumbnail-size'] = empty($thumbnail_size)? ' ': $thumbnail_size;		
		$settings['property-column'] = empty($property_column)? ' ': $property_column;				
		$settings['num-excerpt'] = empty($num_excerpt)? ' ': $num_excerpt;
		$settings['num-fetch'] = empty($num_fetch)? ' ': $num_fetch;		
		$settings['orderby'] = empty($orderby)? ' ': $orderby;		
		$settings['order'] = empty($order)? ' ': $order;		
		$settings['pagination'] = empty($pagination)? ' ': $pagination;				
		$settings['margin-bottom'] = empty($margin_bottom)? ' ': $margin_bottom;	

		
		$output = '<div class="row">'.kodeproperty_get_property_item($settings).'</div>';
		return $output;
    }
    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function kodeproperty_load_style() {
     // wp_register_style( 'vc_extend_style', plugins_url('assets/vc_extend.css', __FILE__) );
     // wp_enqueue_style( 'vc_extend_style' );
	  wp_register_script('owl_carousel', KODEPROPERTY_PATH_URL.'/scripts_styles/owl_carousel/owl_carousel.js', false, '1.0', true);
	  wp_enqueue_script('owl_carousel');
	  wp_enqueue_style( 'owl_carousel', KODEPROPERTY_PATH_URL . '/scripts_styles/owl_carousel/owl_carousel.css' );  //Font Awesome

      // If you need any javascript files on front end, here is how you can load them.
      //wp_enqueue_script( 'vc_extend_js', plugins_url('assets/vc_extend.js', __FILE__), array('jquery') );
    }
    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function kodeproperty_print_vc_notice() {
        // $plugin_data = get_plugin_data(__FILE__);
        // echo '
        // <div class="updated">
          // <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        // </div>';
    }
}
// Finally initialize code
new kodeproperty_extend_vc_property_addon();