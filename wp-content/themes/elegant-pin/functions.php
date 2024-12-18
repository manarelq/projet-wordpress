<?php
/**
 * Theme functions and definitions
 *
 * @package Elegant_Pin
 */

/**
 * After setup theme hook
 */
function elegant_pin_theme_setup(){
    /*
     * Make chile theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'elegant-pin', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'elegant_pin_theme_setup' );

/**
 * Load assets.
 *
 */
function elegant_pin_enqueue_styles() {
    $my_theme = wp_get_theme();
    $version = $my_theme['Version'];

    wp_enqueue_style( 'elegant-pink-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'elegant-pin-style', get_stylesheet_directory_uri() . '/style.css', array( 'elegant-pink-style' ), $version );

    wp_enqueue_style( 'elegant-pin-google-fonts', elegant_pin_fonts_url(), array(), null );    
}
add_action( 'wp_enqueue_scripts', 'elegant_pin_enqueue_styles' );

/**
 * Register custom fonts.
 */
function elegant_pin_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by EB Garamond, translate this to 'off'. Do not translate into your own language.
    */
    $eb_garamond = _x( 'on', 'EB Garamond font: on or off', 'elegant-pin' );

    /*
    * translators: If there are characters in your language that are not supported
    * by Nunito Sans, translate this to 'off'. Do not translate into your own language.
    */
    $nunito_sans = _x( 'on', 'Nunito Sans font: on or off', 'elegant-pin' );
    
    if ( 'off' !== $eb_garamond || 'off' !== $nunito_sans ) {
        $font_families = array();

        if( 'off' !== $eb_garamond ){
            $font_families[] = 'EB Garamond:400,400i,700,700i';
        }

        if( 'off' !== $nunito_sans ){
            $font_families[] = 'Nunito Sans:400,400i,700,700i';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}

function elegant_pin_dequeue_styles(){
    wp_dequeue_style( 'elegant-pink-google-fonts' );
}
add_action( 'wp_enqueue_scripts','elegant_pin_dequeue_styles',99 );
 
function elegant_pin_footer(){
    $copyright_text = get_theme_mod( 'elegant_pink_footer_copyright_text' );

    $text  = '<div class="site-info"><span>';
    if( $copyright_text ){
        $text .=  wp_kses_post( $copyright_text );
    }else{
        $text .=  esc_html__( 'Copyright &copy; ', 'elegant-pin' ) . date_i18n( esc_html__( 'Y', 'elegant-pin' ) ); 
        $text .= ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a></span>';
    }
    $text .= '</span>';
    $text .= '<span>';
    $text .= esc_html__( 'Elegant Pin ', 'elegant-pin' );
    $text .= '</span><span>';
    $text .= esc_html__( 'Developed By ', 'elegant-pin' );
    $text .= '<a href="' . esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">' . esc_html__( 'Rara Theme', 'elegant-pin' ) .'</a>';
    $text .= '</span><span>';
    $text .= sprintf( esc_html__( 'Powered by: %s', 'elegant-pin' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'elegant-pin' ) ) .'" target="_blank" rel="nofollow">WordPress</a>' );
    $text .= '</span>';
    if( function_exists( 'get_the_privacy_policy_link' ) ){
        $text .= get_the_privacy_policy_link( '<span>', '</span>' );    
    }    
    $text .= '</div>';

    return $text;
}
add_filter( 'elegant_pink_footer_text','elegant_pin_footer' );

function elegant_pink_customizer_theme_info( $wp_customize ) {
    
    $wp_customize->add_section( 'theme_info' , array(
        'title'       => __( 'Information Links' , 'elegant-pin' ),
        'priority'    => 6,
        ));

    $wp_customize->add_setting('theme_info_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));
    
    $theme_info = '';
    $theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'elegant-pin' ) . '</h3>';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View demo', 'elegant-pin' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/previews/?theme=elegant-pin/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pin' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'View documentation', 'elegant-pin' ) . ': </label><a href="' . esc_url( 'https://docs.rarathemes.com/docs/elegant-pin/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pin' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme info', 'elegant-pin' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/elegant-pin/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pin' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support ticket', 'elegant-pin' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/support-ticket/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pin' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Rate this theme', 'elegant-pin' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/support/theme/elegant-pin/reviews/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pin' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="more-detail row-element">' . __( 'More WordPress Themes', 'elegant-pin' ) . ': </label><a href="' . esc_url( 'https://rarathemes.com/wordpress-themes/' ) . '" target="_blank" rel="nofollow noopener">' . __( 'here', 'elegant-pin' ) . '</a></span><br />';


    $wp_customize->add_control( new elegant_pink_Theme_Info( $wp_customize ,'theme_info_theme',array(
        'label' => __( 'About Elegant Pin' , 'elegant-pin' ),
        'section' => 'theme_info',
        'description' => $theme_info
        )));

    $wp_customize->add_setting('theme_info_more_theme',array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post',
        ));

}

/**
 * Function for sanitizing Hex color 
 */
function elegant_pin_sanitize_hex_color( $color ){
    if ( '' === $color )
        return '';

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
        return $color;
}

function elegant_pink_category(){
    $categories_list = get_the_category_list( ' ' );
    if ( $categories_list && elegant_pink_categorized_blog() ) {
        echo '<div class="category">' . $categories_list . '</div>';
    }
}

/**
 * Convert '#' to '%23'
*/
function elegant_pin_hash_to_percent23( $color_code ){
    $color_code = str_replace( "#", "%23", $color_code );
    return $color_code;
}

function elegant_pin_dynamic_color(){
    $primary_color  = get_theme_mod( 'primary_color', '#ea3c53' );
    echo "<style type='text/css' media='all'>"; ?>
        :root{
            --primary-color: <?php echo elegant_pin_sanitize_hex_color( $primary_color ); ?>;
        }
        #primary .post .text-holder .btn-readmore:after,
        #primary .latest_post .text-holder .btn-readmore:after{
             background-image: url('data:image/svg+xml; utf8, <svg xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 30 10"><g id="arrow" transform="translate(-10)"><path fill="<?php echo elegant_pin_hash_to_percent23( elegant_pin_sanitize_hex_color( $primary_color ) ); ?>" d="M24.5,44.974H46.613L44.866,40.5a34.908,34.908,0,0,0,9.634,5,34.908,34.908,0,0,0-9.634,5l1.746-4.474H24.5Z" transform="translate(-14.5 -40.5)"></path></g></svg>');
        }
    <?php echo "</style>";
}
add_action( 'wp_head','elegant_pin_dynamic_color',101 );

