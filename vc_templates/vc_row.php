<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    'background_style' => '',
    'single_link' => '',
    'scroll_id' => ''
), $atts));

wp_enqueue_script( 'wpb_composer_front_js' );

if( 'image-left' == $background_style ){
	
	preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $css, $image);
	if(!( isset($image[0][0]) ))
		$image[0][0] = false;
	
	$output .= '<a href="#" id="'. ebor_sanitize_title($single_link) .'" class="in-page-link"></a><section class="side-image text-heavy clearfix dark-wrapper">
		<div class="image-container col-md-5 col-sm-3 pull-left">
			<div class="background-image-holder">
				<img class="background-image" alt="Background Image" src="'. $image[0][0] .'">
			</div>
		</div>
		
		<div class="container">
			<div class="row">
			    <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4 content clearfix">';
	
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . ' ', $this->settings['base'], $atts );
	
	$output .= '<div class="'.$css_class.'">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>'.$this->endBlockComment('row');
	
	$output .= '</div></div></div></section>';
	
} elseif( 'image-right' == $background_style ){
	
	preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $css, $image);
	if(!( isset($image[0][0]) ))
		$image[0][0] = false;
		
	$output .= '<a href="#" id="'. ebor_sanitize_title($single_link) .'" class="in-page-link"></a><section class="side-image text-heavy clearfix dark-wrapper">
		<div class="image-container col-md-5 col-sm-3 pull-right">
			<div class="background-image-holder">
				<img class="background-image" alt="Background Image" src="'. $image[0][0] .'">
			</div>
		</div>
		
		  <div class="container">
			  <div class="row">
			      <div class="col-md-6 content col-sm-8 clearfix">
			    	  <div class="row">';
			    	  
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . ' ', $this->settings['base'], $atts );
	
	$output .= '<div class="'.$css_class.'">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>'.$this->endBlockComment('row');
	
	$output .= '</div></div></div></section>';
			    	
} elseif( 'image' == $background_style ){
	
	preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $css, $image);
	if(!( isset($image[0][0]) ))
		$image[0][0] = false;
		
	$output .= '<a href="#" id="'. ebor_sanitize_title($single_link) .'" class="in-page-link"></a><section class="aq-block image-divider overlay">
		      <div class="background-image-holder parallax-background">
		          <img class="background-image" alt="Background Image" src="'. $image[0][0] .'">
		      </div>
		      
		      <div class="container">
		          <div class="row">';
			    	  
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . ' ', $this->settings['base'], $atts );
	
	$output .= '<div class="'.$css_class.'">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>'.$this->endBlockComment('row');
	
	$output .= '</div></div></section>';
			    	
} elseif( 'full' == $background_style ){
	
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
	
	$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
	$output .= '<section class="'. $background_style .' '.$css_class.'"'.$style.'>';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</section>'.$this->endBlockComment('row');

} else {
	
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
	
	$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
	$output .= '<a href="#" id="'. ebor_sanitize_title($single_link) .'" class="in-page-link"></a><section class="'. $background_style .' '.$css_class.'"'.$style.'><div class="container"><div class="row">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div></div></section>'.$this->endBlockComment('row');

}

echo $output;