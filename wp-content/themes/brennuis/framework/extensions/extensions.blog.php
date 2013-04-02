<?php

/************************** Post formats meta data **************************/
$ln_post_formats_options = array();

// link
$ln_post_formats_options[] = array( "name" => __("Featured image", "framework"),
							"desc" => __("Hide standard post featured image in single post page", "framework"),
							"id" => SHORT_NAME."_post_meta_hide_img_head",
							"type" => "heading");

// hide featured image
$ln_post_formats_options[] = array( "name" => __("Hide featured image", "framework"),
							"desc" => __("Hide featured image:", "framework"),
							"id" => SHORT_NAME."_post_meta_standard_hide_fimage",
							"std" => "false",
							"class" => "ln-input",
							"type" => "checkbox");

// link
$ln_post_formats_options[] = array( "name" => __("Link", "framework"),
							"desc" => __("Options for post format - Link", "framework"),
							"id" => SHORT_NAME."_post_meta_link_head",
							"type" => "heading");

$ln_post_formats_options[] = array( "name" => __("Link URL", "framework"),
							"desc" => __("URL:", "framework"),
							"id" => SHORT_NAME."_post_meta_url",
							"std" => "",
							"class" => "ln-input",
							"type" => "text");

// quote
$ln_post_formats_options[] = array( "name" => __("Quote", "framework"),
							"desc" => __("Options for post format - Quote", "framework"),
							"id" => SHORT_NAME."_post_meta_quote_head",
							"type" => "heading");

$ln_post_formats_options[] = array( "name" => __("Quote text:", "framework"),
							"desc" => __("Quote text:", "framework"),
							"id" => SHORT_NAME."_post_meta_quote_text",
							"std" => "",
							"class" => "ln-input",
							"type" => "textarea");

$ln_post_formats_options[] = array( "name" => __("Quote author", "framework"),
							"desc" => __("Quote author:", "framework"),
							"id" => SHORT_NAME."_post_meta_quote_author",
							"std" => "",
							"class" => "ln-input",
							"type" => "text");

// Video
$ln_post_formats_options[] = array( "name" => __("Video", "framework"),
							"desc" => __("Options for post format - Video", "framework"),
							"id" => SHORT_NAME."_post_meta_video_head",
							"type" => "heading");

$ln_post_formats_options[] = array( "name" => __("Video embed code:", "framework"),
							"desc" => __("Video embed code:", "framework"),
							"id" => SHORT_NAME."_post_meta_video_embed_code",
							"std" => "",
							"class" => "ln-input",
							"type" => "textarea");

// Audio
$ln_post_formats_options[] = array( "name" => __("Audio", "framework"),
							"desc" => __("Options for post format - Audio", "framework"),
							"id" => SHORT_NAME."_post_meta_audio_head",
							"type" => "heading");

$ln_post_formats_options[] = array( "name" => __("Audio embed code:", "framework"),
							"desc" => __("SoundCloud embed code:", "framework"),
							"id" => SHORT_NAME."_post_meta_audio_embed_code",
							"std" => "",
							"class" => "ln-input",
							"type" => "textarea");

/************************** social share icons **************************/
$ln_single_post_social_share_icons = array();
$ln_single_post_social_share_icons['pinterest'] = ('pinterest-big.png');
$ln_single_post_social_share_icons['facebook'] = ('picons36.png');
$ln_single_post_social_share_icons['twitter'] = ('picons33.png');
$ln_single_post_social_share_icons['google'] = ('picons39.png');
$ln_single_post_social_share_icons['delicious'] = ('picons49.png');
$ln_single_post_social_share_icons['digg'] = ('picons38.png');
$ln_single_post_social_share_icons['linkedin'] = ('picons41.png');
$ln_single_post_social_share_icons['stumbleupon'] = ('picons54.png');

/************************** page style options **************************/
$ln_page_style_options = array();

$ln_page_style_options[] = array( "name" => "Enable changes",
							"desc" => __("Enable or disable page style options", "framework"),
							"id" => SHORT_NAME."_meta_page_style_en_head",
							"std" => "",
							"class" => "ln-input",
							"type" => "heading");

$ln_page_style_options[] = array( "name" => "",
							"desc" => __("Enable changes:", "framework"),
							"id" => SHORT_NAME."_meta_page_style_changes_enabled",
							"std" => "false",
							"class" => "ln-input",
							"type" => "checkbox");

