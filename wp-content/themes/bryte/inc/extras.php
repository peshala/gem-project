<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bryte
 */

/**
 * Sidebar position
 */
add_filter( 'theme_mod_sidebar_position', 'bryte_set_post_meta_value' );

/**
 * Header container type
 */
add_filter( 'theme_mod_header_container_type', 'bryte_set_post_meta_value' );

/**
 * Content container type
 */
add_filter( 'theme_mod_content_container_type', 'bryte_set_post_meta_value' );

/**
 * Footer container type
 */
add_filter( 'theme_mod_footer_container_type', 'bryte_set_post_meta_value' );

/**
 * Header layout type
 */
add_filter( 'theme_mod_header_layout_type', 'bryte_set_post_meta_value' );

/**
 * Single post type
 */
add_filter( 'theme_mod_single_post_type', 'bryte_set_post_meta_value' );

/**
 * Header transparent layout
 */
add_filter( 'theme_mod_header_transparent_layout', 'bryte_pre_set_post_meta_value' );

/**
 * Header invert color scheme
 */
add_filter( 'theme_mod_header_invert_color_scheme', 'bryte_pre_set_post_meta_value' );

/**
 * Enable/disable breadcrumbs
 */
add_filter( 'theme_mod_breadcrumbs_visibillity', 'bryte_pre_set_post_meta_value' );

/**
 * Enable/disable top panel
 */
add_filter( 'theme_mod_top_panel_visibility', 'bryte_pre_set_post_meta_value' );

/**
 * Enable/disable header contact block
 */
add_filter( 'theme_mod_header_contact_block_visibility', 'bryte_pre_set_post_meta_value' );

/**
 * Enable/disable header search
 */
add_filter( 'theme_mod_header_search', 'bryte_pre_set_post_meta_value' );

/**
 * Enable/disable header woo elements
 */
add_filter( 'theme_mod_header_woo_elements', 'bryte_pre_set_post_meta_value' );

/**
 * Footer layout type
 */
add_filter( 'theme_mod_footer_layout_type', 'bryte_set_post_meta_value' );

/**
 * Enable/disable footer widget area
 */
add_filter( 'theme_mod_footer_widget_area_visibility', 'bryte_pre_set_post_meta_value' );

/**
 * Enable/disable footer contact block
 */
add_filter( 'theme_mod_footer_contact_block_visibility', 'bryte_pre_set_post_meta_value' );


/**
 * Set post meta.
 */
function bryte_pre_set_post_meta_value( $value ) {

	$value = bryte_set_post_meta_value( $value );

	if ( 'true' === $value || 'false' === $value  ) {
		return wp_validate_boolean( $value );
	}

	return $value;
}

/**
 * Set post specific meta value.
 *
 * @param  string $value Default meta-value.
 * @return string
 */
function bryte_set_post_meta_value( $value ) {
	$queried_obj = bryte_get_queried_obj();

	if ( ! $queried_obj ) {
		return $value;
	}

	$meta_key   = 'bryte_' . str_replace( 'theme_mod_', '', current_filter() );
	$meta_value = get_post_meta( $queried_obj, $meta_key, true );

	if ( ! $meta_value || 'inherit' === $meta_value ) {
		return $value;
	}

	return $meta_value;
}

/**
 * Get queried object.
 *
 * @return string|boolean
 */
function bryte_get_queried_obj() {
	$queried_obj = apply_filters( 'bryte_queried_object_id', false );

	if ( ! $queried_obj && ! bryte_maybe_need_rewrite_mod() ) {
		return false;
	}

	$queried_obj = is_home() ? get_option( 'page_for_posts' ) : $queried_obj;
	$queried_obj = ! $queried_obj ? get_the_id() : $queried_obj;

	return $queried_obj;
}

/**
 * Check if we need to try rewrite theme mod or not
 *
 * @return boolean
 */
function bryte_maybe_need_rewrite_mod() {

	if ( is_front_page() && 'page' !== get_option( 'show_on_front' ) ) {
		return false;
	}

	if ( is_home() && 'page' == get_option( 'show_on_front' ) ) {
		return true;
	}

	if ( ! is_singular() ) {
		return false;
	}

	return true;
}

/**
 * Render existing macros in passed string.
 *
 * @since  1.0.0
 * @param  string $string String to parse.
 * @return string
 */
function bryte_render_macros( $string ) {

	static $macros;

	if ( ! $macros ) {
		$macros = apply_filters( 'bryte_data_macros', array(
			'/%%year%%/'      => date( 'Y' ),
			'/%%date%%/'      => date( get_option( 'date_format' ) ),
			'/%%site-name%%/' => get_bloginfo( 'name' ),
			'/%%home_url%%/'  => esc_url( home_url( '/' ) ),
			'/%%theme_url%%/' => get_stylesheet_directory_uri(),
		) );
	}

	return preg_replace( array_keys( $macros ), array_values( $macros ), $string );
}

/**
 * Render font icons in content
 *
 * @param  string $content Content to render.
 * @return string
 */
