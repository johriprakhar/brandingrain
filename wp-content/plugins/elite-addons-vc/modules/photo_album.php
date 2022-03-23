<?php
/***
 * Extension > Call to Action
 *
 * This is an extension of default VC Component
 *
 **/

if(class_exists('WPBakeryShortCodesContainer')) {

	// Class
	class WPBakeryShortCode_ivan_photo_album extends WPBakeryShortCodesContainer {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'ivan_columns' => '4',
				'el_class' => '',
				'animation' => 	'',
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

			$containerClass = 'ivan-projects ivan-projects-mansory vc_row no-margin';
			
			// Output Form
			ob_start();
			?>

			<div class="ivan-projects-main-wrapper hash-tags-cover-wrapper <?php echo sanitize_html_classes($prefixClass); ?>">
				<div class="<?php echo sanitize_html_classes($containerClass); ?>">
					<div class="gutter-sizer"></div>
					<?php echo do_shortcode($content); ?>
				</div> <!-- .ivan-projects -->
			</div> <!-- .ivan-projects-main-wrapper -->

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

		public $selectors = array(
			'title_css' => array(
				// Font
				'font-family' => 'h3',
				'font-weight' => 'h3',
				'font-size' => 'h3',
				'line-height' => 'h3',
				'text-transform' => 'h3',
				'color' => 'h3',
			),
			'subtitle_css' => array(
				// Font
				'font-family' => '.categories',
				'font-weight' => '.categories',
				'font-size' => '.categories',
				'line-height' => '.categories',
				'text-transform' => '.categories',
				'color' => '.categories',
			),
			
			'bottom_text_css' => array(
				// Font
				'font-family' => '.footer .text',
				'font-weight' => '.footer .text',
				'font-size' => '.footer .text',
				'line-height' => '.footer .text',
				'text-transform' => '.footer .text',
				'color' => '.footer .text',
			),
			
			'bottom_icon_css' => array(
				// Font
				'font-weight' => '.footer i',
				'font-size' => '.footer i',
				'line-height' => '.footer i',
				'color' => '.footer i',
			),
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_photo_album;
	$ivan_vc_photo_album = new WPBakeryShortCode_ivan_photo_album( array('name' => 'Photo album', 'base' => 'ivan_photo_album') );

} // #end class check


if(class_exists('WPBakeryShortCode')) {

	// Class
	class WPBakeryShortCode_ivan_photo_album_item extends WPBakeryShortCode {

		protected function content( $atts, $content = '' ) {
			global $ivan_custom_css;
			// Extract  atts and setup initial vars
			extract( shortcode_atts( array(
				'ivan_columns' => '',
				'title' => '',
				'subtitle' => '',
				'link' => '',
				'image_id' => '',
				'bottom_text' => '',
				'bottom_ico_family' => '',
				'bottom_ico' => '',
				'el_class' => '',
				'animation' => '',
				'animation_delay' => '',
				'animation_iteration' => '',
			), $atts) );

			$output = '';
			$classes = '';

			// El Class
			$classes .= ' '. $el_class;

			
			$href = $link_title = $target = '';
			if ( function_exists( 'vc_parse_multi_attribute' ) ) {
				$parse_args = vc_parse_multi_attribute( $link );
				$href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '';
				$link_title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : '';
				$target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
			}
			
			if (empty($ivan_columns)) {
				$ivan_columns = 2;
			}
			$singleColumn = 12 / $ivan_columns; // 12 Bootstrap Columns / number of columns
			$singleColumnXS = 12;
			
			wp_enqueue_script('ivan_vc_projects');
			
			// Output Form
			ob_start();
			?>
			
			<div class="vc_col-xs-<?php echo sanitize_html_classes($singleColumnXS); ?> vc_col-sm-<?php echo sanitize_html_classes($singleColumn); ?> vc_col-md-<?php echo sanitize_html_classes($singleColumn); ?> taphover ivan-project hash-tags-cover">
				<div class="ivan-project-inner">
					<a href="#" class="thumbnail" style="">
						<?php
						if($image_id != ''):
							$url = wp_get_attachment_image_src($image_id, 'full');
							if (is_array($url) && isset($url[0])):
								echo '<img src="'. esc_url($url['0']).'" alt="'.esc_attr($title).'">';
							endif;
						endif;
						?>
						<span class="ivan-hover-fx"></span>
					</a>

					<div class="entry">
						<div class="entry-inner">
							<?php if (!empty($href) || $href == '#'): ?>
								<a href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($link_title); ?>" target="<?php echo esc_attr($target); ?>" class="grad-overlay"></a>
							<?php else: ?>
								<div href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($link_title); ?>" target="<?php echo esc_attr($target); ?>" class="grad-overlay"></div>
							<?php endif; ?>
							
							
							<div class="centered">
								<h3><?php echo esc_html($title);?></h3>
								<div class="categories"><?php echo esc_html($subtitle);?></div>									
							</div>
						</div>
					</div>
					<div class="footer">
						<?php if (!empty($bottom_ico)): ?>
							<i class="<?php echo sanitize_html_classes($bottom_ico_family.$bottom_ico); ?>"></i>
						<?php endif; ?>
						<span class="text"><?php echo esc_html($bottom_text); ?></span>
					</div>
				</div>
			</div>
			
			<?php
			$output .= ob_get_clean();

			$output = str_replace(array("\n", "\t", "\r"), '', $output);

			return $output;
		}

		// H1 Selectors
		public $selectors = array(
			
		);

		public $prefix = '';
	}// #class end

	// Init global var to store this module data
	global $ivan_vc_photo_album_item;
	$ivan_vc_photo_album_item = new WPBakeryShortCode_ivan_photo_album_item( array('name' => 'Photo album item', 'base' => 'ivan_photo_album_item') );

} // #end class check