<?php
/*
Plugin Name: KodeForest Property
Plugin URI: 
Description: A Custom Post Type Plugin To Use With KodeForest Theme ( This plugin functionality might not working properly on another theme )
Version: 1.0.0
Author: KodeForest
Author URI: http://www.kodeforest.com
License: 
*/


register_activation_hook(__FILE__,'kodeproperty_activate');
function kodeproperty_activate(){
	update_option('kodeproperty_plugin','activated');
}
//Local URL and Paths
define('KODEPROPERTY_PATH_URL', plugin_dir_url( __FILE__ ));
define('KODEPROPERTY_PATH_DIR', plugin_dir_path( __FILE__ ));

if(is_ssl()){
	define('KODEPROPERTY_HTTP', 'https://');
}else{
	define('KODEPROPERTY_HTTP', 'http://');
}
define('KODEPROPERTY_AJAX', admin_url('admin-ajax.php'));

include_once( 'kode-property-item.php');	
include_once( 'kode-property-option.php');

// action to loaded the plugin translation file
add_action('plugins_loaded', 'kodeproperty_property_init');
if( !function_exists('kodeproperty_property_init') ){
	function kodeproperty_property_init() {
		load_plugin_textdomain( 'kode-property-list', false, dirname(plugin_basename( __FILE__ ))  . '/languages/' ); 

	}
}



