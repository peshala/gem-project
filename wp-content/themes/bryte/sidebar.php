<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bryte
 */
$sidebar_position = get_theme_mod( 'sidebar_position' );

if ( is_active_sidebar( 'sidebar' ) && 'fullwidth' !== $sidebar_position && ! bryte_is_product_page() ) {
	do_action( 'bryte_render_widget_area', 'sidebar' );
}

if ( is_active_sidebar( 'shop-sidebar' ) && 'fullwidth' !== $sidebar_position && bryte_is_product_page() ) {
	if ( ( is_shop() || is_product_taxonomy() ) && ! is_single() ) {
		do_action( 'bryte_render_widget_area', 'shop-sidebar' );
	}
}