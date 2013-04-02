<?php

/**
 * Modules
 * - page builder modules
 * - Implements IPageBuilderModules interface, used to output modules in frontend
 * 
 * @version 1.0
 * @author Lion http://themeforest.net/user/Lion
 * 
 */
class Modules implements IPageBuilderModules{
	
	private $page_id;
	private $has_sidebar = false;
	private $close_last = false;
	private $column_module_counter = 0;
	private $default_carousel_thumb = '';
	private $default_small_article_thumb = '';
	
	const CAROUSEL_DEFAULT_THUMB = '/images/carousel-default-img.png';
	const SMALL_ARTICLE_DEFAULT_THUMB = '/images/small-article-default-img.png';

	/**
	 * Constructor
	 *
	 * @param $options array with options 
	 */
	public function __construct($options){

		if(!empty($options)){

			$this->has_sidebar = $options['has-sidebar'];
			$this->page_id = $options['page_id'];

		}else{

			$this->page_id = get_the_ID();
		}

		$this->default_carousel_thumb = INC_CSS.self::CAROUSEL_DEFAULT_THUMB;
		$this->default_small_article_thumb = INC_CSS.self::SMALL_ARTICLE_DEFAULT_THUMB;
	}

	/**************************************************************************************************
	 *										== HELPER FUNCTIONS ==
	 **************************************************************************************************/
	
	/**
	 * Escape Text
	 * - helper function escapes strings
	 * 
	 * @param string to escape
	 * @return escaped string
	 */
	private function escapeText($txt){
		//return ereg_replace("\\\'", '"', stripslashes($txt) ); -- deprecated function in 5.3
		return str_replace("\'", '"', stripslashes($txt) );
	}

	/**
	 * Get Custom Excerpt
	 * - helper function returns excerpt with custom length passed as argument
	 * 
	 * @param string post excerpt
	 * @param int excerpt lenght
	 * @return string exceprt
	 */
	private function getCustomExcerpt($text, $length){

		$text = strip_shortcodes($text);
		$text = strip_tags($text);

		$text = substr($text,0,$length);
		$excerpt = strrpos($text, '.', 1) ? substr($text, 0, strrpos($text, '.') + 1) : false;
		
		if($excerpt){
			return $excerpt.'..';
		}else{
			return $text.'...';
		}
	}

	/**
	 * Get Comments Number
	 * - use in LOOP
	 *
	 * @return number of post comments with description
	 */
	private function getCommentsNumber(){

		$num_comments = get_comments_number();

		if($num_comments == 0){
			return __('No Comments', 'framework');
		}else if($num_comments == 1){
			return '<a href="'.get_permalink(get_the_ID()).'/#comments" title="1 Comment">1 '.__('Comment', 'framework').'</a>';
		}else{
			return '<a href="'.get_permalink(get_the_ID()).'/#comments" title="'.$num_comments.' Comments">'.$num_comments.' '.__('Comments', 'framework').'</a>';
		}

	}

	/**
	 * Close Last Column
	 * - helper function closes last column item with clear div
	 * 
	 * @return string div element (append it to output)
	 */
	private function closeLastColumn(){

		if($this->close_last){
			
			$this->column_module_counter = 0;
			$this->close_last = false;
			
			return '<div class="clear"></div>';
		}
		
		return '';
	}

	/** 
	 * Get Section Title Link
	 * 
	 * @param $cat_name - category name
	 * @param $link_type
	 * @param $custom_link
	 */
	private function getSectionTitleLink($cat_name, $link_type, $custom_link){

		if(!empty($cat_name)){

			// check link type (0-category, 1-custom other -> page)
			if($link_type == '0'){
				
				$trm = get_term_by('slug', $cat_name, 'category');
					
				if(!empty($trm)){
					return get_category_link( $trm->term_id );
				}else{
					return '#';
				}

			}else if($link_type == '1'){
				// custom link
				return $custom_link;
			
			}else{
				// link to page
				return $link_type;
			}
		}

	}

