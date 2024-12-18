<?php  
	if ( ! function_exists( 'vf_expansion_storepress_slider_section' ) ) :
	function vf_expansion_storepress_slider_section() {
    $slider2_hide_show	= get_theme_mod('slider2_hide_show','1');
	$slider	= get_theme_mod('slider2',storepress_get_slider2_default());	
	if($slider2_hide_show=='1'):
?>	
<div id="vf-slider-section" class="vf-slider-section">
	<div class="slider-area">
		<div class="home-slider owl-carousel owl-theme">
			<?php
				if ( ! empty( $slider ) ) {
				$slider = json_decode( $slider );
				foreach ( $slider as $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'storepress_translate_single_string', $item->title, 'slider 2 section' ) : '';
					$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle, 'slider 2 section' ) : '';
					$subtitle2 = ! empty( $item->subtitle2 ) ? apply_filters( 'storepress_translate_single_string', $item->subtitle2, 'slider 2 section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'storepress_translate_single_string', $item->text, 'slider 2 section' ) : '';
					$button = ! empty( $item->text2) ? apply_filters( 'storepress_translate_single_string', $item->text2,'slider 2 section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'slider 2 section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'storepress_translate_single_string', $item->image_url, 'slider 2 section' ) : '';
			?>
			<div class="item">                        
				<div class="main-slider">
					<div class="main-table">
						<div class="main-table-cell">
							<div class="container">
								<div class="row">
									<div class="col-lg-7 col-12">
										<div class="main-content text-left">
											<?php if(!empty($title)): ?>
												<h6 data-animation="fadeInUp" data-delay="100ms"><?php echo esc_html( $title ); ?></h6>
											<?php endif; ?>	
											
											<?php if(!empty($subtitle)): ?>
												<h5 data-animation="fadeInUp" data-delay="300ms"><?php echo esc_html( $subtitle ); ?></h5>
											<?php endif; ?>	
											
											<?php if(!empty($subtitle2)): ?>
												<h2 data-animation="fadeInUp" data-delay="500ms"><?php echo esc_html( $subtitle2 ); ?></h2>
											<?php endif; ?>	
											
											<?php if(!empty($text)): ?>
												<p data-animation="fadeInUp" data-delay="700ms"><?php echo esc_html( $text ); ?></p>
											<?php endif; ?>	
											
											<?php if(!empty($button)): ?>
												<a data-animation="fadeIn" data-delay="900ms" href="<?php echo esc_url( $link ); ?>" class="btn btn-secondary"><?php echo esc_html( $button ); ?></a>
											<?php endif; ?>		
										</div>
									</div>
									<div class="col-lg-5 col-12 mt-auto">
										<div class="main-slider-img">
											<?php if(!empty($image)): ?>
												<img src="<?php echo esc_url( $image ); ?>" data-img-url="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
											<?php endif; ?>	
										</div>
									</div>
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
endif; }
endif;
if ( function_exists( 'vf_expansion_storepress_slider_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 11, 'vf_expansion_storepress_slider_section' );
add_action( 'storepress_sections', 'vf_expansion_storepress_slider_section', absint( $section_priority ) );
}
?>