// add action to create property post type
add_action( 'init', 'kodeproperty_create_property' );
if( !function_exists('kodeproperty_create_property') ){
	function kodeproperty_create_property() {
		global $kodeproperty_plugin_option;
				
		$team_slug = 'property';
		$team_category_slug = 'property_category';
		$team_tag_slug = 'property_tag';		
		
		register_post_type( 'property',
			array(
				'labels' => array(
					'name'               => __('Property', 'kode-property-list'),
					'singular_name'      => __('property', 'kode-property-list'),
					'add_new'            => __('Add New', 'kode-property-list'),
					'add_new_item'       => __('Add New Property', 'kode-property-list'),
					'edit_item'          => __('Edit Property', 'kode-property-list'),
					'new_item'           => __('New Property', 'kode-property-list'),
					'all_items'          => __('All Properties', 'kode-property-list'),
					'view_item'          => __('View Property', 'kode-property-list'),
					'search_items'       => __('Search Property', 'kode-property-list'),
					'not_found'          => __('No Teams found', 'kode-property-list'),
					'not_found_in_trash' => __('No Teams found in Trash', 'kode-property-list'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Property', 'kode-property-list')
				),
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,				
				'rewrite'            => array( 'slug' => $team_slug  ),
				'capability_type'    => 'post',
				'menu_icon'    		=> 'dashicons-admin-multisite',
				'has_archive'        => true,
				'hierarchical'       => true,
				'menu_position'      => 20,
				'supports'           => array( 'title', 'editor','thumbnail', 'excerpt', 'comments', 'custom-fields' )
			)
		);
		
		// create team categories
		// register_taxonomy(
			// 'property_category', array("property"), array(
				// 'hierarchical' => true,
				// 'show_admin_column' => true,
				// 'label' => __('Property Categories', 'kode-property-list'), 
				// 'singular_label' => __('Property Category', 'kode-property-list'), 
				// 'rewrite' => array( 'slug' => $team_category_slug  )));
		// register_taxonomy_for_object_type('property_category', 'property');
		
		
		$labels = array(
			'name' => _x( 'Features', 'taxonomy general name' ),
			'singular_name' => _x( 'Features', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Feature' ),
			'popular_items' => __( 'Popular Feature' ),
			'all_items' => __( 'All Features' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Features' ), 
			'update_item' => __( 'Update Feature' ),
			'add_new_item' => __( 'Add New Feature' ),
			'new_item_name' => __( 'New Feature Name' ),
			'separate_items_with_commas' => __( 'Separate features with commas' ),
			'add_or_remove_items' => __( 'Add or remove features' ),
			'choose_from_most_used' => __( 'Choose from the most used features' ),
			'menu_name' => __( 'Features' ),
		); 
		
		// create team categories
		$rewrite = array(
			'slug'                       => 'features',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		register_taxonomy(
			'features', array("property"), array(
				'label' => __('Property Features', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Property Features', 'kode-property-list'), 
				'new_item_name' => __('Add Property Features', 'kode-property-list'), 
				'singular_label' => __('Property Features', 'kode-property-list'), 
				'hierarchical' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'public' => true,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_tagcloud' => false,
				'rewrite' => $rewrite
			)
		);
		register_taxonomy_for_object_type('features', 'property');
		
		$labels = array(
			'name' => _x( 'Listing Type', 'Type' ),
			'singular_name' => _x( 'Listing Type', 'Type' ),
			'search_items' =>  __( 'Search Listing Type' ),
			'popular_items' => __( 'Popular Listing Type' ),
			'all_items' => __( 'All Listing Type' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Listing Type' ), 
			'update_item' => __( 'Update Listing Type' ),
			'add_new_item' => __( 'Add New Listing Type' ),
			'new_item_name' => __( 'New Listing Type Name' ),
			'separate_items_with_commas' => __( 'Separate listing type with commas' ),
			'add_or_remove_items' => __( 'Add or remove listing type' ),
			'choose_from_most_used' => __( 'Choose from the most used listing type' ),
			'menu_name' => __( 'Listing Type' ),
		); 
		
		//create team categories
		register_taxonomy(
			'status', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Listing Type', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Listing Type', 'kode-property-list'), 
				'new_item_name' => __('Add Listing Type', 'kode-property-list'), 
				'singular_label' => __('Listing Type', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'listing' )));
		register_taxonomy_for_object_type('status', 'property');
		
		$labels = array(
			'name' => _x( 'Property Type', 'Type' ),
			'singular_name' => _x( 'Property Type', 'Type' ),
			'search_items' =>  __( 'Search Property Type' ),
			'popular_items' => __( 'Popular Property Type' ),
			'all_items' => __( 'All Property Type' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Property Type' ), 
			'update_item' => __( 'Update Property Type' ),
			'add_new_item' => __( 'Add New Property Type' ),
			'new_item_name' => __( 'New Property Type Name' ),
			'separate_items_with_commas' => __( 'Separate Property type with commas' ),
			'add_or_remove_items' => __( 'Add or remove Property type' ),
			'choose_from_most_used' => __( 'Choose from the most used Property type' ),
			'menu_name' => __( 'Property Type' ),
		); 
		
		//create team categories
		register_taxonomy(
			'property-type', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Property Type', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Property Type', 'kode-property-list'), 
				'new_item_name' => __('Add Property Type', 'kode-property-list'), 
				'singular_label' => __('Property Type', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'type'  )));
		register_taxonomy_for_object_type('property-type', 'property');
		
		
		$labels = array(
			'name' => _x( 'Room Type', 'Room Type' ),
			'singular_name' => _x( 'Room Type', 'Room Type' ),
			'search_items' =>  __( 'Search Room Type' ),
			'popular_items' => __( 'Popular Room Type' ),
			'all_items' => __( 'All Countries' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Room Type' ), 
			'update_item' => __( 'Update Room Type' ),
			'add_new_item' => __( 'Add New Room Type' ),
			'new_item_name' => __( 'New Room Type Name' ),
			'separate_items_with_commas' => __( 'Separate country with commas' ),
			'add_or_remove_items' => __( 'Add or remove country' ),
			'choose_from_most_used' => __( 'Choose from the most used country' ),
			'menu_name' => __( 'Room Type' ),
		); 
		
		// create team categories
		register_taxonomy(
			'room-type', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Room Type', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Room Type', 'kode-property-list'), 
				'new_item_name' => __('Add Room Type', 'kode-property-list'), 
				'singular_label' => __('Room Type', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'room-type'  )));
		register_taxonomy_for_object_type('room-type', 'property');
		
		
		$labels = array(
			'name' => _x( 'State', 'State' ),
			'singular_name' => _x( 'State', 'State' ),
			'search_items' =>  __( 'Search State' ),
			'popular_items' => __( 'Popular State' ),
			'all_items' => __( 'All Countries' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit State' ), 
			'update_item' => __( 'Update State' ),
			'add_new_item' => __( 'Add New State' ),
			'new_item_name' => __( 'New State Name' ),
			'separate_items_with_commas' => __( 'Separate state with commas' ),
			'add_or_remove_items' => __( 'Add or remove state' ),
			'choose_from_most_used' => __( 'Choose from the most used state' ),
			'menu_name' => __( 'State' ),
		); 
		
		// create team categories
		register_taxonomy(
			'state', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Property State', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Property State', 'kode-property-list'), 
				'new_item_name' => __('Add Property State', 'kode-property-list'), 
				'singular_label' => __('Property State', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'state'  )));
		register_taxonomy_for_object_type('state', 'property');
		
		$labels = array(
			'name' => _x( 'City', 'City' ),
			'singular_name' => _x( 'City', 'City' ),
			'search_items' =>  __( 'Search City' ),
			'popular_items' => __( 'Popular City' ),
			'all_items' => __( 'All Cities' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit City' ), 
			'update_item' => __( 'Update City' ),
			'add_new_item' => __( 'Add New City' ),
			'new_item_name' => __( 'New City Name' ),
			'separate_items_with_commas' => __( 'Separate city with commas' ),
			'add_or_remove_items' => __( 'Add or remove city' ),
			'choose_from_most_used' => __( 'Choose from the most used city' ),
			'menu_name' => __( 'City' ),
		); 
		
		// create team categories
		register_taxonomy(
			'city', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Property City', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Property City', 'kode-property-list'), 
				'new_item_name' => __('Add Property City', 'kode-property-list'), 
				'singular_label' => __('Property City', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'city' )));
		register_taxonomy_for_object_type('city', 'property');
		
		$labels = array(
			'name' => _x( 'Country', 'Country' ),
			'singular_name' => _x( 'Country', 'Country' ),
			'search_items' =>  __( 'Search Country' ),
			'popular_items' => __( 'Popular Country' ),
			'all_items' => __( 'All Countries' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Country' ), 
			'update_item' => __( 'Update Country' ),
			'add_new_item' => __( 'Add New Country' ),
			'new_item_name' => __( 'New Country Name' ),
			'separate_items_with_commas' => __( 'Separate country with commas' ),
			'add_or_remove_items' => __( 'Add or remove country' ),
			'choose_from_most_used' => __( 'Choose from the most used country' ),
			'menu_name' => __( 'Country' ),
		); 
		
		// create team categories
		register_taxonomy(
			'country', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Property Country', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Property Country', 'kode-property-list'), 
				'new_item_name' => __('Add Property Country', 'kode-property-list'), 
				'singular_label' => __('Property Country', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'country'  )));
		register_taxonomy_for_object_type('country', 'property');
		
		
		$labels = array(
			'name' => _x( 'Neighborhood', 'Neighborhood' ),
			'singular_name' => _x( 'Neighborhood', 'Neighborhood' ),
			'search_items' =>  __( 'Search Neighborhood' ),
			'popular_items' => __( 'Popular Neighborhood' ),
			'all_items' => __( 'All Countries' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Neighborhood' ), 
			'update_item' => __( 'Update Neighborhood' ),
			'add_new_item' => __( 'Add New Neighborhood' ),
			'new_item_name' => __( 'New Neighborhood Name' ),
			'separate_items_with_commas' => __( 'Separate neighborhood with commas' ),
			'add_or_remove_items' => __( 'Add or remove neighborhood' ),
			'choose_from_most_used' => __( 'Choose from the most used neighborhood' ),
			'menu_name' => __( 'Neighborhood' ),
		); 
		 	
		// create team categories
		register_taxonomy(
			'neighborhood', array("property"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Neighborhood', 'kode-property-list'), 
				'labels' => $labels, 
				'add_new_item' => __('Add Neighborhood', 'kode-property-list'), 
				'new_item_name' => __('Add Neighborhood', 'kode-property-list'), 
				'singular_label' => __('Neighborhood', 'kode-property-list'), 
				'rewrite' => array( 'slug' => 'neighborhood'  )));
		register_taxonomy_for_object_type('neighborhood', 'property');
		
		
		
		// create team tag
		// register_taxonomy(
			// 'property_tag', array('property'), array(
				// 'hierarchical' => false, 
				// 'show_admin_column' => true,
				// 'label' => __('Property Tags', 'kode-property-list'), 
				// 'singular_label' => __('Property Tag', 'kode-property-list'),  
				// 'rewrite' => array( 'slug' => $team_tag_slug  )));
		// register_taxonomy_for_object_type('property_tag', 'property');	

		// add filter to style single template
		add_filter('single_template', 'kodeproperty_register_property_template');
		
	}
}
include_once( 'kode-property-utility.php');	
$kodeproperty_func_utility = new kodeproperty_func_utility();

