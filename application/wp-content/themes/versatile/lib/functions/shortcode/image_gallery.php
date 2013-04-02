<?php
//********************************** GALLERIA
function sys_galleria($atts, $content = null) {

	extract(shortcode_atts(array(
		'id'		=>'1',
	    'width'      => '600',
        'height'      =>'450',
		'autoplay'	 => '4000',
        'transition' => 'fade',
    ), $atts));
 $timthumboption=get_option("timthumboption");
sys_gal_scripts($height,$autoplay,$width,$id);
$out .=  '<div id="gal_content">';	
if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$content,$matches)){
$out .=  '<div id="galleria'.$id.'" style="width:' .$width. 'px; height:' .$height. 'px;">';

	foreach ($matches[0] as $images) {
		$timthumboption=get_option('timthumboption'); if($timthumboption == "enable") {	
		$out .= '<div><a href="'.get_template_directory_uri().'/timthumb.php?src=' .$images. '&amp;w=' .$width. '&amp;h=' .$height. '&amp;zc=1&amp;q=100">';	
		$out.='<img  src="'.get_template_directory_uri().'/timthumb.php?src=' .$images. '&amp;w=60&amp;h=40&amp;zc=1&amp;q=100" />';
	
			$out.='</a></div>';}else{

	$out .= '<div><a href="'.$images. '">';	
		$out.='<img  src="'.$images. '" width="'.$width.'" height="'.$height.'" />';
	
			$out.='</a></div>';

}
		}
		$out .=  '</div>';

		}
	$out .=  '</div>';
	
	return $out;
}
add_shortcode('galleria','sys_galleria');

//********************************** MINI GALLERY

function sys_gal_scripts($height,$autoplay,$width,$id) {
echo '<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($) {
$("#galleria'.$id.'").galleria({
	transition: "fade",
	autoplay:'.$autoplay.',
	height:'.$height.',
	image_crop: true
    });
});	
/* ]]> */
</script>';
}

function sys_images_mini_gallery( $atts, $content = null ) {
 $timthumboption=get_option("timthumboption");
    extract(shortcode_atts(array(
        'alt'      => '',
        'images'      => '',
		'width'		=>'',
		'height'	=>'',
    ), $atts));

if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$content,$matches)){
	$out .='<ul class="sys_mini_gallery">';
foreach ($matches[0] as $images) {

	$out .= '<li><div class="portimg"><div class="porthumb" style="height:'.$height.'px;"><a rel="prettyPhoto[mixed]" href="' .$images. '" >';
$timthumboption=get_option('timthumboption'); if($timthumboption == "enable") {
	$out .= '<img src="'.get_template_directory_uri().'/timthumb.php?src=' .$images. '&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100" alt="'.$alt.'" class="loading" />';
}else{
	$out .= '<img src="' .$images. '" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" class="loading" />';
}
	//$out.='<img class="image" src="'.get_template_directory_uri().'/timthumb.php?src=' .$images. '&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100" />';	
			$out.='</a></div></div>';
			$out.='<div class="drop_shadow"><img src="'.get_template_directory_uri().'/images/drop_shadow.png" width="'.$width.'"/></div></li>';

	}
	$out .='</ul><div class="clear"></div>';
	}
    return $out;
}

add_shortcode('images_mini_gallery', 'sys_images_mini_gallery');


//********************************** IMAGE FRAME

function sys_image($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'link' => '#',
		'lightbox' => 'false',
		'title' => '',
		'align' => false,
		'width' => false,
		'height' => false,
	), $atts));
	if(!$width||!$height){
		if(!$width){
			$width = '150';
		}
		if(!$height){
			$height = '150';
		}
	}
	$src = do_shortcode($content);
	$no_link = '';
	if($lightbox == 'true'){
	$lightbox_rel ="prettyPhoto[mixed]";
		if($link == '#'){
			$link = $src;
		}
	}else{
		if($link == '#'){
			$no_link = 'image_no_link';
		}
	}



$timthumboption=get_option('timthumboption'); if($timthumboption == "enable") {
	$content = '<img class="image" width="'.$width.'" '.((empty($height))?'':'height="'.$height.'"'). ' alt="'.$title.'" src="'.get_template_directory_uri().'/timthumb.php?src='.$src.((empty($height))?'':'&amp;w='. $width .'&amp;h='.$height).'&amp;zc=1&amp;q=100" />';
}else{
	$content = '<img class="image" width="'.$width.'" '.((empty($height))?'':'height="'.$height.'"'). ' alt="'.$title.'" src="'.$src.'" />';
}
	if($lightbox=="true") { $link=$src; }
		$out.='<div class="portimg '.($align?' align'.$align:'').'" style="width:'.$width.'px;'.((empty($height))?'':'height:'.$height.'px').'">';
		$out.='<div class="porthumb"><a  '.$atarget.''.$rel.' '.($no_link? ' class="'.$no_link.'"':'').' title="'.$title.'" href="'.$link.'">' . $content . '</a></div>';
		$out.='</div>';
return $out;
}
add_shortcode('image', 'sys_image');


//********************************** Photo FRAME

function sys_photoframe( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'alt'      => '',
        'src'      => '',
		'width'		=>'116',
		'height'	=>'116',
    ), $atts));
	
	$out .= "<div class=\"photo_frame\">";
$timthumboption=get_option('timthumboption'); if($timthumboption == "enable") {
	$out .= '<img src="'.get_template_directory_uri().'/timthumb.php?src=' .$src. '&amp;w='.$width.'&amp;h='.$height.'&amp;zc=1&amp;q=100" alt="'.$alt.'" class="loading" />';
}else{
	$out .= '<img src="' .$src. '" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" class="loading" />';
}
	$out .= "</div>";
    return $out;
}

add_shortcode('photoframe', 'sys_photoframe');

?>