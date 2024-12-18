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

?>

    <?php if( ! is_404() ){ ?>
    	</div><!-- #content -->
    <?php } ?>
    
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
        
    </div><!-- .container -->
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
