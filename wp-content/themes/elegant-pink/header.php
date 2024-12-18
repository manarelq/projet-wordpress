<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegant_Pink
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="https://schema.org/WebSite">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'elegant-pink' ); ?></a>
    <div id="mobilemasthead" class="mobile-site-header">
        <div class="container">
            <div class="mobile-site-branding" itemscope itemtype="https://schema.org/Organization">
                <?php 
                if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                    the_custom_logo();
                }
                ?>
                <div class="text-logo">
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php         
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) { ?>
                    <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php } ?> 
                </div>           
            </div><!-- .site-branding -->
            <button class="btn-menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="mobile-menu">
            
            <nav id="mobile-site-navigation" class="mobile-main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                    <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                    <?php get_search_form(); ?>
                    <div class="mobile-menu-title" aria-label="<?php esc_attr_e( 'Mobile', 'elegant-pink' ); ?>">
                        <?php 
                        wp_nav_menu( array( 
                            'theme_location' => 'primary', 
                            'menu_id'        => 'mobile-primary-menu',
                            'menu_class'     => 'nav-menu main-menu-modal', 
                        ) ); 
                        ?>
                    </div>
                    <?php if( get_theme_mod( 'elegant_pink_ed_social', '1' ) ) do_action( 'elegant_pink_social' ); ?>
                </div>
               
            </nav><!-- #mobile-site-navigation -->
            
        </div>
        
    </div>	

	<header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
		<div class="container">
			
            <div class="header-t">
    			<?php if( get_theme_mod( 'elegant_pink_ed_social', '1' ) ) do_action( 'elegant_pink_social' ); ?>
    			<?php get_search_form(); ?>
			</div>
            
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                <?php 
                if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                    the_custom_logo();
                }
                if ( is_front_page() || is_home() ) : ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
                else : ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                <?php
                endif;          
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) { ?>
                <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php } ?>            
            </div><!-- .site-branding -->
            
        </div><!-- .container -->
   </header><!-- #masthead -->
   
    <div class="nav">
        <div class="container">         
            <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
		  	   <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'elegant-pink' ); ?></button>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
        </div>
    </div>
    
    <?php 
    
        if ( is_front_page() ) {
            if( get_theme_mod( 'elegant_pink_ed_slider' ) ) do_action( 'elegant_pink_slider' );
        }    
    ?>
    
    <div class="container">
        <?php if( ! is_404() ) { ?>
            <div id="content" class="site-content">
        <?php } ?>
