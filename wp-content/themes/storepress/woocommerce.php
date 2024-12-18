<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package StorePress
 */

get_header();
?>
<section id="product" class="product-section st-py-default">
    <div class="container">
		<div class="row gy-lg-0 gy-5 wow fadeInUp">
			<?php if ( ! is_active_sidebar( 'storepress-woocommerce-sidebar' ) ) {	?>
				<div id="product-content" class="col-lg-12">
			<?php }else{ ?>
				<div id="product-content" class="col-lg-8">
			<?php } ?>	
				<?php woocommerce_content(); ?>
			</div>
			<?php get_sidebar('woocommerce'); ?>
		</div>	
	</div>
</section>
<?php get_footer(); ?>

