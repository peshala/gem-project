<?php
/**
 * Template part for single post navigation.
 *
 * @package Bryte
 */

if ( ! get_theme_mod( 'single_post_navigation', bryte_theme()->customizer->get_default( 'single_post_navigation' ) ) ) {
	return;
}

the_post_navigation();
