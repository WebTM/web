<?php

class AQ_Text_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text',
			'size' => 'span6',
			'block_icon' => '<i class="fa fa-font fa-fw"></i>',
			'block_description' => 'Use to add Text, HTML or Shortcodes. Also has Icon Options.',
			'block_category' => 'text'
		);
		
		//create the block
		parent::__construct('aq_text_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'icon' => '',
			'icon_size' => 'large',
			'location' => 'top',
			'wpautop' => 0,
			'lead' => 0,
			'vertical' => 0,
			'subtitle' => '',
			'type' => 'top'
		);
		
		$icon_options = web_get_icons();
		
		$display_types = array(
			'top' => 'Icon on Top',
			'left' => 'Icon on Left',
		);
		
		$size_types = array(
			'large' => 'Large',
			'small' => 'Small',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
				
		<p class="description">Title <code>Optional</code></p>
		<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
		
		<p class="description">Subtitle <code>Optional</code></p>
		<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
		
		<p class="description">Block Content</p>
		<?php echo aq_field_editor('text', $block_id, $text) ?>
		
		<hr />
		
		<div class="description cf">
			<div class="icon-modal">
				<div class="icon-modal-inner cf">
				
					<div class="icon-modal-title">
						<a href="#" class="icon-modal-closer"><i class="fa fa-times"></i></a>
						<h3>Choose an Icon</h3>
						<div class="cf"></div>
					</div>
					
					<div class="ebor-modal-content">
						<?php
							foreach($icon_options as $key) {
								$class = ( $key == $icon ) ? 'active' : '';
								echo '<div class="ebor-modal-icon '. $class .'" data-ebor-icon="'. $key .'"><i class="icon '. $key .'"></i></div>';
							}
						?>
					</div>
					
				</div>
			</div>
			<p class="description">Icon <code>Leave Blank for No Icon</code></p>
			<a href="#" class="ebor-icon-modal-launcher button button-primary one_third text-center">Choose Icon</a>
			<div class="two_thirds last">
				<?php echo aq_field_input('icon', $block_id, $icon, $size = 'full') ?>
			</div>
		</div>
		
		<hr />
		
		<div class="one_half">
			<p class="description">Icon Location</p>
			<?php echo aq_field_select('type', $block_id, $display_types, $type) ?>
		</div>
		
		<div class="one_half last">
			<p class="description">Icon Size</p>
			<?php echo aq_field_select('icon_size', $block_id, $size_types, $icon_size) ?>
		</div>
		<div class="cf"></div>
		
		<hr />
		
		<div class="ebor-checkbox cf">
			<?php echo aq_field_checkbox('wpautop', $block_id, $wpautop) ?>
			<p class="description">Disable Auto Paragraphs? <code>wpautop</code></p>
		</div>
		
		<div class="ebor-checkbox cf">
			<?php echo aq_field_checkbox('lead', $block_id, $lead) ?>
			<p class="description">Use Larger Font Size? <code>For Intros etc.</code></p>
		</div>
		
		<div class="ebor-checkbox cf">
			<?php echo aq_field_checkbox('vertical', $block_id, $vertical) ?>
			<p class="description">Vertically Align Text Within Row? <code>Use Sparingly!</code></p>
		</div>
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
	
		$wrapper_open = ( $icon ) ? '<div class="feature feature-icon-'. $icon_size .'">' : '<div class="feature">';
		$wrapper_close = '</div>';
		$before_icon = ( 'left' == $type ) ? '<div class="pull-left">' : '';
		$after_icon = ( 'left' == $type ) ? '</div>' : '';
		$before_content = ( 'left' == $type ) ? '<div class="pull-right">' : '';
		$after_content = ( 'left' == $type ) ? '</div>' : '';
		$before_title = ( $lead ) ? '<h1>' : '<h5>';
		$after_title = ( $lead ) ? '</h1>' : '</h5>';
		
		if( 'left' == $type && 'small' == $icon_size ){
			$before_icon = '<div class="icon-holder">';
			$before_content = '<div class="feature-text">';
			$wrapper_open = '<div class="feature feature-icon-left">';
			$before_title = '<h6>';
			$after_title = '</h6>';
		}
		
		if( $vertical )
			echo '<div class="ebor-align-vertical no-align-mobile">';

			echo $wrapper_open;
				
				echo $before_icon;
				
					if($icon)
						echo '<i class="icon '. $icon .'"></i>';
					
				echo $after_icon;
				
				echo $before_content;
					
					if($title)
						echo $before_title . htmlspecialchars_decode($title) . $after_title;
						
					if($subtitle)
						echo '<h6>'. htmlspecialchars_decode($subtitle) .'</h6>';
					
					if( $lead )
						echo '<div class="lead">';
						
					echo ($wpautop) ? do_shortcode(htmlspecialchars_decode($text)) : wpautop(do_shortcode(htmlspecialchars_decode($text)));
					
					if( $lead )
						echo '</div>';
					
				echo $after_content;
			
			echo $wrapper_close;
			
		if( $vertical )
			echo '</div>';

	}//end block
	
}//end class