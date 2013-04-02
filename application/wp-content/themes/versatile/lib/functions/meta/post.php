<?php
	$post_meta_boxes =
	array(
	


			"sidebar" => array(
		"name" => "sidebar",  
		"title" => "Choose Sidebar Position", 
		"meta_name" => "options", 
		"description" => "Select the options below for displaying the sidebar right aligned or left aligned",
		"type" => "radio",
		"std" =>"",
		"class" => "radio",
		"options" => array("leftsidebar" => "Left Sidebar",
							"rightsidebar" => "Right Sidebar"
								)
),
"Breadcrumb" => array(
			"name" => "breadcrumbs",
			"type" => "checkbox",
			"meta_name" => "display",
			"std" => "",
			"title" => "breadcrumbs",
			"description" => "Check this if you want to disable the breadcrumb for this post"),


		"radio" => array(
		"name" => "radio",
		"title" => "Custom Subheader Teaser Options",
		"description" => "Select the options below for displaying the subheader teaser.",
		"meta_name" => "options",
		"type" => "radio",
		"class" => "radio",
		"std" =>"default",
		"rows" => "",
		"width" => "",
		"options" => array("twitter" => "Twitter", 
							"custom" => "Custom", 
							"disable" => "Disable",
							"default" => "Default",
							"customhtml" => "Custom HTML")
						),
         

		"desc" => array(
		"name" => "page",
		"type" => "textarea",
		"meta_name" => "desc",
		"std" => "",
		"title" => "Custom Subheader Teaser Text/HTML",
		"description" => "Enter the text which will appear in the subheader of this page. If you want to use bold text use html strong element example &lt;strong&gt;bold text &lt;/strong&gt;"),
			"sidebar"=> array(
			'title' =>'Custom Sidebar',
			'name'	=> 'custom',
			'meta_name'	=> 'widget',
			"options1" =>  $sidebarwidget,
			'type'	=> 'customselect',
			'description'	=>'Select the Sidebar you want to associate with this page.',
		
		),

	);

		function cusom_post_meta_box() {
		global $post, $post_meta_boxes,$sidebarwidget;
		echo'<div class="postoptions">';
		foreach($post_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID,$meta_box['name'].'_'.$meta_box['meta_name'], true);	
				if($meta_box_value == "")
					$meta_box_value = $meta_box['std'];
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				if( $meta_box['type'] == "text" )
				{
				echo'<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
				echo'<div class="box-info"><label for="'.$meta_box['name'].'_'.$meta_box['meta_name'].'">'.$meta_box['description'].'.</label></div>';				
				echo'<div class="box-option">';
				echo'<input type="text" name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'" value="'.stripslashes(get_post_meta($post->ID, $meta_box['name'].'_'.$meta_box['meta_name'], true)).'" size="50%" />';
				echo'</div></div></div>';
				}
				if( $meta_box['type'] == "customselect" )
				{
				echo'<div class="metabox">';
				echo'<h3>'.$meta_box['title'].'</h3><div class="metainner">';
				echo'<div class="box-info"><label for="'.$meta_box['name'].'_'.$meta_box['meta_name'].'">'.$meta_box['description'].'.</label></div>';				
				echo'<div class="box-option">';
				echo '<select name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'" id="'.$meta_box['name'].'_'.$meta_box['meta_name'].'">';
				echo '<option value="">select</option>';  echo $meta_box['options1'];
				if($sidebarwidget!=""){
			foreach ($meta_box['options1'] as $key => $value) {
				
					echo '<option value="'.$value.'"', $meta_box_value == $value ? ' selected="selected"' : '', '>', $value, '</option>';
				}
				}		
				//echo'<textarea name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'" rows="" cols=""  />' .get_post_meta($post->ID, $meta_box['name'].'_'.$meta_box['meta_name'], true). '</textarea>';
				echo '</select>';		
		echo'</div></div></div>';
				}
					if( $meta_box['type'] == "textarea" )
				{
				echo'<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
				echo'<div class="box-info"><label for="'.$meta_box['name'].'_'.$meta_box['meta_name'].'">'.$meta_box['description'].'.</label></div>';				
				echo'<div class="box-option">';
				echo'<textarea name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'" rows="" cols=""  />' .get_post_meta($post->ID, $meta_box['name'].'_'.$meta_box['meta_name'], true). '</textarea>';
				echo'</div></div></div>';
				}
 
			if(($meta_box['type'] == 'radio') && (!empty($meta_box['options']))) { // radio buttons
					echo'<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
				echo'<div class="box-info"><label for="'.$meta_box['name'].'_'.$meta_box['meta_name'].'">'.$meta_box['description'].'.</label></div>';				
				echo'<div class="box-option">';
				foreach($meta_box['options'] as $key => $value) {
				echo '<input type="radio" name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'"  value="' . $key . '" ' . (isset($meta_box_value) && ($meta_box_value == $key) ? ' checked="checked"' : '') . '/> ' . $value . ' &nbsp; ' . "\n";
				}
				echo'</div></div></div>';
				
				}	

				if( $meta_box['type'] == "checkbox" )
				{
				$layout=get_post_meta($post->ID, $meta_box['name'].'_'.$meta_box['meta_name'], true);
				if( $layout == $meta_box['name'].'_'.$meta_box['meta_name'] ) { $checked = "checked=\"checked\""; }else{ $checked = ""; } 
				echo'<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
				echo'<div class="box-option">';
				echo'<label><input type="checkbox" name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'" value="'.$meta_box['name'].'_'.$meta_box['meta_name'].'"  '.$checked.' /> '.$meta_box['description'].'.</label></div>';
				echo'</div></div>';
				}

				}
		echo'</div>';
		}

function post_save_postdata($post_id) {
	global $post, $post_meta_boxes;
	foreach($post_meta_boxes as $meta_box) {
		// Verify
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
		}

		$data = $_POST[$meta_box['name'].'_'.$meta_box['meta_name']];
		if(get_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name']) == "")
			add_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], $data, true);
		elseif($data != get_post_meta($post_id, $pre.'_'.$meta_box['meta_name'], true))
			update_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], $data);
		elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], get_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], true));
	}
}
function post_meta_box() {
	global $themename;
	if ( function_exists('add_meta_box') ) {

	add_meta_box( 'new-meta-boxes', $themename.' Post Options', 'cusom_post_meta_box', 'post', 'normal', 'high' );


	}
}
add_action('admin_menu', 'post_meta_box');
add_action('save_post', 'post_save_postdata');
?>