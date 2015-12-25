<?php 

/**
 * Custom colours for the theme.
 * $handle is a reference to the handle used with wp_enqueue_style()
 */
function web_less_vars( $vars, $handle = 'ebor-theme-styles' ) {
    $vars['color-primary'] =       get_option('color-primary', '#e74c3c');
    $vars['color-secondary-1'] =   get_option('color-secondary-1', '#2c3e50');
    $vars['color-secondary-2'] =   get_option('color-secondary-2', '#3498db');
    $vars['color-bg-muted'] =      get_option('color-bg-muted', '#f4f4f4');
    $vars['color-bg-primary'] =    get_option('color-bg-primary', '#fff');
    $vars['color-text'] =          get_option('color-text', '#777777');
    $vars['color-heading'] =       get_option('color-heading', '#333333');
    $vars['color-borders'] =       get_option('color-borders', '#dddddd');
    $vars['color-twitter'] =       get_option('color-twitter', '#00a0d1');
    $vars['color-facebook'] =      get_option('color-facebook', '#3b5998');
    $vars['color-tumblr'] =        get_option('color-tumblr', '#34526f');
    $vars['color-pinterest'] =     get_option('color-pinterest', '#910101');
    $vars['color-dribbble'] =      get_option('color-dribbble', '#ea4c89');
    $vars['color-googleplus'] =    get_option('color-googleplus', '#C63D2D');
    $vars['standard-space'] =      get_option('theme_spacing', '80') . 'px';
    $vars['standard-radius'] =     get_option('theme_corners', '25') . 'px';
    $vars['short-transition'] =    get_option('short_transition','300') . 'ms';
    $vars['medium-transition'] =   get_option('medium_transition','500') . 'ms';
    $vars['long-transition'] =     get_option('long_transition','2000') . 'ms';
    $vars['body-font'] =           get_option('body_font', 'Open Sans');
    $vars['heading-font'] =        get_option('heading_font', 'Open Sans');
    $vars['alt-font'] =            get_option('alt_font', 'Raleway');
    $vars['color-link'] =          get_option('color-link', '#333333');
    $vars['color-link-hover'] =    get_option('color-link-hover', '#e74c3c');
    
    if( '' == $vars['body-font'] )
    	$vars['body-font'] = 'sans-serif';
    	
    if( '' == $vars['heading-font'] )
    	$vars['heading-font'] = 'sans-serif';
    	
    if( '' == $vars['alt-font'] )
    	$vars['alt-font'] = 'sans-serif';
    	
    return $vars;
}
add_filter( 'less_vars', 'web_less_vars', 10, 2 );


/**
 * Add body class so we know when we're using a page template from the page builder.
 */
if(!( function_exists('web_body_class') )){ 
    function web_body_class($c){
        global $post;
        if( isset($post->post_content) && has_shortcode( $post->post_content, 'vc_row' ) ) {
            $c[] = 'visual-composer-active';
        }
        return $c;
    }
    add_filter( 'body_class', 'web_body_class' );
}


/**
 * Add Search Link to Menu
 */
if(!( function_exists('web_one_page_nav_rewrite') )){ 
    function web_one_page_nav_rewrite($items, $args) {
        global $post;
        
        if(!( is_front_page() )){
            return str_replace('href="#', 'href="' . home_url() . '/#', $items);
        } else {
            return $items;
        }
    }
    if( get_option('site_version', 'multi-page') == 'one-page' )
        add_filter( 'wp_nav_menu_items', 'web_one_page_nav_rewrite', 20,2 );
}