<?php
/* 
Plugin Name: WP-Testimonials
Plugin URI: http://www.sunfrogservices.com/free-php-script-downloads/wp-testimonials/
Description: Lets you display your testimonials in a random block and/or all on one page.  Widget included.  Output customizable with CSS.  Optional link in sidebar block to "view all" testimonials on a page.  Requires WordPress 2.7 or higher. <a href="options-general.php?page=tsfstst_config">Configuration Page</a> / <a href="tools.php?page=sfstst_manage">Manage Testimonials</a>
Version: 2.2
Author: Jodi Diehl
Author URI: http://www.sunfrogservices.com
License: GPL

WP-Testimonials - displays testimonials in WordPress
Version 2.2
Copyright (C) 2007-2009 Jodi Diehl
Released 2009-12-02

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Contact Jodi Diehl at http://www.sunfrogservices.com

*/

// +---------------------------------------------------------------------------+
// | WP hooks                                                                  |
// +---------------------------------------------------------------------------+

/* WP actions */

add_action('init', 'sfstst_install');

//register_activation_hook( __FILE__, 'sfstst_install' );
//register_deactivation_hook( __FILE__, 'sfstst_deactivate' );
add_action('admin_menu', 'sfstst_addpages');
add_action( 'admin_init', 'register_sfstst_options' );
add_action('init', 'sfstst_addcss');
add_shortcode('sfs-testimonials', 'sfstst_showall');
add_shortcode('sys-testimonials', 'sys_showall');


function register_sfstst_options() { // whitelist options
  register_setting( 'sfstst-option-group', 'sfs_showlink' );
  register_setting( 'sfstst-option-group', 'sfs_linktext' );
  register_setting( 'sfstst-option-group', 'sfs_linkurl' );
  register_setting( 'sfstst-option-group', 'sfs_linkblank' );
  register_setting( 'sfstst-option-group', 'sfs_deldata' );
}

function unregister_sfstst_options() { // unset options
  unregister_setting( 'sfstst-option-group', 'sfs_showlink' );
  unregister_setting( 'sfstst-option-group', 'sfs_linktext' );
  unregister_setting( 'sfstst-option-group', 'sfs_linkurl' );
  unregister_setting( 'sfstst-option-group', 'sfs_linkblank' );
  unregister_setting( 'sfstst-option-group', 'sfs_deldata' );
}

function sfstst_addcss() { // include style sheet
	$testmonialcss_file = get_template_directory_uri() . '/css/wp-testimonials-style.css';
	//wp_enqueue_style('sfstst_css', $testmonialcss_file, false, '2.92', 'all');
  	 // wp_enqueue_style('sfstst_css',TEMPLATEPATH .'/css/wp-testimonials-style.css' );        
}  

// +---------------------------------------------------------------------------+
// | Create admin links                                                        |
// +---------------------------------------------------------------------------+

function sfstst_addpages() { 	

// Add submenus to appropriate top-level menus:
	add_options_page('Testimonial Configuration', 'Testimonials', 8, 'tsfstst_config', 'sfstst_options_page');
    add_management_page('Testimonials', 'Testimonials', 8, 'sfstst_manage', 'sfstst_adminpage'); 
}


// +---------------------------------------------------------------------------+
// | Create table on activation                                                |
// +---------------------------------------------------------------------------+

function sfstst_install () {
   global $wpdb;

   $table_name = $wpdb->prefix . "testimonials";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
	   $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . "(
		testid int( 15 ) NOT NULL AUTO_INCREMENT ,
		text_short text,
		text_full text,
		clientname text,
		company text,
		homepage text,
		PRIMARY KEY ( `testid` )
		);";
	  
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql);
	  
	  $txt_short = "Thank you for installing the WP-Testimonials plugin.";
	  $txt_long = "Thank you for installing the WP-Testimonials plugin.  You can manage the testimonials through the admin area under the Testimonials tab.";

      $insert = "INSERT INTO " . $table_name .
            " (text_short,text_full,clientname,company,homepage) " .
            "VALUES ('$txt_short','$txt_long','Jodi Diehl','Sunfrog Services, LLC','http://www.sunfrogservices.com')";

      $results = $wpdb->query( $insert );

	}
	  delete_option("sfstst_version");
	  add_option("sfstst_version", "2.2");
}

