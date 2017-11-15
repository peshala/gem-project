<?php
/**
 * Template part for top panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bryte
 */

// Don't show top panel if all elements are disabled.
if ( ! bryte_is_top_panel_visible() ) {
	return;
}
?>

<div class="top-panel <?php echo bryte_get_invert_class_customize_option( 'top_panel_bg' ); ?>">
	<div <?php echo bryte_get_container_classes( ['top-container_wrap'], 'header' ); ?>>
		<div class="top-panel__container">
			<?php bryte_top_message( '<div class="top-panel__message">%s</div>' ); ?>
			<?php bryte_contact_block( 'header' ); ?>
			<div class="top-panel__wrap-items">
				<div class="top-panel__menus">
					<?php bryte_top_menu(); ?>
					<?php bryte_social_list( 'header' ); ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- .top-panel -->
