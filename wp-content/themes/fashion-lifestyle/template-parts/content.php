<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fashion_Lifestyle
 */

$home_layout = get_theme_mod( 'home_layout', 'two' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="https://schema.org/Blog">
	<?php 

        if ( $home_layout == 'two' && !is_singular()){ ?>
           <div class="post-content">
                <?php blossom_fashion_post_thumbnail(); ?>
                <div class="text-holder">
                    <?php blossom_fashion_entry_header(); 
                          blossom_fashion_entry_content();
                          blossom_fashion_entry_footer();
                    ?>
                </div>
            </div>
        <?php
        } else {
        /**
         * @hooked blossom_fashion_entry_header   - 15 
         * @hooked blossom_fashion_post_thumbnail - 20
        */
        do_action( 'blossom_fashion_before_post_entry_content' );
    
        /**
         * @hooked blossom_fashion_entry_content - 15
         * @hooked blossom_fashion_entry_footer  - 20
        */
        do_action( 'blossom_fashion_post_entry_content' );
        
        }

       
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
