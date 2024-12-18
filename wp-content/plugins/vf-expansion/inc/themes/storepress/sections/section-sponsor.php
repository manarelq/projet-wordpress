<?php  
if ( ! function_exists( 'vf_expansion_storepress_sponsor_section' ) ) :
	function vf_expansion_storepress_sponsor_section() {
	$sponsor2_hide_show	= get_theme_mod('sponsor2_hide_show','1');		
	$sponsor2_content 	= get_theme_mod('sponsor2_content',storepress_get_sponsor2_default());
	if($sponsor2_hide_show=='1'):
?>		
<div id="vf-sponsor" class="vf-sponsor vf-products-info-three st-py-default">
	<div class="container">
		<div class="row">
			<?php
				if ( ! empty( $sponsor2_content ) ) {
				$sponsor2_content = json_decode( $sponsor2_content );
				foreach ( $sponsor2_content as $item ) {
					$link = ! empty( $item->link ) ? apply_filters( 'storepress_translate_single_string', $item->link, 'Sponsor 2 section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'storepress_translate_single_string', $item->image_url, 'Sponsor 2 section' ) : '';
			?>
				<div class="col-lg-2 col-sm-6 col-12">
					<div class="sponsors-img">
						<a href="<?php echo esc_url($link); ?>">
							<img src="<?php echo esc_url($image); ?>" />
						</a>
					</div>
				</div>
			<?php }} ?>
		</div>
	</div>
</div>
<?php endif; }
endif;
if ( function_exists( 'vf_expansion_storepress_sponsor_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 15, 'vf_expansion_storepress_sponsor_section' );
add_action( 'storepress_sections', 'vf_expansion_storepress_sponsor_section', absint( $section_priority ) );
}
?>