<?php 

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function web_vcSetAsTheme() {
		vc_set_as_theme();
	}
	add_action( 'vc_before_init', 'web_vcSetAsTheme' );
}

function web_vc_add_attr(){
	/**
	 * Add background atrributes to VC Rows
	 */
	$attributes = array(
		'type' => 'dropdown',
		'heading' => "Background Style",
		'param_name' => 'background_style',
		'value' => array_flip(array(
			'' => 'Standard Settings',
			'full' => 'Fullwidth Section',
			'light-wrapper' => 'Light Background',
			'dark-wrapper' => 'Dark Background',
			'bg-primary' => 'Primary Highlight Colour Background',
			'bg-secondary-1' => 'Secondary Highlight Colour Background',
			'bg-secondary-2 ' => 'Secondary Highlight 2 Colour Background',
			'image' => 'Parallax Background Image (Full Width)',
			'image-left' => 'Image Left, Content on Right',
			'image-right' => 'Image Right, Content on Left'
		)),
		'description' => "Choose Background Style For This Row"
	);
	vc_add_param('vc_row', $attributes);
	
	/**
	 * Add smooth scroll
	 */
	$attributes = array(
		'type' => 'textfield',
		'heading' => "Single Page Scroll ID",
		'param_name' => 'single_link',
		'value' => '',
		'description' => "Enter a lowercase scroll id to link the menu to, no spaces or special characters."
	);
	vc_add_param('vc_row', $attributes);
	
}
add_action('init', 'web_vc_add_attr', 999);