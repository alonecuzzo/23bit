<?php
/*** GENERAL
------------------------------*/

function sys_divider( $atts, $content = null ) {
   return '<div class="divider"></div>';
}
add_shortcode('divider', 'sys_divider');

function sys_divider_top( $atts, $content = null ) {
   return '<div class="divider top"><a href="#">'.__('Top','versatile_front').'</a></div>';
}
add_shortcode('divider_top', 'sys_divider_top');

function sys_divider_space( $atts, $content = null ) {
   return '<div class="divider_space"></div>';
}
add_shortcode('divider_space', 'sys_divider_space');

function sys_divider_line( $atts, $content = null ) {
   return '<div class="divider_line"></div>';
}
add_shortcode('divider_line', 'sys_divider_line');

function sys_clear( $atts, $content = null ) {
   return '<div class="clear"></div>';
}
add_shortcode('clear', 'sys_clear');

/*** TEXT HIGHLIGHTS
------------------------------*/

function sys_highlight($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'bgcolor' => '',
		'textcolor' => '',
	), $atts));
$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
$textcolor = $textcolor?'color:'.$textcolor.';':'';

	if( !empty($textcolor) || !empty($bgcolor)){
		$extras = ' style="'.$bgcolor.$textcolor.'"';
	}else{
		$extras = '';
	}

	return '<span class="highlight" '.$extras.'>'.do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'sys_highlight');

function sys_fancy_heading( $atts, $content = null ) {
   return '<h6 class="fancyheading"><span>' . do_shortcode($content) . '</span></h6>';
}
add_shortcode('fancyheading', 'sys_fancy_heading');


/*** DROPCAPS
------------------------------*/

function sys_dropcap_1($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
        'textcolor'      => '',
	), $atts));

	$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $code.$color . '" '.$textcolor.'>' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'sys_dropcap_1');

function sys_dropcap_2($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
        'textcolor'      => '',
	), $atts));

	$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $code.$color . '" '.$textcolor.'>' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'sys_dropcap_2');

function sys_dropcap_3($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
        'textcolor'      => '',
	), $atts));

	$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $code.$color . '" '.$textcolor.'>' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap3', 'sys_dropcap_3');

function sys_dropcap_4($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
        'textcolor'      => '',
	), $atts));

	$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $code.$color . '" '.$textcolor.'>' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap4', 'sys_dropcap_4');


/*** BLOCKQUOTES
------------------------------*/

function sys_blockquote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
		'cite' => false,
	), $atts));
	
	return '<blockquote' . ($align ? ' class="align' . $align . '"' : '') . '><p>' . do_shortcode($content) .'</p>'. ($cite ? '<p><cite>- ' . $cite . '</cite></p>' : '') . '</blockquote>';
}
add_shortcode('blockquote', 'sys_blockquote');


/*** FANCY TABLE
------------------------------*/
function sys_fancy_table( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'headbgcolor'      => '',
    ), $atts));
	$content = str_replace('<table>', '<table class="fancy_table">', do_shortcode($content));
	return $content;
}
add_shortcode('fancy_table', 'sys_fancy_table');

/*** LISTS
------------------------------*/

function sys_list($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'color' => '',
	), $atts));

	if($style){
		$style = 'list-'.$style;
	}
	return str_replace('<ul>', '<ul class="'.$style.' '.$color.'">', do_shortcode($content));
}
add_shortcode('list', 'sys_list');

/*** ICONS
------------------------------*/

function sys_icons($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'url' => '',
	), $atts));

	if($style){
		$style = 'icon-'.$style;
	}
	if($url){
		$out .='<a class="'.$style.'" href="'.$url.'">'.do_shortcode($content).'</a>';
	}else {
		$out .='<span class="'.$style.'">'.do_shortcode($content).'</span>';
	}
	return $out;
}
add_shortcode('icon', 'sys_icons');


/*** GOOGLE CHART
------------------------------*/

function sys_chart($atts, $content = null) {
extract(shortcode_atts(array(
	    'data' => '',
	    'colors' => '',
	    'size' => '500x250',
	    'bg' => 'FFFFFF',
	    'title' => '',
	    'labels' => '',
	    'advanced' => '',
	    'type' => 'pie'
	), $atts));

	switch ($type) {
		case 'line' :
			$charttype = 'lc'; break;
		case 'xyline' :
			$charttype = 'lxy'; break;
		case 'sparkline' :
			$charttype = 'ls'; break;
		case 'meter' :
			$charttype = 'gom'; break;
		case 'scatter' :
			$charttype = 's'; break;
		case 'venn' :
			$charttype = 'v'; break;
		case 'pie' :
			$charttype = 'p3'; break;
		case 'pie2d' :
			$charttype = 'p'; break;
		default :
			$charttype = $type;
		break;
	}

	if ($title) $string .= '&chtt='.$title.'';
	if ($labels) $string .= '&chl='.$labels.'';
	if ($colors) $string .= '&chco='.$colors.'';
	$string .= '&chs='.$size.'';
	$string .= '&chd=t:'.$data.'';
	$string .= '&chf=bg,s,'.$bg.'';

	return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$charttype.''.$string.$advanced.'" alt="'.$title.'" />';
}
add_shortcode('chart','sys_chart');
?>