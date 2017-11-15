<?php
/**
 * Template part for default header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bryte
 */
?>
<div <?php echo bryte_get_container_classes( ['header-container_wrap'], 'header' ); ?>>
	<div class="header-container__flex">
		<div class="site-branding">
			<?php bryte_header_logo() ?>
			<?php bryte_site_description(); ?>
		</div>

		<div class="header-nav-wrapper">
			<?php bryte_main_menu(); ?>

			<div class="header-components">
				<?php bryte_header_search_toggle(); ?>
				<?php do_action( 'bryte_header_woo_cart' ) ?>
			</div>
		</div>
	</div>
	<?php bryte_header_search( '<div class="header-search">%s<span class="search-form__close"></span></div>' ); ?>
</div>
