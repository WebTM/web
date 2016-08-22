<?php

class AQ_Portfolio_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Portfolio',
			'size' => 'span12',
			'resizable' => 0,
			'block_description' => 'Add a feed of Portfolio posts to the page.',
			'block_category' => 'feeds',
			'block_icon' => '<i class="fa fa-fw fa-paint-brush"></i>'
		);
		parent::__construct('aq_portfolio_block', $block_options);
	}//end construct
	
	function form($instance) {
		$defaults = array(
			'type' => 'fullwidth',
			'pppage' => '999',
			'filter' => 'all',
			'show_filter' => 1
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio_category'
		); 
			
		$filter_options = get_categories( $args );
		
		$portfolio_types = array(
			'half' => 'Fullwidth Portfolio (2 Columns)',
			'fullwidth' => 'Fullwidth Portfolio',
			'quarter' => 'Fullwidth Portfolio (4 Columns)',
			'contained' => 'Contained Portfolio',
		);
	?>
		
		<p class="description">Portfolio Style</p>
		<?php echo aq_field_select('type', $block_id, $portfolio_types, $type) ?>
		
		<p class="description">Load how many items? 999 for all. <code>Note: The Portfolio is not Paged</code></p>
		<?php echo aq_field_input('pppage', $block_id, $pppage, $size = 'full', $type = 'number') ?>
		
		<p class="description">Show a specific portfolio category?</p>
		<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
		
		<p class="description">Show Portfolio Filters?</p>
		<?php echo aq_field_checkbox('show_filter', $block_id, $show_filter) ?>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		/**
		 * Initial query args
		 */
		$query_args = array(
			'post_type' => 'portfolio',
			'posts_per_page' => $pppage
		);
		
		/**
		 * If we're choosing just 1 category, add more args.
		 * ALL THE ARGS!
		 */
		if (!( $filter == 'all' )) {
			if( function_exists( 'icl_object_id' ) ){
				$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
			}
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'id',
					'terms' => $filter
				)
			);
		}
		
		/**
		 * Finally, here's the query.
		 */
		$block_query = new WP_Query( $query_args );
		
		/**
		 * Now let's grab categories for the animated portfolio filter buttons
		 */
		$cats = ( $filter == 'all' ) ? get_categories('taxonomy=portfolio_category') : get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	?>
	
		<section class="no-pad-bottom projects-gallery">
			<div class="projects-wrapper clearfix">
			
				<?php 
					if( 'contained' == $type )
						echo '<div class="divide60"></div>';
						
					if( 1 == $show_filter )
						echo web_portfolio_filters($cats); 
				?>
		
				<?php if( 'fullwidth' == $type ) : ?>

					<div class="projects-container">
					
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('template_parts/content', 'portfolio-fullwidth');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('template_parts/content','none');
								
							endif;
							wp_reset_query();
						?>
					
					</div><!--end of projects-container-->
					
				<?php elseif( 'half' == $type ) : ?>
				
					<div class="projects-container">
					
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('template_parts/content', 'portfolio-half');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('template_parts/content','none');
								
							endif;
							wp_reset_query();
						?>
					
					</div><!--end of projects-container-->
					
				<?php elseif( 'quarter' == $type ) : ?>
				
					<div class="projects-container">
					
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('template_parts/content', 'portfolio-quarter');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('template_parts/content','none');
								
							endif;
							wp_reset_query();
						?>
					
					</div><!--end of projects-container-->
			
				<?php elseif( 'contained' == $type ) : ?>
					
					<div class="row">
						<div class="projects-container column-projects">
							<?php 
								if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
									
									/**
									 * Get blog posts by blog layout.
									 */
									get_template_part('template_parts/content', 'portfolio-contained');
								
								endwhile;	
								else : 
									
									/**
									 * Display no posts message if none are found.
									 */
									get_template_part('template_parts/content','none');
									
								endif;
								wp_reset_query();
							?>
						</div><!--end of projects-container-->
					</div>
			
				<?php endif; ?>
	
			</div><!--end of projects wrapper-->
		</section>
	
	<?php
	}//end block
	
}//end class