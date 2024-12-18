<?php
 /**
 * Enqueue Theme scripts and styles.
 */
function storepress_site_scripts() {
	
	// Theme Styles		
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/css/owl.carousel.min.css');
	
	wp_enqueue_style('bootstrap-min',get_template_directory_uri().'/assets/css/bootstrap.min.css');
	
	wp_enqueue_style('meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.css');
	
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/fonts/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/css/animate.min.css');
	
	wp_enqueue_style('storepress-editor-style',get_template_directory_uri().'/assets/css/editor-style.css');

	wp_enqueue_style('storepress-widgets',get_template_directory_uri().'/assets/css/widgets.css');

	wp_enqueue_style('storepress-main', get_template_directory_uri() . '/assets/css/main.css');

	wp_enqueue_style('storepress-woocommerce', get_template_directory_uri() . '/assets/css/woo.css');
	
	wp_enqueue_style('storepress-media-query', get_template_directory_uri() . '/assets/css/responsive.css');
	
	wp_enqueue_style( 'storepress-style', get_stylesheet_uri() );
	
	// Theme Scripts
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('meanmenu', get_template_directory_uri() . '/assets/js/meanmenu.js', array('jquery'), false, true);
	
	wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array('jquery'), false, true);

	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), false, true);

	wp_enqueue_script('owlcarousel2-filter', get_template_directory_uri() . '/assets/js/owlcarousel2-filter.min.js', array('jquery'), false, true);
	
	
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), false, false, true);

	wp_enqueue_script('storepress-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'storepress_site_scripts' );


//Admin Enqueue for Admin
function storepress_admin_enqueue_scripts(){
	wp_enqueue_style('storepress-admin-style', get_template_directory_uri() . '/inc/customizer/assets/css/admin.css');
	wp_enqueue_script( 'storepress-admin-script', get_template_directory_uri() . '/inc/customizer/assets/js/storepress-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'storepress-admin-script', 'storepress_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'storepress_admin_enqueue_scripts' );