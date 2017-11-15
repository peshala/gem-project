<?php
/**
 * Thumbnails configuration.
 *
 * @package Bryte
 */

add_action( 'after_setup_theme', 'bryte_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function bryte_register_image_sizes() {
	set_post_thumbnail_size( 418, 315, true );

	// Registers a new image sizes.
	add_image_size( 'bryte-thumb-s', 150, 150, true );
	add_image_size( 'bryte-slider-thumb', 158, 88, true );
	add_image_size( 'bryte-thumb-m', 400, 400, true );
	add_image_size( 'bryte-thumb-masonry', 418, 9999, false );
	add_image_size( 'bryte-thumb-l', 886, 668, true );
	add_image_size( 'bryte-thumb-l-2', 886, 315, true );
	add_image_size( 'bryte-thumb-xl', 1920, 1080, true );
	add_image_size( 'bryte-author-avatar', 512, 512, true );

	add_image_size( 'bryte-woo-cart-product-thumb', 141, 188, true );
	add_image_size( 'bryte-thumb-listing-line-product', 418, 560, true );

	add_image_size( 'bryte-thumb-1355-1020', 1200, 900, true );
}
