<?php 
/**
 * Init theme options
 * Certain theme options need to be written to the database as soon as the theme is installed.
 * This is either for the enqueues in ebor-framework, or to override the default image sizes in WooCommerce.
 * Either way this function is only called when the theme is first activated, de-activating and re-activating the theme will result in these options returning to defaults.
 * 
 */
if(!( function_exists('web_init_theme_options') )){
	/**
	 * Hook in on activation
	 */
	global $pagenow;
	
	/**
	 * Define image sizes
	 */
	function web_init_theme_options() {
	  	$catalog = array(
			'width' 	=> '440',	// px
			'height'	=> '295',	// px
			'crop'		=> 1 		// true
		);
	
		$single = array(
			'width' 	=> '600',	// px
			'height'	=> '600',	// px
			'crop'		=> 1 		// true
		);
	
		$thumbnail = array(
			'width' 	=> '113',	// px
			'height'	=> '113',	// px
			'crop'		=> 1 		// false
		);
	
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		
		//Ebor Framework
		$framework_args = array(
			'pivot_shortcodes'      => '1',
			'pivot_widgets'         => '1',
			'portfolio_post_type'   => '1',
			'team_post_type'        => '1',
			'client_post_type'      => '1',
			'testimonial_post_type' => '1',
			'mega_menu'             => '1',
			'aq_resizer'            => '1',
			'page_builder'          => '1',
			'likes'                 => '0',
			'options'               => '1',
			'metaboxes'             => '1'
		);
		update_option('web_framework_options', $framework_args);
	}
	
	
	
	
	/**
	 * Only call this action when we first activate the theme.
	 */
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
		add_action( 'init', 'web_init_theme_options', 1 );
	}
}


function web_admin_load_scripts(){
	$directory = trailingslashit(get_template_directory_uri());
	wp_enqueue_style( 'web-theme-admin-css', $directory . 'admin/theme-admin.css' );
}
add_action('admin_enqueue_scripts', 'web_admin_load_scripts', 200);

/**
 * Medium rare nav walker.
 * This nav walker is for themes by tommusrhodus and medium rare.
 * 
 */
