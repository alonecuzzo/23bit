<?php
// main social icons
$ln_main_social_icons = array();
$ln_main_social_icons['twitter'] = ('picons03.png');
$ln_main_social_icons['facebook'] = ('picons06.png');
$ln_main_social_icons['flickr'] = ('picons04.png');
$ln_main_social_icons['delicious'] = ('picons19.png');
$ln_main_social_icons['digg'] = ('picons08.png');
$ln_main_social_icons['lastfm'] = ('picons12.png');
$ln_main_social_icons['linkedin'] = ('picons11.png');
$ln_main_social_icons['rss'] = ('picons20.png');
$ln_main_social_icons['stumbleupon'] = ('picons24.png');
$ln_main_social_icons['tumblr'] = ('picons15.png');
$ln_main_social_icons['vimeo'] = ('picons13.png');
$ln_main_social_icons['youtube'] = ('picons18.png');
$ln_main_social_icons['dribbble'] = ('picons02.png');

/**********************************************************************
 * ln_get_color_theme
 **********************************************************************/
function ln_get_color_theme(){

	global $wp_query;
	global $ln_theme_bg_patterns;
	
	wp_reset_query();

	$page_en = 'false';
	
	if($wp_query->is_single){
		$q_id = get_the_ID();
	}else if(isset($wp_query->queried_object_id)){
		$q_id = $wp_query->queried_object_id;
	}

	if(!empty($q_id)){

		// get post/page meta data
		$page_en = get_post_meta($q_id, 'ln_meta_page_style_changes_enabled', true);
	}

	$theme = get_option('ln_theme_color_theme');
	$pattern = get_option('ln_theme_bg_pattern');
	$pattern_url = '';
	$custom_pattern = get_option('ln_theme_custom_bg_pattern');
	$custom_bg_color = get_option('ln_theme_custom_bg_color');
	$custom_bg_type = get_option('ln_theme_style_custom_background_type');
	$global_img_repeat = get_option('ln_theme_style_custom_background_repeat_type');

	if($theme == 'ln-custom'){
		echo '<link rel="stylesheet" type="text/css" href="'.INC_CSS.'/css/light/light.css" media="screen" />';
		echo '<link rel="stylesheet" type="text/css" href="'.INC_CSS.'/css/custom-theme/theme.css" media="screen" />';
	}else{
		echo '<link rel="stylesheet" type="text/css" href="'.$theme.'" media="screen" />';
	}

	if($page_en != 'on'){

		// background pattern
		if( (isset($pattern) && $pattern != 'no-pattern' && $custom_bg_type == 'pattern') || $custom_pattern != ''){

			if($custom_pattern == ''){
				foreach ($ln_theme_bg_patterns as $pat) {
					
					if($pat['id'] == $pattern){
						$pattern_url = $pat['pattern_img'];
						break;
					}
				}
			
			}else{
				$pattern_url = $custom_pattern;
			}

			if($pattern_url != ''){

				echo "<style type='text/css'>body { background-color: #".$custom_bg_color."; background-image: url('".$pattern_url."'); } </style>";
			}
		}

		if($custom_bg_type == 'custom-img'){

			echo "<style type='text/css'>body { background: none; background-color:#".$custom_bg_color."; } </style>";

		} 
	
	}else{

		// custom repeat img for individual page/post
		
		$page_bg_col = get_post_meta($q_id, 'ln_meta_page_style_bg_color', true);
		$page_img = get_post_meta($q_id, 'ln_meta_page_style_bg_img', true);
		$page_mode = get_post_meta($q_id, 'ln_meta_page_style_bg_img_repeat', true);
		
		// if this page/post has csutom background enabled
		if($page_mode == 'repeat' && $page_img != ''){
			
			echo "<style type='text/css'>body { background-color: #".$page_bg_col."; background-image: url('".$page_img."'); }</style>";
		
		}else{
			
			// only background color
			echo "<style type='text/css'>body { background-color: #".$page_bg_col."; background-image: none; }</style>";
		
		}

	}

}

/**********************************************************************
 * ln_get_custom_background
 * @param $scale - boolean - determine should it output background image scale
 **********************************************************************/
