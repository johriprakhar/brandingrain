<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	</div></div></div></div></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 site-main">
				<div class="product">
	<div class="woocommerce-tabs">
		<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo esc_attr($key); ?>_tab">
					<a href="#tab-<?php echo esc_attr($key); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>

			<?php
			// Custom Tab Option
			if( true == ivan_get_option('woo-product-extra-tab') ) :
			?>
			<li class="extra_tab">
				<a href="#tab-extra"><?php echo ivan_get_option('woo-product-extra-tab-title'); ?></a>
			</li>
			<?php
			endif;
			?>

		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo esc_attr($key); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php endforeach; ?>

		<?php
			// Custom Tab Content
			if( true == ivan_get_option('woo-product-extra-tab') ) :
			?> 
			<div class="panel entry-content" id="tab-extra">
				 <?php echo do_shortcode( ivan_get_option('woo-product-extra-tab-content') ); ?>
			</div>	
		<?php
			endif;
		?>

	</div>

<?php endif; ?>