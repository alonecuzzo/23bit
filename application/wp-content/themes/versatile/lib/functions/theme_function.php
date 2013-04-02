<?php
/*=================================*/
// Custom Sidebar
/*=================================*/
$sidebarwidget=get_option('customsidebar');
$theme_data =get_theme_data(TEMPLATEPATH . '/style.css');
$sys_version= $theme_data['Version'];
function wp_menu_functon(){
	wp_nav_menu( array(
	'container' =>false,
	'theme_location' => 'top-menu',
	'menu_class' => 'nav',
	'echo' => true,
	'before' => '',
	'after' => '',
	'link_before' => '',
	'link_after' => '',
	'depth' => 0,
	'walker' => new description_walker())
	);
	return true;
}

// sub header teasser options
function sub_header_text($postid) {
	$radio=get_post_meta($postid, "radio_options", TRUE);
	switch($radio) {
case "disable":
echo "";
break;
case "custom":
	if(is_single()){ 
	$page = get_post($postid);
		echo "<div class='subheader'>";
		echo "<div class='subtitle'><h1>".$page->post_title."</h1></div>";
		echo "<div class='subdesc'>".stripslashes(get_post_meta($postid, "page_desc", TRUE))."</div>";
		echo "</div>";
	}
	else
	{
		$page = get_post($postid);
		echo "<div class='subheader'>";
		echo "<div class='subtitle'><h1>".$page->post_title."</h1></div>";
		echo "<div class='subdesc'>".do_shortcode(stripslashes(get_post_meta($postid, "page_desc", TRUE)))."</div>";
		echo "</div>";
	}
break;
case "customhtml":
	if(is_single()){ 
		$cat = get_the_category($post_id); 
		$cat_title=$cat[0]->cat_name;
		echo "<div class='subheader'>";
		echo "<div class='subhtml'>".do_shortcode(stripslashes(get_post_meta($postid, "page_desc", TRUE)))."</div>";
		echo "</div>";
	}
	else
	{
		$page = get_post($postid);
		echo "<div class='subheader'>";
		echo "<div class='subhtml'>".do_shortcode(stripslashes(get_post_meta($postid, "page_desc", TRUE)))."</div>";
		echo "</div>";
	}
break;
case "twitter":
	$twit_username=get_option("sys_twitter_teaser_username");
	if($twit_username) {
		$twit_count="1";
		echo "<div class='subheader'>";
		echo "<div class='subdesc'>";
		echo parse_cache_feed($twit_username,$twit_count,$type);
		echo "</div>";
		echo "</div>";
		wp_reset_query();
	}
	else
	{
		echo "<div class='subdesc'>'.__(Please enter twitter username in Theme options panel general tab','versatile_admin').'</div>"; }
break;
case "default":
	if(is_single()){ 

	$page = get_post($postid);
		echo "<div class='subheader'>";
		echo "<div class='subtitle'><h1>".$page->post_title."</h1></div>";	
	}
	else
	{
		$page = get_post($postid);
		echo "<div class='subheader'>";
		echo "<div class='subtitle'><h1>".$page->post_title."</h1></div>";
	}

	$header_teaser_text=get_option("sys_header_teaser");
	if($header_teaser_text =="sys_headerteaser_text"){
		echo "<div class='subdesc'>";
		echo do_shortcode(stripslashes(get_option("sys_header_teasertext")));
		echo "</div>";
	}

	if($header_teaser_text =="sys_headerteaser_twitter"){
	$usernames=get_option("sys_twitter_teaser_username");
	if($usernames) {
		$tcounts="1";
		echo "<div class='subdesc'>".parse_cache_feed($usernames,$tcounts,$type)."</div>";
		wp_reset_query();
	}

	else
	{
		echo "<div class='subdesc'>'.__(Please enter twitter username in Theme options panel general tab','versatile_admin').'</div>"; }
	}
		echo "</div>";

break;
}
}
function sys_relatedpopular($postid){
	global $wpdb;
	
	echo'<div class="divider_line"></div>';
	echo'<div class="one_half">';
	
	wp_reset_query(); 

	$tags = wp_get_post_tags($postid);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id; $args=array(
			'tag__in'			=> $tag_ids,
			'post__not_in'		=> array($post->ID),
			'showposts'			=>5, // Number of related posts that will be shown.
			'caller_get_posts'	=>1
		);
		wp_reset_query();
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) { 
			$related_post_found = true;
			echo '<div class="widget_postslist"><h3>Related Posts</h3><ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
		
				echo "<li>";
				$post_date = $my_query->post_date;
				$post_date = mysql2date('M j, Y', $post_date, false);
				if (has_post_thumbnail($post->ID) ){
					$thumb = get_post_thumbnail_id($post->ID); 	
					$popular_image = vt_resize( $thumb, '', 40, 40, true );	
				?>
				<a href="<?php echo get_permalink($post->ID); ?>" class="thumb" title="<?php the_title(); ?>"><img class="thinframe"  src="<?php echo $popular_image[url]; ?>"    width="<?php echo $popular_image[width]; ?>" height="<?php echo $popular_image[height]; ?>" alt="" /></a>
				<?php
				}
				else
				{ ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="thumb" >
				<img class="thinframe" src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"  alt="" width="40" height="40" />
				</a>
				<?php 
				} ?>
				<div class="postinfo">
					<?php echo '<span class="wpldate">'.get_the_date().'</span>'; ?>
					<a href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?></a>
				</div>
			</li>
			<?php
			}
			echo '</ul>';
		}
	}
	// If no related posts found
	if(!$related_post_found){
		echo '<div class="widget_postslist"><h3>Recent Posts</h3><ul>';
		$myposts = get_posts('numberposts=3&offset=1');
		foreach($myposts as $post) :
		if(preg_match_all('!.+\.(?:jpe?g|png|gif)!Ui',get_post_meta($post->ID, 'post_image', true), $matches)) {
			$popular_image = get_post_meta($post->ID, 'post_image', true);
		}
		echo "<li>";
		$post_date = $post->post_date;
		$post_date = mysql2date('M j, Y', $post_date, false);
		if (has_post_thumbnail($post->ID) ){
			$thumb = get_post_thumbnail_id($post->ID); 	
			$popular_image = vt_resize( $thumb, '', 40, 40, true );	
		?>
		<a href="<?php echo get_permalink($post->ID); ?>" class="thumb" title="<?php echo $title ?>">
		<img class="thinframe" src="<?php echo $popular_image[url]; ?>" alt=""  width="<?php echo $popular_image[width]; ?>" height="<?php echo $popular_image[height]; ?>" />
		</a>
		<?php } else { ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="thumb" >
			<img class="thinframe" src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="" width="40" height="40" />
		</a>
		<?php 
		} ?>
		<div class="postinfo">
			<?php echo '<span class="wpldate">'.$post_date.'</span>'; ?>
			<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>"> <?php echo $post->post_title ?></a>
		</div>
	</li>
<?php endforeach; 
}	
wp_reset_query(); 
?>	
</div>
</ul>
</div>			
<div class="one_half last">
	<div class="widget_postslist"><h3>Popular Posts</h3>
		<ul>
			<?php
			global $wpdb;
			$popular_limits=$count;
			$show_pass_post = false; $duration='';
			$request = "SELECT ID, post_title,post_date, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
			$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
			if(!$show_pass_post) $request .= " AND post_password =''";
			if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";}
			$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT 3";
			$popular_posts = $wpdb->get_results($request);
				foreach($popular_posts as $post) {
					if($post) {
						print "<li>";
						$post_date = $post->post_date;
						$post_date = mysql2date('M j, Y', $post_date, false);
						if (has_post_thumbnail($post->ID) ){
							$thumb = get_post_thumbnail_id($post->ID);
							$popular_image = vt_resize( $thumb, '', 40, 40, true );
						?>
						<a href="<?php echo get_permalink($post->ID); ?>" class="thumb" title="<?php echo $title ?>">
							<img class="thinframe" src="<?php echo $popular_image[url]; ?>"   width="<?php echo $popular_image[width]; ?>" height="<?php echo $popular_image[height]; ?>" alt="" />
						</a>
						<?php
						}
						else
						{ ?>
						<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>" class="thumb" >
							<img class="thinframe" src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg"  alt="" width="40" height="40" />
						</a>
						<?php
						} ?>
						<div class="postinfo">
							<?php echo '<span class="wpldate">'.$post_date.'</span>'; ?>
							<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>"> <?php echo $post->post_title ?></a>
						</div>
					<?php print "</li>"; 
					}
				}
			wp_reset_query();
			?>
			</div>
		</ul>	
	</div>
<?php } ?>