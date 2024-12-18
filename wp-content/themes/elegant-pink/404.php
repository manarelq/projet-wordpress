<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Elegant_Pink
 */

get_header(); ?>

    <div class="error-holder">
		<div class="holder">
			<h1><?php esc_html_e( '404!', 'elegant-pink' ); ?></h1>
			<h2><?php esc_html_e( 'The requested page can&rsquo;t be found.', 'elegant-pink' ); ?></h2>
			<p><?php printf( esc_html__( 'Sorry but the page you are looking for cannot be found. Take a moment and do a search below or start from our %s.', 'elegant-pink' ), '<a href="' . esc_url( home_url( '/' ) ) . '">homepage</a>' )?></p>
			<?php get_search_form(); ?>
		</div>
	</div>

<?php
get_footer();
