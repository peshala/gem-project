<?php
/**
 * Menus configuration.
 *
 * @package Bryte
 */

add_action( 'after_setup_theme', 'bryte_register_menus', 5 );
/**
 * Register menus.
 */
function bryte_register_menus() {

	register_nav_menus( array(
		'top'          => esc_html__( 'Top', 'bryte' ),
		'main'         => esc_html__( 'Main', 'bryte' ),
		'main_landing' => esc_html__( 'Landing Main', 'bryte' ),
		'footer'       => esc_html__( 'Footer', 'bryte' ),
		'social'       => esc_html__( 'Social', 'bryte' ),
	) );
}
