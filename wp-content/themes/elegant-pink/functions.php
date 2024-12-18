<?php
/**
 * Elegant Pink functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elegant_Pink
 */

$elegant_pink_theme_data = wp_get_theme();
if( ! defined( 'ELEGANT_PINK_THEME_VERSION' ) ) define( 'ELEGANT_PINK_THEME_VERSION', $elegant_pink_theme_data->get( 'Version' ) );
if( ! defined( 'ELEGANT_PINK_THEME_NAME' ) ) define( 'ELEGANT_PINK_THEME_NAME', $elegant_pink_theme_data->get( 'Name' ) );
if( ! defined( 'ELEGANT_PINK_THEME_TEXTDOMAIN' ) ) define( 'ELEGANT_PINK_THEME_TEXTDOMAIN', $elegant_pink_theme_data->get( 'TextDomain' ) );

if ( ! function_exists( 'elegant_pink_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function elegant_pink_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Elegant Pink, use a find and replace
	 * to change 'elegant-pink' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'elegant-pink', get_template_directory() . '/languages' );
    
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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'elegant-pink' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	/* Set up the WordPress core custom background feature. */
	add_theme_support( 'custom-background', apply_filters( 'elegant_pink_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    /* Custom Image Sizes */
    add_image_size( 'elegant-pink-post-thumb', 80, 66, true);
    add_image_size( 'elegant-pink-slider', 1800, 696, true);
    add_image_size( 'elegant-pink-image', 780, 500, true);
    add_image_size( 'elegant-pink-image-full', 1180, 500, true);
    add_image_size( 'elegant-pink-featured-image', 280, 250, true);
    add_image_size( 'elegant-pink-3col-image', 380, 228, true);
    
    /* Custom Logo */
    add_theme_support( 'custom-logo', array(
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
	/* WooCommerce Support */
    add_theme_support( 'woocommerce' );

}
endif;
add_action( 'after_setup_theme', 'elegant_pink_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elegant_pink_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'elegant_pink_content_width', 780 );
}
add_action( 'after_setup_theme', 'elegant_pink_content_width', 0 );

/**
* Adjust content_width value according to template.
*
* @return void
*/
function elegant_pink_template_redirect_content_width() {

	// Full Width in the absence of sidebar.
	if( is_page() ){
	   $sidebar_layout = elegant_pink_sidebar_layout();
       if( ( $sidebar_layout == 'no-sidebar' ) || ! ( is_active_sidebar( 'right-sidebar' ) ) ) $GLOBALS['content_width'] = 1180;
        
	}elseif ( ! ( is_active_sidebar( 'right-sidebar' ) ) ) {
		$GLOBALS['content_width'] = 1180;
	}

}
add_action( 'template_redirect', 'elegant_pink_template_redirect_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elegant_pink_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'elegant-pink' ),
		'id'            => 'right-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'elegant-pink' ),
		'id'            => 'footer-one',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'elegant-pink' ),
		'id'            => 'footer-two',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'elegant-pink' ),
		'id'            => 'footer-three',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'elegant_pink_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function elegant_pink_scripts() {
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
      
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css' );
    if( get_theme_mod( 'ed_localgoogle_fonts',false ) && ! is_customize_preview() && ! is_admin() ){
        if ( get_theme_mod( 'ed_preload_local_fonts',false ) ) {
			elegant_pink_load_preload_local_fonts( elegant_pink_get_webfont_url( elegant_pink_fonts_url() ) );
        }
        wp_enqueue_style( 'elegant-pinlk-google-fonts', elegant_pink_get_webfont_url( elegant_pink_fonts_url() ) );
    }else{
        wp_enqueue_style( 'elegant-pink-google-fonts', elegant_pink_fonts_url() );
    }
    
    wp_enqueue_style( 'elegant-pink-style', get_stylesheet_uri(), '', ELEGANT_PINK_THEME_VERSION );
    
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js' . $build . '/all' . $suffix . '.js', array( 'jquery' ), '6.1.1', true );

    wp_enqueue_script( 'v4-shims', get_template_directory_uri() . '/js' . $build . '/v4-shims' . $suffix . '.js', array( 'jquery' ), '6.1.1', false );
    
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array('jquery'), '1.1.5', true );
    wp_enqueue_script( 'owlcarousel2-a11ylayer', get_template_directory_uri() . '/js' . $build . '/owlcarousel2-a11ylayer' . $suffix . '.js', array('owl-carousel'), '0.2.1', true );
    wp_enqueue_script( 'elegant-pink-modal-accessibility', get_template_directory_uri() . '/js' . $build . '/modal-accessibility' . $suffix . '.js', array( 'jquery' ), ELEGANT_PINK_THEME_VERSION, true );  
    wp_register_script( 'elegant-pink-custom-js', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array('jquery', 'masonry'), ELEGANT_PINK_THEME_VERSION, true );
	wp_register_script( 'elegant-pink-ajax', get_template_directory_uri() . '/js' . $build . '/ajax' . $suffix . '.js', array('jquery'), ELEGANT_PINK_THEME_VERSION, true );
    
    $elegant_pink_slider_auto = get_theme_mod( 'elegant_pink_slider_auto', '1' );
    $elegant_pink_slider_loop = get_theme_mod( 'elegant_pink_slider_loop', '1' );
    $elegant_pink_slider_control = get_theme_mod( 'elegant_pink_slider_control', '1' );
    $elegant_pink_slider_transition = get_theme_mod( 'elegant_pink_slider_transition', 'fade' );
    $elegant_pink_slider_speed = get_theme_mod( 'elegant_pink_slider_speed', '400' );
    $elegant_pink_slider_pause = get_theme_mod( 'elegant_pink_slider_pause', '6000' );
    
    $elegant_pink_translation_array = array(
		'auto'  	=> esc_attr($elegant_pink_slider_auto),
		'loop' 		=> esc_attr($elegant_pink_slider_loop),
        'option' 	=> esc_attr($elegant_pink_slider_control),
        'mode' 		=> esc_attr($elegant_pink_slider_transition),
        'speed' 	=> absint($elegant_pink_slider_speed),
		'pause'  	=> absint($elegant_pink_slider_pause),
        'rtl'       => is_rtl(),
        'ajax_url' 	=> admin_url( 'admin-ajax.php' ),
        'elegant_pink_nonce' => wp_create_nonce( 'elegant_pink_nonce' )
		);
    wp_localize_script( 'elegant-pink-custom-js', 'elegant_pink_data', $elegant_pink_translation_array );
    wp_enqueue_script( 'elegant-pink-custom-js' );
    
    $pagination = get_theme_mod( 'elegant_pink_pagination_type', 'default' );
    
    if( $pagination == 'load_more' ){
        
        // Add parameters for the JS
        
        if( is_page_template( 'template-home.php' ) || ( is_front_page() && ! is_home() ) ){
            $paged = ( get_query_var( 'page' ) > 1 ) ? get_query_var( 'page' ) : 1;
            $blog_qry = new WP_Query( array( 'post_type'=>'post', 'paged'=>$paged ) );
            $max = $blog_qry->max_num_pages;
            wp_reset_postdata();
        }else{
            global $wp_query;
            $max = $wp_query->max_num_pages;
            $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        }
        
        wp_enqueue_script( 'elegant-pink-ajax' );
        
        wp_localize_script( 
            'elegant-pink-ajax', 
            'elegant_pink_ajax',
            array(
                'startPage'     => $paged,
                'maxPages'      => $max,
                'nextLink'      => next_posts( $max, false ),
                'autoLoad'      => $pagination,
                'loadmore'      => __( 'Load More Posts', 'elegant-pink' ),
                'loading'       => __('Loading...', 'elegant-pink'),
                'nomore'        => __( 'No more posts.', 'elegant-pink' ),
                'plugin_url'    => plugins_url()
             )
        );
        
        if ( is_jetpack_activated( true ) ) {
            wp_enqueue_style( 'tiled-gallery', plugins_url() . '/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.css' );            
        }
    }
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elegant_pink_scripts' );

if( ! function_exists( 'elegant_pink_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function elegant_pink_admin_scripts(){
    wp_enqueue_style( 'elegant-pink-admin', get_template_directory_uri() . '/inc/css/admin.css', '', ELEGANT_PINK_THEME_VERSION );
}
endif; 
add_action( 'admin_enqueue_scripts', 'elegant_pink_admin_scripts' );

if( ! function_exists( 'elegant_pink_block_editor_styles' ) ) :
    /**
     * Enqueue editor styles for Gutenberg
     */
    function elegant_pink_block_editor_styles() {
    
    // Block styles.
    wp_enqueue_style( 'elegant-pink-block-editor-style', get_template_directory_uri() . '/css/build/editor-block.css' );

    // Add custom fonts.
    wp_enqueue_style( 'elegant-pink-google-fonts', elegant_pink_fonts_url(), array(), null );

}
endif;
add_action( 'enqueue_block_editor_assets', 'elegant_pink_block_editor_styles' );

if( ! function_exists( 'elegant_pink_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function elegant_pink_admin_notice(){
    global $pagenow;
    $theme_args     = wp_get_theme();
    $meta           = get_option( 'elegant_pink_admin_notice' );
    $name           = $theme_args->__get( 'Name' );
    $current_screen = get_current_screen();
    $dismissnonce   = wp_create_nonce( 'elegant_pink_admin_notice' );

    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'elegant-pink' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'elegant-pink' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=elegant-pink-dashboard' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the dashboard.', 'elegant-pink' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?elegant_pink_admin_notice=1&_wpnonce=<?php echo esc_attr( $dismissnonce ); ?>"><?php esc_html_e( 'Dismiss', 'elegant-pink' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'elegant_pink_admin_notice' );

if( ! function_exists( 'elegant_pink_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function elegant_pink_update_admin_notice(){
    if (!current_user_can('manage_options')) {
        return;
    }

    // Bail if the nonce doesn't check out
    if ( isset( $_GET['elegant_pink_admin_notice'] ) && $_GET['elegant_pink_admin_notice'] = '1' && wp_verify_nonce( $_GET['_wpnonce'], 'elegant_pink_admin_notice' ) ) {
        update_option( 'elegant_pink_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'elegant_pink_update_admin_notice' );

/**
 * Function to exclude posts in blog index page
 */
function elegant_pink_exclude_posts_for_homepage( $query ) {
	$show_on_front   = get_option( 'show_on_front' );
	$ed_slider       = get_theme_mod( 'elegant_pink_ed_slider', '' );
	$slider_type     = get_theme_mod( 'elegant_pink_slider_type', 'category' );
	$slider_category = get_theme_mod( 'elegant_pink_slider_cat', '' );
	$slider_post1    = get_theme_mod( 'elegant_pink_slider_post1' );
	$slider_post2    = get_theme_mod( 'elegant_pink_slider_post2' );
	$slider_post3    = get_theme_mod( 'elegant_pink_slider_post3' );

    if ( ! is_admin() && $query->is_home() && $query->is_main_query() && $ed_slider && 'posts' == $show_on_front ) {

        if( 'category' == $slider_type ){
            $query->set( 'category__not_in', $slider_category );
        }elseif( 'post' == $slider_type ){
            $sliders = array( $slider_post1, $slider_post2, $slider_post3 );        
            $sliders = array_diff( array_unique( $sliders ), array('') );

            if( ! empty( $sliders ) ){
                $query->set( 'post__not_in', $sliders );
            }
        }
    }
}
add_action( 'pre_get_posts', 'elegant_pink_exclude_posts_for_homepage' );

/**
 * Implement Local Font Method functions.
 */
require get_template_directory() . '/inc/class-webfont-loader.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Featured Post Widget
 */
require get_template_directory() . '/inc/widget-featured-post.php';

/**
 * Recent Post Widget
 */
require get_template_directory() . '/inc/widget-recent-post.php';

/**
 * Popular Post Widget
 */
require get_template_directory() . '/inc/widget-popular-post.php';

/**
 * Social Link Widget
 */
require get_template_directory() . '/inc/widget-social-links.php';

/**
 * Add Custom Meta Box
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Info Section
 */
require get_template_directory() . '/inc/info.php';
/**
 * Getting Started
*/
require get_template_directory() . '/inc/dashboard/dashboard.php';
/**
* Recommended Plugins
*/
require_once get_template_directory() . '/inc/tgmpa/recommended-plugins.php';