function ln_get_custom_background($scale){

	$custom_bg_type = get_option('ln_theme_style_custom_background_type');
	
	// get this page/post id and meta data
	wp_reset_query();

	global $wp_query;
	
	if($wp_query->is_single){
		$q_id = get_the_ID();
	}else if(isset($wp_query->queried_object_id)){
		$q_id = $wp_query->queried_object_id;
	}

	// if page ID is not empty
	if(!empty($q_id)){

		// get post/page meta data
		$page_en = get_post_meta($q_id, 'ln_meta_page_style_changes_enabled', true);
		$page_img = get_post_meta($q_id, 'ln_meta_page_style_bg_img', true);
		$page_mode = get_post_meta($q_id, 'ln_meta_page_style_bg_img_repeat', true);

		// if this page/post has csutom background enabled
		if($page_en == 'on'){

			if( isset($page_img) && $page_img != ''){

				if( $scale && $page_mode == 'scale'){
					
					// scale bg img
					echo '<div id="backstretch" data-img="'.esc_attr($page_img).'"></div>';

				}else if($page_mode == 'no-repeat'){

					// no-repeat img (centered)
					echo '<div id="big-background-image" style="background-image: url('.esc_attr($page_img).');"</div>';
				}

			}

		// show global image
		}else if($custom_bg_type == 'custom-img'){

			$global_img = get_option('ln_theme_custom_global_background_image');
			$global_img_repeat = get_option('ln_theme_style_custom_background_repeat_type');

			if( isset($global_img) && $global_img != ''){

				if( $scale && $global_img_repeat == 'scale'){
					
					// scale bg img
					echo '<div id="backstretch" data-img="'.esc_attr($global_img).'"></div>';

				}else if($global_img_repeat == 'no-repeat'){

					// no-repeat img (centered)
					echo '<div id="big-background-image" style="background-image: url('.esc_attr($global_img).');"</div>';
				}

			}
		}
	}
	
}

/**********************************************************************
 * ln_get_responsive_css
 **********************************************************************/
function ln_get_responsive_css(){

	$enabled = get_option('ln_theme_responsive_design_enabled');

	if(isset($enabled) && $enabled == 'true'){
		echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/media-queries.css" media="screen" />';
	}

}

/**********************************************************************
 * ln_get_responsive_viewport
 **********************************************************************/
function ln_get_responsive_viewport(){

	$enabled = get_option('ln_theme_responsive_design_enabled');

	if(isset($enabled) && $enabled == 'true'){
		echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	}

}

/**********************************************************************
 * ln_get_logo
 **********************************************************************/
function ln_get_logo(){
	
	$output = '';
	
	if(get_option('ln_theme_logo_text') == 'true'){
		//text logo
		$output .='<a href="'.get_bloginfo('url').'" class="no-eff"><h1>'.get_bloginfo('name').'</h1></a>';
	}else{
		
		if(get_option('ln_theme_logo') != ''){
			//uploaded logo
			$output .='<a href="'.get_bloginfo('url').'" class="no-eff"><img src="'.get_option('ln_theme_logo').'" title="'.get_bloginfo('name').'" alt="'.get_bloginfo('name').'" /></a>';
		}else{
			//default logo
			$path = 'light';
			$option_path = get_option('ln_theme_color_theme');
			$res = substr($option_path, strpos($option_path, 'css/')+4, strlen($option_path) );
			$res = substr($res, 0, strpos($res, '/') );	
		
			if($option_path == 'ln-custom'){
				$path = 'light';
			}else if($res){
				$path = $res;
			}
			
			$output .='<a href="'.get_bloginfo('url').'" class="no-eff"><img src="'.get_template_directory_uri().'/images/'.$path.'/logo.png" title="'.get_bloginfo('name').'" alt="'.get_bloginfo('name').'" /></a>';
		}
		
	}
	
	echo $output;
}

/**********************************************************************
 * ln_get_slogan
 **********************************************************************/
function ln_get_slogan(){
	
	$slogan = get_option('ln_theme_slogan');

	if(isset($slogan) && $slogan != ''){
		echo '<span class="slogan">'.$slogan.'</span>';
	}
}

/**********************************************************************
 * ln_get_header_banner
 **********************************************************************/
