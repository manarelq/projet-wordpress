<?php
/**
 * Elegant Pink Theme Customizer.
 *
 * @package Elegant_Pink
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elegant_pink_customize_register( $wp_customize ) {
	
    /* Option list of all post */	
    $options_posts = array();
    $options_posts_obj = get_posts('posts_per_page=-1');
    $options_posts[''] = __( 'Choose Post', 'elegant-pink' );
    foreach ( $options_posts_obj as $posts ) {
    	$options_posts[$posts->ID] = $posts->post_title;
    }
    
    /* Option list of all categories */
    $args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $option_categories = array();
    $category_lists = get_categories( $args );
    $option_categories[''] = __( 'Choose Category', 'elegant-pink' );
    foreach( $category_lists as $category ){
        $option_categories[$category->term_id] = $category->name;
    }
    
    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'elegant-pink' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'elegant-pink' ),
        ) 
    );

    $wp_customize->add_section(
        'elegant_pink_typography_section',
        array(
            'title' => __( 'Typography Settings', 'elegant-pink' ),
            'priority' => 80,
        )
    );

    $wp_customize->add_setting(
        'ed_localgoogle_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_localgoogle_fonts',
        array(
            'label'   => __( 'Load Google Fonts Locally', 'elegant-pink' ),
            'section' => 'elegant_pink_typography_section',
            'type'    => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'ed_preload_local_fonts',
        array(
            'default'           => false,
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_preload_local_fonts',
        array(
            'label'           => __( 'Preload Local Fonts', 'elegant-pink' ),
            'section'         => 'elegant_pink_typography_section',
            'type'            => 'checkbox',
            'active_callback' => 'elegant_pink_flush_fonts_callback'
        )
    );
    

    $wp_customize->add_setting(
        'flush_google_fonts',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses',
        )
    );

    $wp_customize->add_control(
        'flush_google_fonts',
        array(
            'label'       => __( 'Flush Local Fonts Cache', 'elegant-pink' ),
            'description' => __( 'Click the button to reset the local fonts cache.', 'elegant-pink' ),
            'type'        => 'button',
            'settings'    => array(),
            'section'     => 'elegant_pink_typography_section',
            'input_attrs' => array(
                'value' => __( 'Flush Local Fonts Cache', 'elegant-pink' ),
                'class' => 'button button-primary flush-it',
            ),
            'active_callback' => 'elegant_pink_flush_fonts_callback'
        )
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel';  
    $wp_customize->get_section( 'elegant_pink_typography_section' )->panel = 'wp_default_panel';
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    $wp_customize->get_section( 'static_front_page' )->title    = 'Static Front Page';
    
	/** Default Settings Ends */    
    
    /** Slider Settings */
    $wp_customize->add_section(
        'elegant_pink_slider_settings',
        array(
            'title' => __( 'Slider Settings', 'elegant-pink' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'elegant_pink_ed_slider',
        array(
            'default' => '',
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_ed_slider',
        array(
            'label'   => __( 'Enable Home Page Slider', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type'    => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'elegant_pink_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'elegant_pink_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Control */
    $wp_customize->add_setting(
        'elegant_pink_slider_control',
        array(
            'default' => '1',
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_control',
        array(
            'label' => __( 'Enable Slider Control', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'elegant_pink_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Slider Transition */
    $wp_customize->add_setting(
        'elegant_pink_slider_transition',
        array(
            'default' => 'fade',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_transition',
        array(
            'label' => __( 'Choose Slider Transition', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'elegant-pink' ),
                'slide' => __( 'Slide', 'elegant-pink' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'elegant_pink_slider_speed',
        array(
            'default' => '400',
            'sanitize_callback' => 'elegant_pink_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_speed',
        array(
            'label' => __( 'Slider Speed', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'number',
        )
    );
    
    /** Slider Pause */
    $wp_customize->add_setting(
        'elegant_pink_slider_pause',
        array(
            'default' => '6000',
            'sanitize_callback' => 'elegant_pink_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_pause',
        array(
            'label'   => __( 'Slider Pause', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type'    => 'number',
        )
    );
    
    /** Words Count */
    $wp_customize->add_setting(
        'elegant_pink_slider_words',
        array(
            'default' => 13,
            'sanitize_callback' => 'elegant_pink_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_words',
        array(
            'label'   => __( 'Words Count', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type'    => 'number',            
        )
    );
    
    /** Slider Readmore */
    $wp_customize->add_setting(
        'elegant_pink_slider_readmore',
        array(
            'default' => __( 'Read More', 'elegant-pink' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Type */
    $wp_customize->add_setting(
        'elegant_pink_slider_type',
        array(
            'default' => 'category',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_type',
        array(
            'label' => __( 'Choose Slider Type', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'radio',
            'choices' => array(
                'category' => __( 'Category Posts', 'elegant-pink' ),
                'post' => __( 'Single Posts', 'elegant-pink' ),
            )
        )
    );
    
    /** Select Category */
    $wp_customize->add_setting(
        'elegant_pink_slider_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_cat',
        array(
            'label' => __( 'Choose Slider Category', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'select',
            'choices' => $option_categories,
            'active_callback' => 'elegant_pink_choice_callback'
        )
    );
    
    /** Select Post 1 */
    $wp_customize->add_setting(
        'elegant_pink_slider_post1',
        array(
            'default' => '',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_post1',
        array(
            'label' => __( 'Slider Post One', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
            'active_callback' => 'elegant_pink_choice_callback'
        )
    );
    
    /** Select Post 2 */
    $wp_customize->add_setting(
        'elegant_pink_slider_post2',
        array(
            'default' => '',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_post2',
        array(
            'label' => __( 'Slider Post Two', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
            'active_callback' => 'elegant_pink_choice_callback'
        )
    );
    
    /** Select Post 3 */
    $wp_customize->add_setting(
        'elegant_pink_slider_post3',
        array(
            'default' => '',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_slider_post3',
        array(
            'label' => __( 'Slider Post Three', 'elegant-pink' ),
            'section' => 'elegant_pink_slider_settings',
            'type' => 'select',
            'choices' => $options_posts,
            'active_callback' => 'elegant_pink_choice_callback'
        )
    );
    /** Slider Settings Ends */

    /** Social Settings */
    $wp_customize->add_section(
        'elegant_pink_social_settings',
        array(
            'title' => __( 'Social Settings', 'elegant-pink' ),
            'description' => __( 'Leave blank if you do not want to show the social link.', 'elegant-pink' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable Social in Header */
    $wp_customize->add_setting(
        'elegant_pink_ed_social',
        array(
            'default' => '',
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_ed_social',
        array(
            'label' => __( 'Enable Social Links', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Facebook */
    $wp_customize->add_setting(
        'elegant_pink_facebook',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_facebook',
        array(
            'label' => __( 'Facebook', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    
    /** Twitter */
    $wp_customize->add_setting(
        'elegant_pink_twitter',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_twitter',
        array(
            'label' => __( 'Twitter', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    
    /** Google Plus */
    $wp_customize->add_setting(
        'elegant_pink_google_plus',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_google_plus',
        array(
            'label' => __( 'Google Plus', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    
    /** LinkedIn */
    $wp_customize->add_setting(
        'elegant_pink_linkedin',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_linkedin',
        array(
            'label' => __( 'LinkedIn', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    
    /** Youtube */
    $wp_customize->add_setting(
        'elegant_pink_youtube',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_youtube',
        array(
            'label' => __( 'YouTube', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    
    /** Instagram */
    $wp_customize->add_setting(
        'elegant_pink_instagram',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_instagram',
        array(
            'label' => __( 'Instagram', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    
    /** Pinterest */
    $wp_customize->add_setting(
        'elegant_pink_pinterest',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_pinterest',
        array(
            'label' => __( 'Pinterest', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );


     /** Ok */
    $wp_customize->add_setting(
        'elegant_pink_ok',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_ok',
        array(
            'label' => __( 'OK', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    /** Vk */
    $wp_customize->add_setting(
        'elegant_pink_vk',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_vk',
        array(
            'label' => __( 'VK', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );

    /** Xing */
    $wp_customize->add_setting(
        'elegant_pink_xing',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_xing',
        array(
            'label' => __( 'Xing', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );

     /** Telegram */
    $wp_customize->add_setting(
        'elegant_pink_telegram',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_telegram',
        array(
            'label' => __( 'Telegram', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );

     /** Tiktok */
     $wp_customize->add_setting(
        'elegant_pink_tiktok',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_tiktok',
        array(
            'label' => __( 'Tiktok', 'elegant-pink' ),
            'section' => 'elegant_pink_social_settings',
            'type' => 'text',
        )
    );
    /** Social Settings Ends */
    
    /** Pagination Settings */
    $wp_customize->add_section(
        'elegant_pink_pagination_settings',
        array(
            'title' => __( 'Pagination Settings', 'elegant-pink' ),
            'priority' => 40,
            'capability' => 'edit_theme_options',
        )
    );
    
    $wp_customize->add_setting(
        'elegant_pink_pagination_type',
        array(
            'default' => 'default',
            'sanitize_callback' => 'elegant_pink_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_pagination_type',
        array(
            'label' => __( 'Pagination Type', 'elegant-pink' ),
            'section' => 'elegant_pink_pagination_settings',
            'type' => 'radio',
            'choices' => array(
                'default'   => __( 'Default', 'elegant-pink' ),
                'load_more' => __( 'Load More', 'elegant-pink' ),
            )
        )
    );
    /** Pagination Settings Ends */
    
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        /** Custom CSS*/
        $wp_customize->add_section(
            'elegant_pink_custom_settings',
            array(
                'title' => __( 'Custom CSS Settings', 'elegant-pink' ),
                'priority' => 50,
                'capability' => 'edit_theme_options',
            )
        );
        
        $wp_customize->add_setting(
            'elegant_pink_custom_css',
            array(
                'default' => '',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'elegant_pink_sanitize_css'
                )
        );
        
        $wp_customize->add_control(
            'elegant_pink_custom_css',
            array(
                'label' => __( 'Custom Css', 'elegant-pink' ),
                'section' => 'elegant_pink_custom_settings',
                'description' => __( 'Put your custom CSS', 'elegant-pink' ),
                'type' => 'textarea',
            )
        );
        /** Custom CSS Ends */
    }

    /** Footer Section */
    $wp_customize->add_section(
        'elegant_pink_footer_section',
        array(
            'title' => __( 'Footer Settings', 'elegant-pink' ),
            'priority' => 70,
        )
    );
    
    /** Copyright Text */
    $wp_customize->add_setting(
        'elegant_pink_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        'elegant_pink_footer_copyright_text',
        array(
            'label' => __( 'Copyright Info', 'elegant-pink' ),
            'section' => 'elegant_pink_footer_section',
            'type' => 'textarea',
        )
    );
    
    /**
     * Sanitization Funcitons
     * 
     * @link https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php  
     */ 
    function elegant_pink_sanitize_checkbox( $checked ){
        // Boolean check.
	   return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }
    
    function elegant_pink_sanitize_select( $input, $setting ) {
    	// Ensure input is a slug.
    	$input = sanitize_key( $input );
    	// Get list of choices from the control associated with the setting.
    	$choices = $setting->manager->get_control( $setting->id )->choices;
    	// If the input is a valid key, return it; otherwise, return the default.
    	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
    
    function elegant_pink_sanitize_number_absint( $number, $setting ) {
    	// Ensure $number is an absolute integer (whole number, zero or greater).
    	$number = absint( $number );
    	// If the input is an absolute integer, return it; otherwise, return the default
    	return ( $number ? $number : $setting->default );
    }
    
    function elegant_pink_sanitize_css( $css ) {
    	return wp_strip_all_tags( $css );
    }
    
    /**
     * Active Callback
     * 
     * @link http://ottopress.com/2015/whats-new-with-the-customizer/ 
     */ 
    function elegant_pink_choice_callback( $control ) {
        $radio_setting = $control->manager->get_setting('elegant_pink_slider_type')->value();
        $control_id = $control->id;
         
        if ( $control_id == 'elegant_pink_slider_cat'  && $radio_setting == 'category' ) return true;
        if ( $control_id == 'elegant_pink_slider_post1' && $radio_setting == 'post' ) return true;
        if ( $control_id == 'elegant_pink_slider_post2' && $radio_setting == 'post' ) return true;
        if ( $control_id == 'elegant_pink_slider_post3' && $radio_setting == 'post' ) return true;
         
        return false;
    }
}
add_action( 'customize_register', 'elegant_pink_customize_register' );

function elegant_pink_flush_fonts_callback( $control ){
    $ed_localgoogle_fonts   = $control->manager->get_setting( 'ed_localgoogle_fonts' )->value();
    $control_id   = $control->id;
    
    if ( $control_id == 'flush_google_fonts' && $ed_localgoogle_fonts ) return true;
    if ( $control_id == 'ed_preload_local_fonts' && $ed_localgoogle_fonts ) return true;
    return false;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function elegant_pink_customize_preview_js() {

    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
	wp_enqueue_script( 'elegant_pink_customizer', get_template_directory_uri() . '/js' . $build . '/customizer' . $suffix . '.js', array( 'customize-preview' ), ELEGANT_PINK_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'elegant_pink_customize_preview_js' );

/**
 * Customizer control Scripts
*/
function elegant_pink_customize_scripts() {
    $array = array( 
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'flushit'    => __( 'Successfully Flushed!','elegant-pink' ),
        'nonce'      => wp_create_nonce('ajax-nonce')
    );

	wp_enqueue_style( 'elegant-pink-customize', get_template_directory_uri().'/inc/css/customize.css','', ELEGANT_PINK_THEME_VERSION );
    wp_enqueue_script( 'elegant-pink-customize', get_template_directory_uri().'/inc/js/customize.js', array( 'jquery' ), '', true );
    wp_localize_script( 'elegant-pink-customize', 'elegant_pink_cdata', $array );
}
add_action( 'customize_controls_enqueue_scripts', 'elegant_pink_customize_scripts' );