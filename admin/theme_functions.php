<?php 


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
			'blank' => 'No Header or Nav',
			'top' => 'Top Bar Header',
			'overlay' => 'Overlay Bar Header',
			'offscreen' => 'Выезжающее меню',
			'fullscreen' => 'Fullscreen Header',
			'contained' => 'Contained Header',
			'center' => 'Center Header',
			'bar' => 'Simple Bar Header'
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

/**
 * Register Menu Locations For The Theme
 */
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

if(!( function_exists('web_get_footer_options') )){
	function web_get_footer_options(){
		$options = array(
			'blank' => 'No Footer',
			'social' => 'Simple Social Footer',
			'columns' => 'Footer With Widgets',
			'social-short' => 'Short Social Footer',
			'contact' => 'Call to Action Footer'
		);
		return $options;	
	}
}
