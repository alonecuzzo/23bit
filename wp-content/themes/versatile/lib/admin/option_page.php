<div id="syscontent">
<?php foreach ($options as $value) { 
	switch ( $value['type'] ) {
	case "open":
?>
<?php break;
case "close":
?>
</div>
<?php break;
case 'subsection':
echo '<h2 class="subtitle">';
echo $value['name'];
echo '</h2>';
break;
case 'ctitle':
?>
<div id="message" class="infohead"><h2><img src="<?php echo $value['icon'];?>" alt="Icon"> <?php echo $value['name']; ?></h2></div>
<?php break;
case "title":
?>
<div id="<?php echo $value['name']; ?>">

<?php break; // ********************* SELECT OPTION
case 'selectname': 
?>
<div class="adcontentbox">
	<h2><?php echo $value['name']; ?></h2>

	<div class="box-option">
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $option) { ?>
		<option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($value['id'] == $value['std']) { echo ' selected="selected"'; } ?>>
		<?php echo $option; ?>
		</option>
		<?php } ?>
		</select>
	</div>
	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* IMAGE UPLOAD
case 'image_upload':
?>
<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<?php 	systhemes_uploader_function($value['id'],$value['std'],null); ?>	
	</div>
	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* RADIOS
case 'radios':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<?php foreach ($value['options'] as $key => $values) { 
			if(get_option($value['id'])){
			if ($key == get_option($value['id']) ) {
				$checked = " checked=\"checked\"";
			} else { $checked = "";	}
			} else {
			if($key == $value['std']) {
				$checked = " checked=\"checked\"";
				} else { $checked = "";	}
			} ?>
		<label>
			<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"  value="<?php echo $key; ?>" <?php echo $checked; ?> /> 
			&nbsp; <?php echo $values; ?>
		</label> <br />
		<?php } ?>
	</div>
	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>
<?php break; // ********************* imageresize
case 'imageresize':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
	<p style="color:red;"><?php $cachefolder= TEMPLATEPATH."/cache/";

if (!function_exists("gd_info")){

echo "If your server does not support timthumb then check Disable";
}
else if (!is_writeable($cachefolder))
{
echo "Theme uses Timthumb Image Resizer, remember to CHMOD your cache folder to 777";
}
?></p>
		<?php foreach ($value['options'] as $key => $values) { 
			if(get_option($value['id'])){
			if ($key == get_option($value['id']) ) {
				$checked = " checked=\"checked\"";
			} else { $checked = "";	}
			} else {
			if($key == $value['std']) {
				$checked = " checked=\"checked\"";
				} else { $checked = "";	}
			} ?>
		<label>
			<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"  value="<?php echo $key; ?>" <?php echo $checked; ?> /> 
			&nbsp; <?php echo $values; ?>
		</label> <br />
		<?php } ?>
	</div>
	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* SLIDER SELECTION
case 'choosesliders':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $option) { ?>
			<option value="<?php echo $option; ?>"  <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($value['id'] == $value['std']) { echo ' selected="selected"'; } ?>>
			<?php echo $option; ?>
			</option>
			<?php } ?>
		</select>
	</div>

	<div class="box-info"><span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>


	<div class="clear"></div>
</div>

<?php break;  // ********************* EDITOR
case 'content_editor':
?>
<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="editor-option">
		<div id="poststuff">
			<div id="post-body">
				<div id="post-body-content">
					<div class="postarea" id="postdivrich">
					<?php $homecontent=stripslashes(get_option("versatile_content")); the_editor($homecontent); ?> 
					<table id="post-status-info" cellspacing="0">
					<tbody><tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr></tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* RANGE INPUT
case 'range':
?>
<div class="minibox">

<div class="typobox-option">
		<div class="title"><?php echo $value['name']; ?></div>

		<select class="select" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $keys =>$values) { ?>
			<option value="<?php echo $keys; ?>"
			<?php if ( get_option( $value['id'] ) == $keys) { echo ' selected="selected"'; } ?>>
			<?php echo $values; ?>
			</option>
			<?php } ?>
		</select>
		px
		</div>
	<div class="clear"></div>
