<?php
/**
 * Theme enqueue scripts and styles.
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if( ! function_exists('topdrive_scripts')){
    function topdrive_scripts() {
        $theme_uri = get_template_directory_uri();
        // include custom jQuery
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true);
        
        // Custom JS
        wp_enqueue_script('topdrive_functions', $theme_uri . '/src/index.js', array(), time(), true);
        wp_localize_script('topdrive_functions', 'localizedObject', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax_nonce'),
        ]);
        //Slick	slider 
        wp_enqueue_script('slick_theme_functions', $theme_uri . '/libery/slick.min.js', array(), false, true);

        // Custom css
        wp_enqueue_style('topdrive_style', $theme_uri . '/src/index.css', array(), time());

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

    }
}
add_action( 'wp_enqueue_scripts', 'topdrive_scripts', 11 );

/**
 * AJAX
 */

add_action( 'wp_ajax_get_product_cat', 'get_product_cat' );
add_action( 'wp_ajax_nopriv_get_product_cat', 'get_product_cat' );

function get_product_cat() {
    if(isset( $_POST['cat_id']) && !empty( $_POST['cat_id'])) {
        $cat_id = sanitize_text_field( $_POST['cat_id']);
        createShopBannerAndProductstemplate($cat_id);
    }
    die();
}