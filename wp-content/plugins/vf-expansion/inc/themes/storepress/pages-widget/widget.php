<?php
$theme = wp_get_theme(); // gets the current theme
if( 'MartPress' == $theme->name){
    $footer_logo = VF_EXPANSION_PLUGIN_URL .'inc/themes/martpress/assets/images/footer-logo.png';
}elseif( 'Qstore' == $theme->name){
    $footer_logo = VF_EXPANSION_PLUGIN_URL .'inc/themes/qstore/assets/images/logo.png';
}else{
     $footer_logo = VF_EXPANSION_PLUGIN_URL .'inc/themes/storepress/assets/images/logo_2.png';
}
$activate = array(
        'storepress-sidebar-primary' => array(
            'search-1',
            'recent-posts-1',
            'archives-1',
        ),
		'storepress-footer-1' => array(
            'text-1'
        ),
		'storepress-footer-2' => array(
            'text-2'
        ),
		'storepress-footer-3' => array(
            'text-3'
        )
    );
    /* the default titles will appear */
	update_option('widget_text', array(
        1 => array('title' => 'Useful Links',
        'text'=>'<ul id="menu-primar-menu" class="menu">
                                <li class="menu-item"><a href="javascript:void(0);">About Us</a></li>
                                <li class="menu-item"><a href="javascript:void(0);">My Account</a></li>
                                <li class="menu-item"><a href="javascript:void(0);">Best Seller</a></li>
                                <li class="menu-item"><a href="javascript:void(0);">Blog</a></li>
                                <li class="menu-item"><a href="javascript:void(0);">Contact</a></li>
                                <li class="menu-item"><a href="javascript:void(0);">Collections</a></li>
                            </ul>'),  
							
		 2 => array('title' => '',
        'text'=>'<div class="widget textwidget">
                            <a href="javascript:void(0);"><img src="'.$footer_logo.'" alt="image"></a>
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <a class="btn btn-primary" href="#">Read More</a>
                        </div><div class="widget widget_mail">
                            <h5 class="widget-title">Sign up to Get Lates Updates</h5>
                            <form role="mail" method="get" class="mail-form" action="/">
                                <label>
                                    <span class="screen-reader-text">Search for:</span>
                                    <input type="email" class="mail-field" placeholder="Your Email Address..." value="" name="e">
                                </label>
                                <button type="submit" class="submit">Subscribe Now</button>
                            </form>
                        </div>'),
		 3 => array('title' => '',
        'text'=>'<aside class="widget widget_opening">
                            <h5 class="widget-title">Opening Hours</h5>
                            <div class="opening-hours">
                                <dl class="st-grid-dl">
                                    <dt>Mon - Tues</dt>
                                    <dd>8AM – 4PM</dd>
                                    <dt>Wed - Thus</dt>
                                    <dd>9AM – 6PM</dd>
                                    <dt>Fri - Sat</dt>
                                    <dd>10AM – 5PM</dd>
                                    <dt>Sunday</dt>
                                    <dd>Emerg. Only</dd>
                                    <dt>Personal</dt>
                                    <dd>Mon - 11AM</dd>
                                </dl>
                            </div>
                        </aside><div class="widget widget_social">
                            <h5 class="widget-title">Follow Us</h5>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>'),					
        ));
		
		 update_option('widget_categories', array(
			1 => array('title' => 'Categories'), 
			2 => array('title' => 'Categories')));

		update_option('widget_archives', array(
			1 => array('title' => 'Archives'), 
			2 => array('title' => 'Archives')));
			
		update_option('widget_search', array(
			1 => array('title' => 'Search'), 
			2 => array('title' => 'Search')));	
		
    update_option('sidebars_widgets',  $activate);
	$MediaId = get_option('storepress_media_id');
	set_theme_mod( 'custom_logo', $MediaId[0] );