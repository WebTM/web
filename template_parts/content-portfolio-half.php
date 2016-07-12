<div id="portfolio-<?php the_ID(); ?>" class="col-md-6 col-sm-6 no-pad project image-holder <?php echo ebor_the_terms('portfolio_category', ' ', 'slug'); ?>">

	<div class="background-image-holder">
		<?php the_post_thumbnail('full', array('class' => 'background-image')); ?>
	</div>
	
	<div class="hover-state">
		<div class="align-vertical text-center">
			<?php the_title('<h1 class="text-white"><strong>', '</strong></h1>'); ?>
			<p class="text-white ebor-limit-width"><?php echo get_the_excerpt(); ?></p>
			<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-white">
				<?php echo get_option('portfolio_continue', 'See Project'); ?>
			</a>
		</div>
	</div>
	
</div>