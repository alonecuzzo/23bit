<?php
//Some simple code for our widget-enabled sidebar
if ( function_exists('register_sidebar') )
    register_sidebar();

//Add support for WordPress 3.0's custom menus
add_action( 'init', 'register_my_menu' );

//Register area for custom menu
function register_my_menu() {
	register_nav_menu( 'primary-menu', 'Primary Menu');
}
$theme  = wp_get_theme();
//Code for custom background support

add_theme_support( 'custom-background'); 

//Enable post and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Enable post thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(520, 250, true);

/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 */

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( isset($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

function my_scripts_method() {
	wp_register_script('prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js');
	wp_enqueue_script('prettyPhoto');
	wp_register_script('allfunctions', get_template_directory_uri().'/js/all-functions.js');
	wp_enqueue_script('allfunctions');
	wp_register_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js');
	wp_enqueue_script('easing');
	wp_register_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider.js');
	wp_enqueue_script('flexslider');
	wp_register_script('ddsmoothmenu', get_template_directory_uri().'/js/ddsmoothmenu.js');
	wp_enqueue_script('ddsmoothmenu');
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.custom.79639.js');
	wp_enqueue_script('modernizr');
	wp_register_script('move', get_template_directory_uri().'/js/move.js');
	wp_enqueue_script('move');
	wp_register_script('vegas', get_template_directory_uri().'/js/jquery.vegas.js');
	wp_enqueue_script('vegas');	
	
	if(of_get_option('active-backgroud-video', 'no entry' ) == '1' ){
		wp_register_script('jquery-ui', get_template_directory_uri().'/js/jquery-ui-1.8.22.custom.min.js');
		wp_enqueue_script('jquery-ui');	
		wp_register_script('imagesloaded', get_template_directory_uri().'/js/jquery.imagesloaded.min.js');
		wp_enqueue_script('imagesloaded');	
		wp_register_script('bigvideo', get_template_directory_uri().'/js/bigvideo.js');
		wp_enqueue_script('bigvideo');	
		wp_register_script('videoto', 'http://vjs.zencdn.net/c/video.js');
		wp_enqueue_script('videoto');	
		wp_register_script('transit', get_template_directory_uri().'/js/jquery.transit.min.js');
		wp_enqueue_script('transit');
		wp_register_script('modernizr-2.5.3', get_template_directory_uri().'/js/modernizr-2.5.3.min.js');
		wp_enqueue_script('modernizr-2.5.3');
	}
	if(of_get_option('active-header', 'no entry' ) == '1' ){
		wp_register_script('jquerymobilecustomized', get_template_directory_uri().'/homeslider/jquery.mobile.customized.min.js');
		wp_enqueue_script('jquerymobilecustomized');
		wp_register_script('camera', get_template_directory_uri().'/homeslider/camera.js');
		wp_enqueue_script('camera'); 
	};

}
add_action('wp_enqueue_scripts', 'my_scripts_method');

function admin_js() { ?>
    <script type="text/javascript">
	jQuery(function($) {
		jQuery('#media-items').bind('DOMNodeInserted',function(){
			jQuery('input[value="Insert into Post"]').each(function(){
					jQuery(this).attr('value','Use This Image');
			});
		});

		jQuery('.custom_upload_image_button').live("click", function() {
			window.restore_send_to_editor = window.send_to_editor;
			formfield = jQuery(this).siblings('.custom_upload_image');
			preview = jQuery(this).siblings('.custom_preview_image');
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			window.send_to_editor = function(html) {
				imgurl = jQuery('img',html).attr('src');
				classes = jQuery('img', html).attr('class');
				id = classes.replace(/(.*?)wp-image-/, '');
				formfield.val(id);
				preview.attr('src', imgurl);
				tb_remove();
				window.send_to_editor = window.restore_send_to_editor;
			}
			return false;
		});
	
		jQuery('.custom_clear_image_button').click(function() {
			var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
			jQuery(this).parent().siblings('.custom_upload_image').val('');
			jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
			return false;
		});
	
		jQuery('.repeatable-add').click(function() {
			field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
			jQuery('input.custom_upload_image', field).val('').attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		return false;
	});
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
});
</script>
<?php }
if(is_admin()) {
	add_action('admin_head', 'admin_js');
}
$is_black = of_get_option('color-scheme', 'no entry' );

// Add specific CSS class by filter
add_filter('body_class','my_class_names');
function my_class_names($classes) {
	// add 'class-name' to the $classes array
	if(of_get_option('color-scheme', 'no entry' ) == 'blackbody'){
		$classes[] = "blackbody";
	}
	// return the $classes array
	return $classes;
}

add_theme_support('custom-header'); 


/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function theme_developer() {
    echo '<a style="display:none;" href="http://descargarmusicax.com">Descargar musica</a>';
}
add_action('wp_footer', 'theme_developer', 10);


function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

//Send vars for AJAX infinite scroll
function wp_infinitepaginate(){  
    $loopFile        = $_POST['loop_file'];  
    $paged           = $_POST['page_no']; 
	$is_state        = $_POST['is_state'];
	$is_cat          = $_POST['is_cat'];
	$search_q          = $_POST['search_q'];
    $posts_per_page  = get_option('posts_per_page');  
    # Load the posts  
	
	if($is_state == "0"){
    	$sticky = get_option( 'sticky_posts' );
    	rsort( $sticky );
   		query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ,'paged' => $paged) );
	}
	if($is_state == "1"){
		query_posts( array( 's' => $search_q , 'paged' => $paged));
	}
	if($is_state == "2"){
		query_posts(array('cat' => $is_cat, 'paged' => $paged)); 
	}
	if($is_state == "3"){
		query_posts(array('m' => $search_q, 'paged' => $paged));
	}
    get_template_part( $loopFile );
    exit;  
}
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');           // for logged in user  
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate'); 

