<?php
/*
Plugin Name: Vf Expansion
Description: This is a plugin created for Vf themes. This plugin provides additional frontpage sections for Vf Themes.
Version: 1.0.5
Author: vfthemes
Text Domain: vf-expansion
Requires PHP: 5.6
*/
define( 'VF_EXPANSION_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'VF_EXPANSION_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function vf_expansion_activate() {
	
	/**
	 * Custom control
	 */
	 require_once('inc/controls/index.php');
	
	/**
	 *  Theme
	 */
	 require_once('inc/activate-themes.php');
		
	}
add_action( 'init', 'vf_expansion_activate' );

/**
 * The code during plugin activation.
 */
function vf_expansion_activates() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/activator.php';
	Vf_Expansion_Activator::activate();
}
register_activation_hook( __FILE__, 'vf_expansion_activates' );