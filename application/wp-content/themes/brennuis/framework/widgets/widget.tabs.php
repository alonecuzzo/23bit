<?php
/*******************************
 * Tabs Widget (recent posts / comments / tags) 
 *******************************/
class ln_tabs_widget extends WP_Widget {
	
	/**
	 * Constructor
	 **/
	function ln_tabs_widget() {
		
		$widget_ops = array('classname' => 'ln-tabs-wg',
							'description' => 'Tabs widget (recent posts / comments / tags)' );
		
		$this->WP_Widget( 'ln_tabs_widget', 'Tabs widget', $widget_ops );
	}
	
	/**
	 * widget
	 **/
	function widget($args, $instance) {
		
		extract($args);
		
		$default_small_article_thumb = INC_CSS.'/images/small-article-default-img.png';
		$small_articles = '';
		$comments_content = '';

		$title = $instance['title'];
		$category = $instance['category'];
		$number = $instance['number'];
		$comments_number = $instance['comments_number'];
		$widget_id = $args['widget_id'];
		$tabs_counter = 1;

		if($number == '' || $number <= 0){
			$number = 5;
		}

		if($comments_number == '' || $comments_number <= 0){
			$comments_number = 5;
		}
		
		$counter = 1;
		$last = '';
		
		// get comments
		$comments = get_comments(array('number' => $comments_number, 'status' => 'approve'));

		foreach ($comments as $comment) {
			
			if($counter == $comments_number){
				$last = 'class="last"';
			}

			$counter += 1;

			$comments_content .= '<li '.$last.'>'.$comment->comment_author.': <p><a href="'.get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="on: '.get_the_title($comment->comment_post_ID) .'" >'.strip_tags( substr($comment->comment_content, 0, 43) ).'...</a></p></li>';
		}

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

		$last = '';
		$counter = 1;

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
	<div class="tabs-widget-nav">
		<ul>
			 <li><a href="#wg-<?php echo $widget_id; ?>-tabs-1" title="<?php _e('Recent', 'framework'); ?>"><?php _e('Recent', 'framework'); ?></a></li>
			 <li><a href="#wg-<?php echo $widget_id; ?>-tabs-2" title="<?php _e('Comments', 'framework'); ?>"><?php _e('Comments', 'framework'); ?></a></li>
			 <li><a href="#wg-<?php echo $widget_id; ?>-tabs-3" title="<?php _e('Tags', 'framework'); ?>"><?php _e('Tags', 'framework'); ?></a></li>
		</ul>
	</div>
	<div class="widget-tabs-content clear">
		<div id="wg-<?php echo $widget_id; ?>-tabs-1">
			<ul class="small-articles">
				<?php echo $small_articles; ?>
			</ul>
		</div>
		<div id="wg-<?php echo $widget_id; ?>-tabs-2">
			<ul>
				<?php echo $comments_content; ?>
			</ul>
		</div>
		<div id="wg-<?php echo $widget_id; ?>-tabs-3">
			<div class="tags">
				<?php wp_tag_cloud('smallest=10&largest=14&separator=, '); ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
<?php 	
		
		echo $after_widget;
	}
	
	/**
	 * form
	 **/
	function form($instance) {
		
		
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'category' => '', 'number' => 5, 'comments_number' => 5) );
		
		$title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
		$number = esc_attr($instance['number']);
		$comments_number = esc_attr($instance['comments_number']);
		
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

        <p>
            <label for="<?php echo $this->get_field_id('comments_number'); ?>"><?php _e('Number of comments:', 'framework'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('comments_number'); ?>" name="<?php echo $this->get_field_name('comments_number'); ?>" type="text" value="<?php echo $comments_number; ?>" />
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
        $instance['comments_number'] = strip_tags($new_instance['comments_number']);
        
		return $instance;
		
	}
	
}

?>