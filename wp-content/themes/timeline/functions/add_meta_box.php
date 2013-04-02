<?php
/*
* Theme Name: Timeline Template
*
* Description: Timeline Template is a clean and minimal wordpress template, 
* intended to showcase your work, blog or interests in an unique modern way, 
* using the trendy timeline look.
*
* Version: 1.0 
*/
?>
<?php
// Add the Meta Box
function add_custom_meta_box() {
    add_meta_box(
		'custom_meta_box', // $id
		'Post Settings', // $title 
		'show_custom_meta_box', // $callback
		'post', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_custom_meta_box');

function add_custom_meta_box2() {
    add_meta_box(
		'custom_meta_box2', // $id
		'Page Settings', // $title 
		'show_custom_meta_box2', // $callback
		'page', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_custom_meta_box2');

// Field Array
$prefix = 'custom_';
$custom_meta_fields = array(
	array(
		'label'	=> ' Select content position',
		'desc'	=> '',
		'id'	=> $prefix.'select_row_position',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Left',
				'value'	=> 'left'
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'right'
			),
			'three' => array (
				'label' => 'Center',
				'value'	=> 'center'
			)
		)
	),
	array(
		'label'	=> ' Show or hide title',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_title',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide category and comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_category',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide social icons',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_soc',
		'type'	=> 'select_soc_show',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
			
		)
	),
	array(
		'label'	=> 'Select immage style',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_style',
		'type'	=> 'select_img_position',
		'options' => array (
			'one' => array (
				'label' => 'Default',
				'value'	=> 'default'
				
			),
			'two' => array (
				'label' => 'Square',
				'value'	=> 'square'
			),
			'three' => array (
				'label' => 'Circle',
				'value'	=> 'circle'
			)
		)
	),
	array(
		'label'	=> 'Select immage position',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_position',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Indside',
				'value'	=> 'inside'
				
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'right'
			),
			'three' => array (
				'label' => 'Left',
				'value'	=> 'left'
			)
		)
	),
	array(
		'label'	=> 'Select immage size',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_size',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Big',
				'value'	=> 'big'
				
			),
			'two' => array (
				'label' => 'Medium',
				'value'	=> 'medium'
			),
			'three' => array (
				'label' => 'Small',
				'value'	=> 'small'
			)
		)
	),
	array(
		'label'	=> 'Select immage badge',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_badge',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Select badge',
				'value'	=> 'non'
				
			),
			'two' => array (
				'label' => 'Hot',
				'value'	=> 'hot'
			),
			'three' => array (
				'label' => 'New',
				'value'	=> 'new'
			)
		)
	),
	
	array(
		'label'	=> 'Add immage title',
		'desc'	=> '* if you add title you will swich to <br>"immage content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_title',
		'type'	=> 'img_title'
	),

	array(
		'label'	=> 'Add Image content',
		'desc'	=> '* if you add content you will swich to "immage content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_content',
		'type'	=> 'img_content'
	),
	array(
		'label'	=> 'Add button link',
		'desc'	=> '',
		'id'	=> $prefix.'img_link',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add immage button title',
		'desc'	=> '<br /> <div style="min-width:100%; border-bottom: 1px solid #ddd;"></div>',
		'id'	=> $prefix.'img_buttontitle',
		'type'	=> 'img_buttontitle'
	),
	array(
		'label'	=> 'Repeatable',
		'desc'	=> '',
		'id'	=> $prefix.'repeatable',
		'type'	=> 'repeatable'
	)
	
);

