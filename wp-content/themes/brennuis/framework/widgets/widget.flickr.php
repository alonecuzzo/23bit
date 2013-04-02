<?php
/*******************************
 * Flickr Widget 
 *******************************/
class ln_flickr_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_flickr_widget() {
		
		$widget_ops = array('classname' => 'ln-flickr-widget',
							'description' => 'Show flickr images.' );
		
		$this->WP_Widget( 'ln_widget_flickr', 'Flickr Widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$title = $instance['title'];
		$source = $instance['source'];
		$user = $instance['user'];
		$number = $instance['number'];
		$display = $instance['display'];
		
		echo $before_widget;
		
		if(isset($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}
		
		
?>		
	<div class="widget-flickr ln-flickr-wrap"> 
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number ?>&amp;size=s&amp;layout=x&amp;display=<?php echo $display;?>&amp;source=<?php echo $source;?>&amp;<?php echo $source;?>=<?php echo $user ?>"></script>
	</div>
	
<?php 	
		
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'source' => 'user', 'user' => '', 'number' => 3, 'display' => 'latest') );
		$title = esc_attr($instance['title']);
		$user = esc_attr($instance['user']);
		$number = esc_attr($instance['number']);
		$source = esc_attr($instance['source']);
		$display = esc_attr($instance['display']);
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('source'); ?>"><?php _e('Select Source:', 'framework'); ?></label>
        	<select id="<?php echo $this->get_field_id('source'); ?>" name="<?php echo $this->get_field_name('source'); ?>">
        		<option value="user"  <?php if($source == 'user'){ echo 'selected="selected"'; } ?> ><?php _e('User', 'framework'); ?></option>
        		<option value="group" <?php if($source == 'group'){ echo 'selected="selected"'; } ?> ><?php _e('Group', 'framework'); ?></option>
        	</select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Flickr ID:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $user; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of photos:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display:', 'framework'); ?></label>
        	<select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
        		<option value="latest"  <?php if($display == 'latest'){ echo 'selected="selected"';} ?> ><?php _e('Latest', 'framework'); ?></option>
        		<option value="random" <?php if($display == 'random'){ echo 'selected="selected"';} ?> ><?php _e('Random', 'framework'); ?></option>
        	</select>
        </p>
        

<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['source'] = $new_instance['source'];
        $instance['user']  = $new_instance['user'];
		$instance['number'] = $new_instance['number'];
		$instance['display'] = $new_instance['display'];
		
		return $instance;
		
	}
	
}

?>