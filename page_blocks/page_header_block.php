<?php

class AQ_Page_Header_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Заголовок (AQ_Page_Header_Block)',
			'size' => 'span12',
			'resizable' => false,
			'block_icon' => '<i class="fa fa-list-alt fa-fw"></i>',
			'block_description' => 'Add one of 12 headers to the page, can also be used as a Page Divider.',
			'block_category' => 'layout'
		);
		
		//create the block
		parent::__construct('aq_page_header_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
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
		);
		
		$directory = trailingslashit(get_template_directory_uri());
		
		$header_options = array(
			'slider' => '<div class="header-image" data-type="slider"><img src="'. $directory .'style/img/headers/slider.png" alt="" /><span>Slider Background</span></div>',
			'video' => '<div class="header-image" data-type="video"><img src="'. $directory .'style/img/headers/video.png" alt="" /><span>Video Background</span></div>',
			'simple' => '<div class="header-image" data-type="simple"><img src="'. $directory .'style/img/headers/simple.png" alt="" /><span>Simple Image Background</span></div>',
			'simple-centered' => '<div class="header-image" data-type="simple-centered"><img src="'. $directory .'style/img/headers/simple-centered.png" alt="" /><span>Simple Image Background, Centered Text</span></div>',
			'product' => '<div class="header-image" data-type="product"><img src="'. $directory .'style/img/headers/product.png" alt="" /><span>Image Background, Featured Product Image</span></div>',
			'resume' => '<div class="header-image" data-type="resume"><img src="'. $directory .'style/img/headers/social.png" alt="" /><span>Image Background, Social Icons</span></div>',
			'personal' => '<div class="header-image" data-type="personal"><img src="'. $directory .'style/img/headers/personal.png" alt="" /><span>Overlay Image Background</span></div>',
			'logo' => '<div class="header-image" data-type="logo"><img src="'. $directory .'style/img/headers/logo.png" alt="" /><span>Image Background, Logo & Chunky Text</span></div>',
			'fullscreen-single' => '<div class="header-image" data-type="fullscreen-single"><img src="'. $directory .'style/img/headers/fullscreen-single.png" alt="" /><span>Fullscreen Image Background</span></div>',
			'map' => '<div class="header-image" data-type="map"><img src="'. $directory .'style/img/headers/map.png" alt="" /><span>Large Map Background</span></div>',
			'form' => '<div class="header-image" data-type="form"><img src="'. $directory .'style/img/headers/form.png" alt="" /><span>Image Background & Contact Form</span></div>',
			'call-to-action' => '<div class="header-image" data-type="call-to-action"><img src="'. $directory .'style/img/headers/call-to-action.png" alt="" /><span>Overlay Image Background, Chunky Text</span></div>',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<div class="cf">
			<p class="description">1. Choose Header Layout</p>
			<ul class="ebor-header-options">
				<?php
					foreach( $header_options as $key => $header ){
						echo '<li>'. $header .'</li>';
					}
				?>
			</ul>
			<div style="display: none;"><?php echo aq_field_input('layout', $block_id, $layout, $size = 'full') ?></div>
		</div>	
		
		<hr />
		
		<p class="description">2. Configure Background Settings</p>	
		
		<p class="description">Manage Background Images <code>Required for all Header Types</code></p>
		<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'gallery') ?>
		
		<hr />
		
		<div class="ebor-checkbox cf">
			<?php echo aq_field_checkbox('blog_posts', $block_id, $blog_posts) ?>
			<p class="description">Fullscreen Header? Add 3 latest posts to bottom of header? <code>Fullscreen type only</code></p>
		</div>
		
		<hr />
		
		<p class="description">Manage Background Videos <code>Only for Background Video Type, all 3 Filetypes Required if using self hosted video.</code></p>
		
		<div class="one_third">
			<p class="description">.mp4 Background Video</p>
			<?php echo aq_field_upload('mpfour', $block_id, $mpfour, $media_type = 'video') ?>
		</div>
		
		<div class="one_third">
			<p class="description">.ogv Background Video</p>
			<?php echo aq_field_upload('ogv', $block_id, $ogv, $media_type = 'video') ?>
		</div>
		
		<div class="one_third last">
			<p class="description">.webm Background Video</p>
			<?php echo aq_field_upload('webm', $block_id, $webm, $media_type = 'video') ?>
		</div><div class="cf"></div>
		
		<p class="description">Youtube Video Instead? Enter URL Here.</p>
		<?php echo aq_field_input('youtube', $block_id, $youtube, $size = 'full') ?>
		
		<hr />
		
		<p class="description">3. Configure Text Settings</p>	
		
		<p class="description">Small Text <code>Optional</code></p>
		<?php echo aq_field_input('small', $block_id, $small, $size = 'full') ?>
		
		<p class="description">Title Text <code>Optional</code></p>
		<?php echo aq_field_input('big', $block_id, $big, $size = 'full') ?>
		
		<p class="description">Subtitle Text <code>Optional</code></p>
		<?php echo aq_field_input('sub', $block_id, $sub, $size = 'full') ?>
		
		<p class="description">Shortcodes <code>Optional</code> <code>Buttons, Contact Form etc.</code></p>
		<?php echo aq_field_textarea('shortcode', $block_id, $shortcode, $size = 'full') ?>
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
		
		if(!( isset($blog_posts) ))
			$blog_posts = false;
		
		include( locate_template('page-header/content-header-' . $layout . '.php') );
		
	}//end block
	
}//end class