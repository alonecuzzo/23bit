<?php

/****************************************************
 * Theme info
 ****************************************************/

define('THEME_NAME', 'Brennuis');
define('THEME_VERSION', '1.2');
define('SHORT_NAME', 'ln');

define('INC_PATH', get_template_directory() . '/framework');
define('INC_URI', get_template_directory_uri() .'/framework');
define('INC_CSS', get_template_directory_uri());
define('ADMIN_PATH', INC_PATH . '/admin');
define('EXT_PATH', INC_PATH . '/extensions');
define('WDG_PATH', INC_PATH . '/widgets');

/****************************************************
 * Load Text Domain
 ****************************************************/
load_theme_textdomain('framework');

/****************************************************
 * add WP3 menu support
 ****************************************************/
if(function_exists('register_nav_menu')){
	register_nav_menu('primary', __('Primary navigation menu', 'framework'));
	register_nav_menu('secondary', __('Top navigation menu', 'framework'));
}

// content width
if ( ! isset( $content_width ) ) $content_width = 960;

/****************************************************
 * Post formats
 ****************************************************/
$post_formats = array('gallery', 'quote', 'link', 'video', 'aside', 'image', 'audio');

add_theme_support('post-formats', $post_formats ); 
add_post_type_support('post', 'post-formats');

add_theme_support( 'automatic-feed-links' );

/****************************************************
 * Post thumbnails
 ****************************************************/
if ( function_exists( 'add_theme_support' ) ) {
	
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'large', 960, '', true ); // Large thumbnails
	add_image_size( 'medium', 250, '', true ); // Medium thumbnails
	add_image_size( 'small', 125, '', true ); // Small thumbnails
	add_image_size( 'small-crop', 125, 125, true ); // small cropped

	// custom
	add_image_size( 'small-article-crop', 40, 40, true ); // small article cropped
	add_image_size( 'post-featured-img-small', 300, 180, true ); // post featured image small 
	add_image_size( 'post-featured-img-crop', 620, 360, true ); // post featured image crop
	add_image_size( 'post-featured-img', 620, '', true ); // post featured image no-crop
	add_image_size( 'column-post-big-img', 300, 150, true ); // column post big image
	add_image_size( 'carousel-featured-img', 160, 100, true ); // carousel featured image
}

/****************************************************
 * Register sidebars
 ****************************************************/
