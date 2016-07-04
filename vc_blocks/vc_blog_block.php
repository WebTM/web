<?php 

/**
 * The Shortcode
 */
function web_blog_shortcode( $atts ) {
	extract( 
		shortcode_atts( 
			array(
				'type' => '3 Column Grid',
				'pppage' => '6',
				'show_filter' => 'Yes'
			), $atts 
		) 
	);
	
	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'post',
		'posts_per_page' => $pppage,
		'paged' => $paged
	);
	
	$pagination = $show_filter;

	$block_query = new WP_Query( $query_args );
	
	ob_start();
?>

	<?php if( $type == 'Preview List' ) : ?>
		
		<ul class="blog-snippet-2">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'post-preview');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
		</ul>	
		<?php if( 1 == $pagination ) : ?>
			<div class="row">
				<div class="col-sm-12 text-center">
					<?php
						/**
						 * Post pagination, use ebor_pagination() first and fall back to default
						 */
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
					?>
				</div>
			</div>
		<?php endif; wp_reset_query(); ?>
		
	<?php elseif( $type == '3 Column Grid' ) : ?>
		
		<div class="row">
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
		
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'post-grid');
					
					if( ($block_query->current_post + 1) % 3 == 0 && !( ($block_query->current_post + 1) == $block_query->post_count ) )
						echo '</div><div class="row">';
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
			<?php if( 1 == $pagination ) : ?>
				<div class="col-sm-12">
					<?php
						/**
						 * Post pagination, use ebor_pagination() first and fall back to default
						 */
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
					?>
				</div>
			<?php endif; wp_reset_query(); ?>
		</div>
		
	<?php elseif( $type == '2 Column Grid & Sidebar' ) : ?>
	
		<div class="row">
			<div class="col-md-9">
				<div class="row">
				
					<?php 
						if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
				
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'post-grid-sidebar');
							
							if( ($block_query->current_post + 1) % 2 == 0 && !( ($block_query->current_post + 1) == $block_query->post_count ) )
								echo '</div><div class="row">';
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
					?>
					
				</div>
				<?php if( 1 == $pagination ) : ?>
					<div class="row">
						<div class="col-sm-12">
							<?php
								/**
								 * Post pagination, use ebor_pagination() first and fall back to default
								 */
								echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
							?>
						</div>
					</div>
				<?php endif; wp_reset_query(); ?>
			</div>
			
			<?php get_sidebar(); ?>
		</div>
		
	<?php elseif( $type == 'Masonry Grid' ) : ?>
		
		<div class="row">
			<div class="blog-masonry-container">
				
				<?php 
					if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
						
						/**
						 * Get blog posts by blog layout.
						 */
						get_template_part('loop/content', 'post-masonry');
					
					endwhile;	
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
				?>
			
			</div><!--end of blog masonry container-->
			<?php if( 1 == $pagination ) : ?>
				<div class="col-sm-12">
					<?php
						/**
						 * Post pagination, use ebor_pagination() first and fall back to default
						 */
						echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
					?>
				</div>
			<?php endif; wp_reset_query(); ?>
		</div><!--end of row-->
		
	<?php elseif( $type == 'Masonry Grid & Sidebar' ) : ?>
		
		<div class="row">
		
			<div class="col-md-9">
				<div class="row">
					<div class="blog-masonry-container">
			
						<?php 
							if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content', 'post-masonry-sidebar');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
						?>
			
					</div><!--end of blog masonry container-->
					<?php if( 1 == $pagination ) : ?>
						<div class="col-sm-12">
							<?php
								/**
								 * Post pagination, use ebor_pagination() first and fall back to default
								 */
								echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
							?>
						</div>
					<?php endif; wp_reset_query(); ?>
				</div>
			</div>
			
			<?php get_sidebar(); ?>
			
		</div><!--end of row-->
		
	<?php elseif( $type == 'Big List' ) : ?>
		
		<section class="blog-list-3 bg-white">
		
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'post-list');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
			
			<?php if( 1 == $pagination ) : ?>
				<div class="blog-snippet-3">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
								<?php
									/**
									 * Post pagination, use ebor_pagination() first and fall back to default
									 */
									echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
								?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; wp_reset_query(); ?>
			
		</section>
		
	<?php elseif( $type == 'Big List With Background Images' ) : ?>
	
		<section class="blog-list-3 bg-white">
		
			<?php 
				if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();
					
					/**
					 * Get blog posts by blog layout.
					 */
					get_template_part('loop/content', 'post-list-image');
				
				endwhile;	
				else : 
					
					/**
					 * Display no posts message if none are found.
					 */
					get_template_part('loop/content','none');
					
				endif;
			?>
			
			<?php if( 1 == $pagination ) : ?>
				<section>
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<?php
									/**
									 * Post pagination, use ebor_pagination() first and fall back to default
									 */
									echo function_exists('ebor_pagination') ? ebor_pagination($block_query->max_num_pages) : posts_nav_link();
								?>
							</div>	
						</div><!--end of row-->
					</div><!--end of container-->
				</section>
			<?php endif; wp_reset_query(); ?>
			
		</section>
		
	<?php endif; ?>
			
<?php	
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'web_blog', 'web_blog_shortcode' );

/**
 * The VC Functions
 */
function web_blog_shortcode_vc() {
	
	$blog_types = array(
		'Preview List',
		'3 Column Grid',
		'2 Column Grid & Sidebar',
		'Masonry Grid',
		'Masonry Grid & Sidebar',
		'Big List',
		'Big List With Background Images'
	);
	
	vc_map( 
		array(
			"icon" => 'web-vc-block',
			"name" => __("Web - Blog"),
			"base" => "web_blog",
			"category" => __('web - Feeds', 'web'),
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
					"value" => $blog_types,
					"description" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => __("Show Pagination?", 'web'),
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
add_action( 'vc_before_init', 'web_blog_shortcode_vc');