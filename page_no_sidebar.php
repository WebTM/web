<?php
	/*
	Template Name: Default Template - No Sidebar
	*/
	get_header();
	the_post();
?>

	<section class="article-single dark-wrapper">
		<div class="container">
		
			<div class="row">
				<div class="col-md-12">
					<div id="page-<?php the_ID(); ?>" <?php post_class('article-body'); ?>>
						<?php
							the_content();
							wp_link_pages();
						?>
					</div><!--end of article body-->
				</div>
			</div><!--end of row-->
			
		</div><!--end of container-->	
	</section>

<?php get_footer();