$ln_page_style_options[] = array( "name" => "Background",
							"desc" => __("Background style options", "framework"),
							"id" => SHORT_NAME."_meta_page_style_head",
							"std" => "",
							"class" => "ln-input",
							"type" => "heading");

$ln_page_style_options[] = array( "name" => "",
							"desc" => __("Background Color:", "framework"),
							"id" => SHORT_NAME."_meta_page_style_bg_color",
							"std" => "ffffff",
							"class" => "ln-input",
							"type" => "color-picker",
							"style" => "margin-top: 10px;");

$ln_page_style_options[] = array( "name" => __("Background image:", "framework"),
							"desc" => __("Background image:", "framework"),
							"id" => SHORT_NAME."_meta_page_style_bg_img",
							"std" => "",
							"class" => "ln-upload",
							"type" => "image");

$ln_page_style_options[] = array( "name" => "",
							"desc" => __("Background repeat:", "framework"),
							"id" => SHORT_NAME."_meta_page_style_bg_img_repeat",
							"std" => "no-repeat",
							"class" => "ln-input",
							"options" => array('no-repeat' => 'No repeat', 'repeat' => 'Repeat', 'scale' => 'Scale image' ),
							"type" => "select");

/************************** category  select options **************************/
$ln_template_category_page_options = array();

$ln_template_category_page_options[] = array( "name" => "Category Page Options",
											"desc" => __("Category Page Options", "framework"),
											"id" => SHORT_NAME."_meta_category_page_options_head",
											"std" => "",
											"class" => "ln-input",
											"type" => "heading");

$ln_template_category_page_options[] = array( "name" => "",
											"desc" => __("Posts Category:", "framework"),
											"id" => SHORT_NAME."_meta_catgory_page_select_category",
											"std" => "ln-recent-regular-posts",
											"class" => "ln-input",
											"type" => "category-select");

$ln_template_category_page_options[] = array( "name" => "",
											"desc" => __("Enable Pagination:", "framework"),
											"id" => SHORT_NAME."_meta_category_page_enable_pagination",
											"std" => "false",
											"class" => "ln-input",
											"type" => "checkbox");

$ln_template_category_page_options[] = array( "name" => "",
											"desc" => __("Number of posts:", "framework"),
											"id" => SHORT_NAME."_meta_category_page_numbef_of_posts",
											"std" => "10",
											"class" => "ln-input small-text",
											"type" => "text");

/*************************************************************
 * post metabox user interface
 *************************************************************/
function ln_post_formats_meta_iu(){
	
	global $ln_post_formats_options;
	echo ln_show_metabox_options($ln_post_formats_options); // in metabox extensions
}

/*************************************************************
 * post and page style metabox - user interface
 *************************************************************/
function ln_post_page_style_meta_iu(){
	
	global $ln_page_style_options;
	echo ln_show_metabox_options($ln_page_style_options); // in metabox extensions
}

/*************************************************************
 * page templates category select 
 *************************************************************/
function ln_post_page_category_select_meta_iu(){

	global $ln_template_category_page_options;
	echo ln_show_metabox_options($ln_template_category_page_options); // in metabox extensions
}

/*************************************************************
 * Review metabox UI
 *************************************************************/
