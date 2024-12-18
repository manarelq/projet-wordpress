<?php
function qstore_product3_setting( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Product  Section
	=========================================*/
	$wp_customize->add_section(
		'product3_setting', array(
			'title' => esc_html__( 'Product Section', 'vf-expansion' ),
			'priority' => 5,
			'panel' => 'storepress_frontpage2_sections',
		)
	);


  // setting 
	$wp_customize->add_setting(
		'product3_setting_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
		'product3_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'product3_setting',
		)
	);

	// Hide/Show
	$wp_customize->add_setting(
		'product3_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'product3_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'product3_setting',
		)
	);
	
	// Product Header Section // 
	$wp_customize->add_setting(
		'product3_headings'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
		'product3_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','vf-expansion'),
			'section' => 'product3_setting',
		)
	);
	
	// Product Title // 
	$wp_customize->add_setting(
		'product3_title',
		array(
			'default'			=> __('Trending Product','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'product3_title',
		array(
			'label'   => __('Title','vf-expansion'),
			'section' => 'product3_setting',
			'type'           => 'text',
		)  
	);
	
	// Product content Section // 
	$wp_customize->add_setting(
		'product3_content_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
		'product3_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','vf-expansion'),
			'section' => 'product3_setting',
		)
	);
	
	// Category
	if(class_exists( 'woocommerce' )): 
		$wp_customize->add_setting(
			'product3_cat_id',
			array(
				'capability' => 'edit_theme_options',
				'priority' => 5,
			)
		);	
		$wp_customize->add_control( new Vf_Expansion_Product_Cat_Control( $wp_customize, 
			'product3_cat_id', 
			array(
				'label'   => __('Select category','vf-expansion'),
				'section' => 'product3_setting',
			) 
		) );
	endif;
	
	// product3_display_num
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'product3_display_num',
			array(
				'default' => '20',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'priority' => 7,
			)
		);
		$wp_customize->add_control( 
			new Vf_Expansion_slider_Control( $wp_customize, 'product3_display_num', 
				array(
					'label'      => __( 'No of Product Display', 'vf-expansion' ),
					'section'  => 'product3_setting',
					'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'    => 1,
							'max'    => 500,
							'step'   => 1,
							'default_value' => 20,
						),
					),
				) ) 
		);
	}
	
}

add_action( 'customize_register', 'qstore_product3_setting' );

// selective refresh
function qstore_product3_section_partials( $wp_customize ){	
	// product3_title
	$wp_customize->selective_refresh->add_partial( 'product3_title', array(
		'selector'            => '.vf3p .heading-default h3',
		'settings'            => 'product3_title',
		'render_callback'  => 'qstore_product3_title_render_callback',
	) );
}

add_action( 'customize_register', 'qstore_product3_section_partials' );

// product3_title
function qstore_product3_title_render_callback() {
	return get_theme_mod( 'product3_title' );
}