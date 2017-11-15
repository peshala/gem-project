<?php
/**
 * The template for displaying the style-2 footer layout.
 *
 * @package Bryte
 */

?>
<div class="footer-container <?php echo bryte_get_invert_class_customize_option( 'footer_bg' ); ?>">
	<div class="site-info container">
		<?php
			bryte_footer_logo();
			bryte_footer_menu();
			bryte_contact_block( 'footer' );
			bryte_social_list( 'footer' );
			bryte_footer_copyright();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->
