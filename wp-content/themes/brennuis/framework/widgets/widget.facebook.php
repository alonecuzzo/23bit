<?php
/*******************************
 * Facebook Widget 
 *******************************/
class ln_facebook_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_facebook_widget() {
		
		$widget_ops = array('classname' => 'ln-facebook-widget',
							'description' => 'Facebook Like Box Widget' );
		
		$this->WP_Widget( 'ln_widget_facebook', 'Facebook Widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$title = $instance['title'];
		$fb_page_url = $instance['fb_page_url'];
		$fb_height = $instance['fb_height'];
		$fb_show_faces = $instance['fb_show_faces'];
		$fb_show_stream = $instance['fb_show_stream'];
		$fb_show_header = $instance['fb_show_header'];
			
		$show_faces_checked = 'false';
		$show_stream_checked = 'false';
		$show_header_checked = 'false';

		if($fb_show_faces == 'on'){
			$show_faces_checked = 'true';
		}

		if($fb_show_stream == 'on'){
			$show_stream_checked = 'true';
		}

		if($fb_show_header == 'on'){
			$show_header_checked = 'true';
		}

		echo $before_widget;
		
		if(isset($title) && !empty($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}
		
		$fb_width = 300;
		
?>		
	<div class="widget-ln-facebook ln-facebook-wrap"> 
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo $fb_page_url ?>&amp;width=<?php echo $fb_width; ?>&amp;height=<?php echo $fb_height; ?>&amp;colorscheme=light&amp;show_faces=<?php echo $fb_show_faces; ?>&amp;border_color=%23ddd&amp;stream=<?php echo $show_stream_checked; ?>&amp;header=<?php echo $show_header_checked; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $fb_width; ?>px; height:<?php echo $fb_height; ?>px;" allowTransparency="true"></iframe>
	</div>
	
<?php 	
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'fb_height' => '335', 'fb_page_url' => '', 'fb_show_faces' => 'on', 'fb_show_stream' => '', 'fb_show_header' => '') );
		
		$title = esc_attr($instance['title']);
		$fb_height = esc_attr($instance['fb_height']);
		$fb_page_url = esc_attr($instance['fb_page_url']);
		$fb_show_faces = esc_attr($instance['fb_show_faces']);
		$fb_show_stream = esc_attr($instance['fb_show_stream']);
		$fb_show_header = esc_attr($instance['fb_show_header']);
		
		$show_faces_checked = '';
		$show_stream_checked = '';
		$show_header_checked = '';

		if($fb_show_faces == 'on'){
			$show_faces_checked = 'checked=checked';
		}

		if($fb_show_stream == 'on'){
			$show_stream_checked = 'checked=checked';
		}

		if($fb_show_header == 'on'){
			$show_header_checked = 'checked=checked';
		}
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('fb_page_url'); ?>"><?php _e('Facebook Page name:', 'framework'); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id('fb_page_url'); ?>" name="<?php echo $this->get_field_name('fb_page_url'); ?>" type="text" value="<?php echo $fb_page_url; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('fb_height'); ?>"><?php _e('Height:', 'framework'); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id('fb_height'); ?>" name="<?php echo $this->get_field_name('fb_height'); ?>" type="text" value="<?php echo $fb_height; ?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('fb_show_faces'); ?>"><?php _e('Show faces:', 'framework'); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id('fb_show_faces'); ?>" name="<?php echo $this->get_field_name('fb_show_faces'); ?>" type="checkbox" <?php echo $show_faces_checked; ?>/>
        </p>
         <p>
        	<label for="<?php echo $this->get_field_id('fb_show_stream'); ?>"><?php _e('Show Stream:', 'framework'); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id('fb_show_stream'); ?>" name="<?php echo $this->get_field_name('fb_show_stream'); ?>" type="checkbox" <?php echo $show_stream_checked; ?>/>
        </p>
         <p>
        	<label for="<?php echo $this->get_field_id('fb_show_header'); ?>"><?php _e('Show Header:', 'framework'); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id('fb_show_header'); ?>" name="<?php echo $this->get_field_name('fb_show_header'); ?>" type="checkbox" <?php echo $show_header_checked; ?>/>
        </p>
        

<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['fb_height'] = strip_tags($new_instance['fb_height']);
		$instance['fb_page_url'] = esc_attr($new_instance['fb_page_url']);
		$instance['fb_show_faces'] = esc_attr($new_instance['fb_show_faces']);
		$instance['fb_show_stream'] = esc_attr($new_instance['fb_show_stream']);
		$instance['fb_show_header'] = esc_attr($new_instance['fb_show_header']);
		
		return $instance;
		
	}
	
}

?>