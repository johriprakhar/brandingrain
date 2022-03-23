<?php
/* * *
 * Module > Portfolio Grid
 *
 * This module extends default VC class, turning easy extend it with custom functions!
 *
 * */

if (class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_portfolio_grid extends WPBakeryShortCode {

		protected function content($atts, $content = null) {
			
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract(shortcode_atts(array(
				'el_class' => '',
				'ivan_posts_per_page' => 9,
				'title' => '',
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
			
			if( $ivan_query->have_posts() ) : ?>
			
				<div class="<?php echo implode(' ', array_map('sanitize_html_class', is_array($classes_arr) ? $classes_arr : array())); ?>">
					<div class="portfolio style2" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>

						<div class="title-wrapper">
							<h3 class="title"><?php echo esc_html($title); ?></h3>
						</div>
						<div class="filters-wrapper">
							<?php 
							// Sortable
							$enableSortable = $ivan_sortable_filters;
						
							if('yes' == $enableSortable) {
								$filters = get_terms(apply_filters('ivan_project_filters', "ivan_vc_projects_cats") );
						
								if( 0 < count($filters) ) { ?>
									<ul>
										<li class="active" data-filter="*"><span><?php echo esc_html($all_txt); ?></span></li>
										<?php
										foreach ($filters as $filter) { ?>
											<li data-filter=".cat-<?php echo sanitize_html_classes($filter->slug); ?>"><span><?php echo $filter->name; ?></span></li>											
										<?php } ?>
									</ul>
									<?php
								}
							} ?>
						</div>

						<div class="items-container clearfix">
							<div class="grid-sizer"></div>
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
										$term_slugs[] = 'cat-'.$term->slug;
										$term_names[] = $term->name;
									endforeach;
								endif; 

								if ($i >= 9) {
									$i = 0;
								}

								$current_animation_delay += $animation_delay;
								?>
								<div class="portfolio-item <?php echo sanitize_html_classes( implode(' ', $term_slugs) ); ?>">
										<h3><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></h3>
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
			'title_css' => array(
				// Font
				'font-family' => '.portfolio.style2 .title-wrapper .title',
				'font-weight' => '.portfolio.style2 .title-wrapper .title',
				'font-size' => '.portfolio.style2 .title-wrapper .title',
				'line-height' => '.portfolio.style2 .title-wrapper .title',
				'text-transform' => '.portfolio.style2 .title-wrapper .title',
				'color' => '.portfolio.style2 .title-wrapper .title',
			),
			'filter_css' => array(
				// Font
				'font-family' => '.portfolio.style2 .filters-wrapper ul li',
				'font-weight' => '.portfolio.style2 .filters-wrapper ul li',
				'font-size' => '.portfolio.style2 .filters-wrapper ul li',
				'line-height' => '.portfolio.style2 .filters-wrapper ul li',
				'text-transform' => '.portfolio.style2 .filters-wrapper ul li',
				'color' => '.portfolio.style2 .filters-wrapper ul li',
				// Hovers
				'color-hover' => '.portfolio.style2 .filters-wrapper ul li.active, .portfolio.style2 .filters-wrapper ul li:hover',
			),
			
			'item_title_css' => array(
				// Font
				'font-family' => '.portfolio.style2 .items-container .portfolio-item a',
				'font-weight' => '.portfolio.style2 .items-container .portfolio-item a',
				'font-size' => '.portfolio.style2 .items-container .portfolio-item a',
				'line-height' => '.portfolio.style2 .items-container .portfolio-item a',
				'text-transform' => '.portfolio.style2 .items-container .portfolio-item a',
				'color' => '.portfolio.style2 .items-container .portfolio-item a',
				'color-hover' => '.portfolio.style2 .items-container .portfolio-item a:hover',
			),
			
			'item_categories_css' => array(
				// Font
				'font-family' => '.portfolio.style2 .items-container .portfolio-item .item-details .categories',
				'font-weight' => '.portfolio.style2 .items-container .portfolio-item .item-details .categories',
				'font-size' => '.portfolio.style2 .items-container .portfolio-item .item-details .categories',
				'line-height' => '.portfolio.style2 .items-container .portfolio-item .item-details .categories',
				'text-transform' => '.portfolio.style2 .items-container .portfolio-item .item-details .categories',
				'color' => '.portfolio.style2 .items-container .portfolio-item .item-details .categories',
			),
		);
		public $prefix = '';

	}

	// #class end
	// Init global var to store this module data
	global $ivan_vc_portfolio_grid;
	$ivan_vc_portfolio_grid = new WPBakeryShortCode_ivan_portfolio_grid(array('name' => 'Portfolio Grid', 'base' => 'ivan_portfolio_grid'));
} // #end class check