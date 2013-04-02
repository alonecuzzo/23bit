<?php
/*** TOGGLE
------------------------------*/
function sys_toggle_content( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'heading'      => '',
    ), $atts));
	
	$out .= '<h4 class="toggle"><a href="#">' .$heading. '</a></h4>';
	$out .= '<div class="toggle_content" style="display: none;">';
	$out .= '<div class="toggleinside">';
	$out .= do_shortcode($content);
	$out .= '</div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('toggle_content', 'sys_toggle_content');

/*** FANCY TOGGLE
------------------------------*/
function sys_fancy_toggle_content( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'heading'      => '',
    ), $atts));
	$out .= '<div class="fancytoggle">';
	$out .= '<h4 class="toggle"><a href="#">' .$heading. '</a></h4>';
	$out .= '<div class="toggle_content" style="display: none;">';
	$out .= '<div class="toggleinside">';
	$out .= do_shortcode($content);
	$out .= '</div></div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('fancy_toggle_content', 'sys_fancy_toggle_content');

/*** TABS
------------------------------*/
function sys_tabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out .= '<div class="systabspane">';
	
	$out .= '<ul class="tabs">';
	foreach ($atts as $tab) {
		$out .= '<li><a href="#">' .$tab. '</a></li>';
	}
	$out .= '</ul>';

	$out .= do_shortcode($content) .'</div><div class="clear"></div>';
	
	return $out;
	
}
add_shortcode('tabs', 'sys_tabs');

/*** TAB PANES
------------------------------*/
function tabpanes( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out .= '<div class="tab_content">' . do_shortcode($content) .'</div>';

	return $out;
}
add_shortcode('tab', 'tabpanes');
?>