<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package StorePress
 */

get_header();
?>
<div id="vf-post" class="vf-post st-py-default">
	<div class="container">
		<div class="row g-4">
			<div class="<?php esc_attr(storepress_pages_layout()); ?>">
				<div class="row">
					<?php if( have_posts() ): ?>
				
						<?php while( have_posts() ) : the_post(); ?>
							<div class="col-lg-12 mb-4">
								<?php	get_template_part('template-parts/content/content','search'); ?>
							</div>
						<?php		
							endwhile; 
							the_posts_navigation();
						?>
						
					<?php else: ?>
					
						<?php get_template_part('template-parts/content/content','none'); ?>
						
					<?php endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
