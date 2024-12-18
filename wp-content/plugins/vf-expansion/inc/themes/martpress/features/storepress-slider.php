<?php
function storepress_slider_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Slider Section Panel
	=========================================*/
	$wp_customize->add_panel(
		'storepress_frontpage2_sections', array(
			'priority' => 32,
			'title' => esc_html__( 'Frontpage', 'vf-expansion' ),
		)
	);
	
	$wp_customize->add_section(
		'slider_setting', array(
			'title' => esc_html__( 'Slider Section', 'vf-expansion' ),
			'panel' => 'storepress_frontpage2_sections',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Slider
	=========================================*/
	$wp_customize->add_setting(
		'slider_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'slider_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'slider_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'slider_setting',
		)
	);
	
	/*=========================================
	Left
	=========================================*/
	$wp_customize->add_setting(
		'slider_content_left_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'slider_content_left_head',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','vf-expansion'),
			'section' => 'slider_setting',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'slider_content_left_hs' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'slider_content_left_hs', 
		array(
			'label'	      => esc_html__( 'Hide / Show', 'vf-expansion' ),
			'section'     => 'slider_setting',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Left Content
	 */
		$wp_customize->add_setting( 'slider_left', 
			array(
			 'sanitize_callback' => 'storepress_repeater_sanitize',
			 'priority' => 2,
			  'default' => storepress_get_slider_left_content_default()
			)
		);
		
		$wp_customize->add_control( 
			new StorePress_Repeater( $wp_customize, 
				'slider_left', 
					array(
						'label'   => esc_html__('Informations','vf-expansion'),
						'section' => 'slider_setting',
						'add_field_label'                   => esc_html__( 'Add New Data', 'vf-expansion' ),
						'item_name'                         => esc_html__( 'Informations', 'vf-expansion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_subtitle2_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control'=> true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_image_control' => true,	
					) 
				) 
			);
	
	//Pro feature
		class storepress_slider_info_section_upgrade extends WP_Customize_Control {
			public function render_content() { 
			?>
				<a class="customizer_storepress_slider_info_upsale up-to-pro" href="https://vfthemes.com/themes/martpress-pro/" target="_blank" style="display: none;"><?php _e('More Information Available in MartPress Pro','vf-expansion'); ?></a>
			<?php
			} 
		}	
	
		$wp_customize->add_setting( 'storepress_info_upsale', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			'priority' => 2,
		));
		$wp_customize->add_control(
			new storepress_slider_info_section_upgrade(
			$wp_customize,
			'storepress_info_upsale',
				array(
					'section'				=> 'slider_setting',
				)
			)
		);
		
	/*=========================================
	Slider
	=========================================*/
	$wp_customize->add_setting(
		'slider_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider','vf-expansion'),
			'section' => 'slider_setting',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'slider_content_hs' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'slider_content_hs', 
		array(
			'label'	      => esc_html__( 'Hide / Show', 'vf-expansion' ),
			'section'     => 'slider_setting',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater for add slides
	 */
	
		$wp_customize->add_setting( 'slider', 
			array(
			 'sanitize_callback' => 'storepress_repeater_sanitize',
			 'priority' => 5,
			  'default' => storepress_get_slider_default()
			)
		);
		
		$wp_customize->add_control( 
			new StorePress_Repeater( $wp_customize, 
				'slider', 
					array(
						'label'   => esc_html__('Slider','vf-expansion'),
						'section' => 'slider_setting',
						'add_field_label'                   => esc_html__( 'Add New Slider', 'vf-expansion' ),
						'item_name'                         => esc_html__( 'Slider', 'vf-expansion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_subtitle2_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_text2_control'=> true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_image_control' => true,	
					) 
				) 
			);
	
	//Pro feature
		class storepress_slider_section_upgrade extends WP_Customize_Control {
			public function render_content() { 
			?>
				<a class="customizer_storepress_slider_upsale up-to-pro" href="https://vfthemes.com/themes/martpress-pro/" target="_blank" style="display: none;"><?php _e('More Slides Available in MartPress Pro','vf-expansion'); ?></a>
			<?php
			} 
		}	
	
		$wp_customize->add_setting( 'storepress_slider_upsale', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			'priority' => 5,
		));
		$wp_customize->add_control(
			new storepress_slider_section_upgrade(
			$wp_customize,
			'storepress_slider_upsale',
				array(
					'section'				=> 'slider_setting',
				)
			)
		);
		
	/*=========================================
	Right
	=========================================*/
	$wp_customize->add_setting(
		'slider_content_right_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'slider_content_right_head',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','vf-expansion'),
			'section' => 'slider_setting',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'slider_content_right_hs' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'slider_content_right_hs', 
		array(
			'label'	      => esc_html__( 'Hide / Show', 'vf-expansion' ),
			'section'     => 'slider_setting',
			'type'        => 'checkbox'
		) 
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'slider_content_right_img' , 
    	array(
			'default' 			=> esc_url(VF_EXPANSION_PLUGIN_URL .'inc/themes/martpress/assets/images/slider-info/fashion_3.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_url',	
			'priority' => 14,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'slider_content_right_img' ,
		array(
			'label'          => esc_html__( 'Image', 'vf-expansion'),
			'section'        => 'slider_setting',
		) 
	));
	
	//  Title // 
	$wp_customize->add_setting(
    	'slider_content_right_ttl',
    	array(
	        'default'			=> __('Sale up to <span class="badge bg-red">60% off</span>','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 15,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_content_right_ttl',
		array(
		    'label'   => __('Title','vf-expansion'),
		    'section' => 'slider_setting',
			'type'           => 'textarea',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'slider_content_right_subttl',
    	array(
	        'default'			=> __('Collection<br>Dress','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 16,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_content_right_subttl',
		array(
		    'label'   => __('Subtitle','vf-expansion'),
		    'section' => 'slider_setting',
			'type'           => 'textarea',
		)  
	);
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'slider_content_right_btn_lbl',
    	array(
	        'default'			=> __('Shop Now','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 17,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_content_right_btn_lbl',
		array(
		    'label'   => __('Button Label','vf-expansion'),
		    'section' => 'slider_setting',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'slider_content_right_btn_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_url',
			'priority' => 17,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_content_right_btn_link',
		array(
		    'label'   => __('Button Link','vf-expansion'),
		    'section' => 'slider_setting',
			'type'           => 'text',
		)  
	);
	
}

add_action( 'customize_register', 'storepress_slider_setting' );


// selective refresh
function storepress_slider_section_partials( $wp_customize ){	
	// slider_content_right_ttl
	$wp_customize->selective_refresh->add_partial( 'slider_content_right_ttl', array(
		'selector'            => '.home1-slider .slider-grid-row.right .slider-content p',
		'settings'            => 'slider_content_right_ttl',
		'render_callback'  => 'storepress_slider_content_right_ttl_render_callback',
	
	) );
	
	// slider_content_right_subttl
	$wp_customize->selective_refresh->add_partial( 'slider_content_right_subttl', array(
		'selector'            => '.home1-slider .slider-grid-row.right .slider-content h4',
		'settings'            => 'slider_content_right_subttl',
		'render_callback'  => 'storepress_slider_content_right_subttl_render_callback',
	
	) );
	
	// slider_content_right_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'slider_content_right_btn_lbl', array(
		'selector'            => '.home1-slider .slider-grid-row.right .slider-content .btn',
		'settings'            => 'slider_content_right_btn_lbl',
		'render_callback'  => 'storepress_slider_content_right_btn_lbl_render_callback',
	
	) );
	
	}

add_action( 'customize_register', 'storepress_slider_section_partials' );

// slider_content_right_ttl
function storepress_slider_content_right_ttl_render_callback() {
	return get_theme_mod( 'slider_content_right_ttl' );
}

// slider_content_right_subttl
function storepress_slider_content_right_subttl_render_callback() {
	return get_theme_mod( 'slider_content_right_subttl' );
}

// slider_content_right_btn_lbl
function storepress_slider_content_right_btn_lbl_render_callback() {
	return get_theme_mod( 'slider_content_right_btn_lbl' );
}