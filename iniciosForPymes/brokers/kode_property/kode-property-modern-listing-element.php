<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

class kodeproperty_extend_vc_property_modern_listing_addon {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'kodeproperty_vc_notice' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'property_modern_listing_item', array( $this, 'kodeproperty_print_element' ) );
        // Register CSS and JS
        // add_action( 'wp_enqueue_scripts', array( $this, 'kodeproperty_load_style' ) );
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
            "name" => __("Property Modern Listing", 'vc_extend'),
            //"description" => __("Fetch all the property posts from by category or tags.", 'vc_extend'),
			"description" => __("KodeForest", 'vc_extend'),
            "base" => "property_modern_listing_item",
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
					"heading" => __("Title Num Length (Word)", 'kode-property-list'),
					"param_name" => "title_num_excerpt",
					"value" => __(" ", 'vc_extend'),
					"description" => __("This is a number of word (decided by spaces) that you want to show on the property title.", 'vc_extend')
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Select Post', 'kode-property-list' ),
					'param_name' => 'list_post',
					'value' => kodeproperty_get_post_list_id_firstempty('property'),
					'description' => __( 'Select Post from here.', 'kode-property-list' )
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Select Style', 'kode-property-list' ),
					'param_name' => 'style',
					'value' => array(
						__( ' ', 'kode-property-list' ) => 'no-filter',
						__( 'Full List', 'kode-property-list' ) => 'full',
						__( 'Small List', 'kode-property-list' ) => 'small',
					),
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
			'title_num_excerpt' => '',
			'list_post' => '',
			'style' => '',
			'thumbnail_size' => '',
			'orderby' => '',
			'order' => '',
			'margin_bottom' => '',
		), $atts ) );
		
		

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content	
		$settings['title-num-excerpt'] = empty($title_num_excerpt)? 30: $title_num_excerpt;		
		$settings['list-post'] = empty($list_post)? ' ': $list_post;
		$settings['style'] = empty($style)? ' ': $style;		
		$settings['thumbnail-size'] = empty($thumbnail_size)? ' ': $thumbnail_size;		
		$settings['orderby'] = empty($orderby)? ' ': $orderby;		
		$settings['order'] = empty($order)? ' ': $order;		
		$settings['margin-bottom'] = empty($margin_bottom)? ' ': $margin_bottom;	

		
		$output = '<div class="row">'.kodeproperty_modern_list_property($settings).'</div>';
		return $output;
    }
    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function kodeproperty_load_style() {
     // wp_register_style( 'vc_extend_style', plugins_url('assets/vc_extend.css', __FILE__) );
     // wp_enqueue_style( 'vc_extend_style' );
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
new kodeproperty_extend_vc_property_modern_listing_addon();