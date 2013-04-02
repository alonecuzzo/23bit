<?php
/*******************************
 * Widget Banner 4x125 
 *******************************/
class ln_banners_125_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_banners_125_widget() {
		
		$widget_ops = array('classname' => 'ln-square-banner-widget',
							'description' => 'Ad Banners 125x125px' );
		
		$this->WP_Widget( 'ln_banners_125_widget', 'Banners 125x125', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$number_of_ads = 4;
		$list = '';
		$title = $instance['title'];
		$img_count = 1;
		$number_of_active_slots = 0;

		echo $before_widget;
		
		if(isset($title) && !empty($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}

		// find the number of active slots 
		for($i=0; $i<$number_of_ads; $i++){

			if( isset($instance['img_'.$i]) && !empty($instance['img_'.$i]) ){
				$number_of_active_slots += 1;
			}
		}

		// output ads
		for($i=0; $i<$number_of_ads; $i++){

			if( isset($instance['img_'.$i]) && !empty($instance['img_'.$i]) ){
				
				$url = $instance['url_'.$i];
				
				if(empty($url)){
					$url = '#';
				}

				$li_class = '';

				if($number_of_active_slots == 1){
				
					$li_class = 'class="last"';
				
				}else if($number_of_active_slots == 2){
					
					if($img_count == 2){
						$li_class = 'class="last even"';
						$img_count = 1;
					}else{
						$li_class = 'class="last"';
						
					}

				}else if($number_of_active_slots > 2){

					if($img_count == 2){
						$li_class = 'class="even"';
						$img_count = 0;
					}

					if($i == 2){
						$li_class = 'class="last"';
					}

					if($i == 3){
						$li_class = 'class="last even"';
					}

				}

				$list.= '<li '.$li_class.'><a class="no-eff" href="'.$url.'" target="_blank" title="'.$url.'"><img src="'.$instance['img_'.$i].'" alt="'.$url.'"/></a></li>';
				
				$img_count+=1;
			}
		}
		
?>		
	<div class="sidebar-widget ln-banner-125">
		<ul>
			<?php echo $list; ?>
		</ul>
		<div class="clear"></div>
	</div>
	
<?php 	
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'img_0' => '', 'url_0' => '', 'img_1' => '', 'url_1' => '', 'img_2' => '', 'url_2' => '', 'img_3' => '', 'url_3' => '') );
		
		$title = esc_attr($instance['title']);
		
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('img_0'); ?>"><?php _e('Image 1 URL (125x125px):', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_0'); ?>" name="<?php echo $this->get_field_name('img_0'); ?>" type="text" value="<?php echo esc_attr($instance['img_0']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url_0'); ?>"><?php _e('URL 1:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url_0'); ?>" name="<?php echo $this->get_field_name('url_0'); ?>" type="text" value="<?php echo esc_attr($instance['url_0']); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('img_1'); ?>"><?php _e('Image 2 URL (125x125px):', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_1'); ?>" name="<?php echo $this->get_field_name('img_1'); ?>" type="text" value="<?php echo esc_attr($instance['img_1']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url_1'); ?>"><?php _e('URL 2:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url_1'); ?>" name="<?php echo $this->get_field_name('url_1'); ?>" type="text" value="<?php echo esc_attr($instance['url_1']); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('img_2'); ?>"><?php _e('Image 3 URL (125x125px):', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_2'); ?>" name="<?php echo $this->get_field_name('img_2'); ?>" type="text" value="<?php echo esc_attr($instance['img_2']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url_2'); ?>"><?php _e('URL 3:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url_2'); ?>" name="<?php echo $this->get_field_name('url_2'); ?>" type="text" value="<?php echo esc_attr($instance['url_2']); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('img_3'); ?>"><?php _e('Image 4 URL (125x125px):', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_3'); ?>" name="<?php echo $this->get_field_name('img_3'); ?>" type="text" value="<?php echo esc_attr($instance['img_3']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url_3'); ?>"><?php _e('URL 4:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('url_3'); ?>" name="<?php echo $this->get_field_name('url_3'); ?>" type="text" value="<?php echo esc_attr($instance['url_3']); ?>" />
        </p>
        
<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['img_0'] = strip_tags($new_instance['img_0']);
        $instance['url_0'] = strip_tags($new_instance['url_0']);
		$instance['img_1'] = strip_tags($new_instance['img_1']);
        $instance['url_1'] = strip_tags($new_instance['url_1']);
        $instance['img_2'] = strip_tags($new_instance['img_2']);
        $instance['url_2'] = strip_tags($new_instance['url_2']);
        $instance['img_3'] = strip_tags($new_instance['img_3']);
        $instance['url_3'] = strip_tags($new_instance['url_3']);
        
		return $instance;
		
	}
	
}

?>