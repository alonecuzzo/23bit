<?php
function portfolio_register() {
	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New Post', 'portfolio Listing'),
		'add_new_item' => __('Add New Post'),
		'edit_item' => __('Edit Post'),
		'new_item' => __('New Portfolio Post Item'),
		'view_item' => __('View Portfolio Item'),
		'search_items' => __('Search Portfolio Items'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'with_front' => false ),
		'query_var' => false,	
		'menu_icon' => get_stylesheet_directory_uri() . '/lib/admin/images/slider-icon-mini.png',  		
		'supports' => array('title','editor','thumbnail','excerpt')
	  ); 
 
	register_post_type( 'portfolio' , $args );
}
register_taxonomy("portfolio_type", portfolio, array("hierarchical" => true, "label" => "Portfolio Categories", "singular_label" => "Portfolio Categories",'show_ui' => true,
		'query_var' => true,
		'rewrite' => false,));
add_action('init', 'portfolio_register');
add_action("template_redirect", 'my_template_redirect');

// Template selection
function my_template_redirect()
{
	global $wp;
	global $wp_query;
	if ($wp->query_vars["post_type"] == "portfolio")
	{
		// Let's look for the portfolio.php template file in the current theme
		if (have_posts())
		{
			include(TEMPLATEPATH . '/single-portfolio.php');
			die();
		}
		else
		{
			$wp_query->is_404 = true;
		}
	}
}

?>