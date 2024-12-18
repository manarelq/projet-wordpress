<?php
/**
 * Template part for displaying posts.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package StorePress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('vf-post-items'); ?>>
	<div class="post-content">
		<div class="post-content-inner">
			<?php
				if ( is_single() ) {
					the_title( '<h6 class="post-title">', '</h6>' );
				} else {
					the_title( '<h6 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h6>' );
				}

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php storepress_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'storepress' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'storepress' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</div>
	<footer class="entry-footer">
		<?php storepress_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