</div>
<?php break; // ********************* COLOR INPUT
case 'color':
?>
<div class="minibox">
	<div class="simple-info">
		<?php echo $value['name']; ?>
	</div>
	<div class="simple-option" id="colorPicker">	
    <input  type="color" size="8" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?>" data-hex="true" class="color"> 	
	</div>

	<div class="clear"></div>
</div>	
<?php break; // ********************* SELECTID
case 'selectid':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $keys =>$values) { ?>
			<option value="<?php echo $keys; ?>"
			<?php if ( get_option( $value['id'] ) == $keys) { echo ' selected="selected"'; } elseif ($keys == $value['std']) { echo ' selected="selected"'; } ?>>
			<?php echo $values; ?>
			</option>
			<?php } ?>
		</select>
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* TEXT INPUT
case 'text':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?>" />
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* TEXTAREA
case 'textarea':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<textarea cols="" rows="" name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea>
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>


<?php break; // ********************* Custom sidebar
case 'customsidebar':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<?php
	 $std = get_option($value['id']);
$output="";
				 $custom_sidebar_arr=@get_option($value['id']);
				// print_r($custom_sidebar_arr);
				if ( $std != "") { $val = $std; }
					echo '<div id="custom_widget_sidebar"><table id="custom_widget_table" cellpadding="0" cellspacing="0">';
				echo '<tbody>';
				
				if($custom_sidebar_arr !=""){
				foreach($custom_sidebar_arr as $custom_sidebar_code) {
					echo '<tr><td><input type="text" name="'.$value['id'].'[]" value="'. $custom_sidebar_code.'"  size="30" style="width:97%" /></td><td><a class="btn small red" href="javascript:void(0);return false;" onClick="jQuery(this).parent().parent().remove();"><span>Delete</span></a></td></tr>';
				}
					}				
				echo '</tbody></table><button type="button" class="btn small green" name="add_custom_widget" value="Add Sidebar" onClick="addWidgetRow()"><span>Add Sidebar</span></button></div>';
				?>
						<script type="text/javascript" language="javascript">
							function addWidgetRow(){
								jQuery('#custom_widget_table').append('<tr><td><input type="text" name="<?php echo $value['id'];?>[]" value="" size="30" style="width:97%" /></td><td><a class="btn small red" href="javascript:void(0);return false;" onClick="jQuery(this).parent().parent().remove();"><span>Delete</span></a></td></tr>');
													
							}

				</script>
			
	</div>	 

	

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>


<?php break; // ********************* CHECKBOX
case "checkbox":
?>

<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>
	
	<div class="box-option">
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
		<div class="on_off"><input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /></div>
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* IPHONE CHECKBOX
case "iphonecheckbox":
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
	<?php foreach ($value['options'] as $keys =>$values) { 
		$checked = ""; 
			if (get_option( $value['id'])) { 
				if (@in_array($keys, get_option($value['id'] ))) $checked = "checked=\"checked\"";
			} 
		else {
		} 
		?>	
	
		<span class="on_off">
		<input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $keys; ?>" value="<?php echo $keys; ?>" <?php echo $checked; ?> />
		<?php echo $values; ?>
		</span><br />
		<?php } ?>		
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* INPUT CHECKBOX
case "inputcheckbox":
?>

<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
	<?php foreach ($value['options'] as $keys =>$values) { 
		$checked = ""; 
			if (get_option( $value['id'])) { 
				if (@in_array($keys, get_option($value['id'] ))) $checked = "checked=\"checked\"";
			} 
		else {
		} 
		?>	
	
		<label class="namelabel">
		<input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $keys; ?>" value="<?php echo $keys; ?>" <?php echo $checked; ?> />
		<?php echo $values; ?>
		</label><br />
		<?php } ?>		
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>


<?php break; // ********************* WIDGET CHECKBOX SIDEBARS
case "widgetcheckbox":
?>

<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<?php foreach ($value['options'] as $values) { 
		$checked = ""; 
			if (get_option( $value['id'])) { 
				if (@in_array($values, get_option($value['id'] ))) $checked = "checked=\"checked\"";
			} 
		else {
		} 
		?>	
	
		<label class="button">
		<input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $values; ?>" value="<?php echo $values; ?>" <?php echo $checked; ?> />
		<?php echo $values; ?>
		</label>
		<?php } ?>		
	</div>

	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>
