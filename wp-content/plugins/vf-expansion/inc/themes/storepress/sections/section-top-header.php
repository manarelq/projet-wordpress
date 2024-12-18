<?php  
if ( ! function_exists( 'storepress_top_header_data' ) ) :
	function storepress_top_header_data() {
		$hs_hdr_info		=	get_theme_mod('hs_hdr_info','1');
		$hs_hdr_right_info	=	get_theme_mod('hs_hdr_right_info','1');
		if($hs_hdr_info == '1' || $hs_hdr_right_info == '1'): ?>
			<div id="above-header" class="above-header d-lg-block d-none wow fadeIn">
				<div class="header-widget d-flex align-items-center">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 col-12 mb-lg-0 mb-4">
								<div class="widget-left text-lg-left text-center">
									<?php storepress_header_left_info(); ?>
								</div>
							</div>
							<div class="col-lg-6 col-12 mb-lg-0 mb-4">
								<div class="widget-right justify-content-lg-end justify-content-center text-lg-right text-center">
									<?php storepress_header_right_info(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif;
	}
endif;
add_action( 'storepress_top_header_data', 'storepress_top_header_data');

if ( ! function_exists( 'storepress_top_header03_datas' ) ) :
	function storepress_top_header03_datas() {
		$hs_hdr_right_info	=	get_theme_mod('hs_hdr_right_info','1');
		if( $hs_hdr_right_info == '1'): 
			storepress_header_right_info(); 
		endif; }
	endif;
	add_action( 'storepress_top_header03_datas', 'storepress_top_header03_datas');