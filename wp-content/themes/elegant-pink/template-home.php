<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Elegant_Pink
 */

$sidebar_layout = elegant_pink_sidebar_layout();
$pagination     = get_theme_mod( 'elegant_pink_pagination_type', 'default' );
 
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">            
			<?php
                $ep_paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
                
                $blog_qry = new WP_Query( array( 'post_type'=>'post', 'paged'=>$ep_paged ) );
                
                if( $blog_qry->have_posts()) :
                
                ?>
                <div class="row ep-masonry">

                <?php
                while( $blog_qry->have_posts() ) :
                    $blog_qry->the_post();
                    
                    get_template_part( 'template-parts/content', get_post_format() );
                
                endwhile;
                ?>
                
                </div>
                
                <?php
                
                else :

			         get_template_part( 'template-parts/content', 'none' );
                     
                endif;
			
			?>            
		</main><!-- #main -->
            
        <?php if( $pagination == 'default' ){ ?>
            <nav class="navigation posts-navigation" role="navigation">
                <div class="nav-links">
                    <div class="nav-previous"><?php echo get_next_posts_link( __( 'Older Entries', 'elegant-pink' ), $blog_qry->max_num_pages ); ?></div>
                    <div class="nav-next"><?php echo get_previous_posts_link( __( 'Newer Entries', 'elegant-pink' ) ); ?></div>
                </div>
            </nav>
        <?php        
            }else{
                echo '<div class="pagination"></div>';    
            }
            
            // clean up after our query
            wp_reset_postdata(); 
        ?> 
        
	</div><!-- #primary -->

<?php
if( $sidebar_layout == 'right-sidebar' )
get_sidebar();
get_footer();
