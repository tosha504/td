<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<a href="<?php echo get_permalink();?>">
	<div <?php wc_product_class( 'shop__products_product', $product );?>>
		<div class="shop__products_product-image">
			<?php echo $product->get_image(); ?>
		</div>
		<div class="shop__products_product-items">
			<h6><?php echo $product->get_name(); ?></h6>
		</div>		
		<div class="shop__products_product-buttons">
			<p><?php echo $product->get_price() . ' ' .  get_woocommerce_currency_symbol(); ?></p>
			<span class="btn btn__primary"><?php _e('See more', 'topdrive' ); ?></span>
		</div>      
	</div>
</a>