if( !function_exists('kodeproperty_register_property_template') ){
	function kodeproperty_register_property_template($single_template) {
		global $post,$kodeproperty_plugin_option;
		
		if ($post->post_type == 'property') {
			$single_template = dirname( __FILE__ ) . '/single-property.php';
		}
		return $single_template;	
	}
}


/** Add Custom Field To Category Form */
add_action( 'status_add_form_fields', 'category_form_custom_field_add', 10 );
add_action( 'status_edit_form_fields', 'category_form_custom_field_edit', 10, 2 );
 
function category_form_custom_field_add( $taxonomy ) {

?>
<div class="form-field">
  <label for="status_icon"><?php esc_attr__('Category Icon','kode-property');?></label>
  <input name="status_icon" id="status_icon" type="text" value="" size="fa fa-arrow" aria-required="true" />
  <p class="description"><?php esc_attr__('Add Category Icon class here for example: fa fa-lock.','kode-property');?></p>
</div>
<?php
}
 
function category_form_custom_field_edit( $tag, $taxonomy ) {
 
    $option_name = 'status_icon_' . $tag->term_id;
    $status_icon = get_option( $option_name );
	
 
?>
<tr class="form-field">
  <th scope="row" valign="top"><label for="status_icon"><?php esc_attr__('Status Icon','kode-property');?></label></th>
  <td>
    <input type="text" name="status_icon" id="status_icon" value="<?php echo esc_attr( $status_icon ) ? esc_attr( $status_icon ) : ''; ?>" size="40" aria-required="true" />
    <p class="description"><?php esc_attr__('Add Status Icon class here for example: fa fa-lock.','kode-property');?></p>
  </td>
</tr>
<?php
}
 