function elegant_pin_added_customizer_settings( $wp_customize ){

    $wp_customize->add_setting(
        'primary_color',
        array(
            'default'           => '#ea3c53',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'primary_color', 
        array(
            'label'      => __( 'Primary Color', 'elegant-pin' ),
            'section'    => 'colors',
        ) ) 
    );

     $wp_customize->add_section(
        'elegant_pin_instagram',
        array(
            'title'      => __( 'Instagram Settings', 'elegant-pin' ),
            'priority'   => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Blossom Instagram  */
     $wp_customize->add_setting(
        'ed_blossom_instagram_shortcode',
        array(
            'default'           => false,
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_blossom_instagram_shortcode',
        array(
            'label'       => __( 'Enable Instagram Section', 'elegant-pin' ),
            'description' => __( 'You must configure the BlossomThemes Feed for Instagram to display your Instagram posts on Homepage', 'elegant-pin' ),
            'section'     => 'elegant_pin_instagram',
            'type'        => 'checkbox',
        )
    );

   $wp_customize->add_section(
        'elegant_pin_newsletter',
        array(
            'title'      => __( 'Newsletter Settings', 'elegant-pin' ),
            'priority'   => 55,
            'capability' => 'edit_theme_options',
        )
    );

    /** Blossom Instagram  */
    $wp_customize->add_setting(
        'ed_blossom_newsletter_shortcode',
        array(
            'default'           => true,
            'sanitize_callback' => 'elegant_pink_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'ed_blossom_newsletter_shortcode',
        array(
            'label'       => __( 'Enable Blossom Email Newsletter', 'elegant-pin' ),
            'section'     => 'elegant_pin_newsletter',
            'type'        => 'checkbox',
        )
    );
    
    /** Blossom Instagram  */
    $wp_customize->add_setting(
        'blossom_newsletter_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );

    $wp_customize->add_control(
        'blossom_newsletter_shortcode',
        array(
            'label'       => __( 'Blossom Email Newsletter', 'elegant-pin' ),
            'description' => __( 'Enter Blossom Email Newsletter Shortcode', 'elegant-pin' ),
            'section'     => 'elegant_pin_newsletter',
            'type'        => 'text',
        )
    );

}
add_action( 'customize_register', 'elegant_pin_added_customizer_settings' );

function elegant_pin_blossom_instagram(){
    $instagram = get_theme_mod( 'ed_blossom_instagram_shortcode',false );
    if( class_exists( 'Blossomthemes_Instagram_Feed' ) ){
     $options = get_option( 'blossomthemes_instagram_feed_settings', true );
     if( !isset( $options['username'] ) || $options['username'] == '' ){
            return;
        }
    }
    if( $instagram && is_front_page() ){ ?>
        <div class="instagram-section">
            <?php echo do_shortcode( '[blossomthemes_instagram_feed]' ); ?>
        </div>
    <?php }
}

function elegant_pin_blossom_newsletter(){
    $newsletter           = get_theme_mod( 'ed_blossom_newsletter_shortcode',true );
    $newsletter_shortcode = get_theme_mod( 'blossom_newsletter_shortcode');
    if( $newsletter && is_front_page() ){
        echo do_shortcode( $newsletter_shortcode );
    }
}