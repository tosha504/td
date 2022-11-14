<?php
/**
 * Location
 *
 * @package  topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; 


$location_titles = get_sub_field('titles');
$locations = get_sub_field('our_locations'); ?>
<!-- Location start -->
<section class="location">
    <div class="container">
        <div class="location__titles">
        <?php  if($location_titles) { 
            foreach ($location_titles as $key => $location_title) { ?>
                <div class="location__title">
                    <a href="<?php echo $location_title["link"]; ?>"><h2 class="title"><?php echo $location_title["title"]; ?></h2></a>
                </div>
            <?php } } ?>
        </div>
       
        <div class="location__wrap">
            <?php 
            foreach ($locations as $location) {
                $cart = $location["note"];
                // var_dump($cart['link']); ?>
                <div class="location__cart">
                    <div class="location__cart_image" <?php if($cart["img"]){ echo 'style="background: url(' . wp_get_attachment_image_url( $cart["img"], 'gallery-thumbnail-big') .'); background-repeat: no-repeat;  background-position: top; background-size: cover;"' ; }?>>
                    </div>
                    <div class="location__cart_content">
                        <div class="location__cart_content-town">
                            <?php if($cart["locatio"] ) { ?><p class="location__cart_content-city"><?php echo $cart["locatio"] ; ?></p><?php } ?>
                            <?php $socials = $cart["social_media"]; 
                            foreach ($socials as $key => $social) { ?>
                                <a class="socials" href="<?php echo esc_url($social['link']); ?>" target="_blank"><?php echo wp_get_attachment_image( $social["icon"], 'full')?></a>
                            <?php } ?>
                        </div>
                        <div class="location__cart_content-adress">
                            <?php if($cart["adress"]  ) { ?><p class="location__cart_content-street"><?php echo $cart["adress"] ; ?></p><?php } ?>
                            <?php 
                            foreach ($cart["phone"] as $key => $phone_number) {
                            $phone = $phone_number["phone_number"]; 
                            $phoneLink = preg_replace('/[^0-9]/', '', $phone);
                            if( $phoneLink ) { ?>
                                <a class="location__cart_content-phone" href="tel:+<?php echo $phoneLink; ?>"><?php echo  $phone; ?></a>
                            <?php } } ?>
                        </div>
                        <div class="location__cart_content-links">
                            <div class="location__cart_content-buttons">
                                <?php 
                                if ( !empty($cart['link']) ) {  
                                $link_url = $cart['link']['url'];
                                $link_title =  $cart['link']['title'];
                                $link_target =  $cart['link']['target'] ? $cart['link']['target'] : '_self'; ?>
                                    <a class="btn__primary" href="<?php echo esc_url( $link_url ); ?>" data-target="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php }  ?>
                            </div>
                            
                        </div>
                    </div>
                </div>



            <?php }
            ?>
        </div>
    </div>
</section>
<!-- Location end -->
