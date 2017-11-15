<?php
/**
 * Cherry-projects hooks.
 *
 * @package Bryte
 */

// Customization cherry-project plugin.
add_filter( 'cherry-projects-title-settings', 'bryte_cherry_projects_title_settings' );
add_filter( 'cherry-projects-author-settings', 'bryte_cherry_projects_author_settings' );
add_filter( 'cherry-projects-button-settings', 'bryte_cherry_projects_button_settings' );
add_filter( 'cherry-projects-content-settings', 'bryte_cherry_projects_content_settings' );
add_filter( 'cherry_projects_show_all_text', 'bryte_projects_show_all_text' );
add_filter( 'cherry-projects-prev-button-text', 'bryte_cherry_projects_prev_button_text' );
add_filter( 'cherry-projects-next-button-text', 'bryte_cherry_projects_next_button_text' );
add_filter( 'cherry_projects_cascading_list_map', 'bryte_cherry_projects_cascading_list_map' );

/**
 * Customization title settings to cherry-project.
 *
 * @param array $settings Title settings.
 *
 * @return array
 */
function bryte_cherry_projects_title_settings( $settings ) {

	$title_html = ( is_single() ) ? '<h3 %1$s>%4$s</h3>' : '<h5 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h5>';

	$settings['html']  = $title_html;
	$settings['class'] = 'project-entry-title';

	return $settings;
}

/**
 * Customization meta author settings to cherry-project.
 *
 * @param array $settings Author settings.
 *
 * @return array
 */
function bryte_cherry_projects_author_settings( $settings ) {

	$settings['html'] = '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>';

	return $settings;
}

/**
 * Customization button settings to cherry-project.
 *
 * @param array $settings Button settings.
 *
 * @return array
 */
function bryte_cherry_projects_button_settings( $settings ) {

	$new_settings = array(
		'text'  => esc_html__( 'View now!', 'bryte' ),
		'class' => 'project-more-button btn btn-primary',
		'icon'  => '',
		'html'  => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
	);

	$settings = array_merge( $settings, $new_settings );

	return $settings;
}

/**
 * Customization content settings to cherry-project.
 *
 * @param array $settings Content settings.
 *
 * @return array
 */
function bryte_cherry_projects_content_settings( $settings ) {

	$settings['class'] = 'project-entry-content';

	return $settings;
}

/**
 * Customization show all text to cherry-project.
 *
 * @return string
 */
function bryte_projects_show_all_text( $show_all_text ) {
	return esc_html__( 'All', 'bryte' );
}

/**
 * Customization cherry-projects prev button text.
 *
 * @return string
 */
function bryte_cherry_projects_prev_button_text( $prev_text ) {
	return esc_html__( 'Previous', 'bryte' );
}

/**
 * Customization cherry-projects next button text.
 *
 * @return string
 */
function bryte_cherry_projects_next_button_text( $next_text ) {
	return esc_html__( 'Next', 'bryte' );
}

/**
 * Customization cherry-projects cascading list map.
 *
 * @return array
 */
function bryte_cherry_projects_cascading_list_map( $cascading_list_map ) {
	return array( 2, 2, 3, 3, 3, 4, 4, 4, 4 );
}