// +---------------------------------------------------------------------------+
// | Add New Testimonial                                                       |
// +---------------------------------------------------------------------------+

/* add new testimonial form */
function sfstst_newform() {
?>
	<div class="wrap">
	<h2>Add New Testimonial</h2>
	If you do not want to include this testimonial in the random block, leave the
	&quot;short text&quot; field blank.<br />
	Leave the &quot;full text&quot; field blank if you do not want to display this testimonial
	on the Testimonials page.<br />
	<br />
	<div id="sfstest-form">
	<form name="addnew" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<label for="clientname">Client Name:</label><input name="clientname" type="text" size="45"><br/>
	<label for="company">Company:</label><input name="company" type="text" size="45"><br/>
	<label for="website">Website:</label><input name="homepage" type="text" size="45" value="http://" onFocus="this.value=''"><br/>
	<label for="text_short">Short text (20-30 words for random block):</label><textarea name="text_short" cols="45" rows="5"></textarea><br/>
	<label for="text_full">Full text:</label><textarea name="text_full" cols="45" rows="15"></textarea><br/>
	<input type="submit" name="sfstst_addnew" value="<?php _e('Add Testimonial', 'sfstst_addnew' ) ?>" /><br/>
	
	</form>
	</div>
	</div>
<?php } 

/* insert testimonial into DB */
function sfstst_insertnew() {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$txt_short = $wpdb->escape($_POST['text_short']);
	$txt_long = $wpdb->escape($_POST['text_full']);
	$clientname = $wpdb->escape($_POST['clientname']);
	$company = $wpdb->escape($_POST['company']);
	$homepage = $_POST['homepage'];
	
	$insert = "INSERT INTO " . $table_name .
	" (text_short,text_full,clientname,company,homepage) " .
	"VALUES ('$txt_short','$txt_long','$clientname','$company','$homepage')";
	
	$results = $wpdb->query( $insert );

}

// +---------------------------------------------------------------------------+
// | Manage Page - list all and show edit/delete options                         |
// +---------------------------------------------------------------------------+


/* show list of testimonials */
function sfstst_showlist() {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	$tstlist = $wpdb->get_results("SELECT testid,clientname,company,homepage FROM $table_name ORDER BY testid DESC");
	$sfs_linkblank = get_option('sfs_linkblank');
	foreach ($tstlist as $tstlist2) {
		echo '<a href="tools.php?page=sfstst_manage&amp;mode=sfststedit&amp;testid='.$tstlist2->testid.'">Edit</a>';
		echo '&nbsp;|&nbsp;';
		echo '<a href="tools.php?page=sfstst_manage&amp;mode=sfststrem&amp;testid='.$tstlist2->testid.'" onClick="return confirm(\'Delete this testimonial?\')">Delete</a>';
		echo '&nbsp;&nbsp;';
		echo stripslashes($tstlist2->clientname);
			if ($tstlist2->company != '') {
				if ($tstlist2->homepage != '') {
					echo ' ( <a href="'.$tstlist2->homepage.'" target="_blank">'.stripslashes($tstlist2->company).'</a>  )';
				} else {
					echo ' ('.stripslashes($tstlist2->company).')';
				}
			}
		echo '<br/><br/>';
	}
}