function ln_review_metabox_iu(){
	
	// get saved review criterias 
	// display them as select list
	// user selects a criteria and clicks publish 
	// now find slected criteria fields and display them below
	// save fields on publish as an array
	global $post;

	$saved_criteria = get_option('ln_custom_rating_criteria_array');
	$saved_post_criteria = get_post_meta($post->ID, 'ln_review_meta_selected_criteria', true);
	$saved_post_fields = get_post_meta($post->ID, 'ln_review_meta_fileds_values', true);
	$found = false;
	$found_fields;
	$count = 0;

	$output = '<div id="ln-meta-options-section">';
	wp_nonce_field('ln_nonce_save_action', 'ln_wpnonce', false, true );


	$output .= '<div class="ln-portfolio-desc" style="display: block; width: 350px; margin: 20px 0 5px 5px;">'.__('Select rating criteria and click publish/update button.', 'framework').'</div>';
	$output .= '<select id="ln_post_review_select_criteria" name="ln_post_review_select_criteria" class="ln-page-builder-select" style="margin-left: 5px; width: 170px; margin-bottom:20px; ">';
	$output .='		<option value="select" disabled=disabled selected=selected>Select Rating Criteria</option>';
										
	if(isset($saved_criteria) && !empty($saved_criteria)) {
		$selec = '';

	 	foreach ($saved_criteria as $k => $v) {
			
	 		if($v['id'] == $saved_post_criteria){
	 			$selec = 'selected=selected';
	 		}

			$output .= '<option value="'.$v['id'].'" '.$selec.'>'.ereg_replace("\\\'", '"',stripslashes($v['name']) ).'</option>';
			
			$selec = '';		
		}
	}

	$output .= '</select>';
	
	// output rating fields 
	if(isset($saved_post_criteria) && !empty($saved_post_criteria)) {

		// find saved id in criterias
		foreach ($saved_criteria as $k => $v){
			if($v['id'] == $saved_post_criteria){
				$found = true;
				$found_fields = explode('/', $v['fields']);
				
				break;
			}
		}

		// output fields
		if($found){

			$output .= '<div>';
			
			foreach ($found_fields as $k => $v) {
				
				$new_val = 5; // default field value
				$crit_title = ereg_replace("\\\'", '"',stripslashes($v));

				if(isset($saved_post_fields[$crit_title])){
					$new_val = esc_attr( $saved_post_fields[$crit_title] );
				}

				$output .= '<div id="ln-criteria-score-field-'.$count.'"> <div class="ln-portfolio-desc" style="float:left; margin-top: 8px;">'.$crit_title.'</div>';
				$output .= '<input id="ln_criteria_field_score['.$count.']" name="ln_criteria_field_score['.$count.']" type="text" class="ln-input ln-ui-slider-field" style="width:40px" value="'.$new_val.'" />';
				$output .= '<input type="hidden" id="ln_criteria_field_key['.$count.']" name="ln_criteria_field_key['.$count.']" value="'.$crit_title.'" />';
				$output .= '<div data-value="'.$new_val.'" data-field="ln-criteria-score-field-'.$count.'" class="ln-ul-slider">';
				$output .= '	<a class="ui-slider-handle" href="#"></a>';
				$output .= '</div><div class="ln-clear"></div> </div>';

				$count +=1;
			}

			$output .= '</div>';

		}
	}

	// Use as review post checkbox
	$checked = '';
		
	$output .= '<div class="ln-checkboxes" style="margin: 10px 0 20px 0; float:none;">';
	$chek_val = get_post_meta($post->ID, 'ln_review_meta_use_as_review', true);

	if(isset($chek_val) && !empty($chek_val)){
							
		if($chek_val == 'on'){
			$checked = 'checked="checked"';
		}else{
			$checked = '';
		}
		
	}else{
		$checked = '';
	}

	
	$output .= '<div class="ln-portfolio-desc"> <label for="ln_review_meta_use_as_review" style="font-size:12px;">'.__('Use for review post', 'framework').'</label></div>
	<input type="checkbox" id="ln_review_meta_use_as_review" '.$checked.' name="ln_review_meta_use_as_review" />';
	$output .= '</div><div class="ln-clear"></div>';
	
	$saved_verdict = get_post_meta($post->ID, 'ln_review_meta_fileds_review_verdict', true);

	// review verdict
	$output .= '<div class="ln-portfolio-desc" style="float: left;">'.__('Review Verdict:', 'framework').'</div>';
	$output .= '<textarea rows="5" cols="25" id="ln-meta-review-verdict-text" class="ln-input" name="ln-meta-review-verdict-text" >'.esc_attr( $saved_verdict ).'</textarea>';
	$output .= '<div class="ln-clear"></div></div>';

	echo $output;

}

/**********************************************************************
 * ln_add_post_formats_metabox
 **********************************************************************/
function ln_add_post_formats_metabox(){
	
	global $post;
	
	$template = get_post_meta( $post->ID, '_wp_page_template', true );

	// post formats meta box
	add_meta_box('ln-post-formats-meta', __('Post formats options', 'framework'), 'ln_post_formats_meta_iu', 'post', 'normal', 'high');
	add_meta_box('ln-review-meta', __('Review Post Options', 'framework'), 'ln_review_metabox_iu', 'post', 'normal', 'high');

	// page/post style options
	add_meta_box('ln-post-page-style-meta', __('Page Style Options', 'framework'), 'ln_post_page_style_meta_iu', 'post', 'normal', 'high');
	add_meta_box('ln-post-page-style-meta', __('Page Style Options', 'framework'), 'ln_post_page_style_meta_iu', 'page', 'normal', 'high');

	// tempalte-category-view and tempalte-top-reviews
	if($template == "template-category-view.php" || $template == "template-top-reviews.php"){
		add_meta_box('ln-post-page-category-select-meta', __('Category Options', 'framework'), 'ln_post_page_category_select_meta_iu', 'page', 'normal', 'high');
	}
	
}
add_action('add_meta_boxes', 'ln_add_post_formats_metabox');

