<?php
function storepress_cta_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	CTA Section
	=========================================*/
	$wp_customize->add_section(
		'cta_setting', array(
			'title' => esc_html__( 'Call Action Section', 'vf-expansion' ),
			'priority' => 9,
			'panel' => 'storepress_frontpage2_sections',
		)
	);
	
	$wp_customize->add_setting(
		'cta_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cta_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'cta_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'cta_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cta_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'cta_setting',
		)
	);
	
	//  Header  // 
	$wp_customize->add_setting(
		'cta_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'cta_headings',
		array(
			'type' => 'hidden',
			'label' => __('Content','vf-expansion'),
			'section' => 'cta_setting',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'cta_title',
    	array(
	        'default'			=> __('50 <span>% OFF</span>','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'cta_title',
		array(
		    'label'   => __('Title','vf-expansion'),
		    'section' => 'cta_setting',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'cta_subtitle',
    	array(
	        'default'			=> __('For Today Fashion','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'cta_subtitle',
		array(
		    'label'   => __('Subtitle','vf-expansion'),
		    'section' => 'cta_setting',
			'type'           => 'text',
		)  
	);
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'cta_btn_lbl',
    	array(
	        'default'			=> __('Shop Now','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'cta_btn_lbl',
		array(
		    'label'   => __('Button Label','vf-expansion'),
		    'section' => 'cta_setting',
			'type'           => 'text',
		)  
	);
	
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'cta_btn_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'cta_btn_link',
		array(
		    'label'   => __('Button Link','vf-expansion'),
		    'section' => 'cta_setting',
			'type'           => 'text',
		)  
	);
	
	
	//  Background  // 
	$wp_customize->add_setting(
		'cta_bg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'cta_bg_head',
		array(
			'type' => 'hidden',
			'label' => __('Background','vf-expansion'),
			'section' => 'cta_setting',
		)
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'cta_bg_img' , 
    	array(
			'default' 			=> esc_url(VF_EXPANSION_PLUGIN_URL .'inc/themes/martpress/assets/images/cta_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_url',	
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'cta_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'vf-expansion'),
			'section'        => 'cta_setting',
		) 
	));
	
	
	// opacity
	if ( class_exists( 'StorePress_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'cta_img_opacity',
			array(
				'default' => '0.5',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'storepress_sanitize_range_value',
				'priority' => 8,
			)
		);
		$wp_customize->add_control( 
		new StorePress_Customizer_Range_Control( $wp_customize, 'cta_img_opacity', 
			array(
				'label'      => __( 'Opacity', 'vf-expansion' ),
				'section'  => 'cta_setting',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 0,
							'max'           => 0.9,
							'step'          => 0.1,
							'default_value' => 0.5,
						),
					),
			) ) 
		);
	}
}

add_action( 'customize_register', 'storepress_cta_setting' );

// selective refresh
function storepress_cta_section_partials( $wp_customize ){	
	// cta_title
	$wp_customize->selective_refresh->add_partial( 'cta_title', array(
		'selector'            => '.home1-cta .display-3',
		'settings'            => 'cta_title',
		'render_callback'  => 'storepress_cta_title_render_callback',
	) );
	
	// cta_subtitle
	$wp_customize->selective_refresh->add_partial( 'cta_subtitle', array(
		'selector'            => '.home1-cta .display-6',
		'settings'            => 'cta_subtitle',
		'render_callback'  => 'storepress_cta_subtitle_render_callback',
	) );
	
	// cta_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'cta_btn_lbl', array(
		'selector'            => '.home1-cta .btn',
		'settings'            => 'cta_btn_lbl',
		'render_callback'  => 'storepress_cta_btn_lbl_render_callback',
	) );
	}

add_action( 'customize_register', 'storepress_cta_section_partials' );

// cta_title
function storepress_cta_title_render_callback() {
	return get_theme_mod( 'cta_title' );
}

// cta_subtitle
function storepress_cta_subtitle_render_callback() {
	return get_theme_mod( 'cta_subtitle' );
}

// cta_btn_lbl
function storepress_cta_btn_lbl_render_callback() {
	return get_theme_mod( 'cta_btn_lbl' );
}