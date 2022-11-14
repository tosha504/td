<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;


$image_banner = get_field('banner_image', 'options');
$title_banner = get_field('banner_title', 'options');
get_header( 'shop' ); ?>

<main id="primary" class="site-main">
	<?php if( $image_banner) { ?> 
		<div class="shop__main-banner" <?php  echo 'style="background-image: url(' . wp_get_attachment_image_url( $image_banner, 'full') .');"' ; ?>>
			<div class="container">
				<?php echo '<h1>' . $title_banner . '</h1>';?>
			</div>	
		</div>
	<?php }	?>	
	
	<div class="container">	
		<?php
		$my_categories = get_categories('taxonomy=product_cat&type=product'); 
		if(!empty($my_categories)) { ?> 
			<div class="shop__items"> 
				<?php 
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => 1,
				);
				$loop = new WP_Query( $args ); ?>
				<?php while ( $loop->have_posts() ) { $loop->the_post(); ?>
					<div class="shop__items_wrap">
						<?php foreach ($my_categories as $key => $mas) { ?>
							<a class="btn btn__recommended" href="#" data-cat="<?php echo $mas->slug; ?>">
								<?php echo esc_attr($mas->name); ?>
							</a>
						<?php } ?>
					</div>
					<?php 
					$index = array_key_first($my_categories); ?>
				<?php } ?>
				<?php wp_reset_query(); ?>
			</div>
			
			<div id="shopProducts" >
				<?php echo createShopBannerAndProductstemplate($my_categories[$index]->name); ?>
			</div>
		<?php } ?>
	</div>

	<!-- Order start -->
	<?php 

	if ( is_shop() ){
		$page_id = get_option( 'woocommerce_shop_page_id' ); 
	}
	else {
		$page_id = get_the_ID();
	}

	$id_current_post = FoodStore::$currentLocation;
	$phone = get_field('phone', $id_current_post); 
	$orders = get_field('orders', $id_current_post);
	$order_page_shop = get_field('order_page_shop', $page_id);
	$title = $order_page_shop['title'];

	$right = $order_page_shop['right'];	?>
	<section class="order">
		<div class="order__left">
			<?php if($title) { ?><h3 class="order__left-title"><?php echo $title; ?></h3><?php } ?>
			<div class="order__left_phones">
				<?php if( $phone ) { 
					$phoneLink = preg_replace('/[^0-9]/', '', $phone);
					?>
						<a class="btn__primary" href="tel:+<?php echo $phoneLink; ?>"><?php echo  $phone; ?></a>
				<?php }  ?>
			</div>
			<?php if($orders) { ?><p class="order__left_orders"><?php echo $orders; ?></p><?php } ?>
		</div>
		<?php  if($right) { ?>
		<div class="order__right" <?php echo 'style="background: url(' . wp_get_attachment_image_url( $right, 'full') .'); background-repeat: no-repeat;  background-position: center top; background-size: cover;"' ; ?>>
		</div>
		<?php } ?>
	</section>
	<!-- Order end -->
</main><!-- #main -->


<?php get_footer( 'shop' );