/**********************************************************************
 * Change post excerpt length 
 **********************************************************************/
function ln_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'ln_excerpt_length' );

/**********************************************************************
 * Change post excerpt read more 
 **********************************************************************/
function ln_excerpt_more( $more ) {
	
	return '... <a href="'. esc_url( get_permalink() ) . '">' . __( 'Read More &rarr;', 'framework' ) . '</a>';
}
add_filter( 'excerpt_more', 'ln_excerpt_more' );

/**********************************************************************
 * Get Blog Posts + Pagination
 **********************************************************************/
function ln_get_blog_posts(){

	// ============================== LOOP =============================== //
	if( have_posts() ) : while ( have_posts() ) : the_post();
		
		// ======== BEGIN POST ENTRY ========= //
		$format = get_post_format();
	
		if ($format === false){
			$format = "standard";
		}
		
		// get post format
		get_template_part('framework/post-formats/format-'.$format);

		// ======== END POST ENTRY ========= //

	endwhile; 
	// ============================== END LOOP =============================== //
	
	else: // no posts found
		
		echo '<h2 class="page-title">'.__('Nothing found!', 'framework').'</h2>';
	
	endif;

	// add pagination
	kriesi_pagination();
}

/**********************************************************************
 * kriesi_pagination
 * 
 * http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 *
 **********************************************************************/
function kriesi_pagination($pages = '', $range = 2){  
     
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
		
		 echo "<div class='ln-pagination ln-col-full'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."' class='no-eff begin'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='no-eff minus' >-</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='no-eff inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' class='no-eff plus'>+</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."' class='no-eff end' >&raquo;</a>";
         echo "</div>\n";
     }
}

/**********************************************************************
 * Get single post review score
 **********************************************************************/
function ln_get_single_review_score(){

	if( get_post_meta( get_the_ID(), 'ln_review_meta_use_as_review', true ) == 'on'):

		$total_score = esc_attr( get_post_meta(get_the_ID(), 'ln_review_meta_fileds_score', true) );
		$field_values = get_post_meta(get_the_ID(), 'ln_review_meta_fileds_values', true);
		$verdict = get_post_meta(get_the_ID(), 'ln_review_meta_fileds_review_verdict', true);
		
		if(isset($field_values) && !empty($field_values)):

?>
		
		<section class="ln-review-post-rating ln-col-full">
			<div class="rating-wrap">
				<div class="rating-box" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
					<meta itemprop="worstRating" content="0">
      				<meta itemprop="bestRating" content="10"> 
					<span class="score" itemprop="ratingValue"><?php echo $total_score; ?></span>
					<span><?php _e('score', 'framework'); ?></span>
				</div>

				<div class="rating-numbers">
					<ul>
						
					<?php foreach ($field_values as $k => $v): 

						$bar_width = str_replace('.', '', $v);
						
						if( strlen($bar_width) == 1){
							$bar_width = $bar_width.'0';
						}

						if($v == '10'){
							$bar_width = '100';
						}

						if(substr($bar_width, 0, 1) == '0'){
							$bar_width = substr($bar_width, 1);
						}
					?>
						<li>
							<span class="criteria"><?php echo $k; ?>:</span> <strong><?php echo $v; ?></strong>
							<div class="criteria-score">
								<div class="bar" style="width: <?php echo $bar_width; ?>%;"></div>
							</div>
						</li>

					<?php endforeach; ?>

					</ul>
				
				</div>

				<p><?php echo $verdict; ?></p>

			</div>
		</section>

<?php
		endif;

	endif;

}

/**********************************************************************
 * Get single post tags
 **********************************************************************/
function ln_get_single_tags_list(){

	$tags = get_the_tags();

	if(isset($tags) && $tags){
		echo '<section class="ln-post-tags ln-col-full">';
		the_tags( '', ' ', '' );
		echo '</section>';
	}

}

/**********************************************************************
 * Get single post social share box
 **********************************************************************/
