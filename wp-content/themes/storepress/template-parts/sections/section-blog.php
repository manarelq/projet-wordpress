<?php  
if ( ! function_exists( 'storepress_blog_section' ) ) :
	function storepress_blog_section() {
	$storepress_blog2_hide_show		= get_theme_mod('blog2_hide_show','1');
	$storepress_blog2_title			= get_theme_mod('blog2_title');
	$storepress_blog2_display_num	= get_theme_mod('blog2_display_num','3'); 
	$storepress_blog2_bg_img		= get_theme_mod('blog2_bg_img',esc_url(get_template_directory_uri() .'/assets/images/post_bg.jpg')); 
	$storepress_blog2_opacity		= get_theme_mod('blog2_opacity','0.75'); 
	if($storepress_blog2_hide_show=='1'):
?>	
<div id="vf-post" class="vf-post post-two st-py-default vf-post-2" style="background: url('<?php echo esc_url($storepress_blog2_bg_img); ?>') no-repeat center center / cover rgba(0, 0, 0, <?php echo esc_attr($storepress_blog2_opacity); ?>); background-blend-mode: multiply;">
	<div class="container">
		<div class="row">
			<?php if(!empty($storepress_blog2_title)): ?>
				<div class="col-lg-12 col-12 mx-lg-auto mb-5 text-center">
					<div class="heading-default text-white wow fadeInUp">
						<div class="title">
							<h3><?php echo wp_kses_post($storepress_blog2_title); ?></h3>
							<?php do_action('storepress_section_seprator2'); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-lg-12 col-12">
				<div class="row g-4">
					<?php 	
						$storepress_blogs_args = array( 'post_type' => 'post', 'posts_per_page' => $storepress_blog2_display_num,'post__not_in'=>get_option("sticky_posts")) ; 	
						$storepress_blog2_wp_query = new WP_Query($storepress_blogs_args);
							if($storepress_blog2_wp_query)
							{	
							while($storepress_blog2_wp_query->have_posts()):$storepress_blog2_wp_query->the_post();
					?>
						<div class="col-lg-4 col-md-6 col-12">
							<?php get_template_part('template-parts/content/content','page-2');	?>
						</div>
					<?php endwhile; } wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; }
endif;
if ( function_exists( 'storepress_blog_section' ) ) {
$section_priority = apply_filters( 'storepress_section_priority', 14, 'storepress_blog_section' );
add_action( 'storepress_sections', 'storepress_blog_section', absint( $section_priority ) );
}