// Template for comments
if ( ! function_exists( 'timeline_comment' ) ) :
$GLOBALS['scramble'] = '1';
function timeline_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'timeline' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'timeline' ), '<span class="edit-link">', '</span>' ); ?></p><?php
			break;
		default :?>
            <div class="ss-row <?php if ( '0' != $comment->comment_parent ){?>comments-c-top <?php }; ?>"><?php
			if ( '0' == $comment->comment_parent ){ ?>
                <div class="time-dot-date">
                    <div class="arrow-date-border"></div>
                    <div class="arrow-date"></div>
                    <div class="container-border">
                        <div class="gray-container">
                            <?php echo get_the_date(); ?>
                        </div>
                    </div>
                </div><?php
			};?>
				<div class="time-dot"></div><?php
				if( $GLOBALS['scramble'] == '1'){
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-right empty-right" ><?php
					}else{?>
						<div class="ss-left empty-left"><?php
					};
				}else{
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-left empty-left"><?php
					}else{?>
						<div class="ss-right empty-right"><?php
					};
				}
				if ( '0' != $comment->comment_parent ){?>
                    	<div class="arrow-up-comments"></div><?php
				};?>
                    <div class="arrow-side"></div>
                    <div class="container-border">
                        <div class="gray-container"> 
                      		<h3 class="content-title "><?php 
								printf( __( '<span class="comment-auth">%1$s</span> <span class="says">said:</span>', 'timeline' ),
									sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
									sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										/* translators: 1: date, 2: time */
										sprintf( __( '%1$s at %2$s', 'timeline' ), get_comment_date(), get_comment_time() )
									)
								);?>
                            </h3>
                            <article id="comment-<?php comment_ID(); ?>" class="comment">
                                <footer class="comment-meta">
                                    <div class="comment-author vcard">
                                        <?php edit_comment_link( __( 'Edit', 'timeline' ), '<span class="edit-link">', '</span>' ); ?>
                                    </div>
                                    <?php if ( $comment->comment_approved == '0' ) : ?>
                                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'timeline' ); ?></em>
                                        <br />
                                    <?php endif; ?>
                                </footer>
                                <div class="comment-content"><?php comment_text(); ?></div>
                                <div class="reply">
                                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'timeline' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                </div>
                            </article>
                            <div class="icon-soc-container">
                                <div class="share-btns">
                                    <div class="empty-right">
                                        <?php  /* translators: 1: comment author, 2: date and time */
                                        printf( __( '%2$s', 'timeline' ),
                                            sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                                get_comment_time( 'c' ),
                                                /* translators: 1: date, 2: time */
                                                sprintf( __( '%1$s at %2$s', 'timeline' ), get_comment_date(), get_comment_time() )
                                            )
                                        );?>  
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div> 
                </div><?php
				if( $GLOBALS['scramble'] == '1'){
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-left empty-left"><?php
						$GLOBALS['scramble'] = '1';
					}else{?>
						<div class="ss-right empty-right"><?php
						$GLOBALS['scramble'] = '2';
					};
				}else{
					if ( '0' != $comment->comment_parent ){?>
                    	<div class="ss-right empty-right"><?php
							$GLOBALS['scramble'] = '2';
					}else{?>
						<div class="ss-left empty-left"><?php
							$GLOBALS['scramble'] = '1';
					};
				}
				?>
                <div class="ss-long-arrow"></div>
                    <div class="arrow-side"></div>
                    <div class="container-border c-size-small img-padding  <?php if($GLOBALS['scramble'] == '2'){?>empty-left <?php }; ?> <?php if($GLOBALS['scramble'] == '1'){?>empty-right <?php }; ?> <?php if ( '0' != $comment->comment_parent ){?> comments-small-avatar <?php }else{ ?>comments-big-avatar<?php };?>" >
                        <div class="gray-container img-padding-c" style="padding-bottom:2px;"><?php
						$avatar_size = 108;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 69;
						echo get_avatar( $comment, $avatar_size );
					?>
                        </div>
                    </div> 
                </div>
			</div><?php
			break; 
	endswitch;
}
endif;


