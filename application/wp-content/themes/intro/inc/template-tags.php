<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Intro
 * @since Intro 1.0
 */
 
if ( ! function_exists( 'intro_blog_title' ) ) :
/**
 * Blog Title
 *
 * @since Intro 1.0
 */
function intro_blog_title() {
	if ( get_option( 'page_for_posts' ) )
		echo esc_attr( get_the_title( get_option( 'page_for_posts' ) ) );
	else
		echo apply_filters( 'intro-blog_title', __( 'Blog', 'intro' ) );
}
endif;

if ( ! function_exists( 'intro_format_icon' ) ) :
/**
 * Output the proper class name for each post format
 *
 * @since Intro 1.0
 */
function intro_format_icon() {
	global $post;
	
	$format = get_post_format();
	
	if ( 'video' == $format )
		echo 'icon-facetime-video';
	elseif ( 'gallery' == $format )
		echo 'icon-camera';
	else
		echo 'icon-search';
}
endif; 

if ( ! function_exists( 'intro_paginate_links' ) ) :
/**
 * Paginate Links
 *
 * @since Intro 1.0
 */
function intro_paginate_links( $args = array() ) {
	global $wp_query;
	
	if ( get_query_var( 'paged' ) ) {
		$current_page = get_query_var( 'paged' );
	} else if ( get_query_var( 'page' ) ) {
		$current_page = get_query_var( 'page' );
	} else {
		$current_page = 1;
	}

	$permalink_structure = get_option('permalink_structure');
	$format = empty( $permalink_structure ) ? '?page=%#%' : 'page/%#%/';

	$base = get_pagenum_link(1) . '%_%';

	if ( is_search() ) {
		$big = 99999999;
		$format = '&paged=%#%';
		str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
	}
	
	$defaults = array(
		'total'     => $wp_query->max_num_pages,
		'base'      => $base,
		'format'    => $format,
		'current'   => $current_page,
		'prev_next' => false,
		'type'      => 'list',
		'show_all'  => true
	);
	
	$args = wp_parse_args( $args, $defaults );

	echo paginate_links( apply_filters( 'intro_paginate_links', $args ) );
}
endif;
 
if ( ! function_exists( 'intro_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Intro 1.0
 */
function intro_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<div class="text">
			<p><?php _e( 'Pingback:', 'intro' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'intro' ), ' ' ); ?></p>
		</div>
	<?php
			break;
		default :
	?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php echo get_avatar( $comment, 53 ); ?>
			<div class="text">
			<p class="title"><?php printf( __( '%s <span class="says">said on</span> %2$s at %3$s', 'intro' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ), get_comment_date(), get_comment_time() ); ?></p>
			<div class="comment-content"><?php comment_text(); ?></div>
		</div>

	<?php
			break;
	endswitch;
}
endif; // ends check for intro_comment()

if ( ! function_exists( 'intro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Intro 1.0
 */
function intro_posted_on() {
	printf( __( 'Posted by <span class="author vcard"><a class="author url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span> on <a href="%4$s" title="%5$s" rel="bookmark"><time class="entry-date" datetime="%6$s" pubdate>%7$s</time></a>', 'intro' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'intro' ), get_the_author() ) ),
		esc_html( get_the_author() ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;