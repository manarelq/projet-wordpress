<?php storepress_header_image();
$storepress_breadcrumb_bg_img= get_theme_mod('breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/breadcrumb.jpg')); 
?>
<header id="vf-header" class="vf-header" style="background: url('<?php echo esc_url($storepress_breadcrumb_bg_img); ?>') no-repeat center center / cover rgba(0, 0, 0, 0.82);background-blend-mode: multiply;">
	<?php do_action('storepress_top_header_data'); ?>
	<div id="vf-product-menu" class="vf-product-menu">
		<div class="container">
			<div class="row gx-2 product-menu-row">
				<div class="col-lg-3 col-12 my-auto">
					<div class="logo">
						<?php storepress_logo(); ?>
					</div>
				</div>
				<div class="col-lg-9 col-12 d-flex align-items-center flex-wrap justify-content-end my-auto">
					<?php
						$storepress_hs_hdr_search		=	get_theme_mod('hs_hdr_search','1');
						if($storepress_hs_hdr_search == '1'):
					?>
						<div class="header-search-form">
							<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
								<select class="header-search-select" name="product_cat">
									<option value=""><?php esc_html_e('All Categories', 'storepress'); ?></option> 
									<?php
									$categories = get_categories('taxonomy=product_cat');
									foreach ($categories as $category) {
										$option = '<option value="' . esc_attr($category->category_nicename) . '">';
										$option .= esc_html($category->cat_name);
										$option .= ' (' . absint($category->category_count) . ')';
										$option .= '</option>';
										echo $option; // WPCS: XSS OK.
									}
									?>
								</select>
								<input class="header-search-input search-field" name="s" type="text" placeholder="<?php esc_attr_e( 'Search Products', 'storepress' ); ?>" />
								<input type="hidden" name="post_type" value="<?php esc_attr_e( 'product', 'storepress' ); ?>" />
								<button class="header-search-button search-submit" type="submit"><i class="fa fa-search"></i></button>
							</form>                            
						</div>
					<?php endif; ?>
					<div class="main-menu-right">
						<ul class="menu-right-list">
							<?php if(class_exists( 'WooCommerce' )) {
								storepress_header_my_acc(); 
								storepress_header_cart(); 
							} ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="navigation-wrapper" class="navigation-wrapper">
		<div class="navigation-middle">
			<div class="main-navigation-area d-none d-lg-block">
				<div class="main-navigation <?php echo esc_attr(storepress_sticky_menu()); ?>">
					<div class="container">
						<div class="row navigation-middle-row">
							<div class="col-lg-3 col-12 my-auto">
								<?php storepress_hdr_product_categories(); ?>
							</div>
							<div class="col-lg-9 col-12 my-auto">
								<nav class="navbar-area">
									<div class="main-navbar">
										<?php storepress_primary_menu_nav(); ?>
									</div>
									<div class="main-menu-right">
										<ul class="menu-right-list">
											<?php storepress_header_contact(); ?>
										</ul>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-mobile-nav <?php echo esc_attr(storepress_sticky_menu()); ?>">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="main-mobile-menu">
							<div class="main-menu-right main-mobile-left">
								<div class="logo">
									<?php storepress_logo(); ?>
								</div>
							</div>
							<div class="menu-collapse-wrap">
								<div class="hamburger-menu">
									<button type="button" class="menu-collapsed" aria-label="<?php esc_attr_e('Menu Collaped','storepress'); ?>">
										<div class="top-bun"></div>
										<div class="meat"></div>
										<div class="bottom-bun"></div>
									</button>
								</div>
							</div>
							<div class="main-mobile-wrapper">
								<div id="mobile-menu-build" class="main-mobile-build">
									<button type="button" class="header-close-menu close-style" aria-label="<?php esc_attr_e('Header Close Menu','storepress'); ?>"></button>
								</div>
							</div>
							<?php if ( function_exists( 'vf_expansion_activate' ) ) : ?>
								<div class="header-above-wrapper">
									<div class="header-above-index">
										<div class="header-above-btn">
											<button type="button" class="header-above-collapse" aria-label="<?php esc_attr_e('Header Above Collapse','storepress'); ?>"><span></span></button>
										</div>
										<div id="header-above-bar" class="header-above-bar"></div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>