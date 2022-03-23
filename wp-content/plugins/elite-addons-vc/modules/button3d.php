<?php
/***
 * Module > Button
 *
 * This module extends default VC class, turning easy extend it with custom functions!
 *
 **/

if(class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_button3d extends WPBakeryShortCode {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'link' => '',
				'target' => '',
				'align' => '',

				'animation' => '',
				'animation_delay' => '',
				'animation_iteration' => '',
				'el_class' => '',
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

			// Output Form
			ob_start();
			
		
			// Add custom classes provided by users
			if('' != $el_class)
				$classes .= ' ' . $el_class;

			// Add custom template class
			
			// Adjust Content
			$content =  str_replace(array('<p>', '</p>'), '', $content );

			if ($animation) {
				$classes .= ' ' . ts_get_animation_class($animation);
			}
			
			$classes_arr = array();
			if (!empty($classes)) {
				$classes_arr = explode(' ',$classes);
				$classes_arr = array_map('trim',$classes_arr);
				if (!is_array($classes_arr)) {
					$classes_arr = array();
				}
			}
			
			
			if('' != $align)
				echo '<div class="ivan-button-align '.$align.'">';
			?>
			<span class="<?php echo sanitize_html_class($prefixClass); ?>">
				<a href="<?php echo esc_url($link); ?>" <?php echo ('yes' == 'target' ? 'target="_blank"' : ''); ?> class="dt-sc-button button-3d <?php echo implode(' ',array_map('sanitize_html_class',$classes_arr));?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>><?php echo wp_kses_post($content); ?></a>
			</span>
			<?php 
			if('' != $align)
				echo '</div>';
			?>
			<div class="dt-sc-clear"></div>
			<?php
			$output .= ob_get_clean();

			//
			// Customizer CSS Output
			//
				$style = '';
				foreach ($this->selectors as $key => $value) {
					if( isset($atts[$key]) && '' != $atts[$key]) {
						$style .= ivan_vc_customizer_get_style( $atts[$key], $this->selectors[$key], $this->prefix, $key );
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
			'btn_css' => array(
				// Font
				'font-family' => 'a',
				'font-weight' => 'a',
				'font-size' => 'a',
				'line-height' => 'a',
				'text-transform' => 'a',
				'color' => 'a',
				// Spacing
				'margin-top' => 'a',
				'margin-right' => 'a',
				'margin-bottom' => 'a',
				'margin-left' => 'a',
//				'padding-top' => 'a',
//				'padding-right' => '.text-btn',
//				'padding-bottom' => 'a',
//				'padding-left' => '.text-btn',
				// Bg
				'background-color' => 'a',
				// Border Radius
//				'border-top-left-radius' => 'a',
//				'border-top-right-radius' => 'a',
//				'border-bottom-left-radius' => 'a',
//				'border-bottom-right-radius' => 'a',
				// Border
//				'border-top-width' => 'a',
//				'border-right-width' => 'a',
//				'border-bottom-width' => 'a',
//				'border-left-width' => 'a',
//				'border-style' => 'a',
				'border-color' => 'a',
				// Hovers
//				'color-hover' => 'a:hover',
//				'border-color-hover' => 'a:hover',
//				'background-color-hover' => 'a:hover',
			),
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_button3d;
	$ivan_vc_button3d = new WPBakeryShortCode_ivan_button3d( array('name' => '3D Button', 'base' => 'ivan_button3d') );

} // #end class check