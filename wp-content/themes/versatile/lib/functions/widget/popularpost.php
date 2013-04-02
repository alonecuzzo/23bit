<?php
/**------------------------------------------
* Popular Post Widget Settings.
*-------------------------------------------*/
wp_reset_query();
function popular_widgets() {
	register_widget( 'popular_widgets' );
}
class popular_widgets extends WP_Widget {
function popular_widgets() {
global $themename;
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'popular_widget', 'description' => __('Use this widget to display Popular Posts by tags, Thumbnail Enable/Disable.', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'popular_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'popular_widget',$themename.'-Popular Posts', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$popular_imagedisable = $instance['popular_imagedisable'];
        $popular_limits = $instance['popular_limits'];
        $popular_title = $instance['popular_title'];
 		$popular_select = $instance['popular_select'];
 		$popular_description_length = $instance['popular_description_length'];
		if($popular_title =='') { $popular_title = "Popular Posts"; };
				
		/* Before widget (defined by themes). */
$before_title='<h3>';
$after_title='</h3>';
$before_widget='<div class="widget_postslist">';
$after_widget='</ul></div>';
?>
<?php 
echo $before_widget;
echo $before_title.$popular_title.$after_title;
global $post;
global $wpdb;
$show_pass_post = false; $duration='';
$request = "SELECT ID, post_title,post_date,post_content, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
if(!$show_pass_post) $request .= " AND post_password =''";
if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
}
$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $popular_limits";
$popular_posts = $wpdb->get_results($request);
echo "<ul>";
	foreach($popular_posts as $post) {
 if($post){ 
		echo "<li>";
       	$post_date = $post->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
              	$post_content=wp_html_excerpt($post->post_content,$popular_description_length);
				if($popular_imagedisable != "true")
	if (has_post_thumbnail($post->ID) ):
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true);
?>
<a class="thumb" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>">
<?php $timthumboption=get_option('timthumboption'); if($timthumboption == "enable") { ?>
<img class="thinframe" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=40&amp;h=40&amp;zc=1&amp;q=100" alt="" />
<?php }else{ echo get_the_post_thumbnail($post->ID,'post_thumb',array('class' =>'thinframe'));  } ?>
</a>		
<?php else:?>
			<a class="thumb" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>">		<img class="thinframe" src="<?php echo bloginfo('template_url'); ?>/images/no-image.jpg"  width="40" height="40" title="<?php $post->post_title;?>" alt="<?php $post->post_title;?>"/></a>
<?php endif;//end has_post_thumbnail ?>	
<a class="title" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>">
<?php echo $post->post_title ?></a>
<?php if($popular_select == 'time'):?>
<span class="wpldate"><?php echo $post_date; ?></span>
<?php else:?>
<p><?php echo $post_content; ?>...</p>
<?php endif;//end Description Length ?>


	<?php
	echo "</li>";
				} }
	echo $after_widget;
?>
<?php
	/* After widget (defined by themes). */

}
/**
 * Update the widget settings.
 */
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	/* Strip tags for title and name to remove HTML (important for text inputs). */
	$instance['popular_title'] = strip_tags( $new_instance['popular_title'] );
	$instance['popular_imagedisable'] = strip_tags( $new_instance['popular_imagedisable'] );
$instance['popular_limits'] = strip_tags( $new_instance['popular_limits'] );
$instance['popular_select'] = strip_tags( $new_instance['popular_select'] );
$instance['popular_description_length'] = strip_tags( $new_instance['popular_description_length'] );

	return $instance;
	}

function form( $instance ) {
	/* Set up some default widget settings. */


$popular_select = isset( $instance['popular_select'] ) ? $instance['popular_select'] : 'time';
		
	

		if ( !isset($instance['popular_description_length']) || !$popular_description_length = (int) $instance['popular_description_length'] )
			$popular_description_length = 60;
			
				if ( !isset($instance['popular_limits']) || !$popular_limits = (int) $instance['popular_limits'] )
			$popular_limits = 3;
 ?>

<!-- Widget Title: Text Input -->
<p>
<label for="<?php echo $this->get_field_id( 'popular_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'popular_title' ); ?>" name="<?php echo $this->get_field_name( 'popular_title' ); ?>" value="<?php echo $instance['popular_title']; ?>" type="text" style="width:100%;" />
</p>

<p><label for="<?php echo $this->get_field_id( 'popular_select' ); ?>"><?php _e('Extra Information:', 'example'); ?></label>
<select id="<?php echo $this->get_field_id( 'popular_select' ); ?>" name="<?php echo $this->get_field_name( 'popular_select' ); ?>">
<option value="time" <?php selected($popular_select,'time');?>>Time</option>
<option value="descrption" <?php selected($popular_select,'descrption');?>>Descrption</option>

</select>


</p>
<p>
<label for="<?php echo $this->get_field_id( 'popular_description_length' ); ?>"><?php _e('Length of Description to show::', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'popular_description_length' ); ?>" name="<?php echo $this->get_field_name( 'popular_description_length' ); ?>" value="<?php echo $popular_description_length; ?>" size="3" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'popular_limits' ); ?>"><?php _e('Number of posts to show:', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'popular_limits' ); ?>" name="<?php echo $this->get_field_name( 'popular_limits' ); ?>" value="<?php echo $popular_limits; ?>" size="3" />
</p>

<p>
<input type="checkbox" value="true" id="<?php echo $this->get_field_id( 'popular_imagedisable' ); ?>" name="<?php echo $this->get_field_name( 'popular_imagedisable' ); ?>" <?php  if( $instance['popular_imagedisable']=="true") { echo "checked"; } ?> class="checkbox" /> <label for="<?php echo $this->get_field_id( 'popular_imagedisable' ); ?>"><?php _e('Disable Post Thumbnail?', 'example'); ?></label>
</p>
<?php } }
add_action( 'widgets_init', 'popular_widgets' );

?>
