<?php
/**
 * Theme hooks.
 *
 * @package Bryte
 */

// Menu description.
add_filter( 'walker_nav_menu_start_el', 'bryte_nav_menu_description', 10, 4 );

// Sidebars classes.
add_filter( 'bryte_widget_area_classes', 'bryte_set_sidebar_classes', 10, 2 );

// Set footer columns.
add_filter( 'dynamic_sidebar_params', 'bryte_get_footer_widget_layout' );

// Adapt default image post format classes to current theme.
add_filter( 'cherry_post_formats_image_css_model', 'bryte_add_image_format_classes', 10, 2 );

// Enqueue misc js script.
add_filter( 'bryte_theme_script_depends', 'bryte_enqueue_misc' );

// Add to toTop and stickUp properties if required.
add_filter( 'bryte_theme_script_variables', 'bryte_js_vars' );

// Add has/no thumbnail classes for posts.
add_filter( 'post_class', 'bryte_post_thumb_classes' );

// Modify a comment form.
add_filter( 'comment_form_defaults', 'bryte_modify_comment_form' );

// Reorder comment fields
add_filter( 'comment_form_fields', 'bryte_reorder_comment_fields' );

// Additional body classes.
add_filter( 'body_class', 'bryte_extra_body_classes' );

// Adds the meta viewport to the header.
add_action( 'wp_head', 'bryte_meta_viewport', 0 );

// Customization for `Tag Cloud` widget.
add_filter( 'widget_tag_cloud_args', 'bryte_customize_tag_cloud' );

// Changed excerpt more string.
add_filter( 'excerpt_more', 'bryte_excerpt_more' );

// Creating wrappers for audio shortcode.
add_filter( 'wp_audio_shortcode', 'bryte_audio_shortcode', 10, 5 );

// Set specific content classes.
add_filter( 'bryte_content_classes', 'bryte_set_specific_content_classes' );

// Change text for buddypress activity read more
add_filter( 'bp_activity_excerpt_append_text', 'bryte_bp_activity_read_more_text' );

// Add template to cherry-team-members templates list.
add_filter( 'cherry_team_templates_list', 'bryte_add_template_to_cherry_team_templates_list' );

// Set specific customizer settings.
add_filter( 'theme_mod_sidebar_width', 'bryte_woo_sidebar_width' );
add_filter( 'theme_mod_sidebar_position', 'bryte_specific_sidebar_position' );
add_filter( 'theme_mod_top_panel_visibility', 'bryte_woo_top_panel_visibility' );

// Landing main menu location.
add_filter( 'bryte_main_menu_args', 'bryte_landing_main_menu_location' );

// Add woo-elements option to page settings meta.
add_filter( 'bryte_page_settings_meta', 'bryte_add_woo_elements_meta' );

// Custom gallery grid sizes
add_action( 'init', 'bryte_add_imeges_size_filter' );

add_filter( 'the_content', 'bryte_fix_elementor_content', -999 );

function bryte_fix_elementor_content( $content ) {
	remove_filter( 'the_content', 'wptexturize', 10 );
	return $content;
}

/**
 * Append description into nav items
 *
 * @param  string $item_output The menu item output.
 * @param  WP_Post $item Menu item object.
 * @param  int $depth Depth of the menu.
 * @param  array $args wp_nav_menu() arguments.
 *
 * @return string
 */
function bryte_nav_menu_description( $item_output, $item, $depth, $args ) {

	if ( 'main' !== $args->theme_location || ! $item->description ) {
		return $item_output;
	}

	$descr_enabled = get_theme_mod(
		'header_menu_attributes',
		bryte_theme()->customizer->get_default( 'header_menu_attributes' )
	);

	if ( ! $descr_enabled ) {
		return $item_output;
	}

	$current     = $args->link_after . '</a>';
	$description = '<div class="menu-item__desc">' . $item->description . '</div>';
	$item_output = str_replace( $current, $description . $current, $item_output );

	return $item_output;
}

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @uses   bryte_get_layout_classes.
 *
 * @param  array $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 *
 * @return array
 */