function bryte_render_icons( $content ) {
	$icons     = bryte_get_render_icons_set();
	$icons_set = implode( '|', array_keys( $icons ) );

	$regex = '/icon:(' . $icons_set . ')?:?([a-zA-Z0-9-_]+)/';

	return preg_replace_callback( $regex, 'bryte_render_icons_callback', $content );
}

/**
 * Callback for icons render.
 *
 * @param  array $matches Search matches array.
 * @return string
 */
function bryte_render_icons_callback( $matches ) {

	if ( empty( $matches[1] ) && empty( $matches[2] ) ) {
		return $matches[0];
	}

	if ( empty( $matches[1] ) ) {
		return sprintf( '<i class="fa fa-%s"></i>', $matches[2] );
	}

	$icons = bryte_get_render_icons_set();

	if ( ! isset( $icons[ $matches[1] ] ) ) {
		return $matches[0];
	}

	return sprintf( $icons[ $matches[1] ], $matches[2] );
}

/**
 * Get list of icons to render.
 *
 * @return array
 */
function bryte_get_render_icons_set() {
	return apply_filters( 'bryte_render_icons_set', array(
		'fa'       => '<i class="fa fa-%s"></i>'
	) );
}

/**
 * Replace %s with theme URL.
 *
 * @param  string $url Formatted URL to parse.
 * @return string
 */
function bryte_render_theme_url( $url ) {
	
	return esc_url( sprintf( $url, get_template_directory_uri() ) );
}

/**
 * Get image ID by URL.
 *
 * @param  string $image_src Image URL to search it in database.
 * @return int|bool false
 */
function bryte_get_image_id_by_url( $image_src ) {
	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid = %s";
	$id    = $wpdb->get_var( $wpdb->prepare( $query, esc_url( $image_src ) ) );

	return $id;
}

/**
 * Print different galleries for masonry and non-masonry layout.
 */
function bryte_post_formats_gallery() {
	$size = bryte_post_thumbnail_size();

	if ( ! in_array( get_theme_mod( 'blog_layout_type' ), array( 'masonry-2-cols', 'masonry-3-cols' ) ) ) {
		return do_action( 'cherry_post_format_gallery', array(
			'size' => $size['size'],
		) );
	}

	$images = bryte_theme()->get_core()->modules['cherry-post-formats-api']->get_gallery_images( false );

	if ( is_string( $images ) && ! empty( $images ) ) {
		return $images;
	}

	$items             = array();
	$first_item        = null;
	$size              = $size['size'];
	$format            = '<div class="mini-gallery post-thumbnail--fullwidth">%1$s<div class="post-gallery__slides">%2$s</div></div>';
	$first_item_format = '<a href="%1$s" class="post-thumbnail__link">%2$s</a>';
	$item_format       = '<a href="%1$s">%2$s</a>';

	bryte_theme()->dynamic_css->add_style(
		'.post-gallery__slides',
		array( 'display' => 'none' )
	);

	foreach ( $images as $img ) {
		$image = wp_get_attachment_image( $img, $size );
		$url   = wp_get_attachment_url( $img );

		if ( sizeof( $items ) === 0 ) {
			$first_item = sprintf( $first_item_format, $url, $image );
		}

		$items[] = sprintf( $item_format, $url, $image );
	}

	printf( $format, $first_item, join( "\r\n", $items ) );
}

/**
 * Check if passed meta data is visible in current context.
 *
 * @since  1.0.0
 * @param  string $meta    Meta setting to check.
 * @param  string $context Current post context - 'single' or 'loop'.
 * @return bool
 */
function bryte_is_meta_visible( $meta, $context = 'loop' ) {

	if ( ! $meta ) {
		return false;
	}

	$meta_enabled = get_theme_mod( $meta, bryte_theme()->customizer->get_default( $meta ) );

	switch ( $context ) {

		case 'loop':

			if ( ! is_single() && $meta_enabled ) {
				return true;
			} else {
				return false;
			}

		case 'single':

			if ( is_single() && $meta_enabled ) {
				return true;
			} else {
				return false;
			}
	}

	return false;
}

/**
 * Get post thumbnail size.
 *
 * @return array
 */
