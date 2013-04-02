<?php
// look up for the path
require_once('sys_config.php');
// check for rights
if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
    global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>System32 Shortcode Panel</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() ?>/lib/admin/tinymce/tinymce.js"></script>
	<base target="_self" />
<style type="text/css">
<!-- 
select#systemshortcode_tag optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif;}
select#systemshortcode_tag optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding-top:1px; padding-bottom:1px;}
.tabs li.current a { font-weight: bold !important;}
-->
</style>
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';
document.getElementById('systemshortcode_tag').focus();" style="display: none">
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<form name="system_tabs" action="#">
	<div class="tabs">
		<ul>
			<li id="system_tab" class="current"><span><a href="javascript:mcTabs.displayTab('system_tab','systemshortcode_panel');" onmousedown="return false;">Short codes</a></span></li>
<li id="portfolio_tab"><span><a href="javascript:mcTabs.displayTab('portfolio_tab','portfolio_panel');" onmousedown="return false;">Portfolio</a></span></li>
<li id="syscontact_tab"><span><a href="javascript:mcTabs.displayTab('syscontact_tab','SysContact_panel');" onmousedown="return false;">Contact Form</a></span></li>
<li id="sysgooglemap_tab"><span><a href="javascript:mcTabs.displayTab('sysgooglemap_tab','Sysgooglemap_panel');" onmousedown="return false;">Google Map</a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper" style="height:170px;">
		<!-- gallery panel -->
		<div id="systemshortcode_panel" class="panel current">
		<br />
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="systemshortcode_tag"><?php _e("Select Shortcodes", 'shortcodes'); ?></label></td>
            <td><select id="systemshortcode_tag" name="systemshortcode_tag" style="width: 200px">
                <option value="0">No Style!</option>
				<?php
					if(is_array($shortcode_tags)) {
					$i=1;

						foreach ($shortcode_tags as $sys_shortcodekey => $short_code_value) {
							if( stristr($short_code_value, 'sys_') ) {
							$sys_shortcode_name = str_replace('sys_', '' ,$short_code_value);
							$sys_shortcode_names = str_replace('_', ' ' ,$sys_shortcode_name);
	$sys_shortcodenames = ucwords($sys_shortcode_names);
if($i==1){ echo '<optgroup label="General Shortcodes">'; }
if($i==34){ echo '<optgroup label="Image and Gallery Shortcodes">'; }
if($i==38){ echo '<optgroup label="Video Shortcodes">'; }
if($i==43){ echo '<optgroup label="Widget Shortcodes">'; }
if($i==49){ echo '<optgroup label="Column Shortcodes">'; }
echo '<option value="' . $sys_shortcodekey . '" >' . $sys_shortcodenames.'</option>' . "\n";
if($i==68){ echo '</optgroup>'; 
echo '<optgroup label="Layout Shortcodes">';
echo '<option value="one_half_layout" >Two Column Layout</option>' . "\n";
echo '<option value="one_third_layout" >Three Column Layout</option>' . "\n";
echo '<option value="one_fourth_layout" >Four Column Layout</option>' . "\n";
echo '<option value="one_fifth_layout" >Five Columns Layout</option>' . "\n";
echo '<option value="one_third_two_third_layout" >One Third - Two Third</option>' . "\n";
echo '<option value="two_third_one_third_layout" >Two Third - One Third</option>' . "\n";
echo '<option value="one_fourth_three_fourth_layout" >One Fourth - Three Fourth</option>' . "\n";
echo '<option value="one_fourth_one_half_one_fourth_layout" >One Fourth - One Half - One Fourth</option>' . "\n";
echo '<option value="one_half_one_fourth_one_fourth_layout" >One Half - One Fourth - One Fourth</option>' . "\n";
echo '<option value="one_fourth_one_fourth_one_half_layout" >One Fourth - One Fourth -  One Half</option>' . "\n";
echo '<option value="one_fifth_four_fifth_layout" >One Fifth - Four Fifth</option>' . "\n";
echo '<option value="four_fifth_one_fifth_layout" >Four Fifth - One Fifth</option>' . "\n";
echo '<option value="two_fifth_three_fifth_layout" >Two Fifth - Three Fifth</option>' . "\n";
echo '<option value="three_fifth_two_fifth_layout" >Three Fifth - Two Fifth</option>' . "\n";
echo '</optgroup>';
}
if($i==82){ echo '</optgroup>'; }

	$i++;
					}
				
					}

					
					}
					?>
            </select></td>
          </tr>
         
        </table>
		</div>

	<div id="portfolio_panel" class="panel">
		<br />
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Select Category", 'portfolio'); ?></label></td>
            <td>


<?php
			$cats_array =get_terms('portfolio_type','orderby=name&hide_empty=0');;

	$dynamic_cats = array();
