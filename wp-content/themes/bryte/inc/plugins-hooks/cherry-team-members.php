<?php
/**
 * Cherry team members hooks.
 *
 * @package Bryte
 */

add_filter( 'cherry_team_shortcode_heading_format', 'bryte_cherry_team_shortcode_heading_format' );

/**
 * Change cherry-services heading format.
 *
 * @param array $heading Cherry services heading format.
 *
 * @return array
 */
function bryte_cherry_team_shortcode_heading_format ( $heading = array() ) {

	$heading = array(
		'super_title' => '<h3 class="team-heading_super_title">%s</h5>',
		'title'       => '<h4 class="team-heading_title">%s</h3>',
		'subtitle'    => '<p class="team-heading_subtitle">%s</p>',
	);

	return $heading;
}