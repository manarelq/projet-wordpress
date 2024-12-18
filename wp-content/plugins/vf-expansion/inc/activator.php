<?php
/**
 * Fired during plugin activation
 *
 * @package    VF Expansion
 */

/**
 * This class defines all code necessary to run during the plugin's activation.
 *
 */
class Vf_Expansion_Activator {

	public static function activate() {

        $item_details_page = get_option('item_details_page'); 
		$vf_expansion_current_theme = wp_get_theme(); // gets the current theme
		if(!$item_details_page){
			if ( 'StorePress' == $vf_expansion_current_theme->name  || 'MartPress' == $vf_expansion_current_theme->name || 'Qstore' == $vf_expansion_current_theme->name){
				require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/pages-widget/media.php';
				require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/pages-widget/homepage.php';
				require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/pages-widget/widget.php';
				require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/pages-widget/post.php';
			}
			
			update_option( 'item_details_page', 'Done' );
		}
	}

}