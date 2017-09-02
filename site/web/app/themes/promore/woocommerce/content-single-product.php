<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>


<?php
	global $product;
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-sm-4">
		<?php woocommerce_show_product_images(); ?>
	</div>

	<div class="col-sm-8">
		<?php woocommerce_template_single_excerpt(); ?>
		<!-- Variable handling -->

		
		<?php //woocommerce_template_single_add_to_cart(); ?>

		
		<div class="product-info">
			<?php the_content(); ?>
		</div>
		<div class="product-attributes">
			<?php $product->list_attributes(); ?>
		</div>

		<?php woocommerce_template_single_price(); ?>
		
		<?php woocommerce_template_single_meta(); ?>
	</div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