$custom_meta_fields2 = array(
	
	array(
		'label'	=> ' Select content position',
		'desc'	=> '',
		'id'	=> $prefix.'select_row_position',
		'type'	=> 'select_row_position',
		'options' => array (
			'one' => array (
				'label' => 'Center',
				'value'	=> 'center'
			)
		)
	),
	array(
		'label'	=> ' Show or hide title',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_title',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide category and comments',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_category',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
		)
	),
	array(
		'label'	=> ' Show or hide social icons',
		'desc'	=> '',
		'id'	=> $prefix.'select_show_soc',
		'type'	=> 'select_soc_show',
		'options' => array (
			'one' => array (
				'label' => 'Show',
				'value'	=> 'show'
			),
			'two' => array (
				'label' => 'Hide',
				'value'	=> 'hide'
			)
			
		)
	),
	array(
		'label'	=> 'Select immage style',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_style',
		'type'	=> 'select_img_position',
		'options' => array (
			'one' => array (
				'label' => 'Default',
				'value'	=> 'default'
				
			),
			'two' => array (
				'label' => 'Square',
				'value'	=> 'square'
			),
			'three' => array (
				'label' => 'Circle',
				'value'	=> 'circle'
			)
		)
	),
	array(
		'label'	=> 'Select immage position',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_position',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Indside',
				'value'	=> 'inside'
				
			),
			'two' => array (
				'label' => 'Right',
				'value'	=> 'right'
			),
			'three' => array (
				'label' => 'Left',
				'value'	=> 'left'
			)
		)
	),
	array(
		'label'	=> 'Select immage size',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_size',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Big',
				'value'	=> 'big'
				
			),
			'two' => array (
				'label' => 'Medium',
				'value'	=> 'medium'
			),
			'three' => array (
				'label' => 'Small',
				'value'	=> 'small'
			)
		)
	),
	array(
		'label'	=> 'Select immage badge',
		'desc'	=> '',
		'id'	=> $prefix.'select_img_badge',
		'type'	=> 'select_img_size',
		'options' => array (
			'one' => array (
				'label' => 'Select badge',
				'value'	=> ''
				
			),
			'two' => array (
				'label' => 'Hot',
				'value'	=> 'hot'
			),
			'three' => array (
				'label' => 'New',
				'value'	=> 'new'
			)
		)
	),
	
	array(
		'label'	=> 'Add immage title',
		'desc'	=> '* if you add title you will swich to <br>"immage content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_title',
		'type'	=> 'img_title'
	),

	array(
		'label'	=> 'Add Image content',
		'desc'	=> '* if you add content you will swich to "immage content mode"  ( disable full size link ) ',
		'id'	=> $prefix.'img_content',
		'type'	=> 'img_content'
	),
	array(
		'label'	=> 'Add button link',
		'desc'	=> '',
		'id'	=> $prefix.'img_link',
		'type'	=> 'img_title'
	),
	array(
		'label'	=> 'Add immage button title',
		'desc'	=> '<br /> <div style="min-width:100%; border-bottom: 1px solid #ddd;"></div>',
		'id'	=> $prefix.'img_buttontitle',
		'type'	=> 'img_buttontitle'
	),
	array(
		'label'	=> 'Repeatable',
		'desc'	=> '',
		'id'	=> $prefix.'repeatable',
		'type'	=> 'repeatable'
	)
	
);

// enqueue scripts and styles, but only if is_admin


