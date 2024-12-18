<?php
function qstore_product_cat3_setting( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Product Category
	=========================================*/
	$wp_customize->add_section(
		'product_cat3_setting', array(
			'title' => esc_html__( 'Product Category Section', 'vf-expansion' ),
			'panel' => 'storepress_frontpage2_sections',
			'priority' => 2,
		)
	);
	
	/*=========================================
	Head
	=========================================*/
	$wp_customize->add_setting(
		'product_cat03_setting_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
		'product_cat03_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'product_cat3_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'product_cat03_hide_show'
		,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
		'product_cat03_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'product_cat3_setting',
		)
	);

	$wp_customize->add_setting(
		'product_cat3_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
		'product_cat3_head',
		array(
			'type' => 'hidden',
			'label' => __('Header','vf-expansion'),
			'section' => 'product_cat3_setting',
		)
	);
	
	// Title // 
	$wp_customize->add_setting(
		'product_cat3_title',
		array(
			'default'			=> __('Weekly Categories','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 1,
		)
	);	
	
	$wp_customize->add_control( 
		'product_cat3_title',
		array(
			'label'   => __('Title','vf-expansion'),
			'section' => 'product_cat3_setting',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	Content Head
	=========================================*/
	$wp_customize->add_setting(
		'product_cat3_content_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);
	
	$wp_customize->add_control(
		'product_cat3_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Product Category','vf-expansion'),
			'section' => 'product_cat3_setting',
		)
	);
	
	// Category
	if(class_exists( 'woocommerce' )): 
		$wp_customize->add_setting(
			'product_cat03_id',
			array(
				'capability' => 'edit_theme_options',
				'priority' => 5,
			)
		);	
		$wp_customize->add_control( new Vf_Expansion_Product_Cat_Control( $wp_customize, 
			'product_cat03_id', 
			array(
				'label'   => __('Select category','vf-expansion'),
				'section' => 'product_cat3_setting',
			) 
		) );
	endif;

	// column // 
	$wp_customize->add_setting(
		'product_cat3_column',
		array(
			'default'			=> '3',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_select',
			'priority' => 6,
		)
	);	

	$wp_customize->add_control(
		'product_cat3_column',
		array(
			'label'   		=> __('Column','vf-expansion'),
			'section' 		=> 'product_cat3_setting',
			'type'			=> 'select',
			'choices'        => 
			array(
				'6' => __( '2 column', 'vf-expansion' ),
				'4' => __( '3 column', 'vf-expansion' ),
				'3' => __( '4 column', 'vf-expansion' ),
			) 
		) 
	);	
}
add_action( 'customize_register', 'qstore_product_cat3_setting' );


// selective refresh
function qstore_product_cat3_section_partials( $wp_customize ){	
	// product_cat3_title
	$wp_customize->selective_refresh->add_partial( 'product_cat3_title', array(
		'selector'            => '.vf-product-cat3 .heading-default h3',
		'settings'            => 'product_cat3_title',
		'render_callback'  => 'qstore_product_cat3_title_render_callback',
	) );
}

add_action( 'customize_register', 'qstore_product_cat3_section_partials' );

// product_cat3_title
function qstore_product_cat3_title_render_callback() {
	return get_theme_mod( 'product_cat3_title' );
}