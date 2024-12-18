<?php
function qstore_sponsor3_setting( $wp_customize ) {
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Sponsor Section
	=========================================*/
	$wp_customize->add_section(
		'sponsor3_setting', array(
			'title' => esc_html__( 'Sponsor Section', 'vf-expansion' ),
			'priority' => 12,
			'panel' => 'storepress_frontpage2_sections',
		)
	);

	// Sponsor3 setting // 
	$wp_customize->add_setting(
		'sponsor3_setting_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
		'sponsor3_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'sponsor3_setting',
		)
	);

	// Hide/Show
	$wp_customize->add_setting(
		'sponsor3_hide_show'
		,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
		'sponsor3_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'sponsor3_setting',
		)
	);

	// Sponsor Header Section // 
	$wp_customize->add_setting(
		'sponsor3_headings'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
		'sponsor3_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','vf-expansion'),
			'section' => 'sponsor3_setting',
		)
	);
	
	// Sponsor Title // 
	$wp_customize->add_setting(
		'sponsor3_title',
		array(
			'default'			=> __('Sponsor','vf-expansion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'sponsor3_title',
		array(
			'label'   => __('Title','vf-expansion'),
			'section' => 'sponsor3_setting',
			'type'           => 'text',
		)  
	);

	// Sponsor content Section // 
	$wp_customize->add_setting(
		'sponsor3_content_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
		'sponsor3_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','vf-expansion'),
			'section' => 'sponsor3_setting',
		)
	);

    /**
	 * Customizer Repeater for add slides
	 */

    $wp_customize->add_setting( 'sponsor3_content', 
    	array(
    		'sanitize_callback' => 'storepress_repeater_sanitize',
    		'priority' => 7,
    		'default' => storepress_get_sponsor2_default()
    	)
    );

    $wp_customize->add_control( 
    	new StorePress_Repeater( $wp_customize, 
    		'sponsor3_content', 
    		array(
    			'label'   => esc_html__('Sponsor','vf-expansion'),
    			'section' => 'sponsor3_setting',
    			'add_field_label'                   => esc_html__( 'Add New Sponsor', 'vf-expansion' ),
    			'item_name'                         => esc_html__( 'Sponsor', 'vf-expansion' ),

    			'customizer_repeater_link_control' => true,
    			'customizer_repeater_image_control' => true,	
    		) 
    	) 
    );

   //Pro feature
    class storepress_sponsor_section_upgrade extends WP_Customize_Control {
    	public function render_content() { 
    		?>
    		<a class="customizer_storepress_sponsor_upsale up-to-pro" href="https://vfthemes.com/themes/qstore-pro/" target="_blank" style="display: none;"><?php _e('More Sponsor Available in Qstore Pro','vf-expansion'); ?></a>
    		<?php
    	} 
    }	

    $wp_customize->add_setting( 'storepress_sponsor_upsale', array(
    	'capability'			=> 'edit_theme_options',
    	'sanitize_callback'	=> 'wp_filter_nohtml_kses',
    	'priority' => 7,
    ));
    $wp_customize->add_control(
    	new storepress_sponsor_section_upgrade(
    		$wp_customize,
    		'storepress_sponsor_upsale',
    		array(
    			'section'				=> 'sponsor3_setting',
    		)
    	)
    );

	// Sponsor Right Content // 
    $wp_customize->add_setting(
    	'sponsor3_right_head'
    	,array(
    		'capability'     	=> 'edit_theme_options',
    		'sanitize_callback' => 'storepress_sanitize_text',
    		'priority' => 8,
    	)
    );

    $wp_customize->add_control(
    	'sponsor3_right_head',
    	array(
    		'type' => 'hidden',
    		'label' => __('Right Content','vf-expansion'),
    		'section' => 'sponsor3_setting',
    	)
    );

	//  Image // 
    $wp_customize->add_setting( 
    	'sponsor3_right_img' , 
    	array(
    		'default' 			=> esc_url(VF_EXPANSION_PLUGIN_URL .'inc/themes/qstore/assets/images/sponsor_playbg.jpg'),
    		'capability'     	=> 'edit_theme_options',
    		'sanitize_callback' => 'storepress_sanitize_url',	
    		'priority' => 9,
    	) 
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'sponsor3_right_img' ,
    	array(
    		'label'          => esc_html__( 'Image', 'vf-expansion'),
    		'section'        => 'sponsor3_setting',
    	) 
    ));	

	// Link // 
    $wp_customize->add_setting(
    	'sponsor3_right_link',
    	array(
    		'default'			=> '#',
    		'capability'     	=> 'edit_theme_options',
    		'sanitize_callback' => 'storepress_sanitize_url',
    		'priority' => 9,
    	)
    );	

    $wp_customize->add_control( 
    	'sponsor3_right_link',
    	array(
    		'label'   => __('Link','vf-expansion'),
    		'section' => 'sponsor3_setting',
    		'type'           => 'text',
    	)  
    );	
}

add_action( 'customize_register', 'qstore_sponsor3_setting' );

// selective refresh
function qstore_sponsor3_section_partials( $wp_customize ){	
	// sponsor3_title
	$wp_customize->selective_refresh->add_partial( 'sponsor3_title', array(
		'selector'            => '.vf-sponsor-three .heading-default h3',
		'settings'            => 'sponsor3_title',
		'render_callback'  => 'qstore_sponsor3_title_render_callback',
	) );
}

add_action( 'customize_register', 'qstore_sponsor3_section_partials' );

// sponsor3_title
function qstore_sponsor3_title_render_callback() {
	return get_theme_mod( 'sponsor3_title' );
}