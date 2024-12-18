<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package StorePress
 */

get_header();
?>
<div id="vf-page404" class="vf-page404 st-py-default">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-12 text-center mx-auto">
				<div class="page404">
					<h2><?php esc_html_e('Page Not Found','storepress'); ?></h2>
					<h1><?php esc_html_e('404','storepress'); ?></h1>
					<h3><?php esc_html_e('The page you requested does not exist.','storepress'); ?></h3>
					<div class="page404-btn mt-sm-5 mt-4">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php esc_html_e('Continue Shopping','storepress'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
