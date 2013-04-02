<?php
add_action('admin_head', 'sys_ajaxupload');
function sys_ajaxupload() {
global $wpdb; // this is how you get access to the database
$sys_upload = wp_upload_dir();
$sys_img=$sys_upload['url'];

?>
<script type="text/javascript">
/* <![CDATA[ */
	jQuery(document).ready(function(){
		jQuery('.image_upload_button').each(function(){
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				action: '<?php echo admin_url("admin-ajax.php"); ?>',
				name: clickedID, // File upload name
				data: { // Additional data to send
					action:'my_special_action',
					type: 'upload',
					data:clickedID},
				autoSubmit: true, // Submit file after selection
				responseType: false,
				onChange: function(file, extension){},
				onSubmit: function(file, extension){
					clickedObject.text('Uploading'); // change button text, when user selects file	
					this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
					interval = window.setInterval(function(){
						var text = clickedObject.text();
						if (text.length < 13){	clickedObject.text(text + '.'); }
						else { clickedObject.text('Uploading'); } 
					}, 200);
				},
				
				onComplete: function(file,response) {
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable(); // enable upload button
					
					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' +response+'</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					}
					else{
						var buildReturn = '<img class="hide sys-option-image" id="image_'+clickedID+'" src="<?php echo $sys_img; ?>/'+file+'" alt="" />';
						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						var imgurl ='<?php echo $sys_img; ?>/'+file+'';
						clickedObject.parent().prev('input').val(imgurl);
					}
				}
			});
		
		});
		
		//AJAX Remove (clear option value)
		jQuery('.image_reset_button').click(function(){
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');
			var theID = jQuery(this).attr('title');	
			var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			var data = {
					action: 'my_special_action',
					type: 'image_reset',
					data: theID
				};

				jQuery.post(ajax_url, data, function(response) {
					var image_to_remove = jQuery('#image_' + theID);
					var button_to_hide = jQuery('#reset_' + theID);
					image_to_remove.fadeOut(500,function(){ 
						jQuery(this).remove(); 
					});
					button_to_hide.fadeOut();
					clickedObject.parent().prev('input').val('');
				});
			return false; 
		});   	 	
	});
/* ]]> */
</script>

<?php  }
add_action('wp_ajax_my_special_action', 'sys_ajaxupload_callback');
	function sys_ajaxupload_callback() {
		global $wpdb; // this is how you get access to the database
		//Uploads
		$themename = get_option('template') . "_";
		//Uploads
		if($_POST['type'] == 'upload'){
			
			$clickedID =$_POST['data']; // Acts as the name
			$filename =$_FILES[$clickedID];
			$override['test_form'] =false;
			
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		
			$override['action'] ='wp_handle_upload';    
			$uploaded_file =wp_handle_upload($filename,$override);
			$upload_tracking[] = $clickedID;
			
			update_option($clickedID ,$uploaded_file['url']);
			//update_option( $themename . $clickedID , $uploaded_file['url'] );
			if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
			else
			{echo $uploaded_file['url'];} // Is the Response
		}

		if($_POST['type'] == 'image_reset'){
			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
			//die;
		}
	}
	function systhemes_uploader_function($id,$std,$mod){
		global $wpdb; // this is how you get access to the database
		$uploader = '';
		$upload =get_option($id);

		if($mod != 'min') {
			$val = $std;
			if ( get_option( $id ) != "") { $val = get_option($id); }
			$uploader .= '<input class="sys-input" name="'. $id .'" id="'. $id .'_upload" type="text" value="'. $val .'" />';
		}

		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">Upload Image</span>';
		
		if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}

		$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="clear"></div>' . "\n";

		if(!empty($upload)){
			$upload = cleanSource($upload);
			$uploader .= '<a class="sys-uploaded-image" href="'. $upload . '">';
			$uploader .= '<img id="image_'.$id.'" src="'.sys_templatepath.'/timthumb.php?src='.$upload.'&amp;w=200" alt="" />';
			$uploader .= '</a>';
		}

		$uploader .= '<div class="clear"></div>' . "\n"; 
		echo $uploader;
	}

function cleanSource($src) {
	// remove slash from start of string
	if (strpos($src, "/") == 0) {
		$src = substr($src, -(strlen($src) - 1));
	}
	// Check if same domain so it doesn't strip external sites
	$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	if (!strpos($src, $host)) return $src;
	$regex = "/^((ht|f)tp(s|):\/\/)(www\.|)".$host."/i";
	$src = preg_replace($regex, '', $src);
	$src = htmlentities($src);

	// remove slash from start of string
	if (strpos($src, '/') === 0) {
		$src = substr($src, -(strlen($src) - 1));
	}
	return $src;
}
?>