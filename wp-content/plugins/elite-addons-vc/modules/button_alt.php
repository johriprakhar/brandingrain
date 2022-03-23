<?php
/***
 * Module > Button
 *
 * This module extends default VC class, turning easy extend it with custom functions!
 *
 **/

if(class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_button_alt extends WPBakeryShortCode {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'link' => '',
				'target' => '',
				'style' => '',
				'ico_family' => '',
				'ico' => '',
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
			
			if (empty($style)) {
				$style = 'dt-newBtn-1';
			}
			
			if (empty($ico_family)) {
				$ico_family = 'fa fa-';
			}
			
			
			
			$classes .= ' ' . $style;
			
			// Add custom classes provided by users
			if('' != $el_class)
				$classes .= ' ' . $el_class;

			// Add custom template class
			
			// Adjust Content
			$content =  str_replace(array('<p>', '</p>'), '', $content );

			if ($animation) {
				$classes .= ' ' . ts_get_animation_class($animation);
			}
			
			if('' != $align)
				echo '<div class="ivan-button-align '.$align.'">';
			?>
			<span class="<?php echo sanitize_html_class($prefixClass); ?>">
				<a href="<?php echo esc_url($link); ?>" <?php echo ('yes' == 'target' ? 'target="_blank"' : ''); ?> class="dt-sc-button <?php echo sanitize_html_classes($classes) ;?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?>>
					<?php if ($style != 'dt-newBtn-3'): ?>
						<i class="<?php echo sanitize_html_classes($ico_family.$ico); ?>"></i>
					<?php endif; ?>
					
					<span><?php echo wp_kses_post($content); ?></span>
							
					<?php if ($style == 'dt-newBtn-3'): ?>
						<i class="<?php echo sanitize_html_classes($ico_family.$ico); ?>"></i>
					<?php endif; ?>
				</a>
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
				'font-family' => 'a.dt-sc-button',
				'font-weight' => 'a.dt-sc-button',
				'font-size' => 'a.dt-sc-button',
				'line-height' => 'a.dt-sc-button',
				'text-transform' => 'a.dt-sc-button',
				'color' => 'a.dt-sc-button',
				// Spacing
				'margin-top' => 'a.dt-sc-button',
				'margin-right' => 'a.dt-sc-button',
				'margin-bottom' => 'a.dt-sc-button',
				'margin-left' => 'a.dt-sc-button',
				// Bg
				'background-color' => 'a.dt-sc-button',
				// Border Radius
				'border-top-left-radius' => 'a.dt-sc-button',
				'border-top-right-radius' => 'a.dt-sc-button',
				'border-bottom-left-radius' => 'a.dt-sc-button',
				'border-bottom-right-radius' => 'a.dt-sc-button',
				// Border
				'border-top-width' => 'a.dt-sc-button',
				'border-right-width' => 'a.dt-sc-button',
				'border-bottom-width' => 'a.dt-sc-button',
				'border-left-width' => 'a.dt-sc-button',
				'border-style' => 'a.dt-sc-button',
				'border-color' => 'a.dt-sc-button',
				// Hovers
				'color-hover' => 'a.dt-sc-button:hover',
				'border-color-hover' => 'a.dt-sc-button:hover',
				'background-color-hover' => 'a.dt-sc-button:hover',
			),
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_button_alt;
	$ivan_vc_button_alt = new WPBakeryShortCode_ivan_button_alt( array('name' => 'Button Alternative', 'base' => 'ivan_button_alt') );

} // #end class check