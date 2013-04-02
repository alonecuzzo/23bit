<?php


/*** FANCY BOX
------------------------------*/
function sys_fancy_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'bgcolor'      => '#4d4d4d',
		'title'      => '',
		'heading'	=> '',
		'ribbon'	=> '',
		'titlecolor'	=> '',
    ), $atts));
	if ($ribbon) { 
		$home = get_option('home');
		$rimage = '<div class="ribbon"><img src="'.get_template_directory_uri().'/images/ribbons/'.$ribbon.'.png" alt=""/></div>';} 
	$out .= '<div class="fancybox">';
	$out .= ''.$rimage.'';
	if($title){
	$out .= '<h4 class="fancytitle" style="background-color: ' .$bgcolor. '; color:' .$titlecolor. ';">' .$title. '</h4>';
	}
	$out .= '<div class="boxcontent">';
	if($heading){
	$out .= '<div class="bigtitle">' .$heading. '</div>';
	}
	$out .= do_shortcode($content) .'</div></div>';
	
	return $out;
	
}
add_shortcode('fancy_box', 'sys_fancy_box');

/*** MINIMAL BOX
------------------------------*/
function sys_minimal_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'bgcolor'      => '#4d4d4d',
		'title'      => '',
		'heading'	=> '',
		'ribbon'	=> '',
    ), $atts));
	
	if ($ribbon) { 
		$home = get_option('home');
		$rimage = '<div class="ribbon"><img src="'.get_template_directory_uri().'/images/ribbons/'.$ribbon.'.png" alt=""/></div>';} 

	$out .= '<div class="minimalbox">';
	$out .= ''.$rimage.'';
	if($title){
	$out .= '<h2 class="minimaltitle">' .$title. '</h2>';
	}
	if($heading){	
	$out .= '<div class="bigtitle">' .$heading. '</div>';
	}
	$out .= '<div class="boxcontent">';
	$out .= do_shortcode($content) .'</div></div>';
	
	return $out;
	
}
add_shortcode('minimal_box', 'sys_minimal_box');

/*** FRAMED BOX
------------------------------*/
function sys_framed_box( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'bgcolor'      => '',
		'bordercolor'	=> '',
		'ribbon'	=> '',
    ), $atts));
	


$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
$bordercolor = $bordercolor?'border-color:'.$bordercolor.';':'';

	if( !empty($bordercolor) || !empty($bgcolor)){
		$extras = ' style="'.$bgcolor.$bordercolor.'"';
	}else{
		$extras = '';
	}

	if ($ribbon) { 
		$home = get_option('home');
		$rimage = '<div class="ribbon"><img src="'.get_template_directory_uri().'/images/ribbons/'.$ribbon.'.png" alt=""/></div>';} 

	$out .= '<div class="framedbox" '.$extras.'>';
	$out .= ''.$rimage.'';
	$out .= '<div class="boxcontent">';
	$out .= do_shortcode($content);
	$out .= "</div>";
	$out .= "</div>";
	
	return $out;
	
}
add_shortcode('framed_box', 'sys_framed_box');
?>