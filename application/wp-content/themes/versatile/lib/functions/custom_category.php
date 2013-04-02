<?php
function myplugin_add_custom_box() {

	  if( function_exists( 'add_meta_box' )) {
	add_meta_box( 'metabox', __( 'Choose Categories', 'myplugin_textdomain' ),  'myplugin_syspage_custom_box', 'page', 'side', 'high');
	  } else {
	
 add_action('dbx_page_advanced', 'myplugin_old_syspage_custom_box' );
	 }
	  
	}
	

function myplugin_syspage_custom_box() {
	global $post;

	echo '<input type="hidden" name="sys_noncename" id="sys_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<label for="myplugin_new_field">' . __("Choose categories you want to assign", 'myplugin_textdomain' ) . '</label>';
	$current_value =  get_post_meta($post->ID, "sys32_cats", true);
	list_categories("page_id",$current_value);
}
	
function myplugin_inner_custom_box() {
	global $post;
}


function myplugin_save_postdata( $post_id ) {
		$sys32_all_cats=$_POST['sys32_cats'];
	while (list ($key,$val) = @each ($sys32_all_cats)) {
		$sys32_category_final .=$val .",";

} 
if($_POST['sys32_cats']!="")
{
delete_post_meta($post_id, "sys32_cats");
}

	if ( !wp_verify_nonce( $_POST['sys_noncename'], plugin_basename(__FILE__) )) {
    	return $post_id;
  	}

  	if ( defined('SYSSAVE') && SYSSAVE ) 
    	return $post_id;
	
	if ( 'page' == $_POST['post_type'] ) {
    	if ( !current_user_can( 'edit_page', $post_id ) )
    		
     		 return $post_id;
  	} else {
    	if ( !current_user_can( 'edit_post', $post_id ) )
      		return $post_id;
  	}
	
	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	if (!get_post_meta($post_id,"sys32_cats")) {
	
		add_post_meta($post_id, "sys32_cats",$sys32_category_final);
  	}else{
  		
  	update_option($post_id,"sys32_cats",$sys32_category_final);
  	}
	if ($_POST["sys32_cats"] == "") {
		  delete_post_meta($post_id, "sys32_cats");
	}

}


 function list_categories($name, $sys32_value)
       { 
       	   

	   
               $categories = get_categories("title_li=&orderby=name");
               foreach ($categories as $category)
               { $checked = ""; 
               
				if ($sys32_value) { 
					$sys32_explode = explode(',',$sys32_value); // 
						foreach ($sys32_explode as $sys32_explodes){
					
			if ($category->term_id == $sys32_explodes){ $checked = "checked=\"checked\"";
				}	 else {  }}} 
               	  
               	?>

<p>
  <input type="checkbox" name="sys32_cats[]"id="<?php echo $category->term_id;?>" value="<?php echo $category->term_id;?>" <?php echo $checked; ?> />
  <?php echo $category->name;?> </p>
<?php
               }
       }
       add_action('admin_menu', 'myplugin_add_custom_box');
	add_action('save_post', 'myplugin_save_postdata');
	?>