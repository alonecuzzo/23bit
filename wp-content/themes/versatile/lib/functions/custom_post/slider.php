<?php
function my_custom_slider() 
{
  $labels = array(  
    'name' => _x('Slide', 'post type general name'),  
    'singular_name' => _x('Slider', 'post type singular name'),  
    'add_new' => _x('Add New', 'Slide'),  
    'add_new_item' => __('Add New Slide'),  
    'edit_item' => __('Edit Slide'),  
    'new_item' => __('New Slide'),  
    'view_item' => __('View Slide'),  
    'search_items' => __('Search Slide'),  
    'not_found' =>  __('No slide found'),  
    'not_found_in_trash' => __('No slide found in Trash'),  
    'parent_item_colon' => ''  
   );  
  $args = array(  
    'labels' => $labels,  
    'public' => true,  
    'publicly_queryable' => true,  
    'show_ui' => true,  
    'query_var' => true,  
    'rewrite' => true,  
    'capability_type' => 'post',  
    'hierarchical' => true,  
    'menu_position' => null,
	'menu_icon' => get_stylesheet_directory_uri() . '/lib/admin/images/slider-icon-mini.png',  
    'supports' => array('title','editor','thumbnail')  
  );  
   register_post_type('slider',$args);  
}
add_action('init', 'my_custom_slider');
?>