<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * @package StorePress
 */

if ( ! function_exists( 'storepress_posted_on' ) ) :
function storepress_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'storepress' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'storepress' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'storepress_entry_footer' ) ) :
function storepress_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'storepress' ) );
		if ( $categories_list && storepress_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'storepress' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'storepress' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'storepress' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'storepress' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'storepress' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function storepress_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'storepress_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'storepress_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so storepress_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so storepress_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in storepress_categorized_blog.
 */
function storepress_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'storepress_categories' );
}
add_action( 'edit_category', 'storepress_category_transient_flusher' );
add_action( 'save_post',     'storepress_category_transient_flusher' );

/**
 * Theme Sticky Menu
 */
if (!function_exists('storepress_sticky_menu')):
    function storepress_sticky_menu()
    {
        $is_sticky = get_theme_mod('hide_show_sticky','1');

        if ($is_sticky == '1'):
            return 'is-sticky-on';
        else:
            return 'not-sticky';
        endif;
    }
endif;


/**
 * Register Breadcrumb for Multiple Variation
 */
function storepress_breadcrumbs_style() {
	get_template_part('./template-parts/sections/section','breadcrumb');	
}

/**
 * This Function Check whether Sidebar active or Not
 */
if(!function_exists( 'storepress_pages_layout' )) :
function storepress_pages_layout(){
	if(is_active_sidebar('storepress-sidebar-primary'))
		{ echo 'col-lg-8 col-md-12 col-12'; } 
	else 
		{ echo 'col-lg-12 col-md-12 col-12'; }  
} endif;




/**
 * 
 * StorPress Page Header
 * 
 */
 if ( ! function_exists( 'storepress_page_header' ) ) :
	function storepress_page_header() {
			$default_header=get_template_part('template-parts/sections/section','header');
			return $default_header;			
	}
	add_action('storepress_page_header','storepress_page_header');
endif;


/**
 * Section Seprator
 */
if(!function_exists( 'storepress_section_seprator' )) :
function storepress_section_seprator(){ ?> 
	<span class="line"><svg viewBox="0 0 44 35" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5972 0.682715C11.8415 1.05646 8.80903 2.54325 5.85827 3.98671C1.84123 5.95168 0.44709 6.65666 0.309703 6.79249C0.208762 6.89225 0.0975566 7.06864 0.0626136 7.18451C-0.0859716 7.67685 -0.154406 7.51558 2.09682 11.9766C4.36801 16.4773 4.28558 16.339 4.77395 16.4695C5.07833 16.5509 5.35424 16.4611 6.41647 15.9344C8.76667 14.7693 9.67068 14.3578 9.87883 14.3583C10.1187 14.3588 10.5529 14.5494 10.7161 14.7256C11.0045 15.0371 10.99 14.5349 10.9906 24.2084C10.991 31.7034 11.0027 33.1574 11.0638 33.3574C11.3148 34.1783 11.9899 34.7968 12.7986 34.9467C13.1844 35.0181 30.833 35.0176 31.2151 34.9461C31.6302 34.8685 32.0294 34.6496 32.3512 34.3232C32.7097 33.9595 32.9031 33.5833 32.9698 33.1196C33.0028 32.8907 33.0221 29.5534 33.0227 23.9687C33.0239 14.4132 33.0053 15.0036 33.3135 14.7004C33.5483 14.4695 33.7466 14.389 34.0876 14.3861C34.3907 14.3836 34.4619 14.4138 36.5502 15.4331C38.4788 16.3745 38.7275 16.4828 38.9604 16.4828C39.2716 16.4829 39.5873 16.337 39.7877 16.1006C39.9637 15.8928 43.88 8.12641 43.963 7.82041C44.0459 7.5144 43.9892 7.2087 43.7956 6.9185C43.6383 6.6828 43.5818 6.64981 42.0482 5.90036C41.1766 5.47438 38.1075 3.97296 35.2282 2.564L29.9929 0.0021409L29.8402 0.192539C29.3371 0.81953 28.4761 1.48163 27.5267 1.9716C25.9385 2.79115 24.1337 3.19315 22.0328 3.19521C19.8385 3.19742 18.1117 2.8104 16.4082 1.93453C15.4277 1.43041 14.7613 0.909659 14.1425 0.164126C14.0661 0.0720925 13.9963 -0.00171959 13.9874 3.04895e-05C13.9784 0.00178057 13.3528 0.308971 12.5972 0.682715Z" fill="currentColor"/></svg></span>
<?php } add_action('storepress_section_seprator','storepress_section_seprator'); endif;


/**
 * Section Seprator
 */
