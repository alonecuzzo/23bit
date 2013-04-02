<?php
function my_breadcrumb() {
	breadcrumbs_plus(array(
		'prefix'	=> '<img src="'. get_template_directory_uri().'/images/home-icon.png" width="16" height="16" alt="Home" class="bread-icon" />',
		'suffix'	=> '',
		'title'		=> false,
		'home'		=> __( 'Home', 'versatile_front' ),
		'sep'		=> '&rarr;',
		'front_page'=> false,
		'bold'		=> true,
		'blog'		=> __( 'Blog', 'versatile_front' ),
		'echo'		=> true,
		'singular_portfolio_taxonomy'	=> 'portfolio_type'
	));
}
?>