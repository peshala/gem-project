<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Bryte
 */

$footer_contact_block_visibility = get_theme_mod( 'footer_contact_block_visibility', bryte_theme()->customizer->get_default( 'footer_contact_block_visibility' ) );
?>

<div class="footer-container <?php echo bryte_get_invert_class_customize_option( 'footer_bg' ); ?>">
	<div <?php echo bryte_get_container_classes( ['footer-container_wrap'], 'footer' ); ?>>
		<div class="site-info">
			<div class="site-info-wrap">
				<?php bryte_footer_logo(); ?>
				<?php bryte_footer_menu(); ?>

				<?php if ( $footer_contact_block_visibility ) : ?>
				<div class="site-info__bottom">
				<?php endif; ?>
					<?php bryte_footer_copyright(); ?>
					<?php bryte_contact_block( 'footer' ); ?>
				<?php if ( $footer_contact_block_visibility ) : ?>
				</div>
				<?php endif; ?>

				<?php bryte_social_list( 'footer' ); ?>
			</div>

		</div><!-- .site-info -->
	</div>
</div><!-- .container -->
