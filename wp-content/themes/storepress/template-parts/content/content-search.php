<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StorePress
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('vf-post-items'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
			<a href="<?php echo esc_url('javascript:void(0)')?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<a href="<?php esc_url(the_permalink()); ?>" class="post-link"><i class="fa fa-link"></i></a>
		</div>
	<?php endif; ?>		
	<div class="post-content">
		<div class="post-date">
			<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><span><?php echo esc_html(get_the_date('j')); ?></span> <?php echo esc_html(get_the_date('M')); ?></a>
			<i class="fa fa-share"></i>
		</div>
		<div class="post-content-inner">
			<div class="post-author">
				<?php esc_html_e('Posted by','storepress'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" title="<?php esc_attr(the_author()); ?>" class="author meta-info"><?php esc_html(the_author()); ?></a>
			</div>
			<?php
			if ( is_single() ) :

				the_title('<h6 class="post-title">', '</h6>' );
				
			else:
				
				the_title( sprintf( '<h6 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
				
			endif; 
			
			the_content( 
				sprintf( 
					__( 'Read More', 'storepress' ), 
					'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
				) 
			);
			?>
			<div class="post-categories">
				<a href="<?php esc_url(the_permalink()); ?>" rel="category tag"><?php the_category(' '); ?></a>
			</div>
		</div>
	</div>
</article>