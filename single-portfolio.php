<?php
	/*
	Template Name: Portfolio
	*/
	get_header();
	echo get_post_format_string( get_post_format() );
	the_post();
	
	/**
	 * Check if we have a template shortcode (page builder) in the post content
	 * If we do, that's all we want to show, as in, we don't want surrounding markup.
	 * 
	 * If this is just plain content (no template shortcode) then we'll output a more traditional markup based post.
	 */
	if( has_shortcode(get_the_content(), 'template') || has_shortcode(get_the_content(), 'vc_row') ) :
	
		the_content();
	
	/**
	 * If there's no template shortcode in the content, just display a more standard post instead.
	 */	
	else :
	
	$header_images = get_post_meta($post->ID, '_ebor_header_images', 1);
	
	if( is_array($header_images) )
		get_template_part('template_parts/content','post-header');
?>
	
	<section class="portfolio-item">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-8 col-sm-offset-1">
					<div <?php post_class('article-body'); ?>>
						<?php
							get_template_part('postformats/format', get_post_format());
							
							if(!( is_array($header_images) )){
								echo '<header class="title">';
								the_title('<h1>', '</h1>');	
								echo '<span class="sub alt-font">'. ebor_the_terms('portfolio_category', ', ', 'name') .'</span></header>';
							}
							
							the_content();
							wp_link_pages();
						?>
					</div>
				</div>
			
			</div>
		</div>
	</section>

<?php 
	endif; //end the template shortcode check
	
	/**
	 * Get the related portfolio posts for this
	 */
	if( get_option('portfolio_related', '1') == '1' )
		get_template_part('template_parts/loop','portfolio-related');
		
	get_footer();