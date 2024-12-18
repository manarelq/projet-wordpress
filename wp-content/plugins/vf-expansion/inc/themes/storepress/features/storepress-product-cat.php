<?php
function storepress_product_cat2_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Product Category
	=========================================*/
	$wp_customize->add_section(
		'product_cat2_setting', array(
			'title' => esc_html__( 'Product Category Section', 'vf-expansion' ),
			'panel' => 'storepress_frontpage2_sections',
			'priority' => 2,
		)
	);
	
	/*=========================================
	Head
	=========================================*/
	$wp_customize->add_setting(
		'product_cat2_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat2_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'product_cat2_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'product_cat2_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat2_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'product_cat2_setting',
		)
	);
	
	$wp_customize->add_setting(
		'product_cat2_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat2_head',
		array(
			'type' => 'hidden',
			'label' => __('Header','vf-expansion'),
			'section' => 'product_cat2_setting',
		)
	);
	
	
	// Title // 
	$wp_customize->add_setting(
    	'product_cat2_title',
    	array(
	        'default'			=> __('Weekly Categories','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 1,
		)
	);	
	
	$wp_customize->add_control( 
		'product_cat2_title',
		array(
		    'label'   => __('Title','vf-expansion'),
		    'section' => 'product_cat2_setting',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	Content Head
	=========================================*/
	$wp_customize->add_setting(
		'product_cat2_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat2_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Product Category','vf-expansion'),
			'section' => 'product_cat2_setting',
		)
	);
	
	
	// Category
	if(class_exists( 'woocommerce' )): 
		$wp_customize->add_setting(
		'product_cat2_id',
			array(
			'capability' => 'edit_theme_options',
			'priority' => 5,
			)
		);	
		$wp_customize->add_control( new Vf_Expansion_Product_Cat_Control( $wp_customize, 
		'product_cat2_id', 
			array(
			'label'   => __('Select category','vf-expansion'),
			'section' => 'product_cat2_setting',
			) 
		) );
	endif;
	
}
add_action( 'customize_register', 'storepress_product_cat2_setting' );


// selective refresh
function storepress_product_cat2_section_partials( $wp_customize ){	
	// product_cat2_title
	$wp_customize->selective_refresh->add_partial( 'product_cat2_title', array(
		'selector'            => '.vfh2-pcat .heading-default h3',
		'settings'            => 'product_cat2_title',
		'render_callback'  => 'storepress_product_cat2_title_render_callback',
	) );
	}

add_action( 'customize_register', 'storepress_product_cat2_section_partials' );

// product_cat2_title
function storepress_product_cat2_title_render_callback() {
	return get_theme_mod( 'product_cat2_title' );
}