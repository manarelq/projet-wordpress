<?php
function storepress_typography( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

	$wp_customize->add_panel(
		'storepress_typography', array(
			'priority' => 38,
			'title' => esc_html__( 'Typography', 'vf-expansion' ),
		)
	);	
	
	/*=========================================
	StorePress Typography
	=========================================*/
	$wp_customize->add_section(
        'storepress_typography',
        array(
        	'priority'      => 1,
            'title' 		=> __('Body Typography','vf-expansion'),
			'panel'  		=> 'storepress_typography',
		)
    );
	
	
	// Body Font Size // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'storepress_body_font_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'storepress_body_font_size', 
			array(
				'label'      => __( 'Size', 'vf-expansion' ),
				'section'  => 'storepress_typography',
				'priority'      => 2,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                    'desktop' => array(
                        'min'           => 0,
                        'max'           => 50,
                        'step'          => 1,
                        'default_value' => 16,
                    ),
                ),
			) ) 
		);
	}
	
	// Body Font Size // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'storepress_body_line_height',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'storepress_body_line_height', 
			array(
				'label'      => __( 'Line Height', 'vf-expansion' ),
				'section'  => 'storepress_typography',
				'priority'      => 3,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
				)	
			) ) 
		);
	}
	
	// Body Font Size // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'storepress_body_ltr_space',
			array(
                'default'           => '0.1',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'storepress_body_ltr_space', 
			array(
				'label'      => __( 'Letter Spacing', 'vf-expansion' ),
				'section'  => 'storepress_typography',
				'priority'      => 4,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'tablet'  => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'desktop' => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
				)	
			) ) 
		);
	}
	
	// Body Font weight // 
	 $wp_customize->add_setting( 'storepress_body_font_weight', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'storepress_body_font_weight', array(
            'label'       => __( 'Weight', 'vf-expansion' ),
            'section'     => 'storepress_typography',
            'type'        =>  'select',
            'priority'    => 5,
            'choices'     =>  array(
                'inherit'   =>  __( 'Default', 'vf-expansion' ),
                '100'       =>  __( 'Thin: 100', 'vf-expansion' ),
                '200'       =>  __( 'Light: 200', 'vf-expansion' ),
                '300'       =>  __( 'Book: 300', 'vf-expansion' ),
                '400'       =>  __( 'Normal: 400', 'vf-expansion' ),
                '500'       =>  __( 'Medium: 500', 'vf-expansion' ),
                '600'       =>  __( 'Semibold: 600', 'vf-expansion' ),
                '700'       =>  __( 'Bold: 700', 'vf-expansion' ),
                '800'       =>  __( 'Extra Bold: 800', 'vf-expansion' ),
                '900'       =>  __( 'Black: 900', 'vf-expansion' ),
                ),
            )
        )
    );
	
	// Body Font style // 
	 $wp_customize->add_setting( 'storepress_body_font_style', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'storepress_body_font_style', array(
            'label'       => __( 'Font Style', 'vf-expansion' ),
            'section'     => 'storepress_typography',
            'type'        =>  'select',
            'priority'    => 6,
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'vf-expansion' ),
                'normal'       =>  __( 'Normal', 'vf-expansion' ),
                'italic'       =>  __( 'Italic', 'vf-expansion' ),
                'oblique'       =>  __( 'oblique', 'vf-expansion' ),
                ),
            )
        )
    );
	// Body Text Transform // 
	 $wp_customize->add_setting( 'storepress_body_text_transform', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'storepress_body_text_transform', array(
                'label'       => __( 'Transform', 'vf-expansion' ),
                'section'     => 'storepress_typography',
                'type'        => 'select',
                'priority'    => 7,
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'vf-expansion' ),
                    'uppercase'     =>  __( 'Uppercase', 'vf-expansion' ),
                    'lowercase'     =>  __( 'Lowercase', 'vf-expansion' ),
                    'capitalize'    =>  __( 'Capitalize', 'vf-expansion' ),
                ),
            )
        )
    );
	
	// Body Text Decoration // 
	 $wp_customize->add_setting( 'storepress_body_txt_decoration', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'storepress_body_txt_decoration', array(
                'label'       => __( 'Text Decoration', 'vf-expansion' ),
                'section'     => 'storepress_typography',
                'type'        => 'select',
                'priority'    => 8,
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'vf-expansion' ),
                    'underline'     =>  __( 'Underline', 'vf-expansion' ),
                    'overline'     =>  __( 'Overline', 'vf-expansion' ),
                    'line-through'    =>  __( 'Line Through', 'vf-expansion' ),
					'none'    =>  __( 'None', 'vf-expansion' ),
                ),
            )
        )
    );
	/*=========================================
	 StorePress Typography Headings
	=========================================*/
	$wp_customize->add_section(
        'storepress_headings_typography',
        array(
        	'priority'      => 2,
            'title' 		=> __('Headings','vf-expansion'),
			'panel'  		=> 'storepress_typography',
		)
    );
	
	/*=========================================
	 StorePress Typography H1
	=========================================*/
	for ( $i = 1; $i <= 6; $i++ ) {
	if($i  == '1'){$j=36;}elseif($i  == '2'){$j=32;}elseif($i  == '3'){$j=28;}elseif($i  == '4'){$j=24;}elseif($i  == '5'){$j=20;}else{$j=16;}
	$wp_customize->add_setting(
		'h' . $i . '_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'h' . $i . '_typography',
		array(
			'type' => 'hidden',
			'label' => esc_html('H' . $i .'','vf-expansion'),
			'section' => 'storepress_headings_typography',
		)
	);
	

	// Heading Font Size // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'storepress_h' . $i . '_font_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'storepress_h' . $i . '_font_size', 
			array(
				'label'      => __( 'Font Size', 'vf-expansion' ),
				'section'  => 'storepress_headings_typography',
				'media_query'   => true,
				'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => $j,
                    ),
                    'tablet'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => $j,
                    ),
                    'desktop' => array(
                       'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
					    'default_value' => $j,
                    ),
				)	
			) ) 
		);
	}
	
	// Heading Font Size // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'storepress_h' . $i . '_line_height',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'storepress_h' . $i . '_line_height', 
			array(
				'label'      => __( 'Line Height', 'vf-expansion' ),
				'section'  => 'storepress_headings_typography',
				'media_query'   => true,
				'input_attrs' => array(
					'min'    => 0,
					'max'    => 5,
					'step'   => 0.1,
					//'suffix' => 'px', //optional suffix
				),
				 'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
				)	
			) ) 
		);
		}
	// Heading Letter Spacing // 
	if ( class_exists( 'Vf_Expansion_slider_Control' ) ) {
		$wp_customize->add_setting(
			'storepress_h' . $i . '_ltr_spacing',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'vf_expansion_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Vf_Expansion_slider_Control( $wp_customize, 'storepress_h' . $i . '_ltr_spacing', 
			array(
				'label'      => __( 'Letter Spacing', 'vf-expansion' ),
				'section'  => 'storepress_headings_typography',
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
                    'tablet'  => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
                    'desktop' => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
				)	
			) ) 
		);
	}
	
	// Heading Font weight // 
	 $wp_customize->add_setting( 'storepress_h' . $i . '_font_weight', array(
		  'capability'        => 'edit_theme_options',
		  'default'           => '700',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'storepress_sanitize_select',
		) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'storepress_h' . $i . '_font_weight', array(
            'label'       => __( 'Font Weight', 'vf-expansion' ),
            'section'     => 'storepress_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'vf-expansion' ),
                '100'       =>  __( 'Thin: 100', 'vf-expansion' ),
                '200'       =>  __( 'Light: 200', 'vf-expansion' ),
                '300'       =>  __( 'Book: 300', 'vf-expansion' ),
                '400'       =>  __( 'Normal: 400', 'vf-expansion' ),
                '500'       =>  __( 'Medium: 500', 'vf-expansion' ),
                '600'       =>  __( 'Semibold: 600', 'vf-expansion' ),
                '700'       =>  __( 'Bold: 700', 'vf-expansion' ),
                '800'       =>  __( 'Extra Bold: 800', 'vf-expansion' ),
                '900'       =>  __( 'Black: 900', 'vf-expansion' ),
                ),
            )
        )
    );
	
	// Heading Font style // 
	 $wp_customize->add_setting( 'storepress_h' . $i . '_font_style', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'storepress_h' . $i . '_font_style', array(
            'label'       => __( 'Font Style', 'vf-expansion' ),
            'section'     => 'storepress_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'vf-expansion' ),
                'normal'       =>  __( 'Normal', 'vf-expansion' ),
                'italic'       =>  __( 'Italic', 'vf-expansion' ),
                'oblique'       =>  __( 'oblique', 'vf-expansion' ),
                ),
            )
        )
    );
	
	// Heading Text Transform // 
	 $wp_customize->add_setting( 'storepress_h' . $i . '_text_transform', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'storepress_h' . $i . '_text_transform', array(
                'label'       => __( 'Text Transform', 'vf-expansion' ),
                'section'     => 'storepress_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'vf-expansion' ),
                    'uppercase'     =>  __( 'Uppercase', 'vf-expansion' ),
                    'lowercase'     =>  __( 'Lowercase', 'vf-expansion' ),
                    'capitalize'    =>  __( 'Capitalize', 'vf-expansion' ),
                ),
            )
        )
    );
	
	// Heading Text Decoration // 
	 $wp_customize->add_setting( 'storepress_h' . $i . '_text_decoration', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'storepress_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'storepress_h' . $i . '_text_decoration', array(
                'label'       => __( 'Text Decoration', 'vf-expansion' ),
                'section'     => 'storepress_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'vf-expansion' ),
                    'underline'     =>  __( 'Underline', 'vf-expansion' ),
                    'overline'     =>  __( 'Overline', 'vf-expansion' ),
                    'line-through'    =>  __( 'Line Through', 'vf-expansion' ),
					'none'    =>  __( 'None', 'vf-expansion' ),
                ),
            )
        )
    );
}
}
add_action( 'customize_register', 'storepress_typography' );