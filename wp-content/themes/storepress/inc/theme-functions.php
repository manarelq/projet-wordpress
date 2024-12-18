<?php
/**
 * Custom functions 
 * @package StorePress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function storepress_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'storepress_body_classes' );



/**
 * Implement the Custom Header feature.
 */
function storepress_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'storepress_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 2000,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'storepress_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'storepress_custom_header_setup' );

if ( ! function_exists( 'storepress_header_style' ) ) :

function storepress_header_style() {
	$header_text_color = get_header_textcolor();

	?>
	<style type="text/css">
	<?php
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		else :
	?>
		h4.site-title,
		p.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('storepress_str_replace_assoc')) {

    /**
     * storepress_str_replace_assoc
     */
    function storepress_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}



//Header Image
if ( ! function_exists( 'storepress_header_image' ) ) {
	function storepress_header_image(){
		if ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="custom-header" rel="home">
				<img src="<?php esc_url(header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
			</a>	
		<?php endif;
	}
}





// Header Contact
if ( ! function_exists( 'storepress_header_contact' ) ) {
	function storepress_header_contact() { 
	$hs_hdr_ct_info			=	get_theme_mod('hs_hdr_ct_info','1');
	$hdr_ct_info_icon		=	get_theme_mod('hdr_ct_info_icon','fa-headphones');
	$hdr_ct_info_ttl		=	get_theme_mod('hdr_ct_info_ttl'); 
	$hdr_ct_info_subttl		=	get_theme_mod('hdr_ct_info_subttl'); 
	$hdr_ct_info_link		=	get_theme_mod('hdr_ct_info_link'); 
	if($hs_hdr_ct_info == '1'): ?>
		<li class="content-list hdr-ct-info">
			<div class="widget-contact">
				<div class="contact-area">
					<?php if(!empty($hdr_ct_info_icon)): ?>
						<div class="contact-icon">
							<div class="contact-corn">
								<i class="fa <?php echo esc_attr($hdr_ct_info_icon); ?>"></i>
							</div>
						</div>
					<?php endif; ?>	
					<div class="contact-info">
						<?php if(!empty($hdr_ct_info_ttl)): ?>
							<h6 class="title"><?php echo wp_kses_post($hdr_ct_info_ttl); ?></h6>
						<?php endif; ?>	
						<?php if(!empty($hdr_ct_info_subttl)): ?>
							<p class="text">
								<?php if(!empty($hdr_ct_info_link)): ?><a href="<?php echo esc_url($hdr_ct_info_link); ?>"><?php endif; ?>
								<?php echo wp_kses_post($hdr_ct_info_subttl); ?>
								<?php if(!empty($hdr_ct_info_link)): ?></a><?php endif; ?>
							</p>	
						<?php endif; ?>	
					</div>
				</div>
			</div>
		</li>
	<?php endif; }
}



// Header Product categories
if ( ! function_exists( 'storepress_hdr_product_categories' ) ) {
	function storepress_hdr_product_categories() { 
	$hs_hdr_product_cat			=	get_theme_mod('hs_hdr_product_cat','1');
	if($hs_hdr_product_cat == '1'  && class_exists( 'woocommerce' )): ?>
		<div class="product-category-browse">
			<button type="button" class="product-category-btn"><span><i class="fa fa-navicon"></i><?php  esc_html_e('All Categories','storepress'); ?></span></button>
			<div class="product-category-menus">
				<div class="product-category-menus-list">
					<ul class="main-menu">
						<?php
						$categories = array(
							  'taxonomy' => 'product_cat',
							  'hide_empty' => false,
							  'parent'   => 0
						  );
						$product_cat = get_terms( $categories );
						foreach ($product_cat as $parent_product_cat) {
							$child_args = array(
								'taxonomy' => 'product_cat',
								'hide_empty' => false,
								'parent'   => $parent_product_cat->term_id
							);
							$thumbnail_id = get_term_meta( $parent_product_cat->term_id, 'thumbnail_id', true );
							$image = wp_get_attachment_url( $thumbnail_id );
							$child_product_cats = get_terms( $child_args );
							$storepress_product_cat_icon = get_term_meta($parent_product_cat->term_id, 'storepress_product_cat_icon', true);
							if ( ! empty($child_product_cats) ) {
								echo '<li class="menu-item menu-item-has-children"><a href="'.esc_url(get_term_link($parent_product_cat->term_id)).'" class="nav-link">'.(!empty($storepress_product_cat_icon) ? "<i class='fa {$storepress_product_cat_icon}'></i>":''); echo esc_html($parent_product_cat->name).'</a>';
							} else {
								echo '<li class="menu-item"><a href="'.esc_url(get_term_link($parent_product_cat->term_id)).'" class="nav-link">'.(!empty($storepress_product_cat_icon) ? "<i class='fa {$storepress_product_cat_icon}'></i>":''); echo esc_html($parent_product_cat->name).'</a>';
							}
							if ( ! empty($child_product_cats) ) {
								echo '<ul class="dropdown-menu">';
								foreach ($child_product_cats as $child_product_cat) {
								echo '<li class="menu-item"><a href="'.esc_url(get_term_link($child_product_cat->term_id)).'" class="dropdown-item">'.esc_html($child_product_cat->name).'</a></li>';
								} echo '</ul>';
							} echo '</li>';
						} ?>
					</ul>
				</div>
			</div>
		</div>
	<?php endif; }
}



