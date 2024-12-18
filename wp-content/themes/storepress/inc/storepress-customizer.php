<?php
/**
 * StorePress Site Customizer.
 */
 if ( ! class_exists( 'StorePress_Customizer' ) ) {
	class StorePress_Customizer {

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
		 * Construct
		 */
		public function __construct() {
			add_action( 'customize_preview_init',                  array( $this, 'storepress_customize_preview_js' ) );
			add_action( 'customize_register',                      array( $this, 'storepress_customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'storepress_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 */
		function storepress_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';			
			
			
			/**
			 * Helper files
			 */
			require STOREPRESS_PARENT_INC_DIR . '/customizer/sanitization.php';
		}
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function storepress_customize_preview_js() {
			wp_enqueue_script( 'storepress-customizer', STOREPRESS_PARENT_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}
		

		// customizer settings.
		function storepress_customizer_settings() {	
			require STOREPRESS_PARENT_INC_DIR . '/customizer/customizer-settings/storepress-plugin-recommendation.php';
			require STOREPRESS_PARENT_INC_DIR . '/customizer/customizer-settings/storepress-header.php';
			require STOREPRESS_PARENT_INC_DIR . '/customizer/customizer-settings/storepress-blog.php';
			require STOREPRESS_PARENT_INC_DIR . '/customizer/customizer-settings/storepress-footer.php';
			require STOREPRESS_PARENT_INC_DIR . '/customizer/customizer-settings/storepress-general.php';
			require STOREPRESS_PARENT_INC_DIR . '/customizer/customizer-upsale/class-customize.php';
		}

	}
}// End if().
StorePress_Customizer::get_instance();