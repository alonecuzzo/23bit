<?php
/*******************************
 * Recent Posts Widget 
 *******************************/
class ln_recent_posts_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_recent_posts_widget() {
		
		$widget_ops = array('classname' => 'ln-recent-posts-wg',
							'description' => 'Display recent posts from given category' );
		
		$this->WP_Widget( 'ln_recent_posts_widget', 'Recent Posts widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$default_small_article_thumb = INC_CSS.'/images/small-article-default-img.png';

		$small_articles = '';
		
		$title = $instance['title'];
		$category = $instance['category'];
		$number = $instance['number'];
		
		if($number == '' || $number <= 0){
			$number = 5;
		}

		$counter = 1;
		$last = '';
		
		// reset query
		wp_reset_query();

		// build query
		if(empty($category) && $category == ''){
			// query recent posts
			$query = array('post_type' => 'post', 'posts_per_page' => $number);
		}else{
			// query recent posts from category
			$query = array('post_type' => 'post', 'posts_per_page' => $number, 'category_name' => $category);
		}

		// run query
		query_posts($query);

		/////////////////////////////////////////////
		// LOOP
		while (have_posts()) {
			  
			    the_post();
				
				$has_image = false;

				if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
					$has_image = true;
				}

				// ==== SMALL ARTICLES ==== //
				
				if($counter == $number){
					$last_class = 'class="last"';
				}else{
					$last_class = '';
				}

				$small_articles.= '<li '.$last_class.'><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'" class="no-eff">';

				if($has_image){
				
					$small_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array('40','40'), false, '' );
					$small_articles.= '<img class="small-article-img" src="'.$small_src[0].'" alt="'.get_the_title().'"/>';
				
				}else{
					
					// use default image
					$small_articles.= '<img class="small-article-img" src="'.$default_small_article_thumb.'"/>';
				}
	    					
	    		$small_articles.= '</a><div class="title"><h5><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h5></div></li>';
				
				$counter += 1;
				
		}
		// END LOOP
		/////////////////////////////////////////////

		echo $before_widget;

		if(isset($title) && !empty($title)){
			echo $before_title;
				echo $title;
			echo $after_title;	
		}
?>	

	<ul class="small-articles">
			<?php echo $small_articles; ?>
	</ul>
	
<?php 	
		
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'category' => '', 'number' => 5) );
		
		$title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
		$number = esc_attr($instance['number']);
		
?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Posts category name:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo $category; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
 
<?php 
	}
	
	/**
	 * update
	 **/
	function update($new_instance, $old_instance) {
		
		$instance=$old_instance;		
		
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['category'] = strip_tags($new_instance['category']);
        $instance['number'] = strip_tags($new_instance['number']);
        
		return $instance;
		
	}
	
}

?>