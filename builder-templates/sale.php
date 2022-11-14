<?php
/**
 * Sale
 *
 * @package  topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 

$sale_title = get_sub_field('title');
$images = get_sub_field('images'); ?>
<!-- Sale start -->
<section id="sale" class="sale">
    <div class="container">
        <?php if($sale_title) {?><h3 class="sale__title title"><?php echo $sale_title; ?></h3><?php } ?>
        <div class="sale__slider">
            <?php 
            if($images) {
            foreach ($images as $key => $value) { ?>
                <div class="sale__slide">
                    <?php echo wp_get_attachment_image( $value['image'], 'full'); ?>
                </div>
            <?php } } ?>
        </div>
    </div>
</section><!-- Sale end -->