<?php
function storepress_product_cat_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Product Category
	=========================================*/
	$wp_customize->add_section(
		'product_cat_setting', array(
			'title' => esc_html__( 'Product Category Section', 'vf-expansion' ),
			'panel' => 'storepress_frontpage2_sections',
			'priority' => 2,
		)
	);
	
	/*=========================================
	Head
	=========================================*/
	
	$wp_customize->add_setting(
		'product_cat_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'product_cat_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'product_cat_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'product_cat_setting',
		)
	);
	
	$wp_customize->add_setting(
		'product_cat_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'product_cat_head',
		array(
			'type' => 'hidden',
			'label' => __('Product Category','vf-expansion'),
			'section' => 'product_cat_setting',
		)
	);
	
	// Category
	if(class_exists( 'woocommerce' )): 
		$wp_customize->add_setting(
		'product_cat_id',
			array(
			'capability' => 'edit_theme_options',
			'priority' => 5,
			)
		);	
		$wp_customize->add_control( new Vf_Expansion_Product_Cat_Control( $wp_customize, 
		'product_cat_id', 
			array(
			'label'   => __('Select category','vf-expansion'),
			'section' => 'product_cat_setting',
			) 
		) );
	endif;
	
}
add_action( 'customize_register', 'storepress_product_cat_setting' );