<?php
/**
 * Portfolio
 *
 * @package Intro
 * @since Intro 1.0
 */

function intro_portfolio_category() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Portfolio Categories', 'intro' ),
		'singular_name'     => __( 'Portfolio Category', 'intro' ),
		'search_items'      => __( 'Search Portfolio Categories', 'intro' ),
		'all_items'         => __( 'All Categories', 'intro' ),
		'parent_item'       => __( 'Parent Category', 'intro' ),
		'parent_item_colon' => __( 'Parent Category:', 'intro' ),
		'edit_item'         => __( 'Edit Category', 'intro' ), 
		'update_item'       => __( 'Update Category', 'intro' ),
		'add_new_item'      => __( 'Add New Category', 'intro' ),
		'new_item_name'     => __( 'New Category', 'intro' ),
		'menu_name'         => __( 'Portfolio Categories', 'intro' ),
	); 	

	$args = array(
		'hierarchical' => true,
		'labels'       => $labels,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'portfolio' ),
	);
	
	register_taxonomy( 'portfolio_category', array( 'post' ), $args );
}
add_action( 'init', 'intro_portfolio_category' );
 
/**
 * Find Portfolio Page
 *
 * Query pages with page template meta, and find
 * the one with the Portfolio template applied. Add
 * to a transient.
 *
 * @since Intro 1.0
 */
function intro_find_portfolio_page() {
	if ( false === ( $page = get_transient( 'intro-portfolio-page' ) ) ) {
		$pages = new WP_Query( array(
			'posts_per_page' => 1,
			'post_type'      => 'page',
			'meta_query'     => array(
				array(
					'key'     => '_wp_page_template',
					'value'   => 'templates/page-template-portfolio.php',
					'compare' => '='
				)
			)
		) );
		
		$page = $pages->posts[0]->ID;
		
		set_transient( 'intro-portfolio-page', $page, 60 * 60 * 72 );
	}
	
	return $page;
}

/**
 * Delete Portfolio Transient
 *
 * When post is saved, there is a chance the page template
 * was updated. Clear the transient if so.
 * 
 * @since Intro 1.0
 */
function intro_clear_portfolio_page( $post_id, $post ) {
	// Bail if not a POST action
	if ( 'POST' !== strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) )
		return;
		
	/** Don't save when autosaving */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	/** Make sure we are on a page */
	if ( 'page' != $post->post_type )
		return $post_id;
		
	delete_transient( 'intro-portfolio-page' );
}
add_action( 'save_post', 'intro_clear_portfolio_page', 10, 2 );

/**
 * If we are on the blog don't show portfolio posts.
 * They should be shown/archived everywhere else.
 *
 * @since Intro 1.0
 */
function intro_filter_portfolio( $query ) {
	if ( is_admin() )
		return $query;
		
	if ( $query->is_main_query() && ! is_search() && ! is_archive() ) {
		$query->set( 'tax_query', array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-video', 'post-format-gallery' ),
				'operator' => 'NOT IN'
			)
		) );
	}
	
	return $query;
}
add_action( 'pre_get_posts', 'intro_filter_portfolio' );

/**
 * Show the styleselect button in the second row of the editor
 *
 * @since Intro 1.0
 */
function intro_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
	
    return $buttons;
}
add_filter( 'mce_buttons_2', 'intro_mce_buttons_2' );

/**
 * Add a few items to the styleselect box in TinyMCE
 *
 * @since Intro 1.0
 */
function intro_mce_before_init( $settings ) {
    $style_formats = array(
    	array(
    		'title'    => __( 'Portfolio Meta', 'intro' ),
    		'selector' => 'ul',
    		'classes'  => 'portfolio-meta'
    	),
		array(
			'title'   => __( 'Visit Site Button', 'intro' ),
			'inline'   => 'div',
			'classes' => 'holder view-site'
		)
    );

    $settings[ 'style_formats' ] = json_encode( $style_formats );

    return $settings;
}
add_filter( 'tiny_mce_before_init', 'intro_mce_before_init' );