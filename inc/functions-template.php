<?php
/**
 * Custom functions
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function builder_template() {
    if ( class_exists( 'ACF' ) && have_rows( 'builder' ) ) {
        if ( have_rows( 'builder' ) ) { while ( have_rows( 'builder' ) ) 
            { the_row();		
                if( get_row_layout() == 'banner'){
                    get_template_part('builder-templates/banner');
                } else if( get_row_layout() == 'location'){
                    get_template_part('builder-templates/location');
                } else if( get_row_layout() == 'application'){
                    get_template_part('builder-templates/application');
                } else if( get_row_layout() == 'order'){
                    get_template_part('builder-templates/order');
                } else if( get_row_layout() == 'prod'){
                    get_template_part('builder-templates/prod');
                } else if( get_row_layout() == 'payment'){
                    get_template_part('builder-templates/payment');
                } else if( get_row_layout() == 'sale'){
                    get_template_part('builder-templates/sale');
                }
            }	
        }
    }
}


function btn_create($button) {
// var_dump($button);
$btn = $button['link'];
$color = $button['style'];
$link_url = $btn['url'];
$link_title = $btn['title'];
$link_target = $btn['target'] ? $btn['target'] : '_self'; ?>
    <a class="btn <?php echo $color?>" href="<?php echo esc_url( $link_url ); ?>" data-target="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
<?php }


function createShopBannerAndProductstemplate($props) { 
    $query = new WP_Query( array( 
        'post_type'         => 'product', 
        'posts_per_page'    => -1,
        'order'             => 'ASC',
        'tax_query'         =>
            array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'slug',
                    'terms'     => $props ,
                )
            ))
        ); 
        $term = get_term($query->get_queried_object_id()); 
        $background = get_field('bg', 'product_cat_' . $term->term_id); 
        $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
    if($thumbnail_id) { ?>
        <div class="shop__banner" <?php if($background) echo 'style="background:' . $background . '"'; ?>>
            <div class="shop__banner_content">
                <?php 
                    if($term->description) echo '<h2>' . $term->description . '</h2>'; 
                    if($term->name) echo '<h1>' . $term->name . '</h1>'; 
                ?>
            </div>
            <div class="shop__banner_image">
                <?php echo  wp_get_attachment_image( $thumbnail_id,  'full' ); ?>
            </div>
        </div>
    <?php } ?>
    
    <div class="shop__products">
        <?php 
        while ( $query->have_posts() ) { $query->the_post();
        $product = wc_get_product(get_the_ID()); 
        ?>  
            <a href="<?php echo get_permalink(); ?>">
                <div class="shop__products_product"> 
                
                    <div class="shop__products_product-image">
                        <?php echo $product->get_image(); ?>
                    </div>
                    <div class="shop__products_product-items">
                        <h6><?php echo $product->get_name(); ?></h6>
                    </div>		
                    <div class="shop__products_product-buttons">
                        <p><?php echo $product->get_price() . ' ' .  get_woocommerce_currency_symbol(); ?></p>
                        <span class="btn"><?php _e('See more', 'topdrive' ); ?></span>
                    </div>
               	
                </div>    
            </a>
        <?php }
        wp_reset_query(); ?>
    </div>
        
<?php
}


function get_products_ajax() {
    if(isset( $_POST['cat_id']) && !empty( $_POST['cat_id'])) {
        $cat_id = sanitize_text_field( $_POST['cat_id']);
        echo createShopBannerAndProductstemplate($cat_id);
    }
}