foreach ($cats_array as $categs) {
	$dynamic_cats[$categs->slug] = $categs->name;
	$cats_ids[] = $categs->slug;
}
?>
<select name="portfolio_tag" id="portfolio_tag" style="width: 200px">
<option value="">Select Category</option>
			<?php foreach ($cats_array as $categs) { ?>
			<option value="<?php echo $categs->slug; ?>"><?php echo $categs->name; ?>
			</option>
			<?php } ?>
		</select>
		
		</td>
          </tr>
		  
<tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Number of Columns", 'portfolio'); ?></label></td>
            <td>
			<input type="text" name="max_columns" id="max_columns" size="5" value="" > <small><em>( max 5 columns )</em></small>
		</td>
          </tr>
		  
		   <tr>
		 
		   <tr>
		 
            <td nowrap="nowrap"><label for="portfolio_tag"><?php _e("Images per page", 'portfolio'); ?></label></td>
            <td>
			<input type="text" id="images_pages" name="images_pages" size="6" value=""> 
		</td>
          </tr>
		   
         
   
        </table>
		</div>
<div id="SysIcon_panel" class="panel">
</div>
<div id="SysContact_panel" class="panel">
<br />
<table border="0" cellpadding="4" cellspacing="0">
	<tr>
		 
            <td nowrap="nowrap"><label for="syscontactemail_tag"><?php _e("Contact Email", 'Contact Email'); ?></label></td>
            <td>
			<input type="text"  name="syscontactemail_tag" id="syscontactemail_tag" size="40%" >
			
		</td>
          </tr>
		  </table>
</div>
<div id="Sysgooglemap_panel" class="panel">
<br />
<table border="0" cellpadding="4" cellspacing="0">
	<tr>
		 
            <td colspan="2" nowrap="nowrap"><label for="gmap_address_tag"><?php _e("Address", 'Address'); ?></label>
			<input type="text"  name="gmap_address" id="gmap_address" size="40%" >
			
		</td>
          </tr>
		  <tr>
		 
            <td nowrap="nowrap"><label for="gmap_height"><?php _e("Height", 'Height'); ?></label>
			<input type="text"  name="gmap_height" id="gmap_height" value="200" size="20%" >
			
		</td>

		 
            <td nowrap="nowrap"><label for="gmap_latitude"><?php _e("Latitude", 'Latitude'); ?></label>
			<input type="text"  name="gmap_latitude" id="gmap_latitude" size="20%" >
			
		</td>
          </tr>
		      <tr>
            <td nowrap="nowrap"><label for="gmap_longitude"><?php _e("Longitude", 'Longitude'); ?></label>
			<input type="text"  name="gmap_longitude" id="gmap_longitude" size="20%" >
			
		</td>

		 
            <td nowrap="nowrap"><label for="gmap_zoom"><?php _e("Zoom", 'Zoom'); ?></label>
			<input type="text"  name="gmap_zoom" id="gmap_zoom" size="20%" >
			
		</td>
 </tr>
		  
		   <tr>
		 
            <td nowrap="nowrap"><label for="gmap_html"><?php _e("Html", 'Html'); ?></label>
			<input type="text"  name="gmap_html" id="gmap_html" size="20%" >
			
		</td>
         
		 
            <td nowrap="nowrap"><label for="gmap_popup"><?php _e("Popup", 'Popup'); ?></label>
	<select id="gmap_popup" name="gmap_popup" style="width: 50px">
                <option value="0">off</option>
 				<option value="1">On</option></select>		
			
		</td></tr><tr>

 <td nowrap="nowrap"><label for="gmap_controls"><?php _e("Controls(optional)", 'Controls'); ?></label>
			<input type="text"  name="gmap_controls" id="gmap_controls" size="20%" >
</td>
<td nowrap="nowrap"><label for="gmap_scrollwheel"><?php _e("scrollwheel", 'scrollwheel'); ?></label>
	<select id="gmap_scrollwheel" name="gmap_scrollwheel" style="width: 50px">
                <option value="0">off</option>
 				<option value="1">On</option>
</select>		
			
		</td>

          </tr>
	<tr>
		 
            <td colspan="2" nowrap="nowrap"><label for="gmap_types"><?php _e("gmap types", 'gmap types'); ?></label>
	<select id="gmap_types" name="gmap_types" style="width: 200px">
                <option value="G_NORMAL_MAP">Default road map</option>
 				<option value="G_SATELLITE_MAP">Google Earth satellite</option>
				<option value="G_HYBRID_MAP">Mixture of normal and satellite</option>
				<option value="G_DEFAULT_MAP_TYPES">Mixture of above three maps</option>
				<option value="G_PHYSICAL_MAP">Physical map</option>
</select>				
		</td>
          </tr>
		  
		  </table>
</div>

		
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="Cancel" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="Insert" onclick="systemshortcodesubmit();" />
		</div>
	</div>
</form>
</body>
</html>
