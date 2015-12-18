<?php 

/**
 * Grab all VC Functions
 */
require_once('admin/vc_functions.php');

/**
 * Grab all VC Base layouts
 */
require_once('admin/vc_layouts.php');

/**
 * Page builder blocks below here
 * Whoop-dee-doo
 */

//Grab Page Header Shortcode
if(!( function_exists('web_page_header_shortcode') ))
	require_once('vc_blocks/vc_page_header_block.php');
