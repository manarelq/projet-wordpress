<?php
function storepress_product_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Product  Section
	=========================================*/
	$wp_customize->add_section(
		'product_setting', array(
			'title' => esc_html__( 'Product Section', 'vf-expansion' ),
			'priority' => 3,
			'panel' => 'storepress_frontpage2_sections',
		)
	);

	$wp_customize->add_setting(
		'product_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'product_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'product_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'product_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'product_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'product_setting',
		)
	);
	
	// Product Header Section // 
	$wp_customize->add_setting(
		'product_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'product_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','vf-expansion'),
			'section' => 'product_setting',
		)
	);
	
	// Product Title // 
	$wp_customize->add_setting(
    	'product_title',
    	array(
	        'default'			=> __('Our Products','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'product_title',
		array(
		    'label'   => __('Title','vf-expansion'),
		    'section' => 'product_setting',
			'type'           => 'text',
		)  
	);
	
	// Product content Section // 
	$wp_customize->add_setting(
		'product_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'product_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','vf-expansion'),
			'section' => 'product_setting',
		)
	);
	
	// Category
	if(class_exists( 'woocommerce' )): 
		$wp_customize->add_setting(
		'product1_cat_id',
			array(
			'capability' => 'edit_theme_options',
			'priority' => 5,
			)
		);	
		$wp_customize->add_control( new Vf_Expansion_Product_Cat_Control( $wp_customize, 
		'product1_cat_id', 
			array(
			'label'   => __('Select category','vf-expansion'),
			'section' => 'product_setting',
			) 
		) );
	endif;
	
	// product_display_num
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'product_display_num',
			array(
				'default' => '20',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'priority' => 7,
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'product_display_num', 
			array(
				'label'      => __( 'No of Product Display', 'vf-expansion' ),
				'section'  => 'product_setting',
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

add_action( 'customize_register', 'storepress_product_setting' );

// selective refresh
function storepress_product_section_partials( $wp_customize ){	
	// product_title
	$wp_customize->selective_refresh->add_partial( 'product_title', array(
		'selector'            => '.home1-product .heading-default h3',
		'settings'            => 'product_title',
		'render_callback'  => 'storepress_product_title_render_callback',
	) );
	}

add_action( 'customize_register', 'storepress_product_section_partials' );

// product_title
function storepress_product_title_render_callback() {
	return get_theme_mod( 'product_title' );
}