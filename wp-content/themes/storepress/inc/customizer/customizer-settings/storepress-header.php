<?php
function storepress_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_section', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header', 'storepress'),
		) 
	);
	
	/*=========================================
	StorePress Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','storepress'),
			'panel'  		=> 'header_section',
		)
    );	
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'hdr_navigation',
        array(
        	'priority'      => 3,
            'title' 		=> __('Header Navigation','storepress'),
			'panel'  		=> 'header_section',
		)
    );
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'hdr_search_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'hdr_search_head',
		array(
			'type' => 'hidden',
			'label' => __('Search','storepress'),
			'section' => 'hdr_navigation',
			'priority'  => 5,
		)
	);	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'hs_hdr_search' , 
			array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'storepress' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority'  => 6,
		) 
	);	
	
	
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'hdr_cart_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'hdr_cart_head',
		array(
			'type' => 'hidden',
			'label' => __('Cart','storepress'),
			'section' => 'hdr_navigation',
			'priority'  => 6,
		)
	);	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'hs_hdr_cart' , 
			array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'storepress' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority'  => 7,
		) 
	);	
	
	
	
	
	/*=========================================
	Header Account
	=========================================*/	
	$wp_customize->add_setting(
		'hdr_acc_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'hdr_acc_head',
		array(
			'type' => 'hidden',
			'label' => __('My Account','storepress'),
			'section' => 'hdr_navigation',
			'priority'  => 9,
		)
	);	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'hs_hdr_account' , 
			array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_account', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'storepress' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority'  => 9,
		) 
	);	
	
	
	/*=========================================
	Contact Info
	=========================================*/	
	$wp_customize->add_setting(
		'abv_hdr_ct_info_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'abv_hdr_ct_info_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Info','storepress'),
			'section' => 'hdr_navigation',
			'priority'  => 21,
		)
	);	
	
	$wp_customize->add_setting( 
		'hs_hdr_ct_info' , 
			array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_ct_info', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'storepress' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority'  => 22,
		) 
	);	
	
	$wp_customize->add_setting( 
		'hdr_ct_info_icon' , 
			array(
			'default' => esc_html__( 'fa-headphones', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		) 
	);
	
	$wp_customize->add_control(
	'hdr_ct_info_icon', 
		array(
			'label'	      => esc_html__( 'Icon', 'storepress' ),
			'section'     => 'hdr_navigation',
			'type'        => 'text',
			'priority'  => 23,
		) 
	);	
	
	// Title // 
	$wp_customize->add_setting(
    	'hdr_ct_info_ttl',
    	array(
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'hdr_ct_info_ttl',
		array(
		    'label'   		=> __('Title','storepress'),
		    'section' 		=> 'hdr_navigation',
			'type'		 =>	'text',
			'priority' => 23,
		)  
	);	
	
	// Subtitle // 
	$wp_customize->add_setting(
    	'hdr_ct_info_subttl',
    	array(
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'hdr_ct_info_subttl',
		array(
		    'label'   		=> __('Subtitle','storepress'),
		    'section' 		=> 'hdr_navigation',
			'type'		 =>	'text',
			'priority' => 24,
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'hdr_ct_info_link',
    	array(
			'sanitize_callback' => 'storepress_sanitize_url',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'hdr_ct_info_link',
		array(
		    'label'   		=> __('Link','storepress'),
		    'section' 		=> 'hdr_navigation',
			'type'		 =>	'text',
			'priority' => 24,
		)  
	);
	
	
	/*=========================================
	Product Categories
	=========================================*/	
	$wp_customize->add_setting(
		'hdr_product_cat'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'hdr_product_cat',
		array(
			'type' => 'hidden',
			'label' => __('Product Categories','storepress'),
			'section' => 'hdr_navigation',
			'priority'  => 25,
		)
	);	
	
	$wp_customize->add_setting( 
		'hs_hdr_product_cat' , 
			array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_product_cat', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'storepress' ),
			'section'     => 'hdr_navigation',
			'type'        => 'checkbox',
			'priority'  => 26,
		) 
	);	
	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Sticky Header','storepress'),
			'panel'  		=> 'header_section',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'sticky_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'sticky_head',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','storepress'),
			'section' => 'sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'hide_show_sticky' , 
			array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'storepress' ),
			'section'     => 'sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'storepress_header_settings' );


// Header selective refresh
function storepress_header_partials( $wp_customize ){	
	// hdr_ct_info_ttl
	$wp_customize->selective_refresh->add_partial( 'hdr_ct_info_ttl', array(
		'selector'            => '.hdr-ct-info h6.title',
		'settings'            => 'hdr_ct_info_ttl',
		'render_callback'  => 'storepress_hdr_ct_info_ttl_render_callback',
	) );
	
	// hdr_ct_info_subttl
	$wp_customize->selective_refresh->add_partial( 'hdr_ct_info_subttl', array(
		'selector'            => '.hdr-ct-info p.text',
		'settings'            => 'hdr_ct_info_subttl',
		'render_callback'  => 'storepress_hdr_ct_info_subttl_render_callback',
	) );
	}

add_action( 'customize_register', 'storepress_header_partials' );

// hdr_ct_info_ttl
function storepress_hdr_ct_info_ttl_render_callback() {
	return get_theme_mod( 'hdr_ct_info_ttl' );
}

// hdr_ct_info_subttl
function storepress_hdr_ct_info_subttl_render_callback() {
	return get_theme_mod( 'hdr_ct_info_subttl' );
}