<?php

require_once ( INC_PATH . '/page-builder/PageBuilder.php' );

/**********************************************************************
 * ln_show_metabox_options
 * - helper function outputs metabox options
 * @param - array of options to display
 **********************************************************************/
function ln_show_metabox_options($opt){
	
	global $post;
	$output = '';
	$val = '';
	$page_tempalte = get_post_meta($post->ID,'_wp_page_template',true);

	$output .='<div id="ln-meta-options-section" style="padding-top: 10px;">';
	
	wp_nonce_field( 'ln_nonce_save_action', 'ln_wpnonce', false, true );
	
	foreach ($opt as $value){
		
		
		// set field val
		if($value['type'] != 'heading'){
			
			if(get_post_meta($post->ID, $value['id'], true)){
				$val = 	get_post_meta($post->ID, $value['id'], true);
			}else{
				$val = $value['std'];
			}
		}
		
		switch ( $value['type'] ) {
				
				case "heading":
					
					$output .= '<div class="ln-meta-head-wrap"><span class="ln-meta-head">'.esc_attr($value['name']).'</span><span class="ln-portfolio-desc">'.esc_attr($value['desc']).'</span></div>';
					
					break;
					
				case "text":  
					
					$output .= '<div>';
					$output .= '<div class="ln-portfolio-desc">'.esc_attr($value['desc']).'</div>';
					$output .= '<input id="' . esc_attr( $value['id'] ) . '" class="'.$value['class'].'" name="' . esc_attr($value['id']) . '" type="text" value="' . esc_attr( $val ) . '" />';
					$output .= '</div>';
					
					break;

				case "text_small":  
					
					$output .= '<div>';
					$output .= '<div class="ln-portfolio-desc">'.esc_attr($value['desc']).'</div>';
					$output .= '<input style="width: 50px;" id="' . esc_attr( $value['id'] ) . '" class="'.$value['class'].'" name="' . esc_attr($value['id']) . '" type="text" value="' . esc_attr( $val ) . '" />';
					$output .= '</div>';
					
					break;
				
				case "textarea":
					  
					$output .= '<div>';
					$output .= '<div class="ln-portfolio-desc" style="float: left;">'.esc_attr($value['desc']).'</div>';
					$output .= '<textarea rows="5" cols="25" id="' . esc_attr( $value['id'] ) . '" class="'.$value['class'].'" name="' . esc_attr($value['id']) . '" >' . esc_attr( $val ) . '</textarea>';
					$output .= '<div class="ln-clear"></div></div>';
					
					break;
				
				case "image": 
					
					$output .= '<div class="ln-select-image">';
					$output .= '<div class="ln-portfolio-desc">'.esc_attr($value['desc']).'</div>';
					$output .= '<input id="'.esc_attr( $value['id'] ).'" class="'.$value['class'].'" name="' . esc_attr($value['id']) . '" type="text" value="' . esc_attr( $val ) . '" />';
					$output .= '<span id="image-'. esc_attr( $value['id'] ) .'" class="button upload ln-select-image-button">Upload Image</span>';
					$output .= '</div>';
					
					break;

				case "checkbox":
				
					$checked = '';
		
					$output .= '<div class="ln-checkboxes" style="margin: 20px 0 20px 0;">';
					
					if(isset($val)){
							
						if($val == 'on'){
							$checked = 'checked="checked"';
						}else{
							$checked = '';
						}
						
					}else if($value['default']=="true"){
						$checked = 'checked="checked"';
						
					}else{
						$checked = '';
					}

					
					$output .= '<div class="ln-portfolio-desc"> <label for="'.esc_attr($value['id']).'" style="font-size:12px;">'.esc_attr($value['desc']).'</label></div>
					<input type="checkbox" id="'.esc_attr( $value['id'] ).'"'.$checked.' name="'.esc_attr($value['id']).'" />';
					$output .= '</div><div class="ln-clear"></div>';
								
				break;

				case "color-picker":

					$custom_style = '';

					if(isset($value['style'])){
						$custom_style = $value['style'];
					}
					
					$output .= '<div class="ln-portfolio-desc" style="float: left; margin-bottom: 20px; padding-top: 5px; '.$custom_style.'"> 
									<label for="'.esc_attr($value['id']).'" style="font-size:12px;">'.esc_attr($value['desc']).'</label></div>';
					$output .='<div style="float: left; '.$custom_style.'"><div id="ln-color-box-'.esc_attr($value['id']).'" class="ln-color-picker-preview" style="background-color:#'.esc_attr( $val ).';"></div>';
					$output .= '<input data-color-box="ln-color-box-'.esc_attr($value['id']).'" type="text" maxlength="6" size="6" id="'.esc_attr($value['id']).'" name="'.esc_attr($value['id']).'" class="ln-color-picker-input" value="'.esc_attr( $val ).'">';
					$output .= '</div> <div class="ln-clear"></div>';

				break;

				case "select":

					$output .= '<div class="ln-portfolio-desc"><label for="'.esc_attr($value['id']).'" style="font-size:12px;">'.esc_attr($value['desc']).'</label></div>';
					$output .= '<select id="'.esc_attr($value['id']).'" name="'.esc_attr($value['id']).'" class="ln-page-builder-select" style="width: 170px;">';
					
					foreach ($value['options'] as $k => $v) {
						
						$selected='';							
				
						if($k == $val){
							$selected=' selected="selected"';
						}

						$output .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
						
					}

					$output .= '</select>';
					$output .= '<div class="ln-clear"></div>';

				break;

				case "category-select":

					$output .= '<div class="ln-portfolio-desc"><label for="'.esc_attr($value['id']).'" style="font-size:12px;">'.esc_attr($value['desc']).'</label></div>';
					$output .= '<select id="'.esc_attr($value['id']).'" name="'.esc_attr($value['id']).'" class="ln-page-builder-select" style="width: 170px;">';
					
					$output .= ln_get_select_categories_list($val);
					
					$output .= '</select>';
					$output .= '<div class="ln-clear"></div>';

				break;


		}
		
		$val = '';
		
	}
	
	$output .='</div>';
	
	return $output;
}

