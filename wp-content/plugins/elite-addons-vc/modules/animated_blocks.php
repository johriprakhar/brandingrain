<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function ivan_animated_blocks( $atts, $content = '', $id = '' ) {

	  extract( shortcode_atts( array(
	    'icon_image' => '',
	    'heading'    => '',
	    'btn_text'   => '',
	    'btn_link'   => ''
	  ), $atts ) );

	  if (function_exists('vc_parse_multi_attribute')) {
    		$parse_args = vc_parse_multi_attribute($btn_link);
    		$href = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    		$title = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    		$target = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  	  }

  	 $output =	'<div class="animated-block">';
  	$output	.=	'<div class="visible-part">';
  	if(!empty($icon_image) && is_numeric($icon_image)) {
  		$background_url =  wp_get_attachment_image_src( $icon_image, 'full' );
  		if(isset($background_url[0])) {
			$output	.=	'<figure>';
			$output	.=	'<img src="'.esc_url($background_url[0]).'" alt="Copro">';
			$output	.=	'</figure>';
		}
	}	
	$output	.=	'<h5>'.esc_html($heading).'</h5>';
	$output	.=	'</div>';
	$output	.=	'<div class="hidden-part">';
	$output	.=	'<p>'.wp_kses_post($content).'</p>';
	$output	.=	'<a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="dt-sc-button dt-newBtn-6">'.esc_html($btn_text).'</a>';
	$output	.=  '</div>';
	$output	.=  '</div>';
  	
  	return $output;
}

add_shortcode('ivan_animated_blocks', 'ivan_animated_blocks');