function ln_get_header_banner(){

	$enabled = get_option('ln_theme_enable_top_banner_img');
	$img = get_option('ln_theme_top_banner_img');
	$url = get_option('ln_theme_top_banner_url');
	$type = get_option('ln_theme_header_banner_type');
	$text_content = stripcslashes( get_option('ln_theme_header_banner_text') );

	if($enabled == 'true'){


		if($type == 'image' && $img != '' && $url != ''){

			echo '<div class="top-banner-full">
		          	<a href="'.$url.'" class="no-eff" target="_blank" title="'.$url.'"><img src="'.$img.'" alt="'.$url.'"/></a>
		          </div>';

		}else{
			echo '<div class="top-banner-full">'.$text_content.'</div>';
		}
	}	

}

/**********************************************************************
 * ln_get_favicon
 **********************************************************************/
function ln_get_favicon(){
	
	$output = '';
	
	if(get_option('ln_theme_favicon') != ''){
		
		$output .='<link rel="shortcut icon" href="'.get_option('ln_theme_favicon').'">';
	}
	
	echo $output;
}
/**********************************************************************
 * ln_get_main_social_icons
 **********************************************************************/
function ln_get_main_social_icons(){

	global $ln_main_social_icons;
	
	$icons = '';
	$color_theme = 'light';
	
	$color_option = get_option('ln_theme_color_theme');
	$custom_theme = get_option('ln_theme_styling_post_share_icons_color_variation');
	$res = substr($color_option, strpos($color_option, 'css/')+4, strlen($color_option) );
	$res = substr($res, 0, strpos($res, '/') );	

	if($res){
		$color_theme = $res;
	}

	if($color_option == 'ln-custom' && isset($custom_theme)){
		$color_theme = 'light'; // use images in light folder
	}

	$path = INC_CSS.'/images/'.$color_theme.'/social';
	
	foreach ($ln_main_social_icons as $k => $v) {
		
		$option = esc_attr(get_option('ln_main_social_icons_'.$k)); 

		if($option != ''){

			if($option == '#'){
				$target = '_self';
			}else{
				$target = '_blank';
			}

			$icons.= '<li><a class="no-eff" href="'.$option.'" title="'.ucfirst($k).'" target="'.$target.'"><img src="'.$path.'/'.$v.'" alt="'.$k.'"/></a></li>';
		
		}

	}

	if($icons != ''){

	   echo '<ul>'.$icons.'</ul>';

    }else{
    	
    	echo '';
    }

}

/**********************************************************************
 * ln_get_rss
 **********************************************************************/
function ln_get_rss(){
	
	$output = '';
	$output .='<link rel="alternate" type="application/rss+xml" title="';
	$output .= get_bloginfo('name');
	$output .=' RSS Feed" href="';
	
	if(get_option('ln_theme_feed_url') != ''){
		$output .= get_option('ln_theme_feed_url');
	}else{
		$output .= get_bloginfo('rss2_url');
	}
	
	$output .='"/>';
	
	echo $output;
}

/**********************************************************************
 * ln_add_custom_js
 **********************************************************************/
function ln_add_custom_js(){
	
	$output = '';
	
	if(get_option('ln_theme_custom_js') != ''){
		
		$output .= '<script type="text/javascript">';
		$output .= stripcslashes(get_option('ln_theme_custom_js'));
		$output .= '</script>';
	}
	
	echo $output;
}
add_action('wp_footer', 'ln_add_custom_js');

/**********************************************************************
 * ln_add_tracking
 **********************************************************************/
function ln_add_tracking(){
	
	$output = '';
	
	if(get_option('ln_theme_tracking_code') != ''){
		
		$output .= stripcslashes(get_option('ln_theme_tracking_code'));
		
	}
	
	echo $output;
}
add_action('wp_footer', 'ln_add_tracking');

/**********************************************************************
 * ln_add_custom_css
 **********************************************************************/
function ln_add_custom_css(){
	
	$output = '';
	
	if(get_option('ln_theme_custom_css') != ''){
		
		$output .= '<style type="text/css">';
		$output .= stripcslashes(get_option('ln_theme_custom_css'));
		$output .= '</style>';
	}
	
	echo $output;
}
add_action('wp_head', 'ln_add_custom_css');

