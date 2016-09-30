<?php 
	global $post;
	$header_images = array_keys(get_post_meta($post->ID, '_ebor_header_images', 1));
	
	$sub = ( is_singular('portfolio') ) ? '<span class="sub alt-font text-white">'. ebor_the_terms('portfolio_category', ', ', 'name') .'</span>' : '<span class="sub alt-font text-white">'. get_the_date() .' - '. ebor_post_reading_time() .'</span>';
	
	if(!( isset($header_images[1]) )) :
?>

	<header class="title ebor-pad-me">
			
		<div class="background-image-holder parallax-background">
			<?php echo wp_get_attachment_image($header_images[0], 'full', false, array('class' => 'background-image')); ?>
		</div>
		
		<div class="container align-bottom">
			<div class="row">
				<div class="col-xs-12">
					<?php 
						the_title('<h1 class="text-white">', '</h1>');
						echo $sub;
					?>
				</div>
			</div>
		</div>
			
	</header>

<?php else : ?>
	
	<section class="title hero-slider ebor-pad-me">
	
		<ul class="slides">
			
			<?php foreach( $header_images as $header_image ) : ?>
				
				<li class="overlay">
					<div class="background-image-holder parallax-background">
						<?php echo wp_get_attachment_image( $header_image, 'full', 0, array('class' => 'background-image') ); ?>
					</div>
					
					<div class="container align-bottom">
						<div class="row">
							<div class="col-md-6 col-sm-9">
								<?php 
									the_title('<h1 class="text-white">', '</h1>');
									echo $sub;
								?>
							</div>
						</div>
					</div>
				</li>
				
			<?php endforeach; ?>
	
		</ul>
		
	</section>
	
<?php endif;