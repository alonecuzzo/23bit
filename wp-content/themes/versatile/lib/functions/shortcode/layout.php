<?php
/*** COLUMN LAYOUTS
------------------------------*/

function sys_one_half($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('one_half', 'sys_one_half');

function sys_one_third($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('one_third', 'sys_one_third');

function sys_two_third($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('two_third', 'sys_two_third');

function sys_one_fourth($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('one_fourth', 'sys_one_fourth');

function sys_three_fourth($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('three_fourth', 'sys_three_fourth');

function sys_one_fifth($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('one_fifth', 'sys_one_fifth');

function sys_two_fifth($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('two_fifth', 'sys_two_fifth');

function sys_three_fifth($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('three_fifth', 'sys_three_fifth');

function sys_four_fifth($atts, $content = null, $code) {
	return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
}
add_shortcode('four_fifth', 'sys_four_fifth');


function sys_one_half_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'sys_one_half_last');

function sys_one_third_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'sys_one_third_last');

function sys_two_third_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'sys_two_third_last');

function sys_one_fourth_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'sys_one_fourth_last');

function sys_three_fourth_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'sys_three_fourth_last');

function sys_one_fifth_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'sys_one_fifth_last');

function sys_two_fifth_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'sys_two_fifth_last');

function sys_three_fifth_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'sys_three_fifth_last');

function sys_four_fifth_last($atts, $content = null, $code) {
	return '<div class="'.str_replace('_last','',$code).' last">' . do_shortcode(trim($content)) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'sys_four_fifth_last');
?>