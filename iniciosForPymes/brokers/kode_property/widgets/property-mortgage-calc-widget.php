<?php
/**
 * Plugin Name: Kodeforest Mortgage Calculator
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show Mortgage Calculation.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'kodeproperty_mort_calc_widget' );
if( !function_exists('kodeproperty_mort_calc_widget') ){
	function kodeproperty_mort_calc_widget() {
		register_widget( 'Kodeforest_Mortgage_Calculator' );
	}
}

if( !class_exists('Kodeforest_Mortgage_Calculator') ){
	class Kodeforest_Mortgage_Calculator extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'kodeproperty_mort_calc_widget', 
				esc_html__('Kodeforest Mortgage Calculator Widget','kode-property-list'), 
				array('description' => esc_html__('A widget that show mortgage Calculator', 'kode-property-list')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $kodeproperty_plugin_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );			
			$mort_price = $instance['mort_price'];
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
			}

			// Widget Content
			echo kodeproperty_mortgage_calculator();
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';			
			$mort_price = isset($instance['mort_price'])? $instance['mort_price']: 3;
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'kode-property-list'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>		
				
			<!-- Show Num --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('mort_price')); ?>"><?php esc_html_e('Mortgage :', 'kode-property-list'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('mort_price')); ?>" name="<?php echo esc_attr($this->get_field_name('mort_price')); ?>" type="text" value="<?php echo esc_attr($mort_price); ?>" />
			</p>

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['mort_price'] = (empty($new_instance['mort_price']))? '': strip_tags($new_instance['mort_price']);

			return $instance;
		}	
	}
}
?>