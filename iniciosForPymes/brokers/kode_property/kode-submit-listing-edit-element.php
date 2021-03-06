<?php
// don't load directly
if (!defined('ABSPATH')) die('-1');

class kodeproperty_extend_vc_property_submit_listing_edit_addon {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'kodeproperty_vc_notice' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'submit_listing_edit_item', array( $this, 'kodeproperty_print_element' ) );
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
            "name" => __("Submit Listing Edit", 'vc_extend'),
            //"description" => __("Fetch all the property posts from by category or tags.", 'vc_extend'),
			"description" => __("KodeForest", 'vc_extend'),
            "base" => "submit_listing_edit_item",
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
					"heading" => __("Element Item Id", 'vc_extend'),
					"param_name" => "element_item_id",
					"value" => __(" ", 'vc_extend'),
					"description" => __("please add the page item id.", 'vc_extend')
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Element Item Class", 'vc_extend'),
					"param_name" => "element_item_class",
					"value" => __(" ", 'vc_extend'),
					"description" => __("please add the page item class.", 'vc_extend')
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Margin Bottom", 'vc_extend'),
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
			'margin_bottom' => '',
		), $atts ) );
		
		

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content	
		$settings['element-item-id'] = empty($element_item_id)? ' ': $element_item_id;	
		$settings['element-item-class'] = empty($element_item_class)? ' ': $element_item_class;	
		$settings['margin-bottom'] = empty($margin_bottom)? ' ': $margin_bottom;	

		
		$output = '<div class="row">'.kodeproperty_submit_listing_edit($settings).'</div>';
		return $output;
    }
    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function kodeproperty_load_style() {
    //  wp_register_style( 'vc_extend_style', plugins_url('assets/vc_extend.css', __FILE__) );
    //  wp_enqueue_style( 'vc_extend_style' );
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
new kodeproperty_extend_vc_property_submit_listing_edit_addon();