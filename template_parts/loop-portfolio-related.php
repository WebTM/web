<?php
	global $post;
	
	/**
	 * First, grab post terms.
	 */
	$terms = get_the_terms( $post->ID , 'portfolio_category', 'string');
	
	/**
	 * Return if this post has no terms
	 */
	if(!( $terms ))
		return false;
	
	/**
	 * Now we know that we definitely have terms to work with, build and array of term id's
	 */	
	$term_ids = array_values( wp_list_pluck( $terms, 'term_id' ) );
	
	/**
	 * Set our arguments for finding related posts
	 */
	$related_args = array(
		'post_type' => 'portfolio',
		'tax_query' => array(
			array(
				 'taxonomy' => 'portfolio_category',
				 'field' => 'id',
				 'terms' => $term_ids,
				 'operator'=> 'IN'
			)
		),
		'posts_per_page' => '3',
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand',
		'post__not_in'=> array(
			$post->ID
		)
	);
	
	/**
	 * Build the related posts query based on what we've grabbed above
	 */
	$related_query = new WP_Query( $related_args );
	
	if ( $related_query->have_posts() && $related_query->post_count >= 3 ) :
?>
	
<section class="no-pad-bottom no-pad-top projects-gallery">
	<div class="projects-wrapper clearfix">
		<div class="projects-container">
			
			<?php  
				while ( $related_query->have_posts() ) : $related_query->the_post();
				
					get_template_part('loop/content','portfolio-fullwidth');
					
				endwhile; 
			?>

		</div><!--end of projects-container-->
	</div><!--end of projects wrapper-->
</section>

<?php elseif( $related_query->have_posts() && $related_query->post_count == 2 ) : ?>

<section class="no-pad-bottom no-pad-top projects-gallery">
	<div class="projects-wrapper clearfix">
		<div class="projects-container">
			
			<?php  
				while ( $related_query->have_posts() ) : $related_query->the_post();
				
					get_template_part('loop/content','portfolio-half');
					
				endwhile; 
			?>

		</div><!--end of projects-container-->
	</div><!--end of projects wrapper-->
</section>
	
<?php
	endif;
	
	wp_reset_query();