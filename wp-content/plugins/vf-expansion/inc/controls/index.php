<?php
/**
 * Vf Expansion Theme Customizer Controls.
 *
 * @package     Vf Expansion
 * @since       Vf Expansion 1.0
 */

$vf_expansion_control_dir =  VF_EXPANSION_PLUGIN_DIR . 'inc/controls';

require $vf_expansion_control_dir . '/range-slider-control.php';
if(class_exists( 'woocommerce' )):
	require $vf_expansion_control_dir . '/product-cat-control.php';
endif;
if ( ! class_exists( 'Vf_Expansion__Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0
	 */
	class Vf_Expansion__Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_register',                      array( $this, 'vf_expansion_customizer_register' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function vf_expansion_customizer_register( $wp_customize ) {
			
			/**
			 * Register controls
			 */
			$wp_customize->register_control_type( 'Vf_Expansion_slider_Control' );
		}

	}
}// End if().

/**
 *  Kicking this off by calling 'get_instance()' method
 */
Vf_Expansion__Customizer::get_instance();