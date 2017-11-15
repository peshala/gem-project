<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo wp_kses_post( $product->get_image() ); ?>
	</a>
	<div class="product_widget_content">
		<?php
		global $product;
		if ( ! wc_get_product_category_list($product->get_id()) ) {
			echo '<ul class="product-widget-categories">&nbsp;</ul>';
		}
		echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="product-widget-categories">', '</div>' );
		?>
		<h6 class="product-title"><a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo wp_kses_post( $product->get_title() ); ?></a></h6>
		<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
		<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
	</div>
</li>
