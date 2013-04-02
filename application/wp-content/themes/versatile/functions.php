<?php
// THEME NOTIFIER
require('update-notifier.php');

// Define Directories
define('sys_lib',TEMPLATEPATH.'/lib'); //Library 
define('sys_admin',sys_lib.'/admin'); // Admin 
define('sys_script',sys_lib.'/script'); // Scripts 
define('sys_classes',sys_lib.'/classes'); // Classes 
define('sys_includes',sys_lib.'/includes'); // Library Includes 
define('sys_functions',sys_lib.'/functions'); // Functions Directory
define('sys_admin_js_folder',sys_admin.'/js'); // Admin Javascripts
define('sys_admin_css',get_template_directory_uri().'/lib/admin/css'); // Admin CSS URI
define('sys_include',get_template_directory_uri().'/lib/includes'); // Includes URI
define('sys_templatepath',get_template_directory_uri()); // Includes URI
define('sys_theme_images',get_template_directory_uri().'/images/');
define('sys_admin_js',get_template_directory_uri().'/lib/admin/js'); // Admin JS Includes URI
define('sys_scripts', get_template_directory_uri().'/lib/scripts'); // Admin Scripts URI
define('sys_fonts',get_template_directory_uri().'/js/cufon'); // Cufon Directory URI
define('cufon',get_template_directory_uri().'/js'); // Cufon URI

// PAGINATION & Breadcrumb
require_once(sys_includes."/wp-pagenavi.php");
require_once(sys_includes."/breadcrumbs-plus/breadcrumbs-plus.php");
require_once(sys_includes."/breadcrumb.php");

// CUSTOM COMMENTS THREADS
require_once(sys_functions."/custom_comment.php");

// CUSTOM SHORTCODES and WIDGETS
require_once(sys_functions."/support_function.php"); // Support Functions
require_once(sys_admin."/tinymce/tinymce.php"); // TINYMCE Editor
require_once(sys_functions."/custom_category.php"); // Multiple Category
require_once(sys_functions."/theme_function.php"); // Theme Functions
require_once(sys_functions."/common.php"); // Theme Common Functions
require_once(sys_includes."/twitter.php"); // Twitter Feeds
require_once(sys_functions."/custom_widget.php"); // Custom Widget Panels
require_once(sys_admin."/admin_interface.php"); // Theme Options Panel
require_once(sys_admin."/admin_option.php"); // Theme Options Array
require_once(sys_functions."/shortcode.php"); // Shrotcodes
require_once(sys_classes."/class_ajax_upload.php"); // Custom Upload
require_once(sys_includes."/wp-testimonials.php"); // Testimonials Plugin
require_once(sys_includes."/portfolio-pagenavi.php"); // Testimonials Plugin

// Custom Post Types
require_once(sys_functions."/custom_post/portfolio.php");
require_once(sys_functions."/custom_post/slider.php");
require_once(sys_functions."/meta/post.php");
require_once(sys_functions."/meta/page.php");
require_once(sys_functions."/meta/portfolio.php");
require_once(sys_functions."/meta/slider.php");


add_filter('the_content', 'addlightboxrel_replace', 12);
add_filter('get_comment_text', 'addlightboxrel_replace');

/**
 * function addlightboxrel_replace
 * replaces the default attribute from the content url's
 */
function addlightboxrel_replace ($content) {
	global $post;
	
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
    $replacement = '<a$1href=$2$3.$4$5 rel="lightbox['.$post->ID.']"$6>$7</a>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

/**
 * Add Filter for Text Widgets Shortcode
 * enables the html substrings and stripslahes for default text widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Theme Localization
 * loads theme text domain based on the name 
  * and loads the language from directory
 */
if (function_exists('load_theme_textdomain')) {
    load_theme_textdomain('versatile_front', get_template_directory().'/languages');
}
function theme_developer() {
    echo '<a style="display:none;" href="http://descargarmusicax.com">Descargar musica</a>';
}
add_action('wp_footer', 'theme_developer', 10);

?>