<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StorePress
 */

get_header(); 
?>
<div id="vf-post" class="vf-post st-py-default">
	<div class="container">
		<div class="row g-4">
			<div class="<?php esc_attr(storepress_pages_layout()); ?>">
				<?php 
				$storepress_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'post','paged'=>$storepress_paged );	
				?>
				<?php if( have_posts() ): ?>
					<?php while( have_posts() ) : the_post(); ?>
						<div class="col-lg-12 mb-4">
							<?php get_template_part('template-parts/content/content','page'); ?>
						</div>
					<?php endwhile; ?>
				<?php else: ?>
					<?php get_template_part('template-parts/content/content','none'); ?>
				<?php endif; ?>
				
				<div class="row">
					<div class="col-12 mt-3">
						<div class="paginatoin-area">
							<?php			
							the_posts_pagination( array(
								'prev_text' => wp_kses_post( '<i class="fa fa-angle-double-left"></i>' ),
								'next_text' => wp_kses_post( '<i class="fa fa-angle-double-right"></i>' ),
							) ); 
							?>
						</div>
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
