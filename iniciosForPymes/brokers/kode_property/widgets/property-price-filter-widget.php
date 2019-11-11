<?php
add_action( 'widgets_init', 'Kodeforest_Price_Filter_Property' );
if( !function_exists('Kodeforest_Price_Filter_Property') ){
	function Kodeforest_Price_Filter_Property() {
		register_widget( 'Kodeforest_Price_Filter_Property' );
	}
}

if( !class_exists('Kodeforest_Price_Filter_Property') ){
	class Kodeforest_Price_Filter_Property extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'kodeproperty_features_widget', 
				esc_html__('Kodeforest Property Price Filter Widget','kode-property-list'), 
				array('description' => esc_html__('A widget that show All Property Filtered by Price', 'kode-property-list')));  
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
			$terms = get_terms('features');
			if(!empty($terms)){
				$num_fetch = ceil(sizeof($terms) / $num_fetch);
				$ret = '
				<div class="widget-filter aside_hdg">
					<h5>'.esc_attr__('Property Price Filter','kode-property-list').'</h5>
					<p>'.esc_attr__('What is the main reason for you to purchase products online?','kode-property-list').'</p>
					<div class="choose-one">
						<label>
							<span class="radio">
								<input type="radio" name="price" value="1" checked="">
								<span class="radio-value" aria-hidden="true"></span>
							</span>
							<span class="option-item">'.esc_attr__('$10000-$50000','kode-property-list').'</span>
						</label>
						<label>
							<span class="radio">
								<input type="radio" name="price" value="1">
								<span class="radio-value" aria-hidden="true"></span>
							</span>
							<span class="option-item">'.esc_attr__('$50001-$10000','kode-property-list').'</span>
						</label>
						<label>
							<span class="radio">
								<input type="radio" name="price" value="1">
								<span class="radio-value" aria-hidden="true"></span>
							</span>
							<span class="option-item">'.esc_attr__('$10001-$15000','kode-property-list').'</span>
						</label>
						<label>
							<span class="radio">
								<input type="radio" name="price" value="1">
								<span class="radio-value" aria-hidden="true"></span>
							</span>
							<span class="option-item">'.esc_attr__('$15001-$20000','kode-property-list').'</span>
						</label>
						<label>
							<span class="radio">
								<input type="radio" name="price" value="1">
								<span class="radio-value" aria-hidden="true"></span>
							</span>
							<span class="option-item">'.esc_attr__('$20001-$25000','kode-property-list').'</span>
						</label>
					</div>
					<div class="filter-btn">
						<input type="submit" value="Search">
					</div>
				</div>';
			}
					
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