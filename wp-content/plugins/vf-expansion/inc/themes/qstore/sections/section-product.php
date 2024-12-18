<?php  
if ( ! function_exists( 'vf_expansion_qstore_product_section' ) ) :
	function vf_expansion_qstore_product_section() {
		$product3_title 		= get_theme_mod('product3_title','Trending Product');
		$product3_cat_id 		= get_theme_mod('product3_cat_id');
		$product3_hide_show		= get_theme_mod('product3_hide_show','1');
		$product3_display_num 	= get_theme_mod('product3_display_num','20');	
		if(class_exists( 'woocommerce' )  && $product3_hide_show=='1'): 

			$args                   = array(
				'post_type' => 'product',
				'posts_per_page' => $product3_display_num,
			);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $product3_cat_id,
				),
			);
			?>	
			<div id="vf-trending-products" class="vf-trending-products product-section products-carousel st-pt-default vf3p">
				<div class="container">
					<div class="row">
						<?php if(!empty($product3_title)): ?>
							<div class="col-lg-12 col-12 mx-lg-auto mb-5 text-center">
								<div class="heading-default wow fadeInUp">
									<div class="title">
										<h3><?php echo wp_kses_post($product3_title); ?></h3>
										<?php do_action('storepress_section_seprator2'); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="col-lg-12 col-12 mx-lg-auto mb-0 text-center">
							<div class="woocommerce columns-4">
								<ul class="products columns-4">
									<?php	
									$loop = new WP_Query( $args ); 
									if( $loop->have_posts() )
									{
										while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
											<?php get_template_part('woocommerce/content','product'); ?>
										<?php endwhile; } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<?php 
			endif; }
		endif;
		if ( function_exists( 'vf_expansion_qstore_product_section' ) ) {
			$section_priority = apply_filters( 'storepress_section_priority', 13, 'vf_expansion_qstore_product_section' );
			add_action( 'storepress_sections', 'vf_expansion_qstore_product_section', absint( $section_priority ) );
		}
	?>