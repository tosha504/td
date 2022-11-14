<?php
/**
 * Payment
 *
 * @package  topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 

$payment_left = get_sub_field('left');
$payment_right = get_sub_field('right');
$bg_image_left = $payment_left['bg_image'];
$bg_image_right = $payment_right['bg_image'];
// var_dump($payment_left);?>

<!-- Payment start -->
<section class="payment">
    <div class="payment__left" <?php if($bg_image_left){ echo 'style="background: url(' . wp_get_attachment_image_url( $bg_image_left, 'full') .'); background-repeat: no-repeat;  background-position: center; background-size: cover;"' ; }?>>
        <div class="payment__left_content">
            <?php if($payment_left['icon']) { ?><?php echo wp_get_attachment_image( $payment_left['icon'], 'full') ?><?php } ?>
            <?php if($payment_left['descr']) { ?><h3 class="payment__left-title"><?php echo $payment_left['descr']; ?></h3><?php } ?>
            <?php if($payment_left["methods"]) { ?>
                <div class="payment__left_methods">
                <?php foreach ($payment_left["methods"] as $key => $method) {
                    echo wp_get_attachment_image( $method['method'], 'thumbnail');
                }?></div>
            <?php } ?>
        </div>    
    </div>
    <div class="payment__right" <?php if($bg_image_right){ echo 'style="background: url(' . wp_get_attachment_image_url( $bg_image_right, 'full') .'); background-repeat: no-repeat;  background-position: center; background-size: cover;"' ; }?>>
    </div>
</section>
<!-- Payment end -->