/*************************************************************
 * Save metabox data
 *************************************************************/
function ln_save_metabox_meta($post_id) {
    
	global $post;
	global $ln_post_formats_options;
	global $ln_sidebars_metabox_options;
	global $ln_page_style_options;
	global $ln_template_category_page_options;
	
	if(! isset($_POST['ln_wpnonce'])){
		return;
	}
	
	// verify 
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){ 
      	return;
	}
	
 	if ( !wp_verify_nonce( $_POST['ln_wpnonce'], 'ln_nonce_save_action') ){
      	return;
 	}


  	// Check permissions
  	if ( 'page' == $_POST['post_type'] ) {
    	if ( !current_user_can( 'edit_page', $post->ID ) )
        	return $post->ID;
  	}else{
    	
  		if ( !current_user_can( 'edit_post', $post->ID ) )
        	return $post->ID;
  	}

  	if($_POST['post_type'] == 'post'){
  		
  		////////////////////////////////////////
	  	// Save Post Formats Options
	  	////////////////////////////////////////
	  	ln_save_options_from_array( $ln_post_formats_options );

	  	////////////////////////////////////////
	  	// Save Sidebar Options
	  	////////////////////////////////////////
	  	ln_save_options_from_array( $ln_sidebars_metabox_options );

	  	////////////////////////////////////////
	  	// Save Style Options
	  	////////////////////////////////////////
	  	ln_save_options_from_array($ln_page_style_options);

  		////////////////////////////////////////
  		// Save  Review 
  		////////////////////////////////////////
  		if(isset($_POST['ln_post_review_select_criteria'])){

  			if(isset($_POST['ln_criteria_field_score'])){

	  			$fields_array = array();
	  			$sum = 0;
	  			$count = 0;


	  			foreach ($_POST['ln_criteria_field_score'] as $k => $field_value) {
	  				
	  				$field_key = $_POST['ln_criteria_field_key'][$k];
	  				
	  				$field_value = (float) $field_value; 

	  				if($field_value < 0){
	  					$field_value = 0;
	  				}

	  				if($field_value > 10){
	  					$field_value = 10;
	  				}

	  				$fields_array[$field_key] = $field_value; // associate key with value so if user reorder rating fields wont break score...
	  				$sum += $field_value;
	  				$count +=1;
	  			}

	  			$avrg = $sum / $count;

	  			if(isset($_POST['ln_review_meta_use_as_review'])){
	  				$show_score = $_POST['ln_review_meta_use_as_review'];
	  			}else{
	  				$show_score = 'off';
	  			}

	  			if( is_float($avrg) ){
	  				update_post_meta($post->ID, 'ln_review_meta_fileds_score', number_format($avrg, 1) );
	  			}else{
	  				update_post_meta($post->ID, 'ln_review_meta_fileds_score', $avrg);
	  			}
	  			update_post_meta($post->ID, 'ln_review_meta_fileds_values', $fields_array);
	  			update_post_meta($post->ID, 'ln_review_meta_use_as_review', $show_score);

	  			if($show_score == 'off'){
	  				// remove post score
  					delete_post_meta($post->ID, 'ln_review_meta_fileds_score');
	  			}

	  		}

	  		update_post_meta($post->ID, 'ln_review_meta_selected_criteria', $_POST['ln_post_review_select_criteria']);
			update_post_meta($post->ID, 'ln_review_meta_fileds_review_verdict', $_POST['ln-meta-review-verdict-text']);
  		
  		}

	} else if($_POST['post_type'] == 'page'){
		
		////////////////////////////////////////
	  	// Save Sidebar Options
	  	////////////////////////////////////////
	  	ln_save_options_from_array( $ln_sidebars_metabox_options );

	  	////////////////////////////////////////
	  	// Save Style Options
	  	////////////////////////////////////////
	  	ln_save_options_from_array( $ln_page_style_options );

	  	////////////////////////////////////////
	  	// Save Page template category select
	  	////////////////////////////////////////
	  	ln_save_options_from_array( $ln_template_category_page_options );

	  	////////////////////////////////////////
	  	// page builder
	  	////////////////////////////////////////
		
		PageBuilder::save_data($post->ID);

  	}
  	
}
add_action('save_post', 'ln_save_metabox_meta');



