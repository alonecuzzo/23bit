<?php

require_once ('CustomCSSTheme.php');
require_once ('custom-color-theme-options.php');
require_once ('theme-options.php');
require_once ('optionsView.php');


/**********************************************************
 * Build admin interface
 *********************************************************/

/**
 * adds options
 **/
function ln_theme_menu() {
	
	// add options page
	add_theme_page('Theme Options', 'Theme Options', 'manage_options', 'ln-theme-options', 'ln_theme_options_page');
	
	// add sidebars options page
	add_theme_page('Review Criteria', 'Review Criteria', 'manage_options', 'ln-review-rating-criteria-page', 'ln_theme_rating_criteria_page');

	// add sidebars options page
	add_theme_page('Sidebars', 'Sidebars', 'manage_options', 'ln-theme-sidebars-page', 'ln_theme_sidebars_page');
	
	// add options
	if(! get_option('ln_options')){
		
		update_option('ln_options',ln_theme_options());
		ln_reset_options(ln_theme_options());
	}
	
	
	// save options
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'ln-theme-options' ) {
		
		if (isset($_POST['save_submit']) && $_POST['action'] == 'lion_framework') {
			
			ln_save_options(ln_theme_options());
			wp_redirect("admin.php?page=ln-theme-options&save=true");
			die;
		}
    }
    
	// reset options
	if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'ln-theme-options' ) {
		
		if (isset($_POST['reset_submit']) && $_POST['action'] == 'lion_framework') {
			
			ln_reset_options(ln_theme_options());
			wp_redirect("admin.php?page=ln-theme-options&reset=true");
			die;
		}
    }
    
    
	// load scripts and stylesheets
	add_action("admin_init", 'ln_admin_scripts');
	add_action("admin_init",'ln_admin_styles');
	add_action("admin_head",'ln_admin_options_fonts');
}
add_action('admin_menu', 'ln_theme_menu');


/**
 * ln_save_options
 * - save options
 **/
function ln_save_options($opt){
	
	$custom_theme_styling = new CustomCSSTheme();

	$id;
	$type;
	$new="";

	foreach ($opt as $value) {

		$id = $value['id'];
		$type = $value['type'];
		
		if(isset($_POST[$value['id']])){
			$new = $_POST[$value['id']];
		}
		
		if( isset($id) && (substr($id,0, 2)) == SHORT_NAME){ // no headings

			if($type == "checkbox" && isset($_POST[$value['id']])){
				$new = "true";
			}else if($type == "checkbox"){
				$new = "false ";
			}else if($type == "color_picker"){
				$new = $_POST[$value['id']];
			}

			if($new == "" && isset($opt['std'])){ $new = $opt['std']; }
			
			// styling ////////////////
			
			if(! $custom_theme_styling->is_selector_closed() && isset($value['property'])){ // if selector is not closed add properties to it
				
				if(isset($value['is_rgb']) && $value['is_rgb'] == true){
					$custom_theme_styling->add_property($value['property'], stripslashes($new), $value['property_end'], true); // convert hex color to rgb
				}else{
					$custom_theme_styling->add_property($value['property'], stripslashes($new), $value['property_end']);
				}
			}

			if($type == "styling_selector"){ 
				$custom_theme_styling->add_selector( $value['selector'] );
			}

			///////////////////////////

			// save
			update_option($id,stripslashes($new));
			
		}
	}

	// save custom CSS style
	update_option('ln_custom_color_theme_css', $custom_theme_styling->get_generated_CSS());

	// save it as CSS file to /css/custom-theme/
	$custom_color_theme_file = get_stylesheet_directory().'/css/custom-theme/theme.css';
	$new_css_file = @fopen($custom_color_theme_file, 'w');
 	
 	@fwrite($new_css_file, $custom_theme_styling->get_generated_CSS());  
	@fclose($new_css_file); 
	
}

/**
 * ln_reset_options
 * - reset options
 **/
function ln_reset_options($opt){

	$id;
	$type;
	$new='';
	
	foreach ($opt as $value) {

		$id = $value['id'];
		$type = $value['type'];
		
		if( isset($id) && (substr($id,0, 2)) == SHORT_NAME){ // no headings
			
			$new = $value['std'];
			
			if($type=="checkbox" || $type=="radio"){
				$new = $value['default'];	
			}
			
			if($type=="select"){
				$new = $value['std'];
			}
			
			update_option($id, stripslashes($new));
		}
	}
	
}

/**
 * ln_admin_scripts
 * - loads admin scripts
 **/