function bryte_set_sidebar_classes( $classes, $area_id ) {

	if ( 'sidebar' == $area_id || 'shop-sidebar' == $area_id ) {
		return bryte_get_layout_classes( 'sidebar', $classes );
	}

	if ( 'footer-area' == $area_id ) {
		$columns = esc_html( get_theme_mod( 'footer_widget_columns', bryte_theme()->customizer->get_default( 'footer_widget_columns' ) ) );

		if ( '1' !== $columns ) {
			$classes[] = sprintf( 'footer-area--%s-cols', $columns );
		} else {
			$classes[] = 'footer-area--fullwidth';
		}

		$classes[] = 'row';
	}

	return $classes;
}

/**
 * Get footer widgets layout class
 *
 * @since  1.0.0
 *
 * @param  string $params Existing widget classes.
 *
 * @return string
 */
function bryte_get_footer_widget_layout( $params ) {

	if ( is_admin() ) {
		return $params;
	}

	if ( empty( $params[0]['id'] ) || 'footer-area' !== $params[0]['id'] ) {
		return $params;
	}

	if ( empty( $params[0]['before_widget'] ) ) {
		return $params;
	}

	$columns = get_theme_mod(
		'footer_widget_columns',
		bryte_theme()->customizer->get_default( 'footer_widget_columns' )
	);

	$columns = intval( $columns );
	$classes = 'class="col-xs-12 col-sm-%3$s col-md-%2$s col-lg-%1$s %4$s ';

	switch ( $columns ) {
		case 4:
			$lg_col = 3;
			$md_col = 6;
			$sm_col = 12;
			$extra  = '';
			break;

		case 3:
			$lg_col = 4;
			$md_col = 4;
			$sm_col = 12;
			$extra  = '';
			break;

		case 2:
			$lg_col = 6;
			$md_col = 6;
			$sm_col = 12;
			$extra  = '';
			break;

		default:
			$lg_col = 12;
			$md_col = 12;
			$sm_col = 12;
			$extra  = '';
			break;
	}

	$params[0]['before_widget'] = str_replace(
		'class="',
		sprintf( $classes, $lg_col, $md_col, $sm_col, $extra ),
		$params[0]['before_widget']
	);

	return $params;
}

/**
 * Filter image CSS model
 *
 * @param  array $css_model Default CSS model.
 * @param  array $args Post formats module arguments.
 *
 * @return array
 */
function bryte_add_image_format_classes( $css_model, $args ) {
	$blog_featured_image = esc_html( get_theme_mod( 'blog_featured_image', bryte_theme()->customizer->get_default( 'blog_featured_image' ) ) );
	$blog_layout         = esc_html( get_theme_mod( 'blog_layout_type', bryte_theme()->customizer->get_default( 'blog_layout_type' ) ) );
	$suffix              = ( 'default' !== $blog_layout ) ? 'fullwidth' : $blog_featured_image;

	$css_model['link'] .= ' post-thumbnail--' . $suffix;

	return $css_model;
}

/**
 * Enqueue misc js script.
 *
 * @param  array $depends Default dependencies.
 * @return array
 */
function bryte_enqueue_misc( $depends ) {
	global $is_IE;

	if ( $is_IE ) {
		$depends[] = 'object-fit-images';
	}

	return $depends;
}

/**
 * Add to toTop and stickUp properties if required.
 *
 * @param  array $vars Default variables.
 *
 * @return array
 */
function bryte_js_vars( $vars ) {
	$header_menu_sticky = get_theme_mod( 'header_menu_sticky', bryte_theme()->customizer->get_default( 'header_menu_sticky' ) );

	if ( $header_menu_sticky && ! wp_is_mobile() ) {
		$vars['stickUp'] = true;
	}

	$totop_visibility = get_theme_mod( 'totop_visibility', bryte_theme()->customizer->get_default( 'totop_visibility' ) );

	if ( $totop_visibility ) {
		$vars['toTop'] = true;
	}

	return $vars;
}

