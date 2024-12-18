<?php  
if ( ! function_exists( 'vf_expansion_martpress_cta_section' ) ) :
	function vf_expansion_martpress_cta_section() {
$cta_hide_show	= get_theme_mod('cta_hide_show','1');		
$cta_title 		= get_theme_mod('cta_title','50 <span>% OFF</span>');
$cta_subtitle 	= get_theme_mod('cta_subtitle','For Today Fashion');
$cta_btn_lbl 	= get_theme_mod('cta_btn_lbl','Shop Now');	
$cta_btn_link 	= get_theme_mod('cta_btn_link','#');
$cta_bg_img 	= get_theme_mod('cta_bg_img',esc_url(VF_EXPANSION_PLUGIN_URL .'inc/themes/martpress/assets/images/cta_bg.jpg'));
$cta_img_opacity = get_theme_mod('cta_img_opacity','0.5');
if($cta_hide_show=='1'):
?>		
<div id="vf-cta" class="vf-cta st-py-default home1-cta">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="row cta-wrapper" style="background: url('<?php echo esc_url($cta_bg_img); ?>') no-repeat center center / cover rgba(0, 0, 0, <?php echo esc_attr($cta_img_opacity); ?>);background-blend-mode:multiply;">
					<div class="col-lg-10 text-lg-left text-center my-lg-auto">
						<?php if(!empty($cta_title)): ?>
							<div class="display-3 font-weight-bold d-inline-block mb-0 mr-1"><?php echo wp_kses_post($cta_title); ?></div>
						<?php endif; ?>
						<?php if(!empty($cta_subtitle)): ?>
							<div class="display-6 font-weight-bold d-inline-block"><?php echo wp_kses_post($cta_subtitle); ?></div>
						<?php endif; ?>	
					</div>
					
					<?php if(!empty($cta_btn_lbl)): ?>
						<div class="col-lg-2 text-lg-right text-center my-lg-auto mt-3">
							<a href="<?php echo esc_url($cta_btn_link); ?>" class="btn btn-border-white"><?php echo wp_kses_post($cta_btn_lbl); ?></a>
						</div>
					<?php endif; ?>	
				</div>
			</div>
		</div>
	</div>
</div>
<?php  endif; }
endif;
if ( function_exists( 'vf_expansion_martpress_cta_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 15, 'vf_expansion_martpress_cta_section' );
add_action( 'storepress_sections', 'vf_expansion_martpress_cta_section', absint( $section_priority ) );
}
?>