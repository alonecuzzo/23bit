<?php

/**------------------------------------------
* Twitter  Widget Settings.
*-------------------------------------------*/
function sys_twitter_widgets() {
	register_widget('sys_twitter_widget');
}

class sys_twitter_widget extends WP_Widget {
function sys_twitter_widget() {
	global $themename;
		/* Widget settings. */ 
		$widget_ops = array( 'classname' => 'sys_twitter_widget', 'description' => __('Use this widget to display the latest tweet from twitter', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'sys_twitter_widget' );

		/* Create the widget. */
		$this->WP_Widget('sys_twitter_widget',$themename.'-twitter', $widget_ops, $control_ops );
	}


	function widget($args,$instance ) {
		extract( $args );
		$sys_twitter_username = $instance['sys_twitter_username'];
		$sys_twitter_title = $instance['sys_twitter_title'];
		$sys_twitter_limits = $instance['sys_twitter_limits'];

		$before_title='</h3>';
		$after_title='<h3>';
		echo $before_widget='<div class="syswidget">';
		echo $after_title .$sys_twitter_title.$before_title;
		echo parse_cache_feed($sys_twitter_username, $sys_twitter_limits);
		echo $after_widget='</div><div class="clear"></div>';
	}

/**
* Update  Settings
*/

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	/* Strip tags for title and name to remove HTML (important for text inputs). */
	
	$instance['sys_twitter_username'] = strip_tags( $new_instance['sys_twitter_username'] );
	$instance['sys_twitter_limits'] = strip_tags( $new_instance['sys_twitter_limits'] );
	$instance['sys_twitter_title'] = strip_tags( $new_instance['sys_twitter_title'] );
	return $instance;
}

function form( $instance ) {

?>

<!-- Twitter Widget Inputs -->
<p>
<label for="<?php echo $this->get_field_id( 'sys_twitter_title' ); ?>"><?php _e('Twitter Title:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'sys_twitter_title' ); ?>" name="<?php echo $this->get_field_name( 'sys_twitter_title' ); ?>" value="<?php echo $instance['sys_twitter_title']; ?>" type="text" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'sys_twitter_username' ); ?>"><?php _e('Twitter Username:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'sys_twitter_username' ); ?>" type="text" name="<?php echo $this->get_field_name( 'sys_twitter_username' ); ?>" value="<?php echo $instance['sys_twitter_username']; ?>" style="width:100%;" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'sys_twitter_limits' ); ?>"><?php _e('Twitter Limits:', 'example'); ?></label>
<input id="<?php echo $this->get_field_id( 'sys_twitter_limits' ); ?>" type="text" name="<?php echo $this->get_field_name( 'sys_twitter_limits' ); ?>" value="<?php echo $instance['sys_twitter_limits']; ?>" style="width:100%;" />
</p>

<?php } } 
add_action( 'widgets_init', 'sys_twitter_widgets' );
?>