if(!( class_exists('web_framework_medium_rare_bootstrap_navwalker') )){
	class web_framework_medium_rare_bootstrap_navwalker extends Walker_Nav_Menu {
	
		/**
		 * @see Walker::start_lvl()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of page. Used for padding.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role=\"menu\" class=\" subnav\">\n";
		}
	
		/**
		 * @see Walker::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item Menu item data object.
		 * @param int $depth Depth of menu item. Used for padding.
		 * @param int $current_page Menu item ID.
		 * @param object $args
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			/**
			 * Dividers, Headers or Disabled
			 * =============================
			 * Determine whether the item is a Divider, Header, Disabled or regular
			 * menu item. To prevent errors we use the strcasecmp() function to so a
			 * comparison that is not case sensitive. The strcasecmp() function returns
			 * a 0 if the strings are equal.
			 */
			if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="divider">';
			} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
				$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
			} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
				$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
			} else {
	
				$class_names = $value = '';
	
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = 'menu-item-' . $item->ID;
	
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
	
				if ( $args->has_children && $depth == 0 ){
					$class_names .= ' has-dropdown';
				} elseif ( $args->has_children ){
					$class_names .= ' dropdown-submenu';
				}
	
				if ( in_array( 'current-menu-item', $classes ) )
					$class_names .= ' active';
	
				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
				$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
				$atts = array();
				$atts['target'] = ! empty( $item->target )	? $item->target	: '';
				$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
	
				// If item has_children add atts to a.
				if ( $args->has_children && $depth === 0 ) {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
					$atts['data-toggle']	= 'dropdown';
					$atts['class']			= 'dropdown-toggle js-activated';
				} else {
					$atts['href'] = ! empty( $item->url ) ? $item->url : '';
				}
	
				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
	
				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( ! empty( $value ) ) {
						$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
						$attributes .= ' ' . $attr . '="' . $value . '"';
					}
				}
	
				$item_output = $args->before;
	
				/*
				 * Glyphicons
				 * ===========
				 * Since the the menu item is NOT a Divider or Header we check the see
				 * if there is a value in the attr_title property. If the attr_title
				 * property is NOT null we apply it as the class name for the glyphicon.
				 */
				if ( ! empty( $item->attr_title ) )
					$item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
				else
					$item_output .= '<a'. $attributes .'>';
	
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ( $args->has_children && 0 === $depth ) ? '</a>' : '</a>';
				$item_output .= $args->after;
				
				/**
				 * Check if menu item object is a mega menu object.
				 * If it is, display the mega menu content.
				 * Otherwise render elements as normal
				 */
				if( $item->object == 'mega_menu' ) {
					$output .= '<div class="subnav subnav-fullwidth">' . do_shortcode(get_post_field('post_content', $item->object_id)) . '</div>';
				} else {
					$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
				}
	
			}
		}
	
		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element Data object
		 * @param array $children_elements List of elements to continue traversing.
		 * @param int $max_depth Max depth to traverse.
		 * @param int $depth Depth of current element.
		 * @param array $args
		 * @param string $output Passed by reference. Used to append additional content.
		 * @return null Null on failure with no changes to parameters.
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
	        if ( ! $element )
	            return;
	
	        $id_field = $this->db_fields['id'];
	
	        // Display this element.
	        if ( is_object( $args[0] ) )
	           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
	
	        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	    }
	
		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a manu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 *
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {
	
				extract( $args );
	
				$fb_output = null;
	
				if ( $container ) {
					$fb_output = '<' . $container;
	
					if ( $container_id )
						$fb_output .= ' id="' . $container_id . '"';
	
					if ( $container_class )
						$fb_output .= ' class="' . $container_class . '"';
	
					$fb_output .= '>';
				}
	
				$fb_output .= '<ul';
	
				if ( $menu_id )
					$fb_output .= ' id="' . $menu_id . '"';
	
				if ( $menu_class )
					$fb_output .= ' class="' . $menu_class . '"';
	
				$fb_output .= '>';
				$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
				$fb_output .= '</ul>';
	
				if ( $container )
					$fb_output .= '</' . $container . '>';
	
				echo $fb_output;
			}
		}
	}
}
if(!( function_exists('web_get_header_layout') )){
	function web_get_header_layout(){
		global $post;
		
		if(!( isset($post->ID) ))
			return get_option('header_layout', 'overlay');
		
		$header = get_post_meta($post->ID, '_web_header_override', 1);
		
		if( '' == $header || false == $header || 'none' == $header ){
			$header = get_option('header_layout', 'overlay');
		}
		
		return $header;	
	}
}
if(!( function_exists('web_get_header_options') )){
	function web_get_header_options(){
		$options = array(
			'logo' => 'No Header or Nav',
			'top' => 'Top Bar Header',
			'overlay' => 'Overlay Bar Header',
			'offscreen' => 'Выезжающее меню',
			'fullscreen' => 'Fullscreen Header',
			'contained' => 'Contained Header',
			'center' => 'Center Header',
			'portfolio' => 'Страница Портфолио'
		);
		return $options;	
	}
}
if(!( function_exists('web_get_post_layouts') )){
	function web_get_post_layouts(){
		$options = array(
			'standard' => 'Centered Layout',
			'sidebar' => 'Post with Sidebar',
			'alt' => 'Author on Left'
		);
		return $options;	
	}
}
if(!( function_exists('web_get_blog_layouts') )){
	function web_get_blog_layouts(){
		$options = array(
			'preview' => 'Preview List',
			'grid' => '3 Column Grid',
			'grid-sidebar' => '2 Column Grid & Sidebar',
			'masonry' => 'Masonry Grid',
			'masonry-sidebar' => 'Masonry Grid & Sidebar',
			'list' => 'Big List',
			'list-images' => 'Big List With Background Images'
		);
		return $options;	
	}
}
if(!( function_exists('web_get_footer_layout') )){
	function web_get_footer_layout(){
		global $post;
		
		if(!( isset($post->ID) ))
			return get_option('footer_layout', 'columns');
			
		$footer = get_post_meta($post->ID, '_web_footer_override', 1);
		if( '' == $footer || false == $footer || 'none' == $footer ){
			$footer = get_option('footer_layout', 'columns');
		}
		return $footer;	
	}
}
if(!( function_exists('web_get_footer_options') )){
	function web_get_footer_options(){
		$options = array(
			'blank' => 'No Footer',
			'social' => 'Simple Social Footer',
			'columns' => 'Footer With Widgets',
			'social-short' => 'Short Social Footer',
			'contact' => 'Contact Footer',			
			'portfolio' => 'Portfolio Footer',
			'ui' => 'UI Footer'
		);
		return $options;	
	}
}
if(!( function_exists('web_register_nav_menus') )){
	function web_register_nav_menus() {
		register_nav_menus( 
			array(
				'primary' => __( 'Стандартное меню', 'web' ),
				'offscreen' => __( 'Выезжающее меню', 'web' ),
				'fullscreen' => __( 'Fullscreen меню', 'web' ),
				'footer' => __( 'Footer меню', 'web' )
			) 
		);
	}
	add_action( 'init', 'web_register_nav_menus' );
}
if(!( function_exists('web_get_social_icons') )){
	function web_get_social_icons(){
		$icons = array(
			"none" => "None",
			"social_facebook" => "facebook",
			"social_twitter" => "twitter",
			"social_pinterest" => "pinterest",
			"social_googleplus" => "googleplus",
			"social_tumblr" => "tumblr",
			"social_tumbleupon" => "tumbleupon",
			"social_wordpress" => "wordpress",
			"social_instagram" => "instagram",
			"social_dribbble" => "dribbble",
			"social_vimeo" => "vimeo",
			"social_linkedin" => "linkedin",
			"social_rss" => "rss",
			"social_deviantart" => "deviantart",
			"social_share" => "share",
			"social_myspace" => "myspace",
			"social_skype" => "skype",
			"social_youtube" => "youtube",
			"social_picassa" => "picassa",
			"social_googledrive" => "googledrive",
			"social_flickr" => "flickr",
			"social_blogger" => "blogger",
			"social_spotify" => "spotify",
			"social_delicious" => "delicious",
			"social_facebook_circle" => "facebook_circle",
			"social_twitter_circle" => "twitter_circle",
			"social_pinterest_circle" => "pinterest_circle",
			"social_googleplus_circle" => "googleplus_circle",
			"social_tumblr_circle" => "tumblr_circle",
			"social_stumbleupon_circle" => "stumbleupon_circle",
			"social_wordpress_circle" => "wordpress_circle",
			"social_instagram_circle" => "instagram_circle",
			"social_dribbble_circle" => "dribbble_circle",
			"social_vimeo_circle" => "vimeo_circle",
			"social_linkedin_circle" => "linkedin_circle",
			"social_rss_circle" => "rss_circle",
			"social_deviantart_circle" => "deviantart_circle",
			"social_share_circle" => "share_circle",
			"social_myspace_circle" => "myspace_circle",
			"social_skype_circle" => "skype_circle",
			"social_youtube_circle" => "youtube_circle",
			"social_picassa_circle" => "picassa_circle",
			"social_googledrive_alt2" => "googledrive_alt2",
			"social_flickr_circle" => "flickr_circle",
			"social_blogger_circle" => "blogger_circle",
			"social_spotify_circle" => "spotify_circle",
			"social_delicious_circle" => "delicious_circle",
			"social_facebook_square" => "facebook_square",
			"social_twitter_square" => "twitter_square",
			"social_pinterest_square" => "pinterest_square",
			"social_googleplus_square" => "googleplus_square",
			"social_tumblr_square" => "tumblr_square",
			"social_stumbleupon_square" => "stumbleupon_square",
			"social_wordpress_square" => "wordpress_square",
			"social_instagram_square" => "instagram_square",
			"social_dribbble_square" => "dribbble_square",
			"social_vimeo_square" => "vimeo_square",
			"social_linkedin_square" => "linkedin_square",
			"social_rss_square" => "rss_square",
			"social_deviantart_square" => "deviantart_square",
			"social_share_square" => "share_square",
			"social_myspace_square" => "myspace_square",
			"social_skype_square" => "skype_square",
			"social_youtube_square" => "youtube_square",
			"social_picassa_square" => "picassa_square",
			"social_googledrive_square" => "googledrive_square",
			"social_flickr_square" => "flickr_square",
			"social_blogger_square" => "blogger_square",
			"social_spotify_square" => "spotify_square",
			"social_delicious_square" => "delicious_square",
		);
		return $icons;
	}	
}
if(!( function_exists('web_get_icons') )){
	function web_get_icons(){
		$icons = array(
			'none',
			'arrow_up', 
			'arrow_down', 
			'arrow_left', 
			'arrow_right', 
			'arrow_left-up', 
			'arrow_right-up', 
			'arrow_right-down', 
			'arrow_left-down', 
			'arrow-up-down', 
			'arrow_up-down_alt', 
			'arrow_left-right_alt', 
			'arrow_left-right', 
			'arrow_expand_alt2', 
			'arrow_expand_alt', 
			'arrow_condense', 
			'arrow_expand', 
			'arrow_move', 
			'arrow_carrot-up', 
			'arrow_carrot-down', 
			'arrow_carrot-left', 
			'arrow_carrot-right', 
			'arrow_carrot-2up', 
			'arrow_carrot-2down', 
			'arrow_carrot-2left', 
			'arrow_carrot-2right', 
			'arrow_carrot-up_alt2', 
			'arrow_carrot-down_alt2', 
			'arrow_carrot-left_alt2', 
			'arrow_carrot-right_alt2', 
			'arrow_carrot-2up_alt2', 
			'arrow_carrot-2down_alt2', 
			'arrow_carrot-2left_alt2', 
			'arrow_carrot-2right_alt2', 
			'arrow_triangle-up', 
			'arrow_triangle-down', 
			'arrow_triangle-left', 
			'arrow_triangle-right', 
			'arrow_triangle-up_alt2', 
			'arrow_triangle-down_alt2', 
			'arrow_triangle-left_alt2', 
			'arrow_triangle-right_alt2', 
			'arrow_back', 
			'icon_minus-06', 
			'icon_plus', 
			'icon_close', 
			'icon_check', 
			'icon_minus_alt2', 
			'icon_plus_alt2', 
			'icon_close_alt2', 
			'icon_check_alt2', 
			'icon_zoom-out_alt', 
			'icon_zoom-in_alt', 
			'icon_search', 
			'icon_box-empty', 
			'icon_box-selected', 
			'icon_minus-box', 
			'icon_plus-box', 
			'icon_box-checked', 
			'icon_circle-empty', 
			'icon_circle-slelected', 
			'icon_stop_alt2', 
			'icon_stop', 
			'icon_pause_alt2', 
			'icon_pause', 
			'icon_menu', 
			'icon_menu-square_alt2', 
			'icon_menu-circle_alt2', 
			'icon_ul', 
			'icon_ol', 
			'icon_adjust-horiz', 
			'icon_adjust-vert', 
			'icon_document_alt', 
			'icon_documents_alt', 
			'icon_pencil', 
			'icon_pencil-edit_alt', 
			'icon_pencil-edit', 
			'icon_folder-alt', 
			'icon_folder-open_alt', 
			'icon_folder-add_alt', 
			'icon_info_alt', 
			'icon_error-oct_alt', 
			'icon_error-circle_alt', 
			'icon_error-triangle_alt', 
			'icon_question_alt2', 
			'icon_question', 
			'icon_comment_alt', 
			'icon_chat_alt', 
			'icon_vol-mute_alt', 
			'icon_volume-low_alt', 
			'icon_volume-high_alt', 
			'icon_quotations', 
			'icon_quotations_alt2', 
			'icon_clock_alt', 
			'icon_lock_alt', 
			'icon_lock-open_alt', 
			'icon_key_alt', 
			'icon_cloud_alt', 
			'icon_cloud-upload_alt', 
			'icon_cloud-download_alt', 
			'icon_image', 
			'icon_images', 
			'icon_lightbulb_alt', 
			'icon_gift_alt', 
			'icon_house_alt', 
			'icon_genius', 
			'icon_mobile', 
			'icon_tablet', 
			'icon_laptop', 
			'icon_desktop', 
			'icon_camera_alt', 
			'icon_mail_alt', 
			'icon_cone_alt', 
			'icon_ribbon_alt', 
			'icon_bag_alt', 
			'icon_creditcard', 
			'icon_cart_alt', 
			'icon_paperclip', 
			'icon_tag_alt', 
			'icon_tags_alt', 
			'icon_trash_alt', 
			'icon_cursor_alt', 
			'icon_mic_alt', 
			'icon_compass_alt', 
			'icon_pin_alt', 
			'icon_pushpin_alt', 
			'icon_map_alt', 
			'icon_drawer_alt', 
			'icon_toolbox_alt', 
			'icon_book_alt', 
			'icon_calendar', 
			'icon_film', 
			'icon_table', 
			'icon_contacts_alt', 
			'icon_headphones', 
			'icon_lifesaver', 
			'icon_piechart', 
			'icon_refresh', 
			'icon_link_alt', 
			'icon_link', 
			'icon_loading', 
			'icon_blocked', 
			'icon_archive_alt', 
			'icon_heart_alt', 
			'icon_printer', 
			'icon_calulator', 
			'icon_building', 
			'icon_floppy', 
			'icon_drive', 
			'icon_search-2', 
			'icon_id', 
			'icon_id-2', 
			'icon_puzzle', 
			'icon_like', 
			'icon_dislike', 
			'icon_mug', 
			'icon_currency', 
			'icon_wallet', 
			'icon_pens', 
			'icon_easel', 
			'icon_flowchart', 
			'icon_datareport', 
			'icon_briefcase', 
			'icon_shield', 
			'icon_percent', 
			'icon_globe', 
			'icon_globe-2', 
			'icon_target', 
			'icon_hourglass', 
			'icon_balance', 
			'icon_star_alt', 
			'icon_star-half_alt', 
			'icon_star', 
			'icon_star-half', 
			'icon_tools', 
			'icon_tool', 
			'icon_cog', 
			'icon_cogs', 
			'arrow_up_alt', 
			'arrow_down_alt', 
			'arrow_left_alt', 
			'arrow_right_alt', 
			'arrow_left-up_alt', 
			'arrow_right-up_alt', 
			'arrow_right-down_alt', 
			'arrow_left-down_alt', 
			'arrow_condense_alt', 
			'arrow_expand_alt3', 
			'arrow_carrot_up_alt', 
			'arrow_carrot-down_alt', 
			'arrow_carrot-left_alt', 
			'arrow_carrot-right_alt', 
			'arrow_carrot-2up_alt', 
			'arrow_carrot-2dwnn_alt', 
			'arrow_carrot-2left_alt', 
			'arrow_carrot-2right_alt', 
			'arrow_triangle-up_alt', 
			'arrow_triangle-down_alt', 
			'arrow_triangle-left_alt', 
			'arrow_triangle-right_alt', 
			'icon_minus_alt', 
			'icon_plus_alt', 
			'icon_close_alt', 
			'icon_check_alt', 
			'icon_zoom-out', 
			'icon_zoom-in', 
			'icon_stop_alt', 
			'icon_menu-square_alt', 
			'icon_menu-circle_alt', 
			'icon_document', 
			'icon_documents', 
			'icon_pencil_alt', 
			'icon_folder', 
			'icon_folder-open', 
			'icon_folder-add', 
			'icon_folder_upload', 
			'icon_folder_download', 
			'icon_info', 
			'icon_error-circle', 
			'icon_error-oct', 
			'icon_error-triangle', 
			'icon_question_alt', 
			'icon_comment', 
			'icon_chat', 
			'icon_vol-mute', 
			'icon_volume-low', 
			'icon_volume-high', 
			'icon_quotations_alt', 
			'icon_clock', 
			'icon_lock', 
			'icon_lock-open', 
			'icon_key', 
			'icon_cloud', 
			'icon_cloud-upload', 
			'icon_cloud-download', 
			'icon_lightbulb', 
			'icon_gift', 
			'icon_house', 
			'icon_camera', 
			'icon_mail', 
			'icon_cone', 
			'icon_ribbon', 
			'icon_bag', 
			'icon_cart', 
			'icon_tag', 
			'icon_tags', 
			'icon_trash', 
			'icon_cursor', 
			'icon_mic', 
			'icon_compass', 
			'icon_pin', 
			'icon_pushpin', 
			'icon_map', 
			'icon_drawer', 
			'icon_toolbox', 
			'icon_book', 
			'icon_contacts', 
			'icon_archive', 
			'icon_heart', 
			'icon_profile', 
			'icon_group', 
			'icon_music', 
			'icon_pause_alt', 
			'icon_phone', 
			'icon_upload', 
			'icon_download', 
			'icon_rook', 
			'icon_printer-alt', 
			'icon_calculator_alt', 
			'icon_building_alt', 
			'icon_floppy_alt', 
			'icon_drive_alt', 
			'icon_search_alt', 
			'icon_id_alt', 
			'icon_id-2_alt', 
			'icon_puzzle_alt', 
			'icon_like_alt', 
			'icon_dislike_alt', 
			'icon_mug_alt', 
			'icon_currency_alt', 
			'icon_wallet_alt', 
			'icon_pens_alt', 
			'icon_easel_alt', 
			'icon_flowchart_alt', 
			'icon_datareport_alt', 
			'icon_briefcase_alt', 
			'icon_shield_alt', 
			'icon_percent_alt', 
			'icon_globe_alt', 
			'icon_clipboard', 
			'social_facebook', 
			'social_twitter', 
			'social_pinterest', 
			'social_googleplus', 
			'social_tumblr', 
			'social_tumbleupon', 
			'social_wordpress', 
			'social_instagram', 
			'social_dribbble', 
			'social_vimeo', 
			'social_linkedin', 
			'social_rss', 
			'social_deviantart', 
			'social_share', 
			'social_myspace', 
			'social_skype', 
			'social_youtube', 
			'social_picassa', 
			'social_googledrive', 
			'social_flickr', 
			'social_blogger', 
			'social_spotify', 
			'social_delicious', 
			'social_facebook_circle', 
			'social_twitter_circle', 
			'social_pinterest_circle', 
			'social_googleplus_circle', 
			'social_tumblr_circle', 
			'social_stumbleupon_circle', 
			'social_wordpress_circle',  
			'social_instagram_circle', 
			'social_dribbble_circle', 
			'social_vimeo_circle', 
			'social_linkedin_circle', 
			'social_rss_circle', 
			'social_deviantart_circle', 
			'social_share_circle', 
			'social_myspace_circle', 
			'social_skype_circle',  
			'social_youtube_circle', 
			'social_picassa_circle', 
			'social_googledrive_alt2', 
			'social_flickr_circle', 
			'social_blogger_circle', 
			'social_spotify_circle',  
			'social_delicious_circle', 
			'social_facebook_square', 
			'social_twitter_square',  
			'social_pinterest_square', 
			'social_googleplus_square', 
			'social_tumblr_square',  
			'social_stumbleupon_square', 
			'social_wordpress_square', 
			'social_instagram_square',  
			'social_dribbble_square', 
			'social_vimeo_square', 
			'social_linkedin_square', 
			'social_rss_square', 
			'social_deviantart_square', 
			'social_share_square', 
			'social_myspace_square', 
			'social_skype_square', 
			'social_youtube_square',  
			'social_picassa_square', 
			'social_googledrive_square', 
			'social_flickr_square', 
			'social_blogger_square', 
			'social_spotify_square', 
			'social_delicious_square', 
			'icon-adjustments',
			'icon-alarmclock',
			'icon-anchor',
			'icon-aperture',
			'icon-attachment',
			'icon-bargraph',
			'icon-basket',
			'icon-beaker',
			'icon-bike',
			'icon-book-open',
			'icon-briefcase',
			'icon-browser',
			'icon-calendar',
			'icon-camera',
			'icon-caution',
			'icon-chat',
			'icon-circle-compass',
			'icon-clipboard',
			'icon-clock',
			'icon-cloud',
			'icon-compass',
			'icon-desktop',
			'icon-dial',
			'icon-document',
			'icon-documents',
			'icon-download',
			'icon-dribbble',
			'icon-edit',
			'icon-envelope',
			'icon-expand',
			'icon-facebook',
			'icon-flag',
			'icon-focus',
			'icon-gears',
			'icon-genius',
			'icon-gift',
			'icon-global',
			'icon-globe',
			'icon-googleplus',
			'icon-grid',
			'icon-happy',
			'icon-hazardous',
			'icon-heart',
			'icon-hotairballoon',
			'icon-hourglass',
			'icon-key',
			'icon-laptop',
			'icon-layers',
			'icon-lifesaver',
			'icon-lightbulb',
			'icon-linegraph',
			'icon-linkedin',
			'icon-lock',
			'icon-magnifying-glass',
			'icon-map',
			'icon-map-pin',
			'icon-megaphone',
			'icon-mic',
			'icon-mobile',
			'icon-newspaper',
			'icon-notebook',
			'icon-paintbrush',
			'icon-paperclip',
			'icon-pencil',
			'icon-phone',
			'icon-picture',
			'icon-pictures',
			'icon-piechart',
			'icon-presentation',
			'icon-pricetags',
			'icon-printer',
			'icon-profile-female',
			'icon-profile-male',
			'icon-puzzle',
			'icon-quote',
			'icon-recycle',
			'icon-refresh',
			'icon-ribbon',
			'icon-rss',
			'icon-sad',
			'icon-scissors',
			'icon-scope',
			'icon-search',
			'icon-shield',
			'icon-speedometer',
			'icon-strategy',
			'icon-streetsign',
			'icon-tablet',
			'icon-target',
			'icon-telescope',
			'icon-toolbox',
			'icon-tools',
			'icon-tools-2',
			'icon-trophy',
			'icon-tumblr',
			'icon-twitter',
			'icon-upload',
			'icon-video',
			'icon-wallet',
			'icon-wine'
		);
		return $icons;	
	}
}