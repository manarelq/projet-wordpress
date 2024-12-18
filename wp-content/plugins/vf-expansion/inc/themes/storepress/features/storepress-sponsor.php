<?php
function storepress_sponsor2_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Sponsor  Section
	=========================================*/
	$wp_customize->add_section(
		'sponsor2_setting', array(
			'title' => esc_html__( 'Sponsor Section', 'vf-expansion' ),
			'priority' => 15,
			'panel' => 'storepress_frontpage2_sections',
		)
	);
	
	$wp_customize->add_setting(
		'sponsor2_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'sponsor2_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','vf-expansion'),
			'section' => 'sponsor2_setting',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'sponsor2_hide_show'
			,array(
			'default'     	=> '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'sponsor2_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide / Show','vf-expansion'),
			'section' => 'sponsor2_setting',
		)
	);
	
	// Sponsor content Section // 
	$wp_customize->add_setting(
		'sponsor2_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'storepress_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'sponsor2_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','vf-expansion'),
			'section' => 'sponsor2_setting',
		)
	);
	
	
	/**
	 * Customizer Repeater for add slides
	 */
	
		$wp_customize->add_setting( 'sponsor2_content', 
			array(
			 'sanitize_callback' => 'storepress_repeater_sanitize',
			 'priority' => 7,
			  'default' => storepress_get_sponsor2_default()
			)
		);
		
		$wp_customize->add_control( 
			new StorePress_Repeater( $wp_customize, 
				'sponsor2_content', 
					array(
						'label'   => esc_html__('Sponsor','vf-expansion'),
						'section' => 'sponsor2_setting',
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
				<a class="customizer_storepress_sponsor_upsale up-to-pro" href="https://vfthemes.com/themes/storepress-pro/" target="_blank" style="display: none;"><?php _e('More Sponsor Available in StorePress Pro','vf-expansion'); ?></a>
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
					'section'				=> 'sponsor2_setting',
				)
			)
		);
		
}
add_action( 'customize_register', 'storepress_sponsor2_setting' );