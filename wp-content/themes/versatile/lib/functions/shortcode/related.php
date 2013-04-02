<?php

/*** Related Post
------------------------------*/

function sys_related_posts( $atts ) {
 
	extract(shortcode_atts(array(
	    'count' => '5',
		'thumb'		=>'true',
	), $atts));
 
	global $wpdb, $post, $table_prefix;
 
	if ($post->ID) {
		$out = '<div class="widget_postslist"><ul>';
 
		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
 
		// Do the query
		$q = "
			SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p
			WHERE tt.taxonomy ='post_tag'
				AND tt.term_taxonomy_id = tr.term_taxonomy_id
				AND tr.object_id  = p.ID
				AND tt.term_id IN ($tagslist)
				AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $count;";
 
		$related = $wpdb->get_results($q);
 
		if ( $related ) {
			foreach($related as $r) {
	$post_date = $r->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
	$out .= "<li>"; 
if(preg_match_all('!.+\.(?:jpe?g|png|gif)!Ui',get_post_meta($r->ID, 'post_image', true), $matches))
{
				$popular_image = get_post_meta($r->ID, 'post_image', true);
}
				if($thumb == "true"){
	$out .= '<a class="thumb" href="'.et_permalink($r->ID).'" title="'.$r->post_title.'">';
				if (has_post_thumbnail($post->ID) ){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true);
	$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/timthumb.php?src=' .$image[0]. '&amp;w=40&amp;h=40&amp;zc=1&amp;q=100"  alt="' .$r->post_title. '"/>';	
				}else{
				$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/images/no-image.jpg'.'" width="40" height="40" alt="' .$r->post_title. '"/>';	
				}
				$out .= '</a>';
				}	
		
			
		$out .= '<span class="title"><a  href="' .get_permalink($r->ID). '" rel="bookmark">' .$r->post_title. '</a></span><br/>';
$out.=$post_date;	
		$out .="</li>";	
			}
		} else {
	$myposts = get_posts("numberposts=$count&offset=1");

foreach($myposts as $post) {
	$out .= "<li>"; 
		$popular_image = get_post_meta($post->ID, 'post_image', true);
				$post_date = $post->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
				if($thumb == "true"){
			if (has_post_thumbnail($post->ID) ){
	$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true);	
		$out .= '<a class="thumb" href="' .get_permalink($post->ID). '" title="' .$post->post_title. '">';
		$timthumboption=get_option("timthumboption");
if($timthumboption== "enable"){
$out .= '<img class="thinframe" src='.get_template_directory_uri().'/timthumb.php?src=' .$image[0]. '&amp;w=40&amp;h=40&amp;zc=1&amp;q=100"  alt="' .$post->post_title. '"/></a>';
}
if($timthumboption== "enable"){
$out .= '<img width="40" height="40" class="thinframe" src=' .$popular_image. '  alt="' .$post->post_title. '"/></a>';
}
?>
				<?php }else{
 $out .= '<a class="thumb" href="' .get_permalink($post->ID). '" title="' .$post->post_title. '">'; 
$out .= '<img class="thinframe" src="'.get_template_directory_uri().'/images/no-image.jpg'.'" width="40" height="40" alt="' .$post->post_title. '"/></a>';	
?>
				<?php }} 
	$out .= '<span class="title"><a  href="' .get_permalink($post->ID). '" rel="bookmark">' .$post->post_title. '</a></span><br />';
$out.=$post_date;	
		$out .="</li>";
		}	

		}
		$out .= '</ul></div>';
		return $out;
	}
	wp_reset_query();
}
add_shortcode('related_posts', 'sys_related_posts');
?>