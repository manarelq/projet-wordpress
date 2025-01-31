<?php
$theme = wp_get_theme(); // gets the current theme


if( 'MartPress' == $theme->name){
	$file = VF_EXPANSION_PLUGIN_URL .'inc/themes/martpress/assets/images/logo.png';

}elseif( 'Qstore' == $theme->name){
	$file = VF_EXPANSION_PLUGIN_URL .'inc/themes/qstore/assets/images/logo.png';
}else{
	$file = VF_EXPANSION_PLUGIN_URL .'inc/themes/storepress/assets/images/logo_2.png';
}
$ImagePath = VF_EXPANSION_PLUGIN_URL .'inc/themes/storepress/assets/images';
$images = array(
	$file,
	$ImagePath. '/blog/post01.jpg',
	$ImagePath. '/blog/post02.jpg',
	$ImagePath. '/blog/post03.jpg',
	$ImagePath. '/product/product01.png',
	$ImagePath. '/product/product02.png',
	$ImagePath. '/product/product03.png',
	$ImagePath. '/product/product04.png'
);
$parent_post_id = null;
foreach($images as $name) {
	$filename = basename($name);
	$upload_file = wp_upload_bits($filename, null, file_get_contents($name));
	if (!$upload_file['error']) {
		$wp_filetype = wp_check_filetype($filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_parent' => $parent_post_id,
			'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
			'post_excerpt' => 'StorePress caption',
			'post_status' => 'inherit'
		);
		$ImageId[] = $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );

		if (!is_wp_error($attachment_id)) {
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
			wp_update_attachment_metadata( $attachment_id,  $attachment_data );
		}
	}

}

update_option( 'storepress_media_id', $ImageId );
