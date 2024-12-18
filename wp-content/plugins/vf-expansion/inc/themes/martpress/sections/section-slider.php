<?php  
if ( ! function_exists( 'vf_expansion_martpress_slider_section' ) ) :
	function vf_expansion_martpress_slider_section() {
	$slider_hide_show						= get_theme_mod('slider_hide_show','1');	
	$slider_content_left_hs 				= get_theme_mod('slider_content_left_hs','1');
	$slider_left							= get_theme_mod('slider_left',storepress_get_slider_left_content_default()); 
	$slider_content_hs						= get_theme_mod('slider_content_hs','1');
	$slider									= get_theme_mod('slider',storepress_get_slider_default());
	$slider_content_right_hs				= get_theme_mod('slider_content_right_hs','1');
	$slider_content_right_img				= get_theme_mod('slider_content_right_img',esc_url(VF_EXPANSION_PLUGIN_URL .'inc/themes/martpress/assets/images/slider-info/fashion_3.jpg'));
	$slider_content_right_ttl				= get_theme_mod('slider_content_right_ttl','Sale up to <span class="badge bg-red">60% off</span>');
	$slider_content_right_subttl			= get_theme_mod('slider_content_right_subttl','Collection<br>Dress');
	$slider_content_right_btn_lbl			= get_theme_mod('slider_content_right_btn_lbl','Shop Now');
	$slider_content_right_btn_link			= get_theme_mod('slider_content_right_btn_link','#');
	if($slider_hide_show=='1'):
?>		
<div id="vf-slider-section" class="vf-slider-section home1-slider">
	<div class="container">
		<div class="row g-3">
			<?php if($slider_content_left_hs=='1'): ?>
				<div class="col-lg-3 col-12">
					<div class="row gy-3 slider-grid-row">
						<?php
							if ( ! empty( $slider_left ) ) {
							$slider_left = json_decode( $slider_left );
							foreach ( $slider_left as $item ) {
								$title = ! empty( $item->title ) ? apply_filters( 'storepress_translate_single_string', $item->title, 'slider section' ) : '';
								$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle, 'slider section' ) : '';
								$subtitle2 = ! empty( $item->subtitle2 ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle2, 'slider section' ) : '';
								$text = ! empty( $item->text ) ? apply_filters( 'storepress_translate_single_string', $item->text, 'slider section' ) : '';
								$button = ! empty( $item->text2) ? apply_filters( 'storepress_translate_single_string', $item->text2,'slider section' ) : '';
								$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'slider section' ) : '';
								$image = ! empty( $item->image_url ) ? apply_filters( 'storepress_translate_single_string', $item->image_url, 'slider section' ) : '';
						?>
							<div class="col-lg-12 col-sm-6">
								<aside class="slider-grid">
									<?php if(!empty($image)): ?>
										<img src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
									<?php endif; ?>	
									<div class="slider-info">
										<div class="slider-content">
											<?php if(!empty($title)  || !empty($subtitle)): ?>
												<h6><?php echo esc_html( $title ); ?> <span class="badge bg-red"><?php echo esc_html( $subtitle ); ?></span></h6>
											<?php endif; ?>
											
											<?php if(!empty($subtitle2)  || !empty($text)): ?>
												<h4><?php echo esc_html( $subtitle2 ); ?><br><?php echo esc_html( $text ); ?></h4>
											<?php endif; ?>
											
											<?php if(!empty($button)): ?>
												<a href="<?php echo esc_url( $link ); ?>" class="btn btn-primary"><?php echo esc_html( $button ); ?></a>
											<?php endif; ?>
										</div>
									</div>
								</aside>
							</div>
						<?php } } ?>
					</div>
				</div>
			<?php endif; ?>	
			<?php if($slider_content_left_hs=='1' && $slider_content_right_hs=='1'): 
					$column='6';
				elseif($slider_content_left_hs=='1' || $slider_content_right_hs=='1'):
					$column='9';
				else:
					$column='12';
				endif;	
			?>
			<div class="col-lg-<?php echo esc_attr($column); ?> col-12">
				<?php if($slider_content_hs=='1'): ?>
					<div class="slider-area">
						<div class="home-slider owl-carousel owl-theme">
							<?php
								if ( ! empty( $slider ) ) {
								$slider = json_decode( $slider );
								foreach ( $slider as $item ) {
									$title = ! empty( $item->title ) ? apply_filters( 'storepress_translate_single_string', $item->title, 'slider section' ) : '';
									$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle, 'slider section' ) : '';
									$subtitle2 = ! empty( $item->subtitle2 ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle2, 'slider section' ) : '';
									$text = ! empty( $item->text ) ? apply_filters( 'storepress_translate_single_string', $item->text, 'slider section' ) : '';
									$button = ! empty( $item->text2) ? apply_filters( 'storepress_translate_single_string', $item->text2,'slider section' ) : '';
									$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'slider section' ) : '';
									$image = ! empty( $item->image_url ) ? apply_filters( 'storepress_translate_single_string', $item->image_url, 'slider section' ) : '';
							?>
								<div class="item">
									<?php if(!empty($image)): ?>
										<img src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
									<?php endif; ?>	
									<div class="main-slider">
										<div class="main-table">
											<div class="main-table-cell">
												<div class="container">
													<div class="main-content text-left">
														<?php if(!empty($title)  || !empty($subtitle)): ?>
															<h6 data-animation="fadeInUp" data-delay="150ms"><?php echo esc_html( $title ); ?> <span class="price"><?php echo esc_html( $subtitle ); ?></span></h6>
														<?php endif; ?>	
														
														<?php if(!empty($subtitle2)): ?>
															<h5 data-animation="fadeInUp" data-delay="200ms"><?php echo esc_html( $subtitle2 ); ?></h5>
														<?php endif; ?>	
														
														<?php if(!empty($text)): ?>
															<h2 data-animation="fadeInUp" data-delay="500ms"><?php echo esc_html( $text ); ?></h2>
														<?php endif; ?>	
														
														<?php if(!empty($button)): ?>
															<a data-animation="fadeIn" data-delay="800ms" href="<?php echo esc_url( $link ); ?>" class="btn btn-white"><?php echo esc_html( $button ); ?></a>
														<?php endif; ?>		
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } } ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php if($slider_content_right_hs=='1'): ?>
				<div class="col-lg-3 col-12">
					<div class="row gy-3 slider-grid-row right">
						<div class="col-lg-12 col-12">
							<aside class="slider-grid single">
								<?php if(!empty($slider_content_right_img)): ?>
									<img src="<?php echo esc_url( $slider_content_right_img ); ?>" />
								<?php endif; ?>
								<div class="slider-info">
									<div class="slider-content">
										<?php if(!empty($slider_content_right_ttl)): ?>
											<p><?php echo wp_kses_post( $slider_content_right_ttl ); ?></p>
										<?php endif; ?>
										
										<?php if(!empty($slider_content_right_subttl)): ?>
											<h4><?php echo wp_kses_post( $slider_content_right_subttl ); ?></h4>
										<?php endif; ?>
										
										<?php if(!empty($slider_content_right_btn_lbl)): ?>
											<a href="<?php echo esc_url( $slider_content_right_btn_link ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $slider_content_right_btn_lbl ); ?></a>
										<?php endif; ?>	
									</div>
								</div>
							</aside>
						</div>
					</div>
				</div>
			<?php endif; ?>	
		</div>
	</div>
</div>
<?php
endif; }endif;
if ( function_exists( 'vf_expansion_martpress_slider_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 11, 'vf_expansion_martpress_slider_section' );
add_action( 'storepress_sections', 'vf_expansion_martpress_slider_section', absint( $section_priority ) );
}
?>