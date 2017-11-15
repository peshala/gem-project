<?php
/**
 * Template part for style-7 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bryte
 */

$vertical_menu_slide = ( ! is_rtl() ) ? 'right' : 'left';
?>
<div <?php echo bryte_get_container_classes( ['header-container_wrap'], 'header' ); ?>>
	<?php bryte_vertical_main_menu( $vertical_menu_slide ); ?>
	<div class="row row-md-center">
		<div class="col-xs-12 col-sm-3">
			<?php bryte_vertical_menu_toggle( 'main-menu' ); ?>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="site-branding">
				<?php bryte_header_logo() ?>
				<?php bryte_site_description(); ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-3">
			<div class="header-components">
				<?php bryte_header_search_toggle(); ?>
				<?php do_action( 'bryte_header_woo_cart' ) ?>
			</div>
		</div>
	</div>
	<?php bryte_header_search( '<div class="header-search">%s<span class="search-form__close"></span></div>' ); ?>
</div>
