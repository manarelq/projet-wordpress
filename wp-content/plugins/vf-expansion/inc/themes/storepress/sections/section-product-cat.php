<?php  
if ( ! function_exists( 'vf_expansion_storepress_product_cat_section' ) ) :
	function vf_expansion_storepress_product_cat_section() {
$product_cat2_hide_show	= get_theme_mod('product_cat2_hide_show','1');		
$product_cat2_title = get_theme_mod('product_cat2_title','Weekly Categories');	
$product_cat2_id 	= get_theme_mod('product_cat2_id');	
if(class_exists( 'woocommerce' ) && $product_cat2_hide_show=='1'): 
?>		
<div id="vf-product-category" class="vf-product-category st-py-full vfh2-pcat">
	<div class="container">
		<?php if(!empty($product_cat2_title)): ?>
			<div class="row">
				<div class="col-lg-12 col-12 mx-lg-auto mb-5 text-center">
					<div class="heading-default wow fadeInUp">
						<div class="title">
							<h3><?php echo wp_kses_post($product_cat2_title); ?></h3>
							<?php do_action('storepress_section_seprator2'); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; 
		if(!empty($product_cat2_id)):
		$count = count($product_cat2_id);
		if ( $count > 0 ){
		?>
		<div class="row g-4">
			<div class="col-lg-12 col-sm-12">
				<div class="product-category-carousel owl-carousel owl-theme">
					<?php foreach ( $product_cat2_id as $i=>$product_category ) { 
					$cat_name = get_term_by( 'slug', $product_category, 'product_cat' );
					$thumbnail_id = get_term_meta( $cat_name->term_id, 'thumbnail_id', true );
					 $image = wp_get_attachment_url( $thumbnail_id );
					?>
						<div class="product-category-home">
							<div class="product-category-img">
								<div class="product-category-img-inner">
									<img src="<?php echo esc_url($image); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
								</div>
							</div>
							<div class="product-category-outer">
								<div class="product-category-content">
									<h6><a href="<?php echo esc_url(get_term_link($cat_name->term_id)); ?>"><?php  echo esc_html($cat_name->name); ?></a></h6>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php }endif; ?>
	</div>
</div>
<?php  endif; }
endif;
if ( function_exists( 'vf_expansion_storepress_product_cat_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 12, 'vf_expansion_storepress_product_cat_section' );
add_action( 'storepress_sections', 'vf_expansion_storepress_product_cat_section', absint( $section_priority ) );
}
?>