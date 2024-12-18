<?php
if( ! function_exists( 'storepress_dynamic_style' ) ):
    function storepress_dynamic_style() {

		$storepress_output_css = '';
		/**
		 *  Breadcrumb Style
		 */
		$breadcrumb_overlay_color	= get_theme_mod('breadcrumb_overlay_color','#201c30');
			$storepress_output_css .=".breadcrumb-section .breadcrumb-shapes {
					background-color: " .esc_attr($breadcrumb_overlay_color). ";
				}\n";
		 
		 
        wp_add_inline_style( 'storepress-style', $storepress_output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'storepress_dynamic_style' );