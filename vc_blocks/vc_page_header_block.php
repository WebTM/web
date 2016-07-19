<?php 

/**
 * The Shortcode
 */
function web_page_header_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'layout' => 'slider',
				'image' => '',
				'mpfour' => '',
				'ogv' => '',
				'webm' => '',
				'small' => '',
				'big' => '',
				'sub' => '',
				'shortcode' => '',
				'youtube' => '',
				'blog_posts' => 0
			), $atts 
		) 
	);
	
	$shortcode = $content;
	
	ob_start();
	?>
	
	<div class="aq-block-aq_page_header_block">
		<?php include( locate_template('template_parts/content-header-' . $layout . '.php') ); ?>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'web_page_header', 'web_page_header_shortcode' );

/**
 * The VC Functions
 */
function web_page_header_shortcode_vc() {
	
	$header_options = array(
		'slider',
		'video',
		'simple',
		'simple-centered',
		'product',
		'resume',
		'personal',
		'logo',
		'fullscreen-single',
		'map',
		'form',
		'call-to-action'
	);
	
	vc_map( 
		array(
			"icon" => 'web-vc-block',
			"name" => __("Web - Header"),
			"base" => "web_page_header",
			"category" => __('Web', 'web'),
			"params" => array(
				array(
					"type" => "dropdown",
					"heading" => __("Display type", 'web'),
					"param_name" => "layout",
					"value" => $header_options,
					"description" => ''
				),
				array(
					"type" => "attach_images",
					"heading" => __("Slider Images", 'web'),
					"param_name" => "image",
					"value" => '',
					"description" => __('Add images to show in the slider, always add an image for the background', 'web')
				),
				array(
					"type" => "dropdown",
					"heading" => __("Fullscreen type - show blog posts?", 'web'),
					"param_name" => "blog_posts",
					"value" => array(
						'No',
						'Yes'
					),
				),
				array(
					"type" => "textfield",
					"heading" => __("Video Embed Background?", 'web'),
					"param_name" => "youtube",
					"value" => '',
					"description" => __('<a href="http://codex.wordpress.org/Embeds" target="_blank">List of Acceptable Services Here</a>', 'web')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .webm extension", 'web'),
					"param_name" => "webm",
					"value" => '',
					"description" => __('Please fill all extensions', 'web')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .mp4 extension", 'web'),
					"param_name" => "mpfour",
					"value" => '',
					"description" => __('Please fill all extensions', 'web')
				),
				array(
					"type" => "textfield",
					"heading" => __("Self Hosted Video Background?, .ogv extension", 'web'),
					"param_name" => "ogv",
					"value" => '',
					"description" => __('Please fill all extensions', 'web')
				),
				array(
					"type" => "textfield",
					"heading" => __("Small Text", 'web'),
					"param_name" => "small",
					"value" => '',
					"description" => ''
				),
				array(
					"type" => "textfield",
					"heading" => __("Big Text", 'web'),
					"param_name" => "big",
					"value" => '',
					"description" => ''
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle Text", 'web'),
					"param_name" => "sub",
					"value" => '',
					"description" => ''
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Shortcodes, buttons etc.", 'web'),
					"param_name" => "content",
					"value" => '',
					"description" => ''
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'web_page_header_shortcode_vc' );