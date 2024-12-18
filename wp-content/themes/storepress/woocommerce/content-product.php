<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<div class="product">
		<div class="product-single">
			<div class="product-bg"></div>
				<div class="product-img">
					<a href="<?php echo esc_url(the_permalink()); ?>">
						<img src="<?php esc_url(the_post_thumbnail_url()); ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" />
					</a>
					<div class="btn-group">
					</div>
					<?php if ( $product->is_on_sale() ) : ?>
						<?php if ( is_page_template( 'templates/template-frontpage.php' )): ?>
							<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sale-ribbon sale"><span class="tag-line">' . esc_html__( 'Sale', 'storepress' ) . '</span></div>', $post, $product ); ?>
						<?php else: ?>	
							<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sale-ribbon"><span class="tag-line">' . esc_html__( 'Sale', 'storepress' ) . '</span></div>', $post, $product ); ?>
					<?php endif; endif; ?>
				</div>
				<div class="product-content-outer">
					<div class="product-content">                                                    
						<h3><a href="<?php esc_url(the_permalink()); ?>"><?php echo esc_html(the_title()); ?></a></h3>
						<?php if ($average = $product->get_average_rating()) : ?>
							<?php echo '<i class="fa fa-star" title="'.sprintf(__( 'Rated %s out of 5', 'storepress' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'storepress' ).'</span></i>'; ?>
						<?php endif; ?>
						<div class="price">
							<?php  echo $product->get_price_html(); ?>
						</div>
					</div>
					<div class="product-action">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				</div>
		</div>
	</div>
</li>
