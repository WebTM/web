<?php 


if(!( function_exists('web_get_header_layout') )){
	function web_get_header_layout(){
		global $post;
		
		if(!( isset($post->ID) ))
			return get_option('header_layout', 'overlay');
		
		$header = get_post_meta($post->ID, '_web_header_override', 1);
		
		if( '' == $header || false == $header || 'none' == $header ){
			$header = get_option('header_layout', 'overlay');
		}
		
		return $header;	
	}
}

if(!( function_exists('web_get_header_options') )){
	function web_get_header_options(){
		$options = array(
			'blank' => 'No Header or Nav',
			'top' => 'Top Bar Header',
			'overlay' => 'Overlay Bar Header',
			'offscreen' => 'Offscreen Header',
			'fullscreen' => 'Fullscreen Header',
			'contained' => 'Contained Header',
			'center' => 'Center Header',
			'bar' => 'Simple Bar Header'
		);
		return $options;	
	}
}

if(!( function_exists('web_get_post_layouts') )){
	function web_get_post_layouts(){
		$options = array(
			'standard' => 'Centered Layout',
			'sidebar' => 'Post with Sidebar',
			'alt' => 'Author on Left'
		);
		return $options;	
	}
}

if(!( function_exists('web_get_blog_layouts') )){
	function web_get_blog_layouts(){
		$options = array(
			'preview' => 'Preview List',
			'grid' => '3 Column Grid',
			'grid-sidebar' => '2 Column Grid & Sidebar',
			'masonry' => 'Masonry Grid',
			'masonry-sidebar' => 'Masonry Grid & Sidebar',
			'list' => 'Big List',
			'list-images' => 'Big List With Background Images'
		);
		return $options;	
	}
}
