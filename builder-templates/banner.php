<?php
/**
 * Banner
 *
 * @package  topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 


$banner_items = get_sub_field('banner'); ?>
<!-- Banner start -->
<section class="Banner">
    <?php if($banner_items) {
    foreach ($banner_items as $key => $banner) { ?>
        <div class="banner" <?php if( $banner['bg_image']){ echo 'style="background: url(' . wp_get_attachment_image_url( $banner['bg_image'], 'full') .'); background-repeat: no-repeat;  background-position: center; background-size: cover;"' ; }?>>
            <div class="container">
                <div class="banner__content">
                    <?php if($banner['title']) { ?><h1 class="banner__title"><?php echo $banner['title']; ?></h1><?php } ?>
                </div>
                <div class="banner__img-phone">
                    <?php echo wp_get_attachment_image( $banner["image_phone"], 'gallery-thumbnail-big') ?>
                </div>
            </div>
        </div>
    <?php  } }?>
</section>
<!-- Banner end -->