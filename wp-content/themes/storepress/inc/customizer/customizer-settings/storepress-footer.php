<?php
function storepress_footer( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer', 'storepress'),
		) 
	);
	
	
	/*=========================================
	Footer Background
	=========================================*/
	$wp_customize->add_section(
        'footer_background',
        array(
            'title' 		=> __('Footer Background','storepress'),
			'panel'  		=> 'footer_section',
			'priority'      => 3,
		)
    );
	
	// Background // 
	$wp_customize->add_setting(
		'footer_bg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'footer_bg_head',
		array(
			'type' => 'hidden',
			'label' => __('Background','storepress'),
			'section' => 'footer_background',
		)
	);
	
	// Background Image // 
    $wp_customize->add_setting( 
    	'footer_bg_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/footer_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_url',	
			'priority' => 10,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'footer_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'storepress'),
			'section'        => 'footer_background',
		) 
	));
	
	//  opacity
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'footer_bg_img_opacity',
			array(
				'default' => esc_html__( '0.65', 'storepress' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'priority' => 6,
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'footer_bg_img_opacity', 
			array(
				'label'      => __( 'Opacity', 'storepress' ),
				'section'  => 'footer_background',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 0,
							'max'           => 0.9,
							'step'          => 0.1,
							'default_value' => 0.65,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Footer Copyright
	=========================================*/	
	$wp_customize->add_section(
        'footer_copyright',
        array(
            'title' 		=> __('Footer Copyright','storepress'),
			'panel'  		=> 'footer_section',
			'priority'      => 6,
		)
    );
	
	// Footer Copyright Head
	$wp_customize->add_setting(
		'footer_btm_copy_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority'  => 3,
		)
	);

	$wp_customize->add_control(
	'footer_btm_copy_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','storepress'),
			'section' => 'footer_copyright',
		)
	);
	
	// Copyright 
	$storepress_footer_copy = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'storepress' );
	$wp_customize->add_setting(
    	'footer_copyright',
    	array(
			'default' => $storepress_footer_copy,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);	

	$wp_customize->add_control( 
		'footer_copyright',
		array(
		    'label'   		=> __('Copytight','storepress'),
		    'section'		=> 'footer_copyright',
			'type' 			=> 'textarea',
			'transport'         => $selective_refresh,
		)  
	);	
}
add_action( 'customize_register', 'storepress_footer' );
// Footer selective refresh
function storepress_footer_partials( $wp_customize ){
	
	// footer_copyright
	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector'            => '.footer-copyright .copyright-text',
		'settings'            => 'footer_copyright',
		'render_callback'  => 'storepress_footer_copyright_render_callback',
	) );
	
	}
add_action( 'customize_register', 'storepress_footer_partials' );

// copyright_content
function storepress_footer_copyright_render_callback() {
	return get_theme_mod( 'footer_copyright' );
}