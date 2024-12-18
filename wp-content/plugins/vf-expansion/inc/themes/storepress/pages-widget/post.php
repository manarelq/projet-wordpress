<?php
$MediaId = get_option('storepress_media_id');
$blog_title1 = "Everyday Same Happy Days";
$blog_title2 = "Everyday Same Happy Days";
$blog_title3 = "Everyday Same Happy Days";
$content='<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>';
$product_ttl1 = "Product 01";
$product_ttl2 = "Product 02";
$product_ttl3 = "Product 03";
$product_ttl4 = "Product 04";

wp_insert_term(
    'Fashion',
    'category',
    array(
      'description' => 'example category',
      'slug'    => 'fashion'
    )
  );


wp_insert_term(
    'Designer',
    'category',
    array(
      'description' => 'example category',
      'slug'    => 'designer'
    )
  );
  
wp_insert_term(
    'Lifestyle',
    'category',
    array(
      'description' => 'example category',
      'slug'    => 'lifestyle'
    )
  ); 
  
if ( class_exists( 'woocommerce' ) ) { 
	wp_insert_term(
		'All',
		'product_cat',
		array(
		  'description' => 'example category',
		  'slug'    => 'all'
		)
	  );
	  
	wp_insert_term(
		'Best Seller',
		'product_cat',
		array(
		  'description' => 'example category',
		  'slug'    => 'best-seller'
		)
	); 

	wp_insert_term(
		'Trending',
		'product_cat',
		array(
		  'description' => 'example category',
		  'slug'    => 'trending'
		)
	); 


	wp_insert_term(
		'Clothes',
		'product_cat',
		array(
		  'description' => 'example category',
		  'slug'    => 'clothes'
		)
	); 

	wp_insert_term(
		'Electronics',
		'product_cat',
		array(
		  'description' => 'example category',
		  'slug'    => 'electronics'
		)
	); 

	wp_insert_term(
		'Footwear',
		'product_cat',
		array(
		  'description' => 'example category',
		  'slug'    => 'footwear'
		)
	); 

}
$postData = array(
				array(
					'post_title' => $blog_title1,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'post',
					'post_category' => array(1,16),
					'tax_input'    => array(
						'post_tag' => array('Lifestyle')
					),
				),
				array(
					'post_title' => $blog_title2,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'post',
					'post_category' => array(1,16,17),
					'tax_input'    => array(
						'post_tag' => array('Fashion')
					),
				),
				array(
					'post_title' => $blog_title3,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'post',
					'post_category' => array(1,16,18),
					'tax_input'    => array(
						'post_tag' => array('Designer')
					),
				),
				array(
					'post_title' => $product_ttl1,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'product',
					'post_category' => array(15,17,18)
				),
				array(
					'post_title' => $product_ttl2,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'product',
				),
				array(
					'post_title' => $product_ttl3,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'product',
				),
				array(
					'post_title' => $product_ttl4,
					'post_status' => 'publish',
					'post_content' => $content,
					'post_author' => 1,
					'post_type'         =>   'product',
				)
			);

kses_remove_filters();
foreach ( $postData as $i => $postData1) : 
	$id = wp_insert_post($postData1);
	set_post_thumbnail( $id, $MediaId[$i + 1] );
	
	if ( class_exists( 'woocommerce' ) ) {
		if($i>2 && $i<=6){
			wp_set_object_terms( $id, 'simple', 'product_type' ); // set product is simple/variable/grouped
			update_post_meta( $id, '_visibility', 'visible' );
			update_post_meta( $id, '_stock_status', 'instock');
			update_post_meta( $id, 'total_sales', '0' );
			update_post_meta( $id, '_downloadable', 'no' );
			update_post_meta( $id, '_virtual', 'yes' );
			update_post_meta( $id, '_regular_price', '' );
			update_post_meta( $id, '_sale_price', '' );
			update_post_meta( $id, '_purchase_note', '' );
			update_post_meta( $id, '_featured', 'no' );
			update_post_meta( $id, '_weight', '11' );
			update_post_meta( $id, '_length', '11' );
			update_post_meta( $id, '_width', '11' );
			update_post_meta( $id, '_height', '11' );
			update_post_meta( $id, '_sku', 'SKU11' );
			update_post_meta( $id, '_product_attributes', array() );
			update_post_meta( $id, '_sale_price_dates_from', '' );
			update_post_meta( $id, '_sale_price_dates_to', '' );
			update_post_meta( $id, '_price', '11' );
			update_post_meta( $id, '_sold_individually', '' );
			update_post_meta( $id, '_manage_stock', 'yes' ); // activate stock management
			wc_update_product_stock($id, 100, 'set'); // set 1000 in stock
			update_post_meta( $id, '_backorders', 'no' );
		}
	}
endforeach;

if ( class_exists( 'woocommerce' ) ) {
	wp_set_object_terms( 21, [ 15, 17, 18 ], 'product_cat' );
	wp_set_object_terms( 22, [ 15, 22, 18 ], 'product_cat' );
	wp_set_object_terms( 23, [ 15, 21, 18 ], 'product_cat' );
	wp_set_object_terms( 24, [ 15, 20, 21 ], 'product_cat' );
}
kses_init_filters();