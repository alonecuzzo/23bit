<?php
/*******************************
 * Twitter Widget 
 *******************************/
class ln_twitter_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_twitter_widget() {
		
		$widget_ops = array('classname' => 'ln-twitter-widget',
							'description' => 'Show Twitter recent tweets.' );
		
		$this->WP_Widget( 'ln_widget_twitter', 'Twitter Widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$title = $instance['title'];
		$twname = $instance['twname'];
		$number = $instance['number'];
		$follow = $instance['follow'];
		
		echo $before_widget;
		
		if(isset($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}
		
		// Twiiter limits 150 requests per hour so use cache file
		$cache_file = WDG_PATH.'/twitter-cache.xml';
		$cachetime = 3600; // one hour
		$cache_file_time = 0;
		
		// if cache file exists get cache file create time
		if(@file_exists($cache_file)){
			$cache_file_time = @filemtime($cache_file);
		}
		
		
		if (time() - $cachetime < $cache_file_time) {
			
			// load feed from cache file
			$tweets = simplexml_load_file($cache_file);
			
			
		}else{
		
			//get tweets
			$feed = 'http://api.twitter.com/1/statuses/user_timeline.xml?include_entities=true&include_rts=true&screen_name='.$twname.'&count='.$number;
			
			if(function_exists('curl_init')){
				// CURL
				$ch = curl_init();
				$timeout = 5;

				curl_setopt ($ch, CURLOPT_URL, $feed);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				
				$tweets_content = curl_exec($ch);
				curl_close($ch);
			
			}else{
				// file get contents
				$tweets_content = file_get_contents($feed);
				
			}

			// parse
			$tweets = @simplexml_load_string($tweets_content);

			// clear a bit xml data (remove things that we dont need in cache file,  
			// like user data and retweeted status). That will make cache file size smaller.

			if(!empty($tweets) && $tweets && $tweets->status[0]->text){
				
				for($j=0; $j<$number; $j++){
					
					if(isset($tweets->status[$j]->retweeted_status)){
						unset($tweets->status[$j]->retweeted_status);
					}
					unset($tweets->status[$j]->user);
					
				}

				// create new cache file
				$new_cache_file = @fopen($cache_file, 'w');
	 
				@fwrite($new_cache_file, $tweets->asXML());  
				@fclose($new_cache_file);
			
			}else{
				// read from cache file
				$tweets = @simplexml_load_file($cache_file);
			} 
			
		}
		
		// show recent tweets 
		if(!empty($tweets) && $tweets){

			for($i=0; $i<$number; $i++){
				
				$date = explode(' ', $tweets->status[$i]->created_at);
			
		
?>		
		<div class="widget-tweet" <?php if($i==0){ echo 'style="margin-top:0;"';}else if($i==$number-1){ echo 'style="border:none;"';}?>>
			<span><?php echo make_clickable($tweets->status[$i]->text); ?></span>
			<span class="widget-tweet-time"><?php echo $date[2].' / '.$date[1].' / '.$date[count($date)-1]; ?></span>
			
		</div> 
<?php 		
			}//end for
		
		}//end if
			
		if(isset($follow) && $follow != ''){
			echo '<a href="http://www.twitter.com/'.$twname.'" target="_blank" title="'.$follow.'">'.$follow.'</a>';
		}

		
		
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'twname' => '', 'number' => 3, 'follow' => 'Follow Me.') );
		$title = esc_attr($instance['title']);
		$twname = esc_attr($instance['twname']);
		$number = esc_attr($instance['number']);
		$follow = esc_attr($instance['follow']);
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twname'); ?>"><?php  _e('Twitter Name:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twname'); ?>" name="<?php echo $this->get_field_name('twname'); ?>" type="text" value="<?php echo $twname; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tweets:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('follow'); ?>"><?php _e('Follow link:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('follow'); ?>" name="<?php echo $this->get_field_name('follow'); ?>" type="text" value="<?php echo $follow; ?>" />
        </p>
        

<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['twname']  = $new_instance['twname'];
		$instance['number'] = $new_instance['number'];
		$instance['follow'] = $new_instance['follow'];
		
		return $instance;
		
	}
	
}

?>