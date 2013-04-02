<?php
/*** POPULAR POSTS WIDGET
###############################################*/
function sys_popular_posts ($atts, $content = null) {
	extract(shortcode_atts(array(
	    'count'      => '2',
		'thumb'		 =>'true',
  ), $atts));

	$out .= '<div class="widget_postslist">';
	$out .= '<ul>';
	global $wpdb;
	$popular_limits=$count;
	$show_pass_post = false; $duration='';
	$request = "SELECT ID, post_title,post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
	if(!$show_pass_post) $request .= " AND post_password =''";
		if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
		}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $popular_limits";
$timthumboption=get_option('timthumboption');
	$popular_posts = $wpdb->get_results($request);
		foreach($popular_posts as $post) {
			if($post) {
				$out .= "<li>"; 
				$popular_image = get_post_meta($post->ID, 'post_image', true);
				$post_date = $post->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
				if($thumb == "true"){
$out .= '<a class="thumb" href="'.get_permalink($post->ID).'" title="'.$post->post_title.'">';
				if (has_post_thumbnail($post->ID) ){
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true);
 if($timthumboption == "enable") { 
			$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/timthumb.php?src=' .$image[0]. '&amp;w=40&amp;h=40&amp;zc=1&amp;q=100"  alt="' .$post->post_title. '"/>';
}else{ 	$out .= get_the_post_thumbnail($post->ID,'post_thumb',array('class' =>'thinframe'));  
}	
				}else{
			$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/images/no-image.jpg'.'" width="40" height="40" alt="' .$post->post_title. '"/>';
				}
				$out .= '</a>';
				}
$out .= '<span class="title"><a  href="' .get_permalink($post->ID). '" rel="bookmark">' .$post->post_title. '</a></span><br/>';
$out .=	'<span class="wpldate">'.$post_date.'</span>';
$out .="</li>";
	}
}
$out .= '</ul></div>';
return $out;
}
add_shortcode('popularpost','sys_popular_posts');
?>