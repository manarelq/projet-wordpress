<?php
// Header Left Info
if ( ! function_exists( 'storepress_header_left_info' ) ) {
	function storepress_header_left_info() { 
	$hs_hdr_info		=	get_theme_mod('hs_hdr_info','1');
	$hdr_info_ttl		=	get_theme_mod('hdr_info_ttl','<b class="text-secondary"><i class="fa fa-tags mr-1"></i>20% Discount</b> On Selected items');
	$hdr_info_link		=	get_theme_mod('hdr_info_link'); 
	if($hs_hdr_info == '1'): ?>
		<aside class="widget widget_block hdr-left-info">
			<div class="textwidget">
				<?php if(!empty($hdr_info_ttl)): ?>
					<?php if(!empty($hdr_info_link)): ?>
						<p class="ttl"><a href="<?php echo esc_url($hdr_info_link); ?>"><?php echo wp_kses_post($hdr_info_ttl); ?></a></p>
					<?php else: ?>	
						<p class="ttl"><?php echo wp_kses_post($hdr_info_ttl); ?></p>
					<?php endif; ?>	
				<?php endif; ?>	
			</div>
		</aside>
	<?php endif; }
}


// Header Right Info
if ( ! function_exists( 'storepress_header_right_info' ) ) {
	function storepress_header_right_info() { 
	$hs_hdr_right_info		=	get_theme_mod('hs_hdr_right_info','1');
	$hdr_info				=	get_theme_mod('hdr_info',storepress_get_hdr_info_default());
	if($hs_hdr_right_info == '1'): ?>
		<aside class="widget widget_nav_menu hdr-right-info">
			<ul id="menu-primar-menu" class="menu">
				<?php
					if ( ! empty( $hdr_info ) ) {
					$hdr_info = json_decode( $hdr_info );
					foreach ( $hdr_info as $item ) {
						$title = ! empty( $item->title ) ? apply_filters( 'storepress_translate_single_string', $item->title, 'Header section' ) : '';
						$icon = ! empty( $item->icon_value) ? apply_filters( 'storepress_translate_single_string', $item->icon_value,'Header section' ) : '';
						$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'Header section' ) : '';
				?>
					<li class="menu-item"><a href="<?php echo esc_url($link); ?>"><i class="fa <?php echo esc_attr($icon); ?>"></i><?php echo esc_html($title); ?></a></li>
				<?php } } ?>
			</ul>
		</aside>
	<?php endif; }
}

/*
 *
 * Social Icon
 */
function storepress_get_social_icon_default() {
	return apply_filters(
		'storepress_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fa-facebook', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-twitter', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-instagram', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_header_social_004',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-skype', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_header_social_005',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fa-linkedin', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_header_social_006',
				)
			)
		)
	);
}

/*
 *
 * Header Info Default
 */
 function storepress_get_hdr_info_default() {
	return apply_filters(
		'storepress_get_hdr_info_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fa-sign-in',
					'title'           => esc_html__( 'Sign In', 'vf-expansion' ),
					'link'            => '#',
					'id'              => 'customizer_repeater_hdr_info_001',
				),
				array(
					'icon_value'       => 'fa-gift',
					'title'           => esc_html__( 'Gift Certificate', 'vf-expansion' ),
					'link'            => '#',
					'id'              => 'customizer_repeater_hdr_info_002',
				),
				array(
					'icon_value'       => 'fa-user',
					'title'           => esc_html__( 'My Account', 'vf-expansion' ),
					'link'            => '#',
					'id'              => 'customizer_repeater_hdr_info_003',
				),
			)
		)
	);
}