/* edit testimonial form */
function sfstst_edit($testid){
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$gettst2 = $wpdb->get_row("SELECT testid, clientname, company, homepage, text_full, text_short FROM $table_name WHERE testid = $testid");
	
	echo '<h3>Edit Testimonial</h3>';
	echo 'If you do not want to include this testimonial in the random block, leave the "short text" field blank.<br />';
	echo 'Leave the "full text" field blank if you do not want to display this testimonial on the Testimonials page.<br /><br />';
	echo '<form name="edittst" method="post" action="tools.php?page=sfstst_manage">';
	 echo 'Client Name:<br/>
		  <input name="clientname" type="text" size="45" value="'.stripslashes($gettst2->clientname).'"><br/><br/>
		Company:<br/>
		  <input name="company" type="text" size="45" value="'.stripslashes($gettst2->company).'"><br/><br/>
		Website:<br/>
		 <input name="homepage" type="text" size="45" value="'.$gettst2->homepage.'"><br/><br/>
		Short text (20-30 words for random block):<br/>
		  <textarea name="text_short" cols="45" rows="5">'.stripslashes($gettst2->text_short).'</textarea><br/><br/>
		Full text:<br/>
		  <textarea name="text_full" cols="45" rows="15">'.stripslashes($gettst2->text_full).'</textarea><br/><br/>
		  <input type="hidden" name="testid" value="'.$gettst2->testid.'">
		  <input name="sfststeditdo" type="submit" value="Update">';
	echo '</form>';
	
}

/* update testimonial in DB */
function sfstst_editdo($testid){
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$testid = $testid;
	$txt_short = $wpdb->escape($_POST['text_short']);
	$txt_long = $wpdb->escape($_POST['text_full']);
	$clientname = $wpdb->escape($_POST['clientname']);
	$company = $wpdb->escape($_POST['company']);
	$homepage = $_POST['homepage'];
	
	$wpdb->query("UPDATE " . $table_name .
	" SET text_short = '$txt_short', ".
	" text_full = '$txt_long', ".
	" clientname = '$clientname', ".
	" company = '$company', ".
	" homepage = '$homepage' ".
	" WHERE testid = '$testid'");
}

/* delete testimonials from DB */
function sfstst_removetst($testid) {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	
	$insert = "DELETE FROM " . $table_name .
	" WHERE testid = ".$testid ."";
	
	$results = $wpdb->query( $insert );

}


/* admin page display */
function sfstst_adminpage() {
	global $wpdb;
?>
	<div class="wrap">
	<?php
	echo '<h2>Testimonials Management Page</h2>';
		if (isset($_POST['sfstst_addnew'])) {
			sfstst_insertnew();
			?>
	<div id="message" class="updated fade"><p><strong><?php _e('Testimonial Added'); ?>.</strong></p></div><?php
		}
		if ($_REQUEST['mode']=='sfststrem') {
			sfstst_removetst($_REQUEST['testid']);
			?><div id="message" class="updated fade"><p><strong><?php _e('Testimonial Deleted'); ?>.</strong></p></div><?php
		}
		if ($_REQUEST['mode']=='sfststedit') {
			sfstst_edit($_REQUEST['testid']);
			exit;
		}
		if (isset($_REQUEST['sfststeditdo'])) {
			sfstst_editdo($_REQUEST['testid']);
			?><div id="message" class="updated fade"><p><strong><?php _e('Testimonial Updated'); ?>.</strong></p></div><?php
		}
			sfstst_showlist(); // show testimonials
		?>
	</div>
	<div class="wrap"><?php sfstst_newform(); // show form to add new testimonial ?>
	</div>
	<div class="wrap">
	<?php 
$yearnow = date('Y');
if($yearnow == "2007") {
    $yearcright = "";
} else { 
    $yearcright = "2007-";
}
?>
	  <p>WP-Testimonials v.2.2 is &copy; Copyright <?php echo("".$yearcright."".date('Y').""); ?>, <a href="http://www.sunfrogservices.com/">Jodi Diehl</a> and distributed under the <a href="http://www.fsf.org/licensing/licenses/quick-guide-gplv3.html">GNU General Public License</a>.</p>
	  <p>If you find this plugin useful, please consider a donation.</p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="7242213">
	<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
<?php } 

