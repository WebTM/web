<?php
	get_header();
	echo "dasdadadasa";
	the_post();
	
	$header_images = get_post_meta($post->ID, '_ebor_header_images', 1);
	
	if( is_array($header_images) ){
		get_template_part('inc/content','post-header');
	}
		
	get_template_part('inc/content-post-single', web_get_post_layout());
	
	get_footer();					