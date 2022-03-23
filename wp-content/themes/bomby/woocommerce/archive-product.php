<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version	 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<?php
$_classes = '';

$title_class = 'normal';

if( ivan_get_option('title-wrapper-layout') == 'Ivan_Layout_Title_Wrapper_Large' )
	$title_class = 'large';

// Title Logic
if( ( false == ivan_get_option('woo-disable-title') && false == ivan_get_option('shop-boxed-page') )
	OR ( true == ivan_get_option('header-negative-height') && false == ivan_get_option('woo-disable-title') ) ) :
?>
	<div id="iv-layout-title-wrapper" class="<?php echo apply_filters( 'iv_title_wrapper_classes', 'iv-layout title-wrapper title-wrapper-shop title-wrapper-' . $title_class); ?> <?php echo ivan_get_option('title-wrapper-color-scheme'); ?>">
		<div class="container">
			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-12 ivan-title-inner">
					<?php
						$_shopheader = ivan_get_option('title-text-shop');
						if(!$_shopheader){
							$_shopheader = 'Shop';
						}
					?>
					<?php // Display optional description of shop
					if( ivan_get_option('title-desc-shop') != '' ) : ?>
						<div class="title-description">
							<p><?php echo nl2br(ivan_get_option('title-desc-shop')); ?></p>
						</div>
					<?php 
					endif;	
					?>
					<h2><?php echo esc_html( $_shopheader ); ?></h2>

					<?php if( ivan_get_option('breadcrumb-shop-disable') == false && $title_class != 'large' ) : ?>
							<?php 
							// Display Breadcrumb
							$defaults = array(
								'wrap_before'  => '<div class="ivan-breadcrumb ivan-woo-breadcrumb"><ul class="breadcrumbs">' . apply_filters('ivan_you_are_here_shop', '<li class="intro">'. esc_html__('You are here:', 'bomby') .'</li>'),
								'wrap_after' => '</ul></div>',
								'before'   => '<li typeof="v:Breadcrumb">',
								'after'   => '</li>',
								'home'	=> esc_html__('Home', 'bomby'),
								'delimiter'  => '<li class="separator">/</li>',
							);
							$args = wp_parse_args( $defaults );
							wc_get_template( 'global/breadcrumb.php', $args );
							?>
					<?php endif; ?>

				</div>

			</div><!--.row -->
		</div><!--.container-->
	</div>
<?php
else :

	if( ( false == ivan_get_option('header-negative-height') && true == ivan_get_option('title-wrapper-enable-switch') ) OR
		true == ivan_get_option('shop-boxed-page') )
		echo apply_filters('ivan_blog_divider', '<div class="title-wrapper-divider blog-version"></div>');

	if( true == ivan_get_option('title-wrapper-enable-switch') && false == ivan_get_option('shop-boxed-page') )
		$_classes .= ' no-title-wrapper';
endif; 
?>
	<?php
	/* @todo: adds who is being hooked */
	do_action( 'ivan_content_before' ); 
	?>
	
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<div class="<?php echo apply_filters( 'iv_content_wrapper_classes', 'iv-layout content-wrapper shop-wrapper ', 'shop' ); ?>">
			<div class="container">

				<?php
				// Boxed Page Logic
				if( true == ivan_get_option('shop-boxed-page') && false == ivan_get_option('header-negative-height') ) : ?>
				<div class="boxed-page-wrapper">

					<?php
					// Adds Title
					if( false == ivan_get_option('title-wrapper-enable-switch') && true == ivan_get_option('shop-boxed-page')
						&& false == ivan_get_option('header-negative-height') ) :
						
						// Display Title again but now inside the boxed div..
						?>
							<div id="iv-layout-title-wrapper" class="<?php echo apply_filters( 'iv_title_wrapper_classes', 'iv-layout title-wrapper title-wrapper-shop title-wrapper-' . $title_class); ?> <?php echo ivan_get_option('title-wrapper-color-scheme'); ?>">
								<div class="container">
									<div class="row">

										<div class="col-xs-12 col-sm-12 col-md-12 ivan-title-inner">
											<h2><?php echo ivan_get_option('title-text-shop'); ?></h2>
											<?php // Display optional description of shop
											if( ivan_get_option('title-desc-shop') != '' ) : ?>
												<div class="title-description">
													<p><?php echo nl2br(ivan_get_option('title-desc-shop')); ?></p>
												</div>
											<?php 
											endif;	
											?>

											<?php if( ivan_get_option('breadcrumb-shop-disable') == false && $title_class != 'large' ) : ?>
													<?php 
													// Display Breadcrumb
													$defaults = array(
														'wrap_before'  => '<div class="ivan-breadcrumb ivan-woo-breadcrumb"><ul class="breadcrumbs">' . apply_filters('ivan_you_are_here_shop', '<li class="intro">'. esc_html__('You are here:', 'bomby') .'</li>'),
														'wrap_after' => '</ul></div>',
														'before'   => '<li typeof="v:Breadcrumb">',
														'after'   => '</li>',
														'home'	=> esc_html__('Home', 'bomby'),
														'delimiter'  => '<li class="separator">/</li>',
													);
													$args = wp_parse_args( $defaults );
													wc_get_template( 'global/breadcrumb.php', $args );
													?>
											<?php endif; ?>
											
										</div>

									</div><!--.row -->
								</div><!--.container-->
							</div>
						<?php
					endif; ?>

					<div class="boxed-page-inner">
				<?php endif; ?>

					

					<div class="row">

						<?php
						$_layout = ivan_get_option('woo-shop-layout');
						if(!$_layout){
							$_layout = 'full';
						}

						get_template_part( 'woocommerce/layouts/shop', $_layout );
						?>

					</div>

				<?php
				// Boxed Page Logic
				if( true == ivan_get_option('shop-boxed-page') && false == ivan_get_option('header-negative-height') ) : ?>
					</div><!-- .boxed-page-inner -->
				</div><!-- .boxed-page-wrapper -->
				<?php endif; ?>

			</div>
		</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' ); ?>