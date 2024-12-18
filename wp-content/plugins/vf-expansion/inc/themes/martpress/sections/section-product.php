<?php  
if ( ! function_exists( 'vf_expansion_martpress_product_section' ) ) :
	function vf_expansion_martpress_product_section() {
$product_hide_show		= get_theme_mod('product_hide_show','1');		
$product_title 			= get_theme_mod('product_title','Our Products');
$product1_cat_id 		= get_theme_mod('product1_cat_id');
$product_display_num 	= get_theme_mod('product_display_num','20');	
if(class_exists( 'woocommerce' )  && $product_hide_show=='1'): 
$args                   = array(
	'post_type' => 'product',
	'posts_per_page' => $product_display_num,
);
if(!empty($product1_cat_id)):
$args['tax_query'] = array(
	array(
		'taxonomy' => 'product_cat',
		'field' => 'slug',
		'terms' => $product1_cat_id,
	),
);
endif;
?>		
<div id="vf-our-products" class="vf-our-products product-section products-carousel st-pt-default home1-product">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12 mx-lg-auto mb-5 text-center">
				<div class="heading-default wow fadeInUp">
					<div class="title">
						<?php if(!empty($product_title)): ?>
							<h3><?php echo wp_kses_post($product_title); ?></h3>
						<?php endif; do_action('storepress_section_seprator'); ?>
					</div>
					<?php if(!empty($product1_cat_id)):
							$count = count($product1_cat_id);
							if ( $count > 0 ){
					?>
						<div class="product-filter">
							<nav class="product-filter-tab owl-filter-bar">
								<?php foreach ( $product1_cat_id as $i=>$product_category ) { 
								$cat_name = get_term_by( 'slug', $product_category, 'product_cat' );
								?>
								<?php if($i == '0'){ ?>
									<a href="javascript:void(0);" class="item current" data-owl-filter=".product_cat-<?php  echo esc_attr($product_category); ?>"><?php  echo esc_html($cat_name->name); ?></a>
								<?php }else{ ?>		
								<a href="javascript:void(0);" class="item" data-owl-filter=".product_cat-<?php  echo esc_attr($product_category); ?>"><?php  echo esc_html($cat_name->name); ?></a>
								<?php }} ?>
							</nav>
						</div>
					<?php }endif;  ?>
				</div>
			</div>
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
<?php endif;  }
endif;
if ( function_exists( 'vf_expansion_martpress_product_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 13, 'vf_expansion_martpress_product_section' );
add_action( 'storepress_sections', 'vf_expansion_martpress_product_section', absint( $section_priority ) );
}
?>