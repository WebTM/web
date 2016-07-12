<?php 

/**
 * The Shortcode
 */
function web_text_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'icon' => '',
				'icon_size' => 'large',
				'location' => 'top',
				'wpautop' => 0,
				'lead' => 'no',
				'vertical' => 0,
				'subtitle' => '',
				'type' => 'top'
			), $atts 
		) 
	);
	
	if($icon == 'none')
		$icon = false;
	
	$output = false;
	$wrapper_open = ( $icon ) ? '<div class="feature feature-icon-'. $icon_size .'">' : '<div class="feature">';
	$wrapper_close = '</div>';
	$before_icon = ( 'left' == $type ) ? '<div class="pull-left">' : '';
	$after_icon = ( 'left' == $type ) ? '</div>' : '';
	$before_content = ( 'left' == $type ) ? '<div class="pull-right">' : '';
	$after_content = ( 'left' == $type ) ? '</div>' : '';
	$before_title = ( 'yes' == $lead ) ? '<h1>' : '<h5>';
	$after_title = ( 'yes' == $lead ) ? '</h1>' : '</h5>';
	
	if( 'left' == $type && 'small' == $icon_size ){
		$before_icon = '<div class="icon-holder">';
		$before_content = '<div class="feature-text">';
		$wrapper_open = '<div class="feature feature-icon-left">';
		$before_title = '<h6>';
		$after_title = '</h6>';
	}
	
	if( $vertical )
		$output .= '<div class="ebor-align-vertical no-align-mobile">';

		$output .= $wrapper_open;
			
			$output .= $before_icon;
			
				if($icon)
					$output .= '<i class="vc-icon '. $icon .'"></i>';
				
			$output .= $after_icon;
			
			$output .= $before_content;
				
				if($title)
					$output .= $before_title . htmlspecialchars_decode($title) . $after_title;
					
				if($subtitle)
					$output .= '<h6>'. htmlspecialchars_decode($subtitle) .'</h6>';
				
				if( 'yes' == $lead )
					$output .= '<div class="lead">';
					
				$output .= ($wpautop) ? do_shortcode(htmlspecialchars_decode($content)) : wpautop(do_shortcode(htmlspecialchars_decode($content)));
				
				if( 'yes' == $lead )
					$output .= '</div>';
				
			$output .= $after_content;
		
		$output .= $wrapper_close;
		
	if( $vertical )
		$output .= '</div>';
	
	return $output;
}
add_shortcode( 'web_text', 'web_text_shortcode' );

/**
 * The VC Functions
 */
function web_text_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'web-vc-block',
			"name" => __("Web - Text"),
			"base" => "web_text",
			"category" => __('Web', 'web'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", 'web'),
					"param_name" => "title",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => __("Subtitle", 'web'),
					"param_name" => "subtitle",
					"value" => '',
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
					"heading" => __("Show an Icon?", 'web'),
					"param_name" => "icon",
					"value" => array_values(web_get_icons()),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Icon Location", 'web'),
					"param_name" => "type",
					"value" => array_flip(array(
						'top' => 'Icon on Top',
						'left' => 'Icon on Left',
					)),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Icon Size", 'web'),
					"param_name" => "icon_size",
					"value" => array_flip(array(
						'large' => 'Large',
						'small' => 'Small',
					)),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Use Large Font Size?", 'web'),
					"param_name" => "lead",
					"value" => array_flip(array(
						'no' => 'No',
						'yes' => 'Yes',
					)),
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'web_text_shortcode_vc' );