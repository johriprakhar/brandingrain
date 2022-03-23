<?php
/**
 * Instagram widget
 */
 
class WP_Instagram_Feed_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_instagram_feed', 'description' => __( "Displays Instagram images", "framework" ) );
		parent::__construct('instagramfeed', __( 'Instagram Feed', "framework" ), $widget_ops);
		
		$this-> alt_option_name = 'widget_instagram_feed';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		wp_enqueue_script('ivan_instafeed');
		
		$cache = wp_cache_get('widget_instagram_feed', 'widget');
		
		if ( !is_array($cache) )
		{
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) )
		{
			$args['widget_id'] = $this->id;
		}
		
		if ( isset( $cache[ $args['widget_id'] ] ) )
		{
			echo $cache[ $args['widget_id'] ];
			return;
		}
	
		ob_start();
		extract($args);
		echo $before_widget;
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$title_link	=  isset($instance['title_link']) ? esc_attr($instance['title_link']) : '';
		$user_name_link = ($title_link && $username ) ? '<a href="'.esc_url($title_link).'">'.esc_attr($username).'</a>' : '';
		$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Instagram', "framework" ) : $instance['title'], $instance, $this->id_base);
		$clientid = isset($instance['clientid']) ? esc_attr($instance['clientid']) : '';
		$limit = isset($instance['limit']) ? (int)$instance['limit'] : '';
		
		if (!empty($clientid)) {
		
			echo $before_title.$title.$user_name_link.$after_title; $uniqueid = uniqid(); ?>
			<ul id="instagram-feed-<?php echo esc_attr($uniqueid); ?>" data-limit="<?php echo esc_attr($limit); ?>" data-clientid="<?php echo esc_attr($clientid); ?>"></ul>
			<?php
		}
		
		echo $after_widget;
		
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_instagram_feed', $cache, 'widget');
	}
		
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = $new_instance['username'];
		$instance['title_link'] = $new_instance['title_link'];
		$instance['clientid'] = strip_tags($new_instance['clientid']);
		$instance['limit'] = (int)$new_instance['limit'];
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_instagram_feed', 'widget');
	}
	
	function form( $instance )
	{
		$title      = isset($instance['title']) ?  $instance['title'] : '';
		$username   = isset($instance['username']) ? $instance['username'] : '';
		$title_link = isset($instance['title_link']) ? $instance['title_link'] : '';
		$clientid   = isset($instance['clientid']) ? $instance['clientid'] : '';
		$limit      = isset($instance['limit']) ? (int)$instance['limit'] : '';
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php _e( 'Username:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo wp_kses_post($username); ?>" /></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('title_link')); ?>"><?php _e( 'Username Link:', "framework" ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_link')); ?>" name="<?php echo esc_attr($this->get_field_name('title_link')); ?>" type="text" value="<?php echo wp_kses_post($title_link); ?>" /></p>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'clientid' )); ?>"><?php _e("Client Id:",'framework'); ?> <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'clientid' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'clientid' )); ?>" type="text" value="<?php echo esc_attr($clientid); ?>" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>"><?php _e("Limit items",'framework'); ?> <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($limit==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
		<?php
	}
}