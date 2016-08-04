<?php
/**
 * WP Foundation for Sites Starter default theme functions and definitions.
 *
 * @package WP_Foundation_for_Sites_Starter
 * @since f6-starter 1.0.0
 *
 * Thanks to the following sites for some great WP clean up functions.
 * @Matteo Spinelli - http://cubiq.org/clean-up-and-optimize-wordpress-for-your-next-theme
 *
 */
 
 
 
 if ( ! function_exists( 'f6_starter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function f6_starter_setup() {
	
	// launching operation cleanup
    add_action('init', 'f6_starter_head_cleanup');
    
    // Remove generator name from RSS feeds (just for good measure even though we removed the feed links above)
	add_filter('the_generator', '__return_false');
	
	// Disable Admin Bar on Front End (it bothers me during development)
	add_filter('show_admin_bar','__return_false'); 
	
	// Add Title Tag support
	add_theme_support( 'title-tag' );
	
	// Makes theme available for translation.
	load_theme_textdomain( 'f6-starter', get_template_directory() . '/languages' );

	// Enable support for Post Thumbnails on posts and pages. (shouldn't this be standard already? )
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'f6-starter' ),
	) );

	//Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	//Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'f6_starter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'f6_starter_setup' );




/*=====================================================================================
  The default wordpress head is a mess. Let's clean it up by removing all the junk we don't need.
  @since f6-starter 1.0.0
======================================================================================*/
function f6_starter_head_cleanup() {
	
	// Remove post, comment, and category feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	
	// Remove Really Simple Discovery (aka EditURI) link
	remove_action( 'wp_head', 'rsd_link' );
	
	// Remove Windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	
	// Remove Page Shortlink
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	
	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );
	
	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	
	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	
	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	
	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );
	
	//Remove Emoji Support (totally not gonna use that anytime soon)
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	
	// Disable REST API
	//remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	//remove_action( 'rest_api_init', 'wp_oembed_register_route');
	//remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10);
	
}




/*=====================================================================================
  Remove Query Strings from Static Resources to prevent issues with caching and CDNs
  @link https://www.keycdn.com/blog/speed-up-wordpress/#caching
  @since f6-starter 1.0.0
======================================================================================*/
function _remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );





/*=====================================================================================
  Enqueue our scripts and styles
  @since f6-starter 1.0.0
======================================================================================*/
function f6_starter_scripts() {
	
	//Foundation for Sites
	wp_enqueue_style( 'f6-starter-foundation-css', get_template_directory_uri() . '/inc/vendors/foundation/foundation.min.css' );
	wp_enqueue_script( 'f6-starter-what-input', get_template_directory_uri() . '/inc/vendors/foundation/what-input.js', array('jquery'), '', true );
	wp_enqueue_script( 'f6-starter-foundation-js', get_template_directory_uri() . '/inc/vendors/foundation/foundation.min.js', array('jquery'), '', true );
	
	//Motion UI
	wp_enqueue_style( 'f6-starter-motion-ui-css', get_template_directory_uri() . '/inc/vendors/motion-ui/motion-ui.min.css' );
	wp_enqueue_script( 'f6-starter-motion-ui-js', get_template_directory_uri() . '/inc/vendors/motion-ui/motion-ui.min.js', array('jquery'), '', true );
	
	//Font Awesome
	wp_enqueue_style('font-fontawesome', get_template_directory_uri() . '/inc/vendors/font-awesome/font-awesome.min.css' );
	
	//Customizer
	wp_enqueue_script( 'f6-starter-customizer', get_template_directory_uri() . '/js/customizer.js', array(), '20151215', true );
	
	//Navigation Fixes
	wp_enqueue_script( 'f6-starter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'f6-starter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	//Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	//CSS
	wp_enqueue_style( 'f6-starter-style', get_stylesheet_uri() );
	
	//JS
	wp_enqueue_script( 'f6-starter-app', get_template_directory_uri() . '/js/app.min.js', array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'f6_starter_scripts' );






/*=====================================================================================
  Set the content width in pixels, based on the theme's design and stylesheet.
  Priority 0 to make it available to lower priority callbacks.
  
  @global int $content_width
  @since f6-starter 1.0.0
======================================================================================*/

function f6_starter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'f6_starter_content_width', 640 );
}
add_action( 'after_setup_theme', 'f6_starter_content_width', 0 );

 



/*=====================================================================================
  Register widget area.
  
  @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
  @since f6-starter 1.0.0
======================================================================================*/

function f6_starter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'f6-starter' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'f6-starter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'f6_starter_widgets_init' );





/*=====================================================================================
  Included Modification Files
  @since f6-starter 1.0.0
======================================================================================*/

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/mods/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/mods/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/mods/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/mods/jetpack.php';





/*=====================================================================================
  Custom Post Type Class
  
  @link http://github.com/jjgrainger/wp-custom-post-type-class/
  @since f6-starter 1.0.0
======================================================================================*/

require get_template_directory() . '/inc/classes/cpt.php';



?>