if ( ! function_exists( 'storepress_logo' ) ) {
	function storepress_logo() {
			if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<h4 class="site-title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h4>
			</a>	
		<?php 						
			}
		?>
		<?php
			$storepress_site_description = get_bloginfo( 'description');
			if ($storepress_site_description) : ?>
				<p class="site-description"><?php echo esc_html($storepress_site_description); ?></p>
		<?php endif; 
	}
}



if ( ! function_exists( 'storepress_primary_menu_nav' ) ) {
	function storepress_primary_menu_nav() {
			wp_nav_menu( 
				array(  
					'theme_location' => 'primary_menu',
					'container'  => '',
					'menu_class' => 'main-menu',
					'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
					'walker' => new WP_Bootstrap_Navwalker()
					 ) 
				);
	}
}



/**
 * Breadcrumb Content
 */
 function storepress_breadcrumbs() {
	
	$showOnHome	= esc_html__('1','storepress'); 	// 1 - Show breadcrumbs on the homepage, 0 - don't show
	$delimiter 	= '';   // Delimiter between breadcrumb
	$home 		= esc_html__('Home','storepress'); 	// Text for the 'Home' link
	$showCurrent= esc_html__('1','storepress'); // Current post/page title in breadcrumb in use 1, Use 0 for don't show
	$before		= '<li class="active">'; // Tag before the current Breadcrumb
	$after 		= '</li>'; // Tag after the current Breadcrumb
	$storepress_page_seprator	= '>';
	global $post;
	$homeLink = home_url();

	if (is_home() || is_front_page()) {
 
	if ($showOnHome == 1) echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html(single_post_title()) . '</a></li>';
 
	} else {
 
    echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a> ' . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp';
 
    if ( is_category() ) 
	{
		$thisCat = get_category(get_query_var('cat'), false);
		if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . ' ');
		echo $before . esc_html__('Archive by category','storepress').' "' . esc_html(single_cat_title('', false)) . '"' .$after;
		
	} 
	
	elseif ( is_search() ) 
	{
		echo $before . esc_html__('Search results for ','storepress').' "' . esc_html(get_search_query()) . '"' . $after;
	} 
	
	elseif ( is_day() )
	{
		echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp';
		echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a> '. '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp';
		echo $before . esc_html(get_the_time('d')) . $after;
	} 
	
	elseif ( is_month() )
	{
		echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp';
		echo $before . esc_html(get_the_time('F')) . $after;
	} 
	
	elseif ( is_year() )
	{
		echo $before . esc_html(get_the_time('Y')) . $after;
	} 
	
	elseif ( is_single() && !is_attachment() )
	{
		if ( get_post_type() != 'post' )
		{
			if ( class_exists( 'WooCommerce' ) ) {
				if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . '&nbsp&nbsp' . $before . wp_kses_post(get_the_title()) . $after;
			}else{	
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
			if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp' . $before . wp_kses_post(get_the_title()) . $after;
			}
		}
		else
		{
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . esc_attr($delimiter) . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp');
			if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			echo $cats;
			if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;
		}
 
    }
		
	elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_shop() ) {
				$thisshop = woocommerce_page_title();
			}
		}	
		else  {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		}	
	} 
	
	elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) 
	{
		$post_type = get_post_type_object(get_post_type());
		echo $before . $post_type->labels->singular_name . $after;
	} 
	
	elseif ( is_attachment() ) 
	{
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); 
		if(!empty($cat)){
		$cat = $cat[0];
		echo get_category_parents($cat, TRUE, ' ' . esc_attr($delimiter) . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp');
		}
		echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
		if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
 
    } 
	
	elseif ( is_page() && !$post->post_parent ) 
	{
		if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;
	} 
	
	elseif ( is_page() && $post->post_parent ) 
	{
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) 
		{
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>' . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp';
			$parent_id  = $page->post_parent;
		}
		
		$breadcrumbs = array_reverse($breadcrumbs);
		for ($i = 0; $i < count($breadcrumbs); $i++) 
		{
			echo $breadcrumbs[$i];
			if ($i != count($breadcrumbs)-1) echo ' ' . esc_attr($delimiter) . '&nbsp' . wp_kses_post($storepress_page_seprator) . '&nbsp';
		}
		if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
 
    } 
	elseif ( is_tag() ) 
	{
		echo $before . esc_html__('Posts tagged ','storepress').' "' . esc_html(single_tag_title('', false)) . '"' . $after;
	} 
	
	elseif ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		echo $before . esc_html__('Articles posted by ','storepress').'' . $userdata->display_name . $after;
	} 
	
	elseif ( is_404() ) {
		echo $before . esc_html__('Error 404 ','storepress'). $after;
    }
	
    if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
		echo ' ( ' . esc_html__('Page','storepress') . '' . esc_html(get_query_var('paged')). ' )';
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
    }
 
    echo '</li>';
 
  }
}

