<?php
$vf_expansion_current_theme = wp_get_theme(); // gets the current theme
	
if( 'StorePress' == $vf_expansion_current_theme->name){
	require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/storepress/storepress.php';
}

if( 'MartPress' == $vf_expansion_current_theme->name){
	require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/martpress/martpress.php';
}

if('Qstore' == $vf_expansion_current_theme->name){
	require VF_EXPANSION_PLUGIN_DIR . 'inc/themes/qstore/qstore.php';
}

