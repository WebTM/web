<?php
	/**
	 * The default page template for Pivot
	 * Various checks used to see if we're running a template for various plugins
	 * Falls back to a standard page with a sidebar if that's what we need.
	 * 
	 * @author tommusrhodus
	 * @since 1.0.0
	 */
	get_header();
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
	
	$bbpress = false;
	$is_woocommerce = false;
	
	if( function_exists('is_bbpress') ){
		if( is_bbpress() ){
			$bbpress = true;
		}
	}
	
	if( function_exists('ebor_is_woocommerce') ){
		if( ebor_is_woocommerce() ){
			$is_woocommerce = true;
		}
	}
	
	if( $bbpress )
		get_template_part('inc/content', 'bbpress-header');
?>

	<section class="article-single dark-wrapper">
		<div class="container">
		
			<div class="row">
			
				<div class="col-sm-9">
					<div id="page-<?php the_ID(); ?>" <?php post_class('article-body'); ?>>
						<?php
							the_content();
							wp_link_pages();
						?>
					</div><!--end of article body-->
				</div>
				
				<?php 
					/**
					 * Grab the sidebar
					 * Check if we're running a plugin template first though.
					 */
					if( $bbpress ){ 
						get_sidebar('forums');
					} elseif( $is_woocommerce ){
						get_sidebar('shop');
					} else { 
						get_sidebar('page'); 
					}
				?>
				
			</div><!--end of row-->
			
		</div><!--end of container-->	
	</section>

<?php
	endif;
	 
	get_footer();		