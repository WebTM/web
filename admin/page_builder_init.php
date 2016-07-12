<?php 

/**
 * Page Builder Functions
 * Queue Up Framework
 */
if(class_exists('AQ_Page_Builder')) {
	
	/**
	 * Register custom blocks
	 * Override by copying block file of your choice to your child theme, and then require & register from your child theme functions.php
	 * Ensure that you use aq_regiser_block() in your child theme to register the block with the page builder.
	 */
	if(!( class_exists('AQ_Page_Header_Block') )){
		require_once get_template_directory() . '/page_blocks/page_header_block.php';
		aq_register_block('AQ_Page_Header_Block');
	}
	if(!( class_exists('AQ_Section_Block') )){
		require_once get_template_directory() . '/page_blocks/page_section_block.php';
		aq_register_block('AQ_Section_Block');
	}
	if(!( class_exists('AQ_Text_Block') )){
		require_once get_template_directory() . '/page_blocks/text_block.php';
		aq_register_block('AQ_Text_Block');
	}
	if(!( class_exists('AQ_Portfolio_Block') )){
		require_once get_template_directory() . '/page_blocks/portfolio_block.php';
		aq_register_block('AQ_Portfolio_Block'); 
	}
	
	/**
	 * Wrapper function overrides
	 * @doNotModify Unless you know exactly what you're doing, modification of these will break the theme layout. You have been warned.
	 */
	function aq_css_classes($block){
		$block = str_replace('span', '', $block);
		$output = 'col-sm-' . $block;
		return $output;
	}
	function aq_css_clearfix(){
		return false;
	}
	function aq_template_wrapper_start($template_id){
		return '<div class="row">';
	}
	function aq_template_wrapper_end(){
		return '</div>';
	}
	
}