/*************************************************************
 * Save options for array - helper function 
 *************************************************************/
function ln_save_options_from_array($arr){

	global $post;
	
	foreach ($arr as $opt){
	  		
  		if(isset($_POST[$opt['id']])){
  			$data = stripslashes(htmlspecialchars( $_POST[$opt['id']] ));
  		}

  		if(isset($opt['id']) && $opt['type'] != 'heading'){
	  		if(isset($data)){
	  			update_post_meta($post->ID, $opt['id'], $data);
	  		}else{
	  			delete_post_meta($post->ID, $opt['id']);
	 		}
  		}
  	}

}

/*************************************************************
 * Get categories list for <select><option>...
 *
 * @param - (string) saved category name
 *************************************************************/
function ln_get_select_categories_list($selected_val){

	$output = '';
		
	// get categories
	$categories =  get_categories(); 
	
	if($selected_val == 'ln-recent-regular-posts'){
		$output .= '<option value="ln-recent-regular-posts" selected=selected> - Recent regular posts</option>'; // add recent posts option selected
	}else{
		$output .= '<option value="ln-recent-regular-posts"> - Recent regular posts</option>'; // add recent posts option
	}

	foreach ($categories as $category) {

			if($category->category_nicename == $selected_val){
				$output .= '<option selected=selected value="'.$category->category_nicename.'">';
			}else{
				$output .= '<option value="'.$category->category_nicename.'">';
			}
			
			$output .= $category->cat_name;
			$output .= '</option>';
	}

	return $output;
}

?>