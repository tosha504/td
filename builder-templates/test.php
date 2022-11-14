<div id="shopBanner" class="shop__banner" <?php if($background) echo 'style="background:' . $background . '"'; ?>>
            <div class="shop__banner_content">
                <?php 
                if($term->description) echo '<h2 class="btn">' . $term->description . '</h2>'; 
                if($term->name) echo '<h1>' . $term->name . '</h1>'; ?>
            </div>
            <div class="shop__banner_image">
                <?php $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                echo  wp_get_attachment_image( $thumbnail_id,  'full' ); ?>
            </div>
        </div>
        <div class="shop__products">
    <?php while ( $query->have_posts() ){ $query->the_post(); 
        $product = wc_get_product(get_the_ID()); ?>

        <div class="shop__products_product">
            <div class="shop__products_product-image">
                <?php echo $product->get_image(); ?>
            </div>
            <div class="shop__products_product-items">
                <h6><?php echo $product->get_name(); ?></h6>
                
            </div>		
            <div class="shop__products_product-buttons">
                <p><?php echo $product->get_price() . ' ' .  get_woocommerce_currency_symbol(); ?></p>
                <a href="<?php echo get_permalink();?>" class="btn btn__primary"><?php _e('See more', 'topdrive' ); ?></a>
            </div>
        </div>  

    <?php  
    }
    wp_reset_query();  } ?>
    </div>