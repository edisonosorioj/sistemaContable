<?php
/**
 * Plugin Name: Kodeforest Featured Property
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show feature Property( Specified by category ).
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'kodeproperty_search_property_widget' );
if( !function_exists('kodeproperty_search_property_widget') ){
	function kodeproperty_search_property_widget() {
		register_widget( 'Kodeforest_Search_Property' );
	}
}

if( !class_exists('Kodeforest_Search_Property') ){
	class Kodeforest_Search_Property extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'kodeproperty_search_property_widget', 
				esc_html__('Kodeforest Search Widget','kode-property-list'), 
				array('description' => esc_html__('A widget that help you to Search Property', 'kode-property-list')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $kodeproperty_plugin_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
			}
			$kodeproperty_func_utility = new kodeproperty_func_utility();
			// Widget Content
			$kodeproperty_plugin_option = get_option('kodeproperty_plugin_option', array());
			$kodeproperty_action = '';
			if(isset($kodeproperty_plugin_option['property-search-page'])){
				$kodeproperty_action = $kodeproperty_plugin_option['property-search-page'];
			}
			
			$ret = '
			<div class="kf_search_property_wrap">
				<form action="'.esc_url(get_permalink($kodeproperty_action)).'" method="get">
					<div class="kf_property_element">
						<div class="kf_property_field">
							<input type="text" name="keyword" placeholder="'.esc_attr__('Keyword','kode-property-list').'"/>
						</div>
						
						<div class="kf_property_field">
							<input type="text" name="space" placeholder="'.esc_attr__('Space in sqft','kode-property-list').'"/>
						</div>
						
						<div class="kf_property_field">
							<select name="property-for" class="chosen-select">
								<option>'.esc_attr__('Todos','kode-property-list').'</option>
								<option>'.esc_attr__('Alquiler','kode-property-list').'</option>
								<option>'.esc_attr__('Venta','kode-property-list').'</option>
								<option>'.esc_attr__('Compra','kode-property-list').'</option>
							</select>
						</div>
						
						<div class="kf_property_field">
							<select name="type" class="chosen-select">
								<option>'.esc_attr__('All Properties','kode-property-list').'</option>';
								$kodeproperty_get = $kodeproperty_func_utility->kodeproperty_get_term_list('status');
								foreach($kodeproperty_get as $keys => $values){
									$ret .= '<option value="'.esc_attr($keys).'">'.esc_attr($values).'</option>';
								}
								$ret .= '
							</select>
						</div>
						
						<div class="kf_property_field">
							<select name="min-bed" class="chosen-select">
								<option>'.esc_attr__('Min. Bedrooms','kode-property-list').'</option>
								<option>'.esc_attr__('2','kode-property-list').'</option>
								<option>'.esc_attr__('3','kode-property-list').'</option>
								<option>'.esc_attr__('4','kode-property-list').'</option>
								<option>'.esc_attr__('5','kode-property-list').'</option>
							</select>
						</div>
						
						<div class="kf_property_field">
							<select name="max-bed" class="chosen-select">
								<option>'.esc_attr__('Max. Bedrooms','kode-property-list').'</option>
								<option>'.esc_attr__('2','kode-property-list').'</option>
								<option>'.esc_attr__('3','kode-property-list').'</option>
								<option>'.esc_attr__('4','kode-property-list').'</option>
								<option>'.esc_attr__('5','kode-property-list').'</option>
							</select>
						</div>
						
						<div class="kf_property_field">
							<div class="kf_range_slider">
								<label>'.esc_attr__('Price Range From','kode-property-list').'</label>
								<input type="text" class="amount" readonly>
								<div class="slider-range"></div>
								<span>'.esc_attr__('Min','kode-property-list').'</span>
								<span class="pull-right">'.esc_attr__('Max','kode-property-list').'</span>
							</div>
						</div>
						
						<div class="kf_property_field">							
							<input type="submit" value="'.esc_attr__('Search','kode-property-list').'">
						</div>
					</div>
				</form>
			</div>';
			
			echo $ret;
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'kode-property-list'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>		

			

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			

			return $instance;
		}	
	}
}
?>