/**
 * Add has/no thumbnail classes for posts
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function bryte_post_thumb_classes( $classes ) {
	$thumb = 'no-thumb';

	if ( has_post_thumbnail() ) {
		$thumb = 'has-thumb';
	}

	$classes[] = $thumb;

	return $classes;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Arguments for comment form.
 *
 * @return array
 */
function bryte_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = esc_html__( 'Submit Comment', 'bryte' );

	$args['fields']['author'] = '<p class="comment-form-author"><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . esc_html__( 'Your name', 'bryte' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your e-mail', 'bryte' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['url'] = '<p class="comment-form-url"><input id="url" class="comment-form__field" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . esc_html__( 'Your website', 'bryte' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . esc_html__( 'Your comment *', 'bryte' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<p id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</p>';

	$args['title_reply'] = esc_html__( 'Leave a reply', 'bryte' );

	return $args;
}

/**
 * Reorder comment fields
 *
 * @param  array $fields Comment fields.
 *
 * @return array
 */
function bryte_reorder_comment_fields( $fields ) {

	if ( is_singular( 'product' ) ) {
		return $fields;
	}

	$new_fields_order = array();
	$new_order        = array( 'author', 'email', 'url', 'comment' );

	foreach ( $new_order as $key ) {
		$new_fields_order[ $key ] = $fields[ $key ];
		unset( $fields[ $key ] );
	}

	return $new_fields_order;
}

/**
 * Add extra body classes
 *
 * @param  array $classes Existing classes.
 *
 * @return array
 */
function bryte_extra_body_classes( $classes ) {
	global $is_IE;

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of ie to browsers IE.
	if ( $is_IE ) {
		$classes[] = 'ie';
	}

	// Adds a options-based classes.
	$header_layout  = esc_attr( get_theme_mod( 'header_container_type', bryte_theme()->customizer->get_default( 'header_container_type' ) ) );
	$content_layout = esc_attr( get_theme_mod( 'content_container_type', bryte_theme()->customizer->get_default( 'content_container_type' ) ) );
	$footer_layout  = esc_attr( get_theme_mod( 'footer_container_type', bryte_theme()->customizer->get_default( 'footer_container_type' ) ) );
	$blog_layout    = esc_attr( get_theme_mod( 'blog_layout_type', bryte_theme()->customizer->get_default( 'blog_layout_type' ) ) );
	$sb_position    = esc_attr( get_theme_mod( 'sidebar_position', bryte_theme()->customizer->get_default( 'sidebar_position' ) ) );
	$sidebar        = esc_attr( get_theme_mod( 'sidebar_width', bryte_theme()->customizer->get_default( 'sidebar_width' ) ) );
	$single_type    = esc_attr( get_theme_mod( 'single_post_type', bryte_theme()->customizer->get_default( 'single_post_type' ) ) );
	$header_type    = esc_attr( get_theme_mod( 'header_layout_type', bryte_theme()->customizer->get_default( 'header_layout_type' ) ) );
	$footer_type    = esc_attr( get_theme_mod( 'footer_layout_type', bryte_theme()->customizer->get_default( 'footer_layout_type' ) ) );

	if ( is_singular( 'post' ) ) {
		$classes[] = 'single-post-' . sanitize_html_class( $single_type );;
	}

	return array_merge( $classes, array(
		'header-layout-' . $header_layout,
		'content-layout-' . $content_layout,
		'footer-layout-' . $footer_layout,
		'blog-' . $blog_layout,
		'position-' . $sb_position,
		'sidebar-' . str_replace( '/', '-', $sidebar ),
		'header-' . $header_type,
		'footer-' . $footer_type,
	) );
}

/**
 * Adds the meta viewport to the header.
 *
 * @since  1.0.1
 */
function bryte_meta_viewport() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />' . "\n";
}

/**
 * Customization for `Tag Cloud` widget.
 *
 * @since  1.0.1
 *
 * @param  array $args Widget arguments.
 *
 * @return array
 */
function bryte_customize_tag_cloud( $args ) {
	$args['smallest'] = 12;
	$args['largest']  = 12;
	$args['unit']     = 'px';

	return $args;
}

