<div id="portfolio-<?php the_ID(); ?>" class="col-md-4 col-sm-6 project image-holder <?php echo ebor_the_terms('portfolio_category', ' ', 'slug'); ?>">
	<div class="ebor-project-container">

		<div class="background-image-holder">
			<?php the_post_thumbnail('full', array('class' => 'background-image')); ?>
		</div>
		
		<div class="hover-state">
			<div class="align-vertical">
				<?php the_title('<h3 class="text-white"><strong>', '</strong></h3>'); ?>
				<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-white">
					<?php echo get_option('portfolio_continue', 'See Project'); ?>
				</a>
			</div>
		</div>
	
	</div>
</div>