// +---------------------------------------------------------------------------+
// | Sidebar - show one random testimonial in sidebar                          |
// +---------------------------------------------------------------------------+

/* show one random testimonial in sidebar */
function sfstst_onerandom() {
	global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	$randone = $wpdb->get_row("SELECT testid, clientname, company, homepage, text_short FROM $table_name WHERE text_short !='' order by RAND() LIMIT 1");
	$sfs_linkblank = get_option('sfs_linkblank');

	echo '<blockquote><p>';
	echo nl2br(stripslashes($randone->text_short)).'</p>';


	echo '<cite>';
	if ($randone->company != '') {
	echo '<span>'.stripslashes($randone->clientname).'</span>';
		if ($randone->homepage != '') {
			if ($sfs_linkblank == 'yes') {
				echo '<a href="'.$randone->homepage.'" target="_blank">'.stripslashes($randone->company).'</a>';
			} else {
				echo '<a href="'.$randone->homepage.'">'.stripslashes($randone->company).'</a>';
			}
		} else {
			echo stripslashes($randone->company);
		}

	} else {
		echo stripslashes($randone->clientname).'';
	}
	echo '</cite></blockquote>';

	$sfs_showlink = get_option('sfs_showlink');
	$sfs_linktext = get_option('sfs_linktext');
	$sfs_linkurl = get_option('sfs_linkurl');
	
		if (($sfs_showlink == 'yes') && ($sfs_linkurl !='')) {
			if ($sfs_linktext == '') { $sfs_linkdisplay = 'Read More'; } else { $sfs_linkdisplay = $sfs_linktext; }
			echo '<div class="readmore"><a href="'.$sfs_linkurl.'">'.$sfs_linkdisplay.'</a></div>';
		}


}

// +---------------------------------------------------------------------------+
// | Widget for testimonial in sidebar                                         |
// +---------------------------------------------------------------------------+
if (version_compare($wp_version, '2.8', '>=')) { // check if this is WP2.8+

	### Class: WP-Testimonials Widget
	 class sfstst_widget extends WP_Widget {
		// Constructor
		function sfstst_widget() {
			$widget_ops = array('description' => __('Displays one random testimonial in your sidebar', 'wp-testimonials'));
			$this->WP_Widget('testimonials', __('Testimonials'), $widget_ops);
		}
	 
		// Display Widget
		function widget($args, $instance) {
			extract($args);
			$title = esc_attr($instance['title']);
	
			echo $before_widget.$before_title.$title.$after_title;
	
				sfstst_onerandom();
	
			echo $after_widget;
		}
	 
		// When Widget Control Form Is Posted
		function update($new_instance, $old_instance) {
			if (!isset($new_instance['submit'])) {
				return false;
			}
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			return $instance;
		}
	 
		// DIsplay Widget Control Form
		function form($instance) {
			global $wpdb;
			$instance = wp_parse_args((array) $instance, array('title' => __('Testimonials', 'wp-testimonials')));
			$title = esc_attr($instance['title']);
	?>
	 
	 
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp-testimonials'); ?>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
	 
	<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
	<?php
		}
	}
	 
	### Function: Init WP-Testimonials  Widget
	add_action('widgets_init', 'widget_sfstst_init');
	function widget_sfstst_init() {
		register_widget('sfstst_widget');
	}
} else { // this is an older WP so use old widget structure
	function widget_sfststwidget($args) {
		extract($args);
	?>
			<?php echo $before_widget; ?>
				<?php echo $before_title
					. 'Testimonial'
					. $after_title; ?>
			 <?php sfstst_onerandom(); ?>
			<?php echo $after_widget; ?>
	<?php
	}
	add_action('plugins_loaded', 'sfstst_sidebarWidgetInit');
	function sfstst_sidebarWidgetInit()
	{
		register_sidebar_widget('Testimonials', 'widget_sfststwidget');
	}
}



// +---------------------------------------------------------------------------+
// | Configuration options for testimonials                                    |
// +---------------------------------------------------------------------------+