/**
 * Replaces `[...]` (appended to automatically generated excerpts) with `...`.
 *
 * @since  1.0.1
 *
 * @param  string $more The string shown within the more link.
 *
 * @return string
 */
function bryte_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip;';
}

/**
 * Creating wrappers for audio shortcode.
 */
function bryte_audio_shortcode( $html, $atts, $audio, $post_id, $library ) {

	$html = '<div class="mejs-container-wrapper">' . $html . '</div>';

	return $html;
}

/**
 * Set specific content classes for blog listing
 */
function bryte_set_specific_content_classes( $layout_classes ) {
	$sidebar_position = get_theme_mod( 'sidebar_position' );

	$white_list_post_type = array(
		'post',
		'team'
	);

	if ( ( 'fullwidth' === $sidebar_position && is_singular( $white_list_post_type ) ) ) {
		$layout_classes = array( 'col-xs-12', 'col-lg-8', 'col-lg-push-2' );
	}

	return $layout_classes;
}

/**
 * Change text for buddypress activity read more
 *
 * @return string
 */
function bryte_bp_activity_read_more_text( $read_more_text ) {
	return esc_html__( 'Read more', 'bryte' );
}

/**
 * Add template to cherry-team-members templates list.
 *
 * @param array $tmpl_list Templates list.
 *
 * @return array
 */
function bryte_add_template_to_cherry_team_templates_list( $tmpl_list ) {
	$tmpl_list['grid-boxes-2'] = 'grid-boxes-2.tmpl';

	return $tmpl_list;
}

/**
 * Customization sidebar width to woo page.
 */
function bryte_woo_sidebar_width( $value ) {

	if ( bryte_is_woocommerce_activated() && is_woocommerce() ) {
		return '1/4';
	}

	return $value;
}

/**
 * Disable sidebar to single woo product page and 404 page.
 */
function bryte_specific_sidebar_position( $value ) {

	if ( ( bryte_is_woocommerce_activated() && is_product() ) || is_404() ) {
		return 'fullwidth';
	}

	return $value;
}

/**
 * Enable top panel to woo product page.
 */
function bryte_woo_top_panel_visibility( $value ) {

	$header_layout = get_theme_mod( 'header_layout_type', bryte_theme()->customizer->get_default( 'header_layout_type' ) );

	if ( bryte_is_woocommerce_activated() && is_product() && in_array( $header_layout, array( 'default', 'style-5', 'style-6', 'style-7'  ) ) ) {
		return true;
	}

	return $value;
}

/**
 * Landing main menu location.
 */
function bryte_landing_main_menu_location( $args ) {

	if ( 'page-templates/landing.php' === get_page_template_slug() ) {
		$args['theme_location'] = 'main_landing';
	}
	return $args;
}

/**
 *  Add woo-elements option to page settings meta.
 */
function bryte_add_woo_elements_meta( $args ) {

	if ( bryte_is_woocommerce_activated() ) {
		$args['fields']['bryte_header_woo_elements'] = array(
			'type'          => 'select',
			'parent'        => 'header_elements_tab',
			'title'         => esc_html__( 'Woocommerce elements', 'bryte' ),
			'value'         => 'inherit',
			'display_input' => false,
			'options'       => array(
				'inherit' => esc_html__( 'Inherit', 'bryte' ),
				'true'    => esc_html__( 'Enable', 'bryte' ),
				'false'   => esc_html__( 'Disable', 'bryte' ),
			),
		);
	}

	return $args;
}

/**
 * Add images size filter
 */
function bryte_add_imeges_size_filter() {
	add_filter( 'tm_pg_get_sizes', 'bryte_images_sizes' );
}

/**
 * Images sizes.
 *
 * @param array $args The arguments.
 *
 * @return array
 */

function bryte_images_sizes( $args ) {
	$args['grid-default'] = array(
		'width'   => '558',
		'height'  => '374',
		'type'    => 'grid',
	);
	$args['masonry-default'] = array(
		'width'   => '558',
		'height'  => '0',
		'type'    => 'masonry',
	);
	return $args;
}
