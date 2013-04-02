<?php

/**------------------------------------------
* Recent Post Widget Settings.
*-------------------------------------------*/

function recentpost_widgets() {
	register_widget( 'recentpost_widgets' );
}
class recentpost_widgets extends WP_Widget {

	function recentpost_widgets() {
		global $themename;
		$widget_ops = array( 'classname' => 'recentpost_widget', 'description' => __('Use this widget to display Recent Posts, Thumbnail Enable/Disable.', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recentpost_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'recentpost_widget',$themename.'-Recent Posts', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$recentpost_imagedisable = $instance['recentpost_imagedisable'];
        $recentpost_limits = $instance['recentpost_limits'];
        $recentpost_title = $instance['recentpost_title'];
		$recentpost_excludecategory=$instance['recentpost_excludecategory'];
		$recentpost_select = $instance['recentpost_select'];
 		$recentpost_description_length = $instance['recentpost_description_length'];
		if($recentpost_title =='') { $recentpost_title = "Recent Posts"; };

		$before_title='<h3>';
		$after_title='</h3>';
		$before_widget='<div class="widget_postslist">';
		$after_widget='</ul></div>';
?>
<?php echo $before_widget;
echo $before_title.$recentpost_title.$after_title;
global $post;
global $wpdb;
$recentpost =get_posts("cat=$recentpost_excludecategory&numberposts=$recentpost_limits&offset=0"); 
echo "<ul>"; $timthumboption=get_option('timthumboption');
	foreach($recentpost as $post) {
	echo "<li>"; 

	$recentpost_image = get_post_meta($post->ID, 'post_image', true);

	$post_date = $post->post_date;
	$post_date = mysql2date('F j, Y', $post_date, false);
	$recentpost_content= wp_html_excerpt($post->post_content,$recentpost_description_length);
	if($recentpost_imagedisable != "true")
	if (has_post_thumbnail($post->ID) ):
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', true);
?>

<a class="thumb" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>"><?php  if($timthumboption == "enable") { ?>
<img class="thinframe" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=40&amp;h=40&amp;zc=1&amp;q=100" alt="" />
<?php }else{ echo get_the_post_thumbnail($post->ID,'post_thumb',array('class' =>'thinframe'));  } ?>
</a>
<?php else:?><a class="thumb" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>">
					<img class="thinframe" src="<?php echo bloginfo('template_url'); ?>/images/no-image.jpg"  width="40" height="40" title="<?php the_title();?>" alt="<?php echo $post->post_title ?>"/></a>
<?php endif;//end has_post_thumbnail ?>

<a class="title" href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>"> <?php echo $post->post_title ?></a>

<?php if($recentpost_select == 'time'):?>
	<span class="wpldate"><?php echo $post_date; ?></span>
<?php else:?>
<p><?php echo $recentpost_content; ?>...</p>
<?php endif;//end Description Length ?>
<?php echo "</li>";
}
echo $after_widget;
}
/**
 * Update settings.
 */
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	/* Strip tags for title and name to remove HTML (important for text inputs). */
	$instance['recentpost_title'] = strip_tags( $new_instance['recentpost_title'] );
	$instance['recentpost_imagedisable'] = strip_tags( $new_instance['recentpost_imagedisable'] );
	$instance['recentpost_limits'] = strip_tags( $new_instance['recentpost_limits'] );
	$instance['recentpost_excludecategory'] = strip_tags( $new_instance['recentpost_excludecategory'] );
	$instance['recentpost_select'] = strip_tags( $new_instance['recentpost_select'] );
	$instance['recentpost_description_length'] = strip_tags( $new_instance['recentpost_description_length'] );
	return $instance;
	}

function form( $instance ) {
	$recentpost_select = isset( $instance['recentpost_select'] ) ? $instance['recentpost_select'] : 'time';
	if ( !isset($instance['recentpost_description_length']) || !$recentpost_description_length = (int) $instance['recentpost_description_length'] )
	$recentpost_description_length = 60;
			
	if ( !isset($instance['recentpost_limits']) || !$recentpost_limits = (int) $instance['recentpost_limits'] )
	$recentpost_limits = 3;
 ?>
<p>
<label for="<?php echo $this->get_field_id( 'recentpost_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'recentpost_title' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_title' ); ?>" value="<?php echo $instance['recentpost_title']; ?>" type="text" style="width:100%;" />
</p>

<p><label for="<?php echo $this->get_field_id( 'recentpost_select' ); ?>"><?php _e('Extra Information:', 'example'); ?></label>
<select id="<?php echo $this->get_field_id( 'recentpost_select' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_select' ); ?>">
<option value="time" <?php selected($recentpost_select,'time');?>>Time</option>
<option value="descrption" <?php selected($recentpost_select,'descrption');?>>Descrption</option>
</select>
</p>

<p>
<label for="<?php echo $this->get_field_id( 'recentpost_description_length' ); ?>"><?php _e('Length of Description to show::', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'recentpost_description_length' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_description_length' ); ?>" value="<?php echo $recentpost_description_length; ?>" size="3" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'recentpost_limits' ); ?>"><?php _e('Number of posts to show:', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'recentpost_limits' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_limits' ); ?>" value="<?php echo $recentpost_limits; ?>" size="3" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'recentpost_excludecategory' ); ?>"><?php _e('Exclude Categories <small>2,3,25</small>', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'recentpost_excludecategory' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_excludecategory' ); ?>" value="<?php echo $instance['recentpost_excludecategory']; ?>" style="width:100%;" />
</p>

<p>
<input type="checkbox" value="true" id="<?php echo $this->get_field_id( 'recentpost_imagedisable' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_imagedisable' ); ?>" <?php  if( $instance['recentpost_imagedisable']=="true") { echo "checked"; } ?> class="checkbox" /> <label for="<?php echo $this->get_field_id( 'recentpost_imagedisable' ); ?>"><?php _e('Disable Post Thumbnail?', 'example'); ?></label>
</p>
<?php } }
add_action( 'widgets_init', 'recentpost_widgets' );
wp_reset_query();
 ?>