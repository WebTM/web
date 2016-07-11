<?php

class AQ_Section_Block extends AQ_Block {
	
	/* PHP5 constructor */
	function __construct() {
		$block_options = array(
			'name' => 'Full Page Section',
			'size' => 'span12',
			'resizable' => false,
			'block_icon' => '<i class="fa fa-desktop fa-fw"></i>',
			'block_description' => 'Creates Sections, Controls Backgrounds & Centers Content. Use this as a wrapper for other blocks.',
			'block_category' => 'layout'
		);
		parent::__construct('aq_section_block', $block_options);
	}
	
	/**
	 * Form fields, this is where we'll put every option we'll use for this block
	 */
	function form_fields($instance) {
		$defaults = array(
			'title' => 'The Page Section Title',
			'type' => 'standard',
			'image' => '',
			'thin_column' => 0
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		if( $title == '' )
			$title = 'The Page Section Title';
			
		$type_options = array(
			'light-wrapper' => 'Light Background',
			'dark-wrapper' => 'Dark Background',
			'bg-primary' => 'Primary Highlight Colour Background',
			'bg-secondary-1' => 'Secondary Highlight Colour Background',
			'bg-secondary-2 ' => 'Secondary Highlight 2 Colour Background',
			'image' => 'Parallax Background Image (Full Width)',
			'image-left' => 'Image Left, Content on Right',
			'image-right' => 'Image Right, Content on Left'
		);
	?>
		<div class="two_thirds">
			<p class="description">Label this page section</p>
			<?php echo aq_field_input('title', $this->block_id, $title, $size = 'full') ?>
			
			<hr />
			
			<p class="description">Menu Link for this section: <code>#<?php echo ebor_sanitize_title($title); ?></code><br />(Used for one-page version only)</p>

			<hr />
			
			<p class="description">Use thin column content width for this section?</p>
			<?php echo aq_field_checkbox('thin_column', $this->block_id, $thin_column) ?>

		</div>
		
		<div class="one_third last">	
			
			<p class="description">Background Type</p>
			<?php echo aq_field_select('type', $this->block_id, $type_options, $type) ?>
			
			<hr />
			
			<p class="description">Image for Parallax Background</p>
			<?php echo aq_field_upload('image', $this->block_id, $image, $media_type = 'image') ?>

		</div>
		<div class="clear"></div>
	<?php
	}//end form fields
	
	function form_options_header($instance){
		extract($instance);
		echo '<div class="ebor-options-wrapper">',
			'<div class="ebor-modal">',
				'<div class="ebor-modal-inner">
				<div class="ebor-modal-title">
					<a href="#" class="ebor-modal-closer"><i class="fa fa-times fa-fw"></i></a>
					<h3>' . $name .': '. $title . '</h3>
					<div class="cf"></div>
				</div>
				<div class="ebor-modal-content">';	
	}

	function before_form($instance) {
		extract($instance);
		
		$title = $title ? '<span class="in-block-title"> : '.$title.'</span>' : '';
		$resizable = $resizable ? '' : 'not-resizable';
		
		echo '<li id="template-block-'.$number.'" class="block block-container block-'.$id_base.' '. $size .' '.$resizable.' all '. $block_category.'">',
				'<dl class="block-bar">',
					'<dt class="block-handle">',
						'<div class="block-title"><div class="block-icon">',
							$block_icon, 
						'</div><div class="block-details">' . $name , $title . '<small>' . $block_description . '</small>',
						'</div></div>',
						'<span class="block-controls">',
							'<a class="block-edit" id="edit-'.$number.'" title="'. __('Edit Block', 'pivot') .'" href="#block-settings-'.$number.'">'. __('Edit Block', 'pivot') .'</a>',
						'</span>',
					'</dt>',
				'</dl>',
				'<div class="block-settings clearfix" id="block-settings-'.$number.'">';
	}//end before form

	function form($instance) {
		$this->block_id = 'aq_block_' . $instance['number'];
		extract($instance);

		$this->form_options_header($instance);
		$this->form_fields($instance); 
	?>
		
		</div></div></div>
		
		<a href="#" class="ebor-modal-launcher button button-primary">Edit This Page Section Settings</a>
		
		</div>
				
		<p class="empty-column">
			<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
		</p>
		
		<ul class="blocks column-blocks cf"></ul>
		
	<?php
	}//end form
	
	function form_callback($instance = array()) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		
		//insert the dynamic block_id & block_saving_id into the array
		$this->block_id = 'aq_block_' . $instance['number'];
		$instance['block_saving_id'] = 'aq_blocks[aq_block_'. $instance['number'] .']';
		extract($instance);
		$col_order = $order;
		
		//column block header
		if(isset($template_id)) {
			echo '<li id="template-block-'.$number.'" class="block block-container block-aq_section_block '.$size.'">',
					'<div class="block-settings-column cf" id="block-settings-'.$number.'">';
	?>
	
		<div class="ebor-column-header">
			<div class="floatright"><a href="#" class="column-close button button-primary"><i class="fa fa-caret-down"></i> Edit Section Content</a><a href="#" class="ebor-modal-launcher button button-primary section-launcher"><i class="fa fa-expand"></i> Edit Section Settings</a></div>
			<div class="floatleft"><i class="fa fa-desktop fa-fw fa-2x"></i><span><strong><?php echo $title; ?></strong></span></div>
			<div class="clear"></div>
		</div>
		
		<div class="ebor-column-content">
		
		<?php 
			$this->form_options_header($instance);
			$this->form_fields($instance); 
		?>
		
		</div></div></div></div>
				
		<p class="empty-column">
			<strong>Drag and Drop additional blocks below this text to add to this section.</strong>
		</p>
					
	<?php
		echo '<ul class="blocks column-blocks cf">';
					
			//check if column has blocks inside it
			$blocks = aq_get_blocks($template_id);
			
			//outputs the blocks
			if($blocks) {
				foreach($blocks as $key => $child) {
					global $aq_registered_blocks;
					extract($child);
					
					//get the block object
					$block = $aq_registered_blocks[$id_base];
					
					if($parent == $col_order) {
						$block->form_callback($child);
					}
				}
			} 
			echo '</ul>';
			
		} else {
			$this->before_form($instance);
			$this->form($instance);
		}
				
		//form footer
		$this->after_form($instance);
	}//end form callback
	
