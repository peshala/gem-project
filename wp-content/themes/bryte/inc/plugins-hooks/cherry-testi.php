<?php
/**
 * Cherry-testi hooks.
 *
 * @package Bryte
 */

// Customization cherry-testimonials pagination args.
add_filter( 'tm_testimonials_pagination_args', 'bryte_tm_testimonials_pagination_args', 10, 2 );

// Add template to tm-testimonials templates list.
add_filter( 'tm_testimonials_templates_list', 'bryte_tm_testimonials_templates_list' );


/**
 * Customization cherry-testimonials pagination args.
 *
 * @return array
 */
function bryte_tm_testimonials_pagination_args( $pagination_args, $args ) {

	$pagination_args = array(
		'prev_text' => esc_html__( 'Previous', 'bryte' ),
		'next_text' => esc_html__( 'Next', 'bryte' ),
	);

	return $pagination_args;
}

/**
 * Add template to tm-testimonials templates list.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function bryte_tm_testimonials_templates_list( $tmpl_list ) {
	$tmpl_list['default-center.tmpl'] = 'default-center.tmpl';

	return $tmpl_list;
}
