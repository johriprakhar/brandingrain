<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */

	add_action( 'init', 'mmpm_register_sidebars', 20 );
	function mmpm_register_sidebars () {
		$number_of_widgets = mmpm_get_option( 'number_of_widgets', '1' );
		if ( is_numeric( $number_of_widgets ) ) {
			for ( $i=1; $i <= $number_of_widgets; $i++ ) { 
				register_sidebar(
					array(
						'name' => __( MMPM_PLUGIN_NAME . ' area ' . $i, MMPM_TEXTDOMAIN_ADMIN  ),
						'id'=> MMPM_PREFIX . '_menu_widgets_area_' . $i,
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div>',
						'before_title' => '<div class="widgettitle">',
						'after_title' => '</div>',
					)
				);
			}
		}
	}


	/**
	 * Menu widget
	 *
	 * @since 1.0.8
	 */
	 class mega_main_sidebar_menu extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'description' => __('Add a "Mega Main Menu" to your sidebar.') );
			parent::__construct( 'mega_main_sidebar_menu', __('Mega Main Sidebar Menu'), $widget_ops );
		}

		function widget($args, $instance) {
			// Get menu
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			echo $args['before_widget'];
			if ( !empty($instance['title']) )
				echo $args['before_title'] . $instance['title'] . $args['after_title'];

			wp_nav_menu( array( 'theme_location' => 'mega_main_sidebar_menu' ) );
			echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
			return $instance;
		}

		function form( $instance ) {
			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Widget Title:') ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
			</p>
			<?php
		}
	}

	add_action('widgets_init', 'mmpm_mega_main_menu_widget' );
	function mmpm_mega_main_menu_widget () {
		register_nav_menu( 'mega_main_sidebar_menu', 'Sidebar Menu by Mega Main' );
		register_widget("mega_main_sidebar_menu");
	}
?>