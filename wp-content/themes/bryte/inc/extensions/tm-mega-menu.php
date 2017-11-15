<?php
/**
 * Extends basic functionality for better TM Mega Menu compatibility
 *
 * @package Bryte
 */

/**
 * Check if Mega Menu plugin is activated.
 *
 * @return bool
 */
function bryte_is_mega_menu_active() {
	return class_exists( 'tm_mega_menu' );
}

add_filter( 'bryte_theme_script_variables', 'bryte_pass_mega_menu_vars' );

/**
 * Pass Mega Menu variables.
 *
 * @param  array  $vars Variables array.
 * @return array
 */
function bryte_pass_mega_menu_vars( $vars = array() ) {

	if ( ! bryte_is_mega_menu_active() ) {
		return $vars;
	}

	$vars['megaMenu'] = array(
		'isActive' => true,
		'location' => get_option( 'tm-mega-menu-location' ),
	);

	return $vars;
}
