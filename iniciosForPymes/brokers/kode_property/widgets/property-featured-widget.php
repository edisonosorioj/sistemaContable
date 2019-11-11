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

add_action( 'widgets_init', 'kodeproperty_feature_property_widget' );
if( !function_exists('kodeproperty_feature_property_widget') ){
	function kodeproperty_feature_property_widget() {
		register_widget( 'Kodeforest_Feature_Property' );
	}
}

if( !class_exists('Kodeforest_Feature_Property') ){
	class Kodeforest_Feature_Property extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'kodeproperty_feature_property_widget', 
				esc_html__('Kodeforest Feature Property Widget','kode-property-list'), 
				array('description' => esc_html__('A widget that show Feature Property products', 'kode-property-list')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $kodeproperty_plugin_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$feature_property = $instance['feature_property'];
			
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
			}
			$feature_property_post = get_post($feature_property);
			$thumbnail = kodeproperty_get_image(get_post_thumbnail_id($feature_property_post->ID), array(570,300));
			$kodeproperty_post_option = kodeproperty_decode_stopbackslashes(get_post_meta($feature_property_post->ID, 'post-option', true ));
			if( !empty($kodeproperty_post_option) ){
				$kodeproperty_post_option = json_decode( $kodeproperty_post_option, true );					
			}
			$kodeproperty_post_option['property-bed'] = (empty($kodeproperty_post_option['property-bed']))? ' ': $kodeproperty_post_option['property-bed'];	
			if($kodeproperty_post_option['property-bed'] == ''){
				$kodeproperty_post_option['property-bed'] = '';
			}
			$kodeproperty_post_option['property-bath'] = (empty($kodeproperty_post_option['property-bath']))? ' ': $kodeproperty_post_option['property-bath'];	
			if($kodeproperty_post_option['property-bath'] == ''){
				$kodeproperty_post_option['property-bath'] = '';
			}
			$kodeproperty_post_option['property-space'] = (empty($kodeproperty_post_option['property-space']))? ' ': $kodeproperty_post_option['property-space'];	
			if($kodeproperty_post_option['property-space'] == ''){
				$kodeproperty_post_option['property-space'] = '';
			}
			$kodeproperty_post_option['property-garage'] = (empty($kodeproperty_post_option['property-garage']))? ' ': $kodeproperty_post_option['property-garage'];	
			if($kodeproperty_post_option['property-garage'] == ''){
				$kodeproperty_post_option['property-garage'] = '';
			}
			$kodeproperty_post_option['property-price'] = (empty($kodeproperty_post_option['property-price']))? ' ': $kodeproperty_post_option['property-price'];	
			if($kodeproperty_post_option['property-price'] == ''){
				$kodeproperty_post_option['property-price'] = '';
			}
			$kodeproperty_post_option['property-currency'] = (empty($kodeproperty_post_option['property-currency']))? ' ': $kodeproperty_post_option['property-currency'];	
			
			if(isset($feature_property) && $feature_property <> ''){
				// Widget Content
				echo $ret = '
				<div class="kf_foo_featured_listing">
					<figure>
						'.$thumbnail.'
						<figcaption class="kf_foo_listing_hover">
							<p>'.$kodeproperty_post_option['property-currency'].' '.esc_attr($kodeproperty_post_option['property-price']).'</p>
						</figcaption>
					</figure>
					<div class="kf_foo_listing_des">
						<h6><a href="'.esc_url(get_permalink($feature_property_post->ID)).'">'.esc_attr($feature_property_post->post_title).'</a></h6>
						<p>'.esc_attr($kodeproperty_post_option['property-location']).'</p>
						<ul class="kf_foo_listing_meta">
							<li><i class="fa fa-bed"></i>'.esc_attr($kodeproperty_post_option['property-bed']).' '.esc_attr__('bed','kode-property-list').'</li>
							<li><i class="icon-bath"></i>'.esc_attr($kodeproperty_post_option['property-bath']).' '.esc_attr__('bath','kode-property-list').'</li>
							<li><i class="fa fa-arrows-alt"></i>'.esc_attr($kodeproperty_post_option['property-garage']).' '.esc_attr__('Garage','kode-property-list').'</li>
						</ul>
					</div>
				</div>';
			}
			wp_reset_postdata();
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$feature_property = isset($instance['feature_property'])? $instance['feature_property']: '';
			
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'kode-property-list'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>		

			<!-- Post Category -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('feature_property')); ?>"><?php esc_html_e('Feature Property :', 'kode-property-list'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('feature_property')); ?>" id="<?php echo esc_attr($this->get_field_id('feature_property')); ?>">
				<?php 	
				$category_list = kodeproperty_get_post_list_id('property'); 
				foreach($category_list as $cat_slug => $cat_name){ ?>
					<option value="<?php echo esc_attr($cat_slug); ?>" <?php if ($feature_property == $cat_slug) echo ' selected '; ?>><?php echo esc_attr($cat_name); ?></option>				
				<?php } ?>	
				</select> 
			</p>
				
			
		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['feature_property'] = (empty($new_instance['feature_property']))? '': strip_tags($new_instance['feature_property']);

			return $instance;
		}	
	}
}
?>