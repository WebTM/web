<?php
/**
 * webtm functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package webtm
 */

if ( ! function_exists( 'ui_setup' ) ) :

function ui_setup() {

	require get_template_directory() . '/admin/init.php';
	require_once get_template_directory() . '/admin/page_builder_init.php';


	/**
	 * Grab all VC Functions
	 */
	require_once('admin/vc_functions.php');

	/**
	 * Grab all VC Base layouts
	 */
	require_once('admin/vc_layouts.php');

	load_theme_textdomain( 'ui', get_template_directory() . '/languages' );

	
	// Remove from head some links.
	
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 ); 
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head',10,0);
	remove_action ('wp_head', 'rel_canonical');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'ui' ),
	) );

	/*
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; // ui_setup
add_action( 'after_setup_theme', 'ui_setup' );

if( function_exists('vc_set_as_theme') )
	require_once get_template_directory() . '/admin/vc_init.php';


/**
 * Register widget area.
 */
function ui_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ui' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ui_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ui_scripts() {
	wp_enqueue_style( 'web-elegant-icons', get_template_directory_uri() . '/style/css/elegant-icons.min.css' );
	wp_enqueue_style( 'ui-style', get_stylesheet_uri() );
	wp_enqueue_script( 'ui-skip-link-focus-fix', get_template_directory_uri() . '/style/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'ui-scripts', get_template_directory_uri() . '/style/js/scripts.js', array(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ui_scripts' );


require_once get_template_directory() . '/admin/page_builder_init.php';


if( function_exists('vc_set_as_theme') )
	require_once get_template_directory() . '/admin/vc_init.php';