function ln_get_single_social_share(){

	global $ln_single_post_social_share_icons;

	$icons = '';
	$color_theme = 'light';

	$color_option = get_option('ln_theme_color_theme');
	$res = substr($color_option, strpos($color_option, 'css/')+4, strlen($color_option) );
	$res = substr($res, 0, strpos($res, '/') );	

	if($res){
		$color_theme = $res;
	}

	if($color_option == 'ln-custom' && isset($custom_theme)){
		$color_theme = $custom_theme;
	}

	$path = INC_CSS.'/images/'.$color_theme.'/social';
	$share_link = '#';

	$title = urlencode(get_the_title());

	foreach ($ln_single_post_social_share_icons as $k => $v) {
		
		if(get_option('ln_single_posts_social_icon_enabled_'.$k) == 'true'){
			
			switch ($k) {

				case 'pinterest':
					$share_link = 'http://pinterest.com/pin/create/button/?url='.urlencode( get_permalink(get_the_ID()) ).'&amp;media='.urlencode( wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ).'&amp;description='.urlencode( get_the_excerpt() );	
					break;

				case 'facebook':
					$share_link = 'http://www.facebook.com/share.php?u='.get_permalink(get_the_ID());	
					break;
				
				case 'twitter':
					$share_link = 'http://twitter.com/home?status='.$title.'%20-%20'.get_permalink(get_the_ID());
					break;

				case 'google':
					$share_link = 'http://www.google.com/bookmarks/mark?op=edit&amp;bkmk='.get_permalink(get_the_ID()).'&amp;title='.$title;
					break;

				case 'delicious':
					$share_link = 'http://delicious.com/post?url='.get_permalink(get_the_ID()).'&amp;title='.$title;
					break;

				case 'digg':
					$share_link = 'http://digg.com/submit?url='.get_permalink(get_the_ID()).'&amp;title='.$title;
					break;

				case 'linkedin':
					$share_link = 'http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_permalink(get_the_ID()).'&amp;title='.$title;
					break;

				case 'stumbleupon':
					$share_link = 'http://www.stumbleupon.com/submit?url='.get_permalink(get_the_ID()).'&amp;title='.$title;
					break;
			}

			$icons.= '<li><a class="no-eff" href="'.$share_link.'" target="blank" title="Share on '.ucfirst($k).'"><img src="'.$path.'/'.$v.'" alt="'.$k.'"/></a></li>';

		}

	}

	if($icons != ''){


		echo '<section class="ln-post-share ln-col-full">
				<ul>'.$icons.'</ul>
			  </section>';

	}

}

/**********************************************************************
 * Get single post authro info
 **********************************************************************/
function ln_get_single_author_info(){

	$author_bio = get_the_author_meta('description');
	$author_avatar = get_avatar( get_the_author_meta('email'), '50');

	if(get_option('ln_magazine_blog_about_the_author_enable') == 'true'):

?>
		<aside class="ln-post-author ln-col-full" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
			<div class="section-head">
				<h3 itemprop="name"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php the_author(); ?>" ><?php the_author(); ?></a></h3>
				<span class="arrow"></span>
				<div class="section-line"></div>
			</div>
			<div class="clear"></div>

			<div class="ln-author-avatar">
				<?php echo $author_avatar;?>
			</div>
			<div class="ln-author-bio">
				<p><?php echo $author_bio; ?></p>
			</div>
			<div class="clear"></div>
		</aside>
<?php

	endif;

}

/**********************************************************************
 * Get single post next and prev links
 **********************************************************************/
function ln_get_single_next_prev_links(){


	$has_prev = false;
	$has_next = false;

	$prev_obj = get_previous_post();
	$next_obj = get_next_post();

	if(!empty($prev_obj)){ 
		$has_prev = true;
	}

	if(!empty($next_obj)){
		$has_next = true;
	}

	if($has_prev || $has_next):

?>
	
	<section class="ln-post-navigation ln-col-full">
		
		<?php if($has_prev): ?>
		<div class="ln-post-link prev ln-col-half">
			<span><?php _e('Previous Story' , 'framework'); ?></span>
			<h5><a href="<?php echo $prev_obj->guid ?>" title="<?php echo $prev_obj->post_title ?>"><?php echo $prev_obj->post_title ?></a></h5>
		</div>
		<?php endif; ?>

		<?php if($has_next): ?>
		<div class="ln-post-link next ln-col-half last-item">
			<span><?php _e('Next Story', 'framework'); ?></span>
			<h5><a href="<?php echo $next_obj->guid ?>" title="<?php echo $next_obj->post_title ?>"><?php echo $next_obj->post_title ?></a></h5>
		</div>
		<?php endif; ?>
		
		<div class="clear"></div>
	</section>

<?php 
	
	endif;

}

