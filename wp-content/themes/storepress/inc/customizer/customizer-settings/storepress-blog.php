<?php
function storepress_blog2_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'storepress_frontpage2_sections', array(
			'priority' => 32,
			'title' => esc_html__( 'Frontpage', 'storepress' ),
		)
	);
	/*=========================================
	Blog Section
	=========================================*/
	$wp_customize->add_section(
		'blog2_setting', array(
			'title' => esc_html__( 'Blog Section', 'storepress' ),
			'priority' => 14,
			'panel' => 'storepress_frontpage2_sections',
		)
	);
	
	$wp_customize->add_setting(
		'blog2_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'blog2_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','storepress'),
			'section' => 'blog2_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'blog2_hide_show'
			,array(
			'default' => esc_html__( '1', 'storepress' ),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'blog2_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','storepress'),
			'section' => 'blog2_setting',
		)
	);
	
	// Blog Header Section // 
	$wp_customize->add_setting(
		'blog2_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'blog2_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','storepress'),
			'section' => 'blog2_setting',
		)
	);
	
	// Blog Title // 
	$wp_customize->add_setting(
    	'blog2_title',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'blog2_title',
		array(
		    'label'   => __('Title','storepress'),
		    'section' => 'blog2_setting',
			'type'           => 'text',
		)  
	);

	// Blog content Section // 
	
	$wp_customize->add_setting(
		'blog2_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'blog2_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','storepress'),
			'section' => 'blog2_setting',
		)
	);
	
	// blog2_display_num
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'blog2_display_num',
			array(
				'default' => esc_html__( '3', 'storepress' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'blog2_display_num', 
			array(
				'label'      => __( 'No. of Posts Display', 'storepress' ),
				'section'  => 'blog2_setting',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'    => 1,
							'max'    => 500,
							'step'   => 1,
							'default_value' => 3,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Head
	=========================================*/
	$wp_customize->add_setting(
		'blog2_bg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'blog2_bg_head',
		array(
			'type' => 'hidden',
			'label' => __('Background','storepress'),
			'section' => 'blog2_setting',
		)
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'blog2_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/post_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'blog2_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'storepress'),
			'section'        => 'blog2_setting',
		) 
	));
	
	
	// opacity
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'blog2_opacity',
			array(
				'default' => esc_html__( '0.75', 'storepress' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'blog2_opacity', 
			array(
				'label'      => __( 'Opacity', 'storepress' ),
				'section'  => 'blog2_setting',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 0,
							'max'           => 0.9,
							'step'          => 0.1,
							'default_value' => 0.75,
						),
					),
			) ) 
		);
	}
}

add_action( 'customize_register', 'storepress_blog2_setting' );

// Blog selective refresh
function storepress_blog2_section_partials( $wp_customize ){	
	// blog2_title
	$wp_customize->selective_refresh->add_partial( 'blog2_title', array(
		'selector'            => '.vf-post-2 .heading-default h3',
		'settings'            => 'blog2_title',
		'render_callback'  => 'storepress_blog2_title_render_callback',
	) );
	}

add_action( 'customize_register', 'storepress_blog2_section_partials' );

// blog2_title
function storepress_blog2_title_render_callback() {
	return get_theme_mod( 'blog2_title' );
}