</div>

<?php break; // ********************* CUSTOM FONT 
case 'custom_fonts':
?>
<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
		<textarea name="wpcuf_code" rows="20" cols="100" style="width: 100%;"><?php echo  stripslashes(get_option("wpcuf_code")); ?></textarea>
	</div>
	<div class="box-info">
		<span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<table class="widefat customtable">
	<thead>
	 <tr>
	    <th style="width: 5%;">Enable</th>
	    <th style="width: 15%;">fontFamily</th>	
	 <th style="width: 80%;">Preview</th>
	 </tr>
	</thead>
	<?php   
	 $count = 0; ?>
	 <!-- body of the table starts here -->
	<tbody>
<?php
foreach (glob(TEMPLATEPATH . "/js/cufon/*") as $path_to_files) {?>
<tr>
<?php

     // let's get some info within the loop
     $count++;
     $file_name = basename($path_to_files);
     $file_content = file_get_contents($path_to_files); //open file and read
     $delimeterLeft = 'font-family":"';
     $delimeterRight = '"';
     $font_name = font_name($file_content, $delimeterLeft, $delimeterRight, $debug = false);
?>
   
     
     <!-- enable --> 
     <td style='width: 5%;' >
<?php


if (get_option(enable_font)) { 
		$checked = in_array($file_name,get_option(enable_font))?' checked="checked"':'';	
			} 
		else {
$default_font=$value['default'];
if($file_name == $default_font)
{
$checked = "checked=\"checked\"";
}else{$checked=""; }	
		} 
?>
	<span class="on_off"><input name="enable_font[]" type="checkbox"  value="<?php echo $file_name; ?>" <?php echo $checked; ?>  />
	</span></td>
	<td style='width: 15%;'><?php echo $font_name; ?></td>
	<td style="width: 80%;"><span style="display: block; font-size: 24px;" id="font-<?php echo $count; ?>">
	This is a preview of the <span style="color:  #379BFF;"><?php echo $font_name; ?></span>. 
	Characters: 0123456789 &amp; so on..</span></td>
	</tr> 
	<?php } ?>
	</tbody>
	</table>  
	<div class="clear"></div>

</div>
<?php break; // ********************* CUSTOM LAYOUT
case 'customlayout':
?>
<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>
	<div class="box-option">
				<p><input type="radio" name="layoutoption" class="sys_theme_layout" onClick="sys_theme_layout()" value="stretched" <?php if(get_option('layoutoption') == 'stretched') { echo(' checked'); } ?> /> Stretched </p>
				<p><input type="radio" name="layoutoption"  class="sys_theme_layout" onClick="sys_theme_layout()" value="boxed" <?php if(get_option('layoutoption') == 'boxed') { echo(' checked'); } ?> /> Boxed</p>
	       	</div>
	<div class="box-info"><span>More Info</span>
	Choose the Layout style you want to display for theme.
	</div>
	<div class="clear"></div>
	
	<div id="sys_theme_layout_boxed" class="suboption">
		<div class="box-option">
<?php	$values=array(
			"id" => $shortname."boxed_repeat",
            "std" => "",
			"options" => array(	"repeat" => "Repeat",
								"no-repeat" => "No Repeat",
								"repeat-x" => "Repeat X",
								"repeat-y" => "Repeat Y")	
			);
?>
<select name="<?php echo $values['id']; ?>" id="<?php echo $values['id']; ?>">
			<?php foreach ($values['options'] as $keys =>$values) { ?>
			<option value="<?php echo $keys; ?>"
			<?php if ( get_option('boxed_repeat') == $keys) { echo ' selected="selected"'; } elseif ($keys == $value['std']) { echo ' selected="selected"'; } ?>>
			<?php echo $values; ?>
			</option>
			<?php } ?>
		</select></div>
		<div class="box-info">
		<span>More Info</span>
		Please select the Background Repeat Option
		</div>

	<div class="box-option">