function ln_admin_scripts(){
		
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	// easing 
	wp_enqueue_script('ln-admin-jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js');
	// colorpicker js
	wp_enqueue_script('ln-admin-jquery-color-picker', INC_URI.'/admin/js/colorpicker.js');

	// admin scripts
	wp_enqueue_script('ln-admin-ajaxupload', INC_URI.'/admin/js/ajaxupload.js');
	wp_enqueue_script('ln-admin-jquery-custom', INC_URI.'/admin/js/jquery.admin.js');
	
	// page buidler js
	wp_enqueue_script('ln-admin-jquery-page-builder', INC_URI.'/admin/js/jquery.page.builder.js');

}

/**
 * ln_admin_styles
 * - loads admin stylesheets
 **/
function ln_admin_styles(){
	
	wp_enqueue_style('ln-admin-style', INC_URI.'/admin/css/admin-style.css');
	wp_enqueue_style('ln-admin--color-picker-style', INC_URI.'/admin/css/colorpicker.css');
}

/**
 * ln_admin_options_fonts
 * - loads theme options fonts
 **/
function ln_admin_options_fonts(){

	$heading_font = get_option('ln_theme_heading_font');
	$content_font = get_option('ln_theme_content_font');

	if(!empty($heading_font) && $heading_font != ''){
		echo '<link id="ln-options-fonts-heading" href="http://'.$heading_font.'" rel="stylesheet">';
	}

	if(!empty($content_font) && $content_font != ''){
		echo '<link id="ln-options-fonts-content" href="http://'.$content_font.'" rel="stylesheet">';
	}
}

/**
 * Display options page
 **/
function ln_theme_options_page() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'framework') );
	}
	
?>
	<form method="post" id="lion_options_form" class="lion_options_form">
		<input type="hidden" name="action" id="action" value="lion_framework" />
		<div class="wrap" id="ln-wrap-admin">
			<?php 
				// show notes
				if(isset($_REQUEST['save']) && $_REQUEST['save'] == "true"){
				   	echo "<span class='ln-note'>All options saved !</span>";
				   	
				}
				
				if(isset($_REQUEST['reset']) && $_REQUEST['reset'] == "true"){
				   	echo "<span class='ln-note'>Options are set to default !</span>";
				   	
				}
			?>
			<div id="ln-header">
				<h2><?php echo THEME_NAME; ?></h2>
				<span>Theme Options v.<?php echo THEME_VERSION; ?></span>
				
			</div>
			<div class="line"></div>
			<div id="ln-content">
			<?php
				
				// generate options view (menu and options) 
				$view = new optionsView(ln_theme_options());
				$content = $view->generate_options_view();
			?>
				<div id="ln-menu">
					<ul>
						<?php echo $content[0]; ?>
					</ul>
				</div>
				<div id="ln-options">
					<?php echo $content[1]; ?>
				</div>
			
			</div>
			<div class="ln-clear"></div>
			</div>
			<div id="ln-footer">
				
				<span class="ln-reset"><input type="submit" class="button ln-reset-button" id="reset_submit" name="reset_submit" value="Reset Options" onclick="return confirm('All options will be set to default!');"/></span>
				<span class="ln-save"><input type="submit" class="button-primary ln-save-button" id="save_submit" name="save_submit" value="Save changes" /></span>
				<div class="ln-clear"></div>	
			</div>
			
	</form>

	<div style="display: none;"><textarea id="ln-custom-theme-generated-css-holder" cols="2" rows="2"><?php echo get_option('ln_custom_color_theme_css'); ?></textarea></div>

<?php 	
	
}


/**
 * Ajax image upload 
 **/
add_action('wp_ajax_ln_ajax_upload', 'ln_ajax_image_upload');

function ln_ajax_image_upload(){

	global $wpdb; //Now WP database can be accessed
	
	$image_id=$_POST['data'];
	$image_filename=$_FILES[$image_id];	
	$override['test_form']=false; 
	$override['action']='wp_handle_upload';    
	
	$uploaded_image = wp_handle_upload($image_filename,$override);
	
	if(!empty($uploaded_image['error'])){
		echo 'Error: ' . $uploaded_image['error'];
	}	
	else{ 
		update_option($image_id, $uploaded_image['url']);		 
		echo $uploaded_image['url'];
	}
			
	die();
	
}


/**
 * Ajax image remove 
 **/
add_action('wp_ajax_ln_ajax_remove', 'ln_ajax_image_remove');

function ln_ajax_image_remove(){
	
	global $wpdb; //Now WP database can be accessed
	
	$image_id=$_POST['data'];
	
	$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$image_id'";
    $wpdb->query($query);
			
	die();
	
}

/**********************************
 *  Review Rating Criteria Page
 **********************************/
function ln_theme_rating_criteria_page(){
	require_once (INC_PATH.'/admin/rating-criteria-page.php');
}

/**********************************
 *  Sidebars page
 **********************************/
function ln_theme_sidebars_page(){
	require_once (INC_PATH.'/admin/sidebars.php');
}

?>