/**********************************************************************
 * Get single post related posts carousel
 **********************************************************************/
function ln_get_single_post_related_posts(){

	if(get_option('ln_magazine_blog_realted_carousel_enable') == 'true'){

		$items = '';
 		$item_width = 200; // carousel item width in pixels width+margin
 		$list_width = 0;
 		$default_carousel_thumb = INC_CSS.'/images/carousel-default-img.png';

		// get post categories and query DB
		$categories = '';
		$number_of_items = get_option('ln_magazine_blog_related_posts_number');

		if(!isset($number_of_items) || $number_of_items == ''){
			$number_of_items = 7;
		}

		foreach((get_the_category()) as $cat) {
			$categories.= $cat->term_id.','; 
		}

		query_posts( array('post_type' => 'post', 'cat' => $categories, 'posts_per_page' => $number_of_items, 'orderby' => 'rand', 'post__not_in' => array(get_the_ID()) ) );

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
    						<img src="'.$default_carousel_thumb.'" alt="'.get_the_title().'"/>
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

		// reset query
		wp_reset_query();

		// check if there is at least one recent post
		if( isset($items) && $items != ''):

		?>

		<section class="ln-carousel-module ln-col-full">

			<div class="section-head">
				<h3><?php _e('Related Posts', 'framework'); ?></h3>
				<div class="section-line"></div>
			</div>

			<div class="ln-carousel">
				<div class="control prev"><span></span></div>
				<div class="slider-wrapper">
					<ul style="width: <?php echo $list_width; ?>px;">
					<?php echo $items; ?>
					</ul>
				</div>
				<div class="control next"><span></span></div>
			</div>
			<div class="clear"></div>
		
		</section>

		<?php

		endif;
	}

}

/**********************************************************************
 * Get Top reviews 
 * 
 * @param - posts category
 * @param - number of posts to display
 * @param - (string) enable pagination (default 'on')
 **********************************************************************/
function ln_get_top_reviews($posts_category, $number_of_items, $page_enable_pg = 'on'){

	global $paged;
    if(empty($paged)) $paged = 1;

    if($posts_category == 'ln-recent-regular-posts'){
		query_posts( array('post_type' => 'post', 'posts_per_page' => $number_of_items,  'paged' => $paged, 'orderby' => 'meta_value_num', 'meta_key' => 'ln_review_meta_fileds_score', 'order' => 'DESC') );
    }else{
		query_posts( array('post_type' => 'post', 'category_name' => $posts_category, 'posts_per_page' => $number_of_items,  'paged' => $paged, 'orderby' => 'meta_value_num', 'meta_key' => 'ln_review_meta_fileds_score', 'order' => 'DESC') );
	}

	// ============================== LOOP =============================== //
	if( have_posts() ) : while ( have_posts() ) : the_post();
		
		// ======== BEGIN POST ENTRY ========= //
		$format = "standard";

		// get post format
		get_template_part('framework/post-formats/format-'.$format);

		// ======== END POST ENTRY ========= //

	endwhile; 
	// ============================== END LOOP =============================== //
	
	else: // no posts found
		
		echo '<h2 class="page-title">'.__('Nothing found!', 'framework').'</h2>';
	
	endif;

	if($page_enable_pg == 'on'){

		// add pagination
		kriesi_pagination();

	}

	// reset query
	wp_reset_query();
    
}

/**********************************************************************
 * Get Posts from given category
 * 
 * @param - posts category
 * @param - number of posts to display
 * @param - (string) enable pagination (default 'on')
 **********************************************************************/
