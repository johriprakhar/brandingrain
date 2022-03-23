<?php
/***
 * Module > Icon
 *
 * This module extends default VC class, turning easy extend it with custom functions!
 *
 **/

if(class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_contact_info extends WPBakeryShortCode {

		protected function content( $atts, $content = null ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'icon' => '',
				'title' => '',
				'subtitle' => '',
				'link' => '',
				'target' => '',
				'el_class' => '',
				'animation' => '',
				'animation_delay' => '',
				'animation_iteration' => '',
			), $atts) );

			$output = '';
			$classes = '';
			
			
			
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
				
			// El Class
			$classes .= ' '. $el_class;
			$classes .= ' '. $prefixClass;
			
			$classes_arr = explode(' ',$classes);
			
			// Output Form				
			ob_start();
			?>
			<div class="<?php echo implode(' ',array_map('sanitize_html_class',is_array($classes_arr) ? $classes_arr: array()) );?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
				<span class="icon-container">
					<i class="fa fa-<?php echo esc_attr($icon); ?>"></i>
				</span>
				<div class="contact-details">
					<h4>
						<?php if (!empty($link)): ?>
							<a href="<?php 
								if (strstr($link,'mailto:')):
									echo esc_attr($link);
								else:
									echo esc_url($link);
								endif;
							?>" target="<?php echo esc_attr($target=="yes" ? '_blank' : '_self') ?>">
						<?php endif;
						echo esc_html($title);
						if (!empty($link)): ?>
							</a>
						<?php endif; ?>
					</h4>
					<p><?php echo esc_html($subtitle); ?></p>
				</div>
			</div>

			<?php
			$output .= ob_get_clean();

			//
			// Customizer CSS Output
			//
				$style = '';
				foreach ($this->selectors as $key => $value) {
					if( isset($atts[$key]) && '' != $atts[$key]) {
						$style .= ivan_vc_customizer_get_style( $atts[$key], $this->selectors[$key], $this->prefix );
					}
				}

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

			return $output;
		}

		// H1 Selectors
		public $selectors = array(
			'icon_css' => array(
				// Font
				//'font-family' => '*replace',
				//'font-weight' => '*replace',
				'font-size' => '.main-icon',
				//'line-height' => '*replace',
				//'text-transform' => '*replace',
				'color' => '.main-icon',
				// Dimensions
				//'width' => '*replace',
				//'height' => '*replace',
				// Spacing
				'margin-top' => '&',
				'margin-right' => '&',
				'margin-bottom' => '&',
				'margin-left' => '&',
				'padding-top' => '.main-icon',
				'padding-right' => '.main-icon',
				'padding-bottom' => '.main-icon',
				'padding-left' => '.main-icon',
				// Bg
				'background-color' => '.main-icon',
				// Border Radius
				'border-top-left-radius' => '.main-icon',
				'border-top-right-radius' => '.main-icon',
				'border-bottom-left-radius' => '.main-icon',
				'border-bottom-right-radius' => '.main-icon',
				// Border
				'border-top-width' => '.main-icon',
				'border-right-width' => '.main-icon',
				'border-bottom-width' => '.main-icon',
				'border-left-width' => '.main-icon',
				'border-style' => '.main-icon',
				'border-color' => '.main-icon',
				// Hovers
				'color-hover' => 'a:hover .main-icon',
				'border-color-hover' => 'a:hover .main-icon',
				'background-color-hover' => 'a:hover .main-icon',
			),
			'holder_css' => array(
				// Font
				//'font-family' => '*replace',
				//'font-weight' => '*replace',
				//'font-size' => '.main-icon',
				//'line-height' => '*replace',
				//'text-transform' => '*replace',
				'color' => '.ivan-font-stack .stack-holder',
				// Dimensions
				//'width' => '*replace',
				//'height' => '*replace',
				// Spacing
				//'margin-top' => '&',
				//'margin-right' => '&',
				//'margin-bottom' => '&',
				//'margin-left' => '&',
				//'padding-top' => '.main-icon',
				//'padding-right' => '.main-icon',
				//'padding-bottom' => '.main-icon',
				//'padding-left' => '.main-icon',
				// Bg
				'background-color' => '.ivan-font-stack-square',
				// Border Radius
				//'border-top-left-radius' => '.main-icon',
				//'border-top-right-radius' => '.main-icon',
				//'border-bottom-left-radius' => '.main-icon',
				//'border-bottom-right-radius' => '.main-icon',
				// Border
				//'border-top-width' => '.main-icon',
				//'border-right-width' => '.main-icon',
				//'border-bottom-width' => '.main-icon',
				//'border-left-width' => '.main-icon',
				//'border-style' => '.main-icon',
				//'border-color' => '.main-icon',
				// Hovers
				'color-hover' => '.ivan-font-stack.with-link:hover .stack-holder',
				//'border-color-hover' => 'a:hover .main-icon',
				'background-color-hover' => '.ivan-font-stack-square.with-link:hover',
			),
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_contact;
	$ivan_vc_contact = new WPBakeryShortCode_ivan_contact_info( array('name' => 'Icon', 'base' => 'ivan_contact_info') );

} // #end class check