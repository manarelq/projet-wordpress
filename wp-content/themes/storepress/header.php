<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>
<body <?php body_class('homepage-two header-two');?> >
<?php wp_body_open(); ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="<?php echo esc_url('#content'); ?>"><?php esc_html_e( 'Skip to content', 'storepress' ); ?></a>
	
	<?php 
		do_action('storepress_page_header');	
		if ( !is_page_template( 'templates/template-frontpage.php' )) {
			storepress_breadcrumbs_style();  
		}
	?>
	
	<div id="content" class="storepress-content">
	