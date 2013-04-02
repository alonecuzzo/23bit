<?php

/*************************************************************
 * 
 * Sliders template hooks, filters and  metaboxes... 
 *
 *************************************************************/

/*************************************************************
 * Register custom post type Sliders
 *************************************************************/
function ln_add_sliders_post_type() {  
	
	$labels = array(
		'name' => __( 'Sliders','framework'),
		'singular_name' => __( 'Sliders','framework' ),
		'add_new' => __('Add New','framework'),
		'add_new_item' => __('Add New Slider','framework'),
		'edit_item' => __('Edit Slider','framework'),
		'new_item' => __('New Slider','framework'),
		'view_item' => __('View Slider','framework'),
		'search_items' => __('Search Sliders','framework'),
		'not_found' =>  __('No Sliders found','framework'),
		'not_found_in_trash' => __('No Sliders found in Trash','framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $arr = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
	  	'supports' => array('title', 'thumbnail'),
	  	'menu_icon' => get_template_directory_uri().'/framework/admin/images/post-type-icon.png'
	  );
	
    register_post_type( __('sliders','framework'), $arr);  
}  
add_action('init', 'ln_add_sliders_post_type');  

/*************************************************************
 * Add Sliders metabox
 *************************************************************/
function ln_add_sliders_post_metabox(){
	
	add_meta_box('ln-page-meta-sliders', __('Slider Options', 'framework'), 'ln_sliders_metabox_iu', 'sliders', 'normal', 'high');
	
}
add_action('add_meta_boxes', 'ln_add_sliders_post_metabox');

/*************************************************************
 * Sliders metabox UI
 *************************************************************/
function ln_sliders_metabox_iu(){
	
	// try to get post attachments 
	// show post attachments
	// add button to upload media

	// get attachments
	$args = array(
		'orderby'		 => 'menu_order',
		'post_type'      => 'attachment',
		'post_parent'    => get_the_ID(),
		'post_mime_type' => 'image',
		'post_status'    => null,
		'numberposts'    => -1,
	);

	$attachments = get_posts($args);

	if(!empty($attachments)):
		// show thumbnails
	?>
		<div id="ln-sliders-thumbs" style="margin-top:20px">
			<ul>

				<?php

					foreach($attachments as $att){
		
						$small_src = wp_get_attachment_image_src($att->ID, 'small-crop', true);
						echo '<li><img src="'.$small_src[0].'" /></li>';	
					} 

				?>

			</ul>
			<div class="ln-clear"></div>
		</div>
	
	<?php else: ?>

		<div id="ln-sliders-thumbs">
			<h2><?php _e('No slides found.', 'framework');?></h2>
		</div>

	<?php endif; ?>

	<div class="ln-action-button-wrap">
		<a class="ln-options-action-buttton" id="ln-post-sliders-upload-slides" href="#"><?php _e('Upload Slides' ,'framework'); ?></a>
		<?php if(!empty($attachments)): ?>
		<a class="ln-options-action-buttton" id="ln-post-sliders-edit-slides" href="#"><?php _e('Edit Slides', 'framework'); ?></a>
		<?php endif; ?>
	</div>
	
	<?php
}

/*************************************************************
 * Add custom fields to attachments page
 *************************************************************/
function ln_attachment_fields_edit($form_fields, $post) {
	
	// Slide Title
	$form_fields['ln_media_slider_title'] = array(
		'label' => __( 'Slide Title: ', 'framework' ),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'ln_media_slider_slide_title', true ),
		'helps' => __( 'Enter slide title', 'framework' )
	);

	// Slide Caption
	$form_fields['ln_media_slider_caption'] = array(
		'label' => __( 'Slide Caption: ', 'framework' ),
		'input' => 'textarea',
		'value' => get_post_meta( $post->ID, 'ln_media_slider_slide_caption', true ),
		'helps' => __( 'Enter slide caption', 'framework' )
	);

	// Slide Link
	$form_fields['ln_media_slider_link_url'] = array(
		'label' => __( 'Slide link URL: ', 'framework' ),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'ln_media_slider_slide_link', true ),
		'helps' => __( 'Enter slide link URL', 'framework' )
	);

	return $form_fields;
}

/*************************************************************
 * Save attachments custom fields
 *************************************************************/
function ln_attachment_fields_save($post, $attachment) {
	
	if ( isset($attachment['ln_media_slider_title']) ){
		update_post_meta($post['ID'], 'ln_media_slider_slide_title', $attachment['ln_media_slider_title']);
	}
	
	if ( isset($attachment['ln_media_slider_caption']) ){
		update_post_meta($post['ID'], 'ln_media_slider_slide_caption', $attachment['ln_media_slider_caption']);
	}

	if ( isset($attachment['ln_media_slider_link_url']) ){
		update_post_meta($post['ID'], 'ln_media_slider_slide_link', $attachment['ln_media_slider_link_url']);
	}

	return $post;
 }

add_filter( 'attachment_fields_to_edit', 'ln_attachment_fields_edit', 10, 2);
add_filter( 'attachment_fields_to_save', 'ln_attachment_fields_save', 10, 2);


?>