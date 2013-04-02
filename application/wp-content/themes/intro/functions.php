<?php
/**
 * Intro functions and definitions
 *
 * @package Intro
 * @since Intro 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Intro 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 725; /* pixels */

/**
 * Custom Theme Options
 */
require( get_template_directory() . '/inc/theme-options.php' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Video Embeds
 */
require( get_template_directory() . '/inc/videos.php' );

/**
 * Portfolio
 */
require( get_template_directory() . '/inc/portfolio.php' );	

/**
 * Widgets
 */
require( get_template_directory() . '/inc/widgets.php' );	
	
if ( ! function_exists( 'intro_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Intro 1.0
 */
function intro_setup() {
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Intro, use a find and replace
	 * to change 'intro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'intro', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 222, 147, true ); 
	add_image_size( 'feature-slider', 1450, 458, true );
	add_image_size( 'blog-outside', 557, 339, true );
	add_image_size( 'blog-inside', 725, 457, true );
	add_image_size( 'portfolio-outside', 306, 237, true );
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'intro' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'video', 'gallery' ) );
	
	/**
	 * Custom Background
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'FFFFFF',
	) );
}
endif;
add_action( 'after_setup_theme', 'intro_setup' );

/** 
 * Returns the <title> tag based on what is being viewed. 
 * 
 * @since Intro 1.0 
 */ 
function intro_wp_title( $title, $sep ) { 
	global $paged, $page; 

	// Add the blog name. 
	$title .= get_bloginfo( 'name' ); 
	
	$site_description = get_bloginfo( 'description', 'display' ); 
	
	if ( $site_description && ( is_home() || is_front_page() ) ) 
		$title = "$title $sep $site_description"; 
	
	// Add a page number if necessary: 
	if ( $paged >= 2 || $page >= 2 ) 
		$title =  "$title $sep " . sprintf( __( 'Page %s', 'intro' ), max( $paged, $page ) );
		
	return $title; 
} 
add_filter( 'wp_title', 'intro_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Intro 1.0
 */
function intro_page_menu_args( $args ) {
	$args[ 'show_home' ] = true;
	$args[ 'container' ] = 'nav';
	
	return $args;
}
add_filter( 'wp_page_menu_args', 'intro_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Intro 1.0
 */
function intro_widgets_init() {
	register_widget( 'Intro_Recent_Projects_Widget' );
	
	register_sidebar( array(
		'name' => __( 'Sidebar', 'intro' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );
	
	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar( array(
			'name' => sprintf( __( 'Footer Column #%d', 'intro' ), $i ),
			'id' => sprintf( 'footer-%d', $i ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => "</div>",
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>'
		) );
	}
}
add_action( 'widgets_init', 'intro_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since Intro 1.0
 */
function intro_scripts() {
	global $post, $wp_styles;

	/** css */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'isotope', get_template_directory_uri() . '/css/isotope-style.css' );
	
	wp_enqueue_style( 'font-awesoem-ie', get_template_directory_uri() . '/css/font-awesome-ie7.css' );
	$wp_styles->add_data( 'font-awesoem-ie', 'conditional', 'lte IE 7' );
	
	wp_enqueue_style( 'style-ie', get_template_directory_uri() . '/css/ie.css' );
	$wp_styles->add_data( 'style-ie', 'conditional', 'lte IE 9' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.0.0.2.min.js' );
	
	if ( is_singular() ) {
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ) );
	}
	
	wp_enqueue_script( 'intro', get_template_directory_uri() . '/js/scripts.js', array( 'isotope', 'flexslider' ) );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'intro_scripts' );

function intro_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	
    return $html;
}
add_filter( 'post_thumbnail_html', 'intro_remove_thumbnail_dimensions', 10 );
add_filter( 'wp_get_attachment_link', 'intro_remove_thumbnail_dimensions', 10 );

/**
 * Select Box Walker
 *
 * Creates a selectbox/dropdown to be used with wp_nav_menu() for
 * resonsive elements.
 *
 * @see http://wordpress.stackexchange.com/a/27498
 *
 * @since Intro 1.0
 */
class Intro_Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
	function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); 
	}

    function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth);
    }

   function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$output .= $indent . '<option value="'   . esc_attr( $item->url        ) .'" id="menu-item-'. $item->ID . '">';
		
		$item->title = str_repeat("&nbsp;", $depth * 4) . $item->title;
		
		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

    function end_el(&$output, $item, $depth){
		$output .= "</option>\n";
    }
}