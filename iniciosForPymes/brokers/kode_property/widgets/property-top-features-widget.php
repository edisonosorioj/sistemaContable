<?php
/**
 * Plugin Name: Kodeforest All Features
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show features.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'kodeproperty_top_features_widget' );
if( !function_exists('kodeproperty_top_features_widget') ){
	function kodeproperty_top_features_widget() {
		register_widget( 'Kodeforest_Top_Features_Property' );
	}
}

if( !class_exists('Kodeforest_Top_Features_Property') ){
	class Kodeforest_Top_Features_Property extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'kodeproperty_top_features_widget', 
				esc_html__('Kodeforest Property Top Features Widget','kode-property-list'), 
				array('description' => esc_html__('A widget that show All Property Features', 'kode-property-list')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $kodeproperty_plugin_option;	
			$num_fetch = 5;
			$title = apply_filters( 'widget_title', $instance['title'] );
			$num_fetch = $instance['num_fetch'];			
			if(isset($num_fetch) && $num_fetch == ''){$num_fetch = 7;}
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
			}

			// Widget Content
			// $num_fetch = ceil(sizeof($terms) / $num_fetch);
			echo '
			<div class="kf_foo_property_type">
				<ul>';
					$property_features = get_terms(
						array(
							'features'
						),
						array(
							'orderby'       => 'name',
							'order'         => 'ASC',
							'hide_empty'    => false,
							'parent' => 0
						)
					);
					
					$property_fea_array = array();
					$term_counter = 0;
					foreach($property_features as $term){
						echo '<li><a href="'.esc_url(get_term_link($term)).'">'.esc_attr($term->name).'  <span>'.esc_attr($term->count).'</span></a></li>';
						if($term_counter >= 6){
							break;
						}
						$term_counter++;
					}
				
					echo '
				</ul>
			</div>';
		
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			
			$title = isset($instance['title'])? $instance['title']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: '';			
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'kode-property-list'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>"><?php esc_html_e('Num Fetch :', 'kode-property-list'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>" name="<?php echo esc_attr($this->get_field_name('num_fetch')); ?>" type="text" value="<?php echo esc_attr($num_fetch); ?>" />
			</p>			

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			// $instance['num_desc'] = (empty($new_instance['num_desc']))? '': strip_tags($new_instance['num_desc']);

			return $instance;
		}	
	}
}
?>