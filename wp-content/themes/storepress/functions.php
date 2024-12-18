<?php
if ( ! function_exists( 'storepress_setup' ) ) :
function storepress_setup() {

// Site path/URI.
define( 'STOREPRESS_PARENT_DIR', get_template_directory() );
define( 'STOREPRESS_PARENT_URI', get_template_directory_uri() );

// Site path/URI.
define( 'STOREPRESS_PARENT_INC_DIR', STOREPRESS_PARENT_DIR . '/inc');
define( 'STOREPRESS_PARENT_INC_URI', STOREPRESS_PARENT_URI . '/inc');

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	
	//Add selective refresh for widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'storepress' );
		
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'storepress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	
	add_theme_support('custom-logo');

	/*
	 * WooCommerce Support
	 */
	add_theme_support( 'woocommerce' );
	
	// Gutenberg wide.
	add_theme_support( 'align-wide' );
	
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'assets/css/editor-style.css', storepress_google_font() ) );
	
	//Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'storepress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'storepress_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function storepress_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'storepress' ),
		'id' => 'storepress-sidebar-primary',
		'description'   => esc_html__( 'The Primary Widget Area', 'storepress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', 'storepress' ),
		'id' => 'storepress-footer-1',
		'description'  => esc_html__( 'Footer Widget 1', 'storepress' ),
		'before_widget'=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title'  => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', 'storepress' ),
		'id' => 'storepress-footer-2',
		'description'   => esc_html__( 'Footer Widget 2', 'storepress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', 'storepress' ),
		'id' => 'storepress-footer-3',
		'description'   => esc_html__( 'Footer Widget 3', 'storepress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name' => __( 'WooCommerce Widget Area', 'storepress' ),
		'id' => 'storepress-woocommerce-sidebar',
		'description'   => esc_html__( 'This Widget area for WooCommerce Widget', 'storepress' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'storepress_widgets_init' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function storepress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'storepress_content_width', 1170 );
}
add_action( 'after_setup_theme', 'storepress_content_width', 0 );


/**
 * Default Nav Walker.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * All Css & Js Files.
 */
require_once get_template_directory() . '/inc/enqueue.php';


/**
 * StorePress Features Style
 */
require_once get_template_directory() . '/inc/dynamic_style.php';

/**
 * Customizer Control & Features.
 */
 require_once get_template_directory() . '/inc/storepress-customizer.php';
 require_once get_template_directory() . '/inc/customizer/customizer-repeater/functions.php';
 require_once get_template_directory() . '/template-parts/sections/section-blog.php';

/**
 * Custom functions for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/theme-functions.php';