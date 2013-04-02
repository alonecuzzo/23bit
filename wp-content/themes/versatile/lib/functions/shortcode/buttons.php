<?php

function sys_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '',
        'linktarget'      => '',
		'color' => '',
		'align' =>	'',
        'bgcolor'      => '',
		'hoverbgcolor' => '',
		'hovertextcolor' => '',
		'textcolor' => '',
        'size'      => 'medium',	
    ), $atts));
	$hoverbgcolor = $hoverbgcolor?($bgcolor?' btn-bg="'.$bgcolor.'"':'').' btn-hoverBg="'.$hoverbgcolor.'"':'';
	$hovertextcolor = $hovertextcolor?($textcolor?' btn-color="'.$textcolor.'"':'').' btn-hoverColor="'.$hovertextcolor.'"':'';
	$bgcolor = $bgcolor?' style="background-color:'.$bgcolor.'"':'';
	$color = $color?' '.$color:'';
	$link = $link?' href="'.$link.'"':'';
	$linktarget = $linktarget?' target="'.$linktarget.'"':'';
	$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
	$button="button";
	$content = "<a $link $linktarget $bgcolor $hoverbgcolor class=\"$align $button $size $color\"><span $textcolor>" .trim($content). "</span></a>";
	if($align === 'center'){
		return '<p class="center">'.trim($content).'</p>';
	}else {
		return trim($content);	
	}
    
}
add_shortcode('button', 'sys_button');

/*** MORE LINK
------------------------------*/

function sys_external_link( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'url'      => '#',
        'target'      => '_self',
    ), $atts));
	$out = "<a href=\"" .$url. "\" target=\"" .$target. "\" class=\"more-link\">" .do_shortcode($content). "</a>";
    return $out;
}
add_shortcode('external_link', 'sys_external_link');

/*** FANCY BUTTONS
------------------------------*/
function sys_email_me( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'emailid'      => '#',
    ), $atts));
	$out = "<a href=\"mailto:" .$emailid. "\" class=\"email-me\">" .do_shortcode($content). "</a>";
    return $out;
}
add_shortcode('email_me', 'sys_email_me');

function sys_download_link( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
    ), $atts));
	$out = "<a href=\"" .$link. "\" class=\"downloadlink\">" .do_shortcode($content). "</a>";
    return $out;
}
add_shortcode('download_link', 'sys_download_link');
?>