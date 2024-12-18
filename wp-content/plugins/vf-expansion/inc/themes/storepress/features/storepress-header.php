<?php
function storepress_above_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	/*=========================================
	StorePress Site Identity
	=========================================*/
	// Logo Width // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'logo_width',
			array(
				'default'			=> '140',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'logo_width', 
			array(
				'label'      => __( 'Logo Width', 'vf-expansion' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 140,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 140,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 140,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Above Header Section
	=========================================*/	
	$wp_customize->add_section(
        'above_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Above Header','vf-expansion'),
			'panel'  		=> 'header_section',
		)
    );
	
	/*=========================================
	Header Info
	=========================================*/
	$wp_customize->add_setting(
		'abv_hdr_info_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'abv_hdr_info_head',
		array(
			'type' => 'hidden',
			'label' => __('Left Info','vf-expansion'),
			'section' => 'above_header',
			'priority'  => 1,
		)
	);
	
	$wp_customize->add_setting( 
		'hs_hdr_info' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_info', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'vf-expansion' ),
			'section'     => 'above_header',
			'type'        => 'checkbox',
			'priority'  => 1,
		) 
	);
	
	// Title // 
	$wp_customize->add_setting(
    	'hdr_info_ttl',
    	array(
	        'default'			=> __('<b class="text-secondary"><i class="fa fa-tags mr-1"></i>20% Discount</b> On Selected items','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'hdr_info_ttl',
		array(
		    'label'   => __('Title','vf-expansion'),
		    'section' => 'above_header',
			'type'           => 'textarea',
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'hdr_info_link',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_url',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'hdr_info_link',
		array(
		    'label'   => __('Link','vf-expansion'),
		    'section' => 'above_header',
			'type'           => 'text',
		)  
	);
	
	
	
	/*=========================================
	Header Right Info
	=========================================*/
	$wp_customize->add_setting(
		'abv_hdr_right_info_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority'  => 4,
		)
	);

	$wp_customize->add_control(
	'abv_hdr_right_info_head',
		array(
			'type' => 'hidden',
			'label' => __('Right Info','vf-expansion'),
			'section' => 'above_header'
		)
	);
	
	$wp_customize->add_setting( 
		'hs_hdr_right_info' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority'  => 5,
		) 
	);
	
	$wp_customize->add_control(
	'hs_hdr_right_info', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'vf-expansion' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);
	
	// Info
	$wp_customize->add_setting( 'hdr_info', 
			array(
			 'sanitize_callback' => 'storepress_repeater_sanitize',
			 'transport'         => $selective_refresh,
			 'priority' => 8,
			 'default' => storepress_get_hdr_info_default()
			)
		);
		
		$wp_customize->add_control( 
			new StorePress_Repeater( $wp_customize, 
				'hdr_info', 
					array(
						'label'   => esc_html__('Information','vf-expansion'),
						'section' => 'above_header',
						'add_field_label'                   => esc_html__( 'Add New Information', 'vf-expansion' ),
						'item_name'                         => esc_html__( 'Information', 'vf-expansion' ),
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
		//Pro feature
		class storepress_info_section_upgrade extends WP_Customize_Control {
			public function render_content() { 
			$vf_expansion_current_theme = wp_get_theme(); // gets the current theme
				if( 'MartPress' == $vf_expansion_current_theme->name){
			?>
				<a class="customizer_storepress_header_info_upsale up-to-pro" href="https://vfthemes.com/themes/martpress-pro/" target="_blank" style="display: none;"><?php _e('More Info Available in MartPress Pro','vf-expansion'); ?></a>
			<?php }else{ ?>	
				<a class="customizer_storepress_header_info_upsale up-to-pro" href="https://vfthemes.com/themes/storepress-pro/" target="_blank" style="display: none;"><?php _e('More Info Available in StorePress Pro','vf-expansion'); ?></a>
			<?php
			} }
		}	
	
		$wp_customize->add_setting( 'storepress_header_info_upsale', array(
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
			'priority' => 12,
		));
		$wp_customize->add_control(
			new storepress_info_section_upgrade(
			$wp_customize,
			'storepress_header_info_upsale',
				array(
					'section'				=> 'above_header',
				)
			)
		);		
}
add_action( 'customize_register', 'storepress_above_header_settings' );


// Header selective refresh
function storepress_above_header_partials( $wp_customize ){
	// hdr_info_ttl
	$wp_customize->selective_refresh->add_partial( 'hdr_info_ttl', array(
		'selector'            => '.hdr-left-info .ttl',
		'settings'            => 'hdr_info_ttl',
		'render_callback'  => 'storepress_hdr_info_ttl_render_callback',
	) );
	
	// hdr_info
	$wp_customize->selective_refresh->add_partial( 'hdr_info', array(
		'selector'            => '.hdr-right-info ul',
	) );
	}

add_action( 'customize_register', 'storepress_above_header_partials' );



// hdr_info_ttl
function storepress_hdr_info_ttl_render_callback() {
	return get_theme_mod( 'hdr_info_ttl' );
}
