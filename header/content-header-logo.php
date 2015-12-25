<?php
	//images
	$attachments = explode(',', $image);
	
	if(is_array($attachments)) :
?>

<header class="page-header ebor-pad-me">

	<div class="background-image-holder parallax-background">
		<?php echo wp_get_attachment_image($attachments[0], 'full', false, array('class' => 'background-image')); ?>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<?php 
					if( isset( $attachments[1] ) )
						echo wp_get_attachment_image($attachments[1], 'full', false, array('class' => 'logo'));
						
					if( $small )
						echo '<span class="text-white alt-font">'. htmlspecialchars_decode($small) .'</span>';
					
					if( $big )
						echo '<h1 class="text-white space-bottom-medium">'. htmlspecialchars_decode($big) .'</h1>';
						
					if( $sub )	
						echo '<p class="lead text-white">'. htmlspecialchars_decode($sub) .'</p>';
				
					if( $shortcode )
						echo do_shortcode(htmlspecialchars_decode($shortcode));
				?>
			</div>
		</div>
	</div>
	
</header>

<?php endif;