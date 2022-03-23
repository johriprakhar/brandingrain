<?php
/***
 * Extension > Call to Action
 *
 * This is an extension of default VC Component
 *
 **/

if(class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_call_action_2 extends WPBakeryShortCode {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'content_left' => '',
				'content_right' => '',
				'link' => '',
				'template' => apply_filters('ivan_vc_call_action_2_default_template', ''),
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

			// Add custom template class
			if('' != $template)
				$classes .= ' ' . $template;

			
			$href = $title = $target = '';
			if ( function_exists( 'vc_parse_multi_attribute' ) ) {
				$parse_args = vc_parse_multi_attribute( $link );
				$href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
				$title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : '';
				$target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
			}
			
			// Output Form
			ob_start();
			?>

			<div class="<?php echo sanitize_html_classes($prefixClass); ?> <?php echo ts_get_animation_class($animation); ?>" <?php echo ts_get_animation_data_class($animation_delay, $animation_iteration); ?> >
				<?php if (!empty($href)): ?>
					<a class="ivan-call-action-2-wrapper" href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($title); ?>" target="<?php echo esc_attr($target);?>">
				<?php else: ?>
					<div class="ivan-call-action-2-wrapper">
				<?php endif; ?>

					<div class="ivan-call-action-2 <?php echo sanitize_html_classes($classes); ?>">
						<span class="content-left"><?php echo wp_kses_post($content_left); ?></span>
						<?php if (!empty($content_right)): ?>
							<span class="content-right"><?php echo wp_kses_post($content_right); ?></span>
						<?php endif; ?>
						
					</div>

				<?php if (!empty($href)): ?>
					</a>
				<?php else: ?>
					</div>	
				<?php endif; ?>
			</div>
			

			<?php
			$output .= ob_get_clean();

			$output = str_replace(array("\n", "\t", "\r"), '', $output);

			// Transfer color scheme to button as well...
			if($template != '')
				$output = str_replace('place-template', $template, $output);

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
			'block_css' => array(
				// Spacing
				'margin-top' => '.ivan-call-action-2-wrapper',
				'margin-right' => '.ivan-call-action-2-wrapper',
				'margin-bottom' => '.ivan-call-action-2-wrapper',
				'margin-left' => '.ivan-call-action-2-wrapper',
				'padding-top' => '.ivan-call-action-2',
				'padding-right' => '.ivan-call-action-2',
				'padding-bottom' => '.ivan-call-action-2',
				'padding-left' => '.ivan-call-action-2',
				// Bg
				'background-color' => '.ivan-call-action-2-wrapper',
				// Hovers
				'background-color-hover' => '.ivan-call-action-2-wrapper:hover',
			),
			'content_left_css' => array(
				// Font
				'font-family' => '.ivan-call-action-2 .content-left',
				'font-weight' => '.ivan-call-action-2 .content-left',
				'font-size' => '.ivan-call-action-2 .content-left',
				'line-height' => '.ivan-call-action-2 .content-left',
				'text-transform' => '.ivan-call-action-2 .content-left',
				'color' => '.ivan-call-action-2 .content-left',
				//hover
				'color-hover' => '.ivan-call-action-2-wrapper:hover .ivan-call-action-2 .content-left',
			),
			
			'content_right_css' => array(
				// Font
				'font-family' => '.ivan-call-action-2 .content-right',
				'font-weight' => '.ivan-call-action-2 .content-right',
				'font-size' => '.ivan-call-action-2 .content-right',
				'line-height' => '.ivan-call-action-2 .content-right',
				'text-transform' => '.ivan-call-action-2 .content-right',
				'color' => '.ivan-call-action-2 .content-right',
				//hover
				'color-hover' => '.ivan-call-action-2-wrapper:hover .ivan-call-action-2 .content-right',
			),
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_call_action_2;
	$ivan_vc_call_action_2 = new WPBakeryShortCode_ivan_call_action_2( array('name' => 'Call to Action 2', 'base' => 'ivan_call_action_2') );

} // #end class check