<?php
/*******************************
 * Social Widget 
 *******************************/
class ln_social_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_social_widget() {
		
		$widget_ops = array('classname' => 'ln-social-widget',
							'description' => 'Number of RSS subscribers, Facebook fans and Twitter followers' );
		
		$this->WP_Widget( 'ln_social_widget', 'Social Widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$feedburner_id = $instance['feedburner_id'];
		$twitter_name = $instance['twitter_name'];
		$facebook_page = $instance['facebook_page'];
		
		$json_cache_content = array();
		$rss_count = 0;
		$twitter_count = 0;
		$facebook_count = 0;
		$cache_content = null;

		$cache_file = WDG_PATH.'/social-widget-cache.json';
		$cachetime = 3600; // one hour
		$cache_file_time = 0;
		
		// if cache file exists get cache file create time
		if(@file_exists($cache_file)){
			$cache_file_time = @filemtime($cache_file);
		}
		
		// READ FROM CACHE FILE
		
		if (time() - $cachetime < $cache_file_time) {
			
			$buff = ''; 
				
			// load feed from cache file
			$fd = @fopen($cache_file, 'r');
				
			$buff = @fread($fd, filesize($cache_file));
				
			$cache_content = json_decode($buff, true);
			
			$twitter_count = $cache_content[0]['twitter_count'];
			$facebook_count = $cache_content[1]['facebook_count'];

			@fclose($fd);
		
		}else{

			// UPDATE/CREATE CACHE FILE
			if(isset($twitter_name) && !empty($twitter_name) ){
				
				$request_twitter = 'http://api.twitter.com/1/users/show.json?screen_name='.urlencode($twitter_name);
				$twitter_res = ln_social_widget_get_request_data($request_twitter);

				if( $twitter_res ){

					// parse
					$response = json_decode($twitter_res, true);
					
					if(isset($response['followers_count']) && $response['followers_count'] != ''){
						$twitter_count = $response['followers_count'];
					}else{

						// get it from cache
						$fd_t = @fopen($cache_file, 'r');
						$buff_t = @fread($fd_t, filesize($cache_file));
						$tw_cache_content = json_decode($buff_t, true);
						$twitter_count = $tw_cache_content[0]['twitter_count'];
						@fclose($fd_t);
					}

					$json_cache_content[] = array( "twitter_count" => $twitter_count );

				}else{
					$json_cache_content[] = array( "twitter_count" => 0 );
				}

			}

			if(isset($facebook_page) && !empty($facebook_page) ){
				
				$request_facebook = 'http://graph.facebook.com/'.urlencode($facebook_page);
				$fb_res = ln_social_widget_get_request_data($request_facebook);

				if( $fb_res ){
					
					// parse
					$response = json_decode($fb_res, true);
					$facebook_count = $response['likes'];
					$json_cache_content[] = array( "facebook_count" => $facebook_count );

				}else{
					$json_cache_content[] = array( "facebook_count" => 0 );
				}

			}

			// create new cache file
			$cache_content = json_encode($json_cache_content);

			if(!empty($cache_content)){
				
				// create new cache file
				$new_cache_file = @fopen($cache_file, 'w');
	 
				@fwrite($new_cache_file, $cache_content);  
				@fclose($new_cache_file);

			} 

		}

		echo $before_widget;
?>		
		
				
		<div class="social-wg-box rss-info">
			<a target="_blank" href="http://feeds.feedburner.com/<?php echo $feedburner_id; ?>" class="no-eff"><img src="<?php echo INC_CSS; ?>/images/light/widgets/picons50.png" alt="RSS"/></a>
			<span class="number"><?php _e('RSS', 'framework'); ?></span>
			<span class="title"><?php _e('Subscribe', 'framework'); ?></span>
		</div>

		<div class="social-wg-box twitter-info">
			<a target="_blank" href="http://twitter.com/<?php echo $twitter_name; ?>" class="no-eff"><img src="<?php echo INC_CSS; ?>/images/light/widgets/picons33.png" alt="Twitter"/></a>
			<span class="number"><?php echo $twitter_count; ?></span>
			<span class="title"><?php _e('Followers', 'framework'); ?></span>
		</div>

		<div class="social-wg-box facebook-info">
			<a target="_blank" href="http://facebook.com/<?php echo $facebook_page; ?>" class="no-eff"><img src="<?php echo INC_CSS; ?>/images/light/widgets/picons36.png" alt="Facebook"/></a>
			<span class="number"><?php echo $facebook_count; ?></span>
			<span class="title"><?php _e('Fans', 'framework'); ?></span>
		</div>

		<div class="clear"></div>

		

<?php
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('feedburner_id' => '', 'twitter_name' => '', 'facebook_page' => '') );
		
		$feedburner_id = esc_attr($instance['feedburner_id']);
		$twitter_name = esc_attr($instance['twitter_name']);
		$facebook_page = esc_attr($instance['facebook_page']);
		
?>
		<p>
            <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('FeedBurner ID:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('twitter_name'); ?>"><?php _e('Twitter Name:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo $twitter_name; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('facebook_page'); ?>"><?php _e('Facebook Page:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_page'); ?>" name="<?php echo $this->get_field_name('facebook_page'); ?>" type="text" value="<?php echo $facebook_page; ?>" />
        </p>
        
<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
        $instance['twitter_name'] = strip_tags($new_instance['twitter_name']);
         $instance['facebook_page'] = strip_tags($new_instance['facebook_page']);
        
		return $instance;
		
	}
	
}

?>