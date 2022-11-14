<?php
/**
 * Application
 *
 * @package  topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 


$app_left = get_sub_field('left');
$app_right = get_sub_field('right'); 
$app_img = get_sub_field('img'); ?>
<!-- App start -->
<section class="app">
    <div class="app__left" <?php if($app_left){ echo 'style="background: url(' . wp_get_attachment_image_url( $app_left, 'full') .'); background-repeat: no-repeat;  background-position: right; background-size: cover;"' ; }?>>
    </div>
    <?php if($app_img) echo wp_get_attachment_image($app_img, 'large'); ?>
    <div class="app__right">
        <div class="app__content">
            <?php if($app_right['title']) { ?><h3 class="app__content-title"><?php echo $app_right['title']; ?></h3><?php } ?>
            <?php if($app_right["application_link"]) { ?>
                <div class="app__content-wrap">
                    <?php foreach ($app_right["application_link"] as $key => $app_link) { ?>
                        <a href="<?php echo $app_link['link']  ?>" target="_blank"><?php echo wp_get_attachment_image($app_link['image'], 'full'); ?></a>
                    <?php } }?>
                </div>
            <?php if($app_right['description']) { ?><p class="app__content-description"><?php echo $app_right['description']; ?></p><?php } ?>  
        </div>
    </div>
</section><!-- App end -->