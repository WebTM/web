<?php 
	get_header();
	
	$term = get_queried_object();
	$title = $term->name;
?>

	<section class="projects-gallery dark-wrapper">
		
		<?php if( $title ) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
						<?php echo '<h1>'. htmlspecialchars_decode($title) .'</h1>'; ?>
					</div>
				</div>
			</div>
			<div class="divide60"></div>
		<?php endif; ?>
		
		<div class="projects-wrapper clearfix">
			<?php get_template_part('loop/loop', get_option('portfolio_layout', 'portfolio-fullwidth')); ?>
		</div>
		
	</section>

<?php get_footer();