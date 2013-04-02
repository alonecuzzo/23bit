<?php


/*** RECENT POSTS WIDGET
------------------------------*/
function sys_recent_posts ($atts, $content = null) {

	extract(shortcode_atts(array(
	    'count'      => '2',
        'cat_id'      =>'5',
		'thumb'		=>'true',	
        
    ), $atts));
		$out .= '<div class="widget_postslist">';
	$out .= '<ul>';
global $post;
global $wpdb;
$myposts = get_posts("numberposts=$count&offset=0&cat=$cat_id");

foreach($myposts as $post) {
	$out .= "<li>"; 
	
				$post_date = $post->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
				if($thumb == "true"){
		$out .= '<a class="thumb" href="'.get_permalink($post->ID).'" title="'.$post->post_title.'">';
				if (has_post_thumbnail($post->ID) ){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true);
$timthumboption=get_option('timthumboption'); if($timthumboption == "enable") { 
	$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/timthumb.php?src=' .$image[0]. '&amp;w=40&amp;h=40&amp;zc=1&amp;q=100"  alt="' .$post->post_title. '"/>';
}else{ 	$out .= get_the_post_thumbnail($post->ID,'post_thumb',array('class' =>'thinframe'));  
}		
				}else{
				$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/images/no-image.jpg'.'" width="40" height="40" alt="' .$post->post_title. '"/>';	
				}
				$out .= '</a>';
				}	
	$out .= '<span class="title"><a  href="' .get_permalink($post->ID). '" rel="bookmark">' .$post->post_title. '</a></span><br/>';
$out.=	'<span class="wpldate">'.$post_date.'</span>';	
		$out .="</li>";
		}

$out .= '</ul></div>';
	return $out;
}
add_shortcode('recentpost','sys_recent_posts');
?>