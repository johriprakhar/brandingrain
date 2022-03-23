<?php
/* * *
 * Module > Latest Posts
 *
 * This module extends default VC class, turning easy extend it with custom functions!
 *
 * */

if (class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_latest_posts extends WPBakeryShortCode {

		protected function content($atts, $content = null) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract(shortcode_atts(array(
				'el_class' => '',
				'ivan_category' => '',
				'animation' => 	'',
				'animation_delay' => '',
				'animation_iteration' => '',
			), $atts));
			
			$output = '';
			$classes = '';

			//
			// Start Customizer Prefix
			//
				$prefixClass = '';
			if (isset($atts['c_id'])) {
				$this->prefix = $atts['c_id'] . ' ';
				$prefixClass = str_replace('.', '', $atts['c_id']);
			} else {
				$this->prefix = '.vc_custom_' . rand(25, 3000) . ' ';
				$prefixClass = str_replace('.', '', $this->prefix);
			}
			// End Customizer Prefix
			// El Class
			$classes .= ' ' . $el_class;
			$classes .= ' ' . $prefixClass;

			$classes_arr = explode(' ', $classes);

			// Output Form


			
			// Args
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
				'post_status' => 'publish',
			);
			
			if( $ivan_category ) {
				$args['tax_query'] = array(
				  array(
					'taxonomy' => 'category',
					'field'    => 'ids',
					'terms'    => explode( ',', $ivan_category )
				  )
				);
			  }

			$ivan_query = new WP_Query( $args );
			
			ob_start();
			
			if( $ivan_query->have_posts() ) : ?>

				<div class="<?php echo implode(' ', array_map('sanitize_html_class', is_array($classes_arr) ? $classes_arr : array())); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
					
					<div class="container">
						<div class="row">
							
							<?php 
							$i = 0;
							$current_animation_delay = 0;
							while( $ivan_query->have_posts() ) : 
								$i++;
								$ivan_query->the_post(); 
							
								$current_animation_delay += $animation_delay;
								
								?>
								<div class="col-md-4">
									<div class="latest-post <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?>>
										<div class="post-inner">
											<time datetime="<?php echo esc_attr(get_the_time(get_option('date_format'))); ?>"><?php the_time(get_option('date_format'));?></time>
											<h3><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title();?></a></h3>
											<p>
											<?php
											$excerpt = get_the_excerpt();
											echo ivan_get_shortened_string($excerpt,20);
											?>
											</p>
											<a href="<?php echo esc_url(get_permalink()); ?>" class="read-more"><?php _e('Read More', '');?></a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					
				</div>
			<?php endif; ?>
			<?php
			wp_reset_postdata();
			
			$output .= ob_get_clean();

			//
			// Customizer CSS Output
			//
				$style = '';
			foreach ($this->selectors as $key => $value) {
				if (isset($atts[$key]) && '' != $atts[$key]) {
					$style .= ivan_vc_customizer_get_style($atts[$key], $this->selectors[$key], $this->prefix);
				}
			}

			// Print style
			if (is_admin()) {
				$output .= '<style type="text/css">'
						. $style
						. '</style>';
			} else {
				$ivan_custom_css .= $style;
			}
			// End Customizer Output

			return $output;
		}

		// H1 Selectors
		public $selectors = array(
			'meta_css' => array(
				// Font
				'font-family' => '.latest-post time',
				'font-weight' => '.latest-post time',
				'font-size' => '.latest-post time',
				'line-height' => '.latest-post time',
				'text-transform' => '.latest-post time',
				'color' => '.latest-post time',
				// Spacing
				'margin-top' => '.latest-post time',
				'margin-right' => '.latest-post time',
				'margin-bottom' => '.latest-post time',
				'margin-left' => '.latest-post time',
				'padding-top' => '.latest-post time',
				'padding-right' => '.latest-post time',
				'padding-bottom' => '.latest-post time',
				'padding-left' => '.latest-post time',
			),
			'header_css' => array(
				// Font
				'font-family' => '.latest-post h3',
				'font-weight' => '.latest-post h3',
				'font-size' => '.latest-post h3',
				'line-height' => '.latest-post h3',
				'text-transform' => '.latest-post h3',
				'color' => '.latest-post h3',
				'color-hover' => '.latest-post h3 a:hover',
				// Spacing
				'margin-top' => '.latest-post h3',
				'margin-right' => '.latest-post h3',
				'margin-bottom' => '.latest-post h3',
				'margin-left' => '.latest-post h3',
				'padding-top' => '.latest-post h3',
				'padding-right' => '.latest-post h3',
				'padding-bottom' => '.latest-post h3',
				'padding-left' => '.latest-post h3',
			),
			
			'text_css' => array(
				// Font
				'font-family' => '.latest-post p',
				'font-weight' => '.latest-post p',
				'font-size' => '.latest-post p',
				'line-height' => '.latest-post p',
				'text-transform' => '.latest-post p',
				'color' => '.latest-post p',
				// Spacing
				'margin-top' => '.latest-post p',
				'margin-right' => '.latest-post p',
				'margin-bottom' => '.latest-post p',
				'margin-left' => '.latest-post p',
				'padding-top' => '.latest-post p',
				'padding-right' => '.latest-post p',
				'padding-bottom' => '.latest-post P',
				'padding-left' => '.latest-post p',
			),
			
			'read_more_css' => array(
				// Font
				'font-family' => '.latest-post .read-more',
				'font-weight' => '.latest-post .read-more',
				'font-size' => '.latest-post .read-more',
				'line-height' => '.latest-post .read-more',
				'text-transform' => '.latest-post .read-more',
				'color' => '.latest-post .read-more',
				'color-hover' => '.latest-post .read-more:hover',
				// Spacing
				'margin-top' => '.latest-post .read-more',
				'margin-right' => '.latest-post .read-more',
				'margin-bottom' => '.latest-post .read-more',
				'margin-left' => '.latest-post .read-more',
				'padding-top' => '.latest-post .read-more',
				'padding-right' => '.latest-post .read-more',
				'padding-bottom' => '.latest-post .read-more',
				'padding-left' => '.latest-post .read-more',
			),
			
			'frame_css' => array(
				'background-color' => '.latest-post:before,.latest-post:after,.latest-post .post-inner:before,.latest-post .post-inner:after',
			),
		);
		public $prefix = '';

	}

	// #class end
	// Init global var to store this module data
	global $ivan_vc_latest_posts;
	$ivan_vc_latest_posts = new WPBakeryShortCode_ivan_latest_posts(array('name' => 'Icon', 'base' => 'ivan_latest_posts'));
} // #end class check