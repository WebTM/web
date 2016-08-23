<?php 

/**
 * The Shortcode
 */
function web_portfolio_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => 'fullwidth',
				'pppage' => '999',
				'filter' => 'all',
				'show_filter' => 1
			), $atts 
		) 
	);
	
	/**
	 * Initial query args
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $pppage
	);
	
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
	
	ob_start();
?>

<section class="no-pad-bottom projects-gallery">
		<div class="projects-wrapper clearfix">
		
			<?php 
				if( 'Contained Portfolio' == $type )
					echo '<div class="divide60"></div>';
					
				if( 'Fullwidth Portfolio' == $type )
					echo '<h1> Portfolio</h1>';
					
				if( 'Yes' == $show_filter ){	
					$cats = get_categories('taxonomy=portfolio_category');
					echo web_portfolio_filters($cats); 
				}
			?>
	
			<?php if( 'Fullwidth Portfolio' == $type ) : ?> 
					
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
				
			<?php elseif( '2 Column Fullwidth' == $type ) : ?>
			
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
				
			<?php elseif( '4 Column Fullwidth' == $type ) : ?>
			
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
		
			<?php elseif( 'Contained Portfolio' == $type ) : ?>
				
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
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'web_portfolio', 'web_portfolio_shortcode' );

/**
 * The VC Functions
 */
function web_portfolio_shortcode_vc() {
	
	$portfolio_types = array(
		'none',
		'Contained Portfolio',
		'4 Column Fullwidth',
		'2 Column Fullwidth',
		'Fullwidth Portfolio'
	);
	
	vc_map( 
		array(
			"icon" => 'web-vc-block',
			"name" => __("Web - Portfolio"),
			"base" => "web_portfolio",
			"category" => __('Web', 'web'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Show How Many Posts?", 'web'),
					"param_name" => "pppage",
					"value" => '8',
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'web'),
					"param_name" => "type",
					"value" => $portfolio_types,
					"description" => 'description'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Filters?", 'web'),
					"param_name" => "show_filter",
					"value" => array(
						'Yes',
						'No'
					),
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'web_portfolio_shortcode_vc');