function bryte_post_thumbnail_size( $args = array() ) {
	$sidebar_position = get_theme_mod( 'sidebar_position', bryte_theme()->customizer->get_default( 'sidebar_position' ) );

	$args = wp_parse_args( $args, array(
		'small'        => 'post-thumbnail',
		'fullwidth'    => ( 'fullwidth' !== $sidebar_position ) ? 'bryte-thumb-l' : 'bryte-thumb-1355-1020',
		'justify'      => 'bryte-thumb-l-2',
		'masonry'      => 'bryte-thumb-masonry',
		'class_prefix' => '',
	) );

	$layout      = get_theme_mod( 'blog_layout_type', bryte_theme()->customizer->get_default( 'blog_layout_type' ) );
	$size_option = get_theme_mod( 'blog_featured_image', bryte_theme()->customizer->get_default( 'blog_featured_image' ) );
	$size        = $args[ $size_option ];
	$link_class  = sanitize_html_class( $args['class_prefix'] . $size_option );

	global $wp_query;

	$valid_justify_post_1 = bryte_nth_child_post_item( 7, 2 );
	$valid_justify_post_2 = bryte_nth_child_post_item( 7, 3 );

	if ( 'default' !== $layout ) {
		$size       = $args['small'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	if ( in_array( $layout, array( 'masonry-2-cols', 'masonry-3-cols' ) ) ) {
		$size       = $args['masonry'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	if ( 'vertical-justify' === $layout && ! wp_is_mobile() && ( in_array( ( $wp_query->current_post + 1 ), $valid_justify_post_1 ) || in_array( ( $wp_query->current_post + 1 ), $valid_justify_post_2 ) ) ) {
		$size       = $args['justify'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	if ( is_single() ) {
		$size       = $args['fullwidth'];
		$link_class = $args['class_prefix'] . 'fullwidth';
	}

	return array(
		'size'  => $size,
		'class' => $link_class,
	);
}

/**
 * PHP analog css selector :nth-child( $multiplier*n + $addition).
 *
 * @param int $multiplier Multiplier.
 * @param int $addition   Addition.
 *
 * @return array
 */
function bryte_nth_child_post_item( $multiplier, $addition ) {
	global $posts_per_page;

	$valid_item = array();

	for ( $n = 0; $n < $posts_per_page; $n ++ ) {

		$result = $multiplier * $n + $addition;

		if ( $result > $posts_per_page ) {
			break;
		}

		$valid_item[] = $result;
	}

	return $valid_item;
}

/**
 * Check color is light or dark.
 *
 * @param string $color Hex color.
 *
 * @return null|string
 */
function bryte_hex_color_is_light_or_dark( $color ) {

	if ( false === strpos( $color, '#' ) ) {
		// Not a hex-color
		return null;
	}

	$hex = str_replace( '#', '', $color );

	if ( 3 === strlen( $hex ) ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else if ( 6 === strlen( $hex ) ) {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	} else {
		return false;
	}

	$luminance = ( $r * 0.299 ) + ( $g * 0.587 ) + ( $b * 0.114 );

	$is_light_or_dark = ( $luminance >= 128 ) ? 'light' : 'dark';

 return apply_filters( 'bryte_hex_color_is_light_or_dark', $is_light_or_dark, $color ) ;
}

/**
 * Get invert class.
 *
 * @param string $color Hex color.
 *
 * @return string
 */
function bryte_get_invert_class( $color ) {

	$invert_class = ( 'dark' === bryte_hex_color_is_light_or_dark( $color ) ) ? 'invert' : '';

	return $invert_class;
}

/**
 * Get invert class from customize color options.
 *
 * @param string $option Customize color option.
 *
 * @return string
 */
function bryte_get_invert_class_customize_option( $option ) {

	$color = esc_attr( get_theme_mod( $option, bryte_theme()->customizer->get_default( $option ) ) );

	return bryte_get_invert_class( $color );
}

/**
 * Get post template part slug.
 *
 * @return string
 */
function bryte_get_post_template_part_slug() {
	$blog_layout_type = get_theme_mod( 'blog_layout_type', bryte_theme()->customizer->get_default( 'blog_layout_type' ) );

	$blog_post_template = 'template-parts/post/default/content';

	if ( 'default' !== $blog_layout_type ) {
		$blog_post_template = 'template-parts/post/grid/content';
	}

	return apply_filters( 'bryte_post_template_part_slug', $blog_post_template, $blog_layout_type );
}

/**
 * Get single post template part slug.
 *
 * @return string
 */
function bryte_get_single_post_template_part_slug() {
	$single_post_type = get_theme_mod( 'single_post_type', bryte_theme()->customizer->get_default( 'single_post_type' ) );

	$single_post_template = 'template-parts/post/single/content-single';

	if ( 'modern' === $single_post_type && is_singular( 'post' ) ) {
		$single_post_template = 'template-parts/post/single/content-single-modern';
	}

	return apply_filters( 'bryte_single_post_template_part_slug', $single_post_template, $single_post_type );
}

/**
 * Add custom css style.
 */
function bryte_404_inline_css() {
	$page_404_bg_url = get_theme_mod( 'page_404_bg_image', bryte_theme()->customizer->get_default( 'page_404_bg_image' ) );
	$page_404_bg_url = esc_url( bryte_render_theme_url( $page_404_bg_url ) );

	$css = 'body.error404 .site-content_wrap{ background-image: url( ' . $page_404_bg_url . ' ); }';

	return $css;
}


/**
 * Get builder module template.
 */
function bryte_get_builder_module_template( $name = null, $module = null, $default = null ) {
	$builder_templates = apply_filters( 'bryte_builder_templates', 'template-parts/builder-templates/' );
	$template = locate_template( $builder_templates . $name );

	if ( $template ) {
		include $template;
		return;
	}

	$template = locate_template( $builder_templates . $default );

	if ( $template ) {
		include $template;
		return;
	}
}
