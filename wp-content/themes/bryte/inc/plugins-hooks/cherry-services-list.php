<?php
/**
 * Cherry-services-list hooks.
 *
 * @package Bryte
 */

// Customization cherry-services-list plugin.
add_filter( 'cherry_services_list_meta_options_args', 'bryte_change_services_list_icon_pack' );
add_filter( 'cherry_services_default_icon_format', 'bryte_cherry_services_default_icon_format' );
add_filter( 'cherry_services_features_title_format', 'bryte_cherry_services_features_title_format' );
add_filter( 'cherry_services_styles', 'bryte_dequeue_cherry_services_grid_style' );
add_filter( 'cherry_services_shortcode_heading_format', 'bryte_cherry_services_shortcode_heading_format' );

/**
 * Change cherry-services-list icon pack.
 */
function bryte_change_services_list_icon_pack( $fields ) {

	$fields['fields']['cherry-services-icon']['auto_parse'] = true;

	$fields['fields']['cherry-services-icon']['icon_data'] = array(
		'icon_set'    => 'ncIconOutline',
		'icon_css'    => BRYTE_THEME_CSS . '/nucleo-outline.css',
		'icon_base'   => 'nc-icon-outline',
		'icon_prefix' => '',
		'icons'       => false
	);

	return $fields;
}

/**
 * Change cherry-services-list icon format
 *
 * @return string
 */
function bryte_cherry_services_default_icon_format( $icon_format ) {
	return '<i class="nc-icon-outline %s"></i>';
}

/**
 * Change cherry-services features title format.
 */
function bryte_cherry_services_features_title_format( $title_format ) {
	return '<h5 class="service-features_title">%s</h5>';
}

/**
 * Dequeue cherry-services grid style.
 *
 * @param array $styles Cherry services list styles.
 *
 * @return array
 */
function bryte_dequeue_cherry_services_grid_style ( $styles = array() ) {

	unset( $styles['cherry-services-grid'] );

	return $styles;
}

/**
 * Change cherry-services heading format.
 *
 * @param array $heading Cherry services heading format.
 *
 * @return array
 */
function bryte_cherry_services_shortcode_heading_format ( $heading = array() ) {

	$heading = array(
		'super_title' => '<h3 class="services-heading_super_title">%s</h3>',
		'title'       => '<h4 class="services-heading_title">%s</h4>',
		'subtitle'    => '<p class="services-heading_subtitle">%s</p>',
	);

	return $heading;
}

