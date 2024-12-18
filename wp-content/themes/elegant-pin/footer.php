<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elegant_Pink
 */
$instagram            = get_theme_mod( 'ed_blossom_instagram_shortcode',true );
$newsletter           = get_theme_mod( 'ed_blossom_newsletter_shortcode',true );
$newsletter_shortcode = get_theme_mod( 'blossom_newsletter_shortcode');
?>
    </div><!-- .container -->
    <?php if( ! is_404() ){ ?>
        </div><!-- #content -->
    <?php } ?>
    <?php elegant_pin_blossom_instagram(); ?>
    <?php elegant_pin_blossom_newsletter(); ?>
        <div class="container">
        <footer class="site-footer">
            <?php if( is_active_sidebar('footer-one') || is_active_sidebar('footer-two') || is_active_sidebar('footer-three') ){?>
            <div class="row">
                
                <?php if(is_active_sidebar('footer-one')){ ?>
                    <div class="col">
                        <?php dynamic_sidebar('footer-one'); ?>
                    </div>
                <?php }?>
                
                
                <?php if(is_active_sidebar('footer-two')){ ?>
                    <div class="col">
                        <?php dynamic_sidebar('footer-two'); ?>
                    </div>
                <?php }?>               
                
                <?php if(is_active_sidebar('footer-three')){ ?>
                    <div class="col">
                        <?php dynamic_sidebar('footer-three'); ?>
                    </div>
                <?php }?>
                
            </div>
            <?php } 
            
            /**
             * @see elegant_pink_footer_credit
            */
            do_action( 'elegant_pink_footer' ); //footer credits
            ?>
        </footer>
        <div class="overlay"></div>
        </div>
    
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