	//form footer
	function after_form($instance) {
		extract($instance);
		
		$block_saving_id = 'aq_blocks[aq_block_'.$number.']';
			
			echo '<div class="block-control-actions cf"><a href="#" class="delete">Delete Section</a></div>';
			echo '<input type="hidden" class="id_base" name="'.$this->get_field_name('id_base').'" value="'.$id_base.'" />';
			echo '<input type="hidden" class="name" name="'.$this->get_field_name('name').'" value="'.$name.'" />';
			echo '<input type="hidden" class="order" name="'.$this->get_field_name('order').'" value="'.$order.'" />';
			echo '<input type="hidden" class="size" name="'.$this->get_field_name('size').'" value="'.$size.'" />';
			echo '<input type="hidden" class="parent" name="'.$this->get_field_name('parent').'" value="'.$parent.'" />';
			echo '<input type="hidden" class="number" name="'.$this->get_field_name('number').'" value="'.$number.'" />';
		echo '</div>',
			'</li>';
	}//end form footer
	
	function block_callback($instance) {
		$instance = is_array($instance) ? wp_parse_args($instance, $this->block_options) : $this->block_options;
		extract($instance);
		
		$col_order = $order;
		$col_size = absint(preg_replace("/[^0-9]/", '', $size));

		//column block header
		if(isset($template_id)) {
			
			if( '1' == $thin_column ){
				$before_thin_column = '<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">';
				$after_thin_column = '</div>';
			} else {
				$before_thin_column =  $after_thin_column = false;
			}
			
			echo '<a href="#" id="'. ebor_sanitize_title($title) .'" class="in-page-link"></a>';
			
			if( $type == 'image' ){
				
				echo '<section class="aq-block image-divider overlay">
					      <div class="background-image-holder parallax-background">
					          <img class="background-image" alt="Background Image" src="'. $image .'">
					      </div>
					      
					      <div class="container">
					          <div class="row">';
					          
			} elseif( $type == 'image-left' ){
				
				echo '<section class="side-image text-heavy clearfix dark-wrapper">
					<div class="image-container col-md-5 col-sm-3 pull-left">
						<div class="background-image-holder">
							<img class="background-image" alt="Background Image" src="'. $image .'">
						</div>
					</div>
					
					<div class="container">
						<div class="row">
						    <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4 content clearfix">
						    	<div class="row">';
						    	
			} elseif( $type == 'image-right' ){
				
				echo '<section class="side-image text-heavy clearfix dark-wrapper">
					<div class="image-container col-md-5 col-sm-3 pull-right">
						<div class="background-image-holder">
							<img class="background-image" alt="Background Image" src="'. $image .'">
						</div>
					</div>
					
					  <div class="container">
						  <div class="row">
						      <div class="col-md-6 content col-sm-8 clearfix">
						    	  <div class="row">';
						    	
			} else {
				
				echo '<section class="aq-block ' . $type . '"><div class="container"><div class="row">';
				
			}
			
			echo $before_thin_column;

				//define vars
				$overgrid = 0; 
				$span = 0; 
				$first = false; 
				$next_block_size= 0; 
				$next_overgrid = 0;  
				$blocks = aq_get_blocks($template_id);
				$block_count = count($blocks); // Add block counts to help detect last block
								
				//outputs the blocks
				if($blocks) {
					foreach($blocks as $key => $child) {
						global $aq_registered_blocks;
						extract($child);
						
						if(class_exists($id_base)) {
							//get the block object
							$block = $aq_registered_blocks[$id_base];
							
							//insert template_id into $child
							$child['template_id'] = $template_id;
							
							//display the block
							if($parent == $col_order) {
								
								$col_size = absint(preg_replace("/[^0-9]/", '', $size));
								
								$overgrid = $span + $col_size;
								
								if($overgrid > 12 || $span == 12 || $span == 0) {
									$span = 0;
									$first = true;
								}
								
								if($first == true) {
									$child['first'] = true;
								}
								
								$span = $span + $col_size; // Move here
								
								if( isset($blocks['aq_block_'.($number+1)]) ){
									$next_block_size = $blocks['aq_block_'.($number+1)]['size']; // Get next block size
									$next_block_size  = absint(preg_replace("/[^0-9]/", '', $next_block_size )); //Convert to int
									$next_overgrid = $span + $next_block_size ; // Workout over grid for next block
			
									if($next_overgrid  > 12 || $span == 12 || $number == $block_count)
										$child['last'] = true;
								} else {
									$child['last'] = true;
								}
		
								$block->block_callback($child);
								
								$next_block_size = 0 ; // Reset $next_block_size;
								$next_overgrid = 0 ; //$next_overgrid
								$overgrid = 0; //reset $overgrid
								$first = false; //reset $first
							}
						}
					}
				}
			
			echo $after_thin_column;
			
			if( 'image-left' == $type || 'image-right' == $type ){
				echo '</div></div></div></div></section>';
			} else {	
				echo '</div></div></section>';
			}

		} else {
			//show nothin_columng
		}
		
	}//end block callback
	
}//end class