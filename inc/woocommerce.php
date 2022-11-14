<?php 
/**
 * Add WooCommerce support
 *
 * @package topdrive
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action('after_setup_theme', 'topdrive_add_woocommerce_support' );
if ( ! function_exists( 'topdrive_add_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function topdrive_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

function grd_woocommerce_script_cleaner() {
	
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-general');
		wp_dequeue_style( 'woocommerce_frontend_styles' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce_fancybox_styles' );
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_script( 'selectWoo' );

		wp_deregister_script( 'selectWoo' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );

}
add_action( 'wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99 );


add_action( 'init', function () {
    //Remove sidebar
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

    //Add container on single page product
    add_action( 'woocommerce_before_main_content', 'add_open_div_container', 10);
    function add_open_div_container() {
        echo '<div class="container">';
    }

    add_action( 'woocommerce_after_main_content', 'add_close_duv_container', 20);
    function add_close_duv_container() {
        echo '</div>';
    }
        
    // add_action( 'woocommerce_before_main_content', 'test', 20);
    // function test() {
    //     echo 'titj';
    // }
    //Remove breadcrumm 
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    // remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

    
    // Changes hook: woocommerce_single_product_summary.
    add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 0);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

    add_filter( 'woocommerce_get_breadcrumb', 'change_breadcrumb' );
    function change_breadcrumb( $crumbs ) {
        $shop =  __("Shop", 'topdrive');
        $site_url = get_site_url();
        $replacements = array(
            1 => array( 
                0 => $shop, 
                1 => $site_url. '/sklep/',
            )
        );

        $my_custom_crumbs = array_replace($crumbs, $replacements);
        return $my_custom_crumbs;
    }

    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

    // remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);

    add_action( 'woocommerce_before_quantity_input_field', function () {
        echo '<button class="cart-qty minus">-</button>';
    });

    add_action( 'woocommerce_after_quantity_input_field', function () {
        echo '<button class="cart-qty plus">+</button>';
    });
} );

//Hide taxonomy page
function wpse_modify_taxonomy($array ) {
//     echo '<pre>';
// var_dump($array) ; echo '</pre>';
    $array['public'] = false;
    $array['show_ui'] = true;
return $array;
}
// hook it up to 11 so that it overrides the original register_taxonomy function
add_filter( 'woocommerce_taxonomy_args_product_cat', 'wpse_modify_taxonomy' );

