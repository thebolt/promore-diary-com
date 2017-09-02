<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */


// Figure out which category to possibly tag it with somemore classes

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$cat_slug = $term->slug;
$cat_slug_class = 'cat-' . $cat_slug;

$is_wide = false;
if ($cat_slug == 'inners') {
	$is_wide = true;
}
?>

	<?php get_template_part('templates/category', 'header'); ?>

	<?php do_action( 'woocommerce_archive_description' ); ?>

	<div class="col-sm-9 cat-main-display products <?php echo $cat_slug_class; ?>">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		

		<?php if ( have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						if ($is_wide) {
							wc_get_template_part( 'content', 'product-wide' );
						} else {
							wc_get_template_part( 'content', 'product' );
						}
					?>
					
				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	</div>
	<?php 
		ob_start();

		dynamic_sidebar('sidebar-category');

		$sidebar_ct = ob_get_contents();
		ob_end_clean();

		$has_sidebar = (!!stripos($sidebar_ct, "h3"));
	?>
	
	<?php if ($has_sidebar) : ?>
	<div class="col-sm-3 cat-widget-container">
		<ul class="cat-widget-list">
			<?php echo $sidebar_ct; ?>
		</ul>
	</div>
	<?php endif; ?>