/**********************************************************************
 * ln_get_custom_excerpt
 **********************************************************************/
function ln_get_custom_excerpt($text, $length){

	$text = strip_shortcodes($text);
	$text = strip_tags($text);

	$text = substr($text, 0, $length);
	$excerpt = strrpos($text, '.', 1) ? substr($text, 0, strrpos($text, '.') + 1) : false;
	
	if($excerpt){
		return apply_filters('the_excerpt', $excerpt.'..' );
	}else{
		return apply_filters('the_excerpt', $text.'...' );
	}
}

/**********************************************************************
 * ln_get_fonts
 **********************************************************************/
function ln_get_fonts(){

	$heading_font = get_option('ln_theme_heading_font');
	$body_font = get_option('ln_theme_content_font');

	$start = strpos($heading_font, '=')+1;
	$end = strpos($heading_font, ':');

	if(!$end){
		$end = strlen($heading_font);
	}

	$heading_font_family = str_replace('+', ' ', substr($heading_font, $start, $end - $start) );
	
	
	$start = strpos($body_font, '=')+1;
	$end = strpos($body_font, ':');
		
	if(!$end){
		$end = strlen($body_font);
	}

	$body_font_family =  str_replace('+', ' ', substr($body_font, $start, $end - $start) );

	
	echo '<link href="http://'.$heading_font.'" rel="stylesheet">';
	echo '<link href="http://'.$body_font.'" rel="stylesheet">';

	echo '<style type="text/css">
			body { font-family: \''.$body_font_family.'\', Helvetica, Arial, sans-serif; }
			h1, h2, h3, h4, h5, h6, blockquote, nav a, .score, .ln-social-widget .number { font-family: \''.$heading_font_family.'\', Helvetica, Arial, serif }
		  </style>';

}

/***************************************
 * Get Comment Form Options
 * @return array of options
 ***************************************/
function ln_get_comment_form_options(){

	$commenter = wp_get_current_commenter();
	
	$fields =  array(
		'author' => '<div>  
						<input type="text" name="author" id="comment_name" class="required" aria-required="true" size="30" value="'.esc_attr( $commenter['comment_author'] ).'"/>
						<label for="comment_name">'.__('Name*', 'framework').'</label>
					 </div>',
		'email'  => '<div>
						<input type="email" name="email" id="comment_email" class="required email" aria-required="true" size="30" value="'.esc_attr(  $commenter['comment_author_email'] ).'"/>
						<label for="comment_email">'.__('Email*', 'framework').'</label>
					</div>',
		'url'    => '<div>
						<input type="text" name="url" id="comment_url" value="'.esc_attr( $commenter['comment_author_url'] ).'"/>
						<label for="comment_url">'.__('Website', 'framework').'</label>
					 </div>'
	);


	$comments_args = array(
							'fields' => apply_filters( 'comment_form_default_fields', $fields ),
							'title_reply' => '</h3><div class="section-head">			
												<h3>'.__('Leave a Comment', 'framework').'</h3>
												<div class="section-line"></div>
											</div><h3>',
							'title_reply_to' => '</h3><div class="section-head">			
													<h3>'.__('Leave a Reply', 'framework').'</h3>
													<div class="section-line"></div>
												</div><h3>',			
        					'comment_notes_before' => '',
        					'comment_notes_after' => '',
        					'label_submit' => __('Add Comment', 'framework'),
        					'comment_field' => '<textarea aria-required="true" class="required" name="comment" rows="9" cols="10" id="comment" onfocus="if(this.value==this.defaultValue){this.value=\'\'}" onblur="if(this.value==\'\'){this.value=this.defaultValue}">'.__('Add Your Comment', 'framework').'</textarea>',
					);

	return $comments_args;
}

/***************
 * ln_social_widget_get_request_data
 */
function ln_social_widget_get_request_data($url){

	if(function_exists('curl_init')){
		// CURL
		$ch = curl_init();
		$timeout = 5;

		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		
		$buff = curl_exec($ch);
		curl_close($ch);

		return $buff;

	}else{
		// file get contents
		return file_get_contents($url);
		
	}

	return false;
}

?>