/*
 *
 * Slider 2 Default
 */
 function storepress_get_slider2_default() {
	return apply_filters(
		'storepress_get_slider2_default', json_encode(
				 array(
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/slider/slide_img_1.png',
					'title'           => esc_html__( '65% OFF', 'vf-expansion' ),
					'subtitle'         => esc_html__( 'Set Your Style & latest fashion', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Women Fashion', 'vf-expansion' ),
					'text'            => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non molestie nisi. Sed quis orci cursus, elementum sem at, aliquet urna. Aliquam et diam ut ex volutpat egestas sit amet et eros. In hac habitasse platea dictumst, In sed malesuada nisl.', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'button_second'	  =>  esc_html__( 'Contact us', 'vf-expansion' ),
					'link2'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider2_001',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/slider/slide_img_2.png',
					'title'           => esc_html__( '65% OFF', 'vf-expansion' ),
					'subtitle'         => esc_html__( 'Set Your Style & latest fashion', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Women Fashion', 'vf-expansion' ),
					'text'            => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non molestie nisi. Sed quis orci cursus, elementum sem at, aliquet urna. Aliquam et diam ut ex volutpat egestas sit amet et eros. In hac habitasse platea dictumst, In sed malesuada nisl.', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'button_second'	  =>  esc_html__( 'Contact us', 'vf-expansion' ),
					'link2'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider2_002',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/slider/slide_img_3.png',
					'title'           => esc_html__( '65% OFF', 'vf-expansion' ),
					'subtitle'         => esc_html__( 'Set Your Style & latest fashion', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Women Fashion', 'vf-expansion' ),
					'text'            => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non molestie nisi. Sed quis orci cursus, elementum sem at, aliquet urna. Aliquam et diam ut ex volutpat egestas sit amet et eros. In hac habitasse platea dictumst, In sed malesuada nisl.', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'button_second'	  =>  esc_html__( 'Contact us', 'vf-expansion' ),
					'link2'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider2_003',
				),
			)
		)
	);
}

/*
 *
 * Sponsor 2 Default
 */
 function storepress_get_sponsor2_default() {
	return apply_filters(
		'storepress_get_sponsor2_default', json_encode(
				 array(
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/sponsor/sponsor1.png',
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_sponsor_001',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/sponsor/sponsor2.png',
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_sponsor_002',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/sponsor/sponsor3.png',
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_sponsor_003',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/sponsor/sponsor4.png',
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_sponsor_004',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/sponsor/sponsor5.png',
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_sponsor_005',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/storepress/assets/images/sponsor/sponsor1.png',
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_sponsor_006',
				),
			)
		)
	);
}

/*
 *
 * Slider Left Default
 */
 function storepress_get_slider_left_content_default() {
	return apply_filters(
		'storepress_get_slider_left_content_default', json_encode(
				 array(
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/martpress/assets/images/slider-info/fashion_1.jpg',
					'title'           => esc_html__( 'Sale up to', 'vf-expansion' ),
					'subtitle'         => esc_html__( '40% off', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Collection', 'vf-expansion' ),
					'text'            => esc_html__( 'Dress', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider_left_001',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/martpress/assets/images/slider-info/fashion_2.jpg',
					'title'           => esc_html__( 'Sale up to', 'vf-expansion' ),
					'subtitle'         => esc_html__( '50% off', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Top Sale', 'vf-expansion' ),
					'text'            => esc_html__( '30% Off', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Read More', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider_left_002',
				)
			)
		)
	);
}

/*
 *
 * Slider Default
 */
 function storepress_get_slider_default() {
	return apply_filters(
		'storepress_get_slider_default', json_encode(
				 array(
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/martpress/assets/images/slider/slider_1.jpg',
					'title'           => esc_html__( 'Start From', 'vf-expansion' ),
					'subtitle'         => esc_html__( '$39.99', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Party Wear', 'vf-expansion' ),
					'text'            => esc_html__( 'Super Sale', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider_001',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/martpress/assets/images/slider/slider_1.jpg',
					'title'           => esc_html__( 'Start From', 'vf-expansion' ),
					'subtitle'         => esc_html__( '$39.99', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Party Wear', 'vf-expansion' ),
					'text'            => esc_html__( 'Super Sale', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider_002',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/martpress/assets/images/slider/slider_1.jpg',
					'title'           => esc_html__( 'Start From', 'vf-expansion' ),
					'subtitle'         => esc_html__( '$39.99', 'vf-expansion' ),
					'subtitle2'         => esc_html__( 'Party Wear', 'vf-expansion' ),
					'text'            => esc_html__( 'Super Sale', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider_003',
				),
			)
		)
	);
}

/*
 *
 * Slider 3 Default
 */
function storepress_get_slider3_default() {
	return apply_filters(
		'storepress_get_slider3_default', json_encode(
			array(
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/qstore/assets/images/slider/slider_01.jpg',
					'title'           => esc_html__( 'Always On Trend', 'vf-expansion' ),
					'subtitle'         => esc_html__( 'Our Latest Collection', 'vf-expansion' ),
					'text'            => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non molestie nisi. Sed quis orci cursus, elementum sem at, aliquet urna. Aliquam et diam ut ex volutpat egestas sit amet et eros. In hac habitasse platea dictumst, In sed malesuada nisl.', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Discover Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'button_second'	  =>  esc_html__( 'Contact us', 'vf-expansion' ),
					'link2'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider3_01',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/qstore/assets/images/slider/slider_02.jpg',
					'title'           => esc_html__( 'Always On Trend', 'vf-expansion' ),
					'subtitle'         => esc_html__( 'Our Latest Collection', 'vf-expansion' ),
					'text'            => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non molestie nisi. Sed quis orci cursus, elementum sem at, aliquet urna. Aliquam et diam ut ex volutpat egestas sit amet et eros. In hac habitasse platea dictumst, In sed malesuada nisl.', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Discover Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'button_second'	  =>  esc_html__( 'Contact us', 'vf-expansion' ),
					'link2'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider3_02',
				),
				array(
					'image_url'       => VF_EXPANSION_PLUGIN_URL . 'inc/themes/qstore/assets/images/slider/slider_03.jpg',
					'title'           => esc_html__( 'Always On Trend', 'vf-expansion' ),
					'subtitle'         => esc_html__( 'Our Latest Collection', 'vf-expansion' ),
					'text'            => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non molestie nisi. Sed quis orci cursus, elementum sem at, aliquet urna. Aliquam et diam ut ex volutpat egestas sit amet et eros. In hac habitasse platea dictumst, In sed malesuada nisl.', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Discover Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'text2'	  =>  esc_html__( 'Shop Now', 'vf-expansion' ),
					'link'	  =>  esc_html__( '#', 'vf-expansion' ),
					'button_second'	  =>  esc_html__( 'Contact us', 'vf-expansion' ),
					'link2'	  =>  esc_html__( '#', 'vf-expansion' ),
					'id'              => 'customizer_repeater_slider3_03',
				),
			)
		)
	);
}