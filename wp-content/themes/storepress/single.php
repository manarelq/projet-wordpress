<?php
/**
 * The template for displaying archive pages.
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
			<div class="col-lg-8 col-12">
				<div class="row g-4">
					<div class="col-lg-12 col-md-12 col-12">
						<?php if( have_posts() ): ?>
						<?php while( have_posts() ): the_post(); ?>
							<article class="vf-post-items single-post">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-image">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php endif; ?>		
								<div class="post-content">
									<div class="post-content-inner">                                            
										<div class="post-categories">
											<a href="<?php esc_url(the_permalink()); ?>" rel="category tag"><?php the_category(', '); ?></a>
										</div>
										<?php
											if ( is_single() ) :
												the_title('<h2 class="post-title">', '</h2>' );
											else:
												the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
											endif; 
										?>
										<div class="post-meta">
											<div class="post-comments">
												<i class="fa fa-comments-o"></i> <?php echo esc_html(get_comments_number($post->ID)); ?> <?php esc_html_e('Comments','storepress'); ?>
											</div>
											<div class="post-date">
												<i class="fa fa-calendar"></i> <a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><?php echo esc_html(get_the_date('j')); ?> <?php echo esc_html(get_the_date('M')); ?> <?php echo esc_html(get_the_date('Y')); ?></a>
											</div>
										</div>
										<?php 
											the_content( 
												sprintf( 
													__( 'Read More', 'storepress' ), 
													'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
												) 
											);
										?>
									</div>
								</div>
							</article>
						<?php endwhile; ?>
						<?php endif; ?>
						<?php comments_template( '', true ); // comments  ?>
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
