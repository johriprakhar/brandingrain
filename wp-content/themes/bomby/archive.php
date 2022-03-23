<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ivan_framework
 */

get_header(); ?>

	<?php

	$_classes = '';

	// Title Logic
	if( ( false == ivan_get_option('blog-disable-title') && false == ivan_get_option('blog-boxed-page') )
		OR ( false == ivan_get_option('blog-disable-title') && true == ivan_get_option('header-negative-height') ) ) :
		do_action( 'ivan_title_wrapper' );
	else :
		
		echo apply_filters('ivan_blog_divider', '<div class="title-wrapper-divider blog-version"></div>');

		$_classes .= ' no-title-wrapper';
	endif;

	do_action( 'ivan_content_before' ); 
	?>

	<?php
	// Boxed Style Support
	if( true == ivan_get_option('blog-boxed-style') )
		$_classes .= ' boxed-style';

	// Get Layout Option
	$_layout = ivan_get_option('blog-layout');

	$_sub_layout = ivan_get_option('blog-sub-' . $_layout );
	
	?>

	<div class="<?php echo apply_filters( 'iv_content_wrapper_classes', 'iv-layout content-wrapper index archives', 'blog' ); ?> blog-<?php echo esc_attr($_layout) . ' style-' . esc_attr($_sub_layout); ?><?php echo esc_attr($_classes); ?>">
		<div class="container">

			<?php
			// Boxed Page Logic
			if( true == ivan_get_option('blog-boxed-page') ) : ?>
			<div class="boxed-page-wrapper">
				
				<?php
				// Adds Title
				if( false == ivan_get_option('archives-disable-title') && true == ivan_get_option('blog-boxed-page')
					&& false == ivan_get_option('header-negative-height') ) :
					do_action( 'ivan_title_wrapper' );
				endif; ?>

				<div class="boxed-page-inner">
			<?php endif; ?>

				<div class="row">

					<?php
						/* Include the selected blog listing display
						 */
						get_template_part( 'post-templates/layout', $_layout . '-' . $_sub_layout );
					?>

				</div>

			<?php
			// Boxed Page Logic
			if( true == ivan_get_option('blog-boxed-page') ) : ?>
				</div><!-- .boxed-page-inner -->
			</div><!-- .boxed-page-wrapper -->
			<?php endif; ?>

		</div>
	</div>

	<?php
	do_action( 'ivan_content_after' ); 
	?>

<?php get_footer(); ?>