<?php
/*** CONTACT FORM WIDGET
###############################################*/

function syswidget_contact_form( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'email'      => '',
     ), $atts));

	$name_str = __('Name *','versatile_front');
	$email_str = __('Email *','versatile_front');
	$submit_str = __('Submit','versatile_front');

	global $wpdb;
	$out.='<div id="result"></div>';
	$out.='<div class="syswidget sysform">';
	$out .= '<form action="'.get_template_directory_uri().'/lib/includes/submitform.php" id="validate_form" method="post">';
	$out .= '<p><input type="text" size="20" name="contact_name" class="txt required"><label>'.$name_str.'</label></p>';
	$out .= '<p><input type="text" size="20" name="contact_email" class="txt required"><label>'.$email_str.'</label></p>';
	$out .= '<p><textarea name="contactcomment" class="required"></textarea></p>';
	$out .= "<p><button name=\"contactsubmit\" class=\"button small gray\"><span> ".__('Send','versatile_front')."</span></button></p>";
	$out .= '<input type="hidden" name="contact_check" value="checking">';
	$out .= '<input type="hidden" name="contact_widgetemail" value="'.$email.'">';
	$out .= '</form>';
	$out.='</div>';
  return $out;
}
add_shortcode('contact_form', 'syswidget_contact_form');
?>