<?php	$boxed_atvalues=array( 
			"id" => $shortname."boxed_attachment",
			"options" => array(	"fixed" => "Fixed",
								"scroll" => "Scroll")	
			);
?>
<select name="<?php echo $boxed_atvalues['id']; ?>" id="<?php echo $boxed_atvalues['id']; ?>">
			<?php foreach ($boxed_atvalues['options'] as $keys =>$values) { ?>
			<option value="<?php echo $keys; ?>"
			<?php if ( get_option('boxed_attachment') == $keys) { echo ' selected="selected"'; } elseif ($keys == $value['std']) { echo ' selected="selected"'; } ?>>
			<?php echo $values; ?>
			</option>
			<?php } ?>
		</select></div>
		<div class="box-info">
			<span>More Info</span>
			Layout Background Attachment Style 
		</div>


		<div class="box-option">
<?php $boxed_values=array(	
			"id" => $shortname."boxed_position",
            "std" => "",
			"options" => array(	"left top" => "Left Top",
								"left center" => "Left Center",
								"left bottom" => "Left Bottom",
								"right top" => "Right Top",
								"right center" => "Right Center",
								"right bottom" => "Right Bottom",
								"center top" => "Center Top",
								"center center" => "Center Center",
								"center bottom" => "Center Bottom")
			);
?>
<select name="<?php echo $boxed_values['id']; ?>" id="<?php echo $boxed_values['id']; ?>">
			<?php foreach ($boxed_values['options'] as $keys =>$values) { ?>
			<option value="<?php echo $keys; ?>"
			<?php if ( get_option('boxed_position') == $keys) { echo ' selected="selected"'; } elseif ($keys == $value['std']) { echo ' selected="selected"'; } ?>>
			<?php echo $values; ?>
			</option>
			<?php } ?>
		</select></div>
		<div class="box-info">
			<span>More Info</span>
			Select the position of the background you want to assign.
		</div>

	<div class="box-option">
	<?php 	

$value['id']="boxed_image";

$value['std']="";
systhemes_uploader_function($value['id'],$value['std'],null); ?>	
</div>								
		<div class="box-info">
			<span>More Info</span>
		Please insert the Image URL here or click on upload button to upload the image from your desktop. 
		</div>
	</div>

		<div class="clear"></div>

	<div id="sys_theme_layout_stretched">
</div>
	<div class="clear"></div>

</div>

<?php break; // ********************* SOCIABLES
case 'header_text':
?>
<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>
	<div class="box-option">
				<p><input type="radio" name="sys_header_teaser" class="sys_header_teaser" onClick="sys_header_text()" value="sys_headerteaser_text" <?php if(get_option('sys_header_teaser') == 'sys_headerteaser_text') { echo(' checked'); } ?> /> Custom </p>
				<p><input type="radio" name="sys_header_teaser"  class="sys_header_teaser" onClick="sys_header_text()" value="sys_headerteaser_twitter" <?php if(get_option('sys_header_teaser') == 'sys_headerteaser_twitter') { echo(' checked'); } ?> /> Twitter</p>
	         	<p><input type="radio" name="sys_header_teaser"  class="sys_header_teaser" onClick="sys_header_text()" value="sys_headerteaser_disable" <?php if(get_option('sys_header_teaser') == 'sys_headerteaser_disable') { echo(' checked'); } ?> /> Disable</p>
	         
	</div>
	<div class="box-info"><span>More Info</span>
	Choose the Teaser style you want to display in the subheader section of the theme.
	</div>
	<div class="clear"></div>
	
	<div id="sys_header_teaser1" class="suboption">
		<div class="box-option"><textarea cols="" name="sys_header_teasertext"><?php echo stripslashes(get_option("sys_header_teasertext")); ?></textarea></div>				
		<div class="box-info">
			<span>More Info</span>
			This text will be used as the title/text for the subheader section of the theme.
		</div>
	</div>

	<div id="sys_twitter_teaser" class="suboption">
		<div class="box-option"><input type="text" name="sys_twitter_teaser_username" value="<?php echo stripslashes(get_option("sys_twitter_teaser_username"));?>"></div>
		<div class="box-info">
			<span>More Info</span>
			Enter your twitter username <em>(e.g : themeforest)</em> This twitter ID will fetch your latest tweets and will be displayed in the subheader section of the theme.
		</div>
	</div>
	<div class="clear"></div>

