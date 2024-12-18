<?php  
if ( ! function_exists( 'vf_expansion_qstore_sponsor_section' ) ) :
	function vf_expansion_qstore_sponsor_section() { 
		$sponsor3_title 		= get_theme_mod('sponsor3_title','Sponsor');
		$sponsor3_right_img 	= get_theme_mod('sponsor3_right_img',esc_url(VF_EXPANSION_PLUGIN_URL .'inc/themes/qstore/assets/images/sponsor_playbg.jpg'));
		$sponsor3_right_link 	= get_theme_mod('sponsor3_right_link','#');
		$sponsor3_hide_show	  = get_theme_mod('sponsor3_hide_show','1');		
		$sponsor3_content 	      = get_theme_mod('sponsor3_content',storepress_get_sponsor2_default());
		if($sponsor3_hide_show=='1'):
			?>	
			<div id="vf-sponsor-three" class="vf-sponsor vf-sponsor-three st-py-default">
				<div class="container">
					<?php if(!empty($sponsor3_title)): ?>
						<div class="row">
							<div class="col-lg-12 col-12 mx-lg-auto mb-5 text-center">
								<div class="heading-default wow fadeInUp">
									<div class="title">
										<h3><?php echo wp_kses_post($sponsor3_title); ?></h3>
										<?php do_action('storepress_section_seprator2'); ?>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="row g-0 align-items-center h-100">
						<div class="col-lg-6 col-12 sponsor-col">
							<div class="row g-0 h-100">
								<?php
								if ( ! empty( $sponsor3_content ) ) {
									$sponsor3_content = json_decode( $sponsor3_content );
									foreach ( $sponsor3_content as $item ) {
										$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'Sponsor 2 section' ) : '';
										$image = ! empty( $item->image_url ) ? apply_filters( 'storepress_translate_single_string', $item->image_url, 'Sponsor 2 section' ) : '';
										?>
										<div class="col-lg-4 col-sm-4 col-12">
											<div class="sponsors-img">
												<a href="<?php echo esc_url($link); ?>">
													<img src="<?php echo esc_url($image); ?>" />
												</a>
											</div>
										</div>
									<?php }} ?>
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<div class="sponsors-image-play">
									<?php if(!empty($sponsor3_right_img)): ?>
										<img src="<?php echo esc_url($sponsor3_right_img); ?>">
									<?php endif; ?>

									<?php if(!empty($sponsor3_right_link)): ?>
										<a href="<?php echo esc_url($sponsor3_right_link); ?>" class="btn btn-play"><i class="fa  fa-play"></i></a>
									<?php endif; ?>	
								</div>
							</div>
						</div>
					</div>
				</div>	
				<?php 
			endif;}endif;
			if ( function_exists( 'vf_expansion_qstore_sponsor_section' ) ) {
				$section_priority = apply_filters( 'storepress_section_priority', 14, 'vf_expansion_qstore_sponsor_section' );
				add_action( 'storepress_sections', 'vf_expansion_qstore_sponsor_section', absint( $section_priority ) );
			} ?>