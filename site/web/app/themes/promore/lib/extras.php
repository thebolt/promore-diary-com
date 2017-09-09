<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}

add_filter('wp_title', 'roots_wp_title', 10);


function load_fonts() {
	wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Alegreya:500|Alegreya:700');
	wp_enqueue_style( 'googleFonts');
}

add_action('wp_print_styles', 'load_fonts');


// Reconfigure woocommerce

// Add an extra wider product thumbnail
function setup_extra_thumbnail() {
	$shop_catalog	= wc_get_image_size( 'shop_catalog_wide' );
	add_image_size( 'shop_catalog_wide', $shop_catalog['width']*2, $shop_catalog['height'], $shop_catalog['crop'] );
}
add_action('after_setup_theme', 'setup_extra_thumbnail' );

function get_image_size_shop_catalog_wide($size) {
	$shop_catalog	= wc_get_image_size( 'shop_catalog');
	$out = array(
			'width'  => $shop_catalog['width']*2,
			'height' => $shop_catalog['height'],
			'crop'   => $shop_catalog['crop']
		);

	return $out;
}
add_filter('woocommerce_get_image_size_shop_catalog_wide', 'get_image_size_shop_catalog_wide');

// Remove title
add_filter('woocommerce_show_page_title', '__return_false');
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

// Removes tabs from their original loaction
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
// Inserts tabs under the main right product content
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );
// Remove related products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Remove add-to-cart on category page
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Hide the admin bar
add_filter('show_admin_bar', '__return_false');