/** Save Custom Field Of Category Form */
add_action( 'created_status_category', 'category_form_custom_field_save', 10, 2 ); 
add_action( 'edited_status_category', 'category_form_custom_field_save', 10, 2 );
 
function category_form_custom_field_save( $term_id, $tt_id ) {
 
    if ( isset( $_POST['status_icon'] ) ) {           
        $option_name = 'status_icon_' . $term_id;
        update_option( $option_name, $_POST['status_icon'] );
    }
}




/** Add Custom Field To Category Form */
add_action( 'neighborhood_add_form_fields', 'category_form_custom_field_add_neighborhood', 10 );
add_action( 'neighborhood_edit_form_fields', 'category_form_custom_field_edit_neighborhood', 10, 2 );
 
function category_form_custom_field_add_neighborhood( $taxonomy ) {

?>
<div class="form-field">
  <label for="status_icon"><?php esc_attr__('Minutes Away','kode-property');?></label>
  <input type="text" name="mintus_away" id="mintus_away" value="" size="fa fa-arrow" aria-required="true" />
  <p class="description"><?php esc_attr__('Write Minutes Away how far this location by.','kode-property');?></p>
</div>
<div class="form-field">
  <label for="by_away"><?php esc_attr__('By','kode-property');?></label>
	<select name="by_away">
		<option><?php esc_attr__('Walk','kode-property');?></option>
		<option><?php esc_attr__('Car','kode-property');?></option>
		<option><?php esc_attr__('Train','kode-property');?></option>
	</select>	
    <p class="description"><?php esc_attr__('Select how far this neighbourhood from this location by.','kode-property');?></p>
</div>
<?php
}
 