if(!function_exists( 'storepress_section_seprator2' )) :
function storepress_section_seprator2(){ ?> 
	<span class="line"><svg viewBox="0 0 44 35" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5972 0.682715C11.8415 1.05646 8.80903 2.54325 5.85827 3.98671C1.84123 5.95168 0.44709 6.65666 0.309703 6.79249C0.208762 6.89225 0.0975566 7.06864 0.0626136 7.18451C-0.0859716 7.67685 -0.154406 7.51558 2.09682 11.9766C4.36801 16.4773 4.28558 16.339 4.77395 16.4695C5.07833 16.5509 5.35424 16.4611 6.41647 15.9344C8.76667 14.7693 9.67068 14.3578 9.87883 14.3583C10.1187 14.3588 10.5529 14.5494 10.7161 14.7256C11.0045 15.0371 10.99 14.5349 10.9906 24.2084C10.991 31.7034 11.0027 33.1574 11.0638 33.3574C11.3148 34.1783 11.9899 34.7968 12.7986 34.9467C13.1844 35.0181 30.833 35.0176 31.2151 34.9461C31.6302 34.8685 32.0294 34.6496 32.3512 34.3232C32.7097 33.9595 32.9031 33.5833 32.9698 33.1196C33.0028 32.8907 33.0221 29.5534 33.0227 23.9687C33.0239 14.4132 33.0053 15.0036 33.3135 14.7004C33.5483 14.4695 33.7466 14.389 34.0876 14.3861C34.3907 14.3836 34.4619 14.4138 36.5502 15.4331C38.4788 16.3745 38.7275 16.4828 38.9604 16.4828C39.2716 16.4829 39.5873 16.337 39.7877 16.1006C39.9637 15.8928 43.88 8.12641 43.963 7.82041C44.0459 7.5144 43.9892 7.2087 43.7956 6.9185C43.6383 6.6828 43.5818 6.64981 42.0482 5.90036C41.1766 5.47438 38.1075 3.97296 35.2282 2.564L29.9929 0.0021409L29.8402 0.192539C29.3371 0.81953 28.4761 1.48163 27.5267 1.9716C25.9385 2.79115 24.1337 3.19315 22.0328 3.19521C19.8385 3.19742 18.1117 2.8104 16.4082 1.93453C15.4277 1.43041 14.7613 0.909659 14.1425 0.164126C14.0661 0.0720925 13.9963 -0.00171959 13.9874 3.04895e-05C13.9784 0.00178057 13.3528 0.308971 12.5972 0.682715Z" fill="currentColor"></path></svg></span>
<?php } add_action('storepress_section_seprator2','storepress_section_seprator2'); endif;

/**
 * Register Google fonts for storepress.
 */
function storepress_google_font() {
	
	$font_families = array('Dancing+Script:wght@400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function storepress_scripts_styles() {
    wp_enqueue_style( 'storepress-fonts', storepress_google_font(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'storepress_scripts_styles' );


/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

add_action( 'wp_ajax_storepress_dismissed_notice_handler', 'storepress_ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function storepress_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        // Store it in the options table
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function storepress_deprecated_hook_admin_notice() {
        // Check if it's been dismissed...
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
            // and added "data-notice" attribute in order to track multiple / different notices
            // multiple dismissible notice states ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="storepress-getting-started-notice clearfix">
                    <div class="storepress-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'storepress' ); ?>" />
                    </div><!-- /.storepress-theme-screenshot -->
                    <div class="storepress-theme-notice-content">
                        <h2 class="storepress-notice-h2">
                            <?php
                        printf(
                        /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Welcome! Thank you for choosing %1$s!', 'storepress' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
                        </h2>

                        <p class="plugin-install-notice"><?php echo sprintf(__('Install and activate <strong>Vf Expansion</strong> plugin for taking full advantage of all the features this theme has to offer.', 'storepress')) ?></p>

                        <a class="storepress-btn-get-started button button-primary button-hero storepress-button-padding" href="<?php echo esc_url('#')?>" data-name="" data-slug=""><?php esc_html_e( 'Get started with StorePress', 'storepress' ) ?></a><span class="storepress-push-down">
                        <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                'or %1$sCustomize theme%2$s</a></span>',
                                '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                                '</a>'
                            );
                        ?>
                    </div><!-- /.storepress-theme-notice-content -->
                </div>
            </div>
        <?php }
}

add_action( 'admin_notices', 'storepress_deprecated_hook_admin_notice' );

/*******************************************************************************
 *  Plugin Installer
 *******************************************************************************/

add_action( 'wp_ajax_install_act_plugin', 'storepress_admin_install_plugin' );

function storepress_admin_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/vf-expansion' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'vf-expansion' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'vf-expansion/vf-expansion.php' );
    }
}	