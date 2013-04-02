<?php
$meta_slider_boxes =

	array(
		"radios" => array(
		"name" => "radio",  
		"title" => "URL (optional)", 
		"meta_name" => "coptions", 
		"description" => "Select the option for the url that the slider item linked to.",
		"type" => "radio",
		"class" => "radio",
		"std" =>"default",
		"options" => array("linkpage" => "Link to Page",
							"linktocategory" => "Link to Category", 
							"linktopost" => "Link to Post",
							"linkmanually" => "Link Manually",
							"default" => "default",
																
															)
			),
			"sidebar"=> array(
			'title' =>'Custom Sidebar',
			'name'	=> 'custom',
			'meta_name'	=> 'widget',
			"options1" =>  $sidebarwidget,
			'type'	=> 'customselect',
			'description'	=>'Select the Sidebar you want to associate with this page.',
		
		),
			);
			
		function custom_slider_boxes() {
	global $post, $meta_slider_boxes,$sidebarwidget;
	
	echo'<div class="postoptions">';
		foreach($meta_slider_boxes as $meta_box) {
			$meta_box_value = get_post_meta($post->ID,$meta_box['name'].'_'.$meta_box['meta_name'], true);
				if($meta_box_value == "")
					$meta_box_value = $meta_box['std'];
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
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
				if(($meta_box['type'] == 'radio') && (!empty($meta_box['options']))) { // radio buttons
					echo'<div class="metabox"><h3>'.$meta_box['title'].'</h3><div class="metainner">';
				echo'<div class="box-info"><label for="'.$meta_box['name'].'_'.$meta_box['meta_name'].'">'.$meta_box['description'].'.</label></div>';				
				echo'<div class="box-option">';
				foreach($meta_box['options'] as $key => $value) {
				echo '<input onclick="sys_custom_url_meta()" type="radio" name="'.$meta_box['name'].'_'.$meta_box['meta_name'].'"  value="' . $key . '" ' . (isset($meta_box_value) && ($meta_box_value == $key) ? ' checked="checked"' : '') . '/> ' . $value . ' &nbsp; ' . "\n";
				}
				echo'</div>';
					global $post;
	 $custom = get_post_custom($post->ID);
	$slider_c_page = $custom["slider_c_page"][0];
	$slider_c_cat = $custom["slider_c_cat"][0];
	$slider_c_post = $custom["slider_c_post"][0];
	$slider_c_manually = stripslashes($custom["slider_c_manually"][0]);

					echo'<div id="customurl">';
					echo'<div id="sys_link">';
					echo '<select name="slider_c_page">';
					echo '<option value="">Select Page</option>';
					foreach(get_custom_options('page') as $key => $option) {
						echo '<option value="' . $key . '"';
						if ($key == $slider_c_page) {
							echo ' selected="selected"';
						}
						echo '>' . $option . '</option>';
					}
					echo '</select>';	
					echo '</div>';
			
					echo'<div id="sys_category">';
					echo '<select name="slider_c_cat">';
					echo '<option value="">Select Category</option>';
					foreach(get_custom_options('cat') as $key => $option) {
						echo '<option value="' . $key . '"';
						if ( $key == $slider_c_cat) {
							echo ' selected="selected"';
						}
						echo '>' . $option . '</option>';
					}
					echo '</select>';	
					echo '</div>';
			
					echo'<div id="sys_post">';
					echo '<select name="slider_c_post">';
					echo '<option value="">Select Post</option>';
					foreach(get_custom_options('post') as $key => $option) {
						echo '<option value="' . $key . '"';
						if ($key == $slider_c_post) {
							echo ' selected="selected"';
						}
						echo '>' . $option . '</option>';
					}
					echo '</select>';	
					echo '</div>';
			
					echo'<div id="sys_manually">';
						echo'<input type="text" name="slider_c_manually" value="'.$slider_c_manually.'" size="50%" />';
					echo '</div></div></div></div>';
							}

			}
				
		echo'</div>';
		}
		
		function slider_meta_box() {
	global $themename;
	if ( function_exists('add_meta_box') ) {
	add_meta_box( 'new-meta-boxes', $themename.' Slide Options', 'custom_slider_boxes', 'slider', 'normal', 'high' );

	}
}
		
		function slider_save_postdata( $post_id ) {
	global $post,$meta_slider_boxes;
		foreach($meta_slider_boxes as $meta_box) {
		

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
if($_POST['slider_c_page']!="") {
			update_post_meta($post_id, "slider_c_page",$_POST['slider_c_page']);
		}if($_POST['slider_c_page'] == ""){
			delete_post_meta($post_id,"slider_c_page", get_post_meta($post_id,slider_c_page, true));
	}
	if( $_POST['slider_c_manually']!="") {
			update_post_meta($post_id, "slider_c_manually",$_POST['slider_c_manually']);
		}if($_POST['slider_c_manually'] == ""){
			delete_post_meta($post_id,"slider_c_manually", get_post_meta($post_id,slider_c_manually, true));
	}
	if( $_POST['slider_c_cat']!="") {
			update_post_meta($post_id, "slider_c_cat",$_POST['slider_c_cat']);
		}if($_POST['slider_c_cat'] == ""){
			delete_post_meta($post_id,"slider_c_cat", get_post_meta($post_id,slider_c_cat, true));
	}
	if( $_POST['slider_c_post']!="") {
			update_post_meta($post_id, "slider_c_post",$_POST['slider_c_post']);
		}if($_POST['slider_c_post'] == ""){
			delete_post_meta($post_id,"slider_c_post", get_post_meta($post_id,slider_c_post, true));
	}	
//$tst=$_POST['slider_c_page'];
	//update_post_meta($post_id, "slider_c_page",$tst);
  //update_post_meta($post_id, "slider_c_post", $_POST['slider_c_post']);
  //update_post_meta($post_id, "slider_c_cat", $_POST['slider_c_cat']);
  //update_post_meta($post_id, "slider_c_manually", $_POST['slider_c_manually']);
		$data = $_POST[$meta_box['name'].'_'.$meta_box['meta_name']];
		if(get_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name']) == "")
			add_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], $data, true);
		elseif($data != get_post_meta($post_id, $pre.'_'.$meta_box['meta_name'], true))
			update_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], $data);
		elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], get_post_meta($post_id, $meta_box['name'].'_'.$meta_box['meta_name'], true));
	}
}
add_action('admin_menu', 'slider_meta_box');
add_action('save_post', 'slider_save_postdata');
?>