	/**
	 * Add Post Format
	 * 
	 * @param post format
	 * @return post format content
	 */
	public function addPostFormat($format){

		$output = '';
		$is_review = false;
		$score = 0;
		$icon = $format;
		$post_categories = '';

		// Review
		if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on'){
			$is_review = true;
			
			$score = get_post_meta( get_the_ID(), 'ln_review_meta_fileds_score', true);
		}

		// get post categories
		foreach((get_the_category()) as $cat) {
			$post_categories .= '<a href="'.get_category_link($cat->term_id).'">'.$cat->cat_name.'</a>, ';
		}
		
		// remove last comma from categories
		$post_categories = substr($post_categories, 0, sizeof($post_categories)-3);

		switch($format){

			//  === STANDARD + review post ==== //
			case "standard":

				// change icon for review post
				if($is_review){
					$icon = 'review';
				}

				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<h3 class="title"><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
		    					<div class="clear"></div>
		    				</header>';

		    	if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
		    		
	    			$output.='<a href="'.get_permalink(get_the_ID()).'" class="no-eff" title="'.get_the_title().'">
	    						<div class="img-wrapper post-img ln-col-half ln-featured">
	    							'.get_the_post_thumbnail(get_the_ID(), 'post-featured-img-small').'
	    							<div class="img-hover"></div>';
	    			
	    			// show review score
	    			if($is_review){
	    				$output.=	'<div class="rating">
	    								<span class="score">'.$score.'</span>
	    								<span>'.__('score', 'framework').'</span>
	    							</div>';
	    			}

	    			$output.=   '</div>
	    					  </a>

	    					<div class="ln-col-half last-item excerpt">
	    						'.get_the_excerpt().'
	    					</div>
	    					<div class="clear"></div>';
	    		}else{

	    			// no featured image show only excerpt

	    			$output.= '<div class="ln-col-full last-item excerpt excerpt-offset">
	    							'.get_the_excerpt().'
	    						</div>';

	    		}
				
				// article footer
				$output.= $this->addPostFormatFooter($post_categories);

				break;

			//  === IMAGE  ==== //
			case "image":

				$has_image = false;

				if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
						
					$has_image = true; 

					$small_src = get_the_post_thumbnail(get_the_ID(), 'post-featured-img');
						
