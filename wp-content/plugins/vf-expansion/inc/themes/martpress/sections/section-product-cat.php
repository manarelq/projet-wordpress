<?php  
if ( ! function_exists( 'vf_expansion_martpress_product_cat_section' ) ) :
	function vf_expansion_martpress_product_cat_section() {
$product_cat_hide_show	= get_theme_mod('product_cat_hide_show','1');
$product_cat_id 	= get_theme_mod('product_cat_id');	
if(class_exists( 'woocommerce' )  && $product_cat_hide_show=='1'): 
//if(!empty($product_cat_id) && !is_customize_preview()):
if(!empty($product_cat_id)):
$count = count($product_cat_id);
if ( $count > 0 ){
?>		
<div id="vf-product-category" class="vf-product-category st-py-full">
	<div class="container">
		<div class="row g-4">
			<?php foreach ( $product_cat_id as $i=>$product_category ) { 
			$cat_name = get_term_by( 'slug', $product_category, 'product_cat' );
			$thumbnail_id = get_term_meta( $cat_name->term_id, 'thumbnail_id', true );
	         $image = wp_get_attachment_url( $thumbnail_id );
			?>
				<div class="col-lg col-sm-6">
					<div class="product-category-home">
						<div class="product-category-img">
							<a href="#">
								<img src="<?php echo esc_url($image); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
							</a>
						</div>
						<div class="product-category-outer">
							<div class="product-category-content">
								<h6><a href="<?php echo esc_url(get_term_link($cat_name->term_id)); ?>"><?php  echo esc_html($cat_name->name); ?></a></h6>
								<p class="mb-0"><?php echo esc_html($cat_name->description); ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php }endif; endif; ?>
<?php   }
endif;
if ( function_exists( 'vf_expansion_martpress_product_cat_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 12, 'vf_expansion_martpress_product_cat_section' );
add_action( 'storepress_sections', 'vf_expansion_martpress_product_cat_section', absint( $section_priority ) );
}
?>