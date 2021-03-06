<?php 

/**
 * Page builder blocks below here
 * Whoop-dee-doo
 */

//Grab Page Header Shortcode
if(!( function_exists('web_page_header_shortcode') ))
	require_once get_template_directory() . '/vc_blocks/vc_page_header_block.php';

//Grab Section Title Shortcode
if(!( function_exists('web_section_title_shortcode') ))
	require_once get_template_directory() . '/vc_blocks/vc_section_title_block.php';
	
//Grab Text Shortcode
if(!( function_exists('web_text_shortcode') ))
	require_once get_template_directory() . '/vc_blocks/vc_text_block.php';
	
	//Grab Portfolio Shortcode
if(!( function_exists('ebor_portfolio_shortcode') ))
	require_once get_template_directory() . '/vc_blocks/vc_portfolio_block.php';
	