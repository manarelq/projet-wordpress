<?php
function qstore_slider3_setting( $wp_customize ) {
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
		'slider3_setting', array(
			'title' => esc_html__( 'Slider Section', 'vf-expansion' ),
			'panel' => 'storepress_frontpage2_sections',
			'priority' => 1,
		)
	);

// slider setting
	$wp_customize->add_setting(
		'slider03_setting_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
		'slider03_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'slider3_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'slider03_hide_show'
		,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
		'slider03_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'slider3_setting',
		)
	);

	
	/*=========================================
	Slider
	=========================================*/
	$wp_customize->add_setting(
		'slider3_content_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
		'slider3_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider','vf-expansion'),
			'section' => 'slider3_setting',
		)
	);


/**
	 * Customizer Repeater for add slides
	 */
$wp_customize->add_setting( 'slider03', 
	array(
		'sanitize_callback' => 'storepress_repeater_sanitize',
		'priority' => 5,
		'default' => storepress_get_slider3_default()
	)
);

$wp_customize->add_control( 
	new StorePress_Repeater( $wp_customize, 
		'slider03', 
		array(
			'label'   => esc_html__('Slider','vf-expansion'),
			'section' => 'slider3_setting',
			'add_field_label'                   => esc_html__( 'Add New Slider', 'vf-expansion' ),
			'item_name'                         => esc_html__( 'Slider', 'vf-expansion' ),

			'customizer_repeater_title_control' => true,
			'customizer_repeater_subtitle_control' => true,
			'customizer_repeater_text_control' => true,
			'customizer_repeater_text2_control'=> true,
			'customizer_repeater_link_control' => true,
			'customizer_repeater_link2_control' => true,
			'customizer_repeater_button2_control' => true,
			'customizer_repeater_image_control' => true,	
		) 
	) 
);

//Pro feature
class qstore_slider_section_upgrade extends WP_Customize_Control {
	public function render_content() { 
		?>
		<a class="customizer_storepress_slider_upsale up-to-pro" href="https://vfthemes.com/themes/qstore-pro/" target="_blank" style="display: none;"><?php _e('More Slides Available in Qstore Pro','vf-expansion'); ?></a>
		<?php
	} 
}	

$wp_customize->add_setting( 'storepress_slider_upsale', array(
	'capability'			=> 'edit_theme_options',
	'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	'priority' => 5,
));
$wp_customize->add_control(
	new qstore_slider_section_upgrade(
		$wp_customize,
		'storepress_slider_upsale',
		array(
			'section'				=> 'slider3_setting',
		)
	)
);
}
add_action( 'customize_register', 'qstore_slider3_setting' );

// selective refresh
function qstore_slider_section_partials( $wp_customize ){	
	// slider_content
	$wp_customize->selective_refresh->add_partial( 'slider03', array(
		'selector'            => '.main-slider .main-content h5',
		'settings'            => 'slider03',
		'render_callback'  => 'qstore_slider_content_render_callback',

	) );
	
	
}

add_action( 'customize_register', 'qstore_slider_section_partials' );

// slider_content
function qstore_slider_content_render_callback() {
	return get_theme_mod( 'slider03' );
}