</div>
<?php break; // ********************* CUSTOM SLIDER
case 'custom_slider':
?>
<div class="adcontentbox">

	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>
	<div class="box-option">
		<input type="radio" name="sys_choose_slider" id="sys_choose_slider" onClick="sys_custom_slider_option()" value="nivo_slider" <?php if(get_option('sys_choose_slider') == 'nivo_slider') { echo(' checked'); } ?> /> Nivo <br>
		<input type="radio" name="sys_choose_slider"  id="sys_choose_slider" onClick="sys_custom_slider_option()" value="video_slider" <?php if(get_option('sys_choose_slider') == 'video_slider') { echo(' checked'); } ?> /> Video <br>
	<input type="radio" name="sys_choose_slider"  id="sys_choose_slider" onClick="sys_custom_slider_option()" value="piecemaker_slider" <?php if(get_option('sys_choose_slider') == 'piecemaker_slider') { echo(' checked'); } ?> /> Piecemaker2
	</div>
	
	<div class="box-info">
		<span>More Info</span>
		Choose the slider you want to assign which holds the Featured Items to display on Homepage.
	</div>
	<div class="clear"></div>

	<div id="sys_nivo_slider">
		<h2>Nivo Slides Limits</h2>
		<div class="box-option">
			<input name="nivodisplayimage" id="nivodisplayimage" type="text" value="<?php if ( get_option( 'nivodisplayimage' ) != "") { echo stripslashes(get_option('nivodisplayimage')); } else { echo $value['std']; } ?>" />
		</div>
		<div class="box-info">
			<span>More Info</span>
			Enter the limit for the featured slides. (Eg: 5)
		</div>
	<div class="clear"></div>

	<h2>Nivo Slides Effect</h2>
		<div class="box-option">	
		<?php 
		$value['id']="nivoslidereffect";
		$value['options']=array("random","sliceDown","sliceDownLeft","sliceUp","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade");
		?>
		<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php foreach ($value['options'] as $option) { ?>
			<option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($value['id'] == $value['std']) { echo ' selected="selected"'; } ?>>
			<?php echo $option; ?>
			</option>
			<?php } ?>
		</select>
		</div>
		<div class="box-info">
			<span>More Info</span>
			Select the style of the featured slider you want to assign, fade or other.
		</div>
		<div class="clear"></div>

	<h2>Nivo Right Side text</h2>
		<div class="box-option">
		<?php 
		$value['id']="nivo_header_highlight";
		?>
		<textarea cols="" rows="" name="nivo_header_highlight" type="textarea"><?php if ( get_option('nivo_header_highlight') != "") { echo stripslashes(get_option('nivo_header_highlight')); } else { echo ""; } ?></textarea>
		</div>
		<div class="box-info">
			<span>More Info</span>
Enter the text you want to highlight on the rightside of the slider. Use &lt;h1> &lt;h4> and &lt;p> elements for content.<br><br>
If you choose to display full width make sure you read this documentation <a href="http://www.themeflash.com/support/nivo-slider-image-full-width-in-boxed-layout-t146.html" target="_blank">Click Here</a>
		</div>
		<div class="clear"></div>
	</div>


	<div id="video_slider">
		<h2>Video Embed Code</h2>
		<div class="box-option">
<textarea name="sys_video" ><?php echo stripslashes(htmlspecialchars(get_option("sys_video")));?></textarea>	
		</div>
		<div class="box-info">
			<span>More Info</span>
		Enter the embed code from youtube, vimeo.
		</div>
		<div class="clear"></div>

	<h2>Video Slider Right Side Text</h2>
		<div class="box-option">
		<?php 
		$value['id']="video_header_highlight";
		?>
		<textarea cols="" rows="" name="video_header_highlight" type="textarea"><?php if ( get_option('video_header_highlight') != "") { echo stripslashes(get_option('video_header_highlight')); } else { echo ""; } ?></textarea>
		</div>
		<div class="box-info">
			<span>More Info</span>
