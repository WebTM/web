<?php 
	get_header(); 
	
	$term = get_queried_object();
	$title = $term->name;
?>

	<section class="dark-wrapper">
		
		<?php if( $title ) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
						<?php echo '<h1>'. htmlspecialchars_decode($title) .'</h1>'; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<div class="container">	
			<div class="row">
				
				<?php get_template_part('loop/loop', get_option('team_layout', 'team-large')); ?>
				
			</div>
		</div>
		
	</section>

<?php get_footer();