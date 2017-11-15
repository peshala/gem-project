<?php
/**
 * Display Header Cart
 * @since  1.0.0
 * @uses  bryte_is_woocommerce_activated() check if WooCommerce is activated
 * @return void
 */

?>
<div class="site-header-cart menu navbar-header-cart menu">
	<div class="site-header-cart__wrapper">
		<?php bryte_cart_link(); ?>
		<div class="shopping_cart-dropdown-wrap products_in_cart_<?php echo WC()->cart->get_cart_contents_count(); ?>">
			<div class="shopping_cart-header">
				<h4><?php esc_html_e( 'My Cart', 'bryte' ) ?></h4>
			</div>
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		</div>
	</div>
</div>
