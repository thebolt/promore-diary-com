<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 12 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

$woocommerce_loop['first'] = false;
$woocommerce_loop['last'] = false;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
	$woocommerce_loop['first'] = true;
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
	$woocommerce_loop['last'] = true;
}

$classes[] = 'col-md-4 col-sm-6';

if ($woocommerce_loop['first'])
	echo "<div class=\"row product-row\">";
?>
<div <?php post_class( $classes ); ?>>
	<div class="cat-product-item">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
			echo woocommerce_get_product_thumbnail('shop_catalog');
		?>

		<div class="cat-product-info">
				<span class="cat-product-title"><?php the_title(); ?></span>

				<?php
					woocommerce_template_loop_price();
				?>
		</div>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>
<?php
if ($woocommerce_loop['last']) {
	echo "</div>";
}
?>
