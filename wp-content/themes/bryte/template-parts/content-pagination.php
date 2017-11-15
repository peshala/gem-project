<?php
/**
 * Template part for posts pagination.
 *
 * @package Bryte
 */

the_posts_pagination( apply_filters( 'bryte_content_posts_pagination',
	array(
		'prev_text' => sprintf( '<span class="screen-reader-text">%s</span>', esc_html__( 'Previous', 'bryte' ) ) . esc_html__( 'Previous', 'bryte' ),
		'next_text' => sprintf( '<span class="screen-reader-text">%s</span>', esc_html__( 'Next', 'bryte' ) ) . esc_html__( 'Next', 'bryte' ),
	)
) );