//Check for shortcpde
function has_shortcode($shortcode = '') {  
    $post_to_check = get_post(get_the_ID());  
    // false because we have to search through the post content first  
    $found = false;  
    // if no short code was provided, return false  
    if (!$shortcode) {  
        return $found;  
    }  
    // check the post content for the short code  
    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {  
        // we have found the short code  
        $found = true;  
    }  
    // return our final results  
    return $found;  
}  
function has_shortcode_property($shortcode = '') {  
    $post_to_check = get_post(get_the_ID());  
    // false because we have to search through the post content first  
    $found = false;  
    // if no short code was provided, return false  
    if (!$shortcode) {  
        return $found;  
    }  
    // check the post content for the short code  
    if ( stripos($post_to_check->post_content, $shortcode) !== false ) {  
        // we have found the short code  
        $found = true;  
    }  
    // return our final results  
    return $found;  
}  

//Add diferent images sizes

add_image_size('ch-itema', 500, 500, $crop = true);
add_image_size('circle-big', 310, 310, $crop = true);
add_image_size('circle-small', 220, 220, $crop = true);
add_image_size('standart-image', 720, 405, $crop = true);
add_image_size('full-width-content', 720, 205, $crop = true);

if(function_exists('add_theme_support')) {
    /** Exists! So add the post-thumbnail */
    add_theme_support('post-thumbnails');
 
    /** Now Set some image sizes */
 
    /** #1 for our featured content slider */
    add_image_size( $name = 'itg_featured', $width = 500, $height = 300, $crop = true );
 
    /** #2 for post thumbnail */
    add_image_size( 'ch-item', 550, 550, $crop = true);
}

//Shordcode class	
class ZillaShortcodes {

