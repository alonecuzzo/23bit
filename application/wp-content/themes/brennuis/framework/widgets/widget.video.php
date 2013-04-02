<?php
/*******************************
 * Video Widget 
 *******************************/
class ln_video_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_video_widget() {
		
		$widget_ops = array('classname' => 'ln-video-widget',
							'description' => 'Show embedded video.' );
		
		$this->WP_Widget( 'ln_widget_video', 'Video Widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$title = $instance['title'];
		$src = $instance['src'];
		$height = $instance['height'];
		
		
		echo $before_widget;
		
		if(isset($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}
?>		

	<iframe height="<?php echo $height; ?>" src="<?php echo $src; ?>" frameborder="0" allowfullscreen></iframe>

<?php 	echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'src' => '', 'width' => 220, 'height' => 130) );
		$title = esc_attr($instance['title']);
		$src = esc_attr($instance['src']);
		$height = esc_attr($instance['height']);
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Video Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('src'); ?>"><?php _e('Video Source:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('src'); ?>" name="<?php echo $this->get_field_name('src'); ?>" type="text" value="<?php echo $src; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Video Height:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
        </p>	

<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['src']  = $new_instance['src'];
		$instance['height'] =  $new_instance['height'];	
        
		return $instance;
		
	}
	
}

?>