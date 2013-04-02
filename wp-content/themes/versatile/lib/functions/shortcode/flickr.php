<?php
/*** FLICKR WIDGET
------------------------------*/
function sys_flickr ($atts, $content= null){

	extract(shortcode_atts(array(
	    'count'     => '5',
        'id'      =>'8241331@N04',
		'display'	=> 'latest',
		'size'		=> 's',
		'layout'	=>'x',	        
    ), $atts));
	

	$out .= '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' .$count. '&amp;display=' .$display. '&amp;size=' .$size. '&amp;layout=x&amp;source=user&amp;user=' .$id. '"></script>';

	
   return $out;
}
add_shortcode('flickr', 'sys_flickr');
?>