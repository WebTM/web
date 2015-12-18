<div class="col-md-4 col-sm-6">
	<div class="blog-snippet-1">
		
		<?php if( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('blog-grid'); ?>
			</a>
		<?php endif; ?>
		
		<?php the_title('<h2><a href="'. get_permalink() .'">', '</a></h2>'); ?>
		
		<span class="sub alt-font">
			<?php 
				_e('Published on ','pivot'); 
				the_time( get_option('date_format') );
			?>
		</span>
		
		<?php the_excerpt(); ?>
		
		<a href="<?php the_permalink(); ?>" class="link-text">
			<?php echo get_option('blog_continue', 'Read More'); ?>
		</a>
		
	</div>
</div>