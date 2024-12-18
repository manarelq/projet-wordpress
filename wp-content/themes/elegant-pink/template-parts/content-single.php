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
    <?php if(has_post_thumbnail()){ ?>
        <div class="img-holder">
        <?php 
            if( is_active_sidebar( 'right-sidebar' ) ){
                the_post_thumbnail( 'elegant-pink-image' );
            }else{
                the_post_thumbnail( 'elegant-pink-image-full' );
            } 
            elegant_pink_posted_on(); 
        ?>
        </div>     
    <?php }else{
        echo '<div class="no-image">';
        elegant_pink_posted_on();
        echo '</div>';

    } ?>
    
    <div class="text-holder">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
    
        <div class="entry-content">
            <?php                 
                the_content( sprintf(
                    /* translators: %s: Name of current post. */
                    wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'elegant-pink' ), array( 'span' => array( 'class' => array() ) ) ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
                
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
