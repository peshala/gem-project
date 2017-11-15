<?php
/**
 * Template part for displaying posts pagination.
 *
 * @package Bryte
 */

the_posts_pagination( array(
		'prev_text' => esc_html__( 'Next', 'bryte' ),
		'next_text' => esc_html__( 'Previous', 'bryte' ),
	)
);
