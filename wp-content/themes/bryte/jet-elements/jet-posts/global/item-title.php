<?php
/**
 * Loop item title
 */

if ( 'yes' !== $this->get_attr( 'show_title' ) ) {
	return;
}

jet_elements()->utility()->meta_data->get_terms( array(
	'type'    => 'category',
	'type'      => 'category',
	'delimiter' => ', ',
	'before'    => '<div class="post__cats">',
	'after'     => '</div>',
	'echo'      => true,
) );

jet_elements()->utility()->attributes->get_title( array(
	'class' => 'entry-title',
	'html'  => '<h5 %1$s><a href="%2$s">%4$s</a></h5>',
	'echo'  => true,
) );