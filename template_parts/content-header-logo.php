<!--header start-->
<?php
	//images
	$attachments = explode(',', $image);
	if(is_array($attachments)) :
?>

<header class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php 
					// if( isset( $attachments[0] ) )
						// echo wp_get_attachment_image($attachments[0], 'full', false, array('class' => 'logo'));
						
					// if( $small )
						// echo '<span class="alt-font">'. htmlspecialchars_decode($small) .'</span>';
					
					// if( $big )
						// echo '<h1 class="space-bottom-medium">'. htmlspecialchars_decode($big) .'</h1>';
						
					// if( $sub )	
						// echo '<p class="lead">'. htmlspecialchars_decode($sub) .'</p>';



					if( $big )
						echo '<h1>UI</h1>';
						
					
						echo '<p class="lead">Создание сайта на Wordpress</p>';
					
					echo '<span>
Весь комплекс услуг: от карандашного наброска, разработки прототипа и дизайн-макета будущего сайта до верстки, интеграции на WordPress, последующего продвижения и сопровождения проекта.
					'. htmlspecialchars_decode($small) .'</span>';
				
					if( $shortcode )
						echo do_shortcode(htmlspecialchars_decode($shortcode));
				?>
			</div>
		</div>
	</div>	
</header>
<!--header end-->
<?php endif;