// add some custom js to the head of the page
add_action('admin_head','add_custom_scripts');
function add_custom_scripts() {
	global $custom_meta_fields, $post;
	
	$output = '<script type="text/javascript">
				jQuery(function() {';
	
	foreach ($custom_meta_fields as $field) { // loop through the fields looking for certain types
		// date
		if($field['type'] == 'date')
			$output .= 'jQuery(".datepicker").datepicker();';
		// slider
		if ($field['type'] == 'slider') {
			$value = get_post_meta($post->ID, $field['id'], true);
			if ($value == '') $value = $field['min'];
			$output .= '
					jQuery( "#'.$field['id'].'-slider" ).slider({
						value: '.$value.',
						min: '.$field['min'].',
						max: '.$field['max'].',
						step: '.$field['step'].',
						slide: function( event, ui ) {
							jQuery( "#'.$field['id'].'" ).val( ui.value );
						}
					});';
		}
	}
	
	$output .= '});
		</script>';
		
	echo $output;
}

// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		// <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
		echo '<tr>
				
				<td>';
				switch($field['type']) {
					
					case 'select_row_position':
						echo '<h2 style="margin-top:0px;">Content Settings</h2><select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span></div>';
					break;
					case 'select_soc_show':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span><br /> <div style="min-width:100%; border-bottom: 1px solid #ddd;"></div>';
					break;
					
					case 'select_img_position':
						echo '<h2 style="margin-top:0px;">Immage Settings</h2><select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'select_img_size':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					
					
					
					
					// text
					case 'img_title':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'img_buttontitle':
						if($meta == ''){
							$meta = 'Read More';
						};
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
			
					// textarea
					case 'img_content':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<label style="margin-left:10px; margin-top:2px; position:absolute; " for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					// checkbox
					
					// image
					case 'image':
					
					
						$image = get_template_directory_uri().'/images/image.png';	
						echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
						echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
										<br clear="all" /><span class="description">'.$field['desc'].'</span>';
					break;
					
					
					// repeatable
					case 'repeatable':
						echo '<a class="repeatable-add button" href="#">+</a>
							  <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) { 
							foreach($meta as $row) { $image = wp_get_attachment_image_src($row, 'medium');	$image = $image[0];
							echo '<li><span class="sort hndle"></span><input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
							<a class="repeatable-remove button" href="#">-</a></li>';
							$i++;
							}
						} else { 
							$image = wp_get_attachment_image_src($row, 'medium');	
							$image = $image[0];
							echo '<li><span class="sort hndle"></span>
							<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
							<a class="repeatable-remove button" href="#">-</a></li>';
						}
						echo '</ul><span class="description">'.$field['desc'].'</span>';
					break;
 					//end switch
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}
function show_custom_meta_box2() {
	global $custom_meta_fields2, $post;
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	echo '<table class="form-table">';
	foreach ($custom_meta_fields2 as $field) {
		$meta = get_post_meta($post->ID, $field['id'], true);
		echo '<tr>
				<td>';
				switch($field['type']) {
					
					case 'select_row_position':
						echo '<h2 style="margin-top:0px;">Content Settings</h2><select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span></div>';
					break;
					case 'select_page_template':
						echo '<h2 style="margin-top:0px;">Page Template</h2><select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span></div>';
					break;
					
					case 'select_soc_show':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option ', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select> <label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span><br /> <div style="min-width:100%; border-bottom: 1px solid #ddd;"></div>';
					break;
					
					case 'select_img_position':
						echo '<h2 style="margin-top:0px;">Immage Settings</h2><select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'select_img_size':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					
					
					
					
					
					// text
					case 'img_title':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					case 'img_buttontitle':
						if($meta == ''){
							$meta = 'Read More';
						};
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<label style="margin-left:10px;" for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
			
					// textarea
					case 'img_content':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
								<label style="margin-left:10px; margin-top:2px; position:absolute; " for="'.$field['id'].'">'.$field['label'].'</label><br /><span class="description">'.$field['desc'].'</span>';
					break;
					// repeatable
					case 'repeatable':
						echo '<a class="repeatable-add button" href="#">+</a>
							  <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) { 
							foreach($meta as $row) { $image = wp_get_attachment_image_src($row, 'medium');	$image = $image[0];
							echo '<li><span class="sort hndle"></span><input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$row.'" />
							<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
							<a class="repeatable-remove button" href="#">-</a></li>';
							$i++;
							}
						} else { 
							$image = wp_get_attachment_image_src(isset($row), 'medium');	
							$image = $image[0];
							echo '<li><span class="sort hndle"></span>
							<input name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.isset($row).'" />
							<img src="'.$image.'" style="width:150px; height:auto;" class="custom_preview_image" alt="" /><br>
							<input class="custom_upload_image_button button" type="button" value="Choose Image" />
							<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
							<a class="repeatable-remove button" href="#">-</a></li>';
						}
						echo '</ul><span class="description">'.$field['desc'].'</span><br /> <div style="min-width:100%; border-bottom: 1px solid #ddd;"></div>';
					break;
					
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}


function remove_taxonomy_boxes() {
	//remove_meta_box('categorydiv', 'post', 'side');
}
add_action( 'admin_menu' , 'remove_taxonomy_boxes' );

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields;
	global $custom_meta_fields2;
	// verify nonce
	
	if (!wp_verify_nonce(isset($_POST['custom_meta_box_nonce']), basename(__FILE__))){
		return $post_id;
	}
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	
	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		if($field['type'] == 'tax_select') continue;
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // enf foreach
	
	foreach ($custom_meta_fields2 as $field) {
		if($field['type'] == 'tax_select') continue;
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // enf foreach
	
	// save taxonomies
	$post = get_post($post_id);
	//$category = $_POST['category'];
	//wp_set_object_terms( $post_id, $category, 'category' );
}
add_action('save_post', 'save_custom_meta');

?>