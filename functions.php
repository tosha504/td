<?php
/**
 * topdrive functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package topdrive
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function topdrive_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on topdrive, use a find and replace
		* to change 'topdrive' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'topdrive', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-left' => esc_html__( 'Menu lewo', 'topdrive' ),
			'menu-right' => esc_html__( 'Menu prawo', 'topdrive' ),
			'menu-mob' => esc_html__( 'Menu telefon', 'topdrive' ),
			'cart' => esc_html__( 'Koszyk', 'topdrive' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'topdrive_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'topdrive_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function topdrive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'topdrive_content_width', 640 );
}
add_action( 'after_setup_theme', 'topdrive_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function topdrive_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'topdrive' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'topdrive' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'topdrive_widgets_init' );

/**
 * Disable Gutenberg
 */
// add_filter('use_block_editor_for_post', '__return_false');

// Theme includes directory.
$topdrive_inc_dir = 'inc';

// Array of files to include.
$topdrive_includes = array(
	'/functions-template.php',  // 	Theme custom functions
	'/enqueue.php',				//	Enqueue scripts and styles.
	'/custom-header.php',		//	Implement the Custom Header feature.
	'/customizer.php',			//	Customizer additions.
	'/template-tags.php',		// 	Custom template tags for this theme.	
	'/template-functions.php',	//	Functions which enhance the theme by hooking into WordPress.

);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$topdrive_includes[] = '/woocommerce.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Include files.
foreach ( $topdrive_includes as $file ) {
	require_once get_theme_file_path( $topdrive_inc_dir . $file );
}

/**
 * Make ACF Options
 */
if (function_exists('acf_add_options_page')) {
$option_page = acf_add_options_page([
	'page_title' => 'General settings',
	'menu_title' => 'General settings',
	'menu_slug' => 'theme-general-settings',
	'post_id' => 'options',
	'capability' => 'edit_posts',
	'redirect' => false
]);
}

//svg
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml'; 
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
  
define('ALLOW_UNFILTERED_UPLOADS', true); 
  
function fix_svg_thumb_display() {
	echo  
	'<style>
		td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
			width: 100% !important; 
			height: auto !important; 
		}
	</style>';
}
add_action('admin_head', 'fix_svg_thumb_display');

// custom size images
function add_image_size_new( $name, $width = 0, $height = 0, $crop = false ) {
    global $_wp_additional_image_sizes;

    $_wp_additional_image_sizes[ $name ] = array(
        'width'  => absint( $width ),
        'height' => absint( $height ),
        'crop'   => $crop,
    );
}
add_image_size_new( 'gallery-thumbnail', 600, 400, true );
add_image_size_new( 'gallery-thumbnail-big', 1000, 600, true );
