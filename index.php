<?php
/**
 *
 * @package webtm
 */

get_header(); 

	$background = get_option('blog_header_background');
	$title = get_option('blog_title','Our Blog');
	$sub = get_option('blog_subtitle', 'News & Views');

?>

	<header class="page-header">
		<?php if( $background ) : ?>
			<div class="background-image-holder parallax-background">
				<img class="background-image" alt="Background Image" src="<?php echo $background; ?>">
			</div>
		<?php endif; ?>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<?php
						if( $sub )
							echo '<span class="text-white alt-font">'. $sub .'</span>';
						
						if( $title )
							echo '<h1 class="text-white">'. $title .'</h1>';
					?>
				</div>
			</div><!--end of row-->
		</div><!--end of container-->
		
	</header>
	
	            <?php
            if (have_posts()) {
                the_post();

			get_template_part('content/blog', get_option('blog_layout','grid-sidebar'));
           
		   }
            ?>


<?php 

	/**
	 * Grab the correct blog loop depending on theme options.
	 */
	get_template_part('content/blog', get_option('blog_layout','grid-sidebar'));

get_footer(); ?>
