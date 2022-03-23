<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;

// Bootstrap Column
$bootstrapColumn = round( 12 / $woocommerce_loop['columns'] );
?>
<li class="product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 )
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	echo ' col-xs-12 col-sm-'. $bootstrapColumn .' col-md-' . $bootstrapColumn;
	?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<?php
	// Apply custom background to categories blocks...

	$_style = '';

	$thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
	$_image = wp_get_attachment_url( $thumbnail_id );

	if( $_image )
		$_style = 'background-image: url('.$_image.');';
	?>

	<a href="<?php echo esc_url( get_term_link( $category->slug, 'product_cat' ) ); ?>" class="main-link" style="<?php echo esc_attr($_style); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<div class="gradient-overlay"></div>

		<h3>
			<?php
				echo '<span class="cat-title-inner">' . $category->name . '</span><span class="cat-count-inner">' . $category->count . ' ' . esc_html__('Products', 'bomby') . '</span>';
			?>
		</h3>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>