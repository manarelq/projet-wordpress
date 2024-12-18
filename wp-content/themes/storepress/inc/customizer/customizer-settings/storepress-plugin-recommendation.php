<?php
/* Notifications in customizer */
require get_template_directory() . '/inc/customizer/customizer-settings/storepress-customizer-notify.php';
$storepress_config_customizer = array(
	'recommended_plugins'       => array(
		'woocommerce' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>WooCommerce</strong> plugin for taking full advantage of all the features this theme has to offer.', 'storepress')),
		),
		'vf-expansion' => array(
			'recommended' => true,
			'description' => sprintf(__('Install and activate <strong>Vf Expansion</strong> plugin for taking full advantage of all the features this theme has to offer.', 'storepress')),
		)
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'storepress' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'storepress' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'storepress' ),
	'activate_button_label'     => esc_html__( 'Activate', 'storepress' ),
	'storepress_deactivate_button_label'   => esc_html__( 'Deactivate', 'storepress' ),
);
StorePress_Customizer_Notify::init( apply_filters( 'storepress_customizer_notify_array', $storepress_config_customizer ) );



class storepress_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof storepress_import_dummy_data ) ) {
			self::$instance = new storepress_import_dummy_data;
			self::$instance->storepress_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function storepress_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'storepress_import_customize_scripts' ), 0 );

	}
	
	

	public function storepress_import_customize_scripts() {

	wp_enqueue_script( 'storepress-import-customizer-js', get_template_directory_uri() . '/inc/customizer/assets/js/import-customizer.js', array( 'customize-controls' ) );
	}
}

$storepress_import_customizers = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
storepress_import_dummy_data::init( apply_filters( 'storepress_import_customizer', $storepress_import_customizers ) );