function ln_get_posts_form_category($posts_category, $number_of_items, $page_enable_pg = 'on'){

	global $paged;
    if(empty($paged)) $paged = 1;

    if($posts_category == 'ln-recent-regular-posts'){
		query_posts( array('post_type' => 'post', 'posts_per_page' => $number_of_items,  'paged' => $paged) );
    }else{
		query_posts( array('post_type' => 'post', 'category_name' => $posts_category, 'posts_per_page' => $number_of_items,  'paged' => $paged) );
	}

	// ============================== LOOP =============================== //
	if( have_posts() ) : while ( have_posts() ) : the_post();
		
		// ======== BEGIN POST ENTRY ========= //
		$format = get_post_format();
	
		if ($format === false){
			$format = "standard";
		}
		
		// get post format
		get_template_part('framework/post-formats/format-'.$format);

		// ======== END POST ENTRY ========= //

	endwhile; 
	// ============================== END LOOP =============================== //
	
	else: // no posts found
		
		echo '<h2 class="page-title">'.__('Nothing found!', 'framework').'</h2>';
	
	endif;

	if($page_enable_pg == 'on'){

		// add pagination
		kriesi_pagination();

	}

	// reset query
	wp_reset_query();
    
}

/**********************************************************************
 * ln_add_blog_slider_js - Gallery post format slider
 **********************************************************************/
function ln_add_blog_slider_js(){
	
	$animation = get_option('ln_blog_gallery_slider_transition');
	$slideshow = get_option('ln_blog_gallery_slider_slideshow');
	$slideshowSpeed = get_option('ln_blog_gallery_slider_slideshow_value');
	$duration = get_option('ln_blog_gallery_slider_animation_duration');

	if($slideshow != 'true'){
		$slideshow = 'false';
	}

	?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		// post format gallery 
		function blogFormatGallerySlider(){
			$('.ln-gallery-post').flexslider({
			    animation: '<?php echo $animation; ?>',
			    smoothHeight: true,
			    slideshow: <?php echo $slideshow; ?>,
			    pauseOnHover: true,
			    animationSpeed: <?php echo $duration; ?>,
			    slideshowSpeed: <?php echo $slideshowSpeed; ?>,
			    start: function(slider){
				   	var btns = slider.controlNav;

					for(i=0; i<slider.count; i++){
						$(btns[i]).append('<img src="'+$(slider.slides[i]).attr('data-small')+'" />' );
					}	
				}
			});
		}setTimeout(blogFormatGallerySlider, 100);
	});
	</script>
	<?php
}

/**********************************************************************
 * ln_add_slider_module_js - Slider Module JS
 **********************************************************************/
function ln_add_slider_module_js(){
	
	$animation = get_option('ln_module_slider_transition');
	$slideshow = get_option('ln_module_slider_slideshow');
	$slideshowSpeed = get_option('ln_module_slider_slideshow_value');
	$duration = get_option('ln_module_slider_animation_duration');

	if($slideshow != 'true'){
		$slideshow = 'false';
	}

	?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		// Slider Module
		$('.ln-slider-module').flexslider({
		    animation: '<?php echo $animation; ?>',
		    smoothHeight: false,
		    slideshow: <?php echo $slideshow; ?>,
		    pauseOnHover: true,
		    animationSpeed: <?php echo $duration; ?>,
		    slideshowSpeed: <?php echo $slideshowSpeed; ?>,
		    start: function(slider){
			   	var btns = slider.controlNav;

				for(i=0; i<slider.count; i++){
					$(btns[i]).append('<img src="'+$(slider.slides[i]).attr('data-small')+'" />' );
				}	
			}
		});
	});
	</script>
	<?php
}

/**********************************************************************
 * ln_add_blog_fancybox_js
 **********************************************************************/
function ln_add_blog_fancybox_js(){
	
?>	
	<!-- Fancybox -->
   	<script type="text/javascript">
   		jQuery(document).ready(function($){
		    $("a.lightbox").fancybox({
				'transitionIn'	:	'fade',
				'transitionOut'	:	'fade',
				'speedIn'		:	250, 
				'speedOut'		:	250, 
				'overlayShow'	:	true
			});

		});
	</script>
	
<?php
 
}//end ln_add_blog_fancybox_js

/**********************************************************************
 * ln_magazine_js_script
 **********************************************************************/
function ln_magazine_js_script(){
	
	wp_reset_query();

	// Post Format Gallery
	if(is_home() || is_singular() || is_page_template('template-magazine.php') || is_search() || is_tag() || is_category() || is_archive()){
		ln_add_blog_slider_js();
	}

	// Lightbox
	if((is_singular() || is_home() || is_search() || is_tag() || is_category() || is_archive()) && get_option('ln_theme_enable_lightbox') == 'true'){
		ln_add_blog_fancybox_js();
	}

	// Slider Module
	if(is_home() || is_page_template('template-magazine.php')){
		ln_add_slider_module_js();
	}

}
add_action('wp_print_footer_scripts', 'ln_magazine_js_script');

?>