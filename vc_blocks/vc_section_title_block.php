<?php 

/**
 * The Shortcode
 */
function web_section_title_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'subtitle' => '',
				'text_white' => 'No',
				'vertical' => 'No',
				'center' => 'Yes'
			), $atts 
		) 
	);
	
	$output = false;
	
	$white_text = ( $text_white == 'Yes' ) ? 'text-white': '';
	$center_text = ( $center == 'Yes' ) ? 'text-center' : ''; 
		
		if( 'Yes' == $vertical )
			$output .= '<div class="ebor-align-vertical no-align-mobile">';
		
			if( $subtitle )
				$output .= '<span class="'. $white_text .' alt-font '. $center_text .' ebor-block">'. htmlspecialchars_decode($subtitle) .'</span>';
			
			if( $title )
				$output .= '<div class="'. $center_text .'"><h1 class="'. $white_text .'">'. htmlspecialchars_decode($title) .'</h1></div>';
	
			if( $content )
				$output .= '<div class="lead '. $center_text .' '. $white_text .'">'. wpautop(do_shortcode(htmlspecialchars_decode($content))) . '</div>';
			
		if( 'Yes' == $vertical )
			$output .= '</div>';
	
	return $output;
}
add_shortcode( 'web_section_title', 'web_section_title_shortcode' );

/**
 * The VC Functions
 */
function web_section_title_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'web-vc-block',
			"name" => __("Web - Section Title"),
			"base" => "web_section_title",
			"category" => __('Web', 'web'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'web'),
					"param_name" => "title",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'web'),
					"param_name" => "subtitle",
					"value" => '',
					"description" => '',
					'holder' => 'div'
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", 'web'),
					"param_name" => "content",
					"value" => '',
					'holder' => 'div'
				),
				array(
					"type" => "dropdown",
					"heading" => __("Use White Text?", 'web'),
					"param_name" => "text_white",
					"value" => array(
						'No',
						'Yes'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Center All Text?", 'web'),
					"param_name" => "center",
					"value" => array(
						'Yes',
						'No'
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Vertically Align?", 'web'),
					"param_name" => "vertical",
					"value" => array(
						'No',
						'Yes'
					),
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'web_section_title_shortcode_vc' );