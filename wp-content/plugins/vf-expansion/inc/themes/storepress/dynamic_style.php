<?php
if( ! function_exists( 'storepress_dynamic_style' ) ):
    function storepress_dynamic_style() {

		$output_css = '';
		
		/**
		 * Logo Width 
		 */
		$output_css   .= storepress_customizer_value( 'logo_width', '.logo img, .mobile-logo img', array( 'max-width' ), array( 140, 140, 140 ), 'px !important' );
		
		/**
		 *  Typography Body
		 */
		 $storepress_body_font_weight	 	 = get_theme_mod('storepress_body_font_weight','inherit');
		 $storepress_body_text_transform	 = get_theme_mod('storepress_body_text_transform','inherit');
		 $storepress_body_font_style	 	 = get_theme_mod('storepress_body_font_style','inherit');
		 $storepress_body_txt_decoration	 = get_theme_mod('storepress_body_txt_decoration','none');
		
		 $output_css   .= storepress_customizer_value( 'storepress_body_font_size', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $output_css   .= storepress_customizer_value( 'storepress_body_line_height', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $output_css   .= storepress_customizer_value( 'storepress_body_ltr_space', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 $output_css .=" body{ 
			font-weight: " .esc_attr($storepress_body_font_weight). ";
			text-transform: " .esc_attr($storepress_body_text_transform). ";
			font-style: " .esc_attr($storepress_body_font_style). ";
			text-decoration: " .esc_attr($storepress_body_txt_decoration). ";
		} a {text-decoration: " .esc_attr($storepress_body_txt_decoration). ";
		}\n";

		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {	
			 $storepress_heading_font_weight	 	= get_theme_mod('storepress_h' . $i . '_font_weight','700');
			 $storepress_heading_text_transform 	= get_theme_mod('storepress_h' . $i . '_text_transform','inherit');
			 $storepress_heading_font_style	 	= get_theme_mod('storepress_h' . $i . '_font_style','inherit');
			 $storepress_heading_txt_decoration	= get_theme_mod('storepress_h' . $i . '_text_decoration','inherit');
			 
			 $output_css   .= storepress_customizer_value( 'storepress_h' . $i . '_font_size', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $output_css   .= storepress_customizer_value( 'storepress_h' . $i . '_line_height', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $output_css   .= storepress_customizer_value( 'storepress_h' . $i . '_ltr_spacing', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
			 $output_css .=" h" . $i . "{ 
				font-weight: " .esc_attr($storepress_heading_font_weight). ";
				text-transform: " .esc_attr($storepress_heading_text_transform). ";
				font-style: " .esc_attr($storepress_heading_font_style). ";
				text-decoration: " .esc_attr($storepress_heading_txt_decoration). ";
			}\n";
		 }	
		 
        wp_add_inline_style( 'storepress-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'storepress_dynamic_style' );