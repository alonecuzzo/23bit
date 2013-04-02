<?php

/**------------------------------------------
* Flickr Widget Settings.
*-------------------------------------------*/

function flickr_widgets() {
	register_widget( 'flickr_widgets' );
}
class flickr_widgets extends WP_Widget {

	function flickr_widgets() {
	global $themename;
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'flickr_widget', 'description' => __('Use this widget to display your flickr gallery.', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'flickr_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'flickr_widget',$themename.'-Flickr Photos', $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
	
		/* Our variables from the widget settings. */
		$flickr_id = $instance['flickr_id'];
        $flickr_limits = $instance['flickr_limits'];
        $flickr_title = $instance['flickr_title'];
				
		/* Before widget (defined by themes). */
$before_title='<h3>';
$after_title='</h3>';
$before_widget='<div class="syswidget_flickr">';
$after_widget='<div class="clear"></div></div>';
?>
<?php echo $before_widget;?>
<?php echo $before_title.$flickr_title.$after_title;?>
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_limits; ?>&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>

<?php
	/* After widget (defined by themes). */
	echo $after_widget;
}
/**
 * Update the Flickr widget settings.
 */
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	/* Strip tags for title and name to remove HTML (important for text inputs). */
	$instance['flickr_title'] = strip_tags( $new_instance['flickr_title'] );
	$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
	$instance['flickr_limits'] = strip_tags( $new_instance['flickr_limits'] );

	return $instance;
	}

function form( $instance ) {
	/* Set up some default widget settings. */
 ?>

<!-- Widget Title: Text Input -->
<p>
<label for="<?php echo $this->get_field_id( 'flickr_title' ); ?>"><?php _e('Title:', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'flickr_title' ); ?>" name="<?php echo $this->get_field_name( 'flickr_title' ); ?>" value="<?php echo $instance['flickr_title']; ?>" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e('Flickr ID: <small>find your Id from <a href="http://idgettr.com" target="_blank">idGettr</a></small>', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php echo $instance['flickr_id']; ?>" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'flickr_limits' ); ?>"><?php _e('How many photos you would like to display?:', 'example'); ?></label>
<input type="text" id="<?php echo $this->get_field_id( 'flickr_limits' ); ?>" name="<?php echo $this->get_field_name( 'flickr_limits' ); ?>" value="<?php echo $instance['flickr_limits']; ?>" style="width:100%;" />
</p>

	
<?php } } 
add_action( 'widgets_init', 'flickr_widgets' );
?>