function category_form_custom_field_edit_neighborhood( $tag, $taxonomy ) {
 
    $option_name = 'mint_' . $tag->term_id;
    $mintus_away = get_option( $option_name );
	
 
?>
<tr class="form-field">
  <th scope="row" valign="top"><label for="mintus_away"><?php esc_attr__('Minutes Away','kode-property');?></label></th>
  <td>
    <input type="text" name="mintus_away" id="mintus_away" value="<?php echo esc_attr( $mintus_away ) ? esc_attr( $mintus_away ) : ''; ?>" size="40" aria-required="true" />
    <p class="description"><?php esc_attr__('Write Minutes Away how far this location by.','kode-property');?></p>
  </td>
</tr>
<tr class="form-field">
  <th scope="row" valign="top"><label for="by_away"><?php esc_attr__('By','kode-property');?></label></th>
  <td>
    <select name="by_away">
		<option <?php echo esc_attr( $by_away ) ? 'selected' : ''; ?>><?php esc_attr__('Walk','kode-property');?></option>
		<option <?php echo esc_attr( $by_away ) ? 'selected' : ''; ?>><?php esc_attr__('Car','kode-property');?></option>
		<option <?php echo esc_attr( $by_away ) ? 'selected' : ''; ?>><?php esc_attr__('Train','kode-property');?></option>
	</select>	
    <p class="description"><?php esc_attr__('Select how far this neighbourhood from this location by.','kode-property');?></p>
  </td>
</tr>
<?php
}
 
/** Save Custom Field Of Category Form */
add_action( 'created_neighborhood_category', 'category_form_custom_neighborhood_field_save', 10, 2 ); 
add_action( 'edited_neighborhood_category', 'category_form_custom_neighborhood_field_save', 10, 2 );
 
function category_form_custom_neighborhood_field_save( $term_id, $tt_id ) {
 
    if ( isset( $_POST['mintus_away'] ) ) {           
        $option_name = 'mint_' . $term_id;
        update_option( $option_name, $_POST['mintus_away'] );
    }
	
	if ( isset( $_POST['by_away'] ) ) {           
        $option_name = 'by_away_' . $term_id;
        update_option( $option_name, $_POST['by_away'] );
    }
	
}


include_once( 'framework/include/kf-file-system.php');
include_once( 'framework/include/kf_property_plugin_meta.php');
include_once( 'framework/include/kf_property_plugin_html.php');
include_once( 'framework/include/kf_plugin_option.php');
include_once( 'framework/include/wp_customizer.php');
include_once( 'framework/include/kf_plugin_post_scripts.php');
$current_theme = strtolower(str_replace(' ','-',get_option('current_theme')));
if($current_theme <> 'kode-property'){
	include_once( 'framework/include/kf_pluginoption_color.php');
	include_once( 'framework/include/kf_property_plugin_google_fonts.php');
}
include_once( 'framework/frontend/kode_loadstyle.php');


include_once( 'kode-property-element.php');
include_once( 'kode-submit-listing-element.php');
include_once( 'kode-submit-listing-edit-element.php');
include_once( 'kode-search-form-element.php');
include_once( 'kode-property-slider-element.php');
include_once( 'kode-property-modern-listing-element.php');
include_once( 'kode-property-marker-slider-element.php');

include_once( 'kode-property-snazzymaps.php');
include_once( 'widgets/property-featured-widget.php');
include_once( 'widgets/property-top-features-widget.php');
include_once( 'widgets/property-search-widget.php');
include_once( 'widgets/property-price-filter-widget.php');
include_once( 'widgets/property-mortgage-calc-widget.php');

require_once(dirname( __FILE__ ) . '/kode-property-mortgage.php');



