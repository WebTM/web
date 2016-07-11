<?php 

/**
 * Page builder blocks
 */

//Grab Page Header Shortcode
if(!( function_exists('web_page_header_shortcode') ))
	require_once('vc_blocks/vc_page_header_block.php');

//Grab Blog Shortcode
if(!( function_exists('web_blog_shortcode') ))
	require_once('vc_blocks/vc_blog_block.php');
