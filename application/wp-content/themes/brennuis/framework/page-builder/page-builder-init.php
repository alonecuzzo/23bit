<?php 

require_once ( INC_PATH . '/page-builder/PageBuilder.php' );

/**********************************************************************
 * ln_add_page_builder_metabox
 **********************************************************************/
function ln_add_page_builder_metabox(){
	
	// chek if page tempalte is template-magazine.php
	global $post;
	$template = get_post_meta( $post->ID, '_wp_page_template', true );

	if($template == "template-magazine.php"){
		add_meta_box('ln-page-builder-meta', __('Page Builder', 'framework'), 'ln_page_builder_meta_iu', 'page', 'normal', 'high');
	}

}
add_action('add_meta_boxes', 'ln_add_page_builder_metabox');

/*************************************************************
 * Page builder metabox user interface
 *************************************************************/
function ln_page_builder_meta_iu(){
	
	global $post;
	
	$ar = get_post_meta($post->ID, PageBuilder::PAGE_BUILDER_META_ID, true);
	$layout = new PageBuilder($ar, $post->ID);

	wp_nonce_field( 'ln_nonce_save_action', 'ln_wpnonce', false, true );
?>	
	<div id="ln-page-builder-wrap">
		<div id="ln-page-builder-content">
			<div id="ln-edit-module-page">
				<div id="ln-edit-page-content">
					<header>
						<h4><?php _e('Edit module settings', 'framework'); ?></h4>
						<span id="ln-edit-module-close-button"></span>
						<div class="ln-clear"></div>
					</header>
					
					<div class="ln-module-edit-inner">
						
						<!-- Title -->	
						<div id="ln-page-builder-edit-title" class="ln-page-builder-edit-section">
							<span><?php _e('Title:', 'framework'); ?></span>
							<input type="text" id="ln-page-builder-edit-module-new-title" name="edit_module_title" class="ln-input" value=""/>
						</div>
						
						<!-- Number of items -->
						<div id="ln-page-builder-edit-number" class="ln-page-builder-edit-section">
							<span><?php _e('Number of posts:', 'framework'); ?></span>
							<input type="text" id="ln-page-builder-edit-module-new-number" name="edit_module_cat" class="ln-input ln-small-input" value="4"/>
						</div>
						
						<!-- Posts Category -->
						<div id="ln-page-builder-edit-category" class="ln-page-builder-edit-section">
							<span><?php _e('Choose category:', 'framework'); ?></span>
							<select id="ln-page-builder-edit-select-category" class="ln-page-builder-select">
								<?php echo PageBuilder::getBlogCategoriesList(); ?>
							</select>
						</div>

						<!-- Slider Type -->
						<div id="ln-page-builder-edit-slider-type" class="ln-page-builder-edit-section">
							<span><?php _e('Slider Type:', 'framework'); ?></span>
							<select id="ln-page-builder-edit-slider-type-select" class="ln-page-builder-select">
								<option value="blog-posts"><?php _e('Blog Posts', 'framework'); ?></option>
								<option value="custom-slider"><?php _e('Custom', 'framework'); ?></option>
							</select>
						</div>

						<!-- Slider Blog Category -->
						<div id="ln-page-builder-edit-slider-blog-category" class="ln-page-builder-edit-section">
							<span><?php _e('Choose Category:', 'framework'); ?></span>
							<select id="ln-page-builder-edit-slider-select-blog-category" class="ln-page-builder-select">
								<?php echo PageBuilder::getBlogCategoriesList(); ?>
							</select>
						</div>

						<!-- Slider Post Category -->
						<div id="ln-page-builder-edit-slider-category" class="ln-page-builder-edit-section">
							<span><?php _e('Choose Slider:', 'framework'); ?></span>
							<select id="ln-page-builder-edit-slider-select-category" class="ln-page-builder-select">
								<?php echo PageBuilder::getSliderPostsList(); ?>
							</select>
						</div>

						<!-- Text -->
						<div id="ln-page-builder-edit-text" class="ln-page-builder-edit-section">
							<span><?php _e('Text type:', 'framework'); ?></span>
							<select id="ln-page-builder-edit-select-text-type" class="ln-page-builder-select">
								<option value="custom"><?php _e('Custom text', 'framework'); ?></option>
								<option value="page-content"><?php _e('Page content', 'framework'); ?></option>
							</select>
							<div id="ln-page-builder-edit-enable-custom-text">
								<div style="margin-bottom: 10px;"><span><?php _e('Custom text:', 'framework'); ?></span></div>
								<textarea cols="78" rows="10" id="ln-page-builder-edit-custom-text" class="ln-input" style="width: 100%;"></textarea>
							</div>
						</div>

						<!-- Video Embed -->
						<div id="ln-page-builder-edit-video" class="ln-page-builder-edit-section">
							<div style="margin-bottom: 10px;"><span><?php _e('Video embed code:', 'framework'); ?></span></div>
							<textarea cols="78" rows="10" id="ln-page-builder-edit-video-embed" class="ln-input" style="width: 100%;"></textarea>
						</div>

						<!-- Section title link option -->
						<div id="ln-page-builder-edit-more-link" class="ln-page-builder-edit-section">
							<div style="margin-bottom: 10px;"><span><?php _e('Section title link navigates to:', 'framework'); ?></span></div>
							<select id="ln-page-builder-edit-select-more-link" class="ln-page-builder-select">
								<option data-type="0" value="0" selected=selected><?php _e('Category page', 'framework'); ?></option>
								<option data-type="1" value="1"><?php _e('Custom link', 'framework'); ?></option>
								<optgroup label="Page">
									<?php echo PageBuilder::getAvailablePages(); ?>
								</optgroup>
							</select>
							<span id="ln-more-link-wrap" style="display:none; "><label style="margin-left: 10px;" for="ln-more-link-custom"><?php _e('Custom link:', 'framework'); ?></label><input type="text" id="ln-more-link-custom" value="" style="margin-left: 10px; padding: 10px 7px;"/></span>
						</div> 

					</div>

					<footer>
						<button id="ln-edit-module-save-button" class="ln-page-builder-action-btn" style="float:right;"><?php _e('Save Changes', 'framework'); ?></button>
					</footer>
					<div class="ln-clear"></div>
				</div>
			</div>
			
			<h4><?php _e('Add module:', 'framework'); ?></h4>
			<div>
				<select id="ln-page-buidler-module-select" class="ln-page-builder-select">
					<option value="select" disabled=disabled selected=selected><?php _e('Select module', 'framework'); ?></option>
					<option value="posts"><?php _e('Posts', 'framework'); ?></option>
					<option value="posts_column"><?php _e('Posts Column', 'framework'); ?></option>
					<option value="posts_carousel"><?php _e('Carousel', 'framework'); ?></option>
					<option value="slider"><?php _e('Slider', 'framework'); ?></option>
					<option value="text_full"><?php _e('Text', 'framework'); ?></option>
					<option value="text_column"><?php _e('Text Column', 'framework'); ?></option>
					<option value="video_full"><?php _e('Video', 'framework'); ?></option>
					<option value="video_column"><?php _e('Video Column', 'framework'); ?></option>
				</select>
				<button id="ln-add-module-button" class="ln-page-builder-action-btn"><?php _e('Add module', 'framework'); ?></button>
			</div>

			<ul id="ln-page-builder-structure">
				<?php echo $layout->output_admin_view(); ?>
			</ul>
			<div class="ln-clear" style="margin-bottom: 25px;"></div>

			
		</div>
	</div>

<?php
	
}// end ln_page_builder_meta_iu

?>