					// lightbox src
					$lightbox_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array('960','9999'), false, '' );
				}

				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<h3 class="title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a></h3>
		    					<div class="clear"></div>
		    				</header>';

		    	if($has_image){
			    	
			    	if(get_option('ln_theme_enable_lightbox') == 'true'){
			    		$output.= '<a href="'.$lightbox_src[0].'" class="no-eff lightbox" title="'.get_the_title().'">';
			    	}else{
			    		$output.= '<a href="'.get_permalink(get_the_ID()).'" class="no-eff" title="'.get_the_title().'">';
			    	}
		    		
		    		$output.=	'<div class="ln-col-full post-img ln-format-img">
		    							'.$small_src.'
		    							<div class="img-hover"></div>
		    						</div>
		    					</a>';
		    	}
	    		
	    		$output.='<div class="ln-col-full excerpt excerpt-offset">
	    					'.get_the_excerpt().'
	    				  </div>';

	    		// article footer
				$output.= $this->addPostFormatFooter($post_categories);

				break;

			//  === QUOTE  ==== //
			case "quote":

				// get post metabox options
				$quote_text = get_post_meta( get_the_ID(), 'ln_post_meta_quote_text', true);
				$quote_author = get_post_meta( get_the_ID(), 'ln_post_meta_quote_author', true);

				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<div class="clear"></div>
		    				</header>
		    				<div class="ln-quote-post ln-col-full">
	    						<blockquote>
	    							<a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.$quote_text.'</a>
	    							<cite>'.$quote_author.'</cite>
	    						</blockquote>
	    					</div>';

	    		// article footer
				$output.= $this->addPostFormatFooter($post_categories);

				break;

			//  === ASIDE  ==== //
			case "aside":
				
				
				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<div class="clear"></div>
		    				</header>
		    				<div class="ln-aside-post ln-col-full">
	    						'.get_the_content().'
	    					</div>';

	    		// article footer
				$output.= $this->addPostFormatFooter($post_categories);

				break;

			//  === Video  ==== //
			case "video":
			
				$video_embed = get_post_meta( get_the_ID(), 'ln_post_meta_video_embed_code', true);

				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<h3 class="title"><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
		    					<div class="clear"></div>
		    				</header>
		    				<div class="ln-col-half ln-featured">
	    						'.stripslashes(htmlspecialchars_decode($video_embed)).'
	    					</div>
	    				
		    				<div class="ln-col-half last-item excerpt">
		    					'.get_the_excerpt().'
		    				</div>
		    				<div class="clear"></div>';

	    		// article footer
				$output.= $this->addPostFormatFooter($post_categories);

				break;

			//  === Link  ==== //
			case "link":

				$link_url = get_post_meta( get_the_ID(), 'ln_post_meta_url', true);

				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<div class="clear"></div>
		    				</header>
		    				<div class="ln-link-post ln-col-full">
	    						<h4><a href="'.$link_url.'" target="_blank" title="'.get_the_title().'">'.get_the_title().'</a></h4>
	    					</div>

	    					<div class="ln-col-full excerpt excerpt-offset">
	    						'.get_the_excerpt().'
	    					</div>
		    				<div class="clear"></div>';

	    		// article footer
				$output.= $this->addPostFormatFooter($post_categories);
				
				break;

			//  === Gallery  ==== //
			case "gallery":

					// get attachments
					$att_args = array(
						'orderby'		 => 'menu_order',
						'post_type'      => 'attachment',
						'post_parent'    => get_the_ID(),
						'post_mime_type' => 'image',
						'post_status'    => null,
						'numberposts'    => -1,
					);

					$attachments = get_posts($att_args);
					$slides = '';

					if(!empty($attachments)){
						
						foreach($attachments as $att){
							
							$nav_thumb = wp_get_attachment_image_src($att->ID, 'small-article-crop', true); 
							$big_slide = wp_get_attachment_image_src($att->ID, 'post-featured-img', true); 
							
							$slides .= '<li data-small="'.$nav_thumb[0].'" data-height="'.$big_slide[2].'"><img src="'.$big_slide[0].'" alt="'.apply_filters('the_title', $att->post_title).'"/></li>';
					        
						}
					}

					$output.= '<article class="ln-blog-post">

			    				<header>
			    					<span class="format-icon '.$icon.'"></span>
			    					<h3 class="title"><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
			    					<div class="clear"></div>
			    				</header>
			    				<div class="ln-gallery-post flexslider ln-col-full">
				    				<ul class="slides">
				    				'.$slides.'
				    				</ul>
				    			</div>
					    		<div class="clear"></div>
			    				
			    				<div class="ln-col-full excerpt excerpt-offset">
			    					'.get_the_excerpt().'
			    				</div>';

			    	// article footer
					$output.= $this->addPostFormatFooter($post_categories);

				break;

			//  === Audio  ==== //
			case "audio":

				$audio_embed = get_post_meta( get_the_ID(), 'ln_post_meta_audio_embed_code', true);

				$output.= '<article class="ln-blog-post">

		    				<header>
		    					<span class="format-icon '.$icon.'"></span>
		    					<h3 class="title"><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
		    					<div class="clear"></div>
		    				</header>

		    				<div class="ln-audio-post ln-col-full">
		    					'.stripslashes(htmlspecialchars_decode($audio_embed)).'
	    					</div>
	    				
	    					<div class="ln-col-full excerpt excerpt-offset">
	    						'.get_the_excerpt().'
	    					</div>';

	    		// article footer
				$output.= $this->addPostFormatFooter($post_categories);

				break;

		}

		return $output;

	}

	/**
	 * Add Post Format Footer
	 * 
	 * @param $post_categories list
	 * @return post format footer
	 */
	public function addPostFormatFooter($post_categories){

		$output = '<footer>
	    				<span class="meta">'.get_the_time("d F Y").' '.__('by', 'framework').' <a href="'.get_author_posts_url(get_the_author_meta('ID')).'" >'.get_the_author().'</a> '.__('in','framework').' '.$post_categories.' / '.$this->getCommentsNumber().'</span>';
	    					
	    if( get_option('ln_theme_blog_enable_post_preview_share') == 'true'){
	    	
	    	$output .='<ul class="share">
	    						
	    					<li>
	    						<a class="no-eff" target="_blank" href="http://pinterest.com/pin/create/button/?url='.urlencode( get_permalink(get_the_ID()) ).'&amp;media='.urlencode( wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ).'&amp;description='.urlencode( $this->getCustomExcerpt(get_the_excerpt(), 80) ).'"><img src="'.INC_CSS.'/images/light/social/share-pinterest.png" alt="Share on Pinterest" title="Share on Pinterest"/></a>
	    					</li>
	    						
	    					<li>
	    						<a class="no-eff" target="_blank" href="http://www.facebook.com/share.php?u='.get_permalink(get_the_ID()).'" ><img src="'.INC_CSS.'/images/light/social/share-facebook.png" alt="Share on Facebook" title="Share on Facebook" /></a>
	    					</li>

	    					<li>
	    						<a class="no-eff" target="_blank" href="http://twitter.com/home?status='.urlencode(get_the_title()).'%20-%20'.get_permalink(get_the_ID()).'"><img src="'.INC_CSS.'/images/light/social/share-twitter.png" alt="Share on Twitter" title="Share on Twitter" /></a>
	    					</li>
	    						
	    				</ul>';
	    }

	    $output.=	'<div class="clear"></div>
	    			</footer>
	    	</article>';

		return $output;
	}

	/**************************************************************************************************
	 *										== MODULES ==
	 **************************************************************************************************/

	/***************************************************************************************************************
	 * Posts
	 ***************************************************************************************************************/
 	public function posts($data){
 		
 		$output = $this->closeLastColumn(); // close any unclosed column

 		$section_title = $this->escapeText( $data['title'] );
 		$number_of_items = $this->escapeText( $data['number_of_items'] );
 		$category = $this->escapeText( $data['category_name'] );
 		$more_link_type = $this->escapeText($data['more_link_type'] );
 		$more_link_url = $this->escapeText( $data['more_link_url'] );

 		$title_link = $this->getSectionTitleLink($category, $more_link_type, $more_link_url);

 		// check query category
		if($category == 'ln-default'){
			$category = 'ln-recent-regular-posts';
		}

		// reset query 
 		wp_reset_query();

 		// ==== BEGIN MODULE ==== //

 		$output.='<section class="ln-posts-module">
	    				<div class="section-head">';

	    if($title_link != '#'){
	    		$output.= '<h3><a href="'.$title_link.'" title="'.$section_title.'" >'.$section_title.'</a></h3> <span class="arrow"></span>';
	    }else{
	    		$output.= '<h3>'.$section_title.'</h3>';
	    }
	    					
	  
	   	$output.=			'<div class="section-line"></div>
	    				</div>';

 		if($category == 'ln-recent-regular-posts'){

 			// build query for recent posts
			query_posts( array('post_type' => 'post', 'posts_per_page' => $number_of_items) );
		

 		}else{

	 		// build query
			query_posts( array('post_type' => 'post', 'category_name' => $category, 'posts_per_page' => $number_of_items) );
		}

		// ============================== LOOP =============================== //
		while (have_posts()) : the_post();
			
			// ======== BEGIN POST ENTRY ========= //
			$format = get_post_format();
		
			if ($format === false){
				$format = "standard";
			}

			// get post format
			$output .= $this->addPostFormat($format);

			// ======== END POST ENTRY ========= //

		endwhile; 
		// ============================== END LOOP =============================== //

		// ==== END MODULE ==== //

		$output.= '</section>';

 		return $output;
 	}
 	
 	/***************************************************************************************************************
	 * Posts Column
	 ***************************************************************************************************************/
 	public function posts_column($data){
 		
 		$output = '';
 		$big_article = 1;
 		$small_counter = 1;
 		$small_articles = '';
 		$post_categories = '';
 		
 		$section_title = $this->escapeText( $data['title'] );
 		$number_of_items = $this->escapeText( $data['number_of_items'] );
 		$category = $this->escapeText( $data['category_name'] );
 		$more_link_type = $this->escapeText($data['more_link_type'] );
 		$more_link_url = $this->escapeText( $data['more_link_url'] );

 		$title_link = $this->getSectionTitleLink($category, $more_link_type, $more_link_url);

 		// check query category
		if($category == 'ln-default'){
			$category = 'ln-recent-regular-posts';
		}

		// set close last to true
 		$this->close_last = true;

 		// increment column counter (used by column modules to close last module)
 		$this->column_module_counter += 1;

 		if($this->column_module_counter == 2){
			$last_column_module_class = 'last-item';
		}else{
			$last_column_module_class = '';
		}

		// reset query 
 		wp_reset_query();

 		// ==== BEGIN MODULE ==== //

 		$output.='<section class="ln-posts-column ln-col-half '.$last_column_module_class.'">
	    				<div class="section-head">';

	    if($title_link != '#'){
	    		$output.= '<h3><a href="'.$title_link.'" title="'.$section_title.'" >'.$section_title.'</a></h3> <span class="arrow"></span>';
	    }else{
	    		$output.= '<h3>'.$section_title.'</h3>';
	    }
	    					
	  
	   $output.=			'<div class="section-line"></div>
	    				</div>';

 		if($category == 'ln-recent-regular-posts'){

 			// build query for recent posts
			query_posts( array('post_type' => 'post', 'posts_per_page' => $number_of_items) );
		

 		}else{

	 		// build query
			query_posts( array('post_type' => 'post', 'category_name' => $category, 'posts_per_page' => $number_of_items) );
		}

		// ============================== LOOP =============================== //
		while (have_posts()) : the_post();
			
			// ======== BEGIN POST ENTRY ========= //
			$has_image = false;
			$is_review = false;
			$score = 0;

			$format = get_post_format();
		
			if ($format === false){
				$format = "standard";
			}

			// get post categories
			foreach((get_the_category()) as $cat) {
				$post_categories .= '<a href="'.get_category_link($cat->term_id).'">'.$cat->cat_name.'</a>, ';
			}
		
			// remove last comma from categories
			$post_categories = substr($post_categories, 0, sizeof($post_categories)-3);

			if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
				$has_image = true;
			}

			// Review post
			if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on' ){
				$is_review = true;
				$score = get_post_meta( get_the_ID(), 'ln_review_meta_fileds_score', true);
			}

			// ===== BIG ARTICLE ==== //
			if($big_article == 1){

				$output.= '<article class="big-article">';
	    				
	    				
	    		if($has_image && $format != 'video'){

	    			$output.= '<a href="'.get_permalink(get_the_ID()).'" class="no-eff" title="'.get_the_title().'">
	    						<div class="img-wrapper post-img">';
	    			$output.= get_the_post_thumbnail(get_the_ID(), 'column-post-big-img');
	    			$output.= '<div class="img-hover"></div>';

	    			if($is_review) {
	    				$output.= '<div class="rating"><span class="score">'.$score.'</span><span>'.__('score', 'framework').'</span></div>';
	    			}

	    			$output.= '</div></a>';
	    		
	    		}else{
	    			// show video
					$video_embed = get_post_meta( get_the_ID(), 'ln_post_meta_video_embed_code', true);
	    			$output.= stripslashes(htmlspecialchars_decode($video_embed));
	    		}	
	    					
	    		$output.='<h4><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'" >'.get_the_title().'</a></h4>';

	    		if(!$has_image && $format != 'video'){
	    			$output.= get_the_excerpt();
	    		}else{
	    			$output.= '<p>'.$this->getCustomExcerpt( get_the_excerpt(), 200).'</p>';
	    		}
	    		
	    		$output.= '<aside>'.get_the_time("d F Y").' '.__('by', 'framework').' <a href="'.get_author_posts_url(get_the_author_meta('ID')).'" >'.get_the_author().'</a> '.__('in','framework').' '.$post_categories.'</aside>
	    				</article>';

				$big_article = 2;

			}else{

				// ==== SMALL ARTICLES ==== //

				$small_counter+=1;

				if($small_counter == $number_of_items){
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
					$small_articles.= '<img class="small-article-img" src="'.$this->default_small_article_thumb.'" alt="'.get_the_title().'"/>';
				}
	    					
	    		$small_articles.= '</a><div class="title"><h5><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h5></div></li>';
				
			}

			
			// ======== END POST ENTRY ========= //

		endwhile; 
		// ============================== END LOOP =============================== //

		// ==== END MODULE ==== //

		$output.= '<ul class="small-articles">'.$small_articles.'</ul>';
		$output.= '</section>';

		// chek if we need to close columns with clear div
		if($this->column_module_counter == 2){
 			$output .= $this->closeLastColumn();
 		}

 		return $output;
	}

 	/***************************************************************************************************************
	 * Posts Carousel
	 ***************************************************************************************************************/
 	public function posts_carousel($data){
 		
 		$items = '';
 		$item_width = 200; // carousel item width in pixels width+margin
 		$list_width = 0;

 		$output = $this->closeLastColumn(); // close any unclosed column

 		$section_title = $this->escapeText( $data['title'] );
 		$number_of_items = $this->escapeText( $data['number_of_items'] );
 		$category = $this->escapeText( $data['category_name'] );
 		$more_link_type = $this->escapeText($data['more_link_type'] );
 		$more_link_url = $this->escapeText( $data['more_link_url'] );

 		$title_link = $this->getSectionTitleLink($category, $more_link_type, $more_link_url);

 		// check query category
		if($category == 'ln-default'){
			$category = 'ln-recent-regular-posts';
		}

		// reset query 
 		wp_reset_query();

 		// ==== BEGIN MODULE ==== //

 		$output.='<section class="ln-carousel-module ln-col-full">
	    				<div class="section-head">';

	    if($title_link != '#'){
	    		$output.= '<h3><a href="'.$title_link.'" title="'.$section_title.'" >'.$section_title.'</a></h3> <span class="arrow"></span>';
	    }else{
	    		$output.= '<h3>'.$section_title.'</h3>';
	    }
	    					
	  
	   $output.='			<div class="section-line"></div>
	    				</div>';

 		if($category == 'ln-recent-regular-posts'){

 			// build query for recent posts
			query_posts( array('post_type' => 'post', 'posts_per_page' => $number_of_items) );
		

 		}else{

	 		// build query
			query_posts( array('post_type' => 'post', 'category_name' => $category, 'posts_per_page' => $number_of_items) );
		}

		// ============================== LOOP =============================== //
		while (have_posts()) : the_post();
			
			$is_review = false;
			$score = 0;

			// ======== BEGIN POST ENTRY ========= //
			$format = get_post_format();
		
			if ($format === false){
				$format = "standard";
			}

			// Review
			if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on'){
				$is_review = true;
				
				$score = get_post_meta( get_the_ID(), 'ln_review_meta_fileds_score', true);
			}

			// generate carousel item

			$items .= '<li>
						<article class="carousel-article">
						<a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'" class="no-eff">';
    		
    		if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
		    		
	    		$items .='<div class="img-wrapper post-img">
    						'.get_the_post_thumbnail(get_the_ID(), 'carousel-featured-img').'
    						<div class="img-hover"></div>';
    		}else{

    			// post doesn't have featured image : use default
    			$items .='<div class="img-wrapper post-img">
    						<img src="'.$this->default_carousel_thumb.'" alt="'.get_the_title().'"/>
    						<div class="img-hover"></div>';
    		}
    		
    		if($is_review){
    			$items .='<div class="rating"><span class="score">'.$score.'</span></div>';
    		}else if($format == 'video'){
    			$items .='<div class="video-icon"></div>';
    		}			
    				
    		$items .= 	'</div></a>
    						<h6><a href="'.get_permalink(get_the_ID()).'" title="'.get_the_title().'">'.get_the_title().'</a></h6>
						</article>
						</li>';

			// increase items width
			$list_width += $item_width;

			// ======== END POST ENTRY ========= //

		endwhile; 
		// ============================== END LOOP =============================== //
		
		$output .= '<div class="ln-carousel">
						<div class="control prev"><span></span></div>
        				<div class="slider-wrapper">
        					<ul style="width: '.$list_width.'px;">
        					'.$items.'
        					</ul>
        				</div>
        				<div class="control next"><span></span></div>

	    			</div>

	    		</section>
	    		<div class="clear"></div>';

	    // ==== END MODULE ==== //

 		return $output;

 	}

 	/***************************************************************************************************************
	 * Slider
	 ***************************************************************************************************************/
 	public function slider($data){

 		$slides = '';
 		$output = $this->closeLastColumn(); // close any unclosed column

 		$number_of_items = $this->escapeText( $data['number_of_items'] );
 		$category = $this->escapeText( $data['category_name'] );
 		$slider_type = $this->escapeText( $data['slider_type'] );
 		$slider_category = $this->escapeText( $data['slider_category'] );

 		// posts
 		if($slider_type == 'blog-posts'){
 			
 			// check query category
			if($slider_category == 'ln-default'){
				$slider_category = 'ln-recent-regular-posts';
			}

 			// reset query 
 			wp_reset_query();

 			if($slider_category == 'ln-recent-regular-posts'){
				// build query for recent posts
				query_posts( array('post_type' => 'post', 'posts_per_page' => $number_of_items) );
			}else{
				// build query
				query_posts( array('post_type' => 'post', 'category_name' => $slider_category, 'posts_per_page' => $number_of_items) );
			}

			// ============================== LOOP =============================== //
			while (have_posts()) : the_post();

				// only posts that have featured image set
	    		if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ){
			    	
			    	$small_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array('40','40'), false, '' );
	    			
	    			$slides .='<li data-small="'.$small_src[0].'">
	    						<a href="'.get_permalink(get_the_ID()).'" class="no-eff" title="'.get_the_title().'" >'.get_the_post_thumbnail(get_the_ID(), 'post-featured-img-crop').'
				    					<section class="flex-caption">
				    						<h3>'.get_the_title().'</h3>
				    						<div class="separator"></div>
				    						<p>'.$this->getCustomExcerpt( get_the_excerpt(), 100).'</p>
				    					</section>
			    					</a>
			    				</li>';
	    			
	    		}
	    			
			endwhile; 
			// ============================== END LOOP =============================== //

 		// custom slider
 		}else if($slider_type == 'custom-slider'){

 			// get attachments
			$args = array(
				'orderby'		 => 'menu_order',
				'post_type'      => 'attachment',
				'post_parent'    => $category,
				'post_mime_type' => 'image',
				'post_status'    => null,
				'numberposts'    => -1,
			);

			$attachments = get_posts($args);

			if(!empty($attachments) && $category != 'ln-default'){
		
				foreach($attachments as $att){
					
					$has_link = false;
					$big_src = wp_get_attachment_image_src($att->ID, 'post-featured-img-crop', true);
					$small_src = wp_get_attachment_image_src($att->ID, 'small-article-crop', true);
					$slide_link = $this->escapeText( get_post_meta($att->ID, 'ln_media_slider_slide_link', true) );
					$slide_caption = $this->escapeText( get_post_meta($att->ID, 'ln_media_slider_slide_caption', true) );
					$slide_title = $this->escapeText( get_post_meta($att->ID, 'ln_media_slider_slide_title', true) );
					
					$slides .= '<li data-small="'.$small_src[0].'">';
					
					// slide link
					if(isset($slide_link) && $slide_link != ''){
						$has_link = true;
						$slides.= '<a class="no-eff" href="'.$slide_link.'" >';
					}

					// slide img
					$slides .=	'<img src="'.$big_src[0].'" alt="'.apply_filters('the_title', $att->post_title).'"/>';
					
					// slider caption
					if($slide_title != '' || $slide_caption != ''){
					
						$slides .= '<section class="flex-caption">';

						if($slide_title != ''){
							$slides .= '<h3>'.$slide_title.'</h3><div class="separator"></div>';
						}

						if($slide_caption != ''){
							$slides .= '<p>'.$slide_caption.'</p>';
						}

						$slides .= '</section>';
					}
					
					// close <a>
					if($has_link){
						$slides .= '</a>';
					}

					// close slide				
					$slides .= '</li>';

				}
			}

 		}

 		$output.='<section class="ln-slider-module flexslider ln-col-full">
					<ul class="slides">
						'.$slides.'
					</ul>
				</section>
				<div class="clear"></div>';

 		return $output;
 	}

 	/***************************************************************************************************************
	 * Text Full
	 ***************************************************************************************************************/
 	public function text_full($data){
 		
 		$content = '';
 		$section_title = $this->escapeText( $data['title'] );

 		$output = $this->closeLastColumn(); // close any unclosed column

 		if($data['custom_text_type'] == 'custom'){
			$content.= $this->escapeText( $data['custom_text'] );
		}else{
			$post = get_page($this->page_id);
			$content.= apply_filters('the_content', $post->post_content);
		}

 		$output .='<section class="ln-text-full ln-col-full">
						<div class="section-head">
		    				<h3>'.$section_title.'</h3>
		    				<div class="section-line"></div>
		    			</div>
		    			'.do_shortcode($content).'
			    	</section>';

	    return $output;
 	}

 	/***************************************************************************************************************
	 * Text Column
	 ***************************************************************************************************************/
 	public function text_column($data){
 		
 		$output = '';
 		$content = '';
 		$section_title = $this->escapeText( $data['title'] );

 		// set close last to true
 		$this->close_last = true;

 		// increment column counter (used by column modules to close last module)
 		$this->column_module_counter += 1;

 		if($this->column_module_counter == 2){
			$last_column_module_class = 'last-item';
		}else{
			$last_column_module_class = '';
		}

		if($data['custom_text_type'] == 'custom'){
			$content.= $this->escapeText( $data['custom_text'] );
		}else{
			$post = get_page($this->page_id);
			$content.= apply_filters('the_content', $post->post_content);
		}

 		$output .='<section class="ln-text-column ln-col-half '.$last_column_module_class.'">
						<div class="section-head">
		    				<h3>'.$section_title.'</h3>
		    				<div class="section-line"></div>
		    			</div>
		    			'.do_shortcode($content).'
			    	</section>';

 		// chek if we need to close columns with clear div
		if($this->column_module_counter == 2){
 			$output .= $this->closeLastColumn();
 		}

 		return $output;
 	}

 	/***************************************************************************************************************
	 * Video Full
	 ***************************************************************************************************************/
 	public function video_full($data){
 		
 		$section_title = $this->escapeText( $data['title'] );

 		$output = $this->closeLastColumn(); // close any unclosed column

	    $output .='<section class="ln-video-full-module ln-col-full">
						<div class="section-head">
		    				<h3>'.$section_title.'</h3>
		    				<div class="section-line"></div>
		    			</div>
		    			'.$this->escapeText( $data['embed_code'] ).'
			    	</section>';

 		return $output;
 	}

 	/***************************************************************************************************************
	 * Video Column
	 ***************************************************************************************************************/
 	public function video_column($data){
 		
 		$section_title = $this->escapeText( $data['title'] );

 		$output = '';

 		// set close last to true
 		$this->close_last = true;

 		// increment column counter (used by column modules to close last module)
 		$this->column_module_counter += 1;

 		if($this->column_module_counter == 2){
			$last_column_module_class = 'last-item';
		}else{
			$last_column_module_class = '';
		}


		 $output .='<section class="ln-video-column-module ln-col-half '.$last_column_module_class.'">
						<div class="section-head">
		    				<h3>'.$section_title.'</h3>
		    				<div class="section-line"></div>
		    			</div>
		    			'.$this->escapeText( $data['embed_code'] ).'
			    	</section>';

 		// chek if we need to close columns with clear div
		if($this->column_module_counter == 2){
 			$output .= $this->closeLastColumn();
 		}

 		return $output;
 	}

}

?>