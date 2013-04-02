<?php
/*******************************
 * Widget Banner 300 
 *******************************/
class ln_banner_300_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_banner_300_widget() {
		
		$widget_ops = array('classname' => 'ln-medium-banner-widget',
							'description' => 'Ad Banner 300x250px' );
		
		$this->WP_Widget( 'ln_banner_300_widget', 'Banner 300', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$title = $instance['title'];
		$img = $instance['img'];
		$url = $instance['url'];
		
		echo $before_widget;
		
		if(isset($title) && !empty($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}
		
		
?>		
	<div class="ln-banner-300">
		<a class="no-eff" href="<?php echo $url;?>" target="_blank" title="<?php echo $url;?>"><img src="<?php echo $img;?>" alt="<?php echo $url;?>" /></a>
	</div>
	
<?php 	
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'img' => '', 'url' => '') );
		
		$title = esc_attr($instance['title']);
		$img = esc_attr($instance['img']);
		$url = esc_attr($instance['url']);
		
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img'); ?>"><?php _e('Image URL (300x250px):', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="text" value="<?php echo $img; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
        </p>
        
<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['img'] = strip_tags($new_instance['img']);
        $instance['url'] = strip_tags($new_instance['url']);
        
		return $instance;
		
	}
	
}

?>