Enter the text you want to highlight on the right side of the slider.
		</div>
		<div class="clear"></div>

	</div>

	<div id="piecemaker_slider">
		<h2>Piecemaker Id</h2>
		<div class="box-option">
<textarea name="piecemaker_id" ><?php echo stripslashes(htmlspecialchars(get_option("piecemaker_id")));?></textarea>	
		</div>
		<div class="box-info">
			<span>More Info</span>
			Enter the code with your piecemaker ID example (Eg:[piecemaker id='2'/]) where 2 is your piecemaker id
		</div>
		<div class="clear"></div>
</div>
</div>
	
<?php break; // ********************* CUSTOM SOCIABLES
case 'custom_socialbook_mark':
?>
<div class="adcontentbox">
<div id="sys_social_book">
	<h2>Social Networking Sites</h2>	
	<table id="sys_socialbookmark" class="customtable">
		<tr>
		<th>Delete</th>
		<th colspan="100%">Site URL / Icons / Title</th>
		</tr>
		<?php
			if (get_option('sys_social_bookmark') != '') {
			$sys_social_items = explode('#;', get_option('sys_social_bookmark'));
				for($i=0;$i<count($sys_social_items);$i++) {
				$sys_social_item = explode('#|', $sys_social_items[$i]);
		?>
		<tr>
		<td align="center" width="70">
			<a href="#" class="sys_social_item_delete"><img src="<?php bloginfo('template_url'); ?>/lib/admin/images/delete.png" alt="x">
		</td>
		<td width="100">
		<strong>Title:</strong>
			<input type="text" class="sys_social_title" value="<?php echo($sys_social_item[0]); ?>" />
		</td>
		<td width="100">
			<strong>Icon</strong>
		<?php global $socialimages_select;?>
			
	<select id="sys_social_file_icon" class="sys_social_file_icon" name="sys_social_file_icon"  width="300">
			<?php foreach ( $socialimages_select as $key => $values) { ?>
			<option style="background:url('<?php bloginfo('template_url');?>/images/followus/<?php echo $values; ?>') 0 0 no-repeat;" title="" value="<?php echo $values; ?>" <?php if ( $sys_social_item[1] == $values) { echo ' selected="selected"'; }?>>
			<?php $sys_socialvalue = str_replace('_', '' ,$values);
							
	echo ucwords($sys_socialvalue); ?>
			</option>
			<?php } ?>
		</select>	
		</td>
			<td width="100">
			<strong>URL:</strong>
			<input type="text" class="sys_social_account_url" value="<?php echo($sys_social_item[2]); ?>" />
			</td>
			</tr>
						<?php
							}
						}
						?>
				</table>
	
			<p>
				<input name="sys_add_social_book" onClick="sys_add_social_item()" type="button" value="Add New Row" class="button" />
				<input type="hidden" id="sys_social_bookmark" name="sys_social_bookmark" />
				<input onclick="sys_social_book_form()" name="social_save" type="submit" value="save changes" class="button" />
			</p>	
	
		</div>
		</div>
<?php break;
case "radio":
?>

<div class="adcontentbox">
	<h2><?php echo $value['name']; ?>	<span><?php echo $value['shortinfo']; ?></span></h2>

	<div class="box-option">
			<?php
						foreach ($value['options'] as $key=>$option) { 
							if(get_option($value['id'])){
								if ($key == get_option($value['id']) ) {
									$checked = " checked=\"checked\"";
								} else {
									$checked = "";
								}
							} else {
								if($key == $value['std']) {
									$checked = " checked=\"checked\"";
								} else {
									$checked = "";
								}
							} ?>
							  
          <label class="button"><input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>"<?php echo $checked; ?> /><?php echo '&nbsp;'.$option; ?></label>
							<?php } ?>
	</div>

	<div class="box-info"><span>More Info</span>
		<?php echo $value['desc']; ?>
	</div>
	<div class="clear"></div>

</div>
<?php break;
	}
}
?>
</div>
</div>