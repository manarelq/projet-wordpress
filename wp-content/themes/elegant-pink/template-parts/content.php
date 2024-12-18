<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elegant_Pink
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( has_post_thumbnail() ){ ?>
        <div class="img-holder">
            <a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'elegant-pink-3col-image', array( 'itemprop' => 'image' ) ); ?></a>
            <?php elegant_pink_posted_on(); ?>
        </div>     
    <?php }?>
    
    <div class="text-holder">
        <header class="entry-header">
            <?php 
                elegant_pink_category();
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
            ?>
        </header><!-- .entry-header -->
    
        <div class="entry-content">
            <?php 
                $format = get_post_format();
                
                if( false === $format ){
                    the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php esc_html_e( 'Read More', 'elegant-pink' ); ?></a>
                <?php
                }else{
                    the_content( sprintf(
                        /* translators: %s: Name of current post. */
                        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'elegant-pink' ), array( 'span' => array( 'class' => array() ) ) ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ) );
                }
                
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elegant-pink' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->        
    </div>
    <footer class="entry-footer">
		<?php elegant_pink_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
