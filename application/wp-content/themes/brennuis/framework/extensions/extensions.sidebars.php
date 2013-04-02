<?php

/*************************************************************
 * 
 * Sidebars options
 *
 *************************************************************/

// array with default sidebars
$ln_theme_sidebars_array = array( "default" => "Default", "blog-sidebar" => "Blog Sidebar" );

// get custom saved sidebars
$saved_sidebars = get_option('ln_custom_sidebars_array');
							
if(isset($saved_sidebars) && !empty($saved_sidebars)) {
	
	foreach ($saved_sidebars as $sidebar => $v) {
		$name = ereg_replace("\\\'", '"', stripslashes( $v['name'] ));
		$ln_theme_sidebars_array[$name] = $name;
	}

}

// METABOX OPTIONS
$ln_sidebars_metabox_options = array();

$ln_sidebars_metabox_options[] = array( "name" => "Sidebar",
										"desc" => __("Page sidebar options", "framework"),
										"id" => SHORT_NAME."_meta_page_style_sidebar_head",
										"std" => "",
										"class" => "ln-input",
										"type" => "heading");

$ln_sidebars_metabox_options[] = array( "name" => "Sidebar Position",
										"desc" => __("Sidebar position:", "framework"),
										"id" => SHORT_NAME."_meta_page_sidebar_position",
										"std" => "right",
										"class" => "ln-input",
										"options" => array('left' => 'Left', 'right' => 'Right' ),
										"type" => "select");

$ln_sidebars_metabox_options[] = array( "name" => "Sidebar ID",
										"desc" => __("Choose sidebar:", "framework"),
										"id" => SHORT_NAME."_meta_page_sidebar",
										"std" => "default",
										"class" => "ln-input",
										"options" => $ln_theme_sidebars_array,
										"type" => "select");

/*************************************************************
 * Add Sidebars metabox
 *************************************************************/
function ln_add_sidebars_options_metabox(){
		
	global $post;
	$template = get_post_meta( $post->ID, '_wp_page_template', true );

	add_meta_box('ln-page-meta-sliders', __('Sidebar Options', 'framework'), 'ln_sidebar_options_metabox_iu', 'post', 'normal', 'high');

	if( $template != 'template-fullwidth.php' ){
		add_meta_box('ln-page-meta-sliders', __('Sidebar Options', 'framework'), 'ln_sidebar_options_metabox_iu', 'page', 'normal', 'high');
	}
	
}
add_action('add_meta_boxes', 'ln_add_sidebars_options_metabox');

/*************************************************************
 * Sidebars metabox UI
 *************************************************************/
function ln_sidebar_options_metabox_iu(){

	global $ln_sidebars_metabox_options;

	echo ln_show_metabox_options($ln_sidebars_metabox_options); // in extensions.metabox.php
}

/**
 * ln_get_single_page_sidebar
 *
 * @param $sidebar_name - sidebar name (id)
 * - outputs single page sidebar
 **/
function ln_get_single_page_sidebar($sidebar_name){

	if(!isset($sidebar_name) || $sidebar_name == ''){
		$sidebar_name = 'default';
	}

	// default or blog sidebar
	if($sidebar_name == 'default' || $sidebar_name == 'blog-sidebar'){
		
		get_sidebar('blog');

	}else{
		
		// custom sidebar
		
		echo '<aside id="content-sidebar" class="sidebar-'.strtolower($sidebar_name).'">';
		if(!function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar($sidebar_name));
		echo '</aside>';
		echo '<div class="clear"></div>';
	}

}

?>