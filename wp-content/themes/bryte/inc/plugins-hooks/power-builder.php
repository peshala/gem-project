<?php
/**
 * Power-builder hooks.
 *
 * @package Bryte
 */

// Add custom icons font to builder.
add_filter( 'tm_builder_custom_font_icons', 'bryte_builder_custom_font_icons' );

// Remove include builder grid css file.
add_filter( 'tm_builder_front_styles', 'bryte_builder_remove_include_grid_css' );

// Customization power-builder taxonomy module.
add_filter( 'tm_pb_module_taxonomy_title_settings', 'bryte_taxonomy_module_title_settings' );
add_filter( 'tm_pb_module_taxonomy_button_settings', 'bryte_taxonomy_module_button_settings' );
add_filter( 'tm_pb_module_taxonomy_template_count_max', 'bryte_taxonomy_module_template_count_max' );

// Customization power-builder carousel module.
add_filter( 'tm_pb_module_carousel_img_settings', 'bryte_module_carousel_img_settings' );
add_filter( 'tm_pb_module_carousel_title_settings', 'bryte_module_carousel_title_settings' );
add_filter( 'tm_pb_module_carousel_author_settings', 'bryte_module_carousel_author_settings' );
add_filter( 'tm_pb_module_carousel_more_button_settings', 'bryte_module_carousel_more_button_settings' );
add_filter( 'tm_pb_module_carousel_space', 'bryte_module_carousel_space' );

// Add custom modules to power builder.
add_action( 'tm_builder_load_user_modules', 'bryte_add_custom_modules_to_builder' );

/**
 * Add custom icon fonts to builder.
 */
function bryte_builder_custom_font_icons( $icons ) {
	$icons['nucleo-outline'] = array(
		'src'  => BRYTE_THEME_CSS . '/nucleo-outline.css',
		'base' => 'nc-icon-outline',
	);

	return $icons;
}

/**
 * Remove include builder grid css file
 */
function bryte_builder_remove_include_grid_css( $styles ) {
	unset( $styles['tm-builder-modules-grid'] );

	return $styles;
}

/**
 * Customization title settings to taxonomy module.
 *
 * @param array $title Title settings.
 *
 * @return array
 */
function bryte_taxonomy_module_title_settings( $title ) {
	$title['class'] = 'tm_pb_taxonomy__title';
	$title['html']  = '<h5 %1$s><a href="%2$s" %3$s>%4$s</a></h5>';

	return $title;
}

/**
 * Customization button settings to taxonomy module.
 *
 * @param array $button Button settings.
 *
 * @return array
 */
function bryte_taxonomy_module_button_settings( $button ) {
	$button['class'] = 'link';
	$button['icon']  = '<i class="lnc-icon-mini arrows-1_minimal-right"></i>';
	$button['html']  = '<span class="button--holder"><a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a></span>';

	return $button;
}

/**
 * Customization template count max to taxonomy module.
 *
 * @return int
 */
function bryte_taxonomy_module_template_count_max( $template_count_max ) {
	return 5;
}

/**
 * Customization image settings to carousel module.
 *
 * @param array $image Image settings.
 *
 * @return array
 */
function bryte_module_carousel_img_settings( $image ) {
	$image['mobile_size'] = 'bryte-thumb-m';

	return $image;
}

/**
 * Customization title settings to carousel module.
 *
 * @param array $post_title Title settings.
 *
 * @return array
 */
function bryte_module_carousel_title_settings( $post_title ) {

	$post_title['class'] = 'entry-title';
	$post_title['html']  = '<h5 %1$s><a href="%2$s" %3$s>%4$s</a></h5>';

	return $post_title;
}

/**
 * Customization author meta settings to carousel module.
 *
 * @param array $author Author meta settings.
 *
 * @return array
 */
function bryte_module_carousel_author_settings( $author ) {

	$author['prefix'] = esc_html__( 'by ', 'bryte' );

	return $author;
}

/**
 * Customization more button settings to carousel module.
 *
 * @param array $more_button More button settings.
 *
 * @return array
 */
function bryte_module_carousel_more_button_settings( $more_button ) {

	$more_button_settings = array(
		'class' => 'carousel__more-btn link',
		'icon'  => '<i class="lnc-icon-mini arrows-1_minimal-right"></i>',
		'html'  => '<a href="%1$s" %3$s><span class="link__text">%4$s</span>%5$s</a>',
	);

	$more_button = array_merge( $more_button, $more_button_settings );

	return $more_button;
}

/**
 * Customization space between slides to carousel module.
 *
 * @return int
 */
function bryte_module_carousel_space( $space_between_slides ) {
	return 50;
}

/**
 * Add custom modules to power builder.
 */
function bryte_add_custom_modules_to_builder( $modules_loader ) {

	$custom_modules = apply_filters( 'bryte_power_builder_theme_modules', array(
		'Bryte_Builder_Module_Icon' => get_parent_theme_file_path( 'builder/modules/class-builder-module-icon.php' ),
	) );

	foreach ( $custom_modules as $module_class => $module_path ) {

		include_once $module_path;
		$modules_loader->add_module( $module_class, $module_path );

	}
}
