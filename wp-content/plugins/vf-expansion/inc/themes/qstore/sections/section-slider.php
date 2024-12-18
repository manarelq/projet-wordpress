<?php  
if ( ! function_exists( 'vf_expansion_qstore_slider_section' ) ) :
	function vf_expansion_qstore_slider_section() {
		$slider									= get_theme_mod('slider03',storepress_get_slider3_default());
		$slider03_hide_show	                    = get_theme_mod('slider03_hide_show','1');
		if($slider03_hide_show=='1'):
		?>	
		<div id="vf-slider-section" class="vf-slider-section">
			<div class="slider-area">
				<div class="home-slider owl-carousel owl-theme">
					<?php
					if ( ! empty( $slider ) ) {
						$slider = json_decode( $slider );
						foreach ( $slider as $item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'storepress_translate_single_string', $item->title, 'slider 3 section' ) : '';
							$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle, 'slider 3 section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'storepress_translate_single_string', $item->text, 'slider 3 section' ) : '';
							$button = ! empty( $item->text2) ? apply_filters( 'storepress_translate_single_string', $item->text2,'slider 3 section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'slider 3 section' ) : '';
							$button2 = ! empty( $item->button_second) ? apply_filters( 'storepress_translate_single_string', $item->button_second,'slider 3 section' ) : '';
							$link2 = ! empty( $item->link2 ) ? apply_filters( 'storepress_translate_single_string', $item->link2, 'slider 3 section' ) : '';
							$image = ! empty( $item->image_url ) ? apply_filters( 'storepress_translate_single_string', $item->image_url, 'slider 3 section' ) : '';
							?>
							<div class="item">
								<?php if(!empty($image)): ?>
									<img src="<?php echo esc_url( $image ); ?>" data-img-url="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
								<?php endif; ?>	
								<div class="main-slider">
									<div class="main-table">
										<div class="main-table-cell">
											<div class="container">
												<div class="main-content text-center">
													<?php if(!empty($title)): ?>
														<h5 data-animation="fadeInUp" data-delay="100ms"><?php echo esc_html( $title ); ?></h5>
													<?php endif; ?>	
													
													<?php if(!empty($subtitle)): ?>
														<h2 data-animation="fadeInUp" data-delay="200ms"><?php echo esc_html( $subtitle ); ?></h2>
													<?php endif; ?>	
													
													<?php if(!empty($text)): ?>
														<p data-animation="fadeInUp" data-delay="300ms"><?php echo esc_html( $text ); ?></p>
													<?php endif; ?>	
													
													<?php if(!empty($button)): ?>
														<a data-animation="fadeIn" data-delay="400ms" href="<?php echo esc_url( $link ); ?>" class="btn btn-primary"><?php echo esc_html( $button ); ?></a>
													<?php endif; ?>	
													
													<?php if(!empty($button2)): ?>
														<a data-animation="fadeIn" data-delay="400ms" href="<?php echo esc_url( $link2 ); ?>" class="btn btn-border-primary"><?php echo esc_html( $button2 ); ?></a>
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
			</div>
			<?php
		endif; }endif;
		if ( function_exists( 'vf_expansion_qstore_slider_section' ) ) {
			$section_priority = apply_filters( 'storepress_section_priority', 11, 'vf_expansion_qstore_slider_section' );
			add_action( 'storepress_sections', 'vf_expansion_qstore_slider_section', absint( $section_priority ) );
		}
	?>