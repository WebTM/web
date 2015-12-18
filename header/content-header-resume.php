<?php
	/**
	 * First we want to gather together all our meta, and perform appropriate checks.
	 */	
	 
	//images
	$attachments = explode(',', $image);
	$protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype');
	
	if(is_array($attachments)) :
?>

<header class="page-header resume-header ebor-pad-me">
	
	<div class="background-image-holder parallax-background">
		<?php echo wp_get_attachment_image($attachments[0], 'full', false, array('class' => 'background-image')); ?>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php
					if( $small )
						echo '<span class="text-white alt-font">'. htmlspecialchars_decode($small) .'</span>';
						
					if( $big )
						echo '<h1 class="text-white space-bottom-medium">'. htmlspecialchars_decode($big) .'</h1>';
					
					if( $sub )
						echo '<span>'. htmlspecialchars_decode($sub) .'</span>';
				?>
				<ul class="social-icons">
					<?php
						for( $i = 1; $i < 4; $i++ ){
							if( get_option("header_social_url_$i") ) {
								echo '<li>
									      <a href="' . esc_url(get_option("header_social_url_$i"), $protocols) . '" target="_blank">
										      <i class="icon ' . get_option("header_social_icon_$i") . '"></i>
									      </a>
									  </li>';
							}
						} 
					?>
				</ul>
			</div>
		</div><!--end of row-->
	</div><!--end of container-->
</header>

<?php endif;