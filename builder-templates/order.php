<?php
/**
 * Order
 *
 * @package  topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 

$order_left = get_sub_field('left');
$order_right = get_sub_field('right'); ?>
<!-- Order start -->
<section class="order">
    <div class="order__left">
        <?php if($order_left['title']) { ?><h3 class="order__left-title"><?php echo $order_left['title']; ?></h3><?php } ?>
        <div class="order__left_phones">
            <?php foreach ($order_left['phones'] as $key => $phone_number) {
                $phone = $phone_number['number']; 
                $phoneLink = preg_replace('/[^0-9]/', '', $phone);
                if( $phoneLink ) { ?>
                    <a class="btn__primary" href="tel:+<?php echo $phoneLink; ?>"><?php echo  $phone; ?></a>
            <?php } } ?>
        </div>
        <?php if($order_left["orders"]  ) { ?><p class="order__left_orders"><?php echo $order_left["orders"] ; ?></p><?php } ?>
    </div>
    <div class="order__right" <?php if($order_right){ echo 'style="background: url(' . wp_get_attachment_image_url( $order_right, 'full') .'); background-repeat: no-repeat;  background-position: center top; background-size: cover;"' ; }?>>

    </div>
</section>
<!-- Order end -->
