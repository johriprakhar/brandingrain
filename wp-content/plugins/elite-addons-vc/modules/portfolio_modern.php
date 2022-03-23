<?php
/* * *
 * Module > Portfolio Modern
 *
 * This module extends default VC class, turning easy extend it with custom functions!
 *
 * */

if (class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_portfolio_modern extends WPBakeryShortCode {

		protected function content($atts, $content = null) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract(shortcode_atts(array(
				'el_class' => '',
				'ivan_posts_per_page' => 15,
				'ivan_category' => '',
				'ivan_sortable_filters' => '',
				'all_txt' => __('All', 'iv_js_composer'),
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
				'post_type' => 'ivan_vc_projects',
				'posts_per_page' => $ivan_posts_per_page,
				'post_status' => 'publish',
				'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
			);

			if('' != $ivan_category) {
				$args['ivan_vc_projects_cats'] = $ivan_category;
			}

			$ivan_query = new WP_Query( $args );
			
			wp_enqueue_script('isotope');
			
			
			ob_start();
			
			if( $ivan_query->have_posts() ) :
				
				
				// Sortable
				$enableSortable = $ivan_sortable_filters;

				if('yes' == $enableSortable) {
					$filters = get_terms(apply_filters('ivan_project_filters', "ivan_vc_projects_cats") );

					if( 0 < count($filters) ) {
						$output .= '<div class="ivan-vc-filters-wrapper"><div class="ivan-vc-filters">';

						$output .= apply_filters('ivan_filter_grid', '<span class="filter-grid"><i class="fa fa-th"></i></span>');

						$output .= '<a href="#" data-filter="*" class="current">'. esc_html($all_txt) .'</a>';

						foreach ($filters as $filter) {
							$output .= '<a href="#" data-filter=".'.esc_attr($filter->slug).'">'. $filter->name . '</a>';
						}

						$output .= '</div></div>';
					}
				}
				
			?>
				<div class="<?php echo implode(' ', array_map('sanitize_html_class', is_array($classes_arr) ? $classes_arr : array())); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>

					<div id="portfolio-holder" class="clearfix">

						<ul id="portfolio" class="folio-grid cols-three style-one light show-category layout-masonry-advanced clearfix" style="position: relative; height: 2249px;">

							<?php 
							$i = 0;
							$current_animation_delay = 0;
							while( $ivan_query->have_posts() ) : 
								$i++;
								$ivan_query->the_post(); 
							
								$terms = wp_get_post_terms(get_the_ID(), 'ivan_vc_projects_cats');
								$term_slugs = array();
								$term_names = array();
								if (count($terms) > 0):
									foreach ($terms as $term):
										$term_slugs[] = $term->slug;
										$term_names[] = $term->name;
									endforeach;
								endif; 
							
								$data_factor = 1;
								
								//image size
								if (in_array($i,array(2,5,6,7,10,12,14,15))) {
									$image_size = 'ivan_portfolio_default';
								} else if ($i == 8) {
									$image_size = 'ivan_portfolio_doubled';
									$data_factor = 2;
								} else {
									$image_size = 'ivan_portfolio_high';
								}
							
								$current_animation_delay += $animation_delay;
								
								?>
								<li class="item <?php echo implode(' ',array_map('sanitize_html_class', $term_slugs)); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($current_animation_delay, $animation_iteration); ?> data-factor="<?php echo esc_attr($data_factor);?>">
									<a href="<?php the_permalink(); ?>" target="_self">
										<?php if (has_post_thumbnail()):
											the_post_thumbnail($image_size);
										endif; ?>
										<div class="caption">
											<div>
												<div>
													<span><?php echo implode(', ', $term_names); ?></span>
													<h3><?php the_title();?></h3>
												</div>
											</div>
										</div>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
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
			
		);
		public $prefix = '';

	}

	// #class end
	// Init global var to store this module data
	global $ivan_vc_portfolio_modern;
	$ivan_vc_portfolio_modern = new WPBakeryShortCode_ivan_portfolio_modern(array('name' => 'Portfolio Modern', 'base' => 'ivan_portfolio_modern'));
} // #end class check