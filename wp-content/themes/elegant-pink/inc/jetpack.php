<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Elegant_Pink
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/responsive-videos/
 */
function elegant_pink_jetpack_setup() {
	
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'elegant_pink_jetpack_setup' );