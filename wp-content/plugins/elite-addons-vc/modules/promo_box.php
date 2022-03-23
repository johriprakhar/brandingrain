<?php
/***
 * Extension > Promo Box
 *
 * This is an extension of default VC Component
 *
 **/

if(class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_promo_box extends WPBakeryShortCode {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'hover_effect' => '',
				'title' => '',
				'button_text' => '',
				'button_link' => '',
				'el_class' => '',
				'animation' => '',
				'animation_delay' => '',
				'animation_iteration' => '',
				'css' => '',
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

			
			$href = $link_title = $target = '';
			if ( function_exists( 'vc_parse_multi_attribute' ) ) {
				$parse_args = vc_parse_multi_attribute( $button_link );
				$href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '';
				$link_title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : '';
				$target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
			}
			
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
			
			// Output Form
			ob_start();
			?>
			<a href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($link_title); ?>" target="<?php echo esc_attr($target); ?>" class="ivan-promo-box <?php echo sanitize_html_classes($prefixClass); ?> <?php echo sanitize_html_classes($css_class); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
				<div class="overlay <?php echo sanitize_html_classes($hover_effect);?>"></div>
				<p><?php echo wp_kses_post($content); ?></p>
				<h3><?php echo esc_html($title); ?></h3>
				<span aria-hidden="true" class="arrow_right promo-box-icon"></span>
			</a>

			<?php
			$output .= ob_get_clean();

			$output = str_replace(array("\n", "\t", "\r"), '', $output);

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
			'header_css' => array(
				// Font
				'font-family' => 'h3',
				'font-weight' => 'h3',
				'font-size' => 'h3',
				'line-height' => 'h3',
				'text-transform' => 'h3',
				'color' => 'h3',
			),
			
			'content_css' => array(
				// Font
				'font-family' => 'p',
				'font-weight' => 'p',
				'font-size' => 'p',
				'line-height' => 'p',
				'text-transform' => 'p',
				'color' => '.',
			),
			
			'button_css' => array(
				// Font
				'font-family' => 'a',
				'font-weight' => 'a',
				'font-size' => 'a',
				'line-height' => 'a',
				'text-transform' => 'a',
				'color' => 'a',
				// Dimensions
				'width' => '.ivan-button',
				'height' => '.ivan-button',
				// Spacing
				'margin-top' => 'a',
				'margin-right' => 'a',
				'margin-bottom' => 'a',
				'margin-left' => 'a',
				'padding-top' => 'a',
				'padding-right' => '.text-btn',
				'padding-bottom' => 'a',
				'padding-left' => '.text-btn',
				// Bg
				'background-color' => 'a',
				// Border Radius
				'border-top-left-radius' => 'a',
				'border-top-right-radius' => 'a',
				'border-bottom-left-radius' => 'a',
				'border-bottom-right-radius' => 'a',
				// Border
				'border-top-width' => 'a',
				'border-right-width' => 'a',
				'border-bottom-width' => 'a',
				'border-left-width' => 'a',
				'border-style' => 'a',
				'border-color' => 'a',
				// Hovers
				'color-hover' => 'a:hover',
				'border-color-hover' => 'a:hover',
				'background-color-hover' => 'a:hover',
			),
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_promo_box;
	$ivan_vc_promo_box = new WPBakeryShortCode_ivan_promo_box( array('name' => 'Promo box', 'base' => 'ivan_promo_box') );

} // #end class check