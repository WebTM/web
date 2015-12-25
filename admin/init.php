<?php

/**
 * Theme functions init
 */

require_once ( 'theme_functions.php' );
require_once ( 'theme_filters.php' );

/**
 * PLUGINS
 * CMB2 is a developer's toolkit for building metaboxes, custom fields, and forms for WordPress that will blow your mind 
 * https://github.com/WebDevStudios/CMB2/wiki/Basic-Usage
 */
require_once ( 'theme_metaboxes.php' );


require_once ( 'web_options.php' );


if( is_admin() ){
	require_once ( 'theme_options.php' );
}