function sfstst_options_page() {
?>
	<div class="wrap">
	<h2>Testimonials Settings</h2>
	<?php echo '<p align="right">Need help? <a href="/' . PLUGINDIR . '/wp-testimonials/docs/documentation.php" target="_blank">documentation</a> &nbsp;|&nbsp; <a href="http://www.sunfrogservices.com/free-php-script-downloads/wp-testimonials/">support page</a></p>'; ?>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	<?php settings_fields( 'sfstst-option-group' ); ?>
	
	<table cellpadding="5" cellspacing="5">
	<tr valign="top">
	<td>Show link in sidebar to full page of testimonials</td>
	<td>
	<?php $sfs_showlink = get_option('sfs_showlink'); 
	if ($sfs_showlink == 'yes') { ?>
	<input type="checkbox" name="sfs_showlink" value="yes" checked />
	<?php } else { ?>
	<input type="checkbox" name="sfs_showlink" value="yes" />
	<?php } ?>
	</td>
	</tr>
	
	<tr valign="top">
	<td>Text for sidebar link (Read More, View All, etc)</td>
	<td><input type="text" name="sfs_linktext" value="<?php echo get_option('sfs_linktext'); ?>" /></td>
	</tr>

	<tr valign="top">
	<td>Testimonials page for sidebar link</td>
	<td> <select name="sfs_linkurl">
	 <option value="">
<?php echo attribute_escape(__('Select page')); ?></option> 
 <?php 
  $pages = get_pages(); 
  foreach ($pages as $pagg) {
  $pagurl = get_page_link($pagg->ID);
  $sfturl = get_option('sfs_linkurl');
  	if ($pagurl == $sfturl) {
		$option = '<option value="'.get_page_link($pagg->ID).'" selected>';
		$option .= $pagg->post_title;
		$option .= '</option>';
		echo $option;
	} else {
		$option = '<option value="'.get_page_link($pagg->ID).'">';
		$option .= $pagg->post_title;
		$option .= '</option>';
		echo $option;	
	}
  }
 ?>	</select></td>
	</tr>

	<tr valign="top">
	<td>Open client website in new window</td>
	<td>
	<?php $sfs_linkblank = get_option('sfs_linkblank'); 
	if ($sfs_linkblank == 'yes') { ?>
	<input type="checkbox" name="sfs_linkblank" value="yes" checked /> 
	<?php } else { ?>
	<input type="checkbox" name="sfs_linkblank" value="yes" /> 
	<?php } ?>
	</td>
	</tr>
	
	<tr valign="top">
	<td>Remove table when deactivating plugin</td>
	<td>
	<?php $sfs_deldata = get_option('sfs_deldata'); 
	if ($sfs_deldata == 'yes') { ?>
	<input type="checkbox" name="sfs_deldata" value="yes" checked /> (this will result in all data being deleted!)
	<?php } else { ?>
	<input type="checkbox" name="sfs_deldata" value="yes" /> (this will result in all data being deleted!)
	<?php } ?>
	</td>
	</tr>
	
	</table>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="sfs_showlink,sfs_linktext,sfs_linkurl,sfs_linkblank,sfs_deldata" />
	
	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	
	</form>
	
	</div>
<?php 
}


// +---------------------------------------------------------------------------+
// | Uninstall plugin                                                          |
// +---------------------------------------------------------------------------+

function sfstst_deactivate () {
	global $wpdb;

	$table_name = $wpdb->prefix . "testimonials";

	$sfs_deldata = get_option('sfs_deldata');
	if ($sfs_deldata == 'yes') {
		$wpdb->query("DROP TABLE {$table_name}");
		delete_option("sfs_showlink");
		delete_option("sfs_linktext");
		delete_option("sfs_linkurl");
		delete_option("sfs_linkblank");
		delete_option("sfs_deldata");
 	}
    delete_option("sfstst_version");
	unregister_sfstst_options();
	
}

