<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elegant_Pink
 */
global $post;
if( get_post_meta( $post->ID, 'elegant_pink_sidebar_layout', true ) ){
    $sidebar_layout = get_post_meta( $post->ID, 'elegant_pink_sidebar_layout', true );    
}else{
    $sidebar_layout = 'right-sidebar';
} 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()){ ?>
        <div class="img-holder">
        <?php
            ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'elegant-pink-image', array( 'itemprop' => 'image' ) ) : the_post_thumbnail( 'elegant-pink-image-full', array( 'itemprop' => 'image' ) );
        ?>
        </div>
    <?php } ?>
    <div class="text-holder">
        <?php 
        if( ! is_front_page() ) : ?>
            <header class="entry-header">
        		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        	</header><!-- .entry-header -->
        <?php endif; ?>
    	<div class="entry-content">
    		<?php
    			the_content();
    
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