function kodeproperty_plugin_enqueue_style() {
	
	wp_enqueue_style( 'kode-prop-plugin-style', KODEPROPERTY_PATH_URL.'framework/frontend/css/prop-style.css', false ); 
	$current_theme = strtolower(str_replace(' ','-',get_option('current_theme')));
	if($current_theme <> 'kode-property'){
		wp_enqueue_style( 'style-custom-plugin', KODEPROPERTY_PATH_URL . 'framework/frontend/css/custom-style.css' );  //Font Awesome	
		wp_enqueue_style( 'style-bootstrap', KODEPROPERTY_PATH_URL . 'framework/frontend/css/bootstrap.css' );  //Font Awesome
		wp_enqueue_style( 'font-awesome', KODEPROPERTY_PATH_URL . 'framework/include/backend_assets/font-awesome/css/font-awesome.min.css' );  //Font Awesome
		wp_enqueue_style( 'kf-range-slider', KODEPROPERTY_PATH_URL . 'framework/frontend/css/range-slider.css' ); 
		wp_enqueue_style( 'kodeproperty-bootstrap-slider', KODEPROPERTY_PATH_URL . 'framework/frontend/css/bootstrap-slider.css' );  //Font Awesome
	}
	
	
}

function kodeproperty_plugin_enqueue_script() {
	if(is_singular('property')){
		$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
		wp_enqueue_script('kf-gomap-api', '//maps.googleapis.com/maps/api/js?libraries=places&key='.esc_attr($kodeproperty_plugin_option['google-map-api']).'');
		
		wp_register_script('owl_carousel', KODEPROPERTY_PATH_URL.'framework/frontend/owl_carousel/owl_carousel.js', false, '1.0', true);
		wp_enqueue_script('owl_carousel');
		wp_enqueue_style( 'owl_carousel', KODEPROPERTY_PATH_URL . 'framework/frontend/owl_carousel/owl_carousel.css' );  //Font Awesome
		
		wp_enqueue_style( 'bx-slider', KODEPROPERTY_PATH_URL . 'framework/frontend/bxslider/bxslider.css' );  //Font Awesome
		wp_register_script('bx-slider', KODEPROPERTY_PATH_URL.'framework/frontend/bxslider/jquery.bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('bx-slider');
	
	}
	
	$current_theme = strtolower(str_replace(' ','-',get_option('current_theme')));
	if($current_theme <> 'kode-property'){
		wp_enqueue_style('kodeproperty-chosen', KODEPROPERTY_PATH_URL . 'framework/include/backend_assets/js/kode-chosen/chosen.min.css');
		wp_register_script('kodeproperty-chosen', KODEPROPERTY_PATH_URL . 'framework/include/backend_assets/js/kode-chosen/chosen.jquery.min.js');
		wp_enqueue_script('kodeproperty-chosen');
		
		wp_register_script('kodeproperty-bootstrap', KODEPROPERTY_PATH_URL.'framework/frontend/js/bootstrap.min.js', array('jquery'), '1.0', true);
		wp_localize_script('kodeproperty-bootstrap', 'ajax_var', array('url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('ajax-nonce')));
		wp_enqueue_script('kodeproperty-bootstrap');
		
		wp_register_script('kodeproperty-bootstrap-slider', KODEPROPERTY_PATH_URL.'framework/frontend/js/bootstrap-slider.js', false, '1.0', true);
		wp_enqueue_script('kodeproperty-bootstrap-slider');
		
		wp_register_script('kodeproperty-functions', KODEPROPERTY_PATH_URL.'framework/frontend/js/functions.js', false, '1.0', true);
		wp_enqueue_script('kodeproperty-functions');
	}
	
}

if(!is_admin()){
	add_action( 'wp_enqueue_scripts', 'kodeproperty_plugin_enqueue_style' );
	add_action( 'wp_enqueue_scripts', 'kodeproperty_plugin_enqueue_script' );
}

$current_theme = strtolower(str_replace(' ','-',get_option('current_theme')));
if($current_theme <> 'kode-property'){
	if( empty($kodeproperty_plguin_option['upload-font']) ){ $kodeproperty_plguin_option['upload-font'] = ''; }
	$kodeproperty_font_controller_plugin = new kodeproperty_font_loader_plugin( json_decode($kodeproperty_plguin_option['upload-font'], true) );	
}




