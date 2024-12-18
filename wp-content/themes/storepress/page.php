<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
			<?php 
			if ( class_exists( 'woocommerce' ) ) 
			{
				if( is_account_page() || is_cart() || is_checkout() ) { 
					echo '<div class="col-lg-' . esc_attr( !is_active_sidebar( "storepress-woocommerce-sidebar" ) ? "12" : "8" ) . '">';

				}else{ 

					echo '<div class="col-lg-' . esc_attr( !is_active_sidebar( "storepress-sidebar-primary" ) ? "12" : "8" ) . '">'; }

				}else{ echo '<div class="col-lg-' . esc_attr( !is_active_sidebar( "storepress-sidebar-primary" ) ? "12" : "8" ) . '">'; } 
				?>
				<?php if( have_posts()) : the_post(); ?>
					<article class="">
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					</article>
				<?php endif;
				if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // comments 
						}
						?>
					</div>
					<?php 
					if ( class_exists( 'WooCommerce' ) ) {
						if( is_account_page() || is_cart() || is_checkout() ) {
							get_sidebar('woocommerce');
						}else{ get_sidebar(); }
					}
					else{ get_sidebar(); }
					?>
				</div>
			</div>
		</div>
		<?php get_footer(); ?>