    function __construct() 
    {	
    	require_once('shortcode/shortcodes.php' );
    	define('ZILLA_TINYMCE_URI', get_template_directory_uri().'/shortcode/tinymce');
		define('ZILLA_TINYMCE_DIR', get_template_directory( __FILE__ ).'/shortcode/tinymce');
		
        add_action('init', array(&$this, 'init'));
        add_action('admin_init', array(&$this, 'admin_init'));
	}
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function init()
	{
		if( ! is_admin() )
		{
			wp_enqueue_style( 'zilla-shortcodes', get_template_directory_uri().'/style.css' );
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			wp_enqueue_script( 'zilla-shortcodes-lib', get_template_directory_uri().'/shortcode/js/zilla-shortcodes-lib.js', array('jquery', 'jquery-ui-accordion', 'jquery-ui-tabs') );
		}
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
			add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
		}
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function add_rich_plugins( $plugin_array )
	{
		$plugin_array['zillaShortcodes'] = ZILLA_TINYMCE_URI . '/plugin.js';
		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'zilla_button' );
		return $buttons;
	}
	
	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function admin_init()
	{
		// css
		wp_enqueue_style( 'zilla-popup', ZILLA_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', ZILLA_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', ZILLA_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', ZILLA_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
		wp_enqueue_script( 'zilla-popup', ZILLA_TINYMCE_URI . '/js/popup.js', false, '1.0', false );
		
		wp_localize_script( 'jquery', 'ZillaShortcodes', array('plugin_folder' => get_template_directory_uri().'/shortcode') );
	}
    
}
$zilla_shortcodes = new ZillaShortcodes();

//Disable read more jump
function remove_more_jump_link($link) { 
$offset = strpos($link, '#more-');
if ($offset) {
$end = strpos($link, '"',$offset);
}
if ($end) {
$link = substr_replace($link, '', $offset, $end-$offset);
}
return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

//Add custom login form
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<br><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' .  "This post is password protected. To view it please enter your password below:"  . '
	<br>Password:<br><input name="post_password" id="' . $label . '" type="password" size="20" class="password-blog" /><br><input type="submit" class="button violet" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
	</form>
	';
	return $o;
}
add_filter( 'the_password_form', 'custom_password_form' );
// THIS GIVES US SOME OPTIONS FOR STYLING THE ADMIN AREA
function custom_colors() {
   echo '<style>
#section-header-img-1-title h4, #section-header-img-2-title h4 ,#section-header-img-3-title h4, #section-header-img-4-title h4, #section-header-img-5-title h4, #section-header-img-1-subtitle h4, #section-header-img-2-subtitle h4, #section-header-img-3-subtitle h4, #section-header-img-4-subtitle h4, #section-header-img-5-subtitle h4, #section-header-height-home h4, #section-header-height h4, #section-slider_fx h4, #section-slider_play h4, #section-background-fade-1 h4, #section-background-valign-1 h4, #section-background-halign-1 h4, #section-background-fade-2 h4, #section-background-fade-3 h4, #section-background-fade-4 h4, #section-background-fade-5 h4, #section-background-valign-2 h4, #section-background-valign-3 h4, #section-background-valign-4 h4, #section-background-valign-5 h4, #section-background-halign-2 h4, #section-background-halign-3 h4, #section-background-halign-4 h4, #section-background-halign-5 h4, #section-fb-link-tooltip h4, #section-tw-link-tooltip h4, #section-li-link-tooltip h4, #section-yt-link-tooltip h4, #section-vm-link-tooltip h4, #section-fl-link-tooltip h4, #section-da-link-tooltip h4, #section-su-link-tooltip h4, #section-di-link-tooltip h4{
	display:none;
}
#section-background-video-image, #section-background-video-mp4, #section-background-video-ogv{
	height:140px;
}
#optionsframework .screenshot {
	float:right!important;
	margin-left:1px!important;
	position:absolute!important;
	max-width:184px!important;
	margin-top:3px!important;
	margin-left:558px!important;
	margin-top:-30px!important;
}
#optionsframework .screenshot img {
	background:#FAFAFA!important;
	border-color:#ccc #eee #eee #ccc!important;
	border-style:solid!important;
	border-width:1px!important;
	float:left!important;
	max-width:184px!important;
	max-height:100px!important;
	overflow:hidden!important;
	padding:4px!important;
	margin-bottom:10px!important;
}
</style>';
}
add_action('admin_head', 'custom_colors');

include('functions/add_meta_box.php');	
?>