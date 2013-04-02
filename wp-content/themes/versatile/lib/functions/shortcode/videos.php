<?php
/***  Video Shortcodes   ***/

function sys_youtube($atts, $content = null) {
	extract(shortcode_atts(array (
		'width' => '480',
		'height' => '385',
		'id' => '',
	), $atts));
$out.='<div class="video-stage" style="width:'.$width.'px; height:'.$height.'px">';
	$out.='<object width="'.$width.'" height="'.$height.'">';
	$out.='<param name="movie" value="http://www.youtube.com/v/'.$id.'?fs=1&amp;hl=en_US"></param>';
	$out.='<param name="allowFullScreen" value="true"></param>';
$out.='<param name="allowscriptaccess" value="always"></param>';
$out.='<embed src="http://www.youtube.com/v/'.$id.'?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'" wmode="opaque">';
$out.='</embed>';
$out.='</object>';
$out.="</div>";
return $out;
}
add_shortcode('youtube','sys_youtube');

function sys_vimeo($atts, $content = null) {
	extract(shortcode_atts(array (
		'width' => '480',
		'height' => '385',
		'id' => '',
	), $atts));

$out.='<div class="video-stage" style="width:'.$width.'px; height:'.$height.'px">';
	$out.='<object width="'.$width.'" height="'.$height.'">';
$out.='<param name="allowfullscreen" value="true" />';
$out.='<param name="allowscriptaccess" value="always" />';
$out.='<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id='.$id.'&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=00ADEF&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" />';
$out.='<embed src="http://vimeo.com/moogaloop.swf?clip_id='.$id.'&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=00ADEF&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="'.$width.'" height="'.$height.'" wmode="opaque">';
$out.='</embed>';
$out.='</object>';
$out.="</div>";
return $out;
}
add_shortcode('vimeo','sys_vimeo');
function sys_wordpresstv($atts, $content = null) {
	extract(shortcode_atts(array (
		'width' => '480',
		'height' => '385',
		'id' => '',
	), $atts));

$out.='<div class="video-stage" style="width:'.$width.'px; height:'.$height.'px">';
$out.='<embed type="application/x-shockwave-flash" src="http://s0.videopress.com/player.swf?v=1.02" width="'.$width.'" height="'.$height.'" wmode="transparent" seamlesstabbing="true" allowfullscreen="true" allowscriptaccess="always" overstretch="true" flashvars="guid='.$id.'" wmode="opaque"></embed>';
$out.="</div>";
return $out;
}
add_shortcode('wordpresstv','sys_wordpresstv');

function sys_bliptv($atts, $content = null) {
	extract(shortcode_atts(array (
		'width' => '480',
		'height' => '385',
		'id' => '',
	), $atts));

$out.='<div class="video-stage" style="width:'.$width.'px; height:'.$height.'px">';
	$out.='<embed src="http://blip.tv/play/'.$id.'" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" allowscriptaccess="always" allowfullscreen="true" wmode="opaque"></embed>';$out.="</div>";
return $out;
}
add_shortcode('bliptv','sys_bliptv');

function sys_googlevideo($atts, $content = null) {
	extract(shortcode_atts(array (
		'width' => '480',
		'height' => '385',
		'align' => '',
		'id' => '',
	), $atts));

$out.='<div class="video-stage '.$align.'" style="width:'.$width.'px; height:'.$height.'px">';
	$out.='<embed id=VideoPlayback src=http://video.google.com/googleplayer.swf?docid='.$id.'&hl=en&fs=true style=width:'.$width.'px;height:'.$height.'px allowFullScreen=true allowScriptAccess=always type=application/x-shockwave-flash wmode="opaque"> </embed>';
$out.="</div>";
return $out;
}
add_shortcode('googlevideo','sys_googlevideo');
?>