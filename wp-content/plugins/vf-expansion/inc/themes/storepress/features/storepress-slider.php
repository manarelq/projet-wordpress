<?php
function storepress_slider2_setting( $wp_customize ) {
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
		'slider2_setting', array(
			'title' => esc_html__( 'Slider Section', 'vf-expansion' ),
			'panel' => 'storepress_frontpage2_sections',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Slider
	=========================================*/
	$wp_customize->add_setting(
		'slider2_setting_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
		'slider2_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'slider2_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'slider2_hide_show'
		,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
		'slider2_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'slider2_setting',
		)
	);
	
	/*=========================================
	Slider
	=========================================*/
	$wp_customize->add_setting(
		'slider2_content_head'
		,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
		'slider2_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','vf-expansion'),
			'section' => 'slider2_setting',
		)
	);
	
	/**
	 * Customizer Repeater for add slides
	 */
	
	$wp_customize->add_setting( 'slider2', 
		array(
			'sanitize_callback' => 'storepress_repeater_sanitize',
			'priority' => 5,
			'default' => storepress_get_slider2_default()
		)
	);
	
	$wp_customize->add_control( 
		new StorePress_Repeater( $wp_customize, 
			'slider2', 
			array(
				'label'   => esc_html__('Slider Content','vf-expansion'),
				'section' => 'slider2_setting',
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
			<a class="customizer_storepress_slider_upsale up-to-pro" href="https://vfthemes.com/themes/storepress-pro/" target="_blank" style="display: none;"><?php _e('More Slides Available in StorePress Pro','vf-expansion'); ?></a>
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
				'section'				=> 'slider2_setting',
			)
		)
	);	
	
}
add_action( 'customize_register', 'storepress_slider2_setting' );