// +---------------------------------------------------------------------------+
// | Show testimonials on page/post with shortcode [sfs-testimonials]          |
// +---------------------------------------------------------------------------+


/* show page of all testimonials */
function sfstst_showall() {
global $wpdb;
	$sfs_linkblank = get_option('sfs_linkblank');
	$table_name = $wpdb->prefix . "testimonials";
	$tstpage = $wpdb->get_results("SELECT testid,clientname,company,text_full,homepage FROM $table_name WHERE text_full !=''
	ORDER BY testid DESC");
	$retvalo = '';
	$retvalo .= '';
	$retvalo .= '<div id="sfstest-page">';

	foreach ($tstpage as $tstpage2) {
		if ($tstpage2->text_full != '') { // don't show blank testimonials
			$retvalo .= '<div class="text">';
			$retvalo .= nl2br(stripslashes($tstpage2->text_full)).'</div>';
				$retvalo .= '<div class="client">';
				if ($tstpage2->company != '') {
				$retvalo .= stripslashes($tstpage2->clientname).'<br/>';
					if ($tstpage2->homepage != '') {
						if ($sfs_linkblank == 'yes') {
							$retvalo .= '<a href="'.$tstpage2->homepage.'" target="_blank">'.stripslashes($tstpage2->company).'</a><br/>';
						} else {
							$retvalo .= '<a href="'.$tstpage2->homepage.'">'.stripslashes($tstpage2->company).'</a><br/>';
						}
					} else {
						$retvalo .= stripslashes($tstpage2->company).'<br/>';
					}
				} else {
					$retvalo .= stripslashes($tstpage2->clientname).'<br/>';
				}
				$retvalo .= '</div>';
			$retvalo .= '<div class="grayline"></div>';
		}
	}
	$retvalo .= '</div>';
return $retvalo;
}
function sys_showall() {
global $wpdb;
	$table_name = $wpdb->prefix . "testimonials";
	if (get_option('sfs_setlimit') == '') {
		$sfs_setlimit = 1;
	} else {
		$sfs_setlimit = get_option('sfs_setlimit');
	}
	$randone = $wpdb->get_results("SELECT testid, clientname, company, homepage, text_short FROM $table_name WHERE text_short !='' order by RAND() LIMIT $sfs_setlimit");

	$sys_testimonials='<div id="sfstest-sidebar">';
	
	foreach ($randone as $randone2) {
			
			$sys_testimonials.= '<blockquote>';
			$sys_testimonials.= '<p>';
			$sys_testimonials.= nl2br(stripslashes($randone2->text_short));
			$sys_testimonials.= '</p>';
	
			$sys_testimonials.= '<cite>';
			if ($randone2->company != '') {
			$sys_testimonials.= stripslashes($randone2->clientname).' / ';
				if ($randone2->homepage != '') {
					$sys_testimonials.= '<a href="'.$randone2->homepage.'" class="cite-link">'.stripslashes($randone2->company).'</a>';
				} else {
					$sys_testimonials.= stripslashes($randone2->company);
				}
		
			} else {
				$sys_testimonials.= stripslashes($randone2->clientname).'';
			}
			$sys_testimonials.= '</cite>';
			$sys_testimonials.= '</blockquote>';

		} // end loop
			$sfs_showlink = get_option('sfs_showlink');
			$sfs_linktext = get_option('sfs_linktext');
			$sfs_linkurl = get_option('sfs_linkurl');
			
				if (($sfs_showlink == 'yes') && ($sfs_linkurl !='')) {
					if ($sfs_linktext == '') { $sfs_linkdisplay = 'Read More'; } else { $sfs_linkdisplay = $sfs_linktext; }
					$sys_testimonials.= '<div class="sfststreadmore"><a href="'.$sfs_linkurl.'">'.$sfs_linkdisplay.'</a></div>';
				}
	 $sys_testimonials.='</div>';
return $sys_testimonials;
}
?>