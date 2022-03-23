<?php

/**
 *
 * VC COLUMN and VC COLUMN INNER
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function ivan_column($atts, $content = '', $id = '') {

	$output = $font_color = $el_class = $width = $offset = '';
	extract(shortcode_atts(array(
		'font_color'      => '',
		'el_class' => '',
		'width' => '1/1',
		'css' => '',
		'offset' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_duration' => '',
		'animation_iteration' => '',
	), $atts));

	if ( $el_class != '' ) {
		$el_class = " " . str_replace( ".", "", $el_class );
	}
	
	$width = wpb_translateColumnWidthToSpan($width);
	$width = vc_column_offset_class_merge($offset, $width);
	$el_class .= ' wpb_column vc_column_container '.ts_get_animation_class($animation);
	
	$style = '';
	if ( ! empty( $font_color ) ) {
		$style .= vc_get_css_color( 'color', $font_color );
	}
	$style = empty( $style ) ? $style : ' style="' . $style . '"';
	
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), 'vc_column', $atts );
	$output .= "\n\t".'<div class="'.$css_class.'"'.$style.' '.ts_get_animation_data_class($animation_delay, $animation_iteration).'>';
	$output .= "\n\t\t".'<div class="wpb_wrapper">';
	$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	$output .= "\n\t\t".'</div> <!-- END .wpb_wrapper -->';
	$output .= "\n\t".'</div> <!-- END ' . $el_class . ' -->' . "\n";

	return $output;
}

add_shortcode('vc_column', 'ivan_column');
add_shortcode('vc_column_inner', 'ivan_column');
