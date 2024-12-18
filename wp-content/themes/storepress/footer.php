</div>
<?php 
	get_template_part('template-parts/sections/section','footer');
?>
<?php $storepress_hs_scroller =	get_theme_mod('hs_scroller','1');
if ($storepress_hs_scroller == '1') { ?>
	<button type="button" class="scrollUp scroll-btn" aria-label="<?php esc_attr_e('scrollUp','storepress'); ?>"><i class="fa fa-angle-up"></i></button>
<?php } ?>			

</div>		
<?php wp_footer(); ?>
</body>
</html>
