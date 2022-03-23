<?php
/***
 * Extension > Modern Tabs
 *
 * This is an extension of default VC Component
 *
 **/

if(class_exists('WPBakeryShortCodesContainer')) {

	// Class
	class WPBakeryShortCode_ivan_modern_tabs extends WPBakeryShortCodesContainer {

		protected function content( $atts, $content = '' ) {
			
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'el_class' => '',
				'animation' => '',
				'animation_delay' => '',
				'animation_iteration' => '',
			), $atts) );

			$output = '';
			$classes = '';
			
			// El Class
			$classes .= ' '. $el_class;

			global $ivan_shortcode_modern_tabs;
			$ivan_shortcode_modern_tabs = array(); // clear the array
			do_shortcode($content); // execute the '[modern_tabs_item]' shortcode first to get the title and content
			
			// Output Form
			ob_start();
			?>
			
			<div class="<?php echo sanitize_html_classes($classes); ?>">
				<?php if (is_array($ivan_shortcode_modern_tabs) && count($ivan_shortcode_modern_tabs) > 0): ?>
					<div class="tab-contents">
						<?php foreach ($ivan_shortcode_modern_tabs as $key => $tab): ?>
						<article id="modern-tab-<?php echo intval($key); ?>" class="<?php echo (0 == $key ? 'active fade in' : 'fade') ?> <?php echo sanitize_html_classes($tab['prefix_class']); ?>">
								<div class="left-content">
									<figure>
										<?php 
										$url = wp_get_attachment_image_src($tab['image_id'], 'full');
										if (isset($url[0])):
											echo '<img src="'. esc_url($url['0']).'" alt="'.esc_attr('title').'" />';
										endif;
										?>
									</figure>
								</div>
								<div class="right-content">
									<div class="container">
										<div class="row">
											<div class="col-md-6 col-md-offset-6">
												<?php 
												echo wpautop(wp_kses_post($tab['content']));
												
												if (function_exists('vc_parse_multi_attribute') && !empty($tab['btn_link'])):
													$parse_args = vc_parse_multi_attribute($tab['btn_link']);
													$href = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
													$title = ( isset($parse_args['title']) ) ? $parse_args['title'] : '';
													$target = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
													?>
													<a href="<?php echo esc_url($href); ?>" class="dt-sc-button dt-newBtn-5" title="<?php echo esc_attr($title); ?>"><span><?php echo esc_html($tab['btn_text']);?></span><i class="fa fa-long-arrow-right"></i></a>
													<?php
												endif;
												
												?>
											</div>
										</div>
									</div>
								</div>
							</article>
						<?php endforeach;	?>
					</div>
				
					<div class="tab-nav">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<ul class="clearfix">									
										<?php foreach ($ivan_shortcode_modern_tabs as $key => $tab): ?>
											<li class="<?php echo (0 == $key ? 'active' : '') ?> <?php echo sanitize_html_classes($tab['prefix_class']); ?>">
												<a class="modern-tab" href="#modern-tab-<?php echo intval($key); ?>" data-target="#modern-tab-<?php echo intval($key); ?>" data-toggle="tab">
													<i class="icon <?php echo sanitize_html_classes($tab['ico_family'].$tab['ico'])?>"></i>
													<span><?php echo esc_html($tab['title']); ?></span>
												</a>
											</li>
										<?php endforeach;	?>
									</ul>
								</div>
							</div>
						</div>		
					</div>
				
				<?php endif; ?>
			</div>
			
			<?php
			$output .= ob_get_clean();
			$output = str_replace(array("\n", "\t", "\r"), '', $output);

			return $output;
		}

	}// #class end

	// Init global var to store this module data
	global $ivan_vc_modern_tabs;
	$ivan_vc_modern_tabs = new WPBakeryShortCode_ivan_modern_tabs( array('name' => 'Modern Tabs', 'base' => 'ivan_modern_tabs') );

} // #end class check


if( class_exists('WPBakeryShortCode') ) {
	
	// Class
	class WPBakeryShortCode_ivan_modern_tabs_item extends WPBakeryShortCode {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'title' => '',
				'image_id' => '',
				'ico_family' => '',
				'ico' => '',
				'btn_text' => '',
				'btn_link' => '',
				'el_class' => '',
				'c_id' => '',
			), $atts) );

			
			//
			// Start Customizer Prefix
			//
			$prefixClass = '';
			if( isset($atts['c_id']) ) {
				$this->prefix = $atts['c_id'] . ' ';
				$prefixClass = str_replace('.', '', $atts['c_id']);
			} else {
				$this->prefix = '.vc_custom_' . rand(25, 3000) . ' ';
				$prefixClass = str_replace('.', '', $this->prefix);
			}
			// End Customizer Prefix
			
			//
			// Customizer CSS Output
			//
			$style = '';
			foreach ($this->selectors as $key => $value) {
				if( isset($atts[$key]) && '' != $atts[$key]) {
					$style .= ivan_vc_customizer_get_style( $atts[$key], $this->selectors[$key], $this->prefix );
				}
			}
			$output = '';
			// Print style
			if(is_admin()) {
				$output .= '<style type="text/css">'
				. $style
				. '</style>';
			}
			else {
				$ivan_custom_css .= $style;
			}
			
			// End Customizer Output
				
			global $ivan_shortcode_modern_tabs;
			$ivan_shortcode_modern_tabs[] = array(
				'prefix_class' => $prefixClass, 
				'title' => $title, 
				'image_id' => $image_id,
				'ico_family' => $ico_family ? $ico_family : 'fa fa-',
				'ico' => $ico, 
				'btn_text' => $btn_text, 
				'btn_link' => $btn_link, 
				'el_class' => $el_class, 
				'c_id' => $c_id, 
				'content' => trim(do_shortcode($content)));
			
			return '';
		}
		
		public $selectors = array(
			'text_css' => array(
				// Font
				'font-family' => 'p',
				'font-weight' => 'p',
				'font-size' => 'p',
				'line-height' => 'p',
				'text-transform' => 'p',
				'color' => 'p',
			),
			'button_css' => array(
				// Font
				'font-family' => '.dt-newBtn-5',
				'font-weight' => '.dt-newBtn-5',
				'font-size' => '.dt-newBtn-5',
				'line-height' => '.dt-newBtn-5',
				'text-transform' => '.dt-newBtn-5',
				'color' => '.dt-newBtn-5, .dt-newBtn-5 i',
				'color-hover' => '.dt-newBtn-5:hover, .dt-newBtn-5:hover i',
				'background-color' => '.dt-newBtn-5',
				'background-color-hover' => '.dt-newBtn-5:hover',
			),
			'tab_icon_css' => array(
				'color' => 'a .icon',
				'color-hover' => 'a:hover .icon',
			),
			'tab_text_css' => array(
				// Font
				'font-family' => 'a.modern-tab span',
				'font-weight' => 'a.modern-tab span',
				'font-size' => 'a.modern-tab span',
				'line-height' => 'a.modern-tab span',
				'text-transform' => 'a.modern-tab span',
				'color' => 'a.modern-tab span',
			),
		);

		public $prefix = '';
		
	}// #class end	
	
	// Init global var to store this module data
	global $ivan_vc_modern_tabs_item;
	$ivan_vc_modern_tabs_item = new WPBakeryShortCode_ivan_modern_tabs_item( array('name' => 'Modern Tabs Item', 'base' => 'ivan_modern_tabs_item') );

}