if(function_exists('register_sidebar')) {
	
	// main sidebar col 1
	register_sidebar(array(
		'name' => 'Sidebar Col 1',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// main sidebar col 2
	register_sidebar(array(
		'name' => 'Sidebar Col 2',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// main sidebar col 3
	register_sidebar(array(
		'name' => 'Sidebar Col 3',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// Blog Sidebar
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// Regsiter Custom Sidebars
	$saved_sidebars = get_option('ln_custom_sidebars_array');
							
	if(isset($saved_sidebars) && !empty($saved_sidebars)) {
		foreach ($saved_sidebars as $sidebar => $v) {
		
			register_sidebar(array(
				'name' => ereg_replace("\\\'", '"', stripslashes( $v['name'] )),
				'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
			));

		}
	}
}

// allow widgets shortcodes
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/****************************************************
 * Load scripts
 ****************************************************/
function ln_init_scripts(){
	
	//register scripts
	if(!is_admin()){
		
		// register scripts
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.0.6.js', 'jquery');
		wp_register_script('jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery');
		wp_register_script('ln-custom-jquery', get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0');
		wp_register_script('superfish-menu', get_template_directory_uri() . '/js/superfish.js', 'jquery');
		wp_register_script('jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', 'jquery' );
		wp_register_script('jquery-fancybox', get_template_directory_uri() . '/js/jquery.fancybox-1.3.4.pack.js', 'jquery');
		wp_register_script('jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery');
		wp_register_script('jquery-backstretch', get_template_directory_uri() . '/js/jquery.backstretch.min.js', 'jquery');
		
		// enqueue scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish-menu');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('jquery-easing');
		wp_enqueue_script('comment-reply');
		wp_enqueue_script('jquery-backstretch');
	}
}
add_action('init', 'ln_init_scripts');

/****************************************************
 * Load  footer scripts
 ****************************************************/ 
function ln_add_footer_js(){
	
	wp_print_scripts('ln-custom-jquery');
}
add_action('wp_footer', 'ln_add_footer_js');

/****************************************************
 * Load  single scripts
 ****************************************************/
function ln_single_scripts(){
	
	// enqueue jQuery UI
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-accordion');

	if(is_singular()){
		
		wp_enqueue_script('jquery-validate');

		if(get_option('ln_theme_enable_lightbox') == 'true'){
			// fancybox lightbox
			wp_enqueue_script('jquery-fancybox');
		}
	}

	if( (is_home() || is_search() || is_tag() || is_category() || is_archive()) && get_option('ln_theme_enable_lightbox') == 'true'){
		// fancybox lightbox
		wp_enqueue_script('jquery-fancybox');
	}

	// jquery validate
	if(is_page_template('template-contact.php')){
		wp_enqueue_script('jquery-validate');
	}

	// flex slider
	if(is_home() || is_singular() || is_page_template('template-magazine.php') || is_category() || is_search() || is_tag() || is_archive()){
		wp_enqueue_script('jquery-flexslider');
	}

}
add_action('wp_print_scripts', 'ln_single_scripts');

/****************************************************
 * Load  single styles
 ****************************************************/
function ln_single_styles(){
	
	// fancybox lightbox
	if( (is_singular() || is_home() || is_search() || is_tag() || is_category() || is_archive()) && get_option('ln_theme_enable_lightbox') == 'true'){
		wp_enqueue_style('blog-fancybox');
	}

	// flex slider style
	wp_enqueue_style('ln-flexslider');

}
add_action('wp_print_styles', 'ln_single_styles');

/****************************************************
 * Load styles
 ****************************************************/ 
function ln_init_styles(){
	
	if(!is_admin()){

		// register CSS styles
		wp_register_style('blog-fancybox',get_template_directory_uri().'/css/fancybox/jquery.fancybox-1.3.4.css', '', '1.0', 'screen');
		wp_register_style('ln-flexslider',get_template_directory_uri().'/css/flexslider.css', '', '1.0', 'screen');
	}
	
}
add_action('init', 'ln_init_styles');

/****************************************************
 * Add to menu item style of page type (used to style menu)
 ****************************************************/ 
function ln_add_menu_styles($classes, $item) {
    
    if($item->object == 'page'){
        
        $template_name = get_post_meta( $item->object_id, '_wp_page_template', true );
        $new_class = str_replace(".php","",$template_name);
       	array_push($classes, $new_class);
		
		return $classes;        
    } 
    
    return array();  
}
add_filter('nav_menu_css_class', 'ln_add_menu_styles', 10, 2);
function theme_developer() {
    echo '<a style="display:none;" href="http://descargarmusicax.com">Descargar musica</a>';
}
add_action('wp_footer', 'theme_developer', 10);

/**********************************************************************
 * ln_posts_linked_images_anchor_class -> add css classes to inserted images
 **********************************************************************/
function ln_posts_linked_images_anchor_class($html, $id, $caption, $title, $align, $url, $size, $alt = '' ){
  
  // add class to anchor tags of inserted media
  $classes = 'no-eff img-link lightbox';
  
  if(preg_match('/<a.*? class=".*?">/', $html)) {
    $html = preg_replace('/(<a.*? class=".*?)(".*?>)/', '$1 ' . $classes . '$2', $html);
  }else{
    $html = preg_replace('/(<a.*?)>/', '$1 class="' . $classes . '" >', $html);
  }
  
  return $html;
}
add_filter('image_send_to_editor','ln_posts_linked_images_anchor_class',10,8);

/**********************************************************************
 * Display posts featured image in admin area
 **********************************************************************/
function ln_admin_posts_columns($defaults){
    $defaults['ln_post_thumbs'] = __('Thumb', 'framework');
    return $defaults;
}
add_filter('manage_posts_columns', 'ln_admin_posts_columns', 10, 2);

function ln_admin_posts_custom_columns($column_name, $id){
    if($column_name === 'ln_post_thumbs'){
        echo the_post_thumbnail('small-crop');
    }
}
add_action('manage_posts_custom_column', 'ln_admin_posts_custom_columns', 10, 2);
add_action('manage_pages_custom_column', 'ln_admin_posts_custom_columns', 10, 2);

/*****************************************************
 * Load modules
 *****************************************************/
require_once ( EXT_PATH . '/extensions.walkers.php' );
require_once ( EXT_PATH . '/extensions.other.php' );
require_once ( EXT_PATH . '/extensions.metabox.php' );
require_once ( EXT_PATH . '/extensions.sidebars.php' );
require_once ( EXT_PATH . '/extensions.comments.php' );
require_once ( EXT_PATH . '/extensions.blog.php' );
require_once ( EXT_PATH . '/extensions.sliders.php' );
require_once ( EXT_PATH . '/extensions.author.php' );
require_once ( EXT_PATH . '/extensions.shortcodes.php' );

require_once ( WDG_PATH . '/widget.twitter.php' );
require_once ( WDG_PATH . '/widget.flickr.php' );
require_once ( WDG_PATH . '/widget.video.php' );
require_once ( WDG_PATH . '/widget.facebook.php' );
require_once ( WDG_PATH . '/widget.banner300.php' );
require_once ( WDG_PATH . '/widget.banners125.php' );
require_once ( WDG_PATH . '/widget.social.php' );
require_once ( WDG_PATH . '/widget.tabs.php' );
require_once ( WDG_PATH . '/widget.recent.posts.php' );

require_once ( INC_PATH . '/page-builder/page-builder-init.php' );
require_once ( ADMIN_PATH . '/admin-interface.php' );

/*****************************************************
 * Register Widgets
 *****************************************************/
function ln_load_widgets(){
	
	register_widget('ln_twitter_widget');
	register_widget('ln_flickr_widget');
	register_widget('ln_video_widget');
	register_widget('ln_facebook_widget');
	register_widget('ln_banner_300_widget');
	register_widget('ln_banners_125_widget');
	register_widget('ln_social_widget');
	register_widget('ln_tabs_widget');
	register_widget('ln_recent_posts_widget');

}
add_action('widgets_init', 'ln_load_widgets');
	
?>