<?php
/**
 * @package   StorePress
 */

require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/theme-functions.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/functions-style.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/dynamic_style.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/sections/section-top-header.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-header.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-slider.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-product-cat.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-product.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-sponsor.php';
require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/features/storepress-typography.php';

if ( ! function_exists( 'vf_expansion_storepress_frontpage_sections' ) ) :
	function vf_expansion_storepress_frontpage_sections() {	
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/sections/section-slider.php';
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/sections/section-product-cat.php';
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/sections/section-product.php';
		require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/sections/section-sponsor.php';
    }
	add_action( 'storepress_sections', 'vf_expansion_storepress_frontpage_sections' );
endif;