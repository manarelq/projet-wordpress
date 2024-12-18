<?php
/**
 * @package   MartPress
 */

require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/theme-functions.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/functions-style.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/dynamic_style.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/sections/section-top-header.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-header.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/features/storepress-slider.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/features/storepress-product-cat.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/features/storepress-product.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/features/storepress-cta.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-typography.php';

if ( ! function_exists( 'vf_expansion_storepress_frontpage_sections' ) ) :
	function vf_expansion_storepress_frontpage_sections() {	
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/sections/section-slider.php';
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/sections/section-product-cat.php';
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/sections/section-product.php';
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/sections/section-cta.php';
    }
	add_action( 'storepress_sections', 'vf_expansion_storepress_frontpage_sections' );
endif;