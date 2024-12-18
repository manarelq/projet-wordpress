<?php 
/**
Template Name:Page Full Width
*/

get_header();
?>
<div class="st-py-full">
	<div class="container">
		<div class="row g-4">
			<div class="col-lg-12">
				<?php 
					the_post(); the_content(); 
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>
			</div>
		</div>
	</div>
</div>
	
<?php get_footer(); ?>