if ( ! function_exists( 'storepress_header_search' ) ) {
	function storepress_header_search() {
		$hs_hdr_search = get_theme_mod( 'hs_hdr_search','1'); 
		if($hs_hdr_search == '1') {
		?>
			<li class="search-button">
				<button type="button" id="header-search-toggle" class="header-search-toggle" aria-expanded="false" aria-label="<?php esc_attr_e('Search Popup','storepress'); ?>"><i class="fa fa-search"></i></button>
				<!--===// Start: Header Search PopUp
				=================================-->
				<div class="header-search-popup">
					<div class="header-search-flex">
						<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"  aria-label="<?php esc_attr_e('Site Search','storepress'); ?>">
							<input type="search" class="form-control header-search-field" placeholder="<?php esc_attr_e('Type To Search','storepress'); ?>" name="s" id="search">
							<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
						</form>
						<button type="button" id="header-search-close" class="close-style header-search-close" aria-label="<?php esc_attr_e('Search Popup Close','storepress'); ?>"></button>
					</div>
				</div>
				<!--===// End: Header Search PopUp
				=================================-->
			</li>
		<?php	
		}
	}
}



if ( ! function_exists( 'storepress_header_cart' ) ) {
	function storepress_header_cart() {
		$hs_hdr_cart 			= get_theme_mod( 'hs_hdr_cart','1'); 
		if($hs_hdr_cart == '1' && class_exists( 'WooCommerce' )) {
		?>
			<li class="cart-wrapper">
				<div class="cart-main">
					<button type="button" class="cart-icon-wrap header-cart cart-trigger">
						<i class="fa fa-shopping-cart"></i>
						<?php 
							$count = WC()->cart->cart_contents_count;
							$cart_url = wc_get_cart_url();
							
							if ( $count > 0 ) {
							?>
								 <span class="cart-count"><?php echo esc_html( $count ); ?></span>
							<?php 
							}
							else {
								?>
								<span class="cart-count"><?php esc_html_e( '0', 'storepress' ); ?></span>
								<?php 
							}
						?>
					</button>
					<div class="cart-modal cart-modal-1">
						<div class="cart-container">
							<div class="cart-header">
								<div class="cart-top">
									<span class="cart-text"><?php esc_html_e('Shopping Cart','storepress'); ?></span>
									<a href="<?php echo esc_url('javascript:void(0)')?>" class="cart-close"><?php esc_html_e('CLOSE','storepress'); ?></a>
								</div>
							</div>
							<div class="cart-data">
								<?php get_template_part('woocommerce/cart/mini','cart'); ?>
							</div>	
						</div>
						<div class="cart-overlay"></div>
					</div>
				</div>
			</li>
		<?php	
		}
	}
}



// My Accout
if ( ! function_exists( 'storepress_header_my_acc' ) ) {
	function storepress_header_my_acc() {
		$hs_hdr_account 	= get_theme_mod( 'hs_hdr_account','1'); 
		if($hs_hdr_account == '1' && class_exists( 'woocommerce' )) {
	?>
		<li class="user">
			<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" class="user-btn"><i class="fa fa-user"></i></a>
		</li>
	<?php	
	} }
}

 /**
 * Add WooCommerce Cart Icon With Cart Count 
 */
function storepress_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?> 
	<?php
    if ( $count > 0 ) {
	?>
		 <span class="cart-count"><?php echo esc_html( $count ); ?></span>
	<?php 
	}
	else {
		?>
		<span class="cart-count"><?php esc_html_e('0','storepress')?></span>
		<?php 
	}
    ?>
	<?php
 
    $fragments['span.cart-count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'storepress_add_to_cart_fragment' );