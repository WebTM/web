<?php 

/**
 * Build theme metaboxes
 * More details here: https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 * 
 */
if(!( function_exists('web_custom_metaboxes') )){
	function web_custom_metaboxes( $meta_boxes ) {
		$prefix = '_web_';
		$social_options = web_get_social_icons();
		$header_options = web_get_header_options();
		$footer_options = web_get_footer_options();
		$post_layout_options = web_get_post_layouts();
		
		$header_overrides['none'] = 'Не переопределять Хедер на этой странице'; // Do Not Override Header Option On This Page
		foreach( $header_options as $key => $value ){
			$header_overrides[$key] = 'Override (переопределить) Header: ' . $value; 	
		}
		
		$footer_overrides['none'] = 'Не переопределять подвал на этой странице'; // Do Not Override Footer Option On This Page
		foreach( $footer_options as $key => $value ){
			$footer_overrides[$key] = 'Override (переопределить) Footer: ' . $value; 	
		}
		
		$post_layout_overrides['none'] = 'Не переопределять макет на этой странице'; // Do Not Override Post Layout Option On This Post
		foreach( $post_layout_options as $key => $value ){
			$post_layout_overrides[$key] = 'Override (переопределить) Post Layout: ' . $value; 	
		}
		
		/**
		 * Post & Portfolio Header Images
		 */
		$meta_boxes[] = array(
			'id' => 'post_header_image_metabox',
			'title' => __('Post Header Image', 'web'),
			'object_types' => array('post', 'portfolio', 'team'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => __( 'Header Images', 'web' ),
					'desc'         => __( 'Upload or add multiple images for the header of this post. No images for just a standard header', 'web' ),
					'id'           => $prefix . 'header_images',
					'type'         => 'file_list'
				),
			)
		);
		
		/**
		 * Post Layouts
		 */
		$meta_boxes[] = array(
			'id' => 'post_layouts_metabox',
			'title' => __('Post Layout Overrides', 'web'),
			'object_types' => array('post'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => __( 'Override Post Layout?', 'web' ),
					'desc'         => __( 'Post Layout is set in "appearance" -> "customise". To override this for this post only, use this control.', 'web' ),
					'id'           => $prefix . 'post_layout_override',
					'type'         => 'select',
					'options'      => $post_layout_overrides,
					'std'          => 'none'
				),
			)
		);
		
		/**
		 * Post & Portfolio Header Images
		 */
		$meta_boxes[] = array(
			'id' => 'post_header_metabox',
			'title' => __('Page Overrides', 'web'),
			'object_types' => array('page', 'team', 'post', 'portfolio'), // post type
			'context' => 'normal',
			'priority' => 'low',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'         => __( 'Override Header?', 'web' ),
					'desc'         => __( 'Header Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'web' ),
					'id'           => $prefix . 'header_override',
					'type'         => 'select',
					'options'      => $header_overrides,
					'std'          => 'none'
				),
				array(
					'name'         => __( 'Override Footer?', 'web' ),
					'desc'         => __( 'Footer Layout is set in "appearance" -> "customise". To override this for this page only, use this control.', 'web' ),
					'id'           => $prefix . 'footer_override',
					'type'         => 'select',
					'options'      => $footer_overrides,
					'std'          => 'none'
				),
			)
		);

		/**
		 * Social Icons for Team Members
		 */
		$meta_boxes[] = array(
			'id' => 'social_metabox',
			'title' => __('Social Icons: Click To Add More', 'web'),
			'object_types' => array('team'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Job Title', 'web'),
					'desc' => '(Optional) Enter a Job Title for this Team Member',
					'id'   => $prefix . 'the_job_title',
					'type' => 'text',
				),
				array(
				    'id'          => $prefix . 'team_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => __( 'Add Another Icon', 'web' ),
				        'remove_button' => __( 'Remove Icon', 'web' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'Social Icon',
							'desc' => 'What icon would you like for this team members first social profile?',
							'id' => $prefix . 'social_icon',
							'type' => 'select',
							'options' => $social_options
						),
						array(
							'name' => __('URL for Social Icon', 'web'),
							'desc' => __("Enter the URL for Social Icon 1 e.g www.google.com", 'web'),
							'id'   => $prefix . 'social_icon_url',
							'type' => 'text_url',
						),
				    ),
				),
			)
		);
		
		/**
		 * Social Icons for Users
		 */
		$meta_boxes[] = array(
			'id' => 'social_metabox',
			'title' => __('Social Icons: Click To Add More', 'web'),
			'object_types' => array('user'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
				    'id'          => $prefix . 'user_social_icons',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => __( 'Add Another Icon', 'web' ),
				        'remove_button' => __( 'Remove Icon', 'web' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'Social Icon',
							'desc' => 'What icon would you like for this team members first social profile?',
							'id' => $prefix . 'social_icon',
							'type' => 'select',
							'options' => $social_options
						),
						array(
							'name' => __('URL for Social Icon', 'web'),
							'desc' => __("Enter the URL for Social Icon 1 e.g www.google.com", 'web'),
							'id'   => $prefix . 'social_icon_url',
							'type' => 'text',
						),
				    ),
				),
			)
		);
		
		/**
		 * Quote Format Metaboxes
		 */
		$meta_boxes[] = array(
			'id' => 'post_format_metabox_quote',
			'title' => __('Quote Details', 'web'),
			'object_types' => array('post'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('Quote Author', 'web'),
					'desc' => __("Enter an author for the quote.", 'web'),
					'id'   => $prefix . 'quote_author',
					'type' => 'text',
				),
				array(
					'name' => __('Quote Date', 'web'),
					'desc' => __("Enter a date for the quote.", 'web'),
					'id'   => $prefix . 'quote_date',
					'type' => 'text',
				),
			)
		);
		
		/**
		 * Video Format Metaboxes
		 */
		$meta_boxes[] = array(
			'id' => 'post_format_metabox_video',
			'title' => __('Videos & oEmbeds', 'web'),
			'object_types' => array('post'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
				    'id'          => $prefix . 'videos',
				    'type'        => 'group',
				    'options'     => array(
				        'add_button'    => __( 'Add Another oEmbed', 'web' ),
				        'remove_button' => __( 'Remove oEmbed', 'web' ),
				        'sortable'      => true
				    ),
				    'fields' => array(
						array(
							'name' => 'oEmbed',
							'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
							'id'   => $prefix . 'the_oembed',
							'type' => 'oembed',
						),
				    ),
				),
			)
		);
		
		$meta_boxes[] = array(
			'id' => 'clients_metabox',
			'title' => __('Client URL', 'web'),
			'object_types' => array('client'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name' => __('URL for this client (optional)', 'web'),
					'desc' => __("Enter a URL for this client, if left blank, client logo will open into a lightbox.", 'web'),
					'id'   => $prefix . 'client_url',
					'type' => 'text',
				),
			),
		);
		
		return $meta_boxes;
	}
	add_filter( 'cmb2_meta_boxes', 'web_custom_metaboxes' );
}