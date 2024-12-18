<?php  
if ( ! function_exists( 'vf_expansion_qstore_product_cat_section' ) ) :
	function vf_expansion_qstore_product_cat_section() {
		$product_cat3_title = get_theme_mod('product_cat3_title','Weekly Categories');	
		$product_cat3_id 	= get_theme_mod('product_cat03_id');	
		$product_cat3_column = get_theme_mod('product_cat3_column','3');
		$product_cat03_hide_show	                    = get_theme_mod('product_cat03_hide_show','1');
		if($product_cat03_hide_show=='1'):	
		if(class_exists( 'woocommerce' )): 
			?>		
			<div id="vf-product-category" class="vf-product-category st-py-full vf-product-cat3">
				<div class="container">
					<?php if(!empty($product_cat3_title)): ?>
						<div class="row">
							<div class="col-lg-12 col-12 mx-lg-auto mb-5 text-center">
								<div class="heading-default wow fadeInUp">
									<div class="title">
										<h3><?php echo wp_kses_post($product_cat3_title); ?></h3>
										<?php do_action('storepress_section_seprator2'); ?>
									</div>
								</div>
							</div>
						</div>
					<?php endif; 
					if(!empty($product_cat3_id)):
						$count = count($product_cat3_id);
						if ( $count > 0 ){
							?>
							<div class="row">
								<?php foreach ( $product_cat3_id as $i=>$product_category ) { 
									$cat_name = get_term_by( 'slug', $product_category, 'product_cat' );
									$thumbnail_id = get_term_meta( $cat_name->term_id, 'thumbnail_id', true );
									$image = wp_get_attachment_url( $thumbnail_id );
									?>
									<div class="col-lg-<?php echo esc_attr($product_cat3_column); ?> col-sm-6 col-sm-12">
										<div class="product-category-home">
											<div class="product-category-img">
												<div class="product-category-img-inner">
													<img src="<?php echo esc_url($image); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="">
												</div>
											</div>
											<div class="product-category-outer">
												<div class="product-category-content">
													<h6><a href="<?php echo esc_url(get_term_link($cat_name->term_id)); ?>"><?php echo esc_html($cat_name->name); ?></a></h6>
													<p class="mb-0"><?php echo esc_html($cat_name->description); ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php }endif; ?>
					</div>
				</div>
			<?php endif; endif; 
		}endif;  

		if ( function_exists( 'vf_expansion_qstore_product_cat_section' ) ) {
			$section_priority = apply_filters( 'storepress_section_priority', 12, 'vf_expansion_qstore_product_cat_section' );
			add_action( 'storepress_sections', 'vf_expansion_qstore_product_cat_section', absint( $section_priority ) );
		}
	?>