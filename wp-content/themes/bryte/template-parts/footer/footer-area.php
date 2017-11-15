<?php
/**
 * The template for displaying footer widget area.
 *
 * @package Bryte
 */
// Check footer-area visibility.
if ( ! get_theme_mod( 'footer_widget_area_visibility', bryte_theme()->customizer->get_default( 'footer_widget_area_visibility' ) ) || ! is_active_sidebar( 'footer-area' ) ) {
	return;
} ?>

<div class="footer-area-wrap <?php echo bryte_get_invert_class_customize_option( 'footer_widgets_bg' ); ?> ">
	<div <?php echo bryte_get_container_classes( ['footer-container_wrap'], 'footer' ); ?>>
		<?php do_action( 'bryte_render_widget